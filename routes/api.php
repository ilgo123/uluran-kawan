<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Api\UserVerificationController;
use App\Http\Controllers\DonationController;

// Resource route untuk campaign
Route::apiResource('campaigns', CampaignController::class);

// Group route yang membutuhkan token login dari Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/user/upload-ktm', [UserVerificationController::class, 'uploadKTM']);

    Route::post('/donations/initiate', [DonationController::class, 'initiateDonation']);
    Route::get('/donations', [DonationController::class, 'index']);
    Route::get('/donations/{donation}', [DonationController::class, 'show']);
});

// Midtrans callback (tidak perlu autentikasi)
Route::post('/payment/callback', [DonationController::class, 'handlePaymentCallback']);