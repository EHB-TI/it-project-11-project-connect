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
 * @property string $what
 * @property string $end_date
 * @property int $space_id
 *
 * @property-read Space $space
 */
class Deadline extends Model
{
    use HasFactory;

    public function space(): belongsToAlias
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public static function findDeadline($what)
    {
       return self::where('what', $what)->orderBy('end_date', 'asc')->first();
    }

    public function nextDeadlineForSpace($space_id)
    {
        return $this->where('space_id', $space_id)
                    ->where('end_date', '>', now())
                    ->orderBy('end_date', 'asc')
                    ->first();
    }    

    protected $fillable = [
        'title',
        'what',
        'end_date',
        'space_id',
    ];

}
