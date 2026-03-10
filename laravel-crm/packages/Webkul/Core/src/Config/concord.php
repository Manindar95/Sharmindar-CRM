<?php

return [
    'modules' => [
        \Sharmindar\Core\Activity\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Admin\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Attribute\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Automation\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Contact\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Core\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\DataGrid\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\EmailTemplate\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Email\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Lead\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Product\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Quote\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Tag\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\User\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\Warehouse\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\WebForm\Providers\ModuleServiceProvider::class,
        \Sharmindar\Core\DataTransfer\Providers\ModuleServiceProvider::class,
    ],

    'register_route_models' => true,
];
