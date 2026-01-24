<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripTemplate extends Model
{
    use HasFactory, SoftDeletes, \Spatie\Translatable\HasTranslations;

    public $translatable = [
        'title', 
        'destination', 
        'meta_title', 
        'meta_description', 
        // 'difficulty', // Difficulty e.g 'easy' is a key/value? In view I used select options 'easy', 'moderate'. These are keys. The label is translated in view. So difficulty should be SHARED.
        // Wait, check view for difficulty. <option value="easy">Easy</option>.
        // Shared.
        'highlights',
        'trip_facts'
    ];

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
        'thumbnail_landscape',
        'trip_itinerary_pdf',
        'trip_facts',
        'meta_title',
        'meta_description',
        'status',
        'is_popular',
        'popular_order',
        'created_by',
    ];

    protected $casts = [
        'rating_avg' => 'decimal:1',
        'rating_count' => 'integer',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'includes' => 'array',
        // 'highlights' => 'array', // Translatable
        // 'trip_facts' => 'array', // Translatable
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

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('popular_order')->orderBy('created_at', 'desc');
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

    public function gearLists(): HasMany
    {
        return $this->hasMany(TripMedia::class)->where('media_type', 'gear_list')->orderBy('sort_order');
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

    // Explicitly handle translatable array attributes
    public function getHighlightsAttribute($value)
    {
        // Try strict usage of Spatie's method. 
        // If recursion happens, it's because getTranslation accesses the property?
        // Let's decode manually as fallback if needed, but Spatie should work.
        // Debugging showed previously it returned raw array.
        
        // Safety check to prevent recursion if getTranslation uses accessor (it shouldn't)
        // Parse raw value directly
        $locale = app()->getLocale();
        
        // If value is null, return empty array?
        if (is_null($value)) return [];

        // If it's already an array (unlikely given no cast, but Laravel magic?), use it.
        // Actually $value passed to accessor IS the raw value from attributes array usually.
        // If it is JSON string:
        if (is_string($value)) {
            $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? [];
             }
        }
        
        // If it is array (already casted or decoded)
        if (is_array($value)) {
             return $value[$locale] ?? $value['en'] ?? $value['id'] ?? [];
        }

        return [];
    }

    public function getTripFactsAttribute($value)
    {
        $locale = app()->getLocale();
        
        if (is_string($value)) {
             $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? null;
             }
        }
        
        if (is_array($value)) {
             return $value[$locale] ?? $value['en'] ?? $value['id'] ?? null;
        }

        return null;
    }

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        // $value passed here is the raw attribute value
        if (is_string($value)) {
             $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? $value; 
             }
        }
        return $value;
    }

    public function getDestinationAttribute($value)
    {
        $locale = app()->getLocale();
        if (is_string($value)) {
             $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? $value;
             }
        }
        return $value;
    }

    public function getMetaTitleAttribute($value)
    {
        $locale = app()->getLocale();
        if (is_string($value)) {
             $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? $value;
             }
        }
        return $value;
    }

    public function getMetaDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        if (is_string($value)) {
             $decoded = json_decode($value, true);
             if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                  return $decoded[$locale] ?? $decoded['en'] ?? $decoded['id'] ?? $value;
             }
        }
        return $value;
    }
}
