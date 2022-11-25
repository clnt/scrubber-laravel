<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Support\ScrubberTestItem;
use Tests\TestCase;

class ScrubberRunTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_run_the_scrubber_run_command(): void
    {
        [$itemA, $itemB] = ScrubberTestItem::factory()->times(2)->create();

        $this->assertEquals(2, ScrubberTestItem::count());

        $this->artisan('scrubber:run')
            ->expectsConfirmation('Are you sure you wish to run the scrubber? This will erase data for '
            . 'the defined tables and fields', 'yes')
            ->expectsOutput('Running scrubber on the database')
            ->expectsOutput('Scrubber completed')
            ->assertExitCode(0);

        $this->assertNotSame($itemA->first_name, $itemA->fresh()->first_name);
        $this->assertNotSame($itemB->first_name, $itemB->fresh()->first_name);
    }

    /** @test */
    public function it_returns_a_non_zero_exit_code_if_confirmation_fail(): void
    {
        $this->artisan('scrubber:run')
            ->expectsConfirmation('Are you sure you wish to run the scrubber? This will erase data for '
            . 'the defined tables and fields')
            ->assertExitCode(1);
    }
}
