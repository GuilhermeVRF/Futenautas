<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
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
    public function boot(): void
    {
        Auth::extend('users', function ($app, $name, array $config) {
            return new EloquentUserProvider($app['hash'],$config['model']);
        });

        Auth::extend('admins', function ($app, $name, array $config) {
            return new EloquentUserProvider($app['hash'],$config['model']);
        });
    }
}
