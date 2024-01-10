<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    protected $fillable = ['notes', 'start_date', 'end_date', 'duration', 'party_leader', 'party_leader_id', 'trip_id', 'cave_id', 'user_id'];

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
