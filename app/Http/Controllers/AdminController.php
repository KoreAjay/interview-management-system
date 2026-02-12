<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Interview;

class AdminController extends Controller
{
    /* DASHBOARD */
    public function dashboard()
    {
        return view('admin.dashboard', [

            'totalCandidates' =>
                Candidate::count(),

            'pendingCandidates' =>
                Candidate::where('status','pending')->count(),

            'selectedCandidates' =>
                Candidate::where('status','selected')->count(),

            'rejectedCandidates' =>
                Candidate::where('status','rejected')->count(),

            'totalInterviews' =>
                Interview::count(),

            'scheduledInterviews' =>
                Interview::where('status','scheduled')->count(),

            'completedInterviews' =>
                Interview::where('status','completed')->count(),
        ]);
    }

    /* FINAL RESULTS */
    public function results(Request $request)
    {
        $query = Interview::with([
            'candidate',
            'interviewer',
            'feedback'
        ])
        ->whereHas('feedback'); // Only completed feedback

        if($request->status){
            $query->whereHas('feedback', function($q) use ($request){
                $q->where('result',$request->status);
            });
        }

        $interviews = $query->latest()->get();

        return view('admin.results', compact('interviews'));
    }
}
