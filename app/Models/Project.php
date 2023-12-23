<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyAlias;

/**
 * Class Project
 *
 * @package App\Models
 *
 * @property string $id
 * @property string $name
 * @property string $brief
 * @property string $description
 * @property int $user_id
 * @property string $status
 *
 * @property-read User $owner
 * @property-read Space $space
 * @property-read Collection|Feedback[] $feedback
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id', 'status','file_path'];


    public function owner(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function space(): BelongsToAlias
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function feedback(): HasManyAlias
    {
        return $this->hasMany(Feedback::class);
    }

    public function users(): BelongsToManyAlias
    {
        return $this->belongsToMany(User::class);
    }

    public function applications(): HasManyAlias
    {
        return $this->hasMany(Application::class);
    }

    public function discussions(): HasManyAlias
    {
        return $this->hasMany(Discussion::class);

    }
    public function reviews(): HasManyAlias
    {
        return $this->hasMany(Review::class);
    }

    public function applicationStatus(User $user): string
    {
        $application = $this->applications()->where('user_id', $user->id)->first();
        if ($application === null) {
            return 'could not find application status';
        }

        return $application->status;
    }

    public function isOwner(User $user): bool
    {
        // Check if the user is the owner of the project
        if ($this->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function isMember(User $user): bool
    {
        if ($this->users()->where('user_id', $user->id)->exists()) {
            return true;
        }

        return false;
    }

    public function canApply(User $user): bool
    {
        // Check if the user is the owner of the project or a teacher
        if ($this->isOwner($user) || $user->role === 'teacher') {
            return false;
        }

        // Check if the user is a product owner of any project in the same space as the project
        $space = $user->spaces()->where('space_id', $this->space_id)->first();
        if ($space) {
            $isProductOwnerInSpace = $space->projects()->where('user_id', $user->id)->exists();
            if ($isProductOwnerInSpace) {
                return false;
            }
        }

        // Check if the user is already a member of a project
        if ($user->isMemberOfAnyProject()) {
            return false;
        }

        // Check if the user has not already applied to the project
        if ($this->applications()->where('user_id', $user->id)->exists()) {
            return false;
        }

        return true;
    }

    public function hasApplied(User $user): bool
    {
        // Check if the user has already applied to the project
        if ($this->applications()->where('user_id', $user->id)->exists()) {
            return true;
        }

        return false;
    }



}
