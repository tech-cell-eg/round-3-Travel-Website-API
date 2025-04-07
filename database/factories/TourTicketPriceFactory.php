<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourTicketPrice>
 */
class TourTicketPriceFactory extends Factory
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
            'ticket_type_id' => TicketType::factory(), 
            'price' => $this->faker->numberBetween(20, 500), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}