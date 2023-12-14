<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use HasFactory;

    public function space()
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
