<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => 1,
            'name' => fake()->word(),
            'item_number' => random_int(100000, 200000),
            'supplier' => fake()->word(),
            'link' => fake()->url(),
            'image' => '',
            'dimensions' => random_int(0, 10) . 'ft' . ' ' . random_int(1, 11) . 'in',
            'color' => fake()->colorName(),
            'notes' => fake()->sentence(),
        ];
    }
}
