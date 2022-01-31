<?php
/**
 * workerman/gateway-worker 配置
 * @doc-link https://www.workerman.net/doc/gateway-worker/
 */

return [
    /**
     * Register 配置
     * @doc-link https://www.workerman.net/doc/gateway-worker/register.html
     *
     * Register类其实也是基于基础的Worker开发的。
     * Gateway进程和BusinessWorker进程启动后分别向Register进程注册自己的通讯地址，Gateway进程和BusinessWorker通过Register进程得到通讯地址后，就可以建立起连接并通讯了。
     *
     * 注意：
     * 客户端不要连接Register服务的端口，Register服务是GatewayWorker内部通讯用的。参见 https://www.workerman.net/doc/gateway-worker/principle.html。
     * register服务只能开一个进程，不能开启多个进程。
     * register不支持Gateway接口(包括GatewayClient接口)，不要在register进程写任何业务。
     *
     * Register类只能定制监听的ip和端口，并且目前只能使用text协议。
     */
    'register' => [
        /**
         * 是否启动 register 服务
         */
        'start' => true,
        /**
         * 监听地址，只能使用text协议
         */
        'listen' => 'text://0.0.0.0:1238',
        /**
         * register配置
         */
        'config' => [
            /**
             * register 进程名称
             */
            'name' => 'Register',
        ],
    ],

    /**
     * Gateway 配置
     * @doc-link https://www.workerman.net/doc/gateway-worker/gateway.html
     *
     * Gateway类用于初始化Gateway进程。
     * Gateway进程是暴露给客户端的让其连接的进程。
     * 所有客户端的请求都是由Gateway接收然后分发给BusinessWorker处理，同样BusinessWorker也会将要发给客户端的响应通过Gateway转发出去。
     * Gateway类是基于基础的Worker开发的。
     * 可以给Gateway对象的onWorkerStart、onWorkerStop、onConnect、onClose设置回调函数，但是无法给设置onMessage回调。
     * Gateway的onMessage行为固定为将客户端数据转发给BusinessWorker。
     */
    'gateway' => [
        /**
         * 是否启动 gateway 服务
         */
        'start' => true,
        /**
         * 监听地址，可以使用的协议：websocket/text/frame/自定义协议/tcp
         */
        'listen' => 'websocket://0.0.0.0:8282',
        /**
         * gateway 配置
         */
        'config' => [
            /**
             * 设置Gateway进程的名称，方便status命令中查看统计
             */
            'name' => 'Gateway',
            /**
             * 设置Gateway进程的数量，以便充分利用多cpu资源
             */
            'count' => 4,
            /**
             * lanIp是Gateway所在服务器的内网IP，默认填写127.0.0.1即可。
             * 多服务器分布式部署的时候需要填写真实的内网ip，不能填写127.0.0.1。
             * 注意：lanIp只能填写真实ip，不能填写域名或者其它字符串，无论如何都不能写0.0.0.0 .
             *
             * 多服务器分布式部署文档：
             * https://www.workerman.net/doc/gateway-worker/how-distributed.html
             */
            'lanIp' => '127.0.0.1',
            /**
             * Gateway进程启动后会监听一个本机端口，用来给BusinessWorker提供链接服务，然后Gateway与BusinessWorker之间就通过这个连接通讯。
             * 这里设置的是Gateway监听本机端口的起始端口。比如启动了4个Gateway进程，startPort为2000，则每个Gateway进程分别启动的本地端口一般为2000、2001、2002、2003。
             * 当本机有多个Gateway/BusinessWorker项目时，需要把每个项目的startPort设置成不同的段
             */
            'startPort' => 2000,
            /**
             * registerAddress，注册服务地址，只写格式类似于 '127.0.0.1:1236'
             */
            'registerAddress' => '127.0.0.1:1238',
            /**
             * 心跳检测时间间隔 单位：秒。如果设置为0代表不做任何心跳检测。
             */
            'pingInterval' => 30,
            /**
             * 客户端连续$pingNotResponseLimit次$pingInterval时间内不发送任何数据(包括但不限于心跳数据)则断开链接，并触发onClose。
             * 如果设置为0代表客户端不用发送心跳数据，即通过TCP层面检测连接的连通性（极端情况至少10分钟才能检测到连接断开，甚至可能永远检测不到）
             */
            'pingNotResponseLimit' => 1,
            /**
             * 当需要服务端定时给客户端发送心跳数据时，$gateway->pingData设置为服务端要发送的心跳请求数据，心跳数据是任意的，只要客户端能识别即可。
             * 客户端收到心跳数据可以忽略不做任何处理。
             */
            'pingData' => '{"action":"ping"}',
            /**
             * 设置Gateway进程启动后的回调函数，一般在这个回调里面初始化一些全局数据
             */
            'onWorkerStart' => null,
            /**
             * 设置Gateway进程关闭的回调函数，一般在这个回调里面做数据清理或者保存数据工作
             */
            'onWorkerStop' => null,
            /**
             * 设置onConnect回调，当有客户端连接上来时触发。
             * 与Events::onConnect的区别是Events::onConnect运行在BusinessWorker进程上。
             * Gateway::onConnect是运行在Gateway进程上，无法使用\GatewayWorker\Lib\Gateway类提供的接口
             */
            'onConnect' => null,
            /**
             * 设置onClose回调，当有客户端连接关闭时触发。
             * 同样与Events::onClose的区别是Gateway::onClose是运行在Gateway进程上，无法使用\GatewayWorker\Lib\Gateway类提供的接口
             */
            'onClose' => null,
        ],
    ],
    /**
     * BusinessWorker 配置
     * @doc-link https://www.workerman.net/doc/gateway-worker/business-worker.html
     *
     * BusinessWorker类其实也是基于基础的Worker开发的。
     * BusinessWorker是运行业务逻辑的进程，BusinessWorker收到Gateway转发来的事件及请求时会默认调用 EventHandler 中的onConnect onMessage onClose方法处理事件及数据，开发者正是通过实现这些回调控制业务及流程。
     */
    'businessworker' => [
        'start' => true,
        /**
         * businessworker配置
         */
        'config' => [
            /**
             * 设置BusinessWorker进程的名称，方便status命令中查看统计
             */
            'name' => 'BusinessWorker',
            /**
             * 设置BusinessWorker进程的数量，以便充分利用多cpu资源
             */
            'count' => 4,
            /**
             * registerAddress，注册服务地址，只写格式类似于 '127.0.0.1:1236'
             */
            'registerAddress' => '127.0.0.1:1238',
            /**
             * 设置BusinessWorker进程启动后的回调函数，一般在这个回调里面初始化一些全局数据
             */
            'onWorkerStart' => null,
            /**
             * 设置BusinessWorker进程关闭的回调函数，一般在这个回调里面做数据清理或者保存数据工作
             */
            'onWorkerStop' => null,
            /**
             * 设置使用哪个类来处理业务，默认值是Events，即默认使用Events.php中的Events类来处理业务。
             * 业务类至少要实现onMessage静态方法，onConnect和onClose静态方法可以不用实现。
             */
            'eventHandler' => \app\service\BusinessWorkerEvent::class,
        ],
    ],
];