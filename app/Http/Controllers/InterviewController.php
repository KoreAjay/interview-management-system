<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Interview;
use App\Models\Interviewer;
use App\Models\User;

class InterviewController extends Controller
{
    /* Show Pending Candidates */
public function index()
{
    // Show ONLY pending candidates
    $candidates = Candidate::where('status','pending')->get();

    return view('interviews.index', compact('candidates'));
}



    /* Schedule Form */
    public function create($candidate_id)
    {
        $candidate = Candidate::findOrFail($candidate_id);

        // Fetch users with interviewer role
        $interviewers = User::where('role', 'interviewer')->get();

        return view('interviews.create', compact('candidate', 'interviewers'));
    }

    /* Store Interview */
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required',
            'interviewer_id' => 'required',
            'round' => 'required',
            'mode' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'meeting_link' => 'nullable'
        ]);

            Interview::create([
        'candidate_id'   => $request->candidate_id,
        'interviewer_id' => $request->interviewer_id,
        'round'          => $request->round,
        'mode'           => $request->mode,
        'meeting_link'   => $request->meeting_link, // ✅ SAVE
        'date'           => $request->date,
        'time'           => $request->time,
        'status'         => 'scheduled'
    ]);

        return redirect()
            ->route('interviews.index')
            ->with('success', 'Interview Scheduled');
    }
}
