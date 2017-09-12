<?php
namespace Training2\OrderController\Controller\Index;

use Magento\Framework\App\Action\Context;
// use Magento\Framework\App\RequestInterface as Request;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\Controller\Result\JsonFactory;
// use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderFactory;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    // protected $resultPageFactory;
    protected $request;
    protected $resultJsonFactory;
    private $orderFactory;
    private $order;
private $jsonHelper;
private $resultPageFactory;
    public function __construct(
        Context $context,
        // Http $request,
        Request $request,
        // \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        // Order $order,
        OrderFactory $orderFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\View\Result\PageFactory $resultFactory)
    {
        // $this->resultPageFactory = $resultPageFactory; 
        // $this->result = $result; 
        $this->request = $request; 
        $this->resultJsonFactory = $resultJsonFactory;
        // $this->order = $order;
        $this->orderFactory = $orderFactory;
        $this->jsonHelper = $jsonHelper;
        $this->resultFactory = $resultFactory;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $orderId = $this->request->getParam('order_id');
        //$orderId = 2;
        $order = $this->orderFactory->create()->load($orderId);
//        $order = $this->order->load($orderId);
        $orderData = array();
        $orderData['status'] = $order->getStatus();
        $orderData['grand_total'] = $order->getGrandTotal();
        $orderData['total_invoiced'] = $order->getTotalInvoiced();
        $items = $order->getAllItems();

        // Iterate through all of the items in the order
        foreach ($items as $item) {
            // Get sku, item_id and price
            $orderData['order_items'][] = [
                'sku' => $item->getSku(),
                'item_id' => $item->getId(),
                'price' => $item->getPrice(),
            ];

        }
// var_dump($orderData);exit;
        try
        {
            if ($orderData) {
                $message = $orderData;
            }
        }
        catch(\Exception $e)
        {
            $message = $e;
        } 
                    // /** @var \Magento\Framework\View\Result\Page $resultPage */
                    // $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

                    // /** @var \Magento\Framework\Controller\Result\Raw $response */
                    // $response = $this->resultFactory->create(ResultFactory::TYPE_RAW);
                    // $response->setHeader('Content-type', 'text/plain');
                    // $response->setContents(
                    //     $this->jsonHelper->jsonEncode(
                    //         $message
                    //     )
                    // );
                    // return $response;
                    // $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                    // $resultJson->setData($orderData);
                    // return $resultJson;
        // return $this->resultJsonFactory->create()->setData(['Test-Message' => $message]);
        return $this->resultJsonFactory->create()->setData($message);
    }

}
