@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card text-white shadow-lg"
                 style="background: linear-gradient(135deg, #141E30, #243B55);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">Admin Dashboard</h2>
                        <p class="mb-0">
                            Welcome back, {{ auth()->user()->name }} 👋  
                            Manage interviews, candidates, and reports.
                        </p>
                    </div>
                    <div class="display-6">🛠️</div>
                </div>
            </div>
        </div>
    </div>

    @php
        use App\Models\Candidate;
        use App\Models\Interview;

        $totalCandidates = Candidate::count();
        $pendingCandidates = Candidate::where('status','pending')->count();
        $selectedCandidates = Candidate::where('status','selected')->count();
        $rejectedCandidates = Candidate::where('status','rejected')->count();

        $totalInterviews = Interview::count();
        $completedInterviews = Interview::where('status','completed')->count();
    @endphp

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <div class="fs-1 text-primary mb-2">👥</div>
                    <h6>Total Candidates</h6>
                    <h3>{{ $totalCandidates }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <div class="fs-1 text-warning mb-2">⏳</div>
                    <h6>Pending</h6>
                    <h3>{{ $pendingCandidates }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <div class="fs-1 text-success mb-2">✅</div>
                    <h6>Selected</h6>
                    <h3>{{ $selectedCandidates }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <div class="fs-1 text-danger mb-2">❌</div>
                    <h6>Rejected</h6>
                    <h3>{{ $rejectedCandidates }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Interview Overview --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Interview Overview</h5>
                </div>
                <div class="card-body">
                    <p>Total Interviews: <b>{{ $totalInterviews }}</b></p>
                    <p>Completed Interviews: <b>{{ $completedInterviews }}</b></p>
                    <p>Scheduled Interviews: 
                        <b>{{ $totalInterviews - $completedInterviews }}</b>
                    </p>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('candidates.index') }}" class="btn btn-outline-primary">
                        Manage Candidates
                    </a>
                    <a href="{{ route('interviews.index') }}" class="btn btn-outline-secondary">
                        Schedule Interviews
                    </a>
                    <a href="/admin/results" class="btn btn-outline-success">
                        View Results
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="row">
        <div class="col-12 text-center text-muted">
            <small>
                Interview Management System © {{ date('Y') }}  
                | Admin Panel
            </small>
        </div>
    </div>

</div>
@endsection
