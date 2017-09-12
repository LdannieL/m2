<?php
namespace Training4\Vendor\Api;

use Training4\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorRepositoryInterface 
{
    public function save(VendorInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(VendorInterface $page);

    public function deleteById($id);
}
