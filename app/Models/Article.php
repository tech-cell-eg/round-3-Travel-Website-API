<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, Sluggable;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,  
            ]
        ];
    }

    public function getImageAttribute(): string
    {
        return str_starts_with($this->attributes['image'], 'http')
            ? $this->attributes['image']
            : asset('storage/' . $this->attributes['image']);
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->user_id = auth()->id();
        });
    }
}
