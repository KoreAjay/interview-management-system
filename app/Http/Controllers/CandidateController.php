<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Admin: List Candidates
     */
    public function index()
    {
        $candidates = Candidate::where('status','pending')->latest()->get();
        return view('candidate.index', compact('candidates'));
    }

    /**
     * Admin: Show Create Form
     */
    public function create()
    {
        return view('candidate.create');
    }

    /**
     * Admin: Store Candidate
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:candidates,email',
    ]);

    $resumeName = null;

    if ($request->hasFile('resume')) {
        $resumeName = time().'.'.$request->resume->extension();
        $request->resume->move(public_path('resumes'), $resumeName);
    }

    Candidate::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'position' => $request->position,
        'experience' => $request->experience,
        'current_company' => $request->current_company,
        'notice_period' => $request->notice_period,
        'current_ctc' => $request->current_ctc,
        'expected_ctc' => $request->expected_ctc,
        'location' => $request->location,
        'resume' => $resumeName,
        'status' => 'pending',
        'applied_at' => now(),
    ]);

    return redirect()
        ->route('candidates.index')
        ->with('success','Candidate Added Successfully');
}

    
    /**
     * Admin: Edit Candidate
     */
    public function edit(Candidate $candidate)
    {
        return view('candidate.edit', compact('candidate'));
    }

    /**
     * Admin: Update Candidate
     */
    public function update(Request $request, Candidate $candidate)
    {
        $candidate->update($request->all());

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate updated');
    }

    /**
     * Admin: Delete Candidate
     */
    public function destroy(Candidate $candidate)
    {
        if ($candidate->resume) {
            @unlink(public_path('resumes/' . $candidate->resume));
        }

        $candidate->delete();

        return back()->with('success', 'Candidate deleted');
    }

    /**
     * Admin: Update Status
     */
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $candidate->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated');
    }
}
