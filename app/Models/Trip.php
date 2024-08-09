<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = ['name', 'region_id', 'user_id', 'trip_leader', 'trip_leader_id', 'notes', 'start_date', 'end_date'];

    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Users are the attendees on a trip
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_trips');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'trip_id');
    }

    public function user_trips(): HasMany
    {
        return $this->hasMany(UserTrip::class, 'trip_id');
    }
}
