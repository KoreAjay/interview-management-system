<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'position',
        'experience',
        'current_company',
        'notice_period',
        'current_ctc',
        'expected_ctc',
        'location',
        'resume',
        'status',
        'applied_at'
    ];

    /* RELATIONS */

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }
}
