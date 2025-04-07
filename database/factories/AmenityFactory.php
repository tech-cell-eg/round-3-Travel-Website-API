<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Wi-Fi',
                'Air Conditioning',
                'Breakfast Included',
                'Tour Guide',
                'Transportation',
                'Swimming Pool',
                'Parking',
                'Snacks',
                'First Aid Kit',
                'Restrooms',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}