@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="mb-4">
        <h3 class="fw-bold">📅 Schedule Interview</h3>
        <p class="text-muted mb-0">
            Assign interviewer, date, time, and interview round
        </p>
    </div>

    {{-- Card --}}
    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background: linear-gradient(135deg,#1e3c72,#2a5298)">
            <h5 class="mb-0">Interview Details</h5>
        </div>

        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('interviews.store') }}">
                @csrf

                <div class="row g-4">

                    {{-- Candidate --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Candidate <span class="text-danger">*</span>
                        </label>
                        <select name="candidate_id" class="form-select" required>
                            <option value="">Select Candidate</option>
                            @foreach($candidates as $candidate)
                                <option value="{{ $candidate->id }}"
                                    {{ old('candidate_id') == $candidate->id ? 'selected' : '' }}>
                                    {{ $candidate->name }} ({{ $candidate->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Interviewer --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Interviewer <span class="text-danger">*</span>
                        </label>
                        <select name="interviewer_id" class="form-select" required>
                            <option value="">Select Interviewer</option>
                            @foreach($interviewers as $interviewer)
                                <option value="{{ $interviewer->id }}"
                                    {{ old('interviewer_id') == $interviewer->id ? 'selected' : '' }}>
                                    {{ $interviewer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Date <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="date"
                               value="{{ old('date') }}"
                               class="form-control"
                               required>
                    </div>

                    {{-- Time --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Time <span class="text-danger">*</span>
                        </label>
                        <input type="time"
                               name="time"
                               value="{{ old('time') }}"
                               class="form-control"
                               required>
                    </div>

                    {{-- Round --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Interview Round <span class="text-danger">*</span>
                        </label>
                        <select name="round" class="form-select" required>
                            <option value="technical" {{ old('round')=='technical'?'selected':'' }}>Technical</option>
                            <option value="hr" {{ old('round')=='hr'?'selected':'' }}>HR</option>
                            <option value="managerial" {{ old('round')=='managerial'?'selected':'' }}>Managerial</option>
                        </select>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('interviews.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        ✅ Schedule Interview
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
