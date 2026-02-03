<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IMS Pro | Smart Interview Management</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .hero-gradient {
                background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent),
                            radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.15), transparent);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 hero-gradient">

        <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-md border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i class="bi bi-person-workspace text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight">IMS<span class="text-indigo-600">Pro</span></span>
                </div>

                <div class="flex items-center gap-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-indigo-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-600 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Join Now</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        
        <div class="relative pt-32 pb-20 px-6">
            <div class="max-w-7xl mx-auto text-center">
                <span class="bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">AI-Powered Recruitment</span>
                <h1 class="mt-8 text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900">
                    Smart Hiring for <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Great Teams.</span>
                </h1>
                <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Streamline your interview process, manage candidates, and provide real-time feedback with our integrated management module.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="glass-card p-8 rounded-3xl hover:translate-y-[-8px] transition duration-300 shadow-xl shadow-slate-200/50">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-shield-check text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Admin Control</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Complete oversight of the recruitment pipeline. Schedule rounds, manage candidate pools, and generate reports.</p>
                    <ul class="text-xs space-y-2 text-slate-600 font-medium">
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Schedule Interviews</li>
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Role-Based Access</li>
                    </ul>
                </div>

                <div class="glass-card p-8 rounded-3xl hover:translate-y-[-8px] transition duration-300 shadow-xl shadow-slate-200/50">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-chat-left-dots text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Interviewer Suite</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Real-time feedback submission and scorecards. Access candidate history and technical round details instantly.</p>
                    <ul class="text-xs space-y-2 text-slate-600 font-medium">
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Live Scorecards</li>
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Feedback Remarks</li>
                    </ul>
                </div>

                <div class="glass-card p-8 rounded-3xl hover:translate-y-[-8px] transition duration-300 shadow-xl shadow-slate-200/50 border-indigo-200">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="bi bi-person-badge text-emerald-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Candidate Portal</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Track your application journey. View scheduled dates, interview status, and final results in a clear dashboard.</p>
                    <ul class="text-xs space-y-2 text-slate-600 font-medium">
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Application Tracking</li>
                        <li><i class="bi bi-check2-circle text-green-500 mr-2"></i> Instant Notifications</li>
                    </ul>
                </div>

            </div>
        </div>

        <footer class="border-t border-slate-200 bg-white py-12">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-slate-400 text-sm italic">
                    Powering the future of recruitment.
                </div>
                <div class="text-slate-500 text-sm">
                    &copy; 2026 IMS Pro. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </div>
            </div>
        </footer>
    </body>
</html>