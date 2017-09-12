<?php
namespace Training5\VendorRepository\Api;

use Training5\VendorRepository\Api\Data\VendorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorRepositoryInterface 
{
    public function save(VendorInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(VendorInterface $page);

    public function deleteById($id);
}
