<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUserStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'seen',
        'userID',
        'notificationID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notificationID');
    }
}
