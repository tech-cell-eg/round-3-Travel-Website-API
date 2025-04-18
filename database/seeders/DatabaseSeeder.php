<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Tour;
use App\Models\User;
use App\Models\Extra;
use App\Models\Amenity;
use App\Models\Article;
use App\Models\Feature;
use App\Models\TicketType;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\TourCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\TicketTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        // Truncate all tables
        User::truncate();
        Destination::truncate();
        TourCategory::truncate();
        TicketType::truncate();
        Tour::truncate();
        Amenity::truncate();
        Extra::truncate();
        Faq::truncate();
        Testimonial::truncate();
        Article::truncate(); 
        Feature::truncate();
    
        DB::table('tour_images')->truncate();
        DB::table('tour_itineraries')->truncate();
        DB::table('tour_reviews')->truncate();
        DB::table('tour_amenities')->truncate();
        DB::table('tour_ticket_prices')->truncate();
        DB::table('extra_tours')->truncate();
    
        // Re-enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
        // Seed the tables
        $users = User::factory(10)->create(); // Store the created users
        Destination::factory(10)->create();
        TourCategory::factory(5)->create();
        $this->call(TicketTypeSeeder::class); 
        Tour::factory(100)->create();
        Amenity::factory(10)->create();
        Extra::factory(10)->create();
        Faq::factory(100)->create();
        Testimonial::factory(100)->create();
        // Article::factory(10)->create(['user_id' => fn () => $users->random()->id]); 
        $this->call(FeatureSeeder::class);
    }
}