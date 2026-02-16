<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softmatric | Staff Registration</title>
    
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient {
            background:
                radial-gradient(at 0% 0%, rgba(16,185,129,.05), transparent 50%),
                radial-gradient(at 100% 0%, rgba(51,65,85,.03), transparent 50%);
        }
        .glass-card {
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(18px);
            border: 1px solid #e2e8f0;
        }
        .input-focus:focus {
            border-color:#10b981;
            box-shadow:0 0 0 4px rgba(16,185,129,.1);
            outline:none;
        }
    </style>
</head>

<body class="hero-gradient min-h-screen flex items-center justify-center px-6">

<div class="w-full max-w-xl">

    <div class="glass-card rounded-3xl p-10 shadow-xl">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold">
                Staff Registration
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                Admin can create staff accounts
            </p>
        </div>

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-600 p-4 rounded-xl text-sm">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register.store') }}" class="space-y-6">
            @csrf

            <!-- NAME -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase">
                    Full Name
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="w-full mt-2 px-4 py-3 border rounded-xl input-focus">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full mt-2 px-4 py-3 border rounded-xl input-focus">
            </div>

            <!-- ROLE (OPTIONAL BUT RECOMMENDED) -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase">
                    Role
                </label>

                <select name="role"
                        class="w-full mt-2 px-4 py-3 border rounded-xl input-focus">

                    <option value="interviewer">Interviewer</option>
                    <option value="candidate">Candidate</option>

                </select>
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase">
                    Password
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full mt-2 px-4 py-3 border rounded-xl input-focus">
            </div>

            <!-- CONFIRM -->
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase">
                    Confirm Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       required
                       class="w-full mt-2 px-4 py-3 border rounded-xl input-focus">
            </div>

            <!-- SUBMIT -->
            <button type="submit"
                class="w-full bg-slate-900 hover:bg-emerald-600 text-white py-3 rounded-xl font-bold transition">
                Create Account
            </button>

        </form>

    </div>

</div>

</body>
</html>
