<?php

namespace T4web\SiteConfig;

return [

    'entity_map' => require __DIR__ . '/entity_map.config.php',

    'console' => [
        'router' => [
            'routes' => [
                'site-config-init' => [
                    'options' => [
                        'route' => 'site-config init',
                        'defaults' => [
                            '__NAMESPACE__' => 'T4web\SiteConfig\Controller\Console',
                            'controller' => 'Init',
                            'action' => 'run'
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'T4web\SiteConfig\Controller\Console\Init' => Controller\Console\InitControllerFactory::class,
        ],
    ],
];
