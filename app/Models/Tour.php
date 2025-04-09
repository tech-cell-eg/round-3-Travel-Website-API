<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, Sluggable, FilterTrait;

    protected $casts = [
        'highlights' => 'array',
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'tour_amenities')
            ->withPivot('is_included')
            ->withTimestamps();
    }

    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class);
    }

    public function reviews()
    {
        return $this->hasMany(TourReview::class);
    }

    public function ticketPrices()
    {
        return $this->hasMany(TourTicketPrice::class)->with('ticketType');
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'extra_tours', 'tour_id', 'extra_id');
    }

    public function getBestsellerAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function getFreeCancellationAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    public function getImageAttribute(): string
    {
        return str_starts_with($this->attributes['image'], 'http')
            ? $this->attributes['image']
            : asset('storage/' . $this->attributes['image']);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Calculate the overall average rating for the tour
     */
    public function averageRating()
    {
        $reviews = $this->reviews;

        if ($reviews->isEmpty()) {
            return 0;
        }

        $avg = $reviews->avg(function ($review) {
            $sum = $review->location_rate +
                $review->amenities_rate +
                $review->price_rate +
                $review->room_rate +
                $review->food_rate +
                $review->tour_operator;

            return $sum / 6;
        });

        return round($avg, 1);
    }

    /**
     * Get ratings by category
     */
    public function categoriesRating()
    {
        $reviews = $this->reviews;

        if ($reviews->isEmpty()) {
            return [
                'location' => 0,
                'amenities' => 0,
                'price' => 0,
                'room' => 0,
                'food' => 0,
                'tour_operator' => 0,
                'overall' => 0
            ];
        }

        return [
            'location' => round($reviews->avg('location_rate'), 1),
            'amenities' => round($reviews->avg('amenities_rate'), 1),
            'price' => round($reviews->avg('price_rate'), 1),
            'room' => round($reviews->avg('room_rate'), 1),
            'food' => round($reviews->avg('food_rate'), 1),
            'tour_operator' => round($reviews->avg('tour_operator'), 1),
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
