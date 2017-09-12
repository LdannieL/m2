<?php

namespace Mage2Kata\OrmEntity\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FloppyDisk extends AbstractDb
{
    const TABLE = 'mage2kata_floppy_disk';
    const ID_FIELD = 'id';

    protected function _construct()
    {
        $this->_init(self::TABLE, self::ID_FIELD);
    }
}