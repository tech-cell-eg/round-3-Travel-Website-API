<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourAmenity>
 */
class TourAmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tour_id' => Tour::factory(),
            'amenity_id' => Amenity::factory(),
            'is_included' => $this->faker->boolean(80), // 80% chance of being true
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}