<?php

return [
    'Value' => [
        'table' => 'site_config_values',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'scope_id' => 'scopeId',
            'name' => 'name',
            'value' => 'value',
        ],
    ],
    'Scope' => [
        'table' => 'site_config_scopes',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'name' => 'name',
        ],
    ],
];
