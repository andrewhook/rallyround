<?php

namespace Rallyround\Client;

use Rallyround\Storage\RedisRepository;

final class Client
{
    public static function submit(Job $job, $queue = 'default')
    {
        $queue = "rallyround:{$queue}";

        return (new RedisRepository())->enqueueJob($job, $queue);
    }
}