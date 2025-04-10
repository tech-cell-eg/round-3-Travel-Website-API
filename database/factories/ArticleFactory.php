<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(5),
            'image'       => $this->faker->imageUrl(800, 600, 'travel', true),
            'user_id'     => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'description' => $this->faker->paragraph(3),
            'created_at'  => $this->faker->dateTimeThisYear(),
            'updated_at'  => $this->faker->dateTimeThisYear(),
        ];
    }
}
