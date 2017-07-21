<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Rallyround\Client\Client;

Client::submit(new ExampleApp\Jobs\SlowerTask(10));
Client::submit(new ExampleApp\Jobs\SlowerTask(10));
Client::submit(new ExampleApp\Jobs\SlowerTask(10));
Client::submit(new ExampleApp\Jobs\SlowerTask(10));
Client::submit(new ExampleApp\Jobs\SlowerTask(10));
