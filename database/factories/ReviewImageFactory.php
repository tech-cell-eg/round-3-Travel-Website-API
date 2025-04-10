<?php

namespace Database\Factories;

use App\Models\TourReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tour_review_id' => TourReview::factory(),
            'image' => $this->faker->imageUrl(800, 600, 'travel', true),
        ];
    }
}