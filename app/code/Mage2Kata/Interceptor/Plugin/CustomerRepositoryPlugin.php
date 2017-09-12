<?php
namespace Mage2Kata\Interceptor\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Created by PhpStorm.
 * User: DannieL
 * Date: 11/30/2016
 * Time: 6:57 PM
 */
class CustomerRepositoryPlugin
{
    /**
     * @var ExternalCustomerApi
     */
    private $customerApi;

    public function __construct(ExternalCustomerApi $customerApi)
    {
        $this->customerApi = $customerApi;
    }

    public function aroundSave(
        CustomerRepositoryInterface $customerRepository,
        callable $proceed,
        CustomerInterface $customer,
        $passwordHash = null
    ) {
//        if ($customer->getId() === null) {
//            $this->customerApi->registerNewCustomer();
//        }
//        return $proceed($customer, $passwordHash);
        $isCustomerNew = $customer->getId() === null;

        /** @var CustomerInterface $savedCustomer */
        $savedCustomer = $proceed($customer, $passwordHash);

        if ($isCustomerNew) {
            $this->customerApi->registerNewCustomer($savedCustomer->getId());
        }

        return $savedCustomer;
    }

}