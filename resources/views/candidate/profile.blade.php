@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Edit Profile</h3>

    <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ $user->name }}" required>
            </div>

            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ $user->email }}" required>
            </div>

            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ $candidate->phone ?? '' }}">
            </div>

            <div class="col-md-6">
                <label>Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
            </div>

            <div class="col-12">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $candidate->address ?? '' }}</textarea>
            </div>

            <div class="col-12">
                <label>Resume</label>
                <input type="file" name="resume" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary mt-4">Update Profile</button>
    </form>

</div>
@endsection
