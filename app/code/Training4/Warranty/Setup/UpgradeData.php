<?php
namespace Training4\Warranty\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogAttribute;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
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
            //Without this renders leaving html tags
            $catalogSetup->updateAttribute(Product::ENTITY, 'warranty', [
                    'is_html_allowed_on_front' => 1
            ]);
        } 
    }
}
