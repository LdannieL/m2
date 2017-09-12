<?php
namespace Training4\VendorList\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    //protected $_view;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;  
       // $this->_view = $context->getView();      
        return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();  
        // $this->_view->loadLayout();
        // $this->_view->renderLayout();
    }
}
