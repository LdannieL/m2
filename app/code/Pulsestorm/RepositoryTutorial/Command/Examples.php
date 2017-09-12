<?php
namespace Pulsestorm\RepositoryTutorial\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Examples extends Command
{
    protected $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\State $appState,
        $name=null
    )
    {
        $this->objectManager = $objectManager;
        $appState->setAreaCode('frontend');
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName("ps:examples");
        $this->setDescription("A command the programmer was too lazy to enter a description for.");
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $output->writeln("Hello World");  
        
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');
        // $page = $repo->getById(3457);        
        // echo get_class($page),"\n";
        
        // $repo = $this->objectManager->get('Magento\Cms\Model\PageRepository');
        // $page = $repo->getById(3);
        // echo $page->getTitle(),"\n";
        // $page->setTitle($page->getTitle() . ', Edited by code!');
        // $repo->save($page);

        // //If you wanted to duplicate a page, you could load the page to duplicate,
        // // set its ID to NULL, and pass the duplicated object to the repository.
        // $repo = $this->objectManager->get('Magento\Cms\Model\PageRepository');
        // $page = $repo->getById(3);
        // $page->setId(null);
        // $page->setTitle('My Duplicated Page');
        // $repo->save($page);                
        // echo $page->getId(),"\n";


        // $repo = $this->objectManager->get('Magento\Cms\Model\PageRepository');
        // $page = $repo->getById(27);        
        // $repo->delete($page);
        // //or
        // //$repo->deleteById($page_id);
        
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');        
        // $search_criteria = $this->objectManager->create(
        //     'Magento\Framework\Api\SearchCriteriaInterface'
        // );
        // $result = $repo->getList($search_criteria);
        // $products = $result->getItems();
        // foreach($products as $product)
        // {
        //     echo $product->getSku(),"\n";
        // }
        
        // //create our filter
        // $filter = $this->objectManager->create('Magento\Framework\Api\Filter');
        // $filter->setData('field','sku');
        // $filter->setData('value','WM%');
        // $filter->setData('condition_type','like');

        // //add our filter(s) to a group
        // $filter_group = $this->objectManager->create('Magento\Framework\Api\Search\FilterGroup');
        // $filter_group->setData('filters', [$filter]);

        // //add the group(s) to the search criteria object
        // $search_criteria = $this->objectManager->create('Magento\Framework\Api\SearchCriteriaInterface');
        // $search_criteria->setFilterGroups([$filter_group]);

        // //query the repository for the object(s)
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');                        
        // $result = $repo->getList($search_criteria);
        // $products = $result->getItems();
        // foreach($products as $product)
        // {
        //     echo $product->getSku(),"\n";
        // }

        // //create our filter
        // $filter = $this->objectManager
        // ->create('Magento\Framework\Api\FilterBuilder')
        // ->setField('sku')
        // ->setConditionType('like')
        // ->setValue('WSH11%')
        // ->create();

        // //add our filter(s) to a group
        // $filter_group = $this->objectManager
        // ->create('Magento\Framework\Api\Search\FilterGroupBuilder')
        // ->addFilter($filter)
        // ->create();
        // // $filter_group->setData('filters', [$filter]);

        // //add the group(s) to the search criteria object
        // $search_criteria = $this->objectManager
        // ->create('Magento\Framework\Api\SearchCriteriaBuilder')
        // ->setFilterGroups([$filter_group])
        // ->create();

        // //query the repository for the object(s)
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');                        
        // $result = $repo->getList($search_criteria);
        // $products = $result->getItems();
        // foreach($products as $product)
        // {
        //     echo $product->getSku(),"\n";
        // }
        
        // // When working with the product repository, filters within a group are added as OR filters. For example, the following search criteria would return two products — WHERE sku LIKE 'WM%WHITE' OR sku = 'WM%BLACK'
        
        // //create our filter
        // $filter_1 = $this->objectManager
        // ->create('Magento\Framework\Api\FilterBuilder')
        // ->setField('sku')
        // ->setConditionType('like')
        // ->setValue('WM%WHITE')    
        // ->create();

        // $filter_2 = $this->objectManager
        // ->create('Magento\Framework\Api\FilterBuilder')
        // ->setField('sku')
        // ->setConditionType('like')
        // ->setValue('WM%BLACK')    
        // ->create();

        // //add our filter(s) to a group
        // $filter_group = $this->objectManager
        // ->create('Magento\Framework\Api\Search\FilterGroupBuilder')
        // ->addFilter($filter_1)
        // ->addFilter($filter_2)
        // ->create();
        // // $filter_group->setData('filters', [$filter]);

        // //add the group(s) to the search criteria object
        // $search_criteria = $this->objectManager
        // ->create('Magento\Framework\Api\SearchCriteriaBuilder')
        // ->setFilterGroups([$filter_group])
        // ->create();

        // //query the repository for the object(s)
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');                        
        // $result = $repo->getList($search_criteria);
        // $products = $result->getItems();
        // foreach($products as $product)
        // {
        //     echo $product->getSku(),"\n";
        // }


        // //Filter groups, on the other hand, are combined as AND filters (again, when working with product repositories). The following code would return no items, as WHERE sku LIKE 'WM%WHITE' AND sku = 'WM%BLACK' is impossible.
        
        // //create our filter
        // $filter_1 = $this->objectManager
        // ->create('Magento\Framework\Api\FilterBuilder')
        // ->setField('sku')
        // ->setConditionType('like')
        // ->setValue('WM%WHITE')    
        // ->create();

        // $filter_2 = $this->objectManager
        // ->create('Magento\Framework\Api\FilterBuilder')
        // ->setField('sku')
        // ->setConditionType('like')
        // ->setValue('WM%BLACK')    
        // ->create();

        // //add our filter(s) to a group
        // $filter_group_1 = $this->objectManager
        // ->create('Magento\Framework\Api\Search\FilterGroupBuilder')
        // ->addFilter($filter_1)
        // ->create();

        // $filter_group_2 = $this->objectManager
        // ->create('Magento\Framework\Api\Search\FilterGroupBuilder')
        // ->addFilter($filter_2)
        // ->create();        
        // // $filter_group->setData('filters', [$filter]);

        // //add the group(s) to the search criteria object
        // $search_criteria = $this->objectManager
        // ->create('Magento\Framework\Api\SearchCriteriaBuilder')
        // ->setFilterGroups([$filter_group_1, $filter_group_2])
        // ->create();

        // //query the repository for the object(s)
        // $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');                        
        // $result = $repo->getList($search_criteria);
        // $products = $result->getItems();
        // foreach($products as $product)
        // {
        //     echo $product->getSku(),"\n";
        // }

        // When working with non-complicated queries, the search criteria builder has short cut methods for adding “single-filter” filter groups. For example, the following code will create a search criteria object, with a single filter group, and that single filter group will contain a sku LIKE 'WM%BLACK' filter
        // This is convenient for creating a series of simple AND filters.
        $search_criteria = $this->objectManager
        ->create('Magento\Framework\Api\SearchCriteriaBuilder')
        ->addFilter('sku','WM16%', 'like')
        ->addFilter('sku','WM16%RCYCLNG', 'like') //additional addFilters will 
                                                     //add another group
        ->create();  

        //query the repository for the object(s)
        $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');                        
        $result = $repo->getList($search_criteria);
        $products = $result->getItems();
        foreach($products as $product)
        {
            echo $product->getSku(),"\n";
        }
    }
} 
