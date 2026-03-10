<?php

namespace Sharmindar\Core\Attribute\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Attribute\Models\Attribute::class,
        \Sharmindar\Core\Attribute\Models\AttributeOption::class,
        \Sharmindar\Core\Attribute\Models\AttributeValue::class,
    ];
}
