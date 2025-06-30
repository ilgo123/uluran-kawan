<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KTMUploadController;


// Halaman beranda
Route::get('/', function () {
    return view('welcome');
});

// Halaman Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Halaman Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

<<<<<<< HEAD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/upload-ktm', [KTMUploadController::class, 'showForm'])->name('ktm.form');
    Route::post('/upload-ktm', [KTMUploadController::class, 'submitForm'])->name('ktm.submit');
});
=======
Route::group(["middleware" => "auth"], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
>>>>>>> 777b3b4c3736a7b9bdfe86236a032a80ba8fe35f
