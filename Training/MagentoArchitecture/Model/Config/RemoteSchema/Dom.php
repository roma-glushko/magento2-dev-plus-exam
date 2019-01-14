<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Model\Config\RemoteSchema;

use DOMDocument;
use InvalidArgumentException;
use Magento\Framework\Config\Dom as ConfigDom;
use Magento\Framework\Config\Dom\UrnResolver;
use Magento\Framework\Config\Dom\ValidationSchemaException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Phrase;

class Dom extends ConfigDom
{
    /**
     * @var UrnResolver
     */
    private static $urnResolver;

    /**
     * @var array
     */
    private static $resolvedSchemaPaths = [];

    /**
     * @param DOMDocument $dom
     * @param string $schema
     * @param string $errorFormat
     *
     * @return array|string[]
     * @throws NotFoundException
     */
    public static function validateDomDocument(
        DOMDocument $dom,
        $schema,
        $errorFormat = ConfigDom::ERROR_FORMAT_DEFAULT
    ) {
        if (!function_exists('libxml_set_external_entity_loader')) {
            return [];
        }

        if (!self::$urnResolver) {
            self::$urnResolver = new RemoteSchemaResolver();
        }

        if (!isset(self::$resolvedSchemaPaths[$schema])) {
            self::$resolvedSchemaPaths[$schema] = self::$urnResolver->getRealPath($schema);
        }

        $schema = self::$resolvedSchemaPaths[$schema];

        libxml_use_internal_errors(true);
        libxml_set_external_entity_loader([self::$urnResolver, 'registerEntityLoader']);
        $errors = [];

        try {
            $result = $dom->schemaValidate($schema);
            if (!$result) {
                $errors = self::getXmlErrors($errorFormat);
            }
        } catch (\Exception $exception) {
            $errors = self::getXmlErrors($errorFormat);
            libxml_use_internal_errors(false);
            array_unshift($errors, new Phrase('Processed schema file: %1', [$schema]));
            throw new ValidationSchemaException(new Phrase(implode("\n", $errors)));
        }

        libxml_set_external_entity_loader(null);
        libxml_use_internal_errors(false);

        return $errors;
    }

    /**
     * Retrieve array of xml errors
     *
     * @param string $errorFormat
     * @return string[]
     */
    private static function getXmlErrors($errorFormat)
    {
        $errors = [];
        $validationErrors = libxml_get_errors();
        if (count($validationErrors)) {
            foreach ($validationErrors as $error) {
                $errors[] = self::_renderErrorMessage($error, $errorFormat);
            }
        } else {
            $errors[] = 'Unknown validation error';
        }
        return $errors;
    }

    /**
     * Render error message string by replacing placeholders '%field%' with properties of \LibXMLError
     *
     * @param \LibXMLError $errorInfo
     * @param string $format
     * @return string
     *
     * @throws InvalidArgumentException
     */
    private static function _renderErrorMessage(\LibXMLError $errorInfo, $format)
    {
        $result = $format;
        foreach ($errorInfo as $field => $value) {
            $placeholder = '%' . $field . '%';
            $value = trim((string)$value);
            $result = str_replace($placeholder, $value, $result);
        }
        if (strpos($result, '%') !== false) {
            if (preg_match_all('/%.+%/', $result, $matches)) {
                $unsupported = [];
                foreach ($matches[0] as $placeholder) {
                    if (strpos($result, $placeholder) !== false) {
                        $unsupported[] = $placeholder;
                    }
                }
                if (!empty($unsupported)) {
                    throw new InvalidArgumentException(
                        "Error format '{$format}' contains unsupported placeholders: " . implode(', ', $unsupported)
                    );
                }
            }
        }
        return $result;
    }
}