<?php
namespace Training4\VendorList\Block;

class VendorList extends \Magento\Framework\View\Element\Template
{
    //function _prepareLayout(){}
	/**
	 * @var \Training4\Vendor\Model\Vendor
	 */
	protected $vendorCollection;
	protected $logger;
	public $_storeManager;

	/**
	 * Vendor constructor.
	 * @param \Magento\Framework\App\Action\Context $context
	 * @param \Training4\Vendor\Model\ResourceModel\Vendor $vendorCollection
	 */
    public function __construct(
	    \Magento\Framework\View\Element\Template\Context $context,
	    \Training4\Vendor\Model\Vendor $vendorCollection,
	    \Psr\Log\LoggerInterface $logger,
	    \Magento\Store\Model\StoreManagerInterface $storeManager
	)
	{
	    $this->vendorCollection = $vendorCollection;
	    $this->logger = $logger;
	    $this->_storeManager = $storeManager;
	    //must have or throws Call to a member function dispatch() on null
	    parent::__construct($context);
	}

	protected function _prepareLayout()
	{

	    parent::_prepareLayout();
	    $this->pageConfig->getTitle()->set(__('List of all vendors'));

	    if ($this->getVendors()) {
	        $pager = $this->getLayout()->createBlock(
	            'Magento\Theme\Block\Html\Pager',
	            'vendor.list.pager'
	        )->setAvailableLimit(array(2=>2,5=>5,10=>10,15=>15,20=>20))
	            ->setShowPerPage(true)->setCollection(
	            $this->getVendors()
	        );
	        $this->setChild('pager', $pager);
	        $this->getVendors()->load();
	    }
	    return $this;
	}

	public function getPagerHtml()
	{
	    return $this->getChildHtml('pager');
	}

	/**
	 * function to get rewards point transaction of customer
	 *
	 * @return reward transaction collection
	 */
	public function getVendors()
	{
	    //get values of current page
	    $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
	    //get values of current limit
	    $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest
	    ()->getParam('limit') : 2;


	    $collection = $this->vendorCollection->getCollection();
	    $collection->setPageSize($pageSize);
	    $collection->setCurPage($page);
	    $this->logger->info("Here is Vendor collection: ".$collection->getSelect());
	    $this->logger->info("Here Vendor collection: Page:".$page." Page size :"
	        .$pageSize);
	    return $collection;
	}

	public function getBaseUrl()
	{
		return $this->_storeManager->getStore()->getBaseUrl();
	}
}
