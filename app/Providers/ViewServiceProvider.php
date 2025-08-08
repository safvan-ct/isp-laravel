<?php
namespace App\Providers;

use App\Models\Topic;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            if (request()->routeIs('admin.*')) {
                return;
            }

            $menus = Cache::remember(app()->getLocale() . '_primary_menus', now()->addHours(6), function () {
                return Topic::select('id', 'slug', 'position')
                    ->with(['translations' => fn($q) => $q
                            ->select('id', 'topic_id', 'title')
                            ->active()
                            ->lang(),
                    ])
                    ->whereHas('translations', fn($q) => $q->lang()->active())
                    ->where('type', 'menu')
                    ->whereNull('parent_id')
                    ->where('is_primary', 1)
                    ->active()
                    ->orderBy('position')
                    ->get();
            });

            $view->with('menus', $menus);
        });
    }
}
