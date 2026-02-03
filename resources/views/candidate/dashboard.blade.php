@extends('layouts.app')

@section('content')
<div class="container py-4">

    @php
        $user = auth()->user();
        $candidate = \App\Models\Candidate::where('email', $user->email)->first();
    @endphp

    {{-- Top Welcome Card --}}
    <div class="card text-white mb-4 shadow-lg"
         style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Candidate Dashboard</h2>
                <p class="mb-0">
                    Welcome back, <strong>{{ $user->name }}</strong> 👋  
                    Track your profile and interview progress.
                </p>
            </div>
            <a href="{{ route('candidate.profile') }}" class="btn btn-light fw-semibold">
                Edit Profile
            </a>
        </div>
    </div>

    <div class="row g-4">

        {{-- Profile Card --}}
        <div class="col-md-4">
            <div class="card shadow border-0 h-100 text-center">

                <div class="card-body">

                    {{-- Profile Image --}}
                    <img src="{{ $candidate && $candidate->profile_image
                        ? asset('storage/'.$candidate->profile_image)
                        : 'https://ui-avatars.com/api/?name='.$user->name.'&background=4facfe&color=fff' }}"
                        class="rounded-circle mb-3 border"
                        width="130" height="130"
                        alt="Profile Image">

                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    {{-- Status Badge --}}
                    <span class="badge px-3 py-2
                        {{ $candidate && $candidate->status == 'selected' ? 'bg-success' :
                           ($candidate && $candidate->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ ucfirst($candidate->status ?? 'pending') }}
                    </span>

                    <hr>

                    {{-- Resume --}}
                    @if($candidate && $candidate->resume)
                        <a href="{{ asset('resumes/'.$candidate->resume) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm w-100 mb-2">
                            View Resume
                        </a>
                    @else
                        <p class="text-muted small">Resume not uploaded</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Details Card --}}
        <div class="col-md-8">
            <div class="card shadow border-0 h-100">

                <div class="card-header bg-white">
                    <h5 class="mb-0">Profile & Interview Details</h5>
                </div>

                <div class="card-body">

                    {{-- Profile Info --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Phone:</strong><br>
                                {{ $candidate->phone ?? 'Not updated' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Address:</strong><br>
                                {{ $candidate->address ?? 'Not updated' }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    {{-- Interview Info --}}
                    <h6 class="mb-3">Interview Information</h6>

                    @if($candidate && $candidate->interviews->count())
                        @php
                            $interview = $candidate->interviews->last();
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Round</strong><br>{{ $interview->round }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date</strong><br>{{ $interview->date }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Status</strong><br>
                                    <span class="badge bg-info">
                                        {{ ucfirst($interview->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">
                            No interview scheduled yet. You will be notified once scheduled.
                        </p>
                    @endif

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
