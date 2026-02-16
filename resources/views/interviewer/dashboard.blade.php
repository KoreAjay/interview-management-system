<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
            color: #1e293b;
        }

        .bg-mesh {
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.04) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(51, 65, 85, 0.03) 0px, transparent 50%);
        }

        .card-pro {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 10px 15px -3px rgba(0, 0, 0, 0.03);
            border-radius: 1.25rem;
        }

        .btn-primary-pro {
            @apply flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-[11px] font-bold uppercase tracking-wider rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200/50 active:scale-95;
        }

        /* Ghost Button for Profile */
        .btn-ghost-pro {
            @apply flex items-center justify-center gap-2 px-3 py-1.5 border border-slate-200 text-slate-600 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 hover:text-slate-900 transition-all active:scale-95;
        }

        .tr-hover:hover {
            background-color: rgba(248, 250, 252, 1);
        }

        .url-chip {
            @apply flex items-center gap-2 px-2 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[10px] font-mono text-slate-500 cursor-pointer hover:border-emerald-400 hover:text-emerald-600 transition-all;
        }

        /* Toast Animation */
        #toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #0f172a;
            color: #fff;
            text-align: center;
            border-radius: 12px;
            padding: 16px;
            position: fixed;
            z-index: 100;
            left: 50%;
            bottom: 30px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} }
        @keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }
    </style>
</head>
<body class="antialiased bg-mesh min-h-screen">

    <div id="toast"><i class="bi bi-check-circle-fill text-emerald-400 mr-2"></i> Link Copied to Clipboard</div>

    <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-xl border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="bg-emerald-600 p-2.5 rounded-xl shadow-md">
                    <i class="bi bi-person-video3 text-white text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-600">matric</span></span>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden sm:flex flex-col items-end">
                    <p class="text-xs font-bold text-slate-900 leading-none mb-1">{{ auth()->user()->name }}</p>
                    <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Authorized Access</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2.5 bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all border border-slate-200">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto pt-32 pb-20 px-6">

        @php
            $user = auth()->user();
            $interviews = \App\Models\Interview::with('candidate')
                ->where('interviewer_id', $user->id)
                ->latest()
                ->get();
            $pendingCount = $interviews->where('status','scheduled')->count();
        @endphp

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pipeline Control</h1>
                <p class="text-slate-500 text-sm mt-1">Review profiles, launch meetings, and submit evaluations.</p>
            </div>
            
            <div class="relative w-full md:w-96">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" id="tableSearch" placeholder="Search by name or email..." 
                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all text-sm font-medium shadow-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="card-pro p-6 bg-slate-900 text-white border-none">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Assigned</p>
                <h3 class="text-3xl font-extrabold">{{ $interviews->count() }}</h3>
            </div>
            <div class="card-pro p-6 border-l-4 border-l-amber-500">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pending Sessions</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $pendingCount }}</h3>
            </div>
            <div class="card-pro p-6 border-l-4 border-l-emerald-500">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Completed Evaluations</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $interviews->where('status','completed')->count() }}</h3>
            </div>
        </div>

        <div class="card-pro overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Session Schedule</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Live Update Active</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" id="interviewTable">
                    <thead>
                        <tr class="bg-white">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Candidate Info</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Round Details</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Meeting Access</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Action Hub</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($interviews as $interview)
                        <tr class="tr-hover transition-all duration-200">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-sm border border-slate-200">
                                        {{ strtoupper(substr($interview->candidate->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 leading-none name-val">{{ $interview->candidate->name }}</p>
                                        <p class="text-[11px] text-slate-400 mt-1 mb-2 email-val">{{ $interview->candidate->email }}</p>
                                        
                                      <a href="{{ route('interviewer.candidate.show', $interview->candidate->id) }}" class="btn-ghost-pro">
    <i class="bi bi-eye"></i> View Profile
</a>
   
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold uppercase rounded">{{ $interview->round }}</span>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter mt-2">
                                    <i class="bi bi-calendar-event mr-1"></i> {{ \Carbon\Carbon::parse($interview->date)->format('d M, Y') }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                @if($interview->status === 'scheduled')
                                <div class="flex flex-col items-center gap-2">
                                    <a href="{{ $interview->meeting_link }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 text-white text-[10px] font-bold uppercase rounded-lg hover:bg-emerald-700 transition-all">
                                        <i class="bi bi-camera-video-fill"></i> Launch Meeting
                                    </a>
                                    <div class="url-chip w-full" onclick="copyToClipboard('{{ $interview->interview_link }}')">
                                        <i class="bi bi-link-45deg"></i>
                                        <span class="truncate max-w-[80px]">{{ $interview->interview_link }}</span>
                                    </div>
                                </div>
                                @else
                                <div class="text-center">
                                    <span class="text-[10px] font-bold text-slate-300 uppercase italic">Link Expired</span>
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-center">
                                @if($interview->status === 'completed')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-[9px] font-black uppercase">Complete</span>
                                @else
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-full text-[9px] font-black uppercase">Upcoming</span>
                                @endif
                            </td>

                            <td class="px-8 py-5 text-right">
                                @if($interview->status === 'scheduled')
                                <a href="{{ url('/feedback/'.$interview->id) }}" class="btn-primary-pro inline-flex">
                                    Score Candidate
                                </a>
                                @else
                                <div class="flex items-center justify-end gap-2 text-emerald-600 font-bold text-[10px] uppercase">
                                    <i class="bi bi-check-circle-fill text-lg"></i> Evaluated
                                </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                
                <div id="noResults" class="hidden py-20 text-center">
                    <i class="bi bi-search text-4xl text-slate-200"></i>
                    <p class="text-slate-400 font-bold text-xs mt-4 uppercase">No matching candidates found</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Search Filter
        document.getElementById('tableSearch').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#interviewTable tbody tr');
            let hasVisibleRow = false;

            rows.forEach(row => {
                let name = row.querySelector('.name-val').textContent.toLowerCase();
                let email = row.querySelector('.email-val').textContent.toLowerCase();
                if (name.includes(filter) || email.includes(filter)) {
                    row.style.display = "";
                    hasVisibleRow = true;
                } else {
                    row.style.display = "none";
                }
            });
            document.getElementById('noResults').classList.toggle('hidden', hasVisibleRow);
        });

        // Copy Clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                let toast = document.getElementById("toast");
                toast.className = "show";
                setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
            });
        }
    </script>

</body>
</html>