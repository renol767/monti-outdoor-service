<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'destination',
        'category',
        'duration_days',
        'duration_nights',
        'difficulty',
        'includes',
        'highlights',
        'thumbnail',
        'meta_title',
        'meta_description',
        'status',
        'created_by',
    ];

    protected $casts = [
        'rating_avg' => 'decimal:1',
        'rating_count' => 'integer',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'includes' => 'array',
        'highlights' => 'array',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function departures(): HasMany
    {
        return $this->hasMany(TripDeparture::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(TripContent::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(TripMedia::class);
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(TripMedia::class)->where('media_type', 'gallery')->orderBy('sort_order');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    // Accessors
    public function getDurationAttribute(): string
    {
        return "{$this->duration_days}D{$this->duration_nights}N";
    }

    // Get next available departure
    public function getNextDepartureAttribute()
    {
        return $this->departures()
            ->whereIn('status', ['available', 'limited'])
            ->where('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->first();
    }

    // Get from_price (minimum price from next departure's variants)
    public function getFromPriceAttribute(): ?int
    {
        $nextDeparture = $this->next_departure;
        
        if (!$nextDeparture) {
            return null;
        }

        return $nextDeparture->variants()
            ->where('is_active', true)
            ->min('base_price');
    }
}
