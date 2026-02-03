<form method="POST" action="{{ route('interviews.store') }}">
@csrf

<select name="candidate_id" class="form-control mb-2">
    @foreach($candidates as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
</select>

<select name="interviewer_id" class="form-control mb-2">
    @foreach($interviewers as $i)
        <option value="{{ $i->id }}">{{ $i->name }}</option>
    @endforeach
</select>

<input type="date" name="date" class="form-control mb-2">
<input type="text" name="round" placeholder="Technical / HR" class="form-control mb-2">

<button class="btn btn-primary">Schedule</button>
</form>
