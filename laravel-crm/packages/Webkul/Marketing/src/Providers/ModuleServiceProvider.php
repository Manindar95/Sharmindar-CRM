<?php

namespace Sharmindar\Core\Marketing\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * Define the module's array.
     *
     * @var array
     */
    protected $models = [
        \Sharmindar\Core\Marketing\Models\Event::class,
        \Sharmindar\Core\Marketing\Models\Campaign::class,
    ];
}
