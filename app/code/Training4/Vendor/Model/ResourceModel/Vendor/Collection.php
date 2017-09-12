<?php
namespace Training4\Vendor\Model\ResourceModel\Vendor;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\Vendor','Training4\Vendor\Model\ResourceModel\Vendor');
    }


    // protected function _renderFiltersBefore() {
    //     $joinTable = $this->getTable('training4_vendor2product');
    //     $this->getSelect()->join($joinTable.' as product','main_table.vendor_id= product.vendor_id', array('*'));
    //     parent::_renderFiltersBefore();
    // }

    // protected function _renderFiltersBefore() {
    //     $joinTable = $this->getTable('training4_vendor2product');
    //     $this->getSelect()->join($joinTable.' as product','main_table.vendor_id= product.vendor_id',
    //         array('product_id' => 'product.product_id'
    //             ));
    //     $this->addFilterToMap('product_id', 'product.product_id');
    //     $this->addFilterToMap('vendor_id', 'main_table.vendor_id');
    //     parent::_renderFiltersBefore();
    // }

    public function filterVendors($product_id)
    {

        $this->getSelect()
            ->join(array('product' => 'training4_vendor2product'), 'main_table.vendor_id= product.vendor_id',
                array('product_id' => 'product.product_id',
                	'vendor_name' => 'main_table.name'
                )
            );
 
        $this->getSelect()->where("product_id=".$product_id);
       
        // $this->training4_vendor_table = "main_table";
        // $this->training4_vendor2product_table = $this->getTable("training4_vendor2product");
        // $this->getSelect()
        //     ->join(array('product' => $this->training4_vendor2product_table), $this->training4_vendor_table . '.vendor_id= product.vendor_id',
        //         array('product_id' => 'product.product_id',
        //         	'vendor_name' => $this->training4_vendor_table.'.name'
        //         )
        //     );
 
        // $this->getSelect()->where("product_id=".$product_id);
    }

    // public function filterProducts(array $vendor_ids)
    // {

    //     $this->getSelect()
    //         ->join(array('product' => 'training4_vendor2product'), 'main_table.vendor_id= product.vendor_id',
    //             array('product_id' => 'product.product_id'
    //             )
    //         )->group('main_table.vendor_id');  //No it gets only distinct
 
    //     //$this->getSelect()->where("main_table.vendor_id=".$vendor_id);
    //     // $this->getSelect()->where("product.vendor_id=".$vendor_id);
    //     $this->getSelect()->where (
    //         'product.vendor_id IN (?)',
    //         $vendor_ids
    //     );
    //     //$this->getSelect()->where("product.vendor_id IN" . $vendor_ids);
    // }


    //Can't work because of returning multiple vendor_id s from main table and from joined
    // public function filterProducts($vendor_ids)
    // {

    //     $this->getSelect()
    //         ->join(array('product' => 'training4_vendor2product'), 'main_table.vendor_id= product.vendor_id',
    //             array('product_id' => 'product.product_id',
    //                 'vendor_id' => 'product.vendor_id'
    //             )
    //         );
 
    //     //$this->getSelect()->where("main_table.vendor_id=".$vendor_id);
    //     // $this->getSelect()->where("product.vendor_id=".$vendor_id);
    // }


}
