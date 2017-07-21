<?php

namespace Rallyround\Server;

use Pool;
use Rallyround\Storage\StorageContract;

class Processor
{
    private $pool;

    private $storage;
    
    private $queue;

    private static $autoloads = [];

    public function __construct(Pool $pool, StorageContract $storage, $queue = 'default')
    {
        $this->pool = $pool;

        $this->storage = $storage;

        $this->queue = "rallyround:{$queue}";
    }

    public function start($daemonize = true)
    {
        do {
            $response = $this->storage->getNextJob($this->queue);
            
            while($response !== null) {
                $job = unserialize($response[1]);

                $this->pool->submit(new JobRunner($job));

                $response = $this->storage->getNextJob($this->queue);
            }

            $this->pool->shutdown();

            sleep(1);
        } while($daemonize);
    }

    public static function setAutoloads($autoloads = [])
    {
        static::$autoloads = $autoloads;
    }

    public static function getAutoloads()
    {
        return static::$autoloads;
    }

    public function getQueueName()
    {
        return $this->queue;
    }
}