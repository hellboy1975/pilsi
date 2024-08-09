<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVisit extends Model
{
    protected $fillable = ['visit_id', 'user_id'];


    public function visits(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
