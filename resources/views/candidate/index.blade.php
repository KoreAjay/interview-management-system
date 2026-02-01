<h2>Candidates List</h2>

<a href="{{ route('candidates.create') }}">Add Candidate</a>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Resume</th>
        <th>Action</th>
    </tr>

@foreach($candidates as $candidate)
<tr>
    <td>{{ $candidate->name }}</td>
    <td>{{ $candidate->email }}</td>
    <td>{{ $candidate->phone }}</td>
    <td>{{ $candidate->status }}</td>
    <td>
        @if($candidate->resume)
        <a href="{{ asset('resumes/'.$candidate->resume) }}" target="_blank">View</a>
        @endif
    </td>
    <td>
        <a href="{{ route('candidates.edit',$candidate->id) }}">Edit</a>

        <form action="{{ route('candidates.destroy',$candidate->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
