<?php

namespace Rallyround\Storage;

use Rallyround\Client\Job;

class RedisRepository implements StorageContract
{
    public function getNextJob($queue)
    {
        $response = RedisClient::instance()->executeRaw(['BRPOP', $queue, 1]);

        if($response !== null) {
            $nextJob = unserialize($response[1]);

            return $nextJob;
        }

        return null;
    }

    public function enqueueJob(Job $job, $queue)
    {
        return RedisClient::instance()->executeRaw(['LPUSH', $queue, serialize($job) ]);
    }
}