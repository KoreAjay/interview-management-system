<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Candidates Management</title>

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
        
        .status-pill {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            padding: 4px 12px;
            border-radius: 9999px;
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
            <a href="{{route('admin.dashboard')  }}" class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-grid-1x2 mr-3 text-lg"></i> Dashboard
            </a>
            <a href="#" class="flex items-center px-4 py-2.5 bg-emerald-500 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200">
                <i class="bi bi-people-fill mr-3 text-lg"></i> Candidates
            </a>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-slate-500 rounded-xl font-semibold transition-all hover:bg-slate-50">
                <i class="bi bi-check-circle mr-3 text-lg"></i> Final Results
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
                    <h1 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Candidate Database</h1>
                    <p class="text-xs text-slate-400">Manage all registered applicants and their profiles</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('candidates.create') }}" class="hidden md:flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                    <i class="bi bi-plus-lg"></i>
                    Add Candidate
                </a>
            </div>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-7xl mx-auto">
                
                <!-- Filters & Search Bar -->
                <div class="bg-white p-4 rounded-[2rem] border border-slate-200 mb-6 flex flex-col md:flex-row gap-4 items-center justify-between shadow-sm">
                    <div class="flex items-center bg-slate-100 rounded-2xl px-4 py-2.5 w-full md:w-96">
                        <i class="bi bi-search text-slate-400 mr-3"></i>
                        <input type="text" placeholder="Search by name, email or position..." class="bg-transparent border-none text-sm focus:ring-0 w-full text-slate-600">
                    </div>
                    <div class="flex items-center gap-2">
                        <select class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-xs font-bold text-slate-500 focus:ring-2 focus:ring-emerald-500/20">
                            <option>All Positions</option>
                            <option>UI/UX Designer</option>
                            <option>Fullstack Developer</option>
                        </select>
                        <select class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-xs font-bold text-slate-500 focus:ring-2 focus:ring-emerald-500/20">
                            <option>All Status</option>
                            <option>New</option>
                            <option>In-Review</option>
                            <option>Hired</option>
                        </select>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">ID</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Candidate</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Contact Info</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Target Role</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($candidates as $candidate)
                                <tr class="table-row-hover transition-all duration-200">
                                    <td class="px-8 py-5">
                                        <span class="text-xs font-bold text-slate-300">#{{ $candidate->id }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-[11px] font-bold text-slate-500">
                                                {{ strtoupper(substr($candidate->name, 0, 1)) }}{{ strtoupper(substr(strrchr($candidate->name, ' '), 1, 1)) }}
                                            </div>
                                            <span class="text-sm font-bold text-slate-800">{{ $candidate->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="space-y-0.5">
                                            <p class="text-[11px] font-medium text-slate-600 flex items-center gap-1.5">
                                                <i class="bi bi-envelope text-slate-400"></i> {{ $candidate->email }}
                                            </p>
                                            <p class="text-[11px] font-medium text-slate-600 flex items-center gap-1.5">
                                                <i class="bi bi-phone text-slate-400"></i> {{ $candidate->phone }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-xs font-semibold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg">
                                            {{ $candidate->position }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @php
                                            $statusClass = match(strtolower($candidate->status)) {
                                                'hired', 'selected' => 'bg-emerald-50 text-emerald-600',
                                                'rejected' => 'bg-rose-50 text-rose-600',
                                                'new' => 'bg-blue-50 text-blue-600',
                                                default => 'bg-amber-50 text-amber-600'
                                            };
                                        @endphp
                                        <span class="status-pill {{ $statusClass }}">
                                            {{ $candidate->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('candidates.show', $candidate->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" onclick="return confirm('Archive this candidate profile?')" title="Delete">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>