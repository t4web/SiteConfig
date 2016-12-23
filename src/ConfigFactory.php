<?php

namespace T4web\SiteConfig;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Config(
            $serviceLocator->get('ConfigValue\Infrastructure\Repository'),
            $serviceLocator->get('ConfigScope\Infrastructure\Repository')
        );
    }
}