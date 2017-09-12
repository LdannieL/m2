<?php
namespace TWS\Favorites\Model;
class Favorites extends \Magento\Framework\Model\AbstractModel implements \TWS\Favorites\Api\Data\FavoritesInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'tws_favorites_favorites';

    protected function _construct()
    {
        $this->_init('TWS\Favorites\Model\ResourceModel\Favorites');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
