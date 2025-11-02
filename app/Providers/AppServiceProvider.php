<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\FavoriteService;
use App\Services\LocalService;
use App\Contracts\UploaderInterface;
use App\Services\Upload\UploadFactory;
use App\Models\Comment;
use App\Observers\CommentObserver;
use App\Models\Local;
use App\Observers\LocalObserver;

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

        Comment::observe(CommentObserver::class);
        Local::observe(LocalObserver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
