<?php
namespace Training2\Specific404Page\Controller;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\App\RequestInterface as Request;
use Magento\Framework\Controller\Result\RedirectFactory;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
	/**
     * @param Request $request
     * @return bool
     */
    public function process(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $parts = explode('/', trim($pathInfo, '/'));

        $moduleName = isset($parts[0]) ? $parts[0] : '';
        $actionPath = isset($parts[1]) ? $parts[1] : '';
        $actionName = isset($parts[2]) ? $parts[2] : '';

        if ($moduleName == 'catalog' && $actionPath == 'product' && $actionName == 'view') {
            $request->setModuleName('notfoundpage')
                    ->setControllerName('noroute')
                    ->setActionName('product');
        } elseif ($moduleName == 'catalog' && $actionPath == 'category' && $actionName == 'view') {
            $request->setModuleName('notfoundpage')
                    ->setControllerName('noroute')
                    ->setActionName('category');        	
        } else {
            $request->setModuleName('notfoundpage')
                ->setControllerName('noroute')
                ->setActionName('other');
        }
        return false;
    }
//     private $request;
//     private $pageFactory;
//     private $redirectFactory;

//     public function __constructor(RequestInterface $request, PageFactory $pageFactory, RedirectFactory $redirectFactory)
//     {
//         $this->request = $request;
//         $this->pageFactory = $pageFactory;
//         $this->redirectFactory = $redirectFactory;    
//     }
// //
// //	private function setUrl($moduleName, $controllerName, $actionName)
// //	{
// //        $this->request
// //			->setModuleName($moduleName)
// //			->setControllerName($controllerName)
// //			->setActionName($actionName);
// //	}

//     private function isUrl($moduleName, $controllerName, $actionName) {
//         if ($this->request->getModuleName() == $moduleName
//                 && $this->request->getControllerName() ==  $controllerName
//                 && $this->request->getActionName() == $actionName) {
//             return true;
//         }
//         return false;
//     }

//     private function getRedirectResult($path)
//     {
//         $redirect = $this->redirectFactory->create();
//         $redirect->setPath($path);
//         return $redirect;
//     }

// 	public function process(RequestInterface $request)
// 	{
// 		// A not-found product (catalog/product/view/id/_ID_)
// 		// A category (catalog/category/view/id/_ID_)
// 		// Another page
// 		//$pages = array('product' => array('moduleName' , );
		
//         if ($request->getModuleName() == 'catalog'
//                 && $request->getControllerName() ==  'product'
//                 && $request->getActionName() == 'view') {
//             return $this->getRedirectResult('/product-not-found');
//         }

// 		// if($this->isUrl('catalog', 'product', 'view')){
// 		// 	$this->getRedirectResult('/product-not-found');
// 		// }
// 		// if($this->isUrl('catalog', 'product', 'view')){
// 		// 	$this->getRedirectResult('/product-not-found');
// 		// }

//         // if($this->isUrl('catalog', 'category', 'view')){
//         //     $this->getRedirectResult('/category-not-found');
//         // }
// //		foreach($array as $key => $value){
// //		    switch($value){
// //		        case 'something':
// //		              echo 'then do this';
// //		              break;
// //		        default:
// //		              echo 'else do something else';
// //		    }
// //		}
// //
// //		switch ($this->isUrl($moduleName, $controllerName, $actionName)) {
// //		    case "red":
// //		        echo "Your favorite color is red!";
// //		        break;
// //		    case "blue":
// //		        echo "Your favorite color is blue!";
// //		        break;
// //		    case "green":
// //		        echo "Your favorite color is green!";
// //		        break;
// //		    default:
// //		        echo "Your favorite color is neither red, blue, nor green!";
// //		}
// //		if ($request->getModuleName() == '') {
// //
// //		}
// //		$moduleName = 'cms';
// //		$controllerName = 'index';
// //		$actionName = 'index';
// //		$request
// //			->setModuleName($moduleName)
// //			->setControllerName($controllerName)
// //			->setActionName($actionName);
// 		// return true;
// 	}
}