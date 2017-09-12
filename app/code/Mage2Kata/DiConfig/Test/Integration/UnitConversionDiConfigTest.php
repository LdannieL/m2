<?php
 
namespace Mage2Kata\DiConfig;
 
use Magento\Framework\ObjectManager\ConfigInterface;
use Magento\TestFramework\ObjectManager;
 
class UnitConversionDiConfigTest extends \PHPUnit_Framework_TestCase
{
    private $configType = Model\Config\UnitConversion\Virtual::class;
 
    private $readerType = Model\Config\UnitConversion\Reader\Virtual::class;
    private $schemaLocatorType = Model\Config\UnitConversion\SchemaLocator\Virtual::class;

    /**
     * @return ConfigInterface
     */
    private function getDiConfig()
    {
        return ObjectManager::getInstance()->get(ConfigInterface::class);
    }
 
    /**
     * @param string $expectedRealType
     * @param string $virtualType
     */
    private function assertVirtualType($expectedRealType, $virtualType)
    {
        $this->assertSame($expectedRealType, $this->getDiConfig()->getInstanceType($virtualType));
    }
 
    /**
     * @param mixed $expected
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
            $this->fail(sprintf('Argument "%s" for %s is not xsi:type="object"', $argumentName, $type));
        }
        $this->assertSame($expectedType, $arguments[$argumentName]['instance']);
    }

    public function testUnitConversionConfigDataDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Data::class, $this->configType);
        $this->assertDiArgumentSame('mage2kata_unitconversion_map_config', $this->configType, 'cacheId');
        $this->assertDiArgumentInstance($this->readerType, $this->configType, 'reader');
    }

    public function testUnitConversionConfigReaderDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Reader\Filesystem::class, $this->readerType);
        $this->assertDiArgumentSame('unit_conversion.xml', $this->readerType, 'fileName');
        $this->assertDiArgumentInstance($this->schemaLocatorType, $this->readerType, 'schemaLocator');
        $converterType = \Mage2Kata\DiConfig\Model\Config\UnitConversionConfigConverter::class;
        $this->assertDiArgumentInstance($converterType, $this->readerType, 'converter');

    }

    public function testUnitConversionConfigSchemaLocatorDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\GenericSchemaLocator::class, $this->schemaLocatorType);
        $this->assertDiArgumentSame('Mage2Kata_DiConfig', $this->schemaLocatorType, 'moduleName');
        $this->assertDiArgumentSame('unit_conversion.xsd', $this->schemaLocatorType, 'schema');
    }

    public function testCanReadUnitConversionXmlData()
    {
        /** @var \Magento\Framework\Config\DataInterface $config */
        $config = ObjectManager::getInstance()->create($this->configType);
        $data = $config->get(null);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
        //print_r($data);

    }
}