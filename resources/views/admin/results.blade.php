<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Final Results</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border: 1px solid rgba(226, 232, 240, 0.6); }
        .tab-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>

<body class="antialiased min-h-screen">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h2 class="font-extrabold text-2xl tracking-tight text-slate-900">Soft<span class="text-emerald-600">matric</span></h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
                    <i class="bi bi-arrow-left mr-1"></i> Dashboard
                </a>
                <span class="h-4 w-px bg-slate-200"></span>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xs font-bold">A</div>
                    <span class="text-xs font-bold text-slate-700">Admin Panel</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-10 px-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Merit List</h1>
                <p class="text-slate-500 font-medium mt-1">Finalized candidates based on multi-round interview feedback.</p>
            </div>
            
            <!-- Quick Stats Row -->
            <div class="flex gap-4">
                <div class="glass-card px-5 py-3 rounded-2xl shadow-sm text-center">
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Selected</p>
                    <p class="text-xl font-black text-slate-900">{{ $candidates->where('status','selected')->count() }}</p>
                </div>
                <div class="glass-card px-5 py-3 rounded-2xl shadow-sm text-center">
                    <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest">Rejected</p>
                    <p class="text-xl font-black text-slate-900">{{ $candidates->where('status','rejected')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-8">
            <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" placeholder="Search candidate by name or email..." 
                   class="w-full pl-14 pr-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-medium text-slate-600">
        </div>

        <!-- Candidate List -->
        <div class="space-y-4">
            @forelse($candidates as $index => $candidate)
                <div class="group">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-emerald-100">
                        
                        <!-- Top Level Summary -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between p-6 md:px-8">
                            <div class="flex items-center gap-6">
                                <span class="hidden md:block text-2xl font-black text-slate-100 group-hover:text-emerald-50/50 transition-colors">
                                    #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div class="relative">
                                    @if($candidate->profile_image)
                                        <img src="{{ asset('storage/' . $candidate->profile_image) }}" class="w-14 h-14 rounded-2xl object-cover ring-4 ring-slate-50">
                                    @else
                                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xl">
                                            {{ substr($candidate->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute -top-2 -right-2 px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-tighter border shadow-sm
                                        {{ $candidate->status == 'selected' ? 'bg-emerald-500 text-white border-emerald-400' : 'bg-rose-500 text-white border-rose-400' }}">
                                        {{ $candidate->status }}
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors">{{ $candidate->name }}</h3>
                                    <p class="text-sm text-slate-400 font-medium">{{ $candidate->email }}</p>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 flex items-center gap-6">
                                <div class="hidden lg:block text-right">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Interviews</p>
                                    <div class="flex -space-x-2">
                                        @foreach($candidate->interviews as $i)
                                            <div title="{{ $i->round }}" class="w-7 h-7 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-slate-600">
                                                {{ substr($i->round, 0, 1) }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button onclick="toggleFeedback('panel-{{ $candidate->id }}')" class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl text-xs font-bold hover:bg-emerald-600 transition-all active:scale-95 shadow-lg shadow-slate-200">
                                    View Detailed Feedback <i class="bi bi-chevron-down text-[10px]"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Expandable Feedback Panel -->
                        <div id="panel-{{ $candidate->id }}" class="hidden bg-slate-50/50 border-t border-slate-100 p-8">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                @forelse($candidate->interviews as $interview)
                                    @if($interview->feedback)
                                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex justify-between items-start mb-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white text-xs font-bold">
                                                            {{ substr($interview->interviewer->user->name ?? 'I', 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-bold text-slate-900">{{ $interview->interviewer->user->name ?? 'Unknown' }}</p>
                                                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $interview->interviewer->designation }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 bg-amber-50 px-3 py-1 rounded-full">
                                                        <i class="bi bi-star-fill text-amber-500 text-[10px]"></i>
                                                        <span class="text-xs font-black text-amber-700">{{ $interview->feedback->rating }}/5</span>
                                                    </div>
                                                </div>

                                                <div class="inline-block px-2 py-1 bg-slate-100 rounded text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">
                                                    {{ $interview->round }} Round
                                                </div>

                                                <p class="text-sm text-slate-600 italic leading-relaxed mb-6">
                                                    "{{ $interview->feedback->remarks }}"
                                                </p>
                                            </div>

                                            <div class="pt-4 border-t border-slate-50 flex justify-between items-center">
                                                <span class="text-[10px] font-black uppercase tracking-wider
                                                    {{ $interview->feedback->result == 'selected' ? 'text-emerald-500' : 'text-rose-500' }}">
                                                    Result: {{ $interview->feedback->result }}
                                                </span>
                                                <span class="text-[10px] font-bold text-slate-300">
                                                    {{ date('d M Y', strtotime($interview->date)) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-span-full py-10 text-center">
                                        <p class="text-slate-400 text-sm font-medium italic">No interview data available for this candidate.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center bg-white rounded-3xl border border-dashed border-slate-300">
                    <i class="bi bi-person-x text-5xl text-slate-200 block mb-4"></i>
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-widest">No final results found in the system</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleFeedback(id) {
            const panel = document.getElementById(id);
            const isHidden = panel.classList.contains('hidden');
            
            // Close all other panels first (Optional - for accordion behavior)
            // document.querySelectorAll('[id^="panel-"]').forEach(p => p.classList.add('hidden'));

            if (isHidden) {
                panel.classList.remove('hidden');
                panel.classList.add('animate-in', 'fade-in', 'slide-in-from-top-2', 'duration-300');
            } else {
                panel.classList.add('hidden');
            }
        }
    </script>

</body>
</html>