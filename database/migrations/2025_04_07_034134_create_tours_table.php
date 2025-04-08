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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['trending', 'popular']);
            $table->integer('duration')->nullable();
            $table->foreignId('tour_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->integer('group_size')->nullable();
            $table->string('ages')->nullable();
            $table->string('languages')->nullable();
            $table->text('description')->nullable();
            $table->json('highlights')->nullable();
            $table->boolean('bestseller')->default(false);
            $table->boolean('free_cancellation')->default(false);
            $table->string('map')->nullable()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
