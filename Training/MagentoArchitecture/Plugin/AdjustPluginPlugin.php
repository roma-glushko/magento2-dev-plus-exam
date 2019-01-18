<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Plugin;

use Training\MagentoArchitecture\Model\Service\SpreadSomeLoveService;

class AdjustPluginPlugin
{
    /**
     * Disable around method of AdjustSpreadSomeLoveAPlugin
     *
     * @param AdjustSpreadSomeLoveAPlugin $subject
     * @param callable $proceed
     * @param SpreadSomeLoveService $subject
     * @param callable $proceed
     * @param $name
     *
     * @return string
     */
    public function aroundAroundExecute(
        AdjustSpreadSomeLoveAPlugin $pluginSubject,
        callable $pluginProceedCallback,
        SpreadSomeLoveService $subject,
        callable $proceed,
        $name
    ) {
        echo "Plugin on Plugin: aroundAroundExecute" . PHP_EOL;
        return $proceed($name);
    }
}