<?php

namespace ClntDev\LaravelScrubber\Adapters;

use ClntDev\Scrubber\Contracts\Logger;
use Illuminate\Log\Logger as IlluminateLogger;
use Throwable;

class Logging implements Logger
{
    protected IlluminateLogger $logger;

    public function __construct(IlluminateLogger $logger)
    {
        $this->logger = $logger;
    }

    public function log(Throwable $exception): void
    {
        $this->logger->error($exception->getMessage());
    }
}
