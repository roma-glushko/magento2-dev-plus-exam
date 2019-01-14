<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Model\Config\RemoteSchema;

use Magento\Framework\Config\SchemaLocatorInterface;

class RemoteSchemaLocator implements SchemaLocatorInterface
{
    /**
     * Get path to merged config schema
     *
     * @return string|null
     */
    public function getSchema()
    {
        return 'https://s3.amazonaws.com/glushko-01/training_config.xsd';
    }

    /**
     * Get path to per file validation schema
     *
     * @return string|null
     */
    public function getPerFileSchema()
    {
        return 'https://s3.amazonaws.com/glushko-01/training_config.xsd';
    }
}