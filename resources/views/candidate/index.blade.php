@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-3">Manage Candidates</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Resume</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->name }}</td>
                            <td>{{ $candidate->email }}</td>
                            <td>{{ $candidate->phone ?? '-' }}</td>

                            <td>
                                @if($candidate->resume)
                                    <a href="{{ asset('resumes/'.$candidate->resume) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-info">
                                        View Resume
                                    </a>
                                @else
                                    <span class="text-muted">No Resume</span>
                                @endif
                            </td>

                            <td>
                                <form method="POST"
                                      action="{{ route('candidates.status', $candidate) }}">
                                    @csrf
                                    <select name="status"
                                            class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                        <option value="pending"
                                            {{ $candidate->status=='pending'?'selected':'' }}>
                                            Pending
                                        </option>
                                        <option value="selected"
                                            {{ $candidate->status=='selected'?'selected':'' }}>
                                            Selected
                                        </option>
                                        <option value="rejected"
                                            {{ $candidate->status=='rejected'?'selected':'' }}>
                                            Rejected
                                        </option>
                                    </select>
                                </form>
                            </td>

                            <td>
                                <a href="{{ route('candidates.edit', $candidate) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No candidates found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
