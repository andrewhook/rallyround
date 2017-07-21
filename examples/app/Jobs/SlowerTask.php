<?php

namespace ExampleApp\Jobs;

use Rallyround\Client\Job;

class SlowerTask extends Job
{
    private $seconds;

    public function __construct($seconds)
    {
        $this->seconds = $seconds;
    }

    public function execute()
    {
        sleep($this->seconds);

        echo date('Y-m-d H:i:s') . "::: Job ran for {$this->seconds}.\n";
    }
}
