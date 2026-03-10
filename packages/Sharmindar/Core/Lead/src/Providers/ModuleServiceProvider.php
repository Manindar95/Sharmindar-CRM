<?php

namespace Sharmindar\Core\Lead\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Lead\Models\Lead::class,
        \Sharmindar\Core\Lead\Models\Pipeline::class,
        \Sharmindar\Core\Lead\Models\Product::class,
        \Sharmindar\Core\Lead\Models\Source::class,
        \Sharmindar\Core\Lead\Models\Stage::class,
        \Sharmindar\Core\Lead\Models\Type::class,
    ];
}
