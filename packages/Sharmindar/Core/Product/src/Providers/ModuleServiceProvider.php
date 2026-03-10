<?php

namespace Sharmindar\Core\Product\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Product\Models\Product::class,
        \Sharmindar\Core\Product\Models\ProductInventory::class,
    ];
}
