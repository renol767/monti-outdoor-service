<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'departure_id',
        'variant_id',
        'pax_count',
        'subtotal',
        'discount_amount',
        'addons_total',
        'total_amount',
        'status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'pax_count' => 'integer',
        'subtotal' => 'integer',
        'discount_amount' => 'integer',
        'addons_total' => 'integer',
        'total_amount' => 'integer',
        'paid_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';

    // Scopes
    public function scopePaid($query)
    {
        return $query->whereIn('status', [self::STATUS_PAID, self::STATUS_CONFIRMED]);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function departure(): BelongsTo
    {
        return $this->belongsTo(TripDeparture::class, 'departure_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(DepartureVariant::class, 'variant_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addons(): HasMany
    {
        return $this->hasMany(OrderAddon::class);
    }

    // Accessors
    public function getFormattedTotalAttribute(): string
    {
        return 'IDR ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending Payment',
            self::STATUS_PAID => 'Paid',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_REFUNDED => 'Refunded',
            default => ucfirst($this->status),
        };
    }

    // Generate unique order number
    public static function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return "ORD-{$date}-{$random}";
    }

    // Boot method for auto-generating order number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
        });
    }
}
