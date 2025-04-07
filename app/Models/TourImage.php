<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourImage extends Model
{
    use HasFactory;

    public function getImageAttribute(): string
    {
        return str_starts_with($this->attributes['image'], 'http')
            ? $this->attributes['image']
            : asset($this->attributes['image']);
    }
}
