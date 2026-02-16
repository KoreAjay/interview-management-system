<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Softmatric | Interview Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-gradient {
            background:
                radial-gradient(at 0% 0%, rgba(16, 185, 129, .08), transparent 50%),
                radial-gradient(at 100% 0%, rgba(51, 65, 85, .05), transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, .08), transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(12px);
            border: 1px solid #e2e8f0;
        }

        .hidden-auth {
            display: none;
        }
    </style>
</head>

<body class="hero-gradient min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-5xl grid lg:grid-cols-2 gap-14 items-center">

        <!-- LEFT CONTENT -->
        <div class="hidden lg:block space-y-6">
            <h1 class="text-6xl font-extrabold text-slate-900">
                Build the Future of <span class="text-emerald-500">Technology</span>
            </h1>
            <p class="text-xl text-slate-500">
                Internal Interview Management Portal for Softmatric.
            </p>
        </div>

        {{-- LOGIN --}}
        <div id="login-card" class="glass-card rounded-3xl overflow-hidden shadow-xl">
            <div class="px-10 py-8 border-b">
                <h3 class="text-2xl font-extrabold">Welcome Back</h3>
                <p class="text-slate-500 text-sm">Login to your dashboard</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="p-10 space-y-6">
                @csrf

                <input type="email" name="email" required placeholder="Email"
                    class="w-full px-5 py-4 rounded-xl border">

                <input type="password" name="password" required placeholder="Password"
                    class="w-full px-5 py-4 rounded-xl border">

                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2"> Remember me
                </label>

                <button class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold">
                    Sign In
                </button>

            </form>
        </div>


    </div>
    </div>

    <script>
        function toggleAuth(type) {
            document.getElementById('login-card').classList.toggle('hidden-auth', type === 'register');
            document.getElementById('register-card').classList.toggle('hidden-auth', type === 'login');
        }
    </script>

</body>

</html>