<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;

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


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Candidate $candidate)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
    ]);

    $candidate->update($request->all());

    return redirect()->route('candidates.index')
        ->with('success','Candidate updated');
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
