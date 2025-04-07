<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->randomElement([
                'What is included in the tour price?',
                'How do I book a tour?',
                'Can I cancel my booking?',
                'What should I bring on the tour?',
                'Are meals provided during the tour?',
                'Is transportation included?',
                'What happens if it rains?',
                'Are children allowed on this tour?',
            ]),
            'answer' => $this->faker->paragraph(3), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}