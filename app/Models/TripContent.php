<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_template_id',
        'tab_type',
        'content_delta',
        'content_html',
        'version',
        'updated_by',
    ];

    protected $casts = [
        'content_delta' => 'array', // JSON cast
        'version' => 'integer',
    ];

    // Tab types
    const TAB_OVERVIEW = 'overview';
    const TAB_INCLUDE_EXCLUDE = 'include_exclude';
    const TAB_ITINERARY = 'itinerary';
    const TAB_TERMS = 'terms';

    public static function tabTypes(): array
    {
        return [
            self::TAB_OVERVIEW,
            self::TAB_INCLUDE_EXCLUDE,
            self::TAB_ITINERARY,
            self::TAB_TERMS,
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
