<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class Cave extends Model
{
    protected $fillable = ['name', 'region_id', 'code', 'description', 'main_picture'];

    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
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

    public function favourite(): MorphOne
    {
        return $this->morphOne(UserFavourite::class, 'entity');
    }

    protected static function booted()
    {
        // when creating a cave this sets the creator_id to that of the current user
        static::creating(function ($model) {
            $model->creator_id = Auth::id();
        });
    }
}
