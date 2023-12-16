<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
use \Illuminate\Database\Eloquent\Relations\belongsToMany as belongsToManyAlias;
/**
 * Class User
 *
 * @package App\Models
 *
 * @property string $name
 * @property string $role
 * @property bool $available
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feedback[] $feedback
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 */
class User extends Authenticatable
{
    use HasFactory;

    public function applications(): HasManyAlias
    {
        return $this->hasMany(Application::class, 'applicantID');
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


    protected $fillable = [
        'name',
        'role',
        'available',
    ];
}
