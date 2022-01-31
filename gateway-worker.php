<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\service\GatewayWorkerService;
use Webman\Config;

Config::load(config_path());
(new GatewayWorkerService())->start();