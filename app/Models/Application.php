<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;


class Application extends Model
{

    use HasFactory;

    public function applicant(): BelongsToAlias
    {
        return $this->belongsTo(User::class, 'applicantID');
    }

    protected $fillable = ['file url', 'motivation content', 'status', 'reason' ];
}
