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
               View
            </a>
        @else
            <span class="text-slate-400">N/A</span>
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
           class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-600 transition">

            Schedule Interview

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
               View
            </a>
        @else
            <span class="text-slate-400">N/A</span>
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
           class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-600 transition">

            Schedule Interview

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
