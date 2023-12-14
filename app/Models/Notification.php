<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function statuses()
    {
        return $this->hasMany(NotificationUserStatus::class);
    }

    protected $fillable = [
        'content',
    ];
}
