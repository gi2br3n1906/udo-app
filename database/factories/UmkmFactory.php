<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Simple menu list
        $menu = [
            ['item' => 'Nasi Goreng', 'price' => 15000],
            ['item' => 'Es Teh', 'price' => 5000],
            ['item' => 'Snack', 'price' => 10000],
        ];

        return [
            'name' => $this->faker->company() . ' Food',
            'description' => $this->faker->sentence(),
            'menu_list' => $menu, // Pass array directly, let Eloquent cast handle it
            'price_range' => '10k - 25k',
            'map_booth_id' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8']),
        ];
    }
}
