@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Interview Schedule</h3>
            <p class="text-muted mb-0">Manage and track all interviews</p>
        </div>

        <a href="{{ route('interviews.create') }}" class="btn btn-primary">
            ➕ Schedule Interview
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Candidate</th>
                        <th>Interviewer</th>
                        <th>Date</th>
                        <th>Round</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($interviews as $interview)
                    <tr>
                        <td>
                            <strong>{{ $interview->candidate->name }}</strong><br>
                            <small class="text-muted">{{ $interview->candidate->email }}</small>
                        </td>

                        <td>{{ $interview->interviewer->name }}</td>

                        <td>{{ \Carbon\Carbon::parse($interview->date)->format('d M Y') }}</td>

                        <td>
                            <span class="badge bg-info">
                                {{ ucfirst($interview->round) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge 
                                {{ $interview->status == 'completed' ? 'bg-success' :
                                   ($interview->status == 'cancelled' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ ucfirst($interview->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No interviews scheduled yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
