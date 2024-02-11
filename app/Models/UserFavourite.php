<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFavourite extends Model
{
    use HasFactory;

    protected $table = 'user_favourites';

    protected $fillable = ['user_id', 'entity_id', 'entity_type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
