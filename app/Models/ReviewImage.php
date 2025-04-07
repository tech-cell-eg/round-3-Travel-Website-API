<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the tour review that owns this image.
     */
    public function tourReview()
    {
        return $this->belongsTo(TourReview::class);
    }
}