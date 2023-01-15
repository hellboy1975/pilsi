<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Trip;
use App\Models\Cave;
use App\Models\User;

class Visit extends Model
{
    use HasFactory;

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cave(): BelongsTo
    {
        return $this->belongsTo(Cave::class, 'cave_id');
    }
}
