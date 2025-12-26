<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class TripDeparture extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_template_id',
        'start_date',
        'end_date',
        'capacity',
        'booked_count',
        'status',
        'discount_type',
        'discount_value',
        'discount_start_at',
        'discount_end_at',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'capacity' => 'integer',
        'booked_count' => 'integer',
        'discount_value' => 'integer',
        'discount_start_at' => 'datetime',
        'discount_end_at' => 'datetime',
    ];

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->whereIn('status', ['available', 'limited']);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now()->toDateString());
    }

    public function scopeInMonth($query, int $year, int $month)
    {
        return $query->whereYear('start_date', $year)
                     ->whereMonth('start_date', $month);
    }

    // Relationships
    public function tripTemplate(): BelongsTo
    {
        return $this->belongsTo(TripTemplate::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(DepartureVariant::class, 'departure_id');
    }

    public function addons(): HasMany
    {
        return $this->hasMany(DepartureAddon::class, 'departure_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'departure_id');
    }

    // Accessors
    public function getRemainingCapacityAttribute(): int
    {
        return max(0, $this->capacity - $this->booked_count);
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

    public function getFromPriceAttribute(): ?int
    {
        $minVariant = $this->variants()
            ->where('is_active', true)
            ->orderBy('base_price')
            ->first();

        if (!$minVariant) {
            return null;
        }

        // Apply discount if active
        $basePrice = $minVariant->base_price;
        $discount = $minVariant->calculated_discount ?: $this->calculated_discount;

        return $basePrice - $discount;
    }

    public function getCalculatedDiscountAttribute(): int
    {
        if (!$this->is_discount_active) {
            return 0;
        }

        // Get base price from cheapest variant for percentage calculation
        $basePrice = $this->variants()->where('is_active', true)->min('base_price') ?? 0;

        if ($this->discount_type === 'percent') {
            return (int) floor($basePrice * $this->discount_value / 100);
        }

        return min($this->discount_value, $basePrice);
    }

    // Methods
    public function updateStatus(): void
    {
        if ($this->status === 'closed') {
            return;
        }

        if ($this->start_date < today()) {
            $this->update(['status' => 'closed']);
            return;
        }

        $remaining = $this->remaining_capacity;

        if ($remaining <= 0) {
            $this->update(['status' => 'sold_out']);
        } elseif ($remaining <= 3 || ($remaining / $this->capacity) <= 0.2) {
            $this->update(['status' => 'limited']);
        } else {
            $this->update(['status' => 'available']);
        }
    }
}
