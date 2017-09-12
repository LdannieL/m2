<?php

namespace Mage2Kata\ActionController\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory as ForwardResultFactory;
use Magento\Framework\View\Result\PageFactory as PageResultFactory;

class Index extends Action
{
    /**
     * @var PageResultFactory
     */
    private $pageFactory;

    /**
     * @var ForwardResultFactory
     */
    private $forwardFactory;

    public function __construct(Context $context, PageResultFactory $pageFactory, ForwardResultFactory $forwardFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory; //sufficient for 1st test to pass
        $this->forwardFactory = $forwardFactory;
    }

    // Fails before noroute created
    // public function execute()
    // {
    //     if ($this->getRequest()->getMethod() === 'GET') {
    //     		return $this->pageFactory->create(); //sufficient for 1st test to pass
    //     } else {
    //     		$forward = $this->forwardFactory->create();
    //     		
    // //  		 //to pass:
    // //        $forward->forward('noroute');
    // //        return $forward;
    //     }
    // }

    // Passes like this
    // public function execute()
    // {
    //     if ($this->getRequest()->getMethod() === 'POST') {
    //         $forward = $this->forwardFactory->create();
    //         $forward->forward('noroute');
    //         return $forward;
    //     }
    //     return $this->pageFactory->create(); //sufficient for 1st test to pass
    // }
 
    // Refactored version
    public function execute()
    {
        return $this->isPostRequest() ?
            $this->handlePostRequest() :
            $this->handleGetRequest();
    }
 
    /**
     * @return bool
     */
    private function isPostRequest()
    {
        return $this->getRequest()->getMethod() === 'POST';
    }
 
    /**
     * @return \Magento\Framework\App\Request\Http
     */
    public function getRequest()
    {
        return parent::getRequest();
    }
 
    /**
     * @return \Magento\Framework\Controller\Result\Forward
     */
    private function handlePostRequest()
    {
        $forward = $this->forwardFactory->create();
        $forward->forward('noroute');
        return $forward;
    }
 
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    private function handleGetRequest()
    {
        return $this->pageFactory->create();
    }
}