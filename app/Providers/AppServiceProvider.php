<?php

namespace App\Providers;

use App\Models\Campaign;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::policy(Campaign::class, CampaignPolicy::class);
        if (config('app.force_https', false)) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
        if (auth()->check()) {
            $view->with('unreadNotifications', auth()->user()->unreadNotifications()->take(5)->get());
        }
    });
    }
}
