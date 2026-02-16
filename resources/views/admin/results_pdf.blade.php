<!DOCTYPE html>
<html>
<head>
    <title>Final Results Report</title>

    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; }
        th,td { border:1px solid #000; padding:8px; font-size:12px; }
        th { background:#eee; }
    </style>
</head>
<body>

<h2>Final Interview Results</h2>

<h2>Final Results Report</h2>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>Candidate</th>
        <th>Status</th>
        <th>Interviewer</th>
        <th>Rating</th>
        <th>Feedback</th>
    </tr>

    @foreach($interviews as $i)
    <tr>
        <td>{{ $i->candidate->name }}</td>
        <td>{{ $i->candidate->status }}</td>
        <td>{{ $i->interviewer->name ?? '-' }}</td>
        <td>{{ $i->feedback->rating ?? '-' }}</td>
        <td>{{ $i->feedback->remarks ?? '-' }}</td>
    </tr>
    @endforeach
</table>


</body>
</html>
