<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ComputerGames\Model\ResourceModel;

class Game extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('unit6_computer_game', 'game_id');
    }
}
