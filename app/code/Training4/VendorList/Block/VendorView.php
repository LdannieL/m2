<?php
namespace Training4\VendorList\Block;

class VendorView extends \Magento\Framework\View\Element\Template
{

	//function _prepareLayout(){}

	protected $vendorCollectionFactory;
	protected $vendorFactory;
	protected $vendorProduct;
	protected $vendorproductCollectionFactory;

    public function __construct(
	    \Magento\Framework\View\Element\Template\Context $context,
	    \Training4\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
	    \Training4\Vendor\Model\VendorFactory $vendorFactory,
	    \Training4\Vendor\Model\VendorProduct $vendorProduct,
	    \Training4\Vendor\Model\ResourceModel\VendorProduct\CollectionFactory $vendorproductCollectionFactory
	)
	{
	    $this->vendorCollectionFactory = $vendorCollectionFactory;
	    $this->vendorFactory = $vendorFactory;
	    $this->vendorProduct = $vendorProduct;
	    $this->vendorproductCollectionFactory = $vendorproductCollectionFactory;
	    //must have or throws Call to a member function dispatch() on null
	    parent::__construct($context);
	}

	public function getVendor()
	{
		$vendor_id = $this->getRequest()->getParam('vendor_id');
		$vendors = [];
		$vendor = $this->vendorFactory->create()->load($vendor_id);;
        return $vendor;
	}

	public function getProducts()
	{
		$vendor_id = $this->getRequest()->getParam('vendor_id');
		//var_dump($vendor_ids);exit;
		$products = [];
		$collection = $this->vendorproductCollectionFactory->create();
        $collection->filterProducts($vendor_id);
        foreach ($collection as $item) {
            $products[] = $item->getProductId();
        }
        return $products;
	}

	//This one works, too
	// public function getProducts()
	// {
	// 	$vendor_id = $this->getRequest()->getParam('vendor_id');
	// 	$vendors = $this->vendorProduct->getProducts([$vendor_id]);

 //        foreach ($vendors[$vendor_id] as $vendor) {
 //            $products[] = $vendor;
 //        }
 //        return $products;
	// } 






	// public function getProducts()
	// {
	// 	$vendor_id = $this->getRequest()->getParam('vendor_id');
	// 	$vendor_ids = array();
	// 	$vendor_ids[] = $vendor_id;
	// 	//var_dump($vendor_ids);exit;
	// 	$products = [];
	// 	$collection = $this->vendorCollectionFactory->create();
 //        $collection->filterProducts($vendor_ids);
 //        foreach ($collection as $item) {
 //            $products[$vendor_id][] = $item->getProductId();
 //        }
 //        return $products;
	// }

	// public function getProducts()
	// {
	// 	$vendor_id = $this->getRequest()->getParam('vendor_id');
	// 	$products = [];
	// 	$collection = $this->vendorCollectionFactory->create();
 //        $collection->addFieldToSelect('*')
 //                ->addFieldToFilter('main_table.vendor_id', array(
	// 			        'main_table.vendor_id' => array($vendor_id))
 //                );
 //        foreach ($collection as $item) {
 //            $products[$vendor_id][] = $item->getProductId();
 //        }
 //        return $products;
	// }
}
