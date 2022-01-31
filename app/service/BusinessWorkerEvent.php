<?php
namespace app\service;

class BusinessWorkerEvent
{
    public static function onConnect($clientId)
    {
        var_dump(__METHOD__);
        var_dump("clientId:\t{$clientId}");
    }

    public static function onMessage($clientId, $message)
    {
        var_dump(__METHOD__);
        var_dump("clientId:\t{$clientId}");
        var_dump("message:\t{$message}");
    }

    public static function onClose($clientId)
    {
        var_dump(__METHOD__);
        var_dump("clientId:\t{$clientId}");
    }
}