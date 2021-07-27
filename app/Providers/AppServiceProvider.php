<?php

namespace App\Providers;

use App\Observers\Api\UuidObserver;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Product::observe(UuidObserver::class);
    }
}
