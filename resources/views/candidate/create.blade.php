@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Add New Candidate</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST"
                  action="{{ route('candidates.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control" required>
                    </div>

                    <!-- ✅ FIXED -->
                    <div class="col-md-6 mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Position</label>
                        <input type="text" name="position"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Experience</label>
                        <input type="number" name="experience"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Current Company</label>
                        <input type="text" name="current_company"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Notice Period (Days)</label>
                        <input type="number" name="notice_period"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Current CTC</label>
                        <input type="text" name="current_ctc"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Expected CTC</label>
                        <input type="text" name="expected_ctc"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Location</label>
                        <input type="text" name="location"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Resume</label>
                        <input type="file" name="resume"
                               class="form-control">
                    </div>

                </div>

                <button class="btn btn-primary">
                    Save Candidate
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
