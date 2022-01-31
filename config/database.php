<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

return [
    // 默认数据库
    'default' => env('DB_CONNECTION', 'mysql'),
    // 各种数据库配置
    'connections' => [

        'mysql' => [
            'driver'      => 'mysql',
            'host'        => env('MYSQL_HOST', '127.0.0.1'),
            'port'        => env('MYSQL_PORT', 3306),
            'database'    => env('MYSQL_DATABASE', 'webman'),
            'username'    => env('MYSQL_USERNAME', 'webman'),
            'password'    => env('MYSQL_PASSWORD', ''),
            'unix_socket' => env('MYSQL_UNIX_SOCKET', ''),
            'charset'     => 'utf8mb4',
            'collation'   => 'utf8mb4_unicode_ci',
            'prefix'      => env('MYSQL_PREFIX', ''),
            'strict'      => true,
            'engine'      => null,
        ],

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => env('SQLITE_DATABASE', base_path() . '/database/database.sqlite'),
            'prefix'   => env('SQLITE_PREFIX', ''),
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => '127.0.0.1',
            'port'     => 5432,
            'database' => 'webman',
            'username' => 'webman',
            'password' => '',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => 'localhost',
            'port'     => 1433,
            'database' => 'webman',
            'username' => 'webman',
            'password' => '',
            'charset'  => 'utf8',
            'prefix'   => '',
        ],
    ],
];
