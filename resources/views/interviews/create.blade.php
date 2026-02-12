<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Schedule Interview</title>

    <!-- Typography & Icons -->
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .form-input-box:focus-within {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .readonly-input {
            background-color: #f8fafc !important;
            color: #64748b;
            cursor: not-allowed;
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
            <a href="#" class="flex items-center px-4 py-2.5 bg-emerald-500 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200">
                <i class="bi bi-calendar-check-fill mr-3 text-lg"></i> Interviews
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        
        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="dashboard.html" class="p-2 text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Schedule Interview</h1>
                    <p class="text-xs text-slate-400">Assign interviewers and set meeting details</p>
                </div>
            </div>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-5xl mx-auto">
                
                <form method="POST" action="{{ route('interviews.store') }}">
                    @csrf
                    
                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">

                    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                        
                        <!-- Form Header -->
                        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="bi bi-calendar-event text-lg"></i>
                                </div>
                                <h2 class="font-bold text-slate-800">Interview Details</h2>
                            </div>
                        </div>

                        <!-- Form Body -->
                        <div class="p-8">
                            
                            <!-- Section: Candidate Preview (Read-Only) -->
                            <div class="mb-10 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <i class="bi bi-info-circle"></i> Candidate Preview
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Name</label>
                                        <p class="text-sm font-semibold text-slate-700">{{ $candidate->name }}</p>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Email</label>
                                        <p class="text-sm font-semibold text-slate-700">{{ $candidate->email }}</p>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Position</label>
                                        <p class="text-sm font-semibold text-slate-700">{{ $candidate->position }}</p>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-slate-400 uppercase">Experience</label>
                                        <p class="text-sm font-semibold text-slate-700">{{ $candidate->experience }} Years</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                
                                <!-- Scheduling Config -->
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Interviewer <span class="text-rose-500">*</span></label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                            <i class="bi bi-person-badge absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <select name="interviewer_id" required 
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none appearance-none">
                                                <option value="">-- Select Interviewer --</option>
                                                @foreach($interviewers as $interviewer)
                                                    <option value="{{ $interviewer->id }}">
                                                        {{ $interviewer->name }} ({{ $interviewer->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Interview Date <span class="text-rose-500">*</span></label>
                                            <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                                <input type="date" name="date" required 
                                                    class="w-full px-4 py-3 bg-transparent text-sm focus:outline-none">
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Start Time <span class="text-rose-500">*</span></label>
                                            <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                                <input type="time" name="time" required 
                                                    class="w-full px-4 py-3 bg-transparent text-sm focus:outline-none">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Interview Round</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                            <i class="bi bi-layers absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="round" placeholder="e.g. Technical Round 1"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>
                                </div>

                                <!-- Meeting Settings -->
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Interview Mode <span class="text-rose-500">*</span></label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                            <i class="bi bi-camera-video absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <select name="mode" required 
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none appearance-none">
                                                <option value="">Select Mode</option>
                                                <option value="online">Online (Video Call)</option>
                                                <option value="offline">Offline (In-Person)</option>
                                            </select>
                                            <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Meeting Link / Office Address</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-white transition-all">
                                            <i class="bi bi-link-45deg absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="meeting_link" placeholder="Paste Zoom/Google Meet link or office floor"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                        <p class="text-[10px] text-slate-400 pl-1 italic">This information will be sent to both candidate and interviewer.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="px-8 py-6 bg-slate-50/80 border-t border-slate-100 flex items-center justify-end gap-4">
                            <button type="button" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                                Discard
                            </button>
                            <button type="submit" class="px-10 py-3 bg-slate-900 text-white text-sm font-extrabold rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 flex items-center gap-2">
                                <i class="bi bi-send-check"></i>
                                Schedule Interview
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </main>
    </div>

</body>
</html>