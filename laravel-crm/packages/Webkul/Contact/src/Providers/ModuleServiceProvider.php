<?php

namespace Sharmindar\Core\Contact\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Contact\Models\Person::class,
        \Sharmindar\Core\Contact\Models\Organization::class,
    ];
}
