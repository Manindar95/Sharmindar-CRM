<?php

namespace Sharmindar\Core\EmailTemplate\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\EmailTemplate\Models\EmailTemplate::class,
    ];
}
