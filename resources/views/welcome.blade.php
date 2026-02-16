<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Internal Interview Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; scroll-behavior: smooth; }

        .hero-gradient {
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(51, 65, 85, 0.03) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .process-line {
            position: absolute;
            top: 30%;
            left: 10%;
            right: 10%;
            height: 2px;
            background: repeating-linear-gradient(to right, #10b981 0%, #10b981 5px, transparent 5px, transparent 15px);
            opacity: 0.2;
            z-index: 0;
        }

        .text-gradient {
            background: linear-gradient(135deg, #0f172a 30%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating-img {
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }
        .btn-shine:hover::after {
            left: 100%;
        }
    </style>
</head>
<body class="antialiased hero-gradient text-slate-900">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 bg-white/80 backdrop-blur-xl border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group">
                <div class="bg-emerald-500 p-2.5 rounded-2xl shadow-lg shadow-emerald-200 group-hover:rotate-12 transition-transform duration-500">
                    <i class="bi bi-cpu-fill text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="hidden lg:flex items-center gap-10">
                <a href="#process" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors uppercase tracking-widest">Process</a>
                <a href="mailto:hr@softmatric.com" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors uppercase tracking-widest">Contact</a>
            </div>

            <div class="flex items-center">
                <a href="/login" class="bg-slate-900 hover:bg-emerald-600 text-white px-8 py-3 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-slate-200 flex items-center gap-2 btn-shine">
                    Staff Login <i class="bi bi-arrow-right-short text-lg"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-48 pb-32 px-6 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-40 -left-20 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-100/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-10 relative z-10">
                <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-[0.25em] border border-emerald-100 shadow-sm">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Internal Career Portal
                </div>
                
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-slate-900 leading-[0.95]">
                    Engineering <br> the <span class="text-gradient">Next Gen.</span>
                </h1>
                
                <p class="text-xl text-slate-500 max-w-lg leading-relaxed font-medium">
                    Welcome to the Softmatric ecosystem. This internal portal is designed to manage our high-performing team and streamline engineering recruitment.
                </p>

                <div class="flex flex-wrap gap-5">
                    <a href="#process" class="bg-emerald-500 hover:bg-emerald-600 text-white px-10 py-5 rounded-[2rem] font-bold text-lg shadow-2xl shadow-emerald-200 transition-all hover:-translate-y-1 flex items-center gap-3">
                        View Pipeline <i class="bi bi-chevron-down text-sm"></i>
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="relative z-10 w-full flex justify-center lg:justify-end">
                    <!-- Main Image Card -->
                    <div class="relative w-full max-w-lg aspect-square">
                        <div class="absolute inset-0 bg-emerald-500/10 rounded-[4rem] rotate-6"></div>
                        <div class="absolute inset-0 bg-slate-900/5 rounded-[4rem] -rotate-3"></div>
                        <div class="relative h-full w-full rounded-[4rem] overflow-hidden shadow-2xl floating-img border-[12px] border-white">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover" alt="Team at Softmatric">
                        </div>
                        
                        <!-- Floating Stats -->
                        <div class="absolute -bottom-10 -left-10 glass-card p-6 rounded-3xl shadow-2xl hidden md:block">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center">
                                    <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black text-slate-900">98%</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Efficiency Rate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Hiring Process Section -->
    <section id="process" class="py-32 bg-slate-50/50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <p class="text-[11px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-4">Our Workflow</p>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">The Hiring Pipeline</h3>
            </div>

            <div class="relative grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="process-line hidden md:block"></div>
                
                <!-- Steps -->
                <div class="relative z-10 group">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl group-hover:bg-emerald-500 transition-all duration-500 group-hover:-translate-y-2">
                        <i class="bi bi-telephone-inbound text-3xl text-emerald-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black text-slate-900">01. Screening</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">A quick conversation to align expectations and culture fit.</p>
                    </div>
                </div>

                <div class="relative z-10 group">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl group-hover:bg-rose-500 transition-all duration-500 group-hover:-translate-y-2">
                        <i class="bi bi-code-square text-3xl text-rose-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black text-slate-900">02. Assessment</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Real-world technical challenges to show us what you can build.</p>
                    </div>
                </div>

                <div class="relative z-10 group">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl group-hover:bg-blue-500 transition-all duration-500 group-hover:-translate-y-2">
                        <i class="bi bi-people-fill text-3xl text-blue-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black text-slate-900">03. Panel Meet</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Collaborative discussion with our core engineering leadership.</p>
                    </div>
                </div>

                <div class="relative z-10 group">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl group-hover:bg-orange-500 transition-all duration-500 group-hover:-translate-y-2">
                        <i class="bi bi-stars text-3xl text-orange-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xl font-black text-slate-900">04. Onboarding</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Finalizing the offer and welcoming you to the ecosystem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white pt-24 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 border-b border-slate-800 pb-20 mb-12">
                <div class="space-y-8 col-span-1 md:col-span-1">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-500 p-2 rounded-xl">
                            <i class="bi bi-cpu-fill text-white"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tighter">Softmatric</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed font-medium">
                        The internal engine powering talent acquisition and engineering excellence at Softmatric.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-emerald-500 transition-all"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-emerald-500 transition-all"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                
                <div class="hidden md:block">
                    <h4 class="font-black text-xs uppercase tracking-[0.2em] text-emerald-500 mb-8">Navigation</h4>
                    <ul class="space-y-4 text-sm text-slate-400 font-bold">
                        <li><a href="#process" class="hover:text-white transition-colors">Our Process</a></li>
                        <li><a href="/login" class="hover:text-white transition-colors">Admin Portal</a></li>
                    </ul>
                </div>

                <div class="hidden md:block">
                    <h4 class="font-black text-xs uppercase tracking-[0.2em] text-emerald-500 mb-8">Company</h4>
                    <ul class="space-y-4 text-sm text-slate-400 font-bold">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Security</a></li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="font-black text-xs uppercase tracking-[0.2em] text-emerald-500 mb-8">Headquarters</h4>
                    <div class="space-y-4 text-sm text-slate-400 font-medium">
                        <p class="flex items-start gap-3"><i class="bi bi-geo-alt-fill text-emerald-500"></i> Pune, MH, India <br> Tech Hub Central</p>
                        <p class="flex items-center gap-3"><i class="bi bi-envelope-at-fill text-emerald-500"></i> hr@softmatric.com</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] text-slate-500 font-black uppercase tracking-[0.3em]">
                <p>&copy; 2026 Softmatric Technologies</p>
                <p>System v2.4.1 - Production Stable</p>
            </div>
        </div>
    </footer>

</body>
</html>