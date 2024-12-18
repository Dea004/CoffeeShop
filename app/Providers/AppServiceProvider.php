<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CoffeeShop;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        // Menyebarkan variabel hasShop ke seluruh tampilan
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $hasShop = CoffeeShop::where('id_user', Auth::id())->exists();
                $view->with('hasShop', $hasShop);
            } else {
                $view->with('hasShop', false);
            }
        });
    }
}
