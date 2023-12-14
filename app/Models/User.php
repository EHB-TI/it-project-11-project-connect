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

    
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }


    protected $fillable = [
        'name',
        'role',
        'available',
    ];
}
