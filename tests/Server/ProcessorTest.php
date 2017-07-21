<?php

namespace Tests\Server;

use Pool;
use PHPUnit\Framework\TestCase;
use Rallyround\Server\Processor;
use Rallyround\Storage\StorageContract;

class ProcessorTest extends TestCase
{
    /** @test */
    function it_assigns_a_default_queue()
    {
        $pool = $this->createMock(Pool::class);
        $storage = $this->createMock(StorageContract::class);

        $processor = new Processor($pool, $storage);

        $this->assertEquals('rallyround:default', $processor->getQueueName());
    }

    /** @test */
    function it_gets_a_job()
    {
        $pool = $this->createMock(Pool::class);
        $storage = $this->getMockBuilder(StorageContract::class)
            ->setMethods(['getNextJob', 'enqueueJob'])
            ->getMock();

        $storage->expects($this->once())
            ->method('getNextJob');

        (new Processor($pool, $storage))->start(false);
    }

    /** @test */
    function it_submits_a_job()
    {
        $pool = $this->getMockBuilder(Pool::class)
            ->disableOriginalConstructor()
            ->setMethods(['submit'])
            ->getMock();

        $storage = $this->createMock(StorageContract::class);

        $storage->expects($this->at(0))
            ->method('getNextJob')
            ->willReturn(true);

        $storage->expects($this->at(1))
            ->method('getNextJob')
            ->willReturn(null);

        $pool->expects($this->once())
            ->method('submit');

        (new Processor($pool, $storage))->start(false);
    }

    /** @test */
    function it_shuts_the_pool_down()
    {
        $pool = $this->getMockBuilder(Pool::class)
            ->disableOriginalConstructor()
            ->setMethods(['shutdown'])
            ->getMock();

        $storage = $this->createMock(StorageContract::class);

        $pool->expects($this->once())
            ->method('shutdown');

        (new Processor($pool, $storage))->start(false);
    }

    /** @test */
    function it_can_set_autoloads()
    {
        Processor::setAutoloads(['vendor/autoload.php']);

        $this->assertEquals(['vendor/autoload.php'], Processor::getAutoloads());
    }
}
