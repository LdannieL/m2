<?php
 
namespace Mage2Kata\SkeletonModule;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader as DeploymentConfigReader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

class SkeletonModuleTest extends \PHPUnit_Framework_TestCase
{
  // public function testNothing()
  // {
  //     $this->fail('I expect this message');
  // }

    private $moduleName = 'Mage2Kata_SkeletonModule';

    /**
     * @var ObjectManager
     */
     private $objectManager;

     protected function setUp()
     {
         $this->objectManager = ObjectManager::getInstance();
     }

    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $paths = $registrar->getPaths(ComponentRegistrar::MODULE);
        $this->assertArrayHasKey($this->moduleName, $paths);
    }

     public function testTheModuleIsKnownAndEnabledInTheTestEnvironment()
     {
         /** @var ModuleList $moduleList */
         $moduleList = $this->objectManager->create(ModuleList::class);
         $message = sprintf('The module "%s" is not enabled in the test environment', $this->moduleName);
         $this->assertTrue($moduleList->has($this->moduleName), $message);
     }

     public function testTheModuleIsKnownAndEnabledInTheRealEnvironment()
     {
         $directoryList = $this->objectManager->create(DirectoryList::class, ['root' => BP]);
         $configReader = $this->objectManager->create(DeploymentConfigReader::class, ['dirList' => $directoryList]);
         $deploymentConfig = $this->objectManager->create(DeploymentConfig::class, ['reader' => $configReader]);

         /** @var ModuleList $moduleList */
         $moduleList = $this->objectManager->create(ModuleList::class, ['config' => $deploymentConfig]);
         $message = sprintf('The module "%s" is not enabled in the real environment', $this->moduleName);
         $this->assertTrue($moduleList->has($this->moduleName), $message);
     }
}
