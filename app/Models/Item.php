<?php

namespace App\Models;

use App\Enums\ItemTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'item_type',
        'effect'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'item_type' => ItemTypeEnum::class,
        ];
    }
}
