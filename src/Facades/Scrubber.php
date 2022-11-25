<?php

namespace ClntDev\LaravelScrubber\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static run(): void
 * @method static getFieldList(string $type = 'pid'): array
 * @method static getFieldListAsString(string $type = 'pid'): string
 */
class Scrubber extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'scrubber-laravel';
    }
}
