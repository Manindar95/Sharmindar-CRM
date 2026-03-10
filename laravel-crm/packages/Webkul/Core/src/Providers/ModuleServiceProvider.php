<?php

namespace Sharmindar\Core\Core\Providers;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Core\Models\CoreConfig::class,
        \Sharmindar\Core\Core\Models\Country::class,
        \Sharmindar\Core\Core\Models\CountryState::class,
    ];
}
