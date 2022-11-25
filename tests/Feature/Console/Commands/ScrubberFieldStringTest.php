<?php

namespace Tests\Feature\Console\Commands;

use ClntDev\LaravelScrubber\Facades\Scrubber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ScrubberFieldStringTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_run_the_scrubber_field_string_command(): void
    {
        $this->artisan('scrubber:fields')
            ->expectsOutput('Getting fields for type "pid"' . PHP_EOL)
            ->expectsOutput(Scrubber::getFieldListAsString())
            ->assertExitCode(0);
    }
}
