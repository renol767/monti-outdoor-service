<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripContent extends Model
{
    use HasFactory, \Spatie\Translatable\HasTranslations;

    public $translatable = ['content_html', 'content_delta'];

    protected $fillable = [
        'trip_template_id',
        'tab_type',
        'content_html',
        'content_delta',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        // 'content_delta' => 'array', // Removed as handled by HasTranslations (or should be?)
        // content_delta is JSON. Spatie handles it if it's in translatable.
        // But Spatie expects the *value* of the translation to be the type.
        // If content_delta is an array/object, Spatie supports it.
        'version' => 'integer',
    ];

    // Tab types
    const TAB_OVERVIEW = 'overview';
    const TAB_INCLUDE_EXCLUDE = 'include_exclude';
    const TAB_ITINERARY = 'itinerary';
    // Note: Terms & Conditions removed - now uses global T&C from landing_settings

    public static function tabTypes(): array
    {
        return [
            self::TAB_OVERVIEW,
            self::TAB_INCLUDE_EXCLUDE,
            self::TAB_ITINERARY,
        ];
    }

    // Relationships
    public function tripTemplate(): BelongsTo
    {
        return $this->belongsTo(TripTemplate::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scope - get latest version
    public function scopeLatest($query)
    {
        return $query->orderBy('version', 'desc');
    }
}
