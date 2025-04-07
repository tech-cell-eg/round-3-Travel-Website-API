<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Destination extends Model
{
    use HasFactory, Sluggable;
    public function tours() {
        return $this->hasMany(Tour::class);
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,  
            ]
        ];
    }

}
