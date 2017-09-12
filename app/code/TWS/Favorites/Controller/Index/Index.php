<?php
namespace TWS\Favorites\Controller\Index;

// use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    private $customerSession;
    protected $_storeManager;
    
    /** @var  \Magento\Catalog\Model\ResourceModel\Product\Collection */
    protected $productCollection;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
        )

    {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->_storeManager = $storeManager;
        $this->productCollection = $collectionFactory->create();
    }
    
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('customer/account/login');
        if (!$this->customerSession->isLoggedIn()) return $resultRedirect;

        //return $this->resultPageFactory->create();
        $result = $this->resultPageFactory->create();

        $customerId = $this->customerSession->getCustomer()->getId();
        $storeId = $this->_storeManager->getStore()->getId();

        // obtain product collection.
        // $this->productCollection->addIdFilter(5); // do some filtering
        // $this->productCollection->addFieldToSelect('*');
        $this->productCollection->getSelect()
            ->join(array('favorites' => 'tws_favorites_favorites'), 'entity_id = favorites.product_id',
                array('customer_id' => 'favorites.customer_id',
                    'product_id' => 'favorites.product_id',
                    'store_id' => 'favorites.store_id'
                )
            );
 
        $this->productCollection->getSelect()
                                ->where('favorites.customer_id='. $customerId)
                                ->where('favorites.store_id='. $storeId);
        $this->productCollection->addFieldToSelect('*');

        // get the custom list block and add our collection to it
        /** @var CustomList $list */
        $list = $result->getLayout()->getBlock('favorite.products.list');
        $list->setProductCollection($this->productCollection);

        return $result;  
    }
}
        // $resource = Mage::getSingleton('core/resource');
        // $customerId = Mage::getSingleton('customer/session')->getId();
        // $storeId = Mage::app()->getStore()->getId();

        // $collection = Mage::getModel('catalog/product')->getCollection();
        // $collection->addAttributeToSelect('*');
        // $collection->getSelect()
        //               ->joinLeft(
        //                   array('favorites' => $resource->getTableName('westum_favorites/favorites')),
        //                  'favorites.product_id = e.entity_id',
        //                   array('product_id', 'customer_id', 'store_id' )
        //                   );
        // $collection->getSelect()->where('favorites.customer_id='. $customerId)->where('favorites.store_id='. $storeId);

        // Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        // Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        // return $collection;