<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Region;
use App\Models\User;

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
}
