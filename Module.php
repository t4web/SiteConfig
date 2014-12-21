<?php
namespace SiteConfig;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\TableGateway\TableGateway;
use SiteConfig\Controller\Console\InitController;
use SiteConfig\Controller\Admin\ShowController;
use SiteConfig\Scope\DbRepository as ScopeRepository;
use SiteConfig\Scope\Mapper as ScopeMapper;
use SiteConfig\Scope\Service as ScopeService;
use SiteConfig\Value\DbRepository as ValueRepository;
use SiteConfig\Value\Mapper as ValueMapper;
use SiteConfig\Value\Service as ValueService;
use SiteConfig\ViewModel\Admin\ListViewModel;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface,
                        ServiceProviderInterface
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
                'SiteConfig\Scope\Service' => function (ServiceManager $sl) {
                    return new ScopeService($sl->get('SiteConfig\Scope\DbRepository'));
                },
                'SiteConfig\Scope\DbRepository' => function (ServiceManager $sl) {
                    $tableGateway = $sl->get('SiteConfig\Scope\TableGateway');
                    $mapper = new ScopeMapper();

                    return new ScopeRepository($tableGateway, $mapper);
                },
                'SiteConfig\Scope\TableGateway' => function (ServiceManager $sl) {
                    return new TableGateway(
                        't4_site_config',
                        $sl->get('Zend\Db\Adapter\Adapter')
                    );
                },

                'SiteConfig\Value\Service' => function (ServiceManager $sl) {
                    return new ValueService($sl->get('SiteConfig\Value\DbRepository'));
                },
                'SiteConfig\Value\DbRepository' => function (ServiceManager $sl) {
                    $tableGateway = $sl->get('SiteConfig\Value\TableGateway');
                    $mapper = new ValueMapper();

                    return new ValueRepository($tableGateway, $mapper);
                },
                'SiteConfig\Value\TableGateway' => function (ServiceManager $sl) {
                    return new TableGateway(
                        't4_site_config',
                        $sl->get('Zend\Db\Adapter\Adapter')
                    );
                },
            )
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'SiteConfig\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new InitController(
                        $sl->get('Zend\Db\Adapter\Adapter'),
                        $sl->get('Zend\Db\Metadata\Metadata')
                    );
                },
                'SiteConfig\Controller\Admin\Show' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new ShowController(
                        $sl->get('SiteConfig\Scope\Service'),
                        $sl->get('SiteConfig\Value\Service'),
                        new ListViewModel()
                    );
                },
            ),

            'invokables' => array(

            )
        );
    }
}
