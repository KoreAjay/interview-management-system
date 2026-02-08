<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Pending Candidates</title>

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
            <a href="dashboard.html" class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-grid-1x2 mr-3 text-lg"></i> Dashboard
            </a>
            <a href="#" class="flex items-center px-4 py-2.5 bg-emerald-500 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200">
                <i class="bi bi-people-fill mr-3 text-lg"></i> Candidates
            </a>
            <a href="schedule_interview.html" class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-calendar-event mr-3 text-lg"></i> Interviews
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
                    <h1 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Pending Candidates</h1>
                    <p class="text-xs text-slate-400">Queue of candidates awaiting interview scheduling</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="hidden md:flex items-center bg-slate-100 rounded-xl px-3 py-1.5 border border-slate-200">
                    <i class="bi bi-search text-slate-400 mr-2 text-xs"></i>
                    <input type="text" placeholder="Quick search..." class="bg-transparent border-none text-xs focus:ring-0 w-40">
                </div>
            </div>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-6xl mx-auto">
                
                <!-- Stats Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-200 flex items-center gap-4">
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                            <i class="bi bi-hourglass-split text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pending</p>
                            <h3 class="text-2xl font-extrabold text-slate-800">{{ count($candidates) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Candidate Info</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Target Role</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Experience</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($candidates as $c)
                                <tr class="table-row-hover transition-all duration-200">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-slate-100 border-2 border-white shadow-sm flex items-center justify-center font-bold text-slate-500 text-xs">
                                                {{ strtoupper(substr($c->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">{{ $c->name }}</p>
                                                <p class="text-[11px] text-slate-400">{{ $c->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-sm font-semibold text-slate-600 flex items-center gap-2">
                                            <i class="bi bi-briefcase text-slate-300"></i>
                                            {{ $c->position }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold">
                                            {{ $c->experience }} YRS
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-1.5 text-amber-500">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span class="text-[10px] font-bold uppercase tracking-tight">Schedule Needed</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <a href="{{ route('interviews.create', $c->id) }}" 
                                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-emerald-600 hover:shadow-lg hover:shadow-emerald-100 transition-all active:scale-95">
                                            <i class="bi bi-calendar-plus"></i>
                                            Schedule
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                                @if(count($candidates) == 0)
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                                <i class="bi bi-inbox text-slate-300 text-2xl"></i>
                                            </div>
                                            <h4 class="text-slate-800 font-bold">No pending candidates</h4>
                                            <p class="text-slate-400 text-xs mt-1">Great job! All candidates have been processed.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Table Footer -->
                    <div class="px-8 py-4 bg-slate-50/30 border-t border-slate-100 flex items-center justify-between">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Showing {{ count($candidates) }} entries
                        </p>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>