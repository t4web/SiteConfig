<?php
namespace SiteConfig;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface
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

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'SiteConfig\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new Controller\Console\InitController(
                        $sl->get('Zend\Db\Adapter\Adapter'),
                        $sl->get('Zend\Db\Metadata\Metadata')
                    );
                },
            ),
            'invokables' => array(
                'SiteConfig\Controller\Admin\Show' => 'SiteConfig\Controller\Admin\ShowController',
            )
        );
    }
}
