<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourReview extends Model
{
    use HasFactory;
    
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }
}
