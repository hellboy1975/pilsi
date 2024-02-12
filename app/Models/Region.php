<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'country_code',
        'description',
    ];

    public function caves(): HasMany
    {
        return $this->hasMany(Cave::class, 'region_id');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'region_id');
    }

    public function favourite(): MorphOne
    {
        return $this->morphOne(UserFavourite::class, 'entity');
    }
}
