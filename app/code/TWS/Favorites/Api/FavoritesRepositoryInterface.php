<?php
namespace TWS\Favorites\Api;

use TWS\Favorites\Api\Data\FavoritesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface FavoritesRepositoryInterface 
{
    public function save(FavoritesInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(FavoritesInterface $page);

    public function deleteById($id);
}
