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
        'youtube_url',
        'color',
        'parent_variation_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
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

    // Alias for filtering
    public function attributeValues()
    {
        return $this->attributes();
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

    // Product variations (colors, sizes, etc.)
    public function variations()
    {
        return $this->belongsToMany(Product::class, 'product_variations', 'product_id', 'variation_id')
            ->withPivot(['variation_type', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    // Get all variations including self
    public function getAllVariations()
    {
        $variations = $this->variations;

        // If this product has a parent, get siblings
        if ($this->parent_variation_id) {
            $parent = Product::find($this->parent_variation_id);
            if ($parent) {
                return $parent->variations;
            }
        }

        return $variations;
    }

    // Parent variation relationship
    public function parentVariation()
    {
        return $this->belongsTo(Product::class, 'parent_variation_id');
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

    public function getYoutubeVideoId(): ?string
    {
        if (!$this->youtube_url) {
            return null;
        }

        // Extract video ID from various YouTube URL formats
        // https://www.youtube.com/watch?v=VIDEO_ID
        // https://youtu.be/VIDEO_ID
        // https://www.youtube.com/embed/VIDEO_ID

        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        if (preg_match($pattern, $this->youtube_url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
