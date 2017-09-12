<?php
namespace TWS\Favorites\Block;

use TWS\Favorites\Model\FavoritesRepository;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

class FavoritesList extends ListProduct
{

    // public function getCustomerId()
    // {
    // 	return $this->customerSession->getCustomer()->getId();
    // }

    // public function getFavoriteIdsJson()
    // {
    // 	$customerId = $this->getCustomerId();
    //     $favorites = $this->favoritesRepository->getFavoriteIdsJson($customerId);

    //     return $favorites;
    // }

    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }

    public function setProductCollection(AbstractCollection $collection)
    {
        $this->_productCollection = $collection;
    }
}
