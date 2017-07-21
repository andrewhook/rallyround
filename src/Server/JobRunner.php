<?php

namespace Rallyround\Server;

class JobRunner extends \Threaded
{
    private $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function run()
    {
        try {
            $className = get_class($this->job);

            $this->debug("{$className}::: Started");

            $result = $this->job->execute();

            $this->debug("{$className}::: Finished");

            return $result;
        } catch(\Exception $e) {
            // report
        }
    }

    private function debug($message)
    {
        echo "{$message}\n";
    }
}