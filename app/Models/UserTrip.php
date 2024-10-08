<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTrip extends Model
{
    protected $fillable = ['trip_id', 'user_id'];

    public function trips(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
