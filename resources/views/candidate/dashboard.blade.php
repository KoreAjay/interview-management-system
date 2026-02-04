<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Candidate Dashboard</title>
    
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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
        }

        .status-badge {
            @apply px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-selected { background: #dcfce7; color: #166534; }
        .status-rejected { background: #fee2e2; color: #991b1b; }

        /* Proper Dropdown Logic */
        .dropdown-content {
            display: none;
            animation: fadeInScale 0.2s ease-out;
        }
        .dropdown-content.show {
            display: block;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: translateY(10px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        
        .nav-blur {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="antialiased hero-gradient min-h-screen">

    <!-- Navbar -->
    <nav class="fixed w-full z-[100] top-0 nav-blur border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer" onclick="window.location.href='/'">
                <div class="bg-slate-900 p-2 rounded-xl group-hover:bg-emerald-500 transition-all duration-300">
                    <i class="bi bi-cpu text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden lg:flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-full border border-emerald-100">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-bold text-emerald-700 tracking-widest uppercase">Live Candidate Portal</span>
                </div>
                
                <!-- Account Dropdown -->
                <div class="relative" id="profileDropdown">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 bg-white border border-slate-200 p-1.5 pr-4 rounded-2xl hover:border-emerald-500 transition-all shadow-sm active:scale-95">
                        <div class="w-8 h-8 rounded-xl bg-slate-900 flex items-center justify-center text-white overflow-hidden shadow-inner">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'C') }}&background=0f172a&color=fff" class="w-full h-full object-cover">
                        </div>
                        <div class="text-left hidden md:block">
                            <p class="text-xs font-bold text-slate-900 leading-none mb-0.5">{{ Auth::user()->name ?? 'Candidate' }}</p>
                            <p class="text-[9px] font-medium text-slate-500 truncate w-24">{{ Auth::user()->email ?? 'mail@domain.com' }}</p>
                        </div>
                        <i class="bi bi-chevron-down text-slate-400 text-[10px]"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="dropdown-content absolute right-0 top-full mt-3 w-64 bg-white border border-slate-200 rounded-2xl shadow-2xl p-2 z-[110]">
                        <div class="px-4 py-3 border-b border-slate-50 mb-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Logged in as</p>
                            <p class="text-sm font-bold text-slate-900 break-all leading-tight">{{ Auth::user()->email ?? 'candidate@email.com' }}</p>
                        </div>
                        <a href="{{ route('candidate.profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-600 hover:bg-slate-50 rounded-xl transition-colors text-sm font-semibold">
                            <i class="bi bi-person-gear text-lg"></i> Account Settings
                        </a>
                        <hr class="my-1 border-slate-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-rose-500 hover:bg-rose-50 rounded-xl transition-colors text-sm font-bold">
                                <i class="bi bi-box-arrow-right text-lg"></i> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto pt-32 pb-20 px-6">
        
        <!-- Welcome Header -->
        <div class="dashboard-header p-8 md:p-12 mb-10 text-white shadow-2xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 bg-emerald-500/20 backdrop-blur-md px-3 py-1 rounded-lg border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-300">Candidate Dashboard</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">
                        Hello, <span class="text-emerald-400">{{ explode(' ', Auth::user()->name ?? 'Innovator')[0] }}</span>!
                    </h1>
                    <p class="text-slate-400 max-w-lg text-sm md:text-base font-medium">
                        Your application is currently being processed. Check your status and emails frequently for updates.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('candidate.profile') }}" class="bg-white text-slate-900 hover:bg-emerald-50 px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-lg flex items-center gap-2 active:scale-95">
                        <i class="bi bi-pencil-square"></i> Update Profile
                    </a>
=======
@extends('layouts.app')

@section('content')
<div class="container py-4">

    @php
        $user = auth()->user();
        $candidate = \App\Models\Candidate::where('email', $user->email)->first();
    @endphp

    {{-- Top Welcome Card --}}
    <div class="card text-white mb-4 shadow-lg"
         style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">Candidate Dashboard</h2>
                <p class="mb-0">
                    Welcome back, <strong>{{ $user->name }}</strong> 👋  
                    Track your profile and interview progress.
                </p>
            </div>
            <a href="{{ route('candidate.profile') }}" class="btn btn-light fw-semibold">
                Edit Profile
            </a>
        </div>
    </div>

    <div class="row g-4">

        {{-- Profile Card --}}
        <div class="col-md-4">
            <div class="card shadow border-0 h-100 text-center">

                <div class="card-body">

                    {{-- Profile Image --}}
                    <img src="{{ $candidate && $candidate->profile_image
                        ? asset('storage/'.$candidate->profile_image)
                        : 'https://ui-avatars.com/api/?name='.$user->name.'&background=4facfe&color=fff' }}"
                        class="rounded-circle mb-3 border"
                        width="130" height="130"
                        alt="Profile Image">

                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    {{-- Status Badge --}}
                    <span class="badge px-3 py-2
                        {{ $candidate && $candidate->status == 'selected' ? 'bg-success' :
                           ($candidate && $candidate->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ ucfirst($candidate->status ?? 'pending') }}
                    </span>

                    <hr>

                    {{-- Resume --}}
                    @if($candidate && $candidate->resume)
                        <a href="{{ asset('resumes/'.$candidate->resume) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm w-100 mb-2">
                            View Resume
                        </a>
                    @else
                        <p class="text-muted small">Resume not uploaded</p>
                    @endif
>>>>>>> 27f0eb8d9d09404577336b9cfa458d95344a0515
                </div>
            </div>
        </div>

<<<<<<< HEAD
        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- Profile Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="glass-card p-8 text-center border-slate-200/60 shadow-sm">
                    <div class="relative w-32 h-32 mx-auto mb-6">
                        <div class="w-full h-full rounded-3xl border-4 border-white shadow-2xl overflow-hidden bg-slate-100 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                             @php
                                $user = auth()->user();
                                $candidate = \App\Models\Candidate::where('email', $user->email)->first();
                            @endphp
                            <img src="{{ $candidate && $candidate->profile_image ? asset('storage/'.$candidate->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=10b981&color=fff&size=200' }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-white p-1 rounded-xl shadow-lg">
                            <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-black text-slate-900 leading-tight">{{ $user->name }}</h2>
                    <p class="text-sm text-emerald-600 font-bold mt-1 break-all">{{ $user->email }}</p>

                    <div class="mt-6 flex flex-wrap justify-center gap-2">
                        @php 
                            $statusClass = 'status-pending';
                            $status = $candidate->status ?? 'pending';
                            if($status == 'selected') $statusClass = 'status-selected';
                            if($status == 'rejected') $statusClass = 'status-rejected';
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            Current Status: {{ $status }}
                        </span>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        @if($candidate && $candidate->resume)
                            <a href="{{ asset('resumes/'.$candidate->resume) }}" target="_blank" class="flex items-center justify-center gap-2 bg-slate-900 text-white py-4 rounded-2xl text-xs font-bold hover:bg-emerald-600 transition-all shadow-lg active:scale-95 w-full">
                                <i class="bi bi-file-earmark-text"></i> View Submitted Resume
                            </a>
                        @else
                            <div class="bg-rose-50 border border-rose-100 p-4 rounded-2xl text-rose-700">
                                <p class="text-[10px] font-black uppercase tracking-widest mb-1">Incomplete Profile</p>
                                <p class="text-xs font-semibold">Please upload your resume to be considered for roles.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Details Grid -->
                <div class="glass-card overflow-hidden shadow-sm border-slate-200/60">
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <div>
                            <h3 class="font-black text-slate-900 text-base">Application Profile</h3>
                            <p class="text-xs text-slate-500 font-medium">Verify your registered information below</p>
                        </div>
                        <i class="bi bi-fingerprint text-slate-300 text-3xl"></i>
                    </div>
                    <div class="p-8 grid sm:grid-cols-2 gap-y-8 gap-x-12">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Full Registered Name</label>
                            <p class="text-slate-900 font-bold text-lg">{{ $user->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Login Email</label>
                            <p class="text-emerald-600 font-bold text-lg break-all">{{ $user->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Contact Number</label>
                            <p class="text-slate-900 font-bold text-lg">{{ $candidate->phone ?? '---' }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Department Preference</label>
                            <p class="text-slate-900 font-bold text-lg">Tech & Engineering</p>
                        </div>
                        <div class="space-y-1 sm:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Physical Address</label>
                            <p class="text-slate-900 font-bold text-lg leading-snug">{{ $candidate->address ?? 'Not specified' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pipeline Section -->
                <div class="glass-card shadow-sm border-slate-200/60 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-black text-slate-900 text-base">Interview Roadmap</h3>
                    </div>
                    <div class="p-8">
                        @if($candidate && $candidate->interviews->count())
                            <!-- Interview Card -->
                            <div class="flex flex-col md:flex-row items-center gap-6 p-6 bg-slate-900 rounded-3xl text-white relative shadow-xl overflow-hidden group">
                                <div class="w-20 h-20 bg-emerald-500 rounded-2xl flex flex-col items-center justify-center shrink-0 shadow-lg group-hover:scale-105 transition-transform">
                                    <span class="text-[11px] font-black uppercase tracking-tighter opacity-80">{{ \Carbon\Carbon::parse($candidate->interviews->last()->date)->format('M') }}</span>
                                    <span class="text-3xl font-black">{{ \Carbon\Carbon::parse($candidate->interviews->last()->date)->format('d') }}</span>
                                </div>
                                <div class="flex-grow text-center md:text-left">
                                    <h4 class="text-xl font-black mb-1">{{ $candidate->interviews->last()->round }}</h4>
                                    <p class="text-slate-400 text-sm font-medium">Live Interview Session • {{ \Carbon\Carbon::parse($candidate->interviews->last()->date)->format('h:i A') }}</p>
                                </div>
                                <div class="shrink-0 w-full md:w-auto">
                                    <span class="block text-center px-6 py-2 rounded-xl bg-white/10 border border-white/20 text-emerald-400 text-xs font-black uppercase tracking-widest">
                                        {{ $candidate->interviews->last()->status }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-12 px-6">
                                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-slate-100">
                                    <i class="bi bi-calendar2-minus text-3xl text-slate-300"></i>
                                </div>
                                <h4 class="text-slate-900 font-black text-xl mb-2">Awaiting Scheduling</h4>
                                <p class="text-slate-500 text-sm max-w-sm mx-auto font-medium">
                                    Your profile is currently in the shortlisting phase. We'll update your roadmap once an interviewer is assigned.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white py-12 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            <div>
                <span class="text-xl font-black">Soft<span class="text-emerald-500">matric</span></span>
                <p class="text-slate-500 text-xs mt-1 font-bold tracking-widest uppercase">Candidate Portal v2.0</p>
            </div>
            <p class="text-[10px] text-slate-600 font-black uppercase tracking-[0.3em]">&copy; 2026 Softmatric Technologies.</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const menu = document.getElementById('dropdownMenu');
            if (!dropdown.contains(e.target)) {
                menu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
=======
        {{-- Details Card --}}
        <div class="col-md-8">
            <div class="card shadow border-0 h-100">

                <div class="card-header bg-white">
                    <h5 class="mb-0">Profile & Interview Details</h5>
                </div>

                <div class="card-body">

                    {{-- Profile Info --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Phone:</strong><br>
                                {{ $candidate->phone ?? 'Not updated' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Address:</strong><br>
                                {{ $candidate->address ?? 'Not updated' }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    {{-- Interview Info --}}
                    <h6 class="mb-3">Interview Information</h6>

                    @if($candidate && $candidate->interviews->count())
                        @php
                            $interview = $candidate->interviews->last();
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Round</strong><br>{{ $interview->round }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date</strong><br>{{ $interview->date }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Status</strong><br>
                                    <span class="badge bg-info">
                                        {{ ucfirst($interview->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">
                            No interview scheduled yet. You will be notified once scheduled.
                        </p>
                    @endif

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
>>>>>>> 27f0eb8d9d09404577336b9cfa458d95344a0515
