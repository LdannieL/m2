<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ProductSeries\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    protected $eavSetup;

    public function __construct(\Magento\Eav\Setup\EavSetup $eavSetup) {
        $this->eavSetup = $eavSetup;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $entityTypeId     = $this->eavSetup->getEntityTypeId('catalog_product');
        $attributeSetId   = $this->eavSetup->getAttributeSetId($entityTypeId, 'Bag');
        $attributeGroupId = $this->eavSetup->getAttributeGroupId($entityTypeId, $attributeSetId, 'Product Details');
        $attributeCode = 'product_series';
        $properties    = array(
            'type'   => 'varchar',
            'label'  => 'Product Series',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'user_defined'=> 1,
            'required' => 0,
            'visible_on_front'      => 1,
            'is_used_in_grid'       => 1,
            'is_visible_in_grid'    => 1,
            'is_filterable_in_grid' => 1
            
        );

        $this->eavSetup->addAttribute($entityTypeId, $attributeCode, $properties);
        $this->eavSetup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, $attributeCode);
    }
}
