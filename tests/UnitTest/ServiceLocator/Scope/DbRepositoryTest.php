<?php
namespace SiteConfig\UnitTest\ServiceLocator\Scope;

use SiteConfig\Module;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Config;

class DbRepositoryTest extends \PHPUnit_Framework_TestCase
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
        $tableGatewayMock = $this->getMockBuilder('Zend\Db\TableGateway\TableGatewayInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('SiteConfig\Scope\TableGateway', $tableGatewayMock);

        $this->assertTrue($this->serviceManager->has('SiteConfig\Scope\DbRepository'));

        $repository = $this->serviceManager->get('SiteConfig\Scope\DbRepository');

        $this->assertInstanceOf('SiteConfig\Scope\DbRepository', $repository);
        $this->assertAttributeSame($tableGatewayMock, 'tableGateway', $repository);
        $this->assertAttributeInstanceOf('SiteConfig\Scope\Mapper', 'mapper', $repository);
    }

}