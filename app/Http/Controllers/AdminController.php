<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Interview;
use App\Models\Feedback;

class AdminController extends Controller
{
    //
    public function dashboard() {
    return view('dashboard',[
        'candidates' => Candidate::count(),
        'interviews' => Interview::count(),
        'selected' => Feedback::where('result','selected')->count(),
        'rejected' => Feedback::where('result','rejected')->count(),
    ]);
}

}
