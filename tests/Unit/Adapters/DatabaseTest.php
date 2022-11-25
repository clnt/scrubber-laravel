<?php

namespace Tests\Unit\Adapters;

use ClntDev\LaravelScrubber\Adapters\Database;
use ClntDev\Scrubber\Contracts\DatabaseUpdate;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /** @test */
    public function the_database_adapter_implements_the_scrubber_contract(): void
    {
        $this->assertInstanceOf(DatabaseUpdate::class, new Database);
    }
}
