<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'departure_addon_id',
        'addon_name',
        'unit_price',
        'quantity',
        'total_price',
    ];

    protected $casts = [
        'unit_price' => 'integer',
        'quantity' => 'integer',
        'total_price' => 'integer',
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function departureAddon(): BelongsTo
    {
        return $this->belongsTo(DepartureAddon::class);
    }
}
