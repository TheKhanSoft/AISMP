<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $file = app_path('Helpers/helpers.php');
        if (file_exists($file)) {
            require_once $file;
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            // Share global settings with all views
            if (!app()->runningInConsole() && \Illuminate\Support\Facades\Schema::hasTable('settings')) {
                View::share('site_name', setting('site_name', 'AI Society'));
                View::share('site_logo', setting('site_logo'));
                View::share('site_tagline', setting('site_tagline'));
                View::share('primary_color', setting('primary_color', '#0f172a'));
                
                // Share social links group
                View::share('social_links', settings_group('social'));
            }
        } catch (\Exception $e) {
            // Ignore during setup/migrations
        }
    }
}
