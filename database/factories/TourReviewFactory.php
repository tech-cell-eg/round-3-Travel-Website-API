<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\TourReview;
use App\Models\ReviewImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourReview>
 */
class TourReviewFactory extends Factory
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
            'name' => $this->faker->name(), 
            'email' => $this->faker->unique()->safeEmail(), 
            'title' => $this->faker->sentence(4), 
            'comment' => $this->faker->paragraph(2), 
            'location_rate' => $this->faker->numberBetween(0, 5), 
            'amenities_rate' => $this->faker->numberBetween(0, 5), 
            'price_rate' => $this->faker->numberBetween(0, 5), 
            'room_rate' => $this->faker->numberBetween(0, 5), 
            'food_rate' => $this->faker->numberBetween(0, 5), 
            'tour_operator' => $this->faker->numberBetween(0, 5), 
            'created_at' => $this->faker->dateTimeThisYear(), 
            'updated_at' => $this->faker->dateTimeThisYear(), 
        ];
    }

    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (TourReview $review) {
            ReviewImage::factory()
                ->count(3)
                ->create(['tour_review_id' => $review->id]);
        });
    }
}