<?php

namespace Sharmindar\Core\Tag\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Tag\Models\Tag::class,
    ];
}
