<?php
/**
* Copyright © Magento, Inc. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Training\MagentoArchitecture\Model\Service;

/**
 * Class SpreadSomeLoveService is a part of Magento 2 plugin/interceptor practice
 */
class SpreadSomeLoveService
{
    /**
     * Spread some love method
     *
     * @param string $userName
     *
     * @return string
     */
    public function execute(string $userName)
    {
        return sprintf('Spreading some love to %s <3', $userName);
    }
}
