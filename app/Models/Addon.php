<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_price',
        'unit',
        'is_active',
    ];

    protected $casts = [
        'default_price' => 'integer',
        'is_active' => 'boolean',
    ];

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relationships
    public function departureAddons(): HasMany
    {
        return $this->hasMany(DepartureAddon::class);
    }
}
