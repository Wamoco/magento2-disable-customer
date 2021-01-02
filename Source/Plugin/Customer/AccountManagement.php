<?php
/**
 * Greetings from Wamoco GmbH, Bremen, Germany.
 * @author Wamoco Team<info@wamoco.de>
 * @license See LICENSE.txt for license details.
 */

namespace Wamoco\DisableCustomer\Plugin\Customer;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Exception\LocalizedException;
use Wamoco\DisableCustomer\Helper\Data as Helper;
use Wamoco\DisableCustomer\Model\Config;

/**
 * Class: AccountManagement
 */
class AccountManagement
{
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var \Wamoco\DisableCustomer\Model\Config
     */
    protected $config;

    /**
     * @var \Wamoco\DisableCustomer\Helper\Data
     */
    protected $helper;

    /**
     * __construct
     *
     * @param CustomerFactory $customerFactory
     * @param Config $config
     * @param Helper $helper
     */
    public function __construct(
        CustomerFactory $customerFactory,
        Config $config,
        Helper $helper
    ) {
        $this->customerFactory = $customerFactory;
        $this->config          = $config;
        $this->helper          = $helper;
    }

    /**
     * aroundIsLocked
     *
     * @param \Magento\Customer\Model\Authentication $accountManagement
     * @param callable $proceed
     * @param mixed $customerId
     * @return bool
     */
    public function aroundIsLocked(
        \Magento\Customer\Model\Authentication $accountManagement,
        callable $proceed,
        $customerId
    ) {
        $customer = $this->customerFactory
                         ->create()
                         ->load($customerId);

        if ($customer && $customer->getId() && $this->helper->isCustomerDisabled($customer)) {
            if ($this->config->getMessage()) {
                throw new LocalizedException($this->config->getMessage());
            }
            return true;
        }

        return $proceed($customerId);
    }
}
