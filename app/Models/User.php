<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'display_name',
        'avatar_url',
        'bio',
        'roles',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function squeezes(): HasMany
    {
        return $this->hasMany(Squeeze::class, 'user_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class, 'attempt_id');
    }

    public function clubs(): BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'user_club');
    }

    public function trips(): HasMany
    {
        return $this->hasMany(UserTrip::class, 'user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            // return str_ends_with($this->email, '@pilsi.info');
        }

        return true;
    }

    public function favouritesByEntity(string $entityType): HasMany
    {
        return $this->HasMany(UserFavourite::class)->where('entity_type', $entityType);
    }

    /**
     * Filters the favourites by caves
     *
     * @return HasMany
     */
    public function favourite_caves(): HasMany
    {
        return $this->favouritesByEntity(Cave::class);
    }

    /**
     * Returns all of the favourites belonging to a User
     */
    public function favourites(): HasMany
    {
        return $this->hasMany(UserFavourite::class);

    }

    public function hasLiked(Model $entity): bool
    {

        return $this->favouritesByEntity($entity::class)->where('entity_id', $entity->id)->exists();
    }

    /**
     * Toggles a user_favourites record for the current logged in user
     *
     * @return bool the current state of this favourite
     */
    public static function toggleFavourite(Model $entity): bool
    {
        $state = false;
        $fav = UserFavourite::where([
            ['user_id', Auth::id()],
            ['entity_id', $entity->id],
            ['entity_type', $entity::class],
        ]);

        if ($fav->exists()) {
            // delete the record
            $fav->delete();
        } else {
            $fav = new UserFavourite;
            $fav->entity_id = $entity->id;
            $fav->user_id = Auth::id();
            $fav->entity_type = $entity::class;
            $fav->save();

            $state = true;
        }

        return $state;
    }

    /**
     * checks to see if the current use has a favourite for this entity
     */
    public static function hasFavourite(Model $entity): bool
    {
        return UserFavourite::where([
            ['user_id', Auth::id()],
            ['entity_id', $entity->id],
            ['entity_type', $entity::class], // probs shouldn't hardcode this
        ])->exists();
    }
}
