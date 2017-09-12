<?php

namespace Training4\Warranty\Entity\Attribute\Frontend;

class RenderBold extends 
    \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    /**
     * @param \Magento\Framework\Object $object
     * @return string
     */
    public function getValue(\Magento\Framework\DataObject $object)
    {
        //$value = $object->getData($this->getAttribute()->getAttributeValue());
        $value = parent::getValue($object);
        //$value = $object->getValue($object);
        return sprintf(
            '<b>%s</b>',
            $value
        );
    }
    
}
