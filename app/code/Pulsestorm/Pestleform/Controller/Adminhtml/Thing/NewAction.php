<?php
namespace Pulsestorm\Pestleform\Controller\Adminhtml\Thing;

class NewAction extends \Magento\Backend\App\Action
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
    }    
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pulsestorm_Pestleform::things');
    }           
}
