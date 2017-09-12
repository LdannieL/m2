<?php 

namespace Training\Repository\Controller\Repository;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\Api\FilterBuilder;

use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProduct;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrderBuilder;

use Magento\Framework\Api\SortOrder;

class Product extends Action
{
    /**
     * @var ProductRepositoryInterface
     */  
    private $productRepository;

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
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        //Add a filter so the result list contains only configurable products
        FilterBuilder $filterBuilder,
        SearchCriteriaInterface $searchCriteriaInterface,
        SortOrderBuilder $sortOrderBuilder
    ) {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }


    public function execute()
    {
        $this->getResponse()->setHeader('Content-Type', 'text/plain');

        $products = $this->getProductsFromRepository();

        foreach ($products as $product) {
            $this->outputProduct($product);
        }

    }

    /**
     * @return ProductInterface[]
     */
    private function getProductsFromRepository()
    {
        //To filter only configurable
        $this->setProductTypeFilter();

        $this->setProductNameFilter();
        $this->setProductOrder();
        $this->setProductPaging();

        $criteria = $this->searchCriteriaBuilder->create();
        $products = $this->productRepository->getList($criteria);
        return $products->getItems();
    }

    private function setProductTypeFilter()
    {
        $configProductFilter = $this->filterBuilder
            ->setField('type_id')
            ->setValue(ConfigurableProduct::TYPE_CODE)
            ->setConditionType('eq')
            ->create();
        $this->searchCriteriaBuilder->addFilters([$configProductFilter]);
    }

    private function outputProduct(ProductInterface $product)
    {
        $this->getResponse()->appendBody(sprintf(
                "%s - %s (%d)\n",
                $product->getName(),
                $product->getSku(),
                $product->getId())
        );
    }

    private function setProductNameFilter()
    {
        $nameFilter = $this->filterBuilder
            ->setField('name')
            ->setValue('M%')
            ->setConditionType('like')
            ->create(); 
    
        $this->searchCriteriaBuilder->addFilters([$nameFilter]);
    }

    private function setProductOrder() 
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('entity_id')
            // ->setDirection(SearchCriteriaInterface::SORT_ASC)
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder); 
    }

    private function setProductPaging() 
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField('entity_id')
            // ->setDirection(SearchCriteriaInterface::SORT_ASC)
            ->setDirection(SortOrder::SORT_ASC)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->setPageSize(6);
        $this->searchCriteriaBuilder->setCurrentPage(1);
    }

}
