<?php
namespace Training4\Vendor\Model;
// class Vendor extends \Magento\Framework\Model\AbstractModel implements Training5\VendorRepository\Api\Data, \Magento\Framework\DataObject\IdentityInterface
class Vendor extends \Magento\Framework\Model\AbstractModel implements \Training5\VendorRepository\Api\Data\VendorInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'training4_vendor';

    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\ResourceModel\Vendor');
    }


    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    public function sayHello() {
        return "Yep, API WORKS!";
    }
}
