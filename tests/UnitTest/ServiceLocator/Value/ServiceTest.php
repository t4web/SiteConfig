<?php
namespace SiteConfig\UnitTest\ServiceLocator\Value;

use SiteConfig\Module;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Config;

class ServiceTest extends \PHPUnit_Framework_TestCase
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
        $dbRepositoryMock = $this->getMockBuilder('SiteConfig\Value\DbRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('SiteConfig\Value\DbRepository', $dbRepositoryMock);

        $this->assertTrue($this->serviceManager->has('SiteConfig\Value\Service'));

        $service = $this->serviceManager->get('SiteConfig\Value\Service');

        $this->assertInstanceOf('SiteConfig\Value\Service', $service);
        $this->assertAttributeSame($dbRepositoryMock, 'repository', $service);
    }

}