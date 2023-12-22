<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

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

    public function statuses(): HasManyAlias
    {
        return $this->hasMany(NotificationUserStatus::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'notification_user_statuses')
                ->using(NotificationUserStatus::class)
                ->withPivot('seen')
                ->withTimestamps();
}

    protected $fillable = [
        'content',
    ];
}
