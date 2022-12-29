<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cave extends Model
{
    protected $fillable = ['name', 'region_id', 'code', 'description'];

    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
