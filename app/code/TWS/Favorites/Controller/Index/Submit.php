<?php
namespace TWS\Favorites\Controller\Index;

// use Magento\Customer\Model\Session;
//use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use TWS\Favorites\Model\FavoritesRepository;
// use TWS\Favorites\Model\Favorites;

class Submit extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    private $customerSession;
    protected $_storeManager;
    
    /** @var  \Magento\Catalog\Model\ResourceModel\Product\Collection */
    protected $productCollection;
    private $request;
    private $productFactory;
    private $favoritesRepository;
    private $date;
    private $favoritesFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        // Request $request,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \TWS\Favorites\Model\FavoritesFactory $favoritesFactory,
        FavoritesRepository $favoritesRepository,
        DateTime $date
        )

    {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->_storeManager = $storeManager;
        $this->productCollection = $collectionFactory->create();
        $this->request = $request;
        $this->productFactory = $productFactory;
        $this->favoritesFactory = $favoritesFactory;
        $this->favoritesRepository = $favoritesRepository;
        $this->date = $date;
    }
    
    public function execute()
    {
        $productId = $this->request->getParam('product');
        $customerId = $this->customerSession->getCustomer()->getId();
        $storeId = $this->_storeManager->getStore()->getId();

        //echo $productId . " " . $customerId . " " . $storeId; exit;

        if (!$productId) {
            echo 'error';
            exit;
        }
        
        $product = $this->productFactory->create()->load($productId);
        if (!$product->getId() || !$product->isVisibleInCatalog()) {
            echo 'error';
            exit;
        }

        // $existFavorites = Mage::getResourceModel('westum_favorites/favorites_collection')->addFieldToFilter('customer_id', $customerId)->addFieldToFilter('product_id', $productId)->addFieldToFilter('store_id', $storeId)->getFirstItem();
        $existFavorites = $this->favoritesRepository->getFavoriteProductByCustomer($customerId, $storeId, $productId);
        try {
             if ($existFavorites->getId()) {
                $existFavorites->delete();
            } else {
                $data = array(
                        'customer_id'=> $customerId,
                        'product_id'=> $productId,
                        'store_id'=> $storeId,
                        'creation_time' => $this->date->gmtDate(),
                        'update_time' => $this->date->gmtDate(),
                        'is_active' => 1
                    ); 
                $newFavorite = $this->favoritesFactory->create();
                //$newFavorite = $this->_objectManager->create('TWS\Favorites\Model\Favorites');
                $newFavorite
                    ->setData($data);
                    // ->setProductId("$productId")
                    // ->setStoreId("$storeId")
                    // ->setCreationTime($this->date->gmtDate())
                    // ->setUpdateTime($this->date->gmtDate());
                    // ->save();
                $this->favoritesRepository->save($newFavorite);
                // $this->favoritesRepository
                //     ->setCustomerId($customerId)
                //     ->setProductId($productId)
                //     ->setStoreId($storeId)
                //     ->setCreationTime($this->date->gmtDate())
                //     ->setUpdateTime($this->date->gmtDate())
                //     ->save();
                
            }
            
            $favorites = $this->favoritesRepository->getFavoriteIdsJson($customerId);;
            echo $favorites;
            exit;
        } catch (Exception $e) {
            echo 'error';
            exit;
        }
    }
}
