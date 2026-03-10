<?php

namespace Sharmindar\Core\DataTransfer\Providers;

use Sharmindar\Core\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * Define models to map with repository interfaces.
     *
     * @var array
     */
    protected $models = [
        \Sharmindar\Core\DataTransfer\Models\Import::class,
        \Sharmindar\Core\DataTransfer\Models\ImportBatch::class,
    ];
}
