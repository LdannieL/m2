<?php
namespace TWS\Favorites\Model\ResourceModel\Favorites;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('TWS\Favorites\Model\Favorites','TWS\Favorites\Model\ResourceModel\Favorites');
    }

    public function filterFavoritesByCustomer($customerId)
    { 
        $this->getSelect()->where("customer_id=".$customerId);
    }

    public function filterFavoritesByStore($storeId)
    { 
        $this->getSelect()->where("store_id=".$storeId);
    }

    public function filterFavoritesByProduct($productId)
    { 
        $this->getSelect()->where("product_id=".$productId);
    }
}
