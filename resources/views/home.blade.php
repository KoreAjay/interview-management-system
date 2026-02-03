@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card text-white shadow"
                 style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1">Welcome, {{ auth()->user()->name }} 👋</h3>
                        <p class="mb-0">Track your interview progress and updates here</p>
                    </div>
                    <div class="fs-1">🎯</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row g-4">

        <!-- Application Status -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3 fs-1 text-primary">📄</div>
                    <h5 class="card-title">Application Status</h5>

                    @php
                        $candidate = \App\Models\Candidate::where('email', auth()->user()->email)->first();
                    @endphp

                    @if($candidate)
                        <span class="badge 
                            {{ $candidate->status == 'selected' ? 'bg-success' : 
                               ($candidate->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ ucfirst($candidate->status) }}
                        </span>
                    @else
                        <span class="badge bg-secondary">Not Applied</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Interview Info -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3 fs-1 text-success">📅</div>
                    <h5 class="card-title">Interview Status</h5>

                    @if($candidate && $candidate->interviews->count())
                        <p class="mb-1"><b>Round:</b> {{ $candidate->interviews->last()->round }}</p>
                        <p class="mb-0 text-muted">
                            {{ $candidate->interviews->last()->date }}
                        </p>
                    @else
                        <p class="text-muted mb-0">No interview scheduled yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-3 fs-1 text-warning">⚡</div>
                    <h5 class="card-title">Quick Actions</h5>

                    <a href="#" class="btn btn-outline-primary btn-sm mb-2 w-100">
                        View Profile
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                        Download Resume
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Message -->
    <div class="row mt-4">
        <div class="col-12 text-center text-muted">
            <small>
                We’ll notify you when there are updates to your interview process.
                <br>
                Best of luck! 🍀
            </small>
        </div>
    </div>

</div>
@endsection
