<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Model\Config\Training;

use Magento\Framework\Config\ConverterInterface as ConfigConverterInterface;

/**
 * Converter from \DOMDocument to array
 */
class Converter implements ConfigConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function convert($source)
    {
        $result = [];

        /** @var \DOMNode $templateNode */
        foreach ($source->documentElement->childNodes as $trainingConfigNode) {
            if ($trainingConfigNode->nodeType != XML_ELEMENT_NODE) {
                continue;
            }

            $trainingConfigId = $trainingConfigNode->attributes->getNamedItem('id')->nodeValue;
            $trainingConfigValue = $trainingConfigNode->attributes->getNamedItem('value')->nodeValue;

            $result[$trainingConfigId] = $trainingConfigValue;
        }

        return $result;
    }
}
