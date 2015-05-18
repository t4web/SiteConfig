<?php
namespace T4webSiteConfigTest\UnitTest\Factory\Controller\Console;

use T4webBaseTest\Factory\AbstractControllerFactoryTest;

use T4webSiteConfig\Factory\Controller\Console\InitControllerFactory;

class InitControllerFactoryTest extends AbstractControllerFactoryTest
{

    public function testFactory() {
        $factory = new InitControllerFactory();

        $this->serviceManager->setService('Zend\Db\Adapter\Adapter', $this->getMockBuilder('Zend\Db\Adapter\Adapter')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('League\Flysystem\Filesystem', $this->getMockBuilder('League\Flysystem\Filesystem')->disableOriginalConstructor()->setMethods(['symlink', 'has'])->getMock());

        $this->assertInstanceOf('T4webSiteConfig\Controller\Console\InitController', $factory->createService($this->controllerManager));
    }

}