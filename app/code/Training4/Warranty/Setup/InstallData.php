<?php
namespace Training4\Warranty\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogAttribute;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    private $catalogSetupFactory;

    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->catalogSetupFactory = $categorySetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) 
    {
        /** @var CategorySetup $catalogSetup */
        $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);
        $catalogSetup->addAttribute(Product::ENTITY, 'warranty', [
            'label' => 'Warranty',
            'visible_on_front' => 1,
            'required' => 0,     
            'type'             => 'varchar',
            'input'            => 'text',
            'backend' => \Training4\Warranty\Entity\Attribute\Backend\AddYear::class,
            'frontend_model' => \Training4\Warranty\Entity\Attribute\Frontend\RenderBold::class,
            'global'           => CatalogAttribute::SCOPE_STORE,
            'group'            => 'Product Details'
            ]);
    }
}
