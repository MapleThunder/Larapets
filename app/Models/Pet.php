<?php

namespace App\Models;

use App\Enums\PetColourEnum;
use App\Enums\PetSpeciesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    /**
     * Default stats for new pets
     */
    const DEFAULT_STATS = [
        'hunger' => 100,
        'health' => 100,
        'level' => 1,
        'experience' => 0
    ];

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
            'species' => PetSpeciesEnum::class,
        ];
    }

    /**
     * Create a new pet for a user with the given attributes
     *
     * @param User $user
     * @param array $attributes
     * @return Pet
     */
    public static function createForUser(User $user, array $attributes): Pet
    {
        $pet = new static();
        $pet->fill($attributes);
        $pet->user_id = $user->id;
        $pet->initializeDefaultStats();
        $pet->save();
        
        return $pet;
    }

    /**
     * Initialize default stats for a new pet
     *
     * @return void
     */
    public function initializeDefaultStats(): void
    {
        $this->full_hunger = self::DEFAULT_STATS['hunger'];
        $this->current_hunger = self::DEFAULT_STATS['hunger'];
        $this->full_health = self::DEFAULT_STATS['health'];
        $this->current_health = self::DEFAULT_STATS['health'];
        $this->level = self::DEFAULT_STATS['level'];
        $this->experience = self::DEFAULT_STATS['experience'];
    }

    /**
     * Check if a pet name is unique across all pets
     *
     * @param string $name
     * @return bool
     */
    public static function isNameUnique(string $name): bool
    {
        return !static::where('name', $name)->exists();
    }

    /**
     * Get the user that owns the pet
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
