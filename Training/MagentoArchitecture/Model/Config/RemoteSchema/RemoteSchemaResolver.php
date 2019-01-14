<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Model\Config\RemoteSchema;

use Magento\Framework\Config\Dom\UrnResolver;
use Magento\Framework\Exception\LocalizedException;

class RemoteSchemaResolver extends UrnResolver
{
    /**
     * Loads remote schema if needed
     *
     * @param string $public
     * @param string $system
     * @param array $context
     *
     * @return bool|resource
     *
     * @throws LocalizedException
     */
    public function registerEntityLoader($public, $system, $context)
    {
        if (strpos($system, "http:") === 0 || strpos($system, "https:") === 0) {
            return fopen($system, 'r');
        }

        return parent::registerEntityLoader($public, $system, $context);
    }

}