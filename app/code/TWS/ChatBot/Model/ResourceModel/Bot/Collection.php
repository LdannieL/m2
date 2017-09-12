<?php
namespace TWS\ChatBot\Model\ResourceModel\Bot;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('TWS\ChatBot\Model\Bot','TWS\ChatBot\Model\ResourceModel\Bot');
    }
}
