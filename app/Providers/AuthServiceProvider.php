<?php
namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

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
        Gate::before(function ($user, $ability) {
            return $user->hasAnyRole('Developer', 'Owner') ? true : null;
        });
    }
}
