<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicantID');
    }
    
    protected $fillable = ['file url', 'motivation content', 'status', 'reason' ];
}
