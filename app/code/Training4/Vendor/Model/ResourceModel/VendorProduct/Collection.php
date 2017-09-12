<?php
namespace Training4\Vendor\Model\ResourceModel\VendorProduct;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\VendorProduct','Training4\Vendor\Model\ResourceModel\VendorProduct');
    }

    public function filterProducts($vendor_id)
    {

        $this->getSelect()
            ->join(array('vendor' => 'training4_vendor'), 'main_table.vendor_id= vendor.vendor_id',
                array('vendor_name' => 'vendor.name'
                )
            );
 
        $this->getSelect()->where("main_table.vendor_id=".$vendor_id);
    }
}
