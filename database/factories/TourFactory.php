<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\ExtraTour;
use App\Models\TourImage;
use App\Models\TicketType;
use App\Models\TourReview;
use App\Models\Destination;
use App\Models\TourAmenity;
use App\Models\TourCategory;
use App\Models\TourItinerary;
use App\Models\TourTicketPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), 
            'image' => $this->faker->imageUrl(800, 600, 'travel', true),
            'type' => $this->faker->randomElement(['trending', 'popular']),
            'initial_price' => $this->faker->numberBetween(100, 1000),
            'tour_category_id' => TourCategory::all()->random()->id, 
            'destination_id' => Destination::all()->random()->id, 
            'group_size' => $this->faker->numberBetween(5, 50),
            'ages' => $this->faker->randomElement(['All Ages', '18+', '12-65', '5+']),
            'languages' => $this->faker->randomElement(['English', 'Spanish, English', 'French, English', 'Multilingual']),
            'description' => $this->faker->paragraph(3),
            'highlights' => [
                $this->faker->sentence(),
                $this->faker->sentence(),
                $this->faker->sentence(),
            ],
            'bestseller' => $this->faker->boolean(20),
            'free_cancellation' => $this->faker->boolean(70),
            'map' => $this->faker->url(),
            'duration' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Tour $tour) {
            TourImage::factory()
                ->count(4)
                ->create(['tour_id' => $tour->id]);

            TourItinerary::factory()
                ->count(6)
                ->create(['tour_id' => $tour->id]);
            
            TourReview::factory()
                ->count(5)
                ->create(['tour_id' => $tour->id]);

            TourAmenity::factory()
                ->count(5)
                ->create(['tour_id' => $tour->id]);

            $ticketTypeIds = TicketType::all()->pluck('id')->toArray();

            foreach (range(0, 2) as $index) {
                TourTicketPrice::factory()->create([
                    'tour_id' => $tour->id,
                    'ticket_type_id' => $ticketTypeIds[$index] ?? TicketType::factory()->create()->id,
                ]);
            }

            ExtraTour::factory()
                ->count(3)
                ->create(['tour_id' => $tour->id]);
        });
    }
}