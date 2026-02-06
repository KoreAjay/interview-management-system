@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Schedule Interview</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('interviews.store') }}">
                @csrf

                {{-- Hidden Candidate ID --}}
                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">

                <div class="row">

                    {{-- Candidate Name --}}
                    <div class="col-md-6 mb-3">
                        <label>Candidate Name</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $candidate->name }}"
                               readonly>
                    </div>

                    {{-- Candidate Email --}}
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $candidate->email }}"
                               readonly>
                    </div>

                    {{-- Position --}}
                    <div class="col-md-6 mb-3">
                        <label>Position</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $candidate->position }}"
                               readonly>
                    </div>

                    {{-- Experience --}}
                    <div class="col-md-6 mb-3">
                        <label>Experience</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $candidate->experience }} Years"
                               readonly>
                    </div>

                    {{-- Interviewer Dropdown (FROM USERS TABLE) --}}
                    <div class="col-md-6 mb-3">
                        <label>Select Interviewer</label>
                        <select name="interviewer_id" class="form-control" required>
                            <option value="">-- Select Interviewer --</option>

                            @foreach($interviewers as $interviewer)
                                <option value="{{ $interviewer->id }}">
                                    {{ $interviewer->name }} ({{ $interviewer->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Mode --}}
                    <div class="col-md-6 mb-3">
                        <label>Mode</label>
                        <select name="mode" class="form-control" required>
                            <option value="">Select Mode</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>

                    {{-- Date --}}
                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    {{-- Time --}}
                    <div class="col-md-6 mb-3">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    {{-- Round --}}
                    <div class="col-md-6 mb-3">
                        <label>Round</label>
                        <input type="text" name="round" class="form-control" placeholder="HR / Technical / Final">
                    </div>

                    {{-- Meeting Link --}}
                    <div class="col-md-6 mb-3">
                        <label>Meeting Link / Address</label>
                        <input type="text" name="meeting_link" class="form-control">
                    </div>

                </div>

                <button class="btn btn-primary">
                    Schedule Interview
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
