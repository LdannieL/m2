<?php
namespace Pulsestorm\Pestleform\Controller\Adminhtml\Thing;

class Index extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }  

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pulsestorm_Pestleform::things');
    }       
}
