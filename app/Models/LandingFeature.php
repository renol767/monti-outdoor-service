<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingFeature extends Model
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'icon', 'order'];
}
