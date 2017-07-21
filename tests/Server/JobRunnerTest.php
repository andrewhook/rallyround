<?php

namespace Tests\Server;

use Rallyround\Client\Job;
use PHPUnit\Framework\TestCase;
use Rallyround\Server\JobRunner;

class JobRunnerTest extends TestCase
{
    /** @test */
    function it_executes_a_job()
    {
        $job = $this->getMockBuilder(Job::class)
            ->setMethods(['execute'])
            ->getMock();

        $job->expects($this->once())
            ->method('execute');

        (new JobRunner($job))->run();
    }
}
