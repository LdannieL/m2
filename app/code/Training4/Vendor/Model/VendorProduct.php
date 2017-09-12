<?php
namespace Training4\Vendor\Model;
//class VendorProduct extends \Magento\Framework\Model\AbstractModel implements \Training4\Vendor\Api\Data\VendorProductInterface, \Magento\Framework\DataObject\IdentityInterface
class VendorProduct extends \Magento\Framework\Model\AbstractModel implements \Training5\VendorRepository\Api\Data\VendorProductInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'training4_vendor_vendor2product';

    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\ResourceModel\VendorProduct');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
	 * @param array $productIds
	 */
	public function getVendors($productIds)
	{
	    return $this->_getResource()->getVendors($productIds);
	}

	/**
	 * @param array $stockistIds
	 */
	public function getProducts($vendorIds)
	{
	    return $this->_getResource()->getProducts($vendorIds);
	}
}
