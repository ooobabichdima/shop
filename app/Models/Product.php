<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'old_price',
        'stock',
        'specs',
        'tuning_kits',
        'is_active',
        'is_featured',
        'is_new',
        'views',
        'rating',
        'reviews_count',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'old_price' => 'decimal:2',
            'specs' => 'array',
            'tuning_kits' => 'array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'rating' => 'decimal:2',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->withPivot(['value_string', 'value_number', 'value_bool'])
            ->withTimestamps();
    }

    // Рекомендуемые товары
    public function recommended()
    {
        return $this->belongsToMany(Product::class, 'product_relations', 'product_id', 'related_id')
            ->wherePivot('type', 'recommended')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    // Тюнинг-киты
    public function tuningKits()
    {
        return $this->belongsToMany(Product::class, 'product_relations', 'product_id', 'related_id')
            ->wherePivot('type', 'tuning_kit')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->old_price || $this->old_price <= $this->price) {
            return 0;
        }
        return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
