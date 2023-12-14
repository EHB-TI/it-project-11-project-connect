<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function applications()
    {
        return $this->hasMany(Application::class, 'applicantID');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    protected $fillable = [
        'name',
        'role',
        'available',
    ];
}
