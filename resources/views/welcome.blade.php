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
        }

        .process-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: repeating-linear-gradient(to right, transparent, transparent 5px, #e2e8f0 5px, #e2e8f0 10px);
            z-index: 0;
        }

        .text-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating-img {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
    </style>
</head>
<body class="antialiased hero-gradient">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 bg-white/70 backdrop-blur-lg border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="bg-slate-900 p-2 rounded-xl group-hover:bg-emerald-500 transition-all duration-300">
                    <i class="bi bi-cpu text-white text-xl"></i>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">Soft<span class="text-emerald-500">matric</span></span>
            </div>

            <div class="hidden lg:flex items-center gap-10">
                <a href="#process" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">Hiring Process</a>
                <a href="#pipeline" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">Pipeline</a>
                <a href="#apply" class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition">Open Roles</a>
            </div>

            <div class="flex items-center gap-3">
                <!-- Linked to Laravel Auth Routes -->
                <a href="/login" class="text-sm font-bold text-slate-700 hover:text-emerald-600 px-4 py-2 transition-all">
                    Login
                </a>
                <a href="/register" class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-40 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-100 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-[0.2em]">
                    Internal Career Portal • Softmatric
                </div>
                <h1 class="text-6xl md:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.1]">
                    Build the Future <br> of <span class="text-gradient">Technology.</span>
                </h1>
                <p class="text-xl text-slate-500 max-w-xl leading-relaxed">
                    Join our team of innovators. We've streamlined our hiring process to be transparent, efficient, and focused on your unique skills.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#apply" class="bg-emerald-500 hover:bg-emerald-600 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-emerald-100 transition-all">
                        Explore Careers
                    </a>
                </div>
            </div>

            <div class="relative">
                <!-- Group Collage Visual inspired by new-hiring_software.webp -->
                <div class="relative z-10 w-full h-[500px]">
                    <div class="absolute top-0 right-0 w-2/3 h-64 rounded-3xl overflow-hidden shadow-2xl floating-img" style="animation-delay: 1s;">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute bottom-0 left-0 w-3/4 h-80 rounded-3xl overflow-hidden shadow-2xl floating-img border-8 border-white">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute top-1/4 -right-4 w-24 h-24 bg-orange-400 rounded-full -z-10 opacity-50"></div>
                    <div class="absolute -bottom-4 left-1/2 w-16 h-16 bg-emerald-500 rounded-full -z-10"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Hiring Process Section (Based on image_1766e6.png) -->
    <section id="process" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-sm font-bold text-emerald-500 uppercase tracking-widest mb-4">Hiring Process</h2>
                <h3 class="text-4xl font-extrabold text-slate-900">How we grow the team</h3>
                <div class="w-20 h-1 bg-emerald-500 mx-auto mt-6"></div>
            </div>

            <div class="relative grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="process-line hidden md:block"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 text-center space-y-4">
                    <div class="w-16 h-16 bg-white border-2 border-emerald-500 rounded-full flex items-center justify-center mx-auto shadow-lg transition-transform hover:scale-110">
                        <i class="bi bi-chat-left-text text-emerald-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900">Interview</h4>
                    <p class="text-sm text-slate-500 px-4">Initial screening to understand your goals and alignment with Softmatric.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 text-center space-y-4">
                    <div class="w-16 h-16 bg-white border-2 border-red-400 rounded-full flex items-center justify-center mx-auto shadow-lg transition-transform hover:scale-110">
                        <i class="bi bi-journal-check text-red-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900">Test</h4>
                    <p class="text-sm text-slate-500 px-4">Practical assessment or technical sandbox to showcase your expertise.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 text-center space-y-4">
                    <div class="w-16 h-16 bg-white border-2 border-blue-400 rounded-full flex items-center justify-center mx-auto shadow-lg transition-transform hover:scale-110">
                        <i class="bi bi-hand-thumbs-up text-blue-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900">Feedback</h4>
                    <p class="text-sm text-slate-500 px-4">Transparent review of your assessment with actionable insights.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 text-center space-y-4">
                    <div class="w-16 h-16 bg-white border-2 border-orange-400 rounded-full flex items-center justify-center mx-auto shadow-lg transition-transform hover:scale-110">
                        <i class="bi bi-trophy text-orange-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900">Decision</h4>
                    <p class="text-sm text-slate-500 px-4">Final offer and welcoming you into the Softmatric family.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Application Form (Based on image_1766e6.png) -->
    <section id="apply" class="py-24 bg-slate-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="glass-card rounded-[40px] p-8 md:p-16 shadow-2xl border border-white">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Apply For Job</h2>
                    <p class="text-slate-500">We'll be back to you as soon as possible with a progression.</p>
                </div>

                <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Your Name*</label>
                        <input type="text" placeholder="Full Name" class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Your Email*</label>
                        <input type="email" placeholder="email@softmatric.com" class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Interested Role</label>
                        <select class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all appearance-none bg-white">
                            <option>Android Developer</option>
                            <option>Frontend Engineer (React)</option>
                            <option>Backend Architect (Node.js)</option>
                            <option>UI/UX Designer</option>
                        </select>
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Upload CV*</label>
                        <div class="w-full border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center hover:border-emerald-500 transition-colors cursor-pointer group">
                            <i class="bi bi-cloud-arrow-up text-3xl text-slate-300 group-hover:text-emerald-500 transition-colors"></i>
                            <p class="text-sm text-slate-500 mt-2">Click to upload or drag and drop (PDF, DOCX)</p>
                            <input type="file" class="hidden">
                        </div>
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Message</label>
                        <textarea rows="4" placeholder="Tell us about yourself..." class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all"></textarea>
                    </div>
                    <div class="md:col-span-2 text-center pt-4">
                        <button type="submit" class="bg-slate-900 hover:bg-emerald-600 text-white px-12 py-4 rounded-2xl font-bold text-lg transition-all shadow-xl hover:shadow-emerald-200">
                            Submit Application <i class="bi bi-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-emerald-900 text-white pt-20 pb-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-emerald-800 pb-16 mb-12">
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl">
                        <i class="bi bi-cpu text-emerald-900 text-lg"></i>
                    </div>
                    <span class="text-2xl font-extrabold">Softmatric</span>
                </div>
                <p class="text-emerald-100/70 text-sm">Building digital solutions with focus on results and technical excellence.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-emerald-800 flex items-center justify-center hover:bg-emerald-500 transition-colors"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-emerald-800 flex items-center justify-center hover:bg-emerald-500 transition-colors"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-emerald-800 flex items-center justify-center hover:bg-emerald-500 transition-colors"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
            
            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest">Services</h4>
                <ul class="space-y-4 text-sm text-emerald-100/70">
                    <li>Mobility Solutions</li>
                    <li>Web Development</li>
                    <li>UI/UX Design</li>
                    <li>Cloud Services</li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest">Company</h4>
                <ul class="space-y-4 text-sm text-emerald-100/70">
                    <li>About Us</li>
                    <li>Our Portfolio</li>
                    <li>Career</li>
                    <li>Blog</li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-6 text-sm uppercase tracking-widest">Contact</h4>
                <p class="text-sm text-emerald-100/70 mb-4"><i class="bi bi-geo-alt mr-2"></i> Pune, India</p>
                <p class="text-sm text-emerald-100/70 mb-4"><i class="bi bi-envelope mr-2"></i> contact@softmatric.com</p>
                <p class="text-sm text-emerald-100/70"><i class="bi bi-telephone mr-2"></i> +91 9876543210</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto text-center text-[10px] text-emerald-100/50 font-bold uppercase tracking-widest">
            <p>&copy; 2026 Softmatric Technologies. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>