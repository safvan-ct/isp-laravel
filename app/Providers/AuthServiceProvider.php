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
    public function boot(): void
    {
        if (! request()->routeIs('admin.*')) {
            return;
        }

        Gate::before(function ($user, $ability) {
            return $user->hasAnyRole('Developer', 'Owner') ? true : null;
        });
    }
}
