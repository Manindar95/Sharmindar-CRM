<?php

namespace Sharmindar\Core\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Sharmindar\Core\Dashboard\Managers\DashboardManager;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the DashboardManager as a singleton so all modules access the exact same registry
        $this->app->singleton('company.dashboard', function ($app) {
            return new DashboardManager();
        });

        $this->registerConfig();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'company_dashboard');

        // Testing the new Engine Dashboard Logic
        \Sharmindar\Core\Dashboard\Facades\Dashboard::registerWidget(
            \Sharmindar\Core\Dashboard\Widgets\System\WelcomeWidget::class
        );
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
    /* Optionally load specific dashboard config if needed later
     $this->mergeConfigFrom(
     dirname(__DIR__) . '/Config/dashboard.php', 'company.dashboard'
     );
     */
    }
}
