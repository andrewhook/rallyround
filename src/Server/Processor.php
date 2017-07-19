<?php

namespace Rallyround\Server;

use Predis\Client as RedisClient;

class Processor
{
    private $queue;
    private $pool;

    private static $autoloads = [];

    public function __construct($queue, $workers = 20)
    {
        $this->queue = "rallyround:{$queue}";

        $this->pool = new \Pool($workers, JobWorker::class);
    }

    public function start()
    {
        while(true) {
            $response = $this->getNextJob();
            
            while($response !== null) {
                $job = unserialize($response[1]);

                $this->pool->submit(new JobRunner($job));

                $response = $this->getNextJob();
            }

            $this->pool->shutdown();

            sleep(1);
        }
    }

    private function getNextJob()
    {
        return (new RedisClient())->executeRaw(['BRPOP', $this->queue, 1]);
    }

    public static function setAutoloads($autoloads = [])
    {
        static::$autoloads = $autoloads;
    }

    public static function getAutoloads()
    {
        return static::$autoloads;
    }
}