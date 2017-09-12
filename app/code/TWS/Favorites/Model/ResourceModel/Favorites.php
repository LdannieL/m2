<?php
namespace TWS\Favorites\Model\ResourceModel;
class Favorites extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('tws_favorites_favorites','tws_favorites_favorites_id');
    }
}
