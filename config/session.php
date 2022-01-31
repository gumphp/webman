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

    'type'    => env('SESSION_TYPE', 'file'), // or redis or redis_cluster

    'handler' => env('SESSION_HANDLER', Webman\FileSessionHandler::class),

    'config' => [
        'file' => [
            'save_path' => env('SESSION_FILE_SAVE_PATH', runtime_path() . '/sessions'),
        ],
        'redis' => [
            'host'      => env('REDIS_HOST_SESSION', '127.0.0.1'),
            'port'      => env('REDIS_PORT_SESSION', 6379),
            'auth'      => env('REDIS_AUTH_SESSION', ''),
            'timeout'   => env('REDIS_TIMEOUT_SESSION', 2),
            'database'  => env('REDIS_DATABASE_SESSION', 1),
            'prefix'    => env('REDIS_PREFIX_SESSION', 'redis_session_'),
        ],
        'redis_cluster' => [
            'host'    => ['127.0.0.1:7000', '127.0.0.1:7001', '127.0.0.1:7001'],
            'timeout' => 2,
            'auth'    => '',
            'prefix'  => 'redis_session_',
        ]
    ],

    'session_name' => env('SESSION_NAME', 'PHPSID'),
];
