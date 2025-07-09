<?php

use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserCampaignController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampaignController::class, 'home'])->name('home');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{campaign:slug}', [CampaignController::class, 'show'])->name('campaigns.show');

Route::get('/register', [AuthenticatedUserController::class, 'createRegister'])->name('register');
Route::post('/register', [AuthenticatedUserController::class, 'storeRegister']);

Route::get('/login', [AuthenticatedUserController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthenticatedUserController::class, 'storeLogin']);

Route::post('/logout', [AuthenticatedUserController::class, 'destroy'])->name('logout');

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-campaigns/create', [UserCampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/my-campaigns', [UserCampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/my-campaigns/{campaign}/edit', [UserCampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/my-campaigns/{campaign}', [UserCampaignController::class, 'update'])->name('campaigns.update');
    Route::post('/donations/success', [DonationController::class, 'success'])->name('donations.success');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    // routes/web.php
     Route::get('/reviews/create/{campaign}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/success-stories', [CampaignController::class, 'successStories'])->name('campaigns.success');
Route::post('/donations', [DonationController::class, 'store'])->middleware('auth')->name('donations.store');
// Route::post('/midtrans/callback', [DonationController::class, 'callback'])->name('midtrans.callback');
// Route::post('/midtrans/callback', function (Request $request) {
//     // Tulis ke log DULU untuk jejak permanen
//     Log::info('--- [DD TEST] ROUTE CALLBACK DIAKSES ---', $request->all());

//     // HENTIKAN SEMUA dan tampilkan data langsung
//     dd('WEBHOOK BERHASIL SAMPAI DI ROUTE!', $request->all());
// })->name('midtrans.callback');
// HANYA UNTUK DEVELOPMENT
Route::get('/test-webhook/{donationId}', function($donationId) {
    $donation = \App\Models\Donation::find($donationId);

    if (!$donation) {
        return 'Donasi tidak ditemukan.';
    }

    if ($donation->status === 'pending') {
        $donation->update(['status' => 'success', 'transaction_id' => 'TEST-'.uniqid()]);
        $donation->campaign->increment('current_amount', $donation->amount);
        return 'Simulasi webhook BERHASIL! Saldo untuk campaign "' . $donation->campaign->title . '" seharusnya sudah bertambah.';
    } else {
        return 'Donasi ini sudah diproses sebelumnya.';
    }

})->middleware('auth');
