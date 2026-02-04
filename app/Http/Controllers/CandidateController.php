<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Admin: List candidates
     */
    public function index()
    {
        $candidates = Candidate::latest()->get();
        return view('candidate.index', compact('candidates'));
    }



    /**
     * Admin: Create form
     */
    public function create()
    {
        return view('candidate.create'); // ✅ FIXED
    }

    /**
     * Admin: Store candidate
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:candidates',
            'phone' => 'required',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->hasFile('resume')) {
            $filename = time() . '_' . $request->resume->getClientOriginalName();
            $request->resume->move(public_path('resumes'), $filename);
            $data['resume'] = $filename;
        }

        $data['status'] = 'pending';

        Candidate::create($data);

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate added successfully');
    }

    /**
     * Admin: Edit candidate
     */
    public function edit(Candidate $candidate)
    {
        return view('candidate.edit', compact('candidate')); // ✅ FIXED
    }

    /**
     * Candidate: Profile page
     */
    public function profile()
    {
        $user = auth()->user();
        $candidate = Candidate::where('email', $user->email)->first();

        return view('candidate.profile', compact('user', 'candidate'));
    }

    /**
     * Candidate: Update profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = auth()->user();
        $oldEmail = $user->email;

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Find candidate using OLD email
        $candidate = Candidate::where('email', $oldEmail)->first();

        if (!$candidate) {
            $candidate = Candidate::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 'pending',
            ]);
        } else {
            $candidate->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        // Profile image
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profiles', 'public');
            $candidate->profile_image = $path;
        }

        // Resume
        if ($request->hasFile('resume')) {
            $filename = time() . '_' . $request->resume->getClientOriginalName();
            $request->resume->move(public_path('resumes'), $filename);
            $candidate->resume = $filename;
        }

        $candidate->save();

        return redirect()->route('candidate.dashboard')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Admin: Update candidate status
     */
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => 'required|in:pending,selected,rejected'
        ]);

        $candidate->update(['status' => $request->status]);

        return back()->with('success', 'Status updated');
    }

    /**
     * Admin: Delete candidate
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate deleted');
    }
}
