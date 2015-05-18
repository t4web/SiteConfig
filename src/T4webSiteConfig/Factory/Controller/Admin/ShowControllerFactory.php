<?php

namespace T4webSiteConfig\Factory\Controller\Admin;

use T4webSiteConfig\Controller\Admin\ShowController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ShowControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        return new ShowController(
            $serviceManager->get('T4webSiteConfig\Value\Service\Finder'),
            $serviceManager->get('T4webSiteConfig\Scope\Service\Finder'),
            $serviceManager->get('T4webSiteConfig\ViewModel\Admin\ListViewModel')
        );
    }
}