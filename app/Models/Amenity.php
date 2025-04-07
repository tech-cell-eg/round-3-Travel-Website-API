<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    public function tours() {
        return $this->belongsToMany(Tour::class, 'tour_amenities')
            ->withPivot('is_included');
    }
}
