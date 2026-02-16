<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    /* =========================
       INDEX
    ==========================*/
    public function index(Request $request)
    {
        $availablePositions = Candidate::distinct()
            ->whereNotNull('position')
            ->pluck('position')
            ->sort();

        $query = Candidate::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filters
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $candidates = $query->latest()->get();

        return view('candidates.index', compact(
            'candidates',
            'availablePositions'
        ));
    }


    /* =========================
       CREATE
    ==========================*/
    public function create()
    {
        // MUST be plural (resource standard)
        return view('candidate.create');
    }


    /* =========================
       STORE
    ==========================*/
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:candidates,email',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->all();

        // Upload Resume
        if ($request->hasFile('resume')) {
            $data['resume'] = $request
                ->file('resume')
                ->store('resumes', 'public');
        }

        $data['status'] = 'pending';

        Candidate::create($data);

        return redirect()
            ->route('candidates.index')
            ->with('success', 'Candidate Added Successfully');
    }


    /* =========================
       SHOW
    ==========================*/
    public function show(Candidate $candidate)
    {
        return view('candidates.show', compact('candidate'));
    }


    /* =========================
       EDIT
    ==========================*/
    public function edit(Candidate $candidate)
    {
        return view('candidates.edit', compact('candidate'));
    }


    /* =========================
       UPDATE
    ==========================*/
    public function update(Request $request, Candidate $candidate)
    {
        $data = $request->all();

        if ($request->hasFile('resume')) {

            // Delete old resume safely
            if ($candidate->resume &&
                Storage::disk('public')->exists($candidate->resume)) {

                Storage::disk('public')->delete($candidate->resume);
            }

            $data['resume'] = $request
                ->file('resume')
                ->store('resumes', 'public');
        }

        $candidate->update($data);

        return redirect()
            ->route('candidates.index')
            ->with('success', 'Candidate Updated Successfully');
    }


    /* =========================
       DELETE
    ==========================*/
    public function destroy(Candidate $candidate)
    {
        DB::beginTransaction();

        try {

            // Delete Resume File
            if ($candidate->resume &&
                Storage::disk('public')->exists($candidate->resume)) {

                Storage::disk('public')->delete($candidate->resume);
            }

            // Delete Feedback → Interviews → Candidate
            foreach ($candidate->interviews as $interview) {
                $interview->feedback()->delete();
            }

            $candidate->interviews()->delete();
            $candidate->delete();

            DB::commit();

            return back()->with(
                'success',
                'Candidate, Interviews & Feedback deleted successfully'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Delete failed: ' . $e->getMessage()
            );
        }
    }


    /* =========================
       STATUS UPDATE
    ==========================*/
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $candidate->update([
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Status updated to ' . ucfirst($request->status)
        );
    }
}
