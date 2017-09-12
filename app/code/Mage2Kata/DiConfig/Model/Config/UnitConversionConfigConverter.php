<?php

namespace Mage2Kata\DiConfig\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class UnitConversionConfigConverter implements ConverterInterface
{
//    /**
//     * @param \DOMDocument $source
//     * @return array[]
//     */
//    public function convert($source)
//    {
//        return [];
//    }

    private function getChildrenByName(\DOMElement $parent, $name)
    {
        return array_filter($this->getAllChildElements($parent), function (\DOMElement $child) use ($name){
            return $child->nodeName === $name;
        });
    }

    private function getAttribute(\DOMElement $element, $name)
    {
        return $element->attributes->getNamedItem($name)->nodeValue;
    }

//    public function convert($document)
//    {
//        $rootNode = $this->getRootNode($document);
//        $result = [];
////        foreach ($this->getAllChildElements($rootNode) as $childNode) {
////            if ($childNode->nodeName === 'unit') {
////                $unit = $childNode->attributes->getNamedItem('id')->nodeValue;
////                $result[$unit] = true;
////            }
////        }
//        foreach ($this->getChildrenByName($rootNode, 'unit') as $unitNode) {
////            $unit = $unitNode->attributes->getNamedItem('id')->nodeValue;
//            $unit = $this->getAttribute($unitNode, 'id');
////            $result[$unit] = [];
////            //added to make pass testAddsEachConversionBelowItsUnit
////            foreach ($this->getChildrenByName($unitNode, 'conversion') as $conversionNode) {
////                $targetUnit = $conversionNode->attributes->getNamedItem('to')->nodeValue;
////                $factor = $conversionNode->attributes->getNamedItem('factor')->nodeValue;
////                $result[$unit][$targetUnit] = $factor;
////            }
//            $result[$unit] = $this->collectConversions($unitNode);
//        }
//        return $result;
//    }

    public function convert($document)
    {
        $rootNode = $this->getRootNode($document);
        return $this->collectUnits($rootNode);
    }

    private function collectConversions(\DOMElement $unitNode)
    {
        $conversions = [];
        foreach ($this->getChildrenByName($unitNode, 'conversion') as $conversionNode) {
            $targetUnit = $this->getAttribute($conversionNode, 'to');
//            $factor = $this->getAttribute($conversionNode, 'factor');
//            $conversions[$targetUnit] = $factor;
            $conversions[$targetUnit] = $this->getAttribute($conversionNode, 'factor');
        }
        return $conversions;
    }

    public function getRootNode(\DOMDocument $document)
    {
//        /** @var \DOMNode $childNode */
//        foreach ($document->childNodes as $childNode) {
//            if ($childNode->nodeType === \XML_ELEMENT_NODE) {
//                return $childNode;
//            }
//        }
        return $this->getAllChildElements($document)[0];
    }

    private function collectUnits(\DOMElement $rootNode)
    {
        $result = [];
        foreach ($this->getChildrenByName($rootNode, 'unit') as $unitNode) {
            $unit = $this->getAttribute($unitNode, 'id');
//            $result[$unit] = $this->collectConversions($unitNode);
            //to make pass testOverwritesNodesWithTheSameUnits
            //the second <unit id="mg"> node completely overwrote previous node
            $conversions = $this->collectConversions($unitNode);
            $result[$unit] = isset($result[$unit]) ? array_merge($result[$unit], $conversions) : $conversions;
        }
        return $result;
    }

    /**
     * @param \DOMNode $source
     * @return \DOMElement[]
     */
    public function getAllChildElements(\DOMNode $source)
    {
        return array_filter(iterator_to_array($source->childNodes), function (\DOMNode $childNode) {
            return $childNode->nodeType === \XML_ELEMENT_NODE;
        });
    }
}