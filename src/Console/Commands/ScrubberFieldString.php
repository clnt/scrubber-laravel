<?php

namespace ClntDev\LaravelScrubber\Console\Commands;

use ClntDev\LaravelScrubber\Facades\Scrubber;
use Illuminate\Console\Command;

class ScrubberFieldString extends Command
{
    /** @var string */
    protected $signature = 'scrubber:fields {type=pid}';

    /** @var string */
    protected $description = 'Returns a comma separated string of field names of the given type (default is `pid`)';

    public function handle(): int
    {
        $type = $this->argument('type');

        $this->info('Getting fields for type "' . $type . '"' . PHP_EOL);

        $this->info(Scrubber::getFieldListAsString($type));

        return 0;
    }
}
