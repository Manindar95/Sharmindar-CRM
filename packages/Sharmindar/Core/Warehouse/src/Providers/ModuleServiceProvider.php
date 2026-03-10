<?php

namespace Sharmindar\Core\Warehouse\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Warehouse\Models\Location::class,
        \Sharmindar\Core\Warehouse\Models\Warehouse::class,
    ];
}
