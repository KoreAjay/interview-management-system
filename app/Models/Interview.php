<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'candidate_id',
        'interviewer_id',
        'round',
        'mode',
        'date',
        'time',
        'meeting_link',
        'status'
    ];


public function candidate()
{
    return $this->belongsTo(Candidate::class);
}

public function interviewer()
{
    return $this->belongsTo(User::class,'interviewer_id');
}

public function feedback()
{
    return $this->hasOne(Feedback::class);
}

}
