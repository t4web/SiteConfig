<?php

namespace T4webSiteConfig\Factory\Controller\Console;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;

use T4webSiteConfig\Controller\Console\InitController;

class InitControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        $fileSystem = new Filesystem(new LocalAdapter(__DIR__));
        $fileSystem->addPlugin(new LocalSymlinkPlugin\Symlink());

        return new InitController(
            $serviceManager->get('Zend\Db\Adapter\Adapter'),
            $fileSystem
        );
    }
}