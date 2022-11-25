<?php

namespace Feature\Adapters;

use ClntDev\LaravelScrubber\Adapters\Logging;
use Exception;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use TiMacDonald\Log\LogEntry;

class LoggingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->logging = new Logging(app(Logger::class));
    }

    /** @test */
    public function it_can_successfully_log_an_error_message(): void
    {
        $this->logging->log(new Exception('Test exception'));

        Log::assertLogged(static fn (LogEntry $log) => $log->level === 'error' && $log->message === 'Test exception');
    }
}
