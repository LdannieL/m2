<?php

namespace Training\Orm\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogAttribute;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\Source\Table as TableSourceModel;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Store\Model\StoreManagerInterface as StoreManager;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;

    private $customerSetupFactory;
    private $storeManager;


    public function __construct(CategorySetupFactory $categorySetupFactory,
        CustomerSetupFactory $customerSetupFactory,
        StoreManager $storeManager
    ){
        $this->catalogSetupFactory = $categorySetupFactory;

        $this->customerSetupFactory = $customerSetupFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $dbVersion = $context->getVersion();

        if (version_compare($dbVersion, '0.0.2', '<')) {
            /** @var CategorySetup $catalogSetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
            $catalogSetup->addAttribute(Product::ENTITY, 'example_multiselect', [
                'label' => 'Example Multiselect',
                'visible_on_front' => 1,
                'required' => 0,     
                'type'             => 'varchar',
                'input'            => 'multiselect',
                'source'           => TableSourceModel::class,
                'backend'          => ArrayBackend::class,
                'user_defined'     => true,
                'global'           => CatalogAttribute::SCOPE_STORE,
                'visible_on_front' => true,
                'group'            => 'Product Details',
                'option' => [
                    'values' => [
                        1 => 'Option 1',
                        2 => 'Option 2',
                        3 => 'Option 3',
                        4 => 'Option 4',
                        5 => 'Option 5',
                        6 => 'Option 6',
                        7 => 'Option 7',
                        8 => 'Option 8',
                        9 => 'Option 9',
                    ]
                ],
            ]);
        } 
        if (version_compare($dbVersion, '0.0.3', '<')) {
            /** @var CategorySetup $catalogSetup */
            $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
            $catalogSetup->updateAttribute(
                Product::ENTITY,  
                'example_multiselect',
                [
                    'frontend_model' =>
                         \Training\Orm\Entity\Attribute\Frontend\HtmlList::class,
                    'is_html_allowed_on_front' => 1,
                ]
            );
        }
        if (version_compare($dbVersion, '0.0.4', '<')) {
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $customerSetup->addAttribute(
                Customer::ENTITY,
                'priority',
                [
                    'label' => 'Priority',
                    'type' => 'int',
                    'input' => 'select',
                    'source' => \Training\Orm\Entity\Attribute\Source\CustomerPriority::class,
                    'required' => 0,
                    'system' => 0,
                    'position' => 100
                ] 
            );
            $customerSetup->getEavConfig()->getAttribute('customer', 'priority')
                ->setData('used_in_forms', ['adminhtml_customer'])
                ->save();
        }
    }
}
