<table class="table">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Status</th>
</tr>

@foreach($candidates as $c)
<tr>
    <td>{{ $c->name }}</td>
    <td>{{ $c->email }}</td>
    <td>
        <span class="badge 
            {{ $c->status=='selected'?'bg-success':'bg-danger' }}">
            {{ ucfirst($c->status) }}
        </span>
    </td>
</tr>
@endforeach
</table>
