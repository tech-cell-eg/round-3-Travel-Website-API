<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourTicketPrice extends Model
{
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
