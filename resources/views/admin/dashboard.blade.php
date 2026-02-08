<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Admin Dashboard</title>

    <!-- Typography & Icons -->
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar for Sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        .sidebar-link:hover { background-color: #f8fafc; color: #059669; }
        .sidebar-link.active { background-color: #10b981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25); }
        
        .stat-card:hover .icon-box { transform: scale(1.1); transition: all 0.3s ease; }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-slate-900/40 z-40 lg:hidden backdrop-blur-sm" x-cloak></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 transition-transform duration-300 ease-in-out flex flex-col">
        
        <!-- Sidebar Header -->
        <div class="p-6 flex items-center justify-between">
            <h2 class="font-extrabold text-2xl tracking-tight">
                Soft<span class="text-emerald-600">matric</span>
            </h2>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-2 space-y-1 sidebar-scroll overflow-y-auto">
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Navigation</p>
            
            <a href="#" class="sidebar-link active flex items-center px-4 py-2.5 rounded-xl font-semibold transition-all group">
                <i class="bi bi-grid-1x2-fill mr-3 text-lg"></i>
                Dashboard
            </a>

            <a href="{{ route('candidates.index') }}" class="sidebar-link flex items-center px-4 py-2.5 text-slate-500 rounded-xl transition-all group">
                <i class="bi bi-people mr-3 text-lg"></i>
                Candidates
            </a>

            <a href="{{ route('interviews.index') }}" class="sidebar-link flex items-center px-4 py-2.5 text-slate-500 rounded-xl transition-all group">
                <i class="bi bi-calendar-check mr-3 text-lg"></i>
                Interviews
            </a>

            <p class="pt-8 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Support & Admin</p>

            <a href="{{ route('admin.results') }}" class="sidebar-link flex items-center px-4 py-2.5 text-slate-500 rounded-xl transition-all group">
                <i class="bi bi-bar-chart-line mr-3 text-lg"></i>
                Reports
            </a>

            <a href="#" class="sidebar-link flex items-center px-4 py-2.5 text-slate-500 rounded-xl transition-all group">
                <i class="bi bi-gear mr-3 text-lg"></i>
                Settings
            </a>
        </nav>

        <!-- Sidebar Footer (Logout) -->
        <div class="p-4 border-t border-slate-100">
            <form method="POST" action="/logout">
                <button class="flex items-center w-full px-4 py-2.5 text-slate-500 hover:text-rose-600 rounded-xl transition-colors">
                    <i class="bi bi-box-arrow-left mr-3 text-lg"></i>
                    <span class="font-semibold text-sm">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        
        <!-- Top Sticky Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 bg-slate-100 rounded-lg">
                    <i class="bi bi-list text-xl"></i>
                </button>
                <div class="hidden sm:block">
                    <h1 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Dashboard Overview</h1>
                    <p class="text-xs text-slate-400">Welcome back, {{ auth()->user()->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-400 hover:bg-slate-100 rounded-xl relative">
                    <i class="bi bi-bell text-xl"></i>
                    <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 border-2 border-white rounded-full"></span>
                </button>
                
                <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-tight">Administrator</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold border-2 border-white shadow-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Main Content -->
        <main class="p-4 lg:p-8 flex-1">
            
            @php
                // These would normally be fetched from your controller
                $totalCandidates = \App\Models\Candidate::count();
                $pendingCandidates = \App\Models\Candidate::where('status','pending')->count();
                $selectedCandidates = \App\Models\Candidate::where('status','selected')->count();
                $rejectedCandidates = \App\Models\Candidate::where('status','rejected')->count();
            @endphp

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <div class="stat-card bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all hover:shadow-lg">
                    <div class="icon-box w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 transition-transform">
                        <i class="bi bi-people-fill text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Candidates</p>
                    <h2 class="text-3xl font-extrabold mt-1">{{ $totalCandidates }}</h2>
                </div>

                <div class="stat-card bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all hover:shadow-lg">
                    <div class="icon-box w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4 transition-transform">
                        <i class="bi bi-hourglass-split text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Pending</p>
                    <h2 class="text-3xl font-extrabold mt-1 text-slate-800">{{ $pendingCandidates }}</h2>
                </div>

                <div class="stat-card bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all hover:shadow-lg">
                    <div class="icon-box w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 transition-transform">
                        <i class="bi bi-check2-circle text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Selected</p>
                    <h2 class="text-3xl font-extrabold mt-1 text-emerald-600">{{ $selectedCandidates }}</h2>
                </div>

                <div class="stat-card bg-white p-6 rounded-3xl border border-slate-200 shadow-sm transition-all hover:shadow-lg">
                    <div class="icon-box w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4 transition-transform">
                        <i class="bi bi-x-circle text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Rejected</p>
                    <h2 class="text-3xl font-extrabold mt-1 text-rose-600">{{ $rejectedCandidates }}</h2>
                </div>
            </div>

            <!-- Quick Action Hub -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-800">Action Center</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Primary Action -->
                    <a href="{{ route('candidates.create') }}" class="group relative bg-emerald-600 p-6 rounded-[2rem] overflow-hidden transition-all hover:-translate-y-1 shadow-lg shadow-emerald-200">
                        <div class="relative z-10 flex flex-col justify-between h-full">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4 backdrop-blur-md">
                                <i class="bi bi-plus-lg text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Add Candidate</h4>
                                <p class="text-emerald-100 text-xs mt-0.5">Register new profile</p>
                            </div>
                        </div>
                        <i class="bi bi-person-plus absolute -bottom-2 -right-2 text-6xl text-white/10 group-hover:scale-125 transition-transform"></i>
                    </a>

                    <!-- Standard Actions -->
                    <a href="{{ route('candidates.index') }}" class="group bg-white p-6 rounded-[2rem] border border-slate-200 transition-all hover:border-emerald-300 hover:shadow-md flex flex-col justify-between">
                        <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800">Manage All</h4>
                            <p class="text-slate-400 text-xs mt-0.5">Filter & Edit Candidates</p>
                        </div>
                    </a>

                    <a href="{{ route('interviews.index') }}" class="group bg-white p-6 rounded-[2rem] border border-slate-200 transition-all hover:border-amber-300 hover:shadow-md flex flex-col justify-between">
                        <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-50 group-hover:text-amber-600 transition-colors">
                            <i class="bi bi-calendar2-week"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800">Schedules</h4>
                            <p class="text-slate-400 text-xs mt-0.5">View Interview Pipeline</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.results') }}" class="group bg-white p-6 rounded-[2rem] border border-slate-200 transition-all hover:border-blue-300 hover:shadow-md flex flex-col justify-between">
                        <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                            <i class="bi bi-activity"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800">Analytics</h4>
                            <p class="text-slate-400 text-xs mt-0.5">Hiring Trends & Data</p>
                        </div>
                    </a>

                </div>
            </div>

        </main>
    </div>

</body>
</html>