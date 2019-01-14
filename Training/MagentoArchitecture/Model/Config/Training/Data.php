<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\MagentoArchitecture\Model\Config\Training;

use Magento\Framework\Config\CacheInterface as ConfigCacheInterface;
use Magento\Framework\Config\Data as ConfigData;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Proxy for caching collected and merged custom config
 */
class Data extends ConfigData
{
    /**
     * Constructor
     *
     * @param Reader $reader
     * @param ConfigCacheInterface $cache
     * @param string|null $cacheId
     * @param SerializerInterface|null $serializer
     */
    public function __construct(
        Reader $reader,
        ConfigCacheInterface $cache,
        $cacheId = 'training_config',
        SerializerInterface $serializer = null
    ) {
        parent::__construct($reader, $cache, $cacheId, $serializer);
    }
}
