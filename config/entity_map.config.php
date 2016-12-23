<?php

namespace T4web\SiteConfig;

return [
    'ConfigValue' => [
        'entityClass' => Entity\Value::class,
        'table' => 'site_config_values',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'scope_id' => 'scopeId',
            'name' => 'name',
            'value' => 'value',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
    'ConfigScope' => [
        'entityClass' => Entity\Scope::class,
        'table' => 'site_config_scopes',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'name' => 'name',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ],
    ],
];
