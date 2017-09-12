<?php 

namespace Training5\VendorRepository\Controller\Repository;

use Training5\VendorRepository\Api\Data\VendorInterface;
use Training5\VendorRepository\Api\VendorRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\Api\FilterBuilder;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrderBuilder;

use Magento\Framework\Api\SortOrder;

class Vendor extends Action
{
    /**
     * @var ProductRepositoryInterface
     */  
    private $vendorRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteriaInterface;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    public function __construct(
        Context $context,
        VendorRepositoryInterface $vendorRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        //Add a filter so the result list contains only configurable products
        FilterBuilder $filterBuilder,
        SearchCriteriaInterface $searchCriteriaInterface,
        SortOrderBuilder $sortOrderBuilder
    ) {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }


    public function execute()
    {
        $this->getResponse()->setHeader('Content-Type', 'text/plain');

        $vendors = $this->getVendorsFromRepository();

        foreach ($vendors as $vendor) {
            $this->outputVendor($vendor);
        }

    }

    /**
     * @return VendorInterface[]
     */
    private function getVendorsFromRepository()
    {
        $this->setVendorNameFilter();
        //$this->setVendorOrder();
        $this->setVendorPaging();

        $criteria = $this->searchCriteriaBuilder->create();
        $vendors = $this->vendorRepository->getList($criteria);
        return $vendors->getItems();
    }

    private function outputVendor(VendorInterface $vendor)
    {
        $this->getResponse()->appendBody(sprintf(
                "%s (%d)\n",
                $vendor->getName(),
                $vendor->getId())
        );
    }

    private function setVendorNameFilter()
    {
        $nameFilter = $this->filterBuilder
            ->setField('name')
            ->setValue('M%')
            ->setConditionType('like')
            ->create(); 
    
        $this->searchCriteriaBuilder->addFilters([$nameFilter]);
    }

    private function setVendorOrder() 
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('vendor_id')
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder); 
    }

    private function setVendorPaging() 
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('vendor_id')
            ->setDirection(SortOrder::SORT_DESC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->setPageSize(3);
        $this->searchCriteriaBuilder->setCurrentPage(1);
    }

}
