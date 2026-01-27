<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rundown>
 */
class RundownFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = now()->setTime($this->faker->numberBetween(8, 16), 0);
        
        return [
            'title' => $this->faker->sentence(3),
            'start_time' => $start,
            'end_time' => $start->copy()->addHour(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
