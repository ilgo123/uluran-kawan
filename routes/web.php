<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KTMUploadController;
use App\Http\Controllers\DonationController;

// Halaman beranda
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Group routes dengan auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/upload-ktm', [KTMUploadController::class, 'showForm'])->name('ktm.form');
    Route::post('/upload-ktm', [KTMUploadController::class, 'submitForm'])->name('ktm.submit');

    // Inisiasi donasi (harus login)
    Route::post('/donations/initiate', [DonationController::class, 'initiateDonation']);
});

// Callback dari Midtrans (tidak pakai middleware)
Route::post('/payment/callback', [DonationController::class, 'handlePaymentCallback']);