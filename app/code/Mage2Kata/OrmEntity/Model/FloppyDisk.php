<?php

namespace Mage2Kata\OrmEntity\Model;

use Magento\Framework\Model\AbstractModel;

class FloppyDisk extends AbstractModel
{
    const SIZE = 'size';
    const CAPACITY = 'capacity';
    const BRAND = 'brand';
    const COLOR = 'color';
    const DATE_OF_MANUFACTURE = 'date_of_manufacture';

    protected function _construct()
    {
        $this->_init(\Mage2Kata\OrmEntity\Model\ResourceModel\FloppyDisk::class);
    }

    public function getSize()
    {
        return $this->_getData(self::SIZE);
    }

    public function setSize($size)
    {
        return $this->setData(self::SIZE, $size);
    }

    public function getCapacityInKb()
    {
        return $this->_getData(self::CAPACITY);
    }

    public function setCapacityInKb($capacity)
    {
        return $this->setData(self::CAPACITY, $capacity);
    }

    public function getBrand()
    {
        return $this->_getData(self::BRAND);
    }

    public function setBrand($brand)
    {
        return $this->setData(self::BRAND, $brand);
    }

    public function getColor()
    {
        return $this->_getData(self::COLOR);
    }

    public function setColor($color)
    {
        return $this->setData(self::COLOR, $color);
    }

    public function getDateOfManufacture()
    {
        return $this->_getData(self::DATE_OF_MANUFACTURE);
    }

    public function setDateOfManufacture($dateOfManufacture)
    {
        return $this->setData(self::DATE_OF_MANUFACTURE, $dateOfManufacture);
    }
}