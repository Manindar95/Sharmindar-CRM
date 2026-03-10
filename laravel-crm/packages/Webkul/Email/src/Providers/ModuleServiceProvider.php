<?php

namespace Sharmindar\Core\Email\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Email\Models\Email::class,
        \Sharmindar\Core\Email\Models\Attachment::class,
    ];
}
