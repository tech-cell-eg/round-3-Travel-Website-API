<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourItinerary>
 */
class TourItineraryFactory extends Factory
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
            'title' => $this->faker->randomElement([
                'Day 1: Arrival and Orientation',
            ]),
            'description' => $this->faker->paragraph(2)
        ];
    }
}