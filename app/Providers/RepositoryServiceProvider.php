<?php
namespace App\Providers;

use App\Repository\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use App\Repository\Settings\SettingsInterface;
use App\Repository\Settings\SettingsRepository;
use App\Repository\User\UserInterface;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SettingsInterface::class, SettingsRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
