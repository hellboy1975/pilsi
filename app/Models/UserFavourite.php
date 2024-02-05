<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavourite extends Model
{
    use HasFactory;

    protected $table = 'user_favourite';

    protected $fillable = ['user_id', 'entity_id', 'entity_type'];

}
