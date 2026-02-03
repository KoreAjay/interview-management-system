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
