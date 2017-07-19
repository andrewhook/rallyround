<?php

namespace Rallyround\Server;

class JobWorker extends \Worker
{
    public function run()
    {
        foreach (Processor::getAutoloads() as $path) {
            require($path);
        }
    }
}