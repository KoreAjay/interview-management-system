@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Interview Feedback</h5>
        </div>

        <div class="card-body">
            <p><strong>Candidate:</strong> {{ $interview->candidate->name }}</p>
            <p><strong>Round:</strong> {{ ucfirst($interview->round) }}</p>

            <form method="POST" action="{{ route('feedback.store', $interview->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Rating (1–5)</label>
                    <select name="rating" class="form-select" required>
                        <option value="">Select</option>
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Result</label>
                    <select name="result" class="form-select" required>
                        <option value="selected">Selected</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Remarks</label>
                    <textarea name="remarks" class="form-control" rows="3"></textarea>
                </div>

                <button class="btn btn-success">
                    Submit Feedback
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
