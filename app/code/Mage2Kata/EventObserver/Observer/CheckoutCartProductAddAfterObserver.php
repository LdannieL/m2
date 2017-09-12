<?php

namespace Mage2Kata\EventObserver\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer as Event;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item as QuoteItem;

class CheckoutCartProductAddAfterObserver implements ObserverInterface
{
    public function execute(Event $event)
    {
        /** @var Product $product */
        $product = $event->getData('product');
        /** @var QuoteItem $quoteItem */
        $quoteItem = $event->getData('quote_item');

        $points = $product->getCustomAttribute('magento_se_points');
        if(isset($points)) {
        	 $quoteItem->setData('magento_se_points', $points->getValue());
        }
       
    }
}
