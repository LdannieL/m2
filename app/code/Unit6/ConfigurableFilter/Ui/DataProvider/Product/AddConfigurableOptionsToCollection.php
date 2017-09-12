<?php

namespace Unit6\ConfigurableFilter\Ui\DataProvider\Product;

class AddConfigurableOptionsToCollection implements \Magento\Ui\DataProvider\AddFilterToCollectionInterface {
    
    protected $configurableOptions = null;

    public function __construct(\Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Attribute\Collection $collection) {
        $this->configurableOptions = $collection;
    }

    public function addFilter(\Magento\Framework\Data\Collection $collection, $field, $condition = null) {
        if (isset($condition['eq']) && ($numberOfOptions = $condition['eq'])) {
            
            $select = $this->configurableOptions->getSelect()
              ->reset(\Zend_Db_Select::COLUMNS)
              ->columns(array('product_id', 'COUNT(*) as cnt'))
              ->group('product_id');

            $res = $this->configurableOptions->getConnection()->fetchAll($select);

            $ids = array();
            foreach ($res as $opt) {
                if ($opt['cnt'] == $numberOfOptions) {
                    $ids[] = $opt['product_id'];
                }
            }
            $collection->addFieldToFilter('entity_id', array('in' => $ids));
        }
    }
    
}