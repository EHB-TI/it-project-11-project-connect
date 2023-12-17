<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo as belongsToAlias;

/**
 * Class Deadline
 *
 * @package App\Models
 *
 * @property string $title
 * @property string $who
 * @property string $what
 * @property string $end_date
 * @property int $spaceID
 *
 * @property-read Space $space
 */
class Deadline extends Model
{
    use HasFactory;

    public function space(): belongsToAlias
    {
        return $this->belongsTo(Space::class, 'spaceID');
    }

    protected $fillable = [
        'title',
        'who',
        'what',
        'end_date',
        'spaceID',
    ];

}
