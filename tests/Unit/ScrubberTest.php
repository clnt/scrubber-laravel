<?php

namespace Tests\Unit;

use ClntDev\LaravelScrubber\Scrubber;
use Tests\TestCase;

class ScrubberTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_the_scrubber_class_with_laravel_implementations(): void
    {
        $scrubber = Scrubber::make();

        $this->assertInstanceOf(Scrubber::class, $scrubber);
    }
}
