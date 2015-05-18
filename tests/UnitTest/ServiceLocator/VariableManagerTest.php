<?php
namespace SiteConfig\UnitTest\ServiceLocator\Scope;

use SiteConfig\Module;
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
        $valueService = $this->getMockBuilder('SiteConfig\Value\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('SiteConfig\Value\Service', $valueService);

        $this->assertTrue($this->serviceManager->has('SiteConfig\VariableManager'));

        $service = $this->serviceManager->get('SiteConfig\VariableManager');

        $this->assertInstanceOf('SiteConfig\VariableManager', $service);
        $this->assertAttributeSame($valueService, 'valueService', $service);
    }

}