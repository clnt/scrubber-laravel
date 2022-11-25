<?php

namespace ClntDev\LaravelScrubber;

use ClntDev\Scrubber\Contracts\DatabaseUpdate;
use ClntDev\Scrubber\Contracts\Logger;
use ClntDev\Scrubber\Scrubber as BaseScrubber;

class Scrubber
{
    protected BaseScrubber $scrubber;

    public function __construct()
    {
        $this->scrubber = new BaseScrubber(
            config('scrubber.configuration_path'),
            app(DatabaseUpdate::class),
            app(Logger::class)
        );
    }

    public static function make(): self
    {
        return new self();
    }

    public function run(): bool
    {
        return $this->scrubber->run();
    }

    public function getFieldList(string $type = 'pid'): array
    {
        return $this->scrubber->getFieldList($type);
    }

    public function getFieldListAsString(string $type = 'pid'): string
    {
        return $this->scrubber->getFieldListAsString($type);
    }
}
