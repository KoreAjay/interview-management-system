@extends('layouts.app')

@section('content')
<div class="container py-4">

<h3 class="mb-4">Schedule Interview</h3>

<div class="card shadow">
<div class="card-body table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Position</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($candidates as $candidate)
<tr>

<td>{{ $candidate->name }}</td>
<td>{{ $candidate->email }}</td>
<td>{{ $candidate->mobile }}</td>
<td>{{ $candidate->position }}</td>
<td>
    <span class="badge bg-warning">
        {{ ucfirst($candidate->status) }}
    </span>
</td>

<td>
    <a href="{{ route('interviews.create',$candidate->id) }}"
       class="btn btn-primary btn-sm">
        Schedule
    </a>
</td>

</tr>
@endforeach

</tbody>
</table>

</div>
</div>

</div>
@endsection
