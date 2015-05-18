<?php
namespace T4webSiteConfig;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;

use T4webBase\Domain\Service\Create as ServiceCreate;
use T4webBase\Domain\Service\Update as ServiceUpdate;
use T4webBase\Domain\Service\BaseFinder as ServiceFinder;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
    ConsoleUsageProviderInterface, ServiceProviderInterface
{

    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'site-config init' => 'Initialize module',
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'T4webSiteConfig\VariableManager' => function (ServiceManager $sm) {
                    return new VariableManager(
                        $sm->get('T4webSiteConfig\Value\Service\Create')
                    );
                },

                'T4webSiteConfig\Value\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('T4webSiteConfig\Value\Repository\DbRepository'),
                        $sm->get('T4webSiteConfig\Value\Criteria\CriteriaFactory')
                    );
                },

                'T4webSiteConfig\Value\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('T4webSiteConfig\Value\InputFilter\Create'),
                        $sm->get('T4webSiteConfig\Value\Repository\DbRepository'),
                        $sm->get('T4webSiteConfig\Value\Factory\EntityFactory')
                    );
                },

                'T4webSiteConfig\Value\Service\Update' => function (ServiceManager $sm) {
                    return new ServiceUpdate(
                        $sm->get('T4webSiteConfig\Value\InputFilter\Update'),
                        $sm->get('T4webSiteConfig\Value\Repository\DbRepository'),
                        $sm->get('T4webSiteConfig\Value\Criteria\CriteriaFactory')
                    );
                },

                'T4webSiteConfig\Scope\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('T4webSiteConfig\Scope\Repository\DbRepository'),
                        $sm->get('T4webSiteConfig\Scope\Criteria\CriteriaFactory')
                    );
                },
            )
        );
    }

}
