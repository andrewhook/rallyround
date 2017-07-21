<?php

require_once(__DIR__ . '/../vendor/autoload.php');

// Set up worker pool to handle the threads
$pool = new \Pool(20, \Rallyround\Server\JobWorker::class);

// Set up our storage driver
$storage = new \Rallyround\Storage\RedisStorage();

// And, go!
(new \Rallyround\Server\Processor($pool, $storage, 'default'))->start();