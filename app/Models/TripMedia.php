<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_template_id',
        'media_type',
        'file_path',
        'alt_text',
        'is_cover',
        'sort_order',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Media types
    const TYPE_GALLERY = 'gallery';
    const TYPE_TRACKING_MAP = 'tracking_map';
    const TYPE_THUMBNAIL = 'thumbnail';

    // Scopes
    public function scopeGallery($query)
    {
        return $query->where('media_type', self::TYPE_GALLERY)->orderBy('sort_order');
    }

    public function scopeTrackingMap($query)
    {
        return $query->where('media_type', self::TYPE_TRACKING_MAP);
    }

    // Relationships
    public function tripTemplate(): BelongsTo
    {
        return $this->belongsTo(TripTemplate::class);
    }

    // Accessor
    public function getUrlAttribute(): string
    {
        return asset($this->file_path);
    }
}
