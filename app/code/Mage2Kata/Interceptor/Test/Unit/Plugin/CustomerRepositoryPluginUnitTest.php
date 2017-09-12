<?php
namespace Mage2Kata\Interceptor\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
 
class CustomerRepositoryPluginUnitTest extends \PHPUnit_Framework_TestCase
{
//    public function testNothing()
//    {
//        $this->assertSame(1, 1);
//    }

//    public function testItCanBeInstantiated()
//    {
//        new CustomerRepositoryPlugin();
//    }

    /**
     * @var CustomerRepositoryPlugin
     */
    private $plugin;

    /**
     * @var CustomerRepositoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockCustomerRepository;

    /**
     * @var CustomerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockCustomerToSave;

    /**
     * @var CustomerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockSavedCustomer;

    /**
     * @var ExternalCustomerApi|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockExternalCustomerApi;

    public function __invoke(CustomerInterface $customer, $passwordHash)
    {
        return $this->mockSavedCustomer;
    }

    private function callAroundSavePlugin()
    {
        $proceed = $this;
        $pwHash = null;
        return $this->plugin->aroundSave($this->mockCustomerRepository, $proceed, $this->mockCustomerToSave, $pwHash);
    }

    protected function setUp()
    {
        $this->mockCustomerRepository = $this->getMock(CustomerRepositoryInterface::class);
        $this->mockCustomerToSave = $this->getMock(CustomerInterface::class);
        $this->mockSavedCustomer = $this->getMock(CustomerInterface::class);

//        $this->plugin = new CustomerRepositoryPlugin();
        $this->mockExternalCustomerApi = $this->getMock(ExternalCustomerApi::class, ['registerNewCustomer']);
        $this->plugin = new CustomerRepositoryPlugin($this->mockExternalCustomerApi);
    }

    public function testItHasAnAroundSaveMethod()
    {
        $customerRepository = $this->mockCustomerRepository;
        $proceed = $this;
        $customer = $this->mockCustomerToSave;
        $passwordHash = null;
        $this->plugin->aroundSave($customerRepository, $proceed, $customer, $passwordHash);
    }

//    public function testItReturnsTheResultOfProceed()
//    {
//        $customerRepository = $this->mockCustomerRepository;
//        $proceed = $this;
//        $customer = $this->mockCustomerToSave;
//        $passwordHash = null;
//        $result = $this->plugin->aroundSave($customerRepository, $proceed, $customer, $passwordHash);
//        $this->assertSame($this->mockSavedCustomer, $result);
//    }

    public function testItReturnsTheResultOfProceed()
    {
        $this->assertSame($this->mockSavedCustomer, $this->callAroundSavePlugin());
    }

    public function testItCallsTheExternalApiForNewCustomers()
    {
        $customerId = 123;
        $this->mockCustomerToSave->method('getId')->willReturn(null);
        $this->mockSavedCustomer->method('getId')->willReturn($customerId);
        $this->mockExternalCustomerApi->expects($this->once())->method('registerNewCustomer')->with($customerId);
        $this->callAroundSavePlugin();
    }

    public function testItDoesNotCallTheExternalApiForExistingCustomers()
    {
        $this->mockCustomerToSave->method('getId')->willReturn(33);
        $this->mockExternalCustomerApi->expects($this->never())->method('registerNewCustomer');
        $this->callAroundSavePlugin();
    }
}