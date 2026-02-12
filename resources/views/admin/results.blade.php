<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Final Results</title>

    <!-- Typography & Icons -->
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .table-row-hover:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.05);
        }

        .filter-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900" x-data="{ sidebarOpen: false }">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 transition-transform duration-300 ease-in-out flex flex-col">
        <div class="p-6 flex items-center justify-between">
            <h2 class="font-extrabold text-2xl tracking-tight">Soft<span class="text-emerald-600">matric</span></h2>
        </div>
        <nav class="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Navigation</p>
            <a href={{ route('admin.dashboard') }} class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-grid-1x2 mr-3 text-lg"></i> Dashboard
            </a>
            <a href={{ route('candidate.dashboard') }} class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-people mr-3 text-lg"></i> Candidates
            </a>
            <a href="#" class="flex items-center px-4 py-2.5 bg-emerald-500 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200">
                <i class="bi bi-check-circle-fill mr-3 text-lg"></i> Final Results
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        
        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-slate-600">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <div>
                    <h1 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Final Results</h1>
                    <p class="text-xs text-slate-400">Post-interview decisions and candidate feedback</p>
                </div>
            </div>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-7xl mx-auto">
                
                <!-- Filters Section -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <form method="GET" class="flex items-center gap-3">
                        <div class="relative">
                            <select name="status" class="filter-select appearance-none bg-white border border-slate-200 rounded-2xl px-5 py-2.5 pr-10 text-xs font-bold text-slate-600 focus:outline-none transition-all cursor-pointer">
                                <option value="">All Outcomes</option>
                                <option value="selected" {{ request('status')=='selected'?'selected':'' }}>Selected</option>
                                <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-[10px]"></i>
                        </div>
                        <button class="bg-slate-900 text-white px-6 py-2.5 rounded-2xl text-xs font-bold hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-100">
                            Filter Results
                        </button>
                    </form>

                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Quick Export:</span>
                        <button class="p-2 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </button>
                        <button class="p-2 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                            <i class="bi bi-file-earmark-excel"></i>
                        </button>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Candidate</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Outcome</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Interviewer</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Session Details</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Rating</th>
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Feedback Comments</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($interviews as $interview)
                                <tr class="table-row-hover transition-all duration-200">
                                    <td class="px-8 py-5">
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $interview->candidate->name }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $interview->candidate->email }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($interview->candidate->status == 'selected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-extrabold uppercase tracking-tight">
                                                <i class="bi bi-check-circle-fill mr-1.5"></i> Selected
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-extrabold uppercase tracking-tight">
                                                <i class="bi bi-x-circle-fill mr-1.5"></i> Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 bg-slate-100 rounded-lg flex items-center justify-center text-[10px] font-bold text-slate-500">
                                                {{ strtoupper(substr($interview->interviewer->name ?? '?', 0, 1)) }}
                                            </div>
                                            <span class="text-xs font-semibold text-slate-600">{{ $interview->interviewer->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="space-y-1">
                                            <p class="text-xs font-bold text-slate-700">{{ $interview->round }}</p>
                                            <p class="text-[10px] text-slate-400 flex items-center gap-1.5 uppercase tracking-tighter">
                                                @if($interview->mode == 'online')
                                                    <i class="bi bi-camera-video"></i> {{ $interview->mode }}
                                                @else
                                                    <i class="bi bi-building text-[8px]"></i> {{ $interview->mode }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @php $rating = $interview->feedback->rating ?? 0; @endphp
                                        <div class="inline-flex items-center gap-1">
                                            <span class="text-sm font-black {{ $rating >= 4 ? 'text-emerald-500' : ($rating >= 3 ? 'text-amber-500' : 'text-slate-400') }}">
                                                {{ $rating ?: '-' }}
                                            </span>
                                            <i class="bi bi-star-fill text-[10px] text-amber-400"></i>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <p class="text-xs text-slate-500 line-clamp-2 max-w-xs italic">
                                            "{{ $interview->feedback->comments ?? 'No feedback recorded' }}"
                                        </p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <i class="bi bi-clipboard-x text-slate-300 text-2xl"></i>
                                            </div>
                                            <h4 class="text-slate-800 font-bold">No results found</h4>
                                            <p class="text-slate-400 text-xs mt-1">Adjust your filters or complete more interviews.</p>
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
