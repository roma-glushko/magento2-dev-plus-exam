<?php
/**
 * Email templates config schema locator
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Model\Config\Training;

use Magento\Framework\Config\SchemaLocatorInterface;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader as ModuleDirReader;

class SchemaLocator implements SchemaLocatorInterface
{
    /**
     * Path to corresponding XSD file with validation rules for both individual and merged configs
     *
     * @var string
     */
    private $schema;

    /**
     * @param ModuleDirReader $moduleReader
     */
    public function __construct(ModuleDirReader $moduleReader)
    {
        $this->schema = $moduleReader->getModuleDir(
                Dir::MODULE_ETC_DIR,
                'Training_MagentoArchitecture'
            ) . '/training_config.xsd';
    }

    /**
     * {@inheritdoc}
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * {@inheritdoc}
     */
    public function getPerFileSchema()
    {
        return $this->schema;
    }
}
