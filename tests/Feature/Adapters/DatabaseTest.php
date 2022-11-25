<?php

namespace Tests\Feature\Adapters;

use ClntDev\Scrubber\Contracts\DatabaseUpdate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Tests\Support\ScrubberTestItem;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->database = app(DatabaseUpdate::class);
    }

    /** @test */
    public function it_can_get_the_database_ids_from_primary_key(): void
    {
        [$testItemA, $testItemB] = $this->createTestItems();

        $values = $this->database->fetch('scrubber_test', 'id');

        $this->assertEquals([$testItemA->id, $testItemB->id], $values);
    }

    /** @test */
    public function it_can_update_the_database(): void
    {
        [$testItemA, $testItemB] = $this->createTestItems();

        $this->assertEquals(2, ScrubberTestItem::count());

        $this->database->update('scrubber_test', 'first_name', 'Updated', $testItemA->id, 'id');
        $this->database->update('scrubber_test', 'first_name', 'Updated B', $testItemB->id, 'id');
        $this->database->update('scrubber_test', 'toggle', true, $testItemB->id, 'id');

        $this->assertDatabaseHas('scrubber_test', $testItemA->fresh()->getAttributes());
        $this->assertDatabaseHas('scrubber_test', $testItemB->fresh()->getAttributes());

        $this->assertEquals('Updated', $testItemA->fresh()->getFirstName());
        $this->assertEquals('Updated B', $testItemB->fresh()->getFirstName());
        $this->assertEquals($testItemA->getLastName(), $testItemA->fresh()->getLastName());
        $this->assertEquals($testItemB->getLastName(), $testItemB->fresh()->getLastName());
        $this->assertEquals($testItemA->getEmail(), $testItemA->fresh()->getEmail());
        $this->assertEquals($testItemB->getEmail(), $testItemB->fresh()->getEmail());
        $this->assertFalse($testItemA->fresh()->getToggle());
        $this->assertTrue($testItemB->fresh()->getToggle());
    }

    private function createTestItems(): Collection
    {
        $testItemA = ScrubberTestItem::create([
            'first_name' => 'User',
            'last_name' => 'One',
            'email' => 'user.one@example.com',
            'toggle' => false,
        ]);
        $testItemB = ScrubberTestItem::create([
            'first_name' => 'User',
            'last_name' => 'Two',
            'email' => 'user.two@example.com',
            'toggle' => false,
        ]);

        return collect([$testItemA, $testItemB]);
    }
}
