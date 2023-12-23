<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
use Illuminate\Database\Eloquent\Relations\belongsToMany as belongsToManyAlias;

use Auth;
/**
 * Class User
 *
 * @package App\Models
 *
 * @property string $name
 * @property string $role
 * @property bool $available
 *
 * @property-read Collection|Application[] $applications
 * @property-read Collection|Project[] $projects
 * @property-read Collection|Feedback[] $feedback
 * @property-read Collection|Chat[] $chat
 * @property-read Collection|Notification[] $notifications
 */
class User extends Authenticatable
{
    use HasFactory;

    public function applications(): HasManyAlias
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    public function projects(): belongsToManyAlias
    {
        return $this->belongsToMany(Project::class);
    }
    public function feedback(): HasManyAlias
    {
        return $this->hasMany(Feedback::class);
    }
    public function chat(): HasManyAlias
    {
        return $this->hasMany(Chat::class);
    }

    public function notifications(): HasManyAlias
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function spaces(): BelongsToManyAlias
    {
        return $this->belongsToMany(Space::class);
    }

    public function reviews(): HasManyAlias
    {
        return $this->hasMany(Review::class);
    }

    public function isMemberOfAnyProject(): bool
    {
        return $this->projects()->exists();
    }

    public function hasRole($role): bool
    {
        return Auth::user()->role == $role;
    }


    protected $fillable = [
        'name',
        'role',
        'available',
    ];
}
