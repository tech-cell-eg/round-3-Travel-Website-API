<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    public function tours() {
        return $this->hasMany(Tour::class);
    }
}
