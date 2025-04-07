<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    public function tours() {
        return $this->belongsToMany(Tour::class, 'extra_tour');
    }
}
