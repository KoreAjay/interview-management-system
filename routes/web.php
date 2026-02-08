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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');

    /* Candidates */
    Route::resource('candidates', CandidateController::class);

    /* Interview Scheduling */
    Route::get(
        '/interviews',
        [InterviewController::class, 'index']
    )->name('interviews.index');

    Route::get(
        '/interviews/create/{candidate}',
        [InterviewController::class, 'create']
    )->name('interviews.create');

    Route::post(
        '/interviews/store',
        [InterviewController::class, 'store']
    )->name('interviews.store');

    /* FINAL RESULTS PAGE */
    Route::get(
        '/admin/results',
        [AdminController::class, 'results']
    )->name('admin.results');

});


/*
|--------------------------------------------------------------------------
| INTERVIEWER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:interviewer'])->group(function () {

    Route::get('/interviewer/dashboard', function () {
        return view('interviewer.dashboard');
    })->name('interviewer.dashboard');

    Route::get(
        '/feedback/{interview}',
        [FeedbackController::class, 'create']
    )
        ->name('feedback.create');

    Route::post(
        '/feedback/{interview}',
        [FeedbackController::class, 'store']
    )
        ->name('feedback.store');
});


/*
|--------------------------------------------------------------------------
| CANDIDATE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:candidate'])->group(function () {

    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

});

Auth::routes();
