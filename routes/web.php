<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;

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

Route::group(["middleware" => "auth"], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Campaigns home
Route::get('/campaigns', [CampaignController::class, 'home'])->name('campaigns.home');

Route::get('/campaigns/explore', [CampaignController::class, 'explore'])->name('campaigns.explore');
