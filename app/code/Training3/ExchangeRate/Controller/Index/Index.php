<?php
namespace Training3\ExchangeRate\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $exchangeRate;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Training3\ExchangeRate\Model\ExchangeRate $exchangeRate)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->exchangeRate = $exchangeRate;       
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $exchangeRate = $this->exchangeRate->getExchangeRate();
        // echo '123';
        $block = $this->_view->getLayout()
            ->createBlock('Magento\Framework\View\Element\Text');
        $block->setText("Today's USD - EUR exchange rate is $exchangeRate");
        $this->getResponse()->appendBody($block->toHtml());
        // return $this->resultPageFactory->create();  
    }
}
