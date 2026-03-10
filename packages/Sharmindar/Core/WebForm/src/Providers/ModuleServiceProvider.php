<?php

namespace Sharmindar\Core\WebForm\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\WebForm\Models\WebForm::class,
        \Sharmindar\Core\WebForm\Models\WebFormAttribute::class,
    ];
}
