<?php

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
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
