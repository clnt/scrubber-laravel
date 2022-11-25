<?php

namespace Feature;

use ClntDev\LaravelScrubber\Scrubber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Support\ScrubberTestItem;
use Tests\TestCase;

class ScrubberTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_run_the_run_method(): void
    {
        [$itemA, $itemB] = ScrubberTestItem::factory()->times(2)->create();

        $this->assertEquals(2, ScrubberTestItem::count());

        Scrubber::make()->run();

        $refreshedItemA = $itemA->fresh();
        $refreshedItemB = $itemB->fresh();

        $this->assertNotSame($itemA->first_name, $refreshedItemA->first_name);
        $this->assertNotSame($itemB->first_name, $refreshedItemB->first_name);
        $this->assertNotSame($itemA->last_name, $refreshedItemA->last_name);
        $this->assertNotSame($itemB->last_name, $refreshedItemB->last_name);
        $this->assertNotSame($itemA->email, $refreshedItemA->email);
        $this->assertNotSame($itemB->email, $refreshedItemB->email);
        $this->assertTrue($refreshedItemA->toggle);
        $this->assertTrue($refreshedItemB->toggle);
    }

    /** @test */
    public function it_can_run_the_get_field_list_method(): void
    {
        $this->assertEquals([
            'first_name',
            'last_name',
            'email',
        ], Scrubber::make()->getFieldList());
    }

    /** @test */
    public function it_can_run_the_get_field_list_as_string_method(): void
    {
        $this->assertEquals('first_name,last_name,email', Scrubber::make()->getFieldListAsString());
    }
}
