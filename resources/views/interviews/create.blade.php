<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Schedule Interview</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(16,185,129,.06) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(15,23,42,.05) 0, transparent 50%);
        }

        .glass-card {
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226,232,240,.8);
        }
    </style>
</head>

<body class="antialiased text-slate-800">

<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-slate-900 p-2 rounded-xl">
                <i class="bi bi-cpu text-white"></i>
            </div>
            <span class="text-xl font-extrabold">Soft<span class="text-emerald-500">matric</span></span>
        </div>

        <a href="{{ route('interviews.index') }}"
           class="text-sm font-bold text-slate-600 hover:text-emerald-600 flex items-center gap-1">
            <i class="bi bi-arrow-left"></i> Interviews
        </a>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-12">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900">Schedule Interview</h1>
        <p class="text-slate-500 mt-1">Assign interviewer and plan interview session</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- FORM -->
        <div class="lg:col-span-2">
            <div class="glass-card rounded-2xl shadow-xl overflow-hidden">

                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between">
                    <h2 class="font-bold text-slate-900">Interview Details</h2>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                        Step 1 of 1
                    </span>
                </div>

                <form class="p-8 space-y-6">

                    <!-- Candidate & Interviewer -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm font-bold text-slate-700">Candidate *</label>
                            <select class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                <option value="">Select Candidate</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Interviewer *</label>
                            <select class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                <option value="">Select Interviewer</option>
                            </select>
                        </div>
                    </div>

                    <!-- Date / Time / Round -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-slate-100">

                        <div>
                            <label class="text-sm font-bold text-slate-700">Date</label>
                            <input type="date"
                                   class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Time</label>
                            <input type="time"
                                   class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Round</label>
                            <select class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                                <option value="technical">Technical</option>
                                <option value="hr">HR</option>
                                <option value="managerial">Managerial</option>
                            </select>
                        </div>
                    </div>

                    <!-- Meeting Link -->
                    <div>
                        <label class="text-sm font-bold text-slate-700">Meeting Link (Optional)</label>
                        <input type="url"
                               placeholder="https://meet.google.com/..."
                               class="mt-1 w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    </div>

                    <!-- Actions -->
                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-4">
                        <a href="{{ route('interviews.index') }}"
                           class="px-6 py-2.5 text-sm font-bold text-slate-600 hover:text-slate-900">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-emerald-600 transition shadow-xl">
                            Schedule Interview
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="space-y-6">

            <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl p-6 shadow-xl">
                <h3 class="font-bold text-lg mb-2">Scheduling Tip</h3>
                <p class="text-sm text-slate-300">
                    Ensure interviewer availability before finalizing. Notifications will be sent automatically.
                </p>
            </div>

            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <h4 class="font-bold text-slate-900 mb-4">Quick Status</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        Candidate profile verified
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                        Interviewer availability required
                    </li>
                </ul>
            </div>

        </div>
    </div>
</main>

</body>
</html>
