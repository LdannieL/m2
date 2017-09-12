<?php
namespace Westum\Cms\Setup;
 
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
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
 
        if (version_compare($context->getVersion(), '1.1') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Example CMS page')
                ->setIdentifier('example-cms-page')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->save();
        }

        // $cmsBlock = $this->_blockFactory->create();
        // $cmsBlock->setIdentifier('order_by_phone')
        //         ->setData('stores', array($storeWg))
        //         ->setTitle('Order by phone')
        //         ->setContent('<div class="welcome-msg">
        //                         <div style="clear: both;">Order By Phone! <span class="skype_c2c_container" dir="ltr"><span>1-800-346-4420</span></div>
        //                     </div>')
        //         ->setIsActive(true)
        //         ->save();
 
        $setup->endSetup();
    }
}