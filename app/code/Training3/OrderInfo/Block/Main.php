<?php
namespace Training3\OrderInfo\Block;

use \Magento\Framework\App\Request\Http as Request;

class Main extends \Magento\Framework\View\Element\Template
{
	protected $orderFactory;
    protected $_coreRegistry;

	public function __construct(
	    \Magento\Framework\View\Element\Template\Context $context,
	    \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\Registry $coreRegistry,
        array $data = [],
        Request $request
	)
	{
	    $this->orderFactory = $orderFactory;
        $this->request = $request;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
	    // parent::__construct($context);
	}
//     public function _prepareLayout()
//     {
//     	$orderId = $this->request->getParam('order_id');
//         //$orderId = 2;
//         $order = $this->orderFactory->create()->load($orderId);
// //        $order = $this->order->load($orderId);
//         $orderData = array();
//         $orderData['status'] = $order->getStatus();
//         $orderData['grand_total'] = $order->getGrandTotal();
//         $orderData['total_invoiced'] = $order->getTotalInvoiced();
//         $items = $order->getAllItems();

//         // Iterate through all of the items in the order
//         foreach ($items as $item) {
//             // Get sku, item_id and price
//             $orderData['order_items'] = [
//                 'sku' => $item->getSku(),
//                 'item_id' => $item->getId(),
//                 'price' => $item->getPrice(),
//             ];

//         }

//     }


    public function getResult()
    {
        return $this->_coreRegistry->registry('result');
    }

    public function getOrderData()
    {
        $orderId = $this->request->getParam('order_id');
        // $orderId = 2;
        $order = $this->orderFactory->create()->load($orderId);
//        $order = $this->order->load($orderId);
        $orderData = array();
        $orderData['status'] = $order->getStatus();
        $orderData['grand_total'] = $order->getGrandTotal();
        $orderData['total_invoiced'] = $order->getTotalInvoiced();
        $items = $order->getAllItems();    
        $orderData['no_items_ordered'] = count($items);

        // Iterate through all of the items in the order
        foreach ($items as $item) {
            // Get sku, item_id and price
            $orderData['order_items'][] = [
                'sku' => $item->getSku(),
                'item_id' => $item->getId(),
                'price' => $item->getPrice(),
            ];

        }
        return $orderData;
        // will return 'bar'
        // return $this->_coreRegistry->registry('result');
    }
}
