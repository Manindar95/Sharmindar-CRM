<?php

namespace Sharmindar\Core\Admin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'contacts.person.create.after' => [
            'Sharmindar\Core\Admin\Listeners\Person@linkToEmail',
        ],

        'lead.create.after' => [
            'Sharmindar\Core\Admin\Listeners\Lead@linkToEmail',
        ],

        'activity.create.after' => [
            'Sharmindar\Core\Admin\Listeners\Activity@afterUpdateOrCreate',
        ],

        'activity.update.after' => [
            'Sharmindar\Core\Admin\Listeners\Activity@afterUpdateOrCreate',
        ],
    ];
}
