<?php
namespace Training4\Vendor\Block;
class Vendor extends \Magento\Framework\View\Element\Template
{
	protected $vendorCollectionFactory;
	protected $_coreRegistry = null;

    public function __construct(
	    \Magento\Framework\View\Element\Template\Context $context,
	    \Training4\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
	    \Magento\Framework\Registry $registry
	)
	{
	    $this->vendorCollectionFactory = $vendorCollectionFactory;
	    $this->_coreRegistry = $registry;
	    //must have or throws Call to a member function dispatch() on null
	    parent::__construct($context);
	}

	public function getVendors()
	{
		$product_id = $this->getProductId();
		$vendors = [];
		$collection = $this->vendorCollectionFactory->create();
        $collection->filterVendors($product_id);
        foreach ($collection as $item) {
            $vendors[] = $item->getVendorName();
        }
        return $vendors;
	}



	/**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProductId()
    {
        return $this->_coreRegistry->registry('product')->getId();
    }
}
