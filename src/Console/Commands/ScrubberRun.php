<?php

namespace ClntDev\LaravelScrubber\Console\Commands;

use ClntDev\LaravelScrubber\Facades\Scrubber;
use Illuminate\Console\Command;

class ScrubberRun extends Command
{
    /** @var string */
    protected $signature = 'scrubber:run';

    /** @var string */
    protected $description = 'Runs the main scrubber method against the given configuration';

    public function handle(): int
    {
        if ($this->confirm(
            'Are you sure you wish to run the scrubber? This will erase data for the defined tables and fields'
        ) === false
        ) {
            return 1;
        }

        $this->warn('Running scrubber on the database');

        Scrubber::run();

        $this->info('Scrubber completed');

        return 0;
    }
}
