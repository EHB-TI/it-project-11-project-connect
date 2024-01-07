<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

use Auth;

/**
 * Class Notification
 *
 * @package App\Models
 *
 * @property string $content
 *
 * @property-read Collection|NotificationUserStatus[] $statuses
 */
class Notification extends Model
{
    use HasFactory;

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function statuses(): HasManyAlias
    {
        return $this->hasMany(NotificationUserStatus::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'Notification_user_statuses')
                ->using(NotificationUserStatus::class)
                ->withPivot('seen')
                ->withTimestamps();
}

public function seen($userId)
{
    return $this->users()->where('user_id', $userId)->wherePivot('seen', true)->exists();
}

    protected $fillable = [
        'content',
        'route',
        'space_id',
    ];
}
