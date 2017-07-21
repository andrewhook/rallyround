<?php

namespace Rallyround\Client;

use Rallyround\Storage\RedisClient;

abstract class Job
{
    public function run($queue = 'default')
    {
        $queue = "rallyround:{$queue}";
        
        return RedisClient::instance()->executeRaw(['LPUSH', $queue, serialize($this) ]);
    }

    abstract public function execute();
}