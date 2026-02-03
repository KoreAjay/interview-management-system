<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $candidates = Candidate::latest()->get();
    return view('candidates.index', compact('candidates'));
}


    /**
     * Show the form for creating a new resource.
     */
    
 public function create()
{
    return view('candidates.create');
}


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:candidates',
        'phone' => 'required',
        'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('resume')) {
        $file = $request->file('resume');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('resumes'), $filename);
        $data['resume'] = $filename;
    }

    Candidate::create($data);

    return redirect()->route('candidates.index')
        ->with('success','Candidate added successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
{
    return view('candidates.edit', compact('candidate'));
}

public function profile()
{
    $user = auth()->user();
    $candidate = Candidate::where('email', $user->email)->first();

    return view('candidate.profile', compact('user', 'candidate'));
}


    /**
     * Update the specified resource in storage.
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

    // Update user table
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Get or create candidate safely (NO DB ERROR)
    $candidate = Candidate::where('email', $user->email)->first();

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
        $file = $request->file('resume');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('resumes'), $filename);
        $candidate->resume = $filename;
    }

    $candidate->save();

    return redirect()->route('candidate.dashboard')
        ->with('success', 'Profile updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Candidate $candidate)
{
    $candidate->delete();
    return redirect()->route('candidates.index')
        ->with('success','Candidate deleted');
}

}
