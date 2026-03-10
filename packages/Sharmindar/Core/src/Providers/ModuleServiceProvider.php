<?php

namespace Sharmindar\Core\Providers;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Models\CoreConfig::class,
        \Sharmindar\Core\Models\Country::class,
        \Sharmindar\Core\Models\CountryState::class,
    ];
}
