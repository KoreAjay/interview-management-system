<tbody class="divide-y divide-slate-50">

@forelse($candidates as $candidate)
<tr class="table-row group">

    {{-- Candidate Name --}}
    <td class="px-8 py-6">
        <strong>{{ $candidate->name }}</strong>
        <br>
        <small class="text-slate-400">{{ $candidate->email }}</small>
    </td>

    {{-- Mobile --}}
    <td class="px-6 py-6">
        {{ $candidate->mobile ?? '-' }}
    </td>

    {{-- Position --}}
    <td class="px-6 py-6">
        {{ $candidate->position ?? '-' }}
    </td>

    {{-- Experience --}}
    <td class="px-6 py-6">
        {{ $candidate->experience ?? 0 }} Years
    </td>

    {{-- Resume --}}
    <td class="px-6 py-6">
        @if($candidate->resume)
            <a href="{{ asset('resumes/'.$candidate->resume) }}"
               target="_blank"
               class="text-blue-600 underline">
               View Resume
            </a>
        @else
            <span class="text-slate-400">No Resume</span>
        @endif
    </td>

    {{-- Status --}}
    <td class="px-6 py-6 text-center">
        <span class="badge-pill badge-info">
            Pending
        </span>
    </td>

    {{-- Schedule Button --}}
    <td class="px-8 py-6 text-right">

        <a href="{{ route('interviews.create', $candidate->id) }}"
           class="btn-feedback">

           <i class="bi bi-calendar-plus"></i>
           Schedule

        </a>

    </td>

</tr>

@empty
<tr>
    <td colspan="7" class="text-center py-10 text-slate-400">
        No Pending Candidates Found
    </td>
</tr>
@endforelse

</tbody>
