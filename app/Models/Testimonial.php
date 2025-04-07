<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    
    public function getRateAttribute($value)
    {
        switch ($value) {
            case 5:
                return 'excellent';
                break;
            case 4:
                return 'very good';
                break;
            case 3:
                return 'good';
                break;
            case 2:
                return 'fair';
                break;
            case 1:
                return 'poor';
                break;
            default:
                return 'no rate';
                break;
        }
    }

    public function getImageAttribute(): string
    {
        return str_starts_with($this->attributes['image'], 'http')
            ? $this->attributes['image']
            : asset($this->attributes['image']);
    }

}
