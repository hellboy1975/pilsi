<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cave extends Model
{
    protected $fillable = ['name', 'region_id', 'code', 'description', 'main_picture'];

    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function squeezes(): HasMany
    {
        return $this->hasMany(Squeeze::class, 'cave_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'cave_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(UserFavourite::class, 'entity_id')->where('entity_type', static::class);
    }
}
