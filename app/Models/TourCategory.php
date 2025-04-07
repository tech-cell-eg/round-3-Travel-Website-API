<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourCategory extends Model
{
    use HasFactory;
    
    public function tours() {
        return $this->hasMany(Tour::class);
    }
}
