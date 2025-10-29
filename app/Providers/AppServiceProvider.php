<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\FavoriteService;
use App\Services\LocalService;
use App\Contracts\UploaderInterface;
use App\Services\Upload\UploadFactory;

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

        $this->app->singleton(LocalService::class, function ($app) {
            return LocalService::getInstance();
        });

        $this->app->bind(UploaderInterface::class, function ($app) {
            $driver = config('upload.driver', env('UPLOAD_DRIVER', 'local'));
            $localService = $app->make(LocalService::class);
            return UploadFactory::make($driver, $localService);
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
