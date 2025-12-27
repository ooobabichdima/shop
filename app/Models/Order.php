<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'user_id',
        'customer_name',
        'phone',
        'email',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'shipping_provider',
        'shipping_city',
        'shipping_ref',
        'shipping_address',
        'promo_code',
        'comment',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }

    public function isPaid(): bool
    {
        return $this->payments()->where('status', 'success')->exists();
    }

    public static function generateOrderNumber(): string
    {
        return 'ORDER-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
    }
}
