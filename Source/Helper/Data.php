<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\DisableCustomer\Helper;

/**
 * Class: Data
 *
 * @see \Magento\Framework\App\Helper\AbstractHelper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * isCustomerDisabled
     *
     * @param \Magento\Customer\Model\Customer $customer
     * @return bool
     */
    public function isCustomerDisabled(\Magento\Customer\Model\Customer $customer)
    {
        $attrCode = \Wamoco\DisableCustomer\Setup\Patch\Data\AddAttribute::ATTRIBUTE_CODE;
        if ($customer->get($attrCode)) {
            return true;
        }
        return false;
    }
}
