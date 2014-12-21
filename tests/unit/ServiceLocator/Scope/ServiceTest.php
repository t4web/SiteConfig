<?php
namespace SiteConfig\UnitTest\ServiceLocator\Scope;

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
        $dbRepositoryMock = $this->getMockBuilder('SiteConfig\Scope\DbRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('SiteConfig\Scope\DbRepository', $dbRepositoryMock);

        $this->assertTrue($this->serviceManager->has('SiteConfig\Scope\Service'));

        $service = $this->serviceManager->get('SiteConfig\Scope\Service');

        $this->assertInstanceOf('SiteConfig\Scope\Service', $service);
        $this->assertAttributeSame($dbRepositoryMock, 'repository', $service);
    }

}