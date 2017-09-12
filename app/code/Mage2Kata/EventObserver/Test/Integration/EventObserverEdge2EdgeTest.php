<?php

namespace Mage2Kata\EventObserver\Test\Integration;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use Magento\TestFramework\ObjectManager;

class EventObserverEdge2EdgeTest extends \PHPUnit_Framework_TestCase
{
    private function dispatchEvent($event, array $eventData)
    {
        /** @var EventManager $eventManager */
        $eventManager = ObjectManager::getInstance()->create(EventManager::class);
        $eventManager->dispatch($event, $eventData);
    }

    public function testCopiesCustomAttributeFromProductToQuoteItem()
    {
        $quoteItem = ObjectManager::getInstance()->create(QuoteItem::class);
        $product = ObjectManager::getInstance()->create(Product::class);
        $product->setCustomAttribute('magento_se_points', 500);

        $this->dispatchEvent(
            'checkout_cart_product_add_after',
            ['quote_item' => $quoteItem, 'product' => $product]
        );

        $this->assertSame(500, $quoteItem->getData('magento_se_points'));
    }
}
