<?php

namespace Database\Factories;

use App\Models\Waves;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grades>
 */
class GradesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Waves::factory(2)->Create();
        return [
            'fk_wave'=> fake()->numberBetween(1, 2),
            'partial_grades1'=> fake()->numberBetween(1, 10),
            'partial_grades2'=> fake()->numberBetween(1, 10),
            'partial_grades3'=> fake()->numberBetween(1, 10)
        ];
    }
}
