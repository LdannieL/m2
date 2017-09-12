<?php

namespace Mage2Kata\OrmEntity\Test\Integration;

use Mage2Kata\OrmEntity\Model\FloppyDisk;
use Mage2Kata\OrmEntity\Model\ResourceModel\FloppyDisk as FloppyResource;
use Magento\TestFramework\ObjectManager;

class FloppyDiskOrmEntityTest extends \PHPUnit_Framework_TestCase
{
//    public function testNothing()
//    {
//        $this->fail('Expected fail');
//    }

    /**
     * @return FloppyDisk
     */
    private function instantiateFloppy()
    {
        return ObjectManager::getInstance()->create(FloppyDisk::class);
    }

    /**
     * @return FloppyResource
     */
    private function instantiateResourceModel()
    {
        return ObjectManager::getInstance()->create(FloppyResource::class);
    }

    /**
     * @return FloppyDisk
     */
    private function createFloppy()
    {
        $floppy = $this->instantiateFloppy();
        $floppy->setBrand(uniqid('test-'));
        $floppy->setCapacityInKb(mt_rand(200, 1288));
        $floppy->setDateOfManufacture(date('Y-m-d', mt_rand(strtotime('1971-01-01'), strtotime('1989-12-31'))));
        $floppy->setColor('#' . dechex(mt_rand(0, 255)) . dechex(mt_rand(0, 255)) . dechex(mt_rand(0, 255)));
        $sizes = ['8"', '5.25"', '3.5"', '3"'];
        $floppy->setSize($sizes[array_rand($sizes)]);
        $this->instantiateResourceModel()->save($floppy);
        return $floppy;
    }

    /**
     * @magentoDbIsolation enabled
     */
    public function testCanSaveAndLoad()
    {
        $floppy = $this->createFloppy();

        $floppyToLoad = $this->instantiateFloppy();
        $this->instantiateResourceModel()->load($floppyToLoad, $floppy->getId());

        $this->assertSame($floppy->getId(), $floppyToLoad->getId());
        $this->assertSame($floppy->getDateOfManufacture(), $floppyToLoad->getDateOfManufacture());
    }

    public function testCanLoadMultipleFloppies()
    {
        $floppyA = $this->createFloppy();
        $floppyB = $this->createFloppy();

        /** @var FloppyResource\Collection $collection */
        $collection = ObjectManager::getInstance()->create(FloppyResource\Collection::class);
        $this->assertContains($floppyA->getId(), array_keys($collection->getItems()));
        $this->assertContains($floppyB->getId(), array_keys($collection->getItems()));
    }
}