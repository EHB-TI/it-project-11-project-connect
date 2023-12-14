<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{

    use HasFactory;

    public $timestamps = true;

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicantID');
    }

    protected $fillable = ['fileurl', 'motivationContent','status','reason' ];
}
