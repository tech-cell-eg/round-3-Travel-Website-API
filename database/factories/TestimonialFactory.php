<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Links to a User
            'rate' => $this->faker->numberBetween(0, 5), // Random rating from 0 to 5 as a string
            'comment' => $this->faker->paragraph(2), // 2-sentence comment
        ];
    }
}