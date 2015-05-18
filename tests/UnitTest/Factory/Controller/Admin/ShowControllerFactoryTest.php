<?php

namespace T4webSiteConfigTest\UnitTest\Factory\Controller\Admin;

use T4webBaseTest\Factory\AbstractControllerFactoryTest;
use T4webSiteConfig\Factory\Controller\Admin\ShowControllerFactory;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

class ShowControllerFactoryTest extends AbstractControllerFactoryTest
{

    public function testFactory() {
        $factory = new ShowControllerFactory();

        $this->serviceManager->setService('T4webSiteConfig\Value\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webSiteConfig\Scope\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webSiteConfig\ViewModel\Admin\ListViewModel', new ListViewModel());

        $this->assertInstanceOf('T4webSiteConfig\Controller\Admin\ShowController', $factory->createService($this->controllerManager));
    }

}