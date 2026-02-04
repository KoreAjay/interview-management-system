<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'interview_id',
        'rating',
        'remarks',
        'result'
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
}
