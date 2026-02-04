<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * List interviews
     */
    public function index()
    {
        $interviews = Interview::with(['candidate', 'interviewer'])
            ->latest()
            ->get();

        return view('interviews.index', compact('interviews'));
    }






    /**
     * Show schedule form
     */
    public function create()
    {
        return view('interviews.create', [
            'candidates' => Candidate::all(),
            'interviewers' => User::where('role', 'interviewer')->get()
        ]);
    }

    /**
     * Store interview
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'interviewer_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'round' => 'required'
        ]);

        Interview::create([
            'candidate_id' => $request->candidate_id,
            'interviewer_id' => $request->interviewer_id,
            'date' => $request->date,
            'time' => $request->time,
            'round' => $request->round,
            'status' => 'scheduled'
        ]);

        return redirect()->route('interviews.index')
            ->with('success', 'Interview scheduled successfully');
    }

}
