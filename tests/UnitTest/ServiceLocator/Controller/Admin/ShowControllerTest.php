<?php
namespace SiteConfig\UnitTest\ServiceLocator\Controller\Admin;

use SiteConfig\Module;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\Config;
use Zend\Mvc\Controller\PluginManager as ControllerPluginManager;
use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    private $serviceManager;

    /**
     * @var ControllerManager
     */
    private $controllerManager;

    protected function setUp()
    {
        $module = new Module();

        $events = new EventManager();
        $sharedEvents = new SharedEventManager;
        $events->setSharedManager($sharedEvents);

        $plugins = new ControllerPluginManager();
        $this->serviceManager = new ServiceManager();
        $this->serviceManager->setService('Zend\ServiceManager\ServiceLocatorInterface', $this->serviceManager);
        $this->serviceManager->setService('EventManager', $events);
        $this->serviceManager->setService('SharedEventManager', $sharedEvents);
        $this->serviceManager->setService('ControllerPluginManager', $plugins);

        $this->controllerManager = new ControllerManager(new Config($module->getControllerConfig()));
        $this->controllerManager->setServiceLocator($this->serviceManager);
        $this->controllerManager->addPeeringServiceManager($this->serviceManager);
    }

    public function testCreation()
    {
        $scopeService = $this->getMockBuilder('SiteConfig\Scope\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $valueService = $this->getMockBuilder('SiteConfig\Value\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('SiteConfig\Scope\Service', $scopeService);
        $this->serviceManager->setService('SiteConfig\Value\Service', $valueService);

        $this->assertTrue($this->controllerManager->has('SiteConfig\Controller\Admin\Show'));

        $controller = $this->controllerManager->get('SiteConfig\Controller\Admin\Show');

        $this->assertInstanceOf('SiteConfig\Controller\Admin\ShowController', $controller);
        $this->assertAttributeEquals($scopeService, 'scopeService', $controller);
        $this->assertAttributeEquals($valueService, 'valueService', $controller);
        $this->assertAttributeInstanceOf('SiteConfig\ViewModel\Admin\ListViewModel', 'viewModel', $controller);
    }

}