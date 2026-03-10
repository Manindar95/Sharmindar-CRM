<?php

namespace Sharmindar\Core\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Load the helpers file
        include __DIR__ . '/../Http/helpers.php';

        // Register the 'core' singleton
        $this->app->singleton('core', function ($app) {
            return $app->make(\Sharmindar\Core\Core::class);
        });

        // Register the 'menu' singleton
        $this->app->singleton('menu', function ($app) {
            return $app->make(\Sharmindar\Core\Menu::class);
        });

        // Register the 'acl' singleton
        $this->app->singleton('acl', function ($app) {
            return $app->make(\Sharmindar\Core\Acl::class);
        });

        // Register the 'system_config' singleton
        $this->app->singleton('system_config', function ($app) {
            return $app->make(\Sharmindar\Core\SystemConfig::class);
        });
    }
}
