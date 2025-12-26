<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartureVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_id',
        'name',
        'description',
        'base_price',
        'quota',
        'booked_count',
        'discount_type',
        'discount_value',
        'discount_start_at',
        'discount_end_at',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'base_price' => 'integer',
        'quota' => 'integer',
        'booked_count' => 'integer',
        'discount_value' => 'integer',
        'discount_start_at' => 'datetime',
        'discount_end_at' => 'datetime',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Relationships
    public function departure(): BelongsTo
    {
        return $this->belongsTo(TripDeparture::class, 'departure_id');
    }

    // Accessors
    public function getRemainingQuotaAttribute(): ?int
    {
        if ($this->quota === null) {
            return null; // Unlimited
        }
        return max(0, $this->quota - $this->booked_count);
    }

    public function getIsDiscountActiveAttribute(): bool
    {
        if (!$this->discount_type || $this->discount_value <= 0) {
            return false;
        }

        $now = now();
        
        if ($this->discount_start_at && $now->lt($this->discount_start_at)) {
            return false;
        }
        
        if ($this->discount_end_at && $now->gt($this->discount_end_at)) {
            return false;
        }

        return true;
    }

    public function getCalculatedDiscountAttribute(): int
    {
        if (!$this->is_discount_active) {
            return 0;
        }

        if ($this->discount_type === 'percent') {
            return (int) floor($this->base_price * $this->discount_value / 100);
        }

        return min($this->discount_value, $this->base_price);
    }

    public function getFinalPriceAttribute(): int
    {
        // Priority: Variant discount > Departure discount
        $discount = $this->calculated_discount;
        
        if ($discount === 0 && $this->departure) {
            $discount = $this->departure->calculated_discount;
        }

        return $this->base_price - $discount;
    }

    // Format price for display
    public function getFormattedPriceAttribute(): string
    {
        return 'IDR ' . number_format($this->final_price, 0, ',', '.');
    }

    public function getFormattedBasePriceAttribute(): string
    {
        return 'IDR ' . number_format($this->base_price, 0, ',', '.');
    }
}
