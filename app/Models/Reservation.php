<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function tickets()
    {
        return $this->hasMany(ReservationTicket::class);
    }

    public function extras()
    {
        return $this->hasMany(ReservationExtra::class);
    }
}
