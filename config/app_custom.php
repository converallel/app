<?php

return [
    'Datasources' => [
        'auth' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'root',
            'password' => '596051',
            'database' => 'oauth',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
            'url' => env('DATABASE_AUTH_URL', null),
        ],
    ],
    'Security' => [
        'jwtKey' => '9ac1225da084b1a51d73e121eff5ebbb7f86d212ab74dbc6c0728303318504e5'
    ]
];