<?php
 
namespace Mage2Kata\Interceptor\Plugin;
 
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Area;
use Magento\TestFramework\App\State as AppState;
use Magento\TestFramework\Interception\PluginList;
use Magento\TestFramework\ObjectManager;
 
class CustomerRepositoryPluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    private $moduleId = 'mage2kata_interceptor';
 
    /**
     * @param string $areaCode
     */
    private function setMagentoArea($areaCode)
    {
        /** @var AppState $applicationState */
        $applicationState = $this->objectManager->get(AppState::class);
        $applicationState->setAreaCode($areaCode);
    }

    /**
     * @return array[]
     */
    private function getCustomerRepositoryInterfacePluginInfo()
    {
        /** @var PluginList $pluginList */
        $pluginList = $this->objectManager->create(PluginList::class);
        return $pluginList->get(CustomerRepositoryInterface::class, []);
    }
 
    protected function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
    }
 
    protected function tearDown()
    {
        $this->setMagentoArea(null);
    }
 
    public function testTheCustomerRepositoryPluginIsRegisteredInTheWebapiRestScope()
    {
        $this->setMagentoArea(Area::AREA_WEBAPI_REST);
//        /** @var PluginList $pluginList */
//        $pluginList = $this->objectManager->create(PluginList::class);
//
//        $pluginInfo = $pluginList->get(CustomerRepositoryInterface::class, []);
        $pluginInfo = $this->getCustomerRepositoryInterfacePluginInfo();
        $this->assertSame(CustomerRepositoryPlugin::class, $pluginInfo[$this->moduleId]['instance']);
    }
 
    public function testTheCustomerRepositoryPluginIsNotRegisteredInGlobalScope()
    {
        $this->setMagentoArea(Area::AREA_GLOBAL);
 
//        /** @var PluginList $pluginList */
//        $pluginList = $this->objectManager->create(PluginList::class);
//
//        $pluginInfo = $pluginList->get(CustomerRepositoryInterface::class, []);
        $this->assertArrayNotHasKey($this->moduleId, $this->getCustomerRepositoryInterfacePluginInfo());
    }

    /**
     * @magentoDataFixture Magento/Customer/_files/customer.php
     */
    public function testTheExternalApiIsCalledWhenANewCustomerIsSaved()
    {
        $mockExternalApi = $this->getMock(ExternalCustomerApi::class, ['registerNewCustomer']);
        $mockExternalApi->expects($this->once())->method('registerNewCustomer');
        $this->objectManager->configure([ExternalCustomerApi::class => ['shared' => true]]);
        $this->objectManager->addSharedInstance($mockExternalApi, ExternalCustomerApi::class);

        $this->setMagentoArea(Area::AREA_WEBAPI_REST);
        /** @var CustomerRepositoryInterface $customerRepository */
        $customerRepository = $this->objectManager->create(CustomerRepositoryInterface::class);
        $customer = $customerRepository->get('customer@example.com');

        $customer->setId(null)
            ->setFirstname('Alice')
            ->setEmail('alica@example.com');

        $customerRepository->save($customer);
    }
}