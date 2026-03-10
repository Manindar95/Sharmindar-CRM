<?php

return [
    'leads'         => [
        'name'       => 'admin::app.leads.index.title',
        'repository' => 'Sharmindar\Core\Lead\Repositories\LeadRepository',
    ],

    'persons'       => [
        'name'       => 'admin::app.contacts.persons.index.title',
        'repository' => 'Sharmindar\Core\Contact\Repositories\PersonRepository',
    ],

    'organizations' => [
        'name'       => 'admin::app.contacts.organizations.index.title',
        'repository' => 'Sharmindar\Core\Contact\Repositories\OrganizationRepository',
    ],

    'products'      => [
        'name'       => 'admin::app.products.index.title',
        'repository' => 'Sharmindar\Core\Product\Repositories\ProductRepository',
    ],

    'quotes'      => [
        'name'       => 'admin::app.quotes.index.title',
        'repository' => 'Sharmindar\Core\Quote\Repositories\QuoteRepository',
    ],

    'warehouses'      => [
        'name'       => 'admin::app.settings.warehouses.index.title',
        'repository' => 'Sharmindar\Core\Warehouse\Repositories\WarehouseRepository',
    ],
];
