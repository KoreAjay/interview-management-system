<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Interview;
use App\Models\Feedback;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'candidates' => Candidate::count(),
            'interviews' => Interview::count(),
            'selected' => Feedback::where('result', 'selected')->count(),
            'rejected' => Feedback::where('result', 'rejected')->count(),
        ]);
    }
    public function results()
    {
        $candidates = Candidate::with([
            'interviews.feedback',
            'interviews.interviewer' // Removed .user if interviewer IS the user
        ])
            ->whereIn('status', ['selected', 'rejected'])
            ->get();

        return view('admin.results', compact('candidates'));
    }
}
