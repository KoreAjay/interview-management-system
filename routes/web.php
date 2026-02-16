<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ----------------------------------------------------------
| PUBLIC ROUTE
----------------------------------------------------------*/
Route::get('/', function () {
    return view('welcome');
});


/* ----------------------------------------------------------
| AUTH ROUTES
| Disable Public Registration
----------------------------------------------------------*/
Auth::routes([
    'register' => false
]);


/* ----------------------------------------------------------
| SHARED ROUTES
| Admin + Interviewer → View Candidate Profile
----------------------------------------------------------*/
Route::resource('candidates', CandidateController::class);

Route::middleware(['auth'])->group(function(){

    Route::get(
        '/candidates/{candidate}',
        [CandidateController::class, 'show']
    )->name('candidates.show');

});
/* ----------------------------------------------------------
| INTERVIEWER ROUTES
----------------------------------------------------------*/
Route::middleware(['auth','role:interviewer'])->group(function () {

    Route::get(
        '/interviewer/dashboard',
        function () {
            return view('interviewer.dashboard');
        }
    )->name('interviewer.dashboard');


    /* Candidate Profile View */
    Route::get(
        '/interviewer/candidate/{candidate}',
        [App\Http\Controllers\CandidateController::class, 'show']
    )->name('interviewer.candidate.show');


    /* Feedback */
    Route::get(
        '/feedback/{interview}',
        [FeedbackController::class, 'create']
    )->name('feedback.create');

    Route::post(
        '/feedback/{interview}',
        [FeedbackController::class, 'store']
    )->name('feedback.store');

});



/* ----------------------------------------------------------
| ADMIN ONLY ROUTES
----------------------------------------------------------*/
Route::middleware(['auth','role:admin'])->group(function(){

    /* Dashboard */
    Route::get(
        '/admin/dashboard',
        [AdminController::class,'dashboard']
    )->name('admin.dashboard');


    /* Register Staff (Admin Only) */
    Route::get(
        '/register',
        function () {
            return view('auth.register');
        }
    )->name('register');

    Route::post(
        '/register',
        [RegisterController::class,'register']
    )->name('register.store');


    /* Candidate Status Update */
    Route::patch(
        '/candidates/{candidate}/status',
        [CandidateController::class,'updateStatus']
    )->name('candidates.updateStatus');


    /* Candidates CRUD (except show) */
    Route::resource(
        'candidates',
        CandidateController::class
    )->except(['show']);


    /* Interviews */
    Route::get(
        '/interviews',
        [InterviewController::class,'index']
    )->name('interviews.index');

    Route::get(
        '/interviews/create/{candidate}',
        [InterviewController::class,'create']
    )->name('interviews.create');

    Route::post(
        '/interviews/store',
        [InterviewController::class,'store']
    )->name('interviews.store');


    /* Reports / Results */
    Route::get(
        '/admin/results',
        [AdminController::class,'results']
    )->name('admin.results');

});


/* ----------------------------------------------------------
| INTERVIEWER ROUTES
----------------------------------------------------------*/
Route::middleware(['auth','role:interviewer'])->group(function () {

    Route::get(
        '/interviewer/dashboard',
        function () {
            return view('interviewer.dashboard');
        }
    )->name('interviewer.dashboard');


    /* Feedback */
    Route::get(
        '/feedback/{interview}',
        [FeedbackController::class, 'create']
    )->name('feedback.create');

    Route::post(
        '/feedback/{interview}',
        [FeedbackController::class, 'store']
    )->name('feedback.store');

});


/* ----------------------------------------------------------
| CANDIDATE ROUTES
----------------------------------------------------------*/
Route::middleware(['auth','role:candidate'])->group(function () {

    Route::get(
        '/candidate/dashboard',
        function () {
            return view('candidate.dashboard');
        }
    )->name('candidate.dashboard');

});
