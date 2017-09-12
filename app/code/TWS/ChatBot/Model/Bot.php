<?php
namespace TWS\ChatBot\Model;
class Bot extends \Magento\Framework\Model\AbstractModel implements \TWS\ChatBot\Api\Data\BotInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'tws_chatbot_bot';

    protected function _construct()
    {
        $this->_init('TWS\ChatBot\Model\ResourceModel\Bot');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
