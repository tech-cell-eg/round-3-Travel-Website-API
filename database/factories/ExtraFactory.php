<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extra>
 */
class ExtraFactory extends Factory
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
                'Priority Boarding',
                'Extra Luggage',
                'Premium Meal',
                'Guided Tour Upgrade',
                'Photo Package',
                'VIP Access',
                'Extended Time',
                'Souvenir Kit',
            ]),
            'price' => $this->faker->numberBetween(10, 100), 
            'per_person' => $this->faker->randomElement([true, false]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}