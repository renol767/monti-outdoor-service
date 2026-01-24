<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingService extends Model
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = ['title', 'description', 'features'];

    protected $fillable = [
        'title', 'description', 'icon', 
        'icon_bg_class', 'features', 'order'
    ];

    // protected $casts = [
    //     'features' => 'array',
    // ];
}
