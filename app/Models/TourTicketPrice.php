<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourTicketPrice extends Model
{
    use HasFactory;
    
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
