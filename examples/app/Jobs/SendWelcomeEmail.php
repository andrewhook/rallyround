<?php

namespace ExampleApp\Jobs;

use Rallyround\Client\Job;

class SendWelcomeEmail extends Job
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function execute()
    {
        echo "Sending email to {$this->email}.\n";
    }
}
