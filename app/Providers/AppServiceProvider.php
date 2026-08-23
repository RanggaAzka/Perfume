<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(
            ['components.footer', 'pages.contact', 'home.refill-service'],
            function ($view) {
                // Guard against the settings table not existing yet (e.g. a
                // fresh checkout before migrations have run) so views never
                // hard-fail on this.
                $settings = Schema::hasTable('site_settings') ? SiteSetting::current() : null;

                $view->with('siteSettings', $settings);
            }
        );
    }
}
