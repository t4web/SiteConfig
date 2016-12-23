<?php

namespace T4web\SiteConfig\Controller\Console;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InitControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        return new InitController(
            $serviceManager->get('Zend\Db\Adapter\Adapter')
        );
    }
}