<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingFeature extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'order'];
}
