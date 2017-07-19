<?php

namespace Rallyround\Client;

abstract class Job
{
    public function run($queue = 'default')
    {
        $queue = "rallyround:{$queue}";
        
        return Client::instance()->executeRaw(['LPUSH', $queue, serialize($this) ]);
    }

    abstract public function execute();
}