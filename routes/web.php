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



Route::middleware(['auth', 'role:candidate'])
    ->prefix('candidate')
    ->group(function () {

    Route::get('/profile/edit', [CandidateProfileController::class, 'edit'])
        ->name('candidate.edit');

    Route::put('/profile/update', [CandidateProfileController::class, 'update'])
        ->name('candidate.update');

    Route::get('/profile/{id?}', [CandidateProfileController::class, 'show'])
        ->name('candidate.show');

});


Route::middleware(['auth', 'role:recruiter'])
    ->prefix('company')
    ->group(function () {

    Route::get('/profile/edit', [CompanyProfileController::class, 'edit'])
        ->name('company.edit');

    Route::put('/profile/update', [CompanyProfileController::class, 'update'])
        ->name('company.update');

    Route::put('/profile/{id?}', [CompanyProfileController::class, 'show'])
        ->name('company.show');

});


// Route::get('/recruiter/dashboard', [RecruiterDashboardController::class, 'index']);