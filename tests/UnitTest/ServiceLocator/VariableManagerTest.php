<?php
namespace T4webSiteConfigTest\UnitTest\ServiceLocator;

use T4webSiteConfig\Module;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Config;

class VariableManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    private $serviceManager;

    protected function setUp()
    {
        $module = new Module();

        $this->serviceManager = new ServiceManager(new Config($module->getServiceConfig()));
        $this->serviceManager->setAllowOverride(true);
    }

    public function testCreation()
    {
        $valueService = $this->getMockBuilder('T4webBase\Domain\Service\Create')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webSiteConfig\Value\Service\Create', $valueService);
//        $this->serviceManager->setService('T4webSiteConfig\Value\Service\Create', $this->getMockBuilder('T4webBase\Domain\Service\Create')->disableOriginalConstructor()->getMock());

        $this->assertTrue($this->serviceManager->has('T4webSiteConfig\VariableManager'));

        $service = $this->serviceManager->get('T4webSiteConfig\VariableManager');

        $this->assertInstanceOf('T4webSiteConfig\VariableManager', $service);
//        $this->assertAttributeSame($valueService, 'valueService', $service);
    }

}