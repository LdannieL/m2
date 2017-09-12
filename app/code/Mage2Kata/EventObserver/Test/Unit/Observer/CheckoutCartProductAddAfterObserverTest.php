<?php

namespace Mage2Kata\EventObserver\Observer;

use Magento\Framework\Api\AttributeInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as Event;
use Magento\Catalog\Model\Product;
use Magento\Quote\Model\Quote\Item as QuoteItem;

class CheckoutCartProductAddAfterObserverTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsTheEventObserverInterface()
    {
        $this->assertInstanceOf(
            ObserverInterface::class,
            new CheckoutCartProductAddAfterObserver()
        );
    }

    public function testSetsTheMagentoSEPointsOnTheQuoteItem()
    {
        $mockQuoteItem = $this->getMock(QuoteItem::class, [], [], '', false);
        $mockProduct = $this->getMock(Product::class, [], [], '', false);

        $mockAttribute = $this->getMock(AttributeInterface::class);
        $mockAttribute->method('getValue')->willReturn(123);
        $mockProduct->method('getCustomAttribute')->with('magento_se_points')->willReturn($mockAttribute);
            //lets have our test call the method we want to write
            $mockQuoteItem->expects($this->once())->method('setData')
                ->with('magento_se_points', 123);

        $mockEvent = $this->getMock(Event::class, [], [], '', false);
        $mockEvent->method('getData')->willReturnMap([
            ['product', null, $mockProduct],
            ['quote_item', null, $mockQuoteItem],
        ]);
            //add an assertion to our test
//            $observer = new CheckoutCartProductAddAfterObserver();
//            $observer->execute($mockEvent);
            (new CheckoutCartProductAddAfterObserver())->execute($mockEvent);
    }
}
