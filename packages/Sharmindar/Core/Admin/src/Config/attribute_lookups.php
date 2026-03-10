<?php

return [
    'leads' => [
        'name'         => 'Leads',
        'repository'   => 'Sharmindar\Core\Lead\Repositories\LeadRepository',
        'label_column' => 'title',
    ],

    'lead_sources' => [
        'name'         => 'Lead Sources',
        'repository'   => 'Sharmindar\Core\Lead\Repositories\SourceRepository',
    ],

    'lead_types' => [
        'name'         => 'Lead Types',
        'repository'   => 'Sharmindar\Core\Lead\Repositories\TypeRepository',
    ],

    'lead_pipelines' => [
        'name'         => 'Lead Pipelines',
        'repository'   => 'Sharmindar\Core\Lead\Repositories\PipelineRepository',
    ],

    'lead_pipeline_stages' => [
        'name'         => 'Lead Pipeline Stages',
        'repository'   => 'Sharmindar\Core\Lead\Repositories\StageRepository',
    ],

    'users' => [
        'name'         => 'Sales Owners',
        'repository'   => 'Sharmindar\Core\User\Repositories\UserRepository',
    ],

    'organizations' => [
        'name'         => 'Organizations',
        'repository'   => 'Sharmindar\Core\Contact\Repositories\OrganizationRepository',
    ],

    'persons' => [
        'name'         => 'Persons',
        'repository'   => 'Sharmindar\Core\Contact\Repositories\PersonRepository',
    ],

    'warehouses' => [
        'name'         => 'Warehouses',
        'repository'   => 'Sharmindar\Core\Warehouse\Repositories\WarehouseRepository',
    ],

    'locations' => [
        'name'         => 'Locations',
        'repository'   => 'Sharmindar\Core\Warehouse\Repositories\LocationRepository',
    ],
];
