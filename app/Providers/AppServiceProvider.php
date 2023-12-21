<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
        require app_path('Breadcrumbs/breadcrumbs.php');

        View::composer('components.nav-bar', function ($view) {
            $view->with('spaces', Auth::user()->spaces);
        });
    }
}
