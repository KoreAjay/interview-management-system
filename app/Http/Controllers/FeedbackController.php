<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Feedback;
use App\Models\Candidate;
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

        /* 1️⃣ SAVE FEEDBACK */
        $feedback = Feedback::create([
            'interview_id' => $interview->id,
            'rating'       => $request->rating,
            'result'       => $request->result,
            'remarks'      => $request->remarks ?? ''   // ✅ FIX NULL ERROR
        ]);

        /* 2️⃣ UPDATE INTERVIEW STATUS */
        $interview->update([
            'status' => 'completed'
        ]);

        /* 3️⃣ AUTO UPDATE CANDIDATE STATUS */
        $candidate = Candidate::find($interview->candidate_id);

        if ($candidate) {
            $candidate->update([
                'status' => $request->result   // selected / rejected
            ]);
        }

        return redirect()
            ->route('interviewer.dashboard')
            ->with('success', 'Feedback submitted & Candidate status updated');
    }
}
