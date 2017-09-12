<?php
namespace Pulsestorm\ToDoCrud\Model;
class TodoItem extends \Magento\Framework\Model\AbstractModel implements TodoItemInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pulsestorm_todocrud_todoitem';

    protected function _construct()
    {
        $this->_init('Pulsestorm\ToDoCrud\Model\ResourceModel\TodoItem');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve todo id
     *
     * @return string
     */
    public function getPulsestormTodocrudTodoitemId()
    {
        return $this->getData('pulsestorm_todocrud_todoitem_id');
    }

    /**
     * Retrieve todo title
     *
     * @return string
     */
    public function getItemText()
    {
        return $this->getData('item_text');
    }
}
