<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Club extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'abbreviationl',
        'location',
        'website',
        'about',
        'logo_url',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_club');
    }
}
