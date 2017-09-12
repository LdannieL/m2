<?php
namespace Training4\Vendor\Model\ResourceModel;
class VendorProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('training4_vendor2product','value_id');
    }

    /**
     * Retrieve product stockist Ids
     *
     * @param array $productIds
     * @return array
     */
    public function getVendors(array $productIds)
    {
        $select = $this->getConnection()->select()->from(
            $this->getMainTable(),
            ['product_id', 'vendor_id']
        )->where(
            'product_id IN (?)',
            $productIds
        );
        $rowset = $this->getConnection()->fetchAll($select);

        $result = [];
        foreach ($rowset as $row) {
            $result[$row['product_id']][] = $row['vendor_id'];
        }

        return $result;
    }


    /**
     * Retrieve stockist product Ids
     *
     * @param array $stockistIds
     * @return array
     */
    public function getProducts(array $vendorIds)
    {
        $select = $this->getConnection()->select()->from(
            $this->getMainTable(),
            ['product_id', 'vendor_id']
        )->where(
            'vendor_id IN (?)',
            $vendorIds
        );
        $rowset = $this->getConnection()->fetchAll($select);

        $result = [];
        foreach ($rowset as $row) {
            $result[$row['vendor_id']][] = $row['product_id'];
        }

        return $result;
    }
}
