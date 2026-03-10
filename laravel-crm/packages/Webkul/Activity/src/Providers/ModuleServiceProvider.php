<?php

namespace Sharmindar\Core\Activity\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Activity\Models\Activity::class,
        \Sharmindar\Core\Activity\Models\File::class,
        \Sharmindar\Core\Activity\Models\Participant::class,
    ];
}
