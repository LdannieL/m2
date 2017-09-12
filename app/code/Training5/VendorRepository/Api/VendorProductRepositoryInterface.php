<?php
namespace Training5\VendorRepository\Api;

use Training5\VendorRepository\Api\Data\VendorProductInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorProductRepositoryInterface 
{
    public function save(VendorProductInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(VendorProductInterface $page);

    public function deleteById($id);
}
