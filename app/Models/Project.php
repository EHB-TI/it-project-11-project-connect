<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;

/**
 * Class Project
 *
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property string $brief
 * @property string $description
 * @property int $owner_id
 * @property string $status
 *
 * @property-read User $owner
 * @property-read Space $space
 * @property-read Collection|Feedback[] $feedback
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'owner_id', 'status'];


    public function owner(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function space(): BelongsToAlias
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function feedback(): HasManyAlias
    {
        return $this->hasMany(Feedback::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
