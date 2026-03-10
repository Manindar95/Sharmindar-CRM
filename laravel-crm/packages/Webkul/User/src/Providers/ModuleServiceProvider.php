<?php

namespace Sharmindar\Core\User\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\User\Models\Group::class,
        \Sharmindar\Core\User\Models\Role::class,
        \Sharmindar\Core\User\Models\User::class,
    ];
}
