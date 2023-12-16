<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
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
