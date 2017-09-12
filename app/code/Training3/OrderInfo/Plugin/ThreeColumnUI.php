<?php
namespace Training3\OrderInfo\Plugin;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Request\Http as Request;


class ThreeColumnUI
{
	protected $resultPageFactory;
    protected $request;
    protected $_coreRegistry;
    protected $_view;

    public function __construct(
        Context $context,
        Request $request,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
        )
    {
        $this->resultPageFactory = $resultPageFactory; 
        $this->request = $request;
        $this->_coreRegistry = $coreRegistry;
        $this->_view = $context->getView();
    }

    //function beforeMETHOD($subject, $arg1, $arg2){}
    //function aroundMETHOD($subject, $procede, $arg1, $arg2){return $proceed($arg1, $arg2);}
    public function afterExecute($subject, $result)
    {
    	$resultType = $this->request->getParam('json');
    	if (isset($resultType) && $resultType !== 1) {
            $this->_coreRegistry->register('result', $result);
    		// return $this->resultPageFactory->create();  
            $this->_view->loadLayout();
            $this->_view->renderLayout();
    	} else {
    		return $result;
    	}
    	// return $result;
    }
}
