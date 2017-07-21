<?php

namespace Rallyround\Storage;

use Rallyround\Client\Job;

interface StorageContract
{
    public function getNextJob($queue);

    public function enqueueJob(Job $job, $queue);
}