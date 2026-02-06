@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Manage Candidates</h3>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Position</th>
                        <th>Experience</th>
                        <th>Company</th>
                        <th>Notice</th>
                        <th>CTC</th>
                        <th>Expected</th>
                        <th>Location</th>
                        <th>Resume</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($candidates as $candidate)
                    <tr>

                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ $candidate->mobile }}</td>
                        <td>{{ $candidate->position }}</td>
                        <td>{{ $candidate->experience }} yrs</td>
                        <td>{{ $candidate->current_company }}</td>
                        <td>{{ $candidate->notice_period }} days</td>
                        <td>{{ $candidate->current_ctc }}</td>
                        <td>{{ $candidate->expected_ctc }}</td>
                        <td>{{ $candidate->location }}</td>

                        {{-- Resume --}}
                        <td>
                            @if($candidate->resume)
                                <a href="{{ asset('resumes/'.$candidate->resume) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-info">
                                   View
                                </a>
                            @else
                                <span class="text-muted">No File</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="badge bg-secondary">
                                {{ ucfirst($candidate->status) }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td>

                            {{-- Schedule Interview --}}
                            <a href="{{ route('interviews.create', $candidate->id) }}"
                               class="btn btn-sm btn-success mb-1">
                               Schedule
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('candidates.edit',$candidate->id) }}"
                               class="btn btn-sm btn-primary">
                               Edit
                            </a>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted">
                            No Candidates Found
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
