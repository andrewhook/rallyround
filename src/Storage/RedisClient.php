<?php

namespace Rallyround\Storage;

use Predis\Client;

final class RedisClient
{
    private static $config;

    public static function instance()
    {
        static $instance = null;
     
        if ($instance === null) {
            $instance = new Client();
        }
     
        return $instance;
    }
}