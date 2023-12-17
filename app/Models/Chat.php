<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

/**
 * Class Chat
 *
 * @package App\Models
 *
 * @property string $message
 *
 * @property-read Collection|User[] $users
 */
class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'message'
    ];
    public function users(): hasManyAlias
    {
        return $this->hasMany(User::class);
    }
}
