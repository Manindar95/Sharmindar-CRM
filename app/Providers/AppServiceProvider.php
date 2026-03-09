<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Http::globalRequestMiddleware(fn($handler) => function ($request, $options) use ($handler) {
            $host = $request->getUri()->getHost();

            // Enterprise Whitelist
            $allowedDomains = [
                'localhost',
                '127.0.0.1',
                'openrouter.ai', // Authorized Magic AI Service
            ];

            if (!in_array($host, $allowedDomains)) {
                throw new \Exception("Enterprise Security Policy: Outbound connection to [{$host}] is blocked.");
            }

            return $handler($request, $options);
        });
    }
}
