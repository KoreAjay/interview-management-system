<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased hero-gradient min-h-screen">

<!-- NAVBAR -->
<nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-lg border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

        <div class="flex items-center gap-3">
            <div class="bg-slate-900 p-2 rounded-xl">
                <i class="bi bi-cpu text-white text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-slate-900">
                Soft<span class="text-emerald-500">matric</span>
            </span>
        </div>

        <div class="flex items-center gap-3">
            <span class="text-sm font-bold text-slate-700">
                {{ auth()->user()->name }}
            </span>
        </div>

    </div>
</nav>

<main class="max-w-7xl mx-auto pt-32 pb-20 px-6">

{{-- ================== STATS ================== --}}
@php
$totalCandidates = \App\Models\Candidate::count();
$pendingCandidates = \App\Models\Candidate::where('status','pending')->count();
$selectedCandidates = \App\Models\Candidate::where('status','selected')->count();
$rejectedCandidates = \App\Models\Candidate::where('status','rejected')->count();

$totalInterviews = \App\Models\Interview::count();
$completedInterviews = \App\Models\Interview::where('status','completed')->count();
$scheduledInterviews = \App\Models\Interview::where('status','scheduled')->count();
@endphp

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="p-6 bg-white shadow rounded-xl">
        <h4>Total Candidates</h4>
        <h2 class="text-2xl font-bold">{{ $totalCandidates }}</h2>
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        <h4>Pending</h4>
        <h2 class="text-2xl font-bold">{{ $pendingCandidates }}</h2>
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        <h4>Selected</h4>
        <h2 class="text-2xl font-bold">{{ $selectedCandidates }}</h2>
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        <h4>Rejected</h4>
        <h2 class="text-2xl font-bold">{{ $rejectedCandidates }}</h2>
    </div>

</div>

{{-- ================== QUICK ACTIONS ================== --}}
<div class="grid md:grid-cols-3 gap-6">

    {{-- ADD CANDIDATE --}}
    <a href="{{ route('candidates.create') }}"
       class="p-6 bg-white shadow rounded-xl flex justify-between items-center hover:bg-emerald-50">

        <div>
            <h4 class="font-bold">Add Candidate</h4>
            <p class="text-sm text-gray-500">Create new candidate</p>
        </div>

        <i class="bi bi-plus-circle text-2xl text-emerald-600"></i>
    </a>

    {{-- MANAGE CANDIDATES --}}
    <a href="{{ route('candidates.index') }}"
       class="p-6 bg-white shadow rounded-xl flex justify-between items-center hover:bg-blue-50">

        <div>
            <h4 class="font-bold">Manage Candidates</h4>
            <p class="text-sm text-gray-500">View all candidates</p>
        </div>

        <i class="bi bi-people text-2xl text-blue-600"></i>
    </a>

    {{-- SCHEDULE INTERVIEWS --}}
    <a href="{{ route('interviews.index') }}"
       class="p-6 bg-white shadow rounded-xl flex justify-between items-center hover:bg-amber-50">

        <div>
            <h4 class="font-bold">Schedule Interviews</h4>
            <p class="text-sm text-gray-500">Assign interviewer</p>
        </div>

        <i class="bi bi-calendar-event text-2xl text-amber-600"></i>
    </a>

</div>

</main>
</body>
</html>
