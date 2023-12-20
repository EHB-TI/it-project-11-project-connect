<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
 * @property-read Collection|Deadline[] $deadlines
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

    public function deadlines(): HasManyAlias
    {
        return $this->hasMany(Deadline::class);
    }

    public function getCourseUsers($courseId) {
        // Use Guzzle to create a mock API request
        $client = new Client();

        // Mock API endpoint - replace with actual Canvas API endpoint
        $url = 'https://mock-canvas-api.com/courses/' . $courseId . '/users';

        try {
            $response = $client->request('GET', $url);

            // Parse the response body and return the users
            $users = json_decode($response->getBody(), true);

            return $users;
        } catch (GuzzleException $e) {
            // Handle exception - e.g., log the error message
            error_log($e->getMessage());

            // Return an empty array as a fallback
            return [];
        }
    }


}
