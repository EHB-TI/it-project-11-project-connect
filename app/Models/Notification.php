<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

/**
 * Class Notification
 *
 * @package App\Models
 *
 * @property string $content
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NotificationUserStatus[] $statuses
 */
class Notification extends Model
{
    use HasFactory;

    public function statuses(): HasManyAlias
    {
        return $this->hasMany(NotificationUserStatus::class);
    }

    protected $fillable = [
        'content',
    ];
}
