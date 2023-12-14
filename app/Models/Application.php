<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{

    use HasFactory;

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicantID');
    }

    protected $fillable = ['file', 'content', 'status', 'reason' ];
}
