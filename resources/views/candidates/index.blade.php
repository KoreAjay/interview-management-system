<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Candidates Management</title>

    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .table-row-hover:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
        
        .status-pill {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 6px 14px;
            border-radius: 12px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/40 z-40 lg:hidden backdrop-blur-sm" x-cloak></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 transition-transform duration-300 ease-in-out flex flex-col">
        <div class="p-8 flex items-center justify-between">
            <h2 class="font-extrabold text-2xl tracking-tight">Soft<span class="text-emerald-600">matric</span></h2>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Navigation</p>
            <a href="{{route('admin.dashboard')}}"
                class="flex items-center px-4 py-3 text-slate-500 rounded-2xl font-bold transition-all hover:bg-slate-50">
                <i class="bi bi-grid-1x2 mr-3 text-lg"></i> Dashboard
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 bg-emerald-500 text-white rounded-2xl font-bold shadow-lg shadow-emerald-200">
                <i class="bi bi-people-fill mr-3 text-lg"></i> Candidates
            </a>
            <a href="{{ route('admin.results') }}"
                class="flex items-center px-4 py-3 text-slate-500 rounded-2xl font-bold transition-all hover:bg-slate-50">
                <i class="bi bi-check-circle mr-3 text-lg"></i> Final Results
            </a>
        </nav>
    </aside>

    <div class="lg:ml-64 min-h-screen flex flex-col">

        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 bg-slate-100 rounded-xl">
                    <i class="bi bi-list text-xl"></i>
                </button>
                <div>
                    <h1 class="text-sm font-black text-slate-800 uppercase tracking-widest">Database</h1>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">{{ $candidates->count() }} Profiles Registered</p>
                </div>
            </div>

            <a href="{{ route('candidates.create') }}"
                class="flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white text-xs font-bold rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                <i class="bi bi-plus-lg"></i> Add New Candidate
            </a>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-7xl mx-auto">

                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm rounded-2xl flex items-center gap-3 animate-pulse">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('candidates.index') }}" method="GET" class="mb-8">
                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex flex-wrap gap-5 items-end">
                        
                        <div class="flex-1 min-w-[240px]">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2 mb-2 block tracking-widest">Search Profile</label>
                            <div class="flex items-center bg-slate-100 rounded-2xl px-4 py-2.5 w-full border border-transparent focus-within:border-emerald-500/50 transition-all">
                                <i class="bi bi-search text-slate-400 mr-3"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Enter name or email..."
                                    class="bg-transparent border-none text-sm focus:ring-0 w-full text-slate-600 placeholder:text-slate-400">
                            </div>
                        </div>

                        <div class="w-full lg:w-56">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2 mb-2 block tracking-widest">By Position</label>
                            <select name="position" onchange="this.form.submit()"
                                class="w-full bg-slate-100 border-none rounded-2xl px-4 py-2.5 text-sm text-slate-600 font-bold focus:ring-2 focus:ring-emerald-500/20 appearance-none">
                                <option value="">All Job Roles</option>
                                @foreach($availablePositions as $pos)
                                    <option value="{{ $pos }}" {{ request('position') == $pos ? 'selected' : '' }}>
                                        {{ $pos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full lg:w-44">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2 mb-2 block tracking-widest">Application Status</label>
                            <select name="status" onchange="this.form.submit()"
                                class="w-full bg-slate-100 border-none rounded-2xl px-4 py-2.5 text-sm text-slate-600 font-bold focus:ring-2 focus:ring-emerald-500/20">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="selected" {{ request('status') == 'selected' ? 'selected' : '' }}>Selected</option>
                                <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="w-full lg:w-44">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2 mb-2 block tracking-widest">Applied Date</label>
                            <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                                class="w-full bg-slate-100 border-none rounded-2xl px-4 py-2.5 text-sm text-slate-600 font-bold focus:ring-2 focus:ring-emerald-500/20">
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-2xl text-xs font-bold hover:bg-slate-800 transition-all shadow-lg">
                                Apply
                            </button>
                            @if(request()->anyFilled(['search', 'status', 'date', 'position']))
                                <a href="{{ route('candidates.index') }}"
                                    class="bg-rose-50 text-rose-600 px-6 py-2.5 rounded-2xl text-xs font-bold hover:bg-rose-100 transition-all">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Candidate Information</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Resume</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Position & Experience</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Timeline</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Status</th>
                                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($candidates as $candidate)
                                    <tr class="table-row-hover transition-all duration-300">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold shadow-md shadow-emerald-100">
                                                    {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-black text-slate-800">{{ $candidate->name }}</p>
                                                    <p class="text-[11px] text-slate-400 font-medium">{{ $candidate->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            @if($candidate->resume)
                                                <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 text-[10px] font-black rounded-xl border border-slate-200 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                                    <i class="bi bi-cloud-arrow-down-fill text-sm"></i> VIEW CV
                                                </a>
                                            @else
                                                <span class="text-[10px] font-black text-slate-300 italic tracking-widest">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-black text-slate-700">{{ $candidate->position }}</span>
                                                <span class="text-[11px] text-emerald-600 font-bold">{{ $candidate->experience }} Years Experience</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-bold text-slate-700">{{ $candidate->created_at->format('d M Y') }}</span>
                                                <span class="text-[10px] text-slate-400 font-medium uppercase">{{ $candidate->created_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            @php
                                                $statusStyle = match (strtolower($candidate->status)) {
                                                    'hired', 'selected' => 'bg-emerald-100 text-emerald-700',
                                                    'rejected' => 'bg-rose-100 text-rose-700',
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    default => 'bg-blue-100 text-blue-700'
                                                };
                                            @endphp
                                            <span class="status-pill {{ $statusStyle }}">
                                                {{ $candidate->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <a href="{{ route('candidates.show', $candidate->id) }}"
                                                    class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('candidates.edit', $candidate->id) }}"
                                                    class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('candidates.destroy', $candidate->id) }}"
                                                    method="POST" class="inline" onsubmit="return confirm('Archive this candidate record?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-8 py-20 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="bi bi-inbox text-5xl text-slate-200 mb-4"></i>
                                                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No matching candidates found</p>
                                                <a href="{{ route('candidates.index') }}" class="mt-4 text-emerald-600 font-black text-[10px] uppercase border-b-2 border-emerald-100">Clear all filters</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>