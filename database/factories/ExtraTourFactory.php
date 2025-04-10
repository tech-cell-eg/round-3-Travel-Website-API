<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Extra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExtraTour>
 */
class ExtraTourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'extra_id' => Extra::factory(), 
            'tour_id' => Tour::factory(), 
        ];
    }
}