<?php

namespace Rallyround\Storage;

interface StorageContract
{
    public function getNextJob($queue);
}