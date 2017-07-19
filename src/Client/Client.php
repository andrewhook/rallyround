<?php

namespace Rallyround\Client;

use Predis\Client as RedisClient;

final class Client
{
    private static $config;

    public static function instance()
    {
        static $inst = null;
     
        if ($inst === null) {
            $inst = new RedisClient();
        }
     
        return $inst;
    }

    public static function setConfiguration($config)
    {
        static::$config = $config;
    }
}