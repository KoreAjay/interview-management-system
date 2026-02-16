<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="w-64 bg-black text-white min-h-screen p-5">

        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <nav class="space-y-3">

            <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>

            <a href="{{ route('candidates.index') }}" class="block">Candidates</a>

            <a href="{{ route('interviews.index') }}" class="block">Interviews</a>

            <a href="{{ route('admin.results') }}" class="block">Results</a>

        </nav>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-6">

        @yield('content')

    </div>

</div>

</body>
</html>
