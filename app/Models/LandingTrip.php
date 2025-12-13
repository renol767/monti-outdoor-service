<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingTrip extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'price', 
        'duration', 'difficulty', 'category', 
        'image', 'is_popular', 'order'
    ];

    protected $casts = [
        'is_popular' => 'boolean',
    ];
}
