<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobListings;
use App\Http\Controllers\ApplicationController;

Route::get('/', [AuthController::class , "showFormRegister"]);
Route::post('/', [AuthController::class , "register"])->name('register');

Route::get('/login', [AuthController::class , "showFormLogin"]);
Route::post('/login', [AuthController::class , "login"])->name('login');

Route::post('/home', [AuthController::class , 'logout'])->name('logout');

Route::get('/home', function(){
    return view('home');
})->middleware('auth')->name('home');


// candidate
Route::middleware(['auth', 'role:candidate'])
    ->prefix('candidate')
    ->group(function () {

    Route::get('/profile/edit', [CandidateProfileController::class, 'edit'])
        ->name('candidate.edit');

    Route::put('/profile/update', [CandidateProfileController::class, 'update'])
        ->name('candidate.update');
});

Route::get('candidate/profile/{id?}', [CandidateProfileController::class, 'show'])
        ->name('candidate.show')->middleware('auth');



// company
Route::middleware(['auth', 'role:recruiter'])
    ->prefix('company')
    ->group(function () {

    Route::get('/profile/edit', [CompanyProfileController::class, 'edit'])
        ->name('company.edit');

    Route::put('/profile/update', [CompanyProfileController::class, 'update'])
        ->name('company.update');
});

Route::get('company/profile/{id?}', [CompanyProfileController::class, 'show'])
    ->name('company.show')->middleware('auth');



// Jobs
Route::resource('jobs', JobController::class)->middleware('auth');


Route::patch('jobs/{job}/toggle', [JobController::class, 'toggle'])->middleware('auth')->name('jobs.toggle');


Route::get('/jobs-listings', [JobListings::class, 'index'])
       ->name('Jobs-listings')->middleware('auth');


Route::get('/applications', [ApplicationController::class, 'index'])
    ->name('applications.index')->middleware('auth');

Route::get('/application/create/{id}', [ApplicationController::class, 'create'])
    ->name('application.create')->middleware(['auth', 'role:candidate']);

Route::post('/application/store/{id}', [ApplicationController::class, 'store'])
    ->name('application.store')->middleware(['auth', 'role:candidate']);


Route::delete('/applications/delete/{id}', [ApplicationController::class, 'destroy'])
    ->name('applications.delete')->middleware(['auth', 'role:candidate']);



// Route::get('/recruiter/dashboard', [RecruiterDashboardController::class, 'index']);