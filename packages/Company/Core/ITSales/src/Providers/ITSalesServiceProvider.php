<?php

namespace Company\Core\ITSales\Providers;

use Company\Core\ITSales\Console\Commands\SendStaleLeadReminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class ITSalesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->commands([
            SendStaleLeadReminders::class ,
        ]);

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.admin'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'it_sales');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'it_sales');

        $this->loadRoutesFrom(__DIR__ . '/../../routes/it-sales-routes.php');

        // Schedule the stale lead reminder to run every hour
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('leads:remind-stale')->hourly();
        });
    }
}
