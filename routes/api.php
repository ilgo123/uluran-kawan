<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Api\UserVerificationController;


Route::apiResource('campaigns', CampaignController::class);

Route::middleware('auth')->group(function () {
    Route::post('/user/upload-ktm', [UserVerificationController::class, 'uploadKTM']);
});

Route::post('/user/upload-ktm', [UserVerificationController::class, 'uploadKTM']);
