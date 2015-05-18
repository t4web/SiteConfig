<?php

namespace T4webSiteConfig\Factory\Controller\Admin;

use T4webSiteConfig\Controller\Admin\SaveAjaxController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SaveAjaxControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        return new SaveAjaxController(
            $serviceManager->get('T4webSiteConfig\Value\Service\Update'),
            $serviceManager->get('T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel')
        );
    }
}