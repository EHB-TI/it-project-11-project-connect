<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'owner_id', 'status'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
