<?php
 
namespace Mage2Kata\DiConfig\Model\Config;
 
use Magento\Framework\Config\ConverterInterface;
 
class UnitConversionConfigConverterTest extends \PHPUnit_Framework_TestCase
{
//    public function testNothing()
//    {
//        $this->fail('in the foo');
//    }

     /**
      * @var UnitConversionConfigConverter
      */
     private $converter;

    /**
     * @param string $xml
     * @return \DOMDocument
     */
    private function createDOMDocument($xml)
    {
        $source = new \DOMDocument();
        $source->loadXML($xml);
        return $source;
    }
 
     protected function setUp()
     {
         $this->converter = new UnitConversionConfigConverter();
     }
 
     public function testImplementsTheConfigConverterInterface()
     {
         $this->assertInstanceOf(ConverterInterface::class, $this->converter);
     }

    public function testReturnsEmptyArrayForEmptyInput()
    {
//        $source = new \DOMDocument();
//        $source->loadXML('<empty/>');
//        $this->assertSame([], $this->converter->convert($source));
        $this->assertSame([], $this->converter->convert($this->createDOMDocument('<empty/>')));
    }

    public function testContainsTheUnitsAsArrayKeys()
    {
        // Mark our test as incomplete for now
//        $this->markTestIncomplete();
        //or
//        $this->markTestSkipped();

        $xml = <<<XML
<conversion_map>
    <unit id="mg"/>
</conversion_map>
XML;
        $this->assertArrayHasKey('mg', $this->converter->convert($this->createDOMDocument($xml)));
    }

    public function testReturnsTheRootNode()
    {
        $document = $this->createDOMDocument('<root/>');
        $rootNode = $this->converter->getRootNode($document);
        $this->assertInstanceOf(\DOMElement::class, $rootNode);
        $this->assertSame('root', $rootNode->nodeName);
    }

    public function testReturnsAllChildNodes()
    {
        $xml = <<<XXX
<root>
    <child/>
    <child/>
    <child/>
</root>
XXX;
        $documentChildren = $this->converter->getAllChildElements($this->createDOMDocument($xml));
        $this->assertInternalType('array', $documentChildren);
        $this->assertCount(1, $documentChildren);
        $this->assertContainsOnlyInstancesOf(\DOMElement::class, $documentChildren);
        $this->assertCount(3, $this->converter->getAllChildElements($documentChildren[0]));
    }

    public function testAddsEachConversionBelowItsUnit()
    {
        $xml = <<<XML
<conversion_map>
    <unit id="mg">
        <conversion to="g" factor="111"/>
        <conversion to="kg" factor="222"/>
    </unit>
</conversion_map>
XML;
        $result = $this->converter->convert($this->createDOMDocument($xml));
        $this->assertSame(['mg' => ['g' => '111', 'kg' => '222']], $result);
    }

    public function testOverwritesNodesWithTheSameUnits()
    {
        $xml = <<<XML
<conversion_map>
    <unit id="mg">
        <conversion to="g" factor="111"/>
        <conversion to="kg" factor="222"/>
    </unit>
    <unit id="mg">
        <conversion to="g" factor="333"/>
    </unit>
</conversion_map>
XML;
        $result = $this->converter->convert($this->createDOMDocument($xml));
        $this->assertSame(['mg' => ['g' => '333', 'kg' => '222']], $result);
    }
}