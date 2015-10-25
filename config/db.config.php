<?php

return array(
    'tables' => array(
        't4websiteconfig-value' => array(
            'name' => 'site_config',
            'columnsAsAttributesMap' => array(
                'id' => 'id',
                'scope' => 'scope',
                'name' => 'name',
                'value' => 'value',
            ),
        ),
        't4websiteconfig-scope' => array(
            'name' => 'site_config',
            'columnsAsAttributesMap' => array(
                'id' => 'id',
                'scope' => 'name',
            ),
        ),
    ),
);
