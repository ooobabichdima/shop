<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'options',
        'sort_order',
        'is_filterable',
        'is_active',
    ];

    protected $casts = [
        'options' => 'array',
        'is_filterable' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_category')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderBy('attribute_category.sort_order');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product')
            ->withPivot('value')
            ->withTimestamps();
    }
}
