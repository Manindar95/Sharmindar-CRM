<?php

namespace Sharmindar\Core\DataGrid\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\DataGrid\Models\SavedFilter::class,
    ];
}
