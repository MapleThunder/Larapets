<?php

namespace App\Models;

use App\Enums\PetColourEnum;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'species',
        'colour',
        'full_hunger',
        'current_hunger',
        'full_health',
        'current_health',
        'level',
        'experience',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'colour' => PetColourEnum::class,
        ];
    }
}
