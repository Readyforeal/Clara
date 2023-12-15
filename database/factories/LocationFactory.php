<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => 1,
            'name' => fake()->randomElement([
                'Kitchen',
                'Powder Bath',
                'Master Bedroom',
                'Master Bath',
                'Hall Bath',
                'West Bedroom',
                'East Bedroom',
                'Living Room',
                'Dining Room',
            ]),
        ];
    }
}
