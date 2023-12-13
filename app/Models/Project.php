<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'ownerID');
    }

    public function space()
    {
        return $this->belongsTo(Space::class, 'spaceID');
    }

    protected $fillable = [
        'name',
        'description',
        'status',
        'ownerID',
        'spaceID'
    ];
}
