<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Gate::define('super-admin', function ($user) {
            return $user->hasRole('super-admin');
        });
    
        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
