<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'city',
        'phone',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_warehouse')
            ->withPivot(['quantity', 'reserved'])
            ->withTimestamps();
    }

    // Отримати доступну кількість товару (quantity - reserved)
    public function getAvailableQuantity($productId)
    {
        $pivot = $this->products()->where('product_id', $productId)->first()?->pivot;
        if (!$pivot) return 0;
        return max(0, $pivot->quantity - $pivot->reserved);
    }
}
