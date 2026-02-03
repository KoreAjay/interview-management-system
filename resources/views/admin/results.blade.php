@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card text-white shadow-lg"
                 style="background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1">Final Results</h2>
                        <p class="mb-0">
                            Overview of selected and rejected candidates
                        </p>
                    </div>
                    <div class="display-6">📊</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Results</h6>
                    <h3>{{ $candidates->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Selected</h6>
                    <h3 class="text-success">
                        {{ $candidates->where('status','selected')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Rejected</h6>
                    <h3 class="text-danger">
                        {{ $candidates->where('status','rejected')->count() }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Results Table --}}
    <div class="card shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Candidate Results</h5>
            <span class="text-muted small">
                Showing {{ $candidates->count() }} records
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Candidate</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($candidates as $index => $c)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $c->name }}"
                                             class="rounded-circle me-2"
                                             width="35" height="35">
                                        <strong>{{ $c->name }}</strong>
                                    </div>
                                </td>

                                <td>{{ $c->email }}</td>

                                <td>
                                    <span class="badge px-3 py-2
                                        {{ $c->status == 'selected'
                                            ? 'bg-success'
                                            : 'bg-danger' }}">
                                        {{ strtoupper($c->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No results available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center text-muted mt-3">
        <small>Interview Management System © {{ date('Y') }}</small>
    </div>

</div>
@endsection
