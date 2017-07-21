<?php

namespace Rallyround\Storage;

class RedisStorage implements StorageContract
{
    public function getNextJob($queue)
    {
        return RedisClient::instance()->executeRaw(['BRPOP', $queue, 1]);
    }
}