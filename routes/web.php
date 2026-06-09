<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class , "showFormRegister"]);
Route::post('/', [AuthController::class , "register"])->name('register');

Route::get('/login', [AuthController::class , "showFormLogin"]);
Route::post('/login', [AuthController::class , "login"])->name('login');

Route::post('/home', [AuthController::class , 'logout'])->name('logout');

Route::get('/home', function(){
    return view('home');
})->middleware('auth')->name('home');
