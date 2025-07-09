<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Pengecualian CSRF yang sudah ada
        $middleware->validateCsrfTokens(except: [
            'midtrans/*',
        ]);

        // TAMBAHKAN KODE INI untuk mempercayai proxy Ngrok
        // $middleware->trustProxies(at: [
        //     '*', // Mempercayai semua proxy (aman untuk development dengan Ngrok)
        // ]);

    })
    ->withProviders([
        App\Providers\Filament\AdminPanelProvider::class, // Biasanya sudah ada
        App\Providers\MidtransServiceProvider::class, // <-- Tambahkan ini untuk Midtrans
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
