<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;

/**
 * Class NotificationUserStatus
 *
 * @package App\Models
 *
 * @property bool $seen
 * @property int $user_id
 * @property int $notification_id
 *
 * @property-read User $user
 * @property-read Notification $notification
 */
class NotificationUserStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'seen',
        'user_id',
        'notification_id'
    ];

    public function user(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notification(): BelongsToAlias
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
