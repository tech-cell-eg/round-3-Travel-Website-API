<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('comment');
            $table->unsignedTinyInteger('location_rate')->default(0)->comment('from 0 to 5'); 
            $table->unsignedTinyInteger('amenities_rate')->default(0)->comment('from 0 to 5'); 
            $table->unsignedTinyInteger('price_rate')->default(0)->comment('from 0 to 5'); 
            $table->unsignedTinyInteger('room_rate')->default(0)->comment('from 0 to 5'); 
            $table->unsignedTinyInteger('food_rate')->default(0)->comment('from 0 to 5'); 
            $table->unsignedTinyInteger('tour_operator')->default(0)->comment('from 0 to 5'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_reviews');
    }
};
