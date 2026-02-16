<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Add New Candidate</title>

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

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
            display: none;
        }
        
        .custom-file-input::before {
            content: 'Browse File';
            display: inline-block;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px 12px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-weight: 700;
            font-size: 12px;
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900" x-data="{ sidebarOpen: false }">

    <!-- Sidebar (Keeping consistent with Dashboard) -->
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
                <i class="bi bi-person-plus-fill mr-3 text-lg"></i> Candidates
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
                    <h1 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Add New Candidate</h1>
                    <p class="text-xs text-slate-400">Create a new talent profile in the database</p>
                </div>
            </div>
        </header>

        <main class="p-4 lg:p-8 flex-1">
            <div class="max-w-5xl mx-auto">
                
                <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                        <!-- Form Header -->
                        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                                    <i class="bi bi-person-bounding-box text-lg"></i>
                                </div>
                                <h2 class="font-bold text-slate-800">Candidate Information</h2>
                            </div>
                            <span class="text-[10px] font-bold bg-white px-3 py-1 rounded-full border border-slate-200 text-slate-400 uppercase tracking-tighter">New Entry</span>
                        </div>

                        <!-- Form Body -->
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                
                                <!-- Personal Info Section -->
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Full Name <span class="text-rose-500">*</span></label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="name" required placeholder="e.g. John Doe"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Email Address <span class="text-rose-500">*</span></label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="email" name="email" required placeholder="john@example.com"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Mobile Number</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-telephone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="mobile" placeholder="+1 (555) 000-0000"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Location</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-geo-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="location" placeholder="City, Country"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>
                                </div>

                                <!-- Career Info Section -->
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Target Position</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="position" placeholder="e.g. Senior Frontend Developer"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Experience (Yrs)</label>
                                            <input type="number" name="experience" placeholder="0"
                                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Notice (Days)</label>
                                            <input type="number" name="notice_period" placeholder="30"
                                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Current Company</label>
                                        <div class="form-input-box relative border border-slate-200 rounded-2xl bg-slate-50/50 transition-all">
                                            <i class="bi bi-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                            <input type="text" name="current_company" placeholder="Company Name"
                                                class="w-full pl-11 pr-4 py-3 bg-transparent text-sm focus:outline-none">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Current CTC</label>
                                            <input type="text" name="current_ctc" placeholder="0.00"
                                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Expected CTC</label>
                                            <input type="text" name="expected_ctc" placeholder="0.00"
                                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resume Upload -->
                            <div class="mt-8 pt-8 border-t border-slate-100">
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest pl-1">Resume / CV (PDF or Word)</label>
                                    <div class="relative border-2 border-dashed border-slate-200 rounded-[2rem] p-8 transition-all hover:bg-slate-50 group text-center">
                                        <i class="bi bi-cloud-arrow-up text-4xl text-slate-300 group-hover:text-emerald-500 transition-colors"></i>
                                        <p class="mt-2 text-sm text-slate-500">Drag and drop file here or click to upload</p>
                                        <input type="file" name="resume" 
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer Actions -->
                        <div class="px-8 py-6 bg-slate-50/80 border-t border-slate-100 flex items-center justify-end gap-4">
                            <button type="button" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-10 py-3 bg-emerald-600 text-white text-sm font-extrabold rounded-2xl hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-100">
                                Save Candidate Profile
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </main>
    </div>

</body>
</html>