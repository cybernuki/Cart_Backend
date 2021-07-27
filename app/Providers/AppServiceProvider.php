<?php

namespace App\Providers;

use App\Model\Client;
use App\Model\Product;
use App\Observers\Api\ClientObserver;
use App\Observers\Api\UuidObserver;
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
        Client::observe(UuidObserver::class);

        Client::observe(ClientObserver::class);
    }
}
