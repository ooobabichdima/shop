<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'answers',
        'status',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
        ];
    }
}
