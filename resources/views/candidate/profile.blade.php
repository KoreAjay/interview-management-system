<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Edit Profile</title>
    
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

        .form-input {
            @apply w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none text-slate-900 text-sm font-medium;
        }

        .form-label {
            @apply text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block mb-2 ml-1;
        }

        .btn-primary {
            @apply bg-slate-900 text-white hover:bg-emerald-600 px-8 py-4 rounded-2xl text-sm font-extrabold transition-all shadow-lg flex items-center justify-center gap-2 active:scale-95;
        }
    </style>
</head>
<body class="antialiased hero-gradient min-h-screen">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-lg border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer" onclick="window.location='{{ route('candidate.dashboard') }}'">
                <div class="bg-slate-900 p-2 rounded-xl group-hover:bg-emerald-500 transition-all duration-300">
                    <i class="bi bi-cpu text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('candidate.dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto pt-32 pb-20 px-6">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Profile</h1>
                <p class="text-slate-500 text-sm font-medium">Keep your professional information up to date.</p>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                <i class="bi bi-person-gear text-2xl"></i>
            </div>
        </div>

        <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="glass-card p-8 md:p-10 shadow-xl border-slate-200/60">
                <div class="grid md:grid-cols-2 gap-6">
                    
                    <!-- Basic Info Section -->
                    <div class="md:col-span-2 flex items-center gap-3 mb-2">
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold">01</span>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Account Information</h3>
                    </div>

                    <div class="space-y-1">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" value="{{ $user->name }}" placeholder="Enter your full name" required>
                    </div>

                    <div class="space-y-1">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ $user->email }}" placeholder="name@company.com" required>
                    </div>

                    <div class="space-y-1">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" value="{{ $candidate->phone ?? '' }}" placeholder="+1 (555) 000-0000">
                    </div>

                    <div class="space-y-1">
                        <label class="form-label">Profile Picture</label>
                        <div class="relative group">
                            <input type="file" name="profile_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="form-input flex items-center gap-3 bg-slate-50 border-dashed border-2 group-hover:border-emerald-500 group-hover:bg-emerald-50/30 transition-all">
                                <i class="bi bi-image text-slate-400"></i>
                                <span class="text-slate-500 text-xs">Choose image...</span>
                            </div>
                        </div>
                    </div>

                    <!-- Address & Experience Section -->
                    <div class="md:col-span-2 flex items-center gap-3 mt-6 mb-2">
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold">02</span>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Professional Details</h3>
                    </div>

                    <div class="md:col-span-2 space-y-1">
                        <label class="form-label">Postal Address</label>
                        <textarea name="address" rows="3" class="form-input resize-none" placeholder="Street, City, State, ZIP">{{ $candidate->address ?? '' }}</textarea>
                    </div>

                    <div class="md:col-span-2 space-y-1">
                        <label class="form-label">Curriculum Vitae (Resume)</label>
                        <div class="relative group">
                            <input type="file" name="resume" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="form-input flex flex-col items-center justify-center py-10 bg-slate-50 border-dashed border-2 group-hover:border-emerald-500 group-hover:bg-emerald-50/30 transition-all text-center">
                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 text-slate-400 group-hover:text-emerald-500 transition-colors">
                                    <i class="bi bi-cloud-arrow-up text-2xl"></i>
                                </div>
                                <span class="text-slate-900 font-bold text-sm">Upload New Resume</span>
                                <span class="text-slate-400 text-xs mt-1">PDF, DOCX up to 5MB</span>
                            </div>
                        </div>
                        @if($candidate && $candidate->resume)
                            <p class="mt-2 text-[10px] font-bold text-emerald-600 flex items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> Current resume: {{ $candidate->resume }}
                            </p>
                        @endif
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('candidate.dashboard') }}" class="px-8 py-4 rounded-2xl text-sm font-extrabold text-slate-500 hover:text-slate-900 transition-all">
                    Cancel
                </a>
                <button type="submit" class="btn-primary min-w-[200px]">
                    Update Profile
                </button>
            </div>
        </form>
    </main>

    <footer class="bg-slate-900 text-white pt-20 pb-12 px-6">
        <div class="max-w-7xl mx-auto text-center border-t border-slate-800 pt-12">
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.3em]">&copy; 2026 Softmatric Technologies. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
=======
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Edit Profile</h3>

    <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ $user->name }}" required>
            </div>

            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ $user->email }}" required>
            </div>

            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ $candidate->phone ?? '' }}">
            </div>

            <div class="col-md-6">
                <label>Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
            </div>

            <div class="col-12">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $candidate->address ?? '' }}</textarea>
            </div>

            <div class="col-12">
                <label>Resume</label>
                <input type="file" name="resume" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary mt-4">Update Profile</button>
    </form>

</div>
@endsection
>>>>>>> 27f0eb8d9d09404577336b9cfa458d95344a0515
