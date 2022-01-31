<?php

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => env('PHINX_DEFAULT_ENVIRONMENT', 'development'),
        'production' => [
            'adapter' => 'mysql',
            'host' => env('MYSQL_HOST', '127.0.0.1'),
            'name' => env('MYSQL_DATABASE', 'webman'),
            'user' => env('MYSQL_USERNAME', 'root'),
            'pass' => env('MYSQL_PASSWORD', ''),
            'port' => env('MYSQL_PORT', 3306),
            'charset' => 'utf8mb4',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => env('MYSQL_HOST', '127.0.0.1'),
            'name' => env('MYSQL_DATABASE', 'webman'),
            'user' => env('MYSQL_USERNAME', 'root'),
            'pass' => env('MYSQL_PASSWORD', ''),
            'port' => env('MYSQL_PORT', 3306),
            'charset' => 'utf8mb4',
        ],
        'testing' => [
            'host' => env('MYSQL_HOST', '127.0.0.1'),
            'name' => env('MYSQL_DATABASE', 'webman'),
            'user' => env('MYSQL_USERNAME', 'root'),
            'pass' => env('MYSQL_PASSWORD', ''),
            'port' => env('MYSQL_PORT', 3306),
            'charset' => 'utf8mb4',
        ],
    ],
    'version_order' => 'creation'
];
