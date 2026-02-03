<td>
    @if($candidate->resume)
        <a href="{{ asset('resumes/'.$candidate->resume) }}" target="_blank"
           class="btn btn-sm btn-outline-info">
            View Resume
        </a>
    @endif
</td>

<td>
    <form method="POST" action="{{ route('candidates.status',$candidate) }}">
        @csrf
        <select name="status" class="form-select form-select-sm"
                onchange="this.form.submit()">
            <option {{ $candidate->status=='pending'?'selected':'' }}>pending</option>
            <option {{ $candidate->status=='selected'?'selected':'' }}>selected</option>
            <option {{ $candidate->status=='rejected'?'selected':'' }}>rejected</option>
        </select>
    </form>
</td>
