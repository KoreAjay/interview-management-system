<tbody class="divide-y divide-slate-50">
@forelse($interviews as $interview)
<tr class="table-row group">

    {{-- Candidate --}}
    <td class="px-8 py-6">
        <strong>{{ $interview->candidate->name ?? 'N/A' }}</strong>
    </td>

    {{-- Interviewer --}}
    <td class="px-6 py-6">
        {{ $interview->interviewer?->user?->name ?? 'Not Assigned' }}
    </td>

    {{-- Date --}}
    <td class="px-6 py-6">
        {{ \Carbon\Carbon::parse($interview->date)->format('d M Y') }}
        <br>
        <small class="text-slate-400">
            {{ \Carbon\Carbon::parse($interview->time)->format('h:i A') }}
        </small>
    </td>

    {{-- Round --}}
    <td class="px-6 py-6">
        {{ $interview->round }}
    </td>

    {{-- Status --}}
    <td class="px-6 py-6 text-center">
        <span class="badge-pill {{ $interview->status === 'scheduled' ? 'badge-info' : 'badge-success' }}">
            {{ ucfirst($interview->status) }}
        </span>
    </td>

</tr>
@empty
<tr>
    <td colspan="5" class="text-center py-10 text-slate-400">
        No interviews scheduled yet.
    </td>
</tr>
@endforelse
</tbody>
