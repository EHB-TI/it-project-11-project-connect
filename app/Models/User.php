<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

class User extends Authenticatable
{
    use HasFactory;

    public function applications(): HasManyAlias
    {
        return $this->hasMany(Application::class, 'applicantID');
    }

    public function projects(): HasManyAlias
    {
        return $this->hasMany(Project::class, 'ownerID');
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
