<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyAlias;

/**
 * Class Space
 *
 * @package App\Models
 *
 * @property string $name
 * @property int $canvasCourseId
 * @property int $defaultTeamSize
 *
 * @property-read Collection|Project[] $projects
 * @property-read Collection|User[] $users
 */
class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'canvasCourseId',
        'defaultTeamSize',
    ];

    public function projects(): HasManyAlias
    {
        return $this->hasMany(Project::class);
    }

    public function users(): BelongsToManyAlias
    {
        return $this->belongsToMany(User::class);
    }




}
