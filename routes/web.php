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
/*
|--------------------------------------------------------------------------
| Interview Routes (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Interview list
    Route::get('/interviews', [InterviewController::class, 'index'])
        ->name('interviews.index');

    // Schedule form (WITH candidate id)
    Route::get(
        '/interviews/create/{candidate}',
        [InterviewController::class, 'create']
    )->name('interviews.create');


    // Store
    Route::post('/interviews/store', [InterviewController::class, 'store'])
        ->name('interviews.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /* Candidate CRUD */
    Route::resource('candidates', CandidateController::class);

    /* Interview Pages */
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

    /* Feedback */
    Route::get('/feedback/{interview}', [FeedbackController::class, 'create'])
        ->name('feedback.create');

    Route::post('/feedback/{interview}', [FeedbackController::class, 'store'])
        ->name('feedback.store');
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

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

