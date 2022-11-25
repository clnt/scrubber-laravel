<?php

namespace Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Support\ScrubberTestItem;

class ScrubberTestItemFactory extends Factory
{
    /** @var string */
    protected $model = ScrubberTestItem::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'toggle' => false,
        ];
    }
}
