@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card text-white shadow-lg"
                 style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">Interviewer Dashboard</h2>
                        <p class="mb-0">
                            Welcome back, {{ auth()->user()->name }} 👋  
                            Review interviews and submit feedback.
                        </p>
                    </div>
                    <div class="display-6">🎤</div>
                </div>
            </div>
        </div>
    </div>

    @php
        $interviewer = auth()->user()->interviewer;
        $interviews = $interviewer
            ? $interviewer->interviews()->with('candidate')->latest()->get()
            : collect();
    @endphp

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="fs-1 text-primary mb-2">📅</div>
                    <h6>Total Interviews</h6>
                    <h3>{{ $interviews->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="fs-1 text-warning mb-2">⏳</div>
                    <h6>Pending</h6>
                    <h3>{{ $interviews->where('status','scheduled')->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="fs-1 text-success mb-2">✅</div>
                    <h6>Completed</h6>
                    <h3>{{ $interviews->where('status','completed')->count() }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Interview List --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">My Interview Schedule</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Candidate</th>
                                <th>Round</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($interviews as $interview)
                            <tr>
                                <td>
                                    <strong>{{ $interview->candidate->name }}</strong><br>
                                    <small class="text-muted">{{ $interview->candidate->email }}</small>
                                </td>

                                <td>{{ $interview->round }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($interview->date)->format('d M Y') }}
                                </td>

                                <td>
                                    <span class="badge 
                                        {{ $interview->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($interview->status) }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($interview->status === 'scheduled')
                                        <a href="{{ url('/feedback/'.$interview->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Give Feedback
                                        </a>
                                    @else
                                        <span class="text-muted">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No interviews assigned yet.
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Note --}}
    <div class="row mt-4">
        <div class="col-12 text-center text-muted">
            <small>
                Please submit feedback promptly after each interview to help HR make decisions.
            </small>
        </div>
    </div>

</div>
@endsection
