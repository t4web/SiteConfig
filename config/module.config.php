<?php

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

    'router' => array(
        'routes' => array(
            'site-config-admin-show' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/site-config',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SiteConfig\Controller\Admin',
                        'controller'    => 'Show',
                        'action'        => 'default',
                    ),
                ),
            ),
            'site-config-admin-save' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/site-config/save',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SiteConfig\Controller\Admin',
                        'controller'    => 'SaveAjax',
                        'action'        => 'default',
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
                        'route'    => 'site-config init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'SiteConfig\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

);
