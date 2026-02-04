<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Interview Schedule</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        .hero-gradient {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(51, 65, 85, 0.03) 0px, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
        }

        .table-row {
            @apply border-b border-slate-50 hover:bg-slate-50/50 transition-all duration-200 cursor-default;
        }

        .badge-pill {
            @apply px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border;
        }

        .badge-scheduled { @apply bg-blue-50 text-blue-600 border-blue-100; }
        .badge-completed { @apply bg-emerald-50 text-emerald-600 border-emerald-100; }
        
        .btn-primary-sm {
            @apply bg-slate-900 text-white hover:bg-emerald-600 px-6 py-3 rounded-2xl text-xs font-bold tracking-tight transition-all shadow-lg active:scale-95 flex items-center gap-2;
        }

        /* Profile Dropdown Logic */
        .profile-trigger:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="antialiased hero-gradient min-h-screen">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-lg border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer" onclick="window.location='/'">
                <div class="bg-slate-900 p-2 rounded-xl group-hover:bg-emerald-500 transition-all duration-300">
                    <i class="bi bi-cpu text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="flex items-center gap-6">
                <!-- User Profile Dropdown -->
                <div class="relative profile-trigger py-4">
                    <button class="flex items-center gap-3 bg-white border border-slate-200 pl-2 pr-4 py-1.5 rounded-2xl hover:border-emerald-500 transition-colors shadow-sm">
                        <div class="w-8 h-8 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold text-xs">
                            A
                        </div>
                        <div class="text-left hidden md:block">
                            <p class="text-xs font-bold text-slate-900 leading-none mb-1">Admin User</p>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">System Manager</p>
                        </div>
                        <i class="bi bi-chevron-down text-slate-400 text-[10px] ml-1"></i>
                    </button>

                    <!-- Dropdown Content -->
                    <div class="dropdown-menu absolute right-0 top-full mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-2xl p-2 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-50 mb-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Quick Access</p>
                        </div>
                        
                        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-50 hover:text-emerald-600 rounded-xl transition-colors text-sm font-bold">
                            <i class="bi bi-grid-1x2 text-lg"></i>
                            Admin Dashboard
                        </a>

                        <div class="border-t border-slate-50 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-colors text-sm font-bold text-left">
                                <i class="bi bi-box-arrow-right text-lg"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto pt-32 pb-20 px-6">

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
            <div>
                <nav class="flex gap-2 mb-4">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Recruitment</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">/</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500">Calendar</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">Interview Schedule</h1>
                <p class="text-slate-500 mt-2 text-sm max-w-md">Manage and monitor all ongoing recruitment rounds across various departments.</p>
            </div>
            
            <a href="{{ route('interviews.create') }}" class="btn-primary-sm">
                <i class="bi bi-plus-lg"></i>
                Schedule New Interview
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 text-emerald-700 animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0">
                    <i class="bi bi-check-lg"></i>
                </div>
                <p class="text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Main Schedule Card -->
        <div class="glass-card shadow-2xl border-slate-200/60 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 bg-white/50 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base">Active Interviews</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Scheduled Sessions: {{ $interviews->count() }}</p>
                </div>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50"><i class="bi bi-filter"></i></button>
                    <button class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Candidate</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Interviewer</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date & Time</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Round</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($interviews as $interview)
                            <tr class="table-row group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white text-xs font-bold">
                                            {{ strtoupper(substr($interview->candidate->name ?? 'N', 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ $interview->candidate->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <span class="text-sm font-semibold text-slate-600">{{ $interview->interviewer->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-slate-900">
                                            {{ \Carbon\Carbon::parse($interview->date)->format('d M Y') }}
                                        </span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase mt-1">
                                            <i class="bi bi-clock mr-1"></i> {{ \Carbon\Carbon::parse($interview->time)->format('h:i A') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="text-xs font-black text-slate-500 uppercase tracking-tighter bg-slate-100 px-2 py-1 rounded-md">
                                        {{ $interview->round }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="badge-pill {{ $interview->status == 'scheduled' ? 'badge-scheduled' : 'badge-completed' }}">
                                        {{ ucfirst($interview->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="max-w-xs mx-auto space-y-4">
                                        <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-200 text-3xl mx-auto">
                                            <i class="bi bi-calendar-x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-slate-900 font-bold">No sessions found</h4>
                                            <p class="text-slate-400 text-xs mt-1">There are no interviews scheduled in the system yet.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Footer pagination simulation -->
            <div class="px-8 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Showing {{ $interviews->count() }} results</p>
                <div class="flex gap-1">
                    <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 opacity-50 cursor-not-allowed"><i class="bi bi-chevron-left text-xs"></i></button>
                    <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 opacity-50 cursor-not-allowed"><i class="bi bi-chevron-right text-xs"></i></button>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-auto py-12 px-6 border-t border-slate-200">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.4em]">Softmatric Recruitment Portal &copy; 2026</p>
        </div>
    </footer>

</body>
</html>