<?php
namespace SiteConfig\UnitTest\ServiceLocator\Value;

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

        $this->serviceManager->setService('SiteConfig\Value\TableGateway', $tableGatewayMock);

        $this->assertTrue($this->serviceManager->has('SiteConfig\Value\DbRepository'));

        $repository = $this->serviceManager->get('SiteConfig\Value\DbRepository');

        $this->assertInstanceOf('SiteConfig\Value\DbRepository', $repository);
        $this->assertAttributeSame($tableGatewayMock, 'tableGateway', $repository);
        $this->assertAttributeInstanceOf('SiteConfig\Value\Mapper', 'mapper', $repository);
    }

}