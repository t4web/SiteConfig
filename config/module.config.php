<?php

namespace T4webSiteConfig;

use Zend\ServiceManager\ServiceLocatorInterface;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
        'display_exceptions' => false,
        'display_not_found_reason' => false,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'T4webSiteConfig\Controller\Console\Init' => 'T4webSiteConfig\Factory\Controller\Console\InitControllerFactory',
            'T4webSiteConfig\Controller\Admin\Show' => 'T4webSiteConfig\Factory\Controller\Admin\ShowControllerFactory',
            'T4webSiteConfig\Controller\Admin\SaveAjax' => 'T4webSiteConfig\Factory\Controller\Admin\SaveAjaxControllerFactory',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'T4webSiteConfig\ViewModel\Admin\ListViewModel' => function(ServiceLocatorInterface $serviceLocator) {
                $repository = $serviceLocator->get("T4webSiteConfig\\Scope\\Infrastructure\\Repository");
                return new ListViewModel($repository);
            }
        ),
        'invokables' => array(
            'T4webSiteConfig\Value\InputFilter\Create' => 'T4webSiteConfig\Value\InputFilter\Create',
            'T4webSiteConfig\Value\InputFilter\Update' => 'T4webSiteConfig\Value\InputFilter\Update',

            'T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel' => 'T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel',
        ),
    ),

    'router' => array(
        'routes' => array(
            'site-config-admin-show' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/site-config',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webSiteConfig\Controller\Admin',
                        'controller' => 'Show',
                        'action' => 'default',
                    ),
                ),
            ),
            'site-config-admin-save' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/site-config/save',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webSiteConfig\Controller\Admin',
                        'controller' => 'SaveAjax',
                        'action' => 'default',
                    ),
                ),
            ),
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'site-config-init' => array(
                    'options' => array(
                        'route' => 'site-config init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'T4webSiteConfig\Controller\Console',
                            'controller' => 'Init',
                            'action' => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'entity_map' => require __DIR__ . '/entity_map.config.php',
);
