<?php

namespace Mage2Kata\EventObserver\Test\Integration;

use Mage2Kata\EventObserver\Observer\CheckoutCartProductAddAfterObserver;
use Magento\Framework\Event\ConfigInterface as EventObserverConfig;
use Magento\TestFramework\ObjectManager;

class EventObserverConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckoutCartProductAddAfterEventObserverIsConfigured()
    {
        /** @var EventObserverConfig $observerConfig */
        $observerConfig = ObjectManager::getInstance()->create(EventObserverConfig::class);
        $observers = $observerConfig->getObservers('checkout_cart_product_add_after');
        $this->assertArrayHasKey('mage2kata_eventobserver', $observers);
        $this->assertSame(
            ltrim(CheckoutCartProductAddAfterObserver::class, '\\'),
            $observers['mage2kata_eventobserver']['instance']
        );
    }
}
