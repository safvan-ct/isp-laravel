<?php
namespace App\Providers;

use App\Repository\Quran\QuranChapterInterface;
use App\Repository\Quran\QuranChapterRepository;
use App\Repository\Quran\QuranChapterTranslationInterface;
use App\Repository\Quran\QuranChapterTranslationRepository;
use App\Repository\Quran\QuranVerseInterface;
use App\Repository\Quran\QuranVerseRepository;
use App\Repository\Quran\QuranVerseTranslationInterface;
use App\Repository\Quran\QuranVerseTranslationRepository;
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

        $this->app->bind(QuranChapterInterface::class, QuranChapterRepository::class);
        $this->app->bind(QuranChapterTranslationInterface::class, QuranChapterTranslationRepository::class);
        $this->app->bind(QuranVerseInterface::class, QuranVerseRepository::class);
        $this->app->bind(QuranVerseTranslationInterface::class, QuranVerseTranslationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
