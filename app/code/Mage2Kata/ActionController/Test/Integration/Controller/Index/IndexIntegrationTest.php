<?php
 
namespace Mage2Kata\ActionController\Controller\Index;
 
use Magento\TestFramework\Request;
use Magento\TestFramework\TestCase\AbstractController as ControllerTestCase;
 
class IndexIntegrationTest extends ControllerTestCase
{
	// public function testNothing()
	// {
	//    $this->fail('123');
	// }
	
    public function testCanHandleGetRequests()
    {
        $this->getRequest()->setMethod(Request::METHOD_GET);
        $this->dispatch('mage2kata/index/index');
        $this->assertSame(200, $this->getResponse()->getHttpResponseCode());
        // $this->assertContains('<body ', $this->getResponse()->getBody());
        $this->assertRegExp('#<body [^>]+>#s', $this->getResponse()->getBody());
    }

    public function testCanNotHandlePostRequests()
    {
        $this->getRequest()->setMethod(Request::METHOD_POST);
        $this->dispatch('mage2kata/index/index');

        $this->assertSame(404, $this->getResponse()->getHttpResponseCode());
        $this->assert404NotFound();
    }
}