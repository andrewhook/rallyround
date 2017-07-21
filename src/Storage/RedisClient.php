<?php

namespace Rallyround\Storage;

use Predis\Client;

final class RedisClient
{
    private static $config;

    public static function instance()
    {
        static $inst = null;
     
        if ($inst === null) {
            $inst = new Client();
        }
     
        return $inst;
    }
}