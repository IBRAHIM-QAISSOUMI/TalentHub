<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\CompanyProfileController;

Route::get('/', [AuthController::class , "showFormRegister"]);
Route::post('/', [AuthController::class , "register"])->name('register');

Route::get('/login', [AuthController::class , "showFormLogin"]);
Route::post('/login', [AuthController::class , "login"])->name('login');

Route::post('/home', [AuthController::class , 'logout'])->name('logout');

Route::get('/home', function(){
    return view('home');
})->middleware('auth')->name('home');



Route::middleware(['auth'])->group(function () {

    Route::get('/candidate/profile/edit', [CandidateProfileController::class, 'edit'])->name('candidate.edit');
    Route::put('/candidate/profile/update', [CandidateProfileController::class, 'update'])->name('candidate.update');
    Route::get('/candidate/profile', [CandidateProfileController::class, 'show'])->name('candidate.show');

    // Route::get('/candidate/dashboard', [CandidateDashboardController::class, 'index']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/recruiter/profile/edit', [CompanyProfileController::class, 'edit']);
    Route::post('/recruiter/profile', [CompanyProfileController::class, 'update']);

    // Route::get('/recruiter/dashboard', [RecruiterDashboardController::class, 'index']);
});