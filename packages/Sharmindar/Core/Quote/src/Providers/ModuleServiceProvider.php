<?php

namespace Sharmindar\Core\Quote\Providers;

use Sharmindar\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Sharmindar\Core\Quote\Models\Quote::class,
        \Sharmindar\Core\Quote\Models\QuoteItem::class,
    ];
}
