<?php
namespace Unit6\ComputerGames\Model;

class Game extends \Magento\Framework\Model\AbstractExtensibleModel
//extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Unit6\ComputerGames\Model\ResourceModel\Game');
    }

    public function getCustomAttributesCodes() {
        return array('game_id', 'name', 'type', 'trial_period', 'release_date');
    }
}