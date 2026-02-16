<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: .05em;
        }

        .form-input {
            width: 100%;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            background: white;
        }

        .section-divider {
            position: relative;
            margin: 2.5rem 0 1.5rem;
        }

        .section-divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #f1f5f9;
        }

        .section-title {
            position: relative;
            display: inline-block;
            background: white;
            padding-right: 1rem;
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased">

<div class="min-h-screen py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-10">
            <div>
                <nav class="flex text-xs font-medium text-slate-400 mb-2 gap-2">
                    <a href="#" class="hover:text-slate-600">Candidates</a>
                    <span>/</span>
                    <span class="text-slate-900">Edit Profile</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Edit Candidate Profile
                </h1>
            </div>

            <a href="{{ route('candidates.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-semibold rounded-xl hover:bg-slate-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden">
            
            <div class="h-32 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
            
            <div class="px-10 pb-10 -mt-12">
                <div class="flex items-end gap-6 mb-8">
                    <div class="h-24 w-24 rounded-3xl bg-white p-1 shadow-xl">
                        <div class="h-full w-full rounded-[1.25rem] bg-slate-100 flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM96,120a32,32,0,1,1,32,32A32,32,0,0,1,96,120Zm97.76,66.41a80,80,0,0,0-139.52,0,88,88,0,1,1,139.52,0Z"></path></svg>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h2 class="text-xl font-bold text-slate-900">{{ $candidate->name }}</h2>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider rounded-full">
                            {{ $candidate->status }}
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('candidates.update',$candidate->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="section-divider"><span class="section-title">Personal Details</span></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ $candidate->name }}" class="form-input" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" value="{{ $candidate->email }}" class="form-input" placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile" value="{{ $candidate->mobile }}" class="form-input" placeholder="+1 (555) 000-0000">
                        </div>
                        <div>
                            <label class="form-label">Current Location</label>
                            <input type="text" name="location" value="{{ $candidate->location }}" class="form-input" placeholder="City, Country">
                        </div>
                    </div>

                    <div class="section-divider"><span class="section-title">Professional Experience</span></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="md:col-span-2">
                            <label class="form-label">Position Applied For</label>
                            <input type="text" name="position" value="{{ $candidate->position }}" class="form-input" placeholder="e.g. Senior Product Designer">
                        </div>
                        <div>
                            <label class="form-label">Current Company</label>
                            <input type="text" name="current_company" value="{{ $candidate->current_company }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Experience (Years)</label>
                            <input type="text" name="experience" value="{{ $candidate->experience }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Current CTC</label>
                            <div class="relative">
                                <input type="text" name="current_ctc" value="{{ $candidate->current_ctc }}" class="form-input">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Expected CTC</label>
                            <input type="text" name="expected_ctc" value="{{ $candidate->expected_ctc }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Notice Period</label>
                            <input type="text" name="notice_period" value="{{ $candidate->notice_period }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Application Status</label>
                            <select name="status" class="form-input appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236b7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:20px_20px] bg-right-4 bg-no-repeat">
                                <option value="pending" {{ $candidate->status=='pending'?'selected':'' }}>Pending Review</option>
                                <option value="selected" {{ $candidate->status=='selected'?'selected':'' }}>Shortlisted</option>
                                <option value="hired" {{ $candidate->status=='hired'?'selected':'' }}>Hired</option>
                                <option value="rejected" {{ $candidate->status=='rejected'?'selected':'' }}>Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-divider"><span class="section-title">Documents</span></div>
                    <div class="bg-slate-50 rounded-2xl p-6 border border-dashed border-slate-200">
                        <label class="form-label">Upload New Resume</label>
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                            <input type="file" name="resume" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            
                            @if($candidate->resume)
                                <a href="{{ asset('storage/'.$candidate->resume) }}" target="_blank" class="shrink-0 flex items-center gap-2 px-4 py-2 bg-white text-slate-700 text-xs font-bold rounded-lg border border-slate-200 hover:shadow-sm transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256"><path d="M247.31,124.76c-.35-.79-8.82-19.74-27.65-38.57C194.57,61.11,162.88,48,128,48S61.43,61.11,36.34,86.19c-18.83,18.83-27.3,37.78-27.65,38.57a8,8,0,0,0,0,6.48c.35.79,8.82,19.74,27.65,38.57C61.43,194.89,93.12,208,128,208s66.57-13.11,91.66-38.19c18.83-18.83,27.3-37.78,27.65-38.57a8,8,0,0,0,0-6.48ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128a133.33,133.33,0,0,1,23.07-30.75C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.47,133.47,0,0,1,231,128a133.33,133.33,0,0,1-23.07,30.75C185.67,180.81,158.78,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,3)"></path></svg>
                                    View Current Resume
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-100 flex items-center justify-between">
                        <button type="button" class="text-red-500 text-xs font-bold uppercase tracking-widest hover:text-red-600 transition">
                            Delete Candidate
                        </button>
                        
                        <div class="flex gap-3">
                            <a href="{{ route('candidates.index') }}" class="px-6 py-3 text-slate-500 text-xs font-bold uppercase tracking-widest hover:text-slate-700 transition">
                                Cancel
                            </a>
                            <button type="submit" class="px-10 py-3 bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all hover:-translate-y-0.5">
                                Save Changes
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>