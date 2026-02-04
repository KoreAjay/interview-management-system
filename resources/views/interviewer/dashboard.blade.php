<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Interviewer Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        .hero-gradient {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(51, 65, 85, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.08) 0px, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
        }

        .interviewer-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
        }

        .table-row {
            @apply border-b border-slate-100 hover:bg-slate-50/80 transition-all duration-200 cursor-default;
        }

        .badge-pill {
            @apply px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border;
        }

        .badge-completed { @apply bg-emerald-50 text-emerald-600 border-emerald-100; }
        .badge-scheduled { @apply bg-amber-50 text-amber-600 border-amber-100; }

        .stat-card {
            @apply glass-card p-6 border-slate-200/60 shadow-xl flex flex-col items-center justify-center text-center group hover:translate-y-[-4px] transition-all duration-300;
        }

        .btn-feedback {
            @apply bg-slate-900 text-white hover:bg-emerald-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md flex items-center gap-2 active:scale-95;
        }

        /* Profile Dropdown Simulation */
        .profile-trigger:hover .logout-popover {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .logout-popover {
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
                <span class="hidden sm:block text-[10px] font-black uppercase tracking-widest text-slate-400">Interviewer Access</span>
                
                <!-- Profile & Logout Dropdown -->
                <div class="relative profile-trigger py-4">
                    <button class="flex items-center gap-3 bg-white border border-slate-200 pl-2 pr-4 py-1.5 rounded-2xl hover:border-emerald-500 transition-colors shadow-sm">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left hidden md:block">
                            <p class="text-xs font-bold text-slate-900 leading-none mb-1">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] font-black text-emerald-600 uppercase tracking-tighter">Active Now</p>
                        </div>
                        <i class="bi bi-chevron-down text-slate-400 text-[10px] ml-1"></i>
                    </button>

                    <!-- Logout Popover -->
                    <div class="logout-popover absolute right-0 top-full mt-2 w-48 bg-white border border-slate-200 rounded-2xl shadow-2xl p-2 overflow-hidden">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-colors text-sm font-bold">
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
        
        <!-- Header Section -->
        <div class="interviewer-header p-8 md:p-12 mb-10 text-white shadow-2xl relative">
            <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
                <i class="bi bi-mic-fill text-9xl"></i>
            </div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest text-white mb-4">
                        <i class="bi bi-lightning-charge-fill"></i> Activity Overview
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Welcome back, {{ auth()->user()->name }} 👋</h1>
                    <p class="text-emerald-50 max-w-lg text-sm leading-relaxed">
                        Ready for today's sessions? Review your assigned candidates and submit your feedback scores directly below.
                    </p>
                </div>
                <div class="hidden lg:block bg-white/10 p-4 rounded-3xl backdrop-blur-sm border border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase text-emerald-200 tracking-widest">Today's Date</p>
                            <p class="text-lg font-bold">{{ date('D, M d Y') }}</p>
                        </div>
                        <i class="bi bi-calendar-event text-3xl text-white/50"></i>
                    </div>
                </div>
            </div>
        </div>

       @php
    $user = auth()->user();

    $interviews = \App\Models\Interview::with('candidate')
        ->where('interviewer_id', $user->id)
        ->latest()
        ->get();
@endphp


        <!-- Quick Summary Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            
            <div class="stat-card">
                <i class="bi bi-calendar4-week text-2xl text-slate-300 mb-3"></i>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Assignments</span>
                <h3 class="text-3xl font-black text-slate-900">{{ $interviews->count() }}</h3>
                <div class="w-8 h-1 bg-slate-100 rounded-full mt-3 group-hover:bg-slate-900 transition-colors"></div>
            </div>

            <div class="stat-card">
                <i class="bi bi-hourglass-split text-2xl text-amber-400 mb-3"></i>
                <span class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] mb-1">Pending Feedback</span>
                <h3 class="text-3xl font-black text-slate-900">{{ $interviews->where('status','scheduled')->count() }}</h3>
                <div class="w-8 h-1 bg-amber-100 rounded-full mt-3 group-hover:bg-amber-500 transition-colors"></div>
            </div>

            <div class="stat-card">
                <i class="bi bi-check2-circle text-2xl text-emerald-400 mb-3"></i>
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-1">Reviews Completed</span>
                <h3 class="text-3xl font-black text-slate-900">{{ $interviews->where('status','completed')->count() }}</h3>
                <div class="w-8 h-1 bg-emerald-100 rounded-full mt-3 group-hover:bg-emerald-500 transition-colors"></div>
            </div>
        </div>

        <!-- Schedule Table -->
        <div class="glass-card shadow-2xl border-slate-200/60 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 bg-white/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base">My Interview Schedule</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Real-time update of your evaluation pipeline</p>
                </div>
                <div class="px-4 py-2 bg-slate-900 rounded-xl">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Active Pool: {{ $interviews->count() }}</span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Candidate Information</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Evaluation Round</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Session Date</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($interviews as $interview)
                            <tr class="table-row group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black text-sm">
                                            {{ strtoupper(substr($interview->candidate->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 mb-0.5">{{ $interview->candidate->name }}</p>
                                            <p class="text-xs text-slate-400 font-medium">{{ $interview->candidate->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                        <span class="text-xs font-black text-slate-600 uppercase tracking-tight">{{ $interview->round }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="text-sm font-bold text-slate-900">
                                        {{ \Carbon\Carbon::parse($interview->date)->format('d M Y') }}
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase mt-1">Confirmed Slot</div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="badge-pill {{ $interview->status === 'completed' ? 'badge-completed' : 'badge-scheduled' }}">
                                        {{ $interview->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if($interview->status === 'scheduled')
                                        <a href="{{ url('/feedback/'.$interview->id) }}" class="btn-feedback inline-flex ml-auto">
                                            <i class="bi bi-chat-left-text"></i> Give Feedback
                                        </a>
                                    @else
                                        <div class="flex items-center justify-end gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-widest">
                                            <i class="bi bi-check-all text-lg"></i> Submitted
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="max-w-xs mx-auto space-y-4">
                                        <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center text-slate-200 text-4xl mx-auto border border-slate-100 shadow-inner">
                                            <i class="bi bi-journal-x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-slate-900 font-black text-sm uppercase tracking-wider">No Assignments Found</h4>
                                            <p class="text-slate-400 text-xs font-medium mt-1">You don't have any interviews scheduled at the moment. Take a break!</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 flex items-center gap-3">
                <i class="bi bi-info-circle text-emerald-500"></i>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                    Reminder: Please submit feedback within 24 hours of session completion.
                </p>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.4em]">Interview Management System &copy; {{ date('Y') }}</p>
        </div>
    </main>

    <footer class="bg-slate-900 text-white pt-20 pb-12 px-6">
        <div class="max-w-7xl mx-auto text-center border-t border-slate-800 pt-12">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.3em]">&copy; 2026 Softmatric Technologies. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
