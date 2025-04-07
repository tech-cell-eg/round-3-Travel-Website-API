<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Tour extends Model
{
    use HasFactory, Sluggable;
    
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
            ->withPivot('is_included');
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
        return $this->hasMany(TourTicketPrice::class);
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'extra_tour');
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
            : asset($this->attributes['image']);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
