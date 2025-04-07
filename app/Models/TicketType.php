<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    public function prices() {
        return $this->hasMany(TourTicketPrice::class);
    }
}
