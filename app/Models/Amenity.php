<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
    use HasFactory;
    
    public function tours() {
        return $this->belongsToMany(Tour::class, 'tour_amenities')
            ->withPivot('is_included');
    }
}
