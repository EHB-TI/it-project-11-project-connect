<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;

/**
 * Class NotificationUserStatus
 *
 * @package App\Models
 *
 * @property bool $seen
 * @property int $userID
 * @property int $notificationID
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Notification $notification
 */
class NotificationUserStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'seen',
        'userID',
        'notificationID'
    ];

    public function user(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function notification(): BelongsToAlias
    {
        return $this->belongsTo(Notification::class, 'notificationID');
    }
}
