<?php 
namespace Pulsestorm\HelloAdminBackend\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $page = $this->resultPageFactory->create();  
        $page->setActiveMenu('Pulsestorm_HelloAdminBackend::a_menu_item');
        $page->getConfig()->getTitle()->prepend(__('Our Custom Title'));
        return $page;  
    }    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pulsestorm_HelloAdminBackend::menu_1');
    }            
        
}
