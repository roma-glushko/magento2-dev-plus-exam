<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\MagentoArchitecture\Model\Config\Training;

use Magento\Framework\Config\Data\Scoped as ScopedConfigData;

class ScopedData extends ScopedConfigData
{
    /**
     * Scope priority loading scheme
     *
     * @var string[]
     */
    protected $_scopePriorityScheme = ['global', 'frontend'];
}
