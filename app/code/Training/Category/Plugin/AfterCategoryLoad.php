<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\Category\Plugin;

class AfterCategoryLoad
{

    /**
     * @var \Magento\Catalog\Api\Data\CategoryExtensionFactory
     */
    protected $categoryExtensionFactory;
    protected $setup;

    /**
     * @param \Magento\Catalog\Api\Data\CategoryExtensionFactory $categoryExtensionFactory
     */
    public function __construct(
        \Magento\Catalog\Api\Data\CategoryExtensionFactory $categoryExtensionFactory,
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup
    ) {
        $this->categoryExtensionFactory = $categoryExtensionFactory;
        $this->setup = $setup;
    }

    /**
     * Add countries information to the categorie's extension attributes
     *
     * @param \Magento\Catalog\Model\Category $category
     * @return \Magento\Catalog\Model\Category
     */
    public function afterLoad(\Magento\Catalog\Model\Category $category)
    {
        $categoryExtension = $category->getExtensionAttributes();
        if ($categoryExtension === null) {
            $categoryExtension = $this->categoryExtensionFactory->create();
        }
        
        $select = $this->setup->getConnection()->select()->from('training_category_country')->where('category_id=?', $category->getId());
        $data = $this->setup->getConnection()->fetchAll($select);
        $countries = array();
        if (is_array($data)) {
            foreach ($data as $country) {
                $countries[] = $country['country'];
            }
        }
        
        $categoryExtension->setCountries($countries);
        $category->setExtensionAttributes($categoryExtension);
        return $category;
    }
}
