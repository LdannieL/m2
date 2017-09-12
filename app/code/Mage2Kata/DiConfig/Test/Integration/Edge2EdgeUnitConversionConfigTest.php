<?php
 
namespace Mage2Kata\DiConfig;
 
use Magento\TestFramework\ObjectManager;

class Edge2EdgeUnitConversionConfigTest extends \PHPUnit_Framework_TestCase
{
	// public function testNothing()
 //    {
 //        $this->fail('foo');
 //    }
    
    private $configType = \Mage2Kata\DiConfig\Model\Config\UnitConversion\Virtual::class;
 
    public function testCanAccessUnitConversionConfig()
    {
        $objectManager = ObjectManager::getInstance();
        /** @var \Magento\Framework\Config\Data $config */
        $config = $objectManager->create($this->configType);
        $this->assertSame('2.20462257811', $config->get('kg/lbs'));
    }
    
    public function testMultipleFilesCanBeMerged()
    {
        $mockFileResolver = $this->getMock(\Magento\Framework\Config\FileResolverInterface::class);
        $mockFileResolver->method('get')->willReturn([
            'test1.xml' => <<<XML
<conversion_map>
    <unit id="kg" type="weight">
        <conversion to="mg" factor="111"/>
        <conversion to="g" factor="222"/>
        <conversion to="lbs" factor="333"/>
    </unit>
</conversion_map>
XML
            ,'test2.xml' => <<<XML
<conversion_map>
    <unit id="kg" type="weight">
        <conversion to="lbs" factor="444"/>
    </unit>
</conversion_map>
XML
        ]);
        $objectManager = ObjectManager::getInstance();
        $reader = $objectManager->create(
            \Mage2Kata\DiConfig\Model\Config\UnitConversion\Reader\Virtual::class,
            ['fileResolver' => $mockFileResolver]
        );
        $mockCache = $this->getMock(\Magento\Framework\Config\CacheInterface::class);
        $mockCache->method('load')->willReturn(false);
        /** @var \Magento\Framework\Config\Data $config */
        $config = $objectManager->create($this->configType, ['reader' => $reader, 'cache' => $mockCache]);
        $this->assertSame('444', $config->get('kg/lbs'));
    }
}