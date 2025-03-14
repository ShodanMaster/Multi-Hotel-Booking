<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $authenticatedGuards = [
                'web' => auth('web')->check(),
                'admin' => auth('admin')->check(),
                'hotel' => auth('hotel')->check(),
            ];

            $view->with('authenticatedGuards', $authenticatedGuards);
        });
    }
}
