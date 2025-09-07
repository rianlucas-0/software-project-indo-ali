<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\FavoriteService;
use App\Services\LocalService; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });

        $this->app->bind(FavoriteService::class, function ($app) {
            return new FavoriteService();
        });

        $this->app->bind(LocalService::class, function ($app) {
            return new LocalService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
