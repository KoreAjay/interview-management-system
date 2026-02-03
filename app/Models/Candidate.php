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
        'phone',
        'address',
        'resume',
        'profile_image',
        'status',
    ];

    public function interviews()
    {
        return $this->hasMany(\App\Models\Interview::class);
    }
}
