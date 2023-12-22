<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'team_id' => 1,
            // 'name' => fake()->randomElement([
            //     'Footings and Foundations',
            //     'Masonry',
            //     'Retaining Walls and Pavers',
            //     'Building Materials',
            //     'Windows and Exterior Doors',
            //     'Garage Doors',
            //     'AV, Security, and Low Voltage',
            //     'Electrical',
            //     'Plumbing',
            //     'Countertops',
            //     'Cabinets',
            //     'Appliances',
            //     'Tile Material',
            //     'Wood Flooring',
            //     'Shower Door, Glass, and Mirrors',
            //     'Carpet and Exercise Flooring',
            //     'Hardware',
            // ]),
        ];
    }
}
