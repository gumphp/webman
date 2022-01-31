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
    'listen'               => env('SERVER_LISTEN', 'http://0.0.0.0:8787'),
    'transport'            => env('SERVER_TRANSPORT', 'tcp'),
    'context'              => env('SERVER_CONTEXT', []),
    'name'                 => env('SERVER_NAME', 'webman'),
    'count'                => env('SERVER_COUNT', cpu_count() * 2),
    'user'                 => env('SERVER_USER', ''),
    'group'                => env('SERVER_GROUP', ''),
    'pid_file'             => env('SERVER_PID_FILE', runtime_path() . '/webman.pid'),
    'stdout_file'          => env('SERVER_STDOUT_FILE', runtime_path() . '/logs/stdout.log'),
    'log_file'             => env('SERVER_LOG_FILE', runtime_path() . '/logs/workerman.log'),
    'max_request'          => env('SERVER_MAX_REQUEST', 1000000),
    'max_package_size'     => env('SERVER_MAX_PACKAGE_SIZE', 10*1024*1024),
];
