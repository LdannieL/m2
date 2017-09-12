<?php
namespace TWS\ChatBot\Model\ResourceModel;
class Bot extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('tws_chatbot_bot','tws_chatbot_bot_id');
    }
}
