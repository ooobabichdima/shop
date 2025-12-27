<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'is_filterable',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_filterable' => 'boolean',
        ];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
            ->withPivot(['value_string', 'value_number', 'value_bool'])
            ->withTimestamps();
    }
}
