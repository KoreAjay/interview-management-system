<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Admin Dashboard</title>
    
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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
        }

        .admin-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
        }

        .stat-card {
            @apply glass-card p-6 shadow-xl border-slate-200/60 flex items-center gap-5 hover:translate-y-[-4px] transition-all duration-300;
        }

        .icon-box {
            @apply w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner;
        }

        .action-btn {
            @apply flex items-center justify-between p-4 rounded-2xl border border-slate-200 bg-white hover:bg-emerald-50 hover:border-emerald-200 transition-all group;
        }
    </style>
</head>
<body class="antialiased hero-gradient min-h-screen">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-lg border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="bg-slate-900 p-2 rounded-xl group-hover:bg-emerald-500 transition-all duration-300">
                    <i class="bi bi-cpu text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-900 rounded-full">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-black text-white tracking-[0.2em] uppercase">Admin Control</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-slate-700 hidden sm:inline">{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white shadow-sm overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f172a&color=fff" alt="avatar">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto pt-32 pb-20 px-6">
        
        <!-- Dashboard Header -->
        <div class="admin-header p-8 md:p-12 mb-10 text-white shadow-2xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest text-emerald-400">
                        <i class="bi bi-shield-lock"></i> Central Management
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                        Admin <span class="text-emerald-400">Dashboard</span>
                    </h1>
                    <p class="text-slate-400 max-w-lg text-sm md:text-base leading-relaxed">
                        Welcome back, {{ auth()->user()->name }}. Monitor candidate pipelines, interview success rates, and manage organizational talent acquisition.
                    </p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white/10 hover:bg-white/20 px-6 py-3.5 rounded-2xl text-xs font-extrabold transition-all border border-white/10">
                        Generate Report
                    </button>
                    <button class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 px-6 py-3.5 rounded-2xl text-xs font-extrabold transition-all shadow-lg">
                        System Settings
                    </button>
                </div>
            </div>
        </div>

        @php
            $totalCandidates = \App\Models\Candidate::count();
            $pendingCandidates = \App\Models\Candidate::where('status','pending')->count();
            $selectedCandidates = \App\Models\Candidate::where('status','selected')->count();
            $rejectedCandidates = \App\Models\Candidate::where('status','rejected')->count();

            $totalInterviews = \App\Models\Interview::count();
            $completedInterviews = \App\Models\Interview::where('status','completed')->count();
            $scheduledInterviews = $totalInterviews - $completedInterviews;
        @endphp

        <!-- Key Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="stat-card">
                <div class="icon-box bg-blue-50 text-blue-600">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Candidates</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $totalCandidates }}</h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box bg-amber-50 text-amber-600">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pending Review</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $pendingCandidates }}</h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box bg-emerald-50 text-emerald-600">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Selected</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $selectedCandidates }}</h3>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box bg-rose-50 text-rose-600">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rejected</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $rejectedCandidates }}</h3>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- Interview Overview -->
            <div class="lg:col-span-7">
                <div class="glass-card shadow-xl border-slate-200/60 overflow-hidden h-full">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="font-extrabold text-slate-900 text-sm uppercase tracking-wider">Interview Analytics</h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Live Stats</span>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-3 gap-4 mb-10">
                            <div class="text-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-2xl font-black text-slate-900 block">{{ $totalInterviews }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Total</span>
                            </div>
                            <div class="text-center p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                                <span class="text-2xl font-black text-emerald-700 block">{{ $completedInterviews }}</span>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase">Completed</span>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                <span class="text-2xl font-black text-blue-700 block">{{ $scheduledInterviews }}</span>
                                <span class="text-[10px] font-bold text-blue-600 uppercase">Scheduled</span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest">Completion Rate</h4>
                            @php 
                                $rate = $totalInterviews > 0 ? round(($completedInterviews / $totalInterviews) * 100) : 0;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex justify-between items-end">
                                    <span class="text-sm font-bold text-slate-600">Pipeline Efficiency</span>
                                    <span class="text-sm font-black text-slate-900">{{ $rate }}%</span>
                                </div>
                                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 rounded-full transition-all duration-1000" style="width: {{ $rate }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="lg:col-span-5">
                <div class="glass-card shadow-xl border-slate-200/60 overflow-hidden h-full">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-extrabold text-slate-900 text-sm uppercase tracking-wider">Operational Hub</h3>
                    </div>
                    <div class="p-8 space-y-4">
                        <a href="{{ route('candidates.index') }}" class="action-btn">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <i class="bi bi-person-lines-fill"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-slate-900">Manage Candidates</p>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">View, Edit & Status Updates</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                        </a>

                        <a href="{{ route('interviews.index') }}" class="action-btn">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-slate-900">Schedule Interviews</p>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Book Rounds & Panels</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                        </a>

                        <a href="/admin/results" class="action-btn">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <i class="bi bi-bar-chart-line"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold text-slate-900">Performance Results</p>
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Scores & Feedback Analysis</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-12 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.4em]">Interview Management System &copy; {{ date('Y') }}</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-20 pb-12 px-6">
        <div class="max-w-7xl mx-auto text-center border-t border-slate-800 pt-12">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.3em]">&copy; 2026 Softmatric Technologies. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>