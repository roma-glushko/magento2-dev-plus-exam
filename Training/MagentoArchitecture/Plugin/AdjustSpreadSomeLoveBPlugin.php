<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\MagentoArchitecture\Plugin;

use Training\MagentoArchitecture\Model\Service\SpreadSomeLoveService;

class AdjustSpreadSomeLoveBPlugin
{
    /**
     * @param SpreadSomeLoveService $subject
     * @param $name
     *
     * @return array
     */
    public function beforeExecute(SpreadSomeLoveService $subject, $name)
    {
        echo "Plugin B: beforeExecute" . PHP_EOL;
        return [$name];
    }

    /**
     * @param SpreadSomeLoveService $subject
     * @param callable $proceed
     * @param $name
     *
     * @return string
     */
    public function aroundExecute(SpreadSomeLoveService $subject, callable $proceed, $name)
    {
        echo "Plugin B: aroundExecute: before proceed()" . PHP_EOL;
        $result =  $proceed($name);
        echo "Plugin B: aroundExecute: after proceed()" . PHP_EOL;

        return $result;
    }

    /**
     * @param SpreadSomeLoveService $subject
     * @param $result
     * @param $name
     *
     * @return string
     */
    public function afterExecute(SpreadSomeLoveService $subject, $result, $name)
    {
        echo "Plugin B: afterExecute" . PHP_EOL;
        return $result;
    }
}