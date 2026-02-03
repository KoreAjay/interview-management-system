<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Interview extends Model
{
    protected $fillable = [
        'candidate_id',
        'interviewer_id',
        'date',
        'time',
        'round',
        'status'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}