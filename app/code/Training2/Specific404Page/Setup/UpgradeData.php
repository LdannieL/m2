<?php
namespace Training2\Specific404Page\Setup;
 
use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;
 
    /**
     * Construct
     *
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
    }
 
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Product Not Found page')
                ->setIdentifier('product-not-found')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('This product is not found.')
                ->save();
        }
        
        if (version_compare($context->getVersion(), '0.0.3') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Category Not Found page')
                ->setIdentifier('category-not-found')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('This category is not found.')
                ->save();
        }

        if (version_compare($context->getVersion(), '0.0.4') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Altenative Not Found page')
                ->setIdentifier('altenative-not-found')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('This page is not found.')
                ->save();
        }
 
        $setup->endSetup();
    }
}