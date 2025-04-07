<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourCategory>
 */
class TourCategoryFactory extends Factory
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
                'Adventure',
                'Cultural',
                'Beach',
                'Wildlife',
                'Historical',
                'Food & Wine',
                'City Tours',
                'Nature',
            ]),
            'image' => $this->faker->imageUrl(640, 480, 'travel', true), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}