<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $candidate->name }} | Profile</title>

    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fcfcfd] text-slate-900">

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('candidates.index') }}"
           class="flex items-center text-slate-500 hover:text-slate-800 font-semibold text-sm">
            <i class="bi bi-arrow-left mr-2"></i> Back to Database
        </a>

        <a href="{{ route('candidates.edit',$candidate->id) }}"
           class="px-5 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50">
            Edit Profile
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT CARD -->
        <div class="space-y-6">

            <div class="bg-white rounded-[2.5rem] border p-8 text-center shadow-sm">

                <div class="w-24 h-24 rounded-3xl bg-emerald-50 text-emerald-600
                            flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    {{ strtoupper(substr($candidate->name,0,1)) }}
                </div>

                <h2 class="text-xl font-extrabold">{{ $candidate->name }}</h2>
                <p class="text-sm text-slate-400">{{ $candidate->position }}</p>

                <span class="inline-block mt-4 px-4 py-1 text-[10px] font-black uppercase
                    rounded-full
                    {{ $candidate->status=='hired'
                        ? 'bg-emerald-100 text-emerald-700'
                        : 'bg-amber-100 text-amber-700' }}">
                    {{ $candidate->status }}
                </span>

            </div>

            <!-- CONTACT -->
            <div class="bg-white rounded-[2.5rem] border p-8 shadow-sm">

                <h3 class="text-xs font-bold text-slate-400 uppercase mb-6">
                    Contact Details
                </h3>

                <div class="space-y-4 text-sm">

                    <p><i class="bi bi-envelope mr-2"></i>
                        {{ $candidate->email }}</p>

                    <p><i class="bi bi-briefcase mr-2"></i>
                        {{ $candidate->experience }} Years Experience</p>

                    <p><i class="bi bi-calendar-event mr-2"></i>
                        Applied:
                        {{ $candidate->created_at->format('M d, Y') }}
                    </p>

                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="lg:col-span-2 space-y-6">

            <!-- STATUS -->
            <div class="bg-white rounded-[2.5rem] border p-8 shadow-sm">

                <h3 class="text-xs font-bold text-slate-400 uppercase mb-6">
                    Update Application Status
                </h3>

                <div class="flex flex-wrap gap-3">

                    @foreach(['pending','selected','rejected','hired'] as $status)

                    <form method="POST"
                          action="{{ route('candidates.updateStatus',$candidate->id) }}">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" value="{{ $status }}">

                        <button class="px-6 py-2 rounded-xl text-xs font-bold border
                            {{ $candidate->status==$status
                                ? 'bg-slate-900 text-white'
                                : 'bg-white text-slate-600 hover:border-emerald-400' }}">
                            {{ ucfirst($status) }}
                        </button>
                    </form>

                    @endforeach

                </div>
            </div>

            <!-- RESUME -->
            <div class="bg-white rounded-[2.5rem] border p-8 shadow-sm">

                <div class="flex justify-between mb-6">
                    <h3 class="text-xs font-bold text-slate-400 uppercase">
                        Resume Document
                    </h3>

                    @if($candidate->resume)
                        <a href="{{ asset('storage/'.$candidate->resume) }}"
                           target="_blank"
                           class="text-emerald-600 text-xs font-bold">
                            <i class="bi bi-download"></i> Download
                        </a>
                    @endif
                </div>

                @if($candidate->resume)

                    @php
                        $ext = pathinfo($candidate->resume, PATHINFO_EXTENSION);
                    @endphp

                    @if($ext == 'pdf')
                        <!-- PDF Preview -->
                        <iframe
                            src="{{ asset('storage/'.$candidate->resume) }}"
                            class="w-full h-[500px] rounded-xl">
                        </iframe>

                    @else
                        <!-- DOC/DOCX Preview -->
                        <div class="text-center py-16">
                            <i class="bi bi-file-earmark-text text-4xl text-slate-300"></i>
                            <p class="text-slate-400 mt-2">
                                Preview not available.
                                Download to view.
                            </p>
                        </div>
                    @endif

                @else

                    <!-- No Resume -->
                    <div class="text-center py-16 bg-slate-50 rounded-2xl">
                        <i class="bi bi-file-earmark-x text-4xl text-slate-300"></i>
                        <p class="text-slate-400 mt-2">
                            No resume uploaded.
                        </p>
                    </div>

                @endif

            </div>

        </div>
    </div>
</div>

</body>
</html>
    