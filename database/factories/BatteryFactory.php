<?php

namespace Database\Factories;

use App\Models\surfer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Battery>
 */
class BatteryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $surfer=  surfer::factory(2)->create();
        return [
            'fk_surfer1'=>$surfer[0]->id,
            'fk_surfer2'=>$surfer[1]->id
        ];
    }
}
