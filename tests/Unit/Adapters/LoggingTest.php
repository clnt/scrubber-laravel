<?php

namespace Tests\Unit\Adapters;

use ClntDev\LaravelScrubber\Adapters\Logging;
use ClntDev\Scrubber\Contracts\Logger;
use Illuminate\Log\Logger as IlluminateLogger;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    /** @test */
    public function the_logging_adapter_implements_the_scrubber_contract(): void
    {
        $this->assertInstanceOf(Logger::class, new Logging(app(IlluminateLogger::class)));
    }
}
