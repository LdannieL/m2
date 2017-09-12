<?php

namespace Training4\Warranty\Entity\Attribute\Backend;

class AddYear extends 
    \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Before save method
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);

        if ($object->hasData($attrCode)) {
            if ($value = $object->getData($attrCode) == 1) {
                $add_on = ' Year';
            } else {
                $add_on = ' Years';
            }
           $object->setData($attrCode, $value . $add_on);
        }

        return $this;
    }
}
