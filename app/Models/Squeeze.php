<?php

namespace App\Models;

use App\Models\Cave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Squeeze extends Model
{
    protected $fillable = ['name', 'cave_id', 'pilsi', 'description', 'user_id'];
    use HasFactory;

    public function cave(): BelongsTo
    {
        return $this->belongsTo(Cave::class, 'cave_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class, 'attempt_id');
    }
}
