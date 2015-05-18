<?php

namespace T4webSiteConfigTest\UnitTest\Factory\Controller\Admin;

use T4webBaseTest\Factory\AbstractControllerFactoryTest;
use T4webSiteConfig\Factory\Controller\Admin\SaveAjaxControllerFactory;
use T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel;

class SaveAjaxControllerFactoryTest extends AbstractControllerFactoryTest
{

    public function testFactory() {
        $factory = new SaveAjaxControllerFactory();

        $this->serviceManager->setService('T4webSiteConfig\Value\Service\Update', $this->getMockBuilder('T4webBase\Domain\Service\Update')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel', new SaveAjaxViewModel());

        $this->assertInstanceOf('T4webSiteConfig\Controller\Admin\SaveAjaxController', $factory->createService($this->controllerManager));
    }

}