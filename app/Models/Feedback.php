<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;

/**
 * Class Feedback
 *
 * @package App\Models
 *
 * @property string $message
 *
 * @property-read \App\Models\User $owner
 */
class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'message'

    ];

    public function owner(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
