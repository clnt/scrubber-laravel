<?php

namespace Tests\Feature\Facades;

use ClntDev\LaravelScrubber\Facades\Scrubber;
use Tests\TestCase;

class ScrubberTest extends TestCase
{
    /** @test */
    public function it_can_use_the_facade_to_get_the_expected_field_list(): void
    {
        $this->assertEquals([
            'first_name',
            'last_name',
            'email',
        ], Scrubber::getFieldList());
    }
}
