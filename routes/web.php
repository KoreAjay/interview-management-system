<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::resource('candidates', CandidateController::class);
    Route::resource('interviews', InterviewController::class);

<<<<<<< HEAD
    Route::post(
        '/candidates/{candidate}/status',
        [CandidateController::class, 'updateStatus']
    )->name('candidates.status');

    Route::get('/admin/results', [AdminController::class, 'results'])
        ->name('admin.results');

=======
    Route::post('/candidates/{candidate}/status',
        [CandidateController::class, 'updateStatus']
    )->name('candidates.status');

    Route::get('/admin/results', function () {
        $candidates = \App\Models\Candidate::whereIn('status', ['selected','rejected'])->get();
        return view('admin.results', compact('candidates'));
    })->name('admin.results');
>>>>>>> 27f0eb8d9d09404577336b9cfa458d95344a0515
});


/*
|--------------------------------------------------------------------------
| Interviewer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:interviewer'])->group(function () {

    Route::get('/interviewer/dashboard', function () {
        return view('interviewer.dashboard');
    })->name('interviewer.dashboard');
<<<<<<< HEAD

    Route::get('/feedback/{interview}', [FeedbackController::class, 'create'])
        ->name('feedback.create');

    Route::post('/feedback/{interview}', [FeedbackController::class, 'store'])
        ->name('feedback.store');
});
Route::middleware(['auth', 'role:interviewer'])->group(function () {

    Route::get('/interviewer/dashboard', function () {
        return view('interviewer.dashboard');
    })->name('interviewer.dashboard');

    Route::get('/feedback/{interview}', [FeedbackController::class, 'create'])
        ->name('feedback.create');

    Route::post('/feedback/{interview}', [FeedbackController::class, 'store'])
        ->name('feedback.store');
=======
>>>>>>> 27f0eb8d9d09404577336b9cfa458d95344a0515
});

/*
|--------------------------------------------------------------------------
| Candidate Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:candidate'])->group(function () {

    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    Route::get('/candidate/profile', [CandidateController::class, 'profile'])
        ->name('candidate.profile');

    Route::post('/candidate/profile/update', [CandidateController::class, 'updateProfile'])
        ->name('candidate.profile.update');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();
