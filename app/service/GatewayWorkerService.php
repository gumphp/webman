<?php
namespace app\service;

use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use Workerman\Worker;

class GatewayWorkerService
{
    /**
     * 启动 register/gateway/businessworker
     */
    public static function start()
    {
        self::startRegister();
        self::startGateway();
        self::startBusinessWorker();

        Worker::runAll();
    }

    /**
     * 启动 register
     */
    protected static function startRegister()
    {
        if (!self::getConfig('register.start')) {
            return;
        }
        $register = new Register(self::getConfig('register.listen'));
        self::setWorkerConfig($register, self::getConfig('register.config'));
    }

    /**
     * 启动 gateway
     */
    protected static function startGateway()
    {
        if (!self::getConfig('gateway.start')) {
            return;
        }
        $gateway = new Gateway(self::getConfig('gateway.listen'));
        self::setWorkerConfig($gateway, self::getConfig('gateway.config'));
    }

    /**
     * 启动 businessworker
     */
    protected static function startBusinessWorker()
    {
        if (!self::getConfig('businessworker.start')) {
            return;
        }
        $businessWorker = new BusinessWorker();
        self::setWorkerConfig($businessWorker, self::getConfig('businessworker.config'));
    }

    /**
     * 获取配置
     *
     * @param $name
     * @param null $default
     * @return mixed
     */
    protected static function getConfig($name, $default = null)
    {
        return config("gateway-worker.{$name}", $default);
    }

    /**
     * 设置worker进程配置
     *
     * @param $worker
     * @param $configs
     */
    protected static function setWorkerConfig($worker, $configs)
    {
        foreach ($configs as $name => $value) {
            $worker->{$name} = $value;
        }
    }
}
