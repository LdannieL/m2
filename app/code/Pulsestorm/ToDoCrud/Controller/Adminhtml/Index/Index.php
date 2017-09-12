<?php
namespace Pulsestorm\ToDoCrud\Controller\Adminhtml\Index;
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
        return $this->resultPageFactory->create();  
        // $page = $this->resultPageFactory->create();  
        // $page->setActiveMenu('Pulsestorm_ToDoCrud::pulsestorm_admin_todocrud_menu');
        // $page->getConfig()->getTitle()->prepend(__('Our Custom Title'));
        // return $page;  
    }    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pulsestorm_ToDoCrud::menu_1');
    }            
        
}
