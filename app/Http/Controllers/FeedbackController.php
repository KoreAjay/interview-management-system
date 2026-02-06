<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create(Interview $interview)
    {
        return view('feedback.create', compact('interview'));
    }

    public function store(Request $request, Interview $interview)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'result' => 'required|in:selected,rejected',
            'remarks' => 'nullable|string'
        ]);

        Feedback::create([
            'interview_id' => $interview->id,
            'rating' => $request->rating,
            'result' => $request->result,
            'remarks' => $request->remarks,
        ]);

        $interview->update(['status' => 'completed']);

        return redirect()->route('interviewer.dashboard')
            ->with('success', 'Feedback submitted successfully');
    }
    public function updates()
{
    $interviews = Interview::with([
        'candidate',
        'interviewer',
        'feedback'
    ])->latest()->get();

    return view('admin.interview-updates', compact('interviews'));
}

}
