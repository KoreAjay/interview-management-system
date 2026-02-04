<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

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

    // ✅ interviewer is a USER
    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
