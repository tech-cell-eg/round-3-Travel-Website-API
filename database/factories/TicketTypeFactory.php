<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define a static list of ticket types with age ranges
        static $ticketTypes = [
            ['name' => 'Adult', 'age_min' => 18, 'age_max' => 70],
            ['name' => 'Youth', 'age_min' => 13, 'age_max' => 17],
            ['name' => 'Children', 'age_min' => 1, 'age_max' => 12],
        ];

        $ticketType = $this->faker->unique()->randomElement($ticketTypes);

        return [
            'name' => $ticketType['name'],
            'age_min' => $ticketType['age_min'],
            'age_max' => $ticketType['age_max'],
        ];
    }
}