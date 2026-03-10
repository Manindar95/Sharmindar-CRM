<?php

namespace Sharmindar\Core\Automation\Providers;

use Sharmindar\Core\Automation\Models\Webhook;
use Sharmindar\Core\Automation\Models\Workflow;
use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * Define the modals to map with this module.
     *
     * @var array
     */
    protected $models = [
        Workflow::class,
        Webhook::class,
    ];
}
