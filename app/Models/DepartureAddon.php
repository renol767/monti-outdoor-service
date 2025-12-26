<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartureAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_id',
        'addon_id',
        'price',
        'max_qty',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'max_qty' => 'integer',
        'is_active' => 'boolean',
    ];

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relationships
    public function departure(): BelongsTo
    {
        return $this->belongsTo(TripDeparture::class, 'departure_id');
    }

    public function addon(): BelongsTo
    {
        return $this->belongsTo(Addon::class);
    }

    // Accessor
    public function getFormattedPriceAttribute(): string
    {
        return 'IDR ' . number_format($this->price, 0, ',', '.');
    }
}
