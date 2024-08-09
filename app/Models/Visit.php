<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Users are the attendees on a Visit
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_visits');
    }

    public function cave(): BelongsTo
    {
        return $this->belongsTo(Cave::class, 'cave_id');
    }
}
