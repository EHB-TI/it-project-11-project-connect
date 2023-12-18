<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;

/**
 * Class Application
 *
 * @package App\Models
 *
 * @property string $fileurl
 * @property string $motivationContent
 * @property string $status
 * @property string $reason
 *
 * @property-read User $applicant
 * @property-read Project $project
 */
class Application extends Model
{

    use HasFactory;

    public $timestamps = true;


    public function applicant(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project(): BelongsToAlias
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    protected $fillable = ['file_path', 'motivationContent','status','reason','user_id'];
}
