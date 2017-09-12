<?php

namespace Mage2Kata\ActionController\Controller\Index;

use Mage2Kata\ActionController\Model\Exception\RequiredParametersMissingException;
use Magento\Framework\App\Action\Context as ActionContext;
use Magento\Framework\Controller\Result\Raw as RawResult;
use Magento\Framework\Controller\Result\RawFactory as RawResultFactory;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\Result\RedirectFactory as RedirectResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request as HttpRequest;

class IndexTest extends \PHPUnit_Framework_TestCase
{
//    public function testNothing()
//    {
//        $this->assertSame(1, 1);
//    }

    /**
     * @var Index
     */
    private $controller;

    /**
     * @var RawResult|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockRawResult;

    /**
     * @var HttpRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockRequest;

    /**
     * @var UseCase|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockUseCase;

    /**
     * @var RedirectResult|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockRedirectResult;

    protected function setUp()
    {
        $this->mockRawResult = $this->getMock(RawResult::class, [], [], '', false);
        $this->mockRequest = $this->getMock(HttpRequest::class, [], [], '', false);
        $this->mockUseCase = $this->getMock(UseCase::class, ['doSomething'], [], '', false);
        $this->mockRedirectResult = $this->getMock(RedirectResult::class, [], [], '', false);

        $mockRawResultFactory = $this->getMock(RawResultFactory::class, ['create'], [], '', false);
        $mockRawResultFactory->method('create')->willReturn($this->mockRawResult);

        $mockRedirectResultFactory = $this->getMock(RedirectResultFactory::class, ['create'], [], '', false);
        $mockRedirectResultFactory->method('create')->willReturn($this->mockRedirectResult);

        $mockContext = $this->getMock(ActionContext::class, [], [], '', false);
        $mockContext->method('getRequest')->willReturn($this->mockRequest);
        $mockContext->method('getResultRedirectFactory')->willReturn($mockRedirectResultFactory);

        $this->controller = new Index($mockContext, $mockRawResultFactory, $this->mockUseCase);
    }

    public function testReturnsResultInstance()
    {
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->assertInstanceOf(ResultInterface::class, $this->controller->execute());
    }

    public function testReturns405MethodNotAllowedForNonPostRequests()
    {
        $this->mockRequest->method('getMethod')->willReturn('GET');
        $this->mockRawResult->expects($this->once())->method('setHttpResponseCode')->with(405);
        $this->controller->execute();
    }

    public function testReturns400BadRequestIfRequiredParametersAreMissing()
    {
//        $testException = new RequiredParametersMissingException('Test Exception: required parameters missing');
//        $this->mockUseCase->method('doSomething')->willThrowException($testException);
//        $this->mockRawResult->expects($this->once())->method('setHttpResponseCode')->with(400);
//        $this->controller->execute();
        $incompleteParameters = [];
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->mockRequest->method('getParams')->willReturn($incompleteParameters);

        $testException = new RequiredParametersMissingException('Test Exception: required parameters missing');
        $this->mockUseCase->expects($this->once())
            ->method('doSomething')
            ->with($incompleteParameters)
            ->willThrowException($testException);

        $this->mockRawResult->expects($this->once())->method('setHttpResponseCode')->with(400);

        $this->controller->execute();
    }

//    public function testRedirectsToHomepageForValidRequests()
//    {
//        $this->mockRequest->method('getMethod')->willReturn('POST');
//        $this->mockRequest->method('getParams')->willReturn(['foo_id' => 123]);
//
//        $this->assertSame($this->mockRedirectResult, $this->controller->execute());
//    }

    public function testRedirectsToHomepageForValidRequests()
    {
        $this->mockRequest->method('getMethod')->willReturn('POST');
        $this->mockRequest->method('getParams')->willReturn(['foo_id' => 123]);

        $this->mockRedirectResult->expects($this->once())->method('setPath');

        $this->assertSame($this->mockRedirectResult, $this->controller->execute());
    }
}