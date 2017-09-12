<?php
 
namespace Mage2Kata\DiConfig;
 
use Magento\Framework\ObjectManager\ConfigInterface as ObjectManagerConfig;
use Magento\TestFramework\ObjectManager;
 
class DiConfigConfigurationTest extends \PHPUnit_Framework_TestCase
{
	// public function testNothing()
 //    {
 //        $this->fail('here we go');
 //    }

    // public function testUnitMapConfigDataVirtualType()
    // {
    //     /** @var ObjectManagerConfig $diConfig */
    //     $diConfig = ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    //     $this->assertSame(
    //         \Magento\Framework\Config\Data::class,
    //         $diConfig->getInstanceType(Model\Config\Data\Virtual::class)
    //     );
    // }

    // Refactored version
    /**
     * @return ObjectManagerConfig
     */
    private function getDiConfig()
    {
        return ObjectManager::getInstance()->get(ObjectManagerConfig::class);
    }
 
    /**
     * @param string $expectedType
     * @param string $type
     */
    private function assertVirtualType($expectedType, $type)
    {
        $this->assertSame($expectedType, $this->getDiConfig()->getInstanceType($type));
    }
 	//step 1
    // public function testUnitMapConfigDataVirtualType()
    // {
    //     $type = Model\Config\Data\Virtual::class;
    //     $this->assertVirtualType(\Magento\Framework\Config\Data::class, $type);
    // }
    
    //step2
 //    public function testUnitMapConfigDataVirtualType()
	// {
	//     $type = Model\Config\Data\Virtual::class;
	//     $this->assertVirtualType(\Magento\Framework\Config\Data::class, $type);
	 
	//     $argumentName = 'cacheId';
	//     $arguments = $this->getDiConfig()->getArguments($type);
	//     if (! isset($arguments[$argumentName])) {
	//         $this->fail(sprintf('No argument "%s" configured for %s', $argumentName, $type));
	//     }
	//     $this->assertSame('mage2kata_config_unitconversion_map', $arguments[$argumentName]);
	// }
	
    //refactored sp 2
	/**
	 * @param string $expected
	 * @param string $type
	 * @param string $argumentName
	 */
	private function assertDiArgumentSame($expected, $type, $argumentName)
	{
	    $arguments = $this->getDiConfig()->getArguments($type);
	    if (!isset($arguments[$argumentName])) {
	        $this->fail(sprintf('No argument "%s" configured for %s', $argumentName, $type));
	    }
	    $this->assertSame($expected, $arguments[$argumentName]);
	}
	 
	// public function testUnitMapConfigDataVirtualType()
	// {
	//     $type = Model\Config\Data\Virtual::class;
	//     $this->assertVirtualType(\Magento\Framework\Config\Data::class, $type);
	//     $this->assertDiArgumentSame('mage2kata_config_unitconversion_map', $type, 'cacheId');
	// }
 
    /**
     * @param string $expectedType
     * @param string $type
     * @param string $argumentName
     */
    private function assertDiArgumentInstance($expectedType, $type, $argumentName)
    {
        $arguments = $this->getDiConfig()->getArguments($type);
        if (!isset($arguments[$argumentName])) {
            $this->fail(sprintf('No argument "%s" configured for %s', $argumentName, $type));
        }
        if (!isset($arguments[$argumentName]['instance'])) {
            $this->fail(sprintf('The argument "%s" for %s is not of xsi:type="object"', $argumentName, $type));
        }
        $this->assertSame($expectedType, $arguments[$argumentName]['instance']);
    }
    
 	//step 3
    public function testUnitMapConfigDataVirtualType()
    {
        $type = Model\Config\Data\Virtual::class;
        $this->assertVirtualType(\Magento\Framework\Config\Data::class, $type);
        $this->assertDiArgumentSame('mage2kata_config_unitconversion_map', $type, 'cacheId');
        $this->assertDiArgumentInstance(Model\Config\Data\Reader\Virtual::class, $type, 'reader');
    }
}