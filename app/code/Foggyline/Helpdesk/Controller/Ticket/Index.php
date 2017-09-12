<?php

namespace Foggyline\Helpdesk\Controller\Ticket;

class Index extends \Foggyline\Helpdesk\Controller\Ticket
{
    public function execute()
    {

        $this->_view->loadLayout();
//        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Billing Agreements'));
        $this->_view->renderLayout();

//
//        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
//        return $resultPage;
    }
}
