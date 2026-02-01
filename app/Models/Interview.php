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
    'round',
    'date',
    'time',
    'status'
];

    public function candidate() {
    return $this->belongsTo(Candidate::class);
}

public function interviewer() {
    return $this->belongsTo(Interviewer::class);
}

public function feedback() {
    return $this->hasOne(Feedback::class);
}

}
