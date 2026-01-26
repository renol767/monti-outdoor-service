<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripTypeSection extends Model
{
    use HasFactory, \Spatie\Translatable\HasTranslations;

    public $translatable = ['title', 'subtitle', 'content_html', 'content_full'];

    protected $fillable = [
        'category',
        'slug',
        'title',
        'subtitle',
        'subtitle',
        'content_html', // Highlight (no images allowed via UI, but safe to allow basic tags)
        'content_full', // Full (images allowed)
        'images',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        // content_full cast removed to prevent conflict with Translatable array
    ];

    // Categories
    const CATEGORY_MOUNTAIN = 'mountain';
    const CATEGORY_OUTDOOR = 'outdoor';
    const CATEGORY_INDOOR = 'indoor';

    public static function categories(): array
    {
        return [
            self::CATEGORY_MOUNTAIN => 'Mountain Trip',
            self::CATEGORY_OUTDOOR => 'Outdoor Activity Trip',
            self::CATEGORY_INDOOR => 'Indoor Activity Trip',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Helpers
    public function getFirstImageAttribute(): ?string
    {
        $images = $this->images ?? [];
        return !empty($images) ? $images[0] : null;
    }
}
