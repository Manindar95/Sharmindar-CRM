<?php

namespace Company\Core\Activity\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Company\Core\Activity\Listeners\AuthenticationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the package.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            [AuthenticationListener::class , 'onUserLogin'],
        ],
        Logout::class => [
            [AuthenticationListener::class , 'onUserLogout'],
        ],
    ];

    /**
     * Register any events for your package.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
