<?php

namespace Database\Factories;

use App\Models\Battery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Waves>
 */
class WavesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      Battery::factory(1)->Create();
        return [
            'fk_battery' => 1,
            'fk_surfer'=> fake()->numberBetween(1, 2)
        ];
    }
}
