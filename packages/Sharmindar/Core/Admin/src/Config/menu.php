<?php

return [

    [
        'key' => 'dashboard',
        'name' => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'icon-dashboard',
    ],

    // =========================================================
    // GROUP 1: Sales & Growth (Pre-Project) — sort 100-199
    // =========================================================

    [
        'key' => 'leads',
        'name' => 'admin::app.layouts.leads',
        'route' => 'admin.leads.index',
        'sort' => 101,
        'icon-class' => 'icon-leads',
        'group' => 'Sales & Growth',
    ],

    [
        'key' => 'it_sales',
        'name' => 'IT Sales',
        'route' => 'admin.it_sales.lifecycle.statuses.index',
        'sort' => 102,
        'icon-class' => 'icon-note',
        'group' => 'Sales & Growth',
    ], [
        'key' => 'it_sales.services_catalog',
        'name' => 'Services Catalog',
        'route' => 'admin.it_sales.services.index',
        'sort' => 1,
        'icon-class' => 'icon-product',
    ], [
        'key' => 'it_sales.proposals',
        'name' => 'Proposals',
        'route' => 'admin.it_sales.proposals.index',
        'sort' => 2,
        'icon-class' => 'icon-note',
    ], [
        'key' => 'it_sales.requirements',
        'name' => 'Requirements',
        'route' => 'admin.it_sales.requirements.index',
        'sort' => 3,
        'icon-class' => 'icon-note',
    ], [
        'key' => 'it_sales.estimations',
        'name' => 'Estimations',
        'route' => 'admin.it_sales.estimations.index',
        'sort' => 4,
        'icon-class' => 'icon-note',
    ], [
        'key' => 'it_sales.lifecycle_statuses',
        'name' => 'Lifecycle Statuses',
        'route' => 'admin.it_sales.lifecycle.statuses.index',
        'sort' => 5,
        'icon-class' => 'icon-settings-pipeline',
    ], [
        'key' => 'it_sales.project_handovers',
        'name' => 'Project Handovers',
        'route' => 'admin.it_sales.handovers.index',
        'sort' => 6,
        'icon-class' => 'icon-note',
    ], [
        'key' => 'it_sales.approvals',
        'name' => 'Approvals',
        'route' => 'admin.it_sales.approvals.index',
        'sort' => 7,
        'icon-class' => 'icon-activity',
    ],

    [
        'key' => 'quotes',
        'name' => 'admin::app.layouts.quotes',
        'route' => 'admin.quotes.index',
        'sort' => 103,
        'icon-class' => 'icon-quote',
        'group' => 'Sales & Growth',
    ],

    [
        'key' => 'contacts',
        'name' => 'admin::app.layouts.contacts',
        'route' => 'admin.contacts.persons.index',
        'sort' => 104,
        'icon-class' => 'icon-contact',
        'group' => 'Sales & Growth',
    ], [
        'key' => 'contacts.persons',
        'name' => 'admin::app.layouts.persons',
        'route' => 'admin.contacts.persons.index',
        'sort' => 1,
        'icon-class' => '',
    ], [
        'key' => 'contacts.organizations',
        'name' => 'admin::app.layouts.organizations',
        'route' => 'admin.contacts.organizations.index',
        'sort' => 2,
        'icon-class' => '',
    ],

    // =========================================================
    // GROUP 2: Operations & Delivery (Execution) — sort 200-299
    // =========================================================

    [
        'key' => 'projects',
        'name' => 'admin::app.layouts.projects',
        'route' => 'admin.projects.index',
        'sort' => 201,
        'icon-class' => 'icon-note',
        'group' => 'Operations & Delivery',
    ],

    [
        'key' => 'products',
        'name' => 'admin::app.layouts.products',
        'route' => 'admin.products.index',
        'sort' => 202,
        'icon-class' => 'icon-product',
        'group' => 'Operations & Delivery',
    ],

    [
        'key' => 'tasks',
        'name' => 'admin::app.layouts.tasks',
        'route' => 'admin.tasks.index',
        'sort' => 203,
        'icon-class' => 'icon-activity',
        'group' => 'Operations & Delivery',
    ],

    [
        'key' => 'activities',
        'name' => 'admin::app.layouts.activities',
        'route' => 'admin.activities.index',
        'sort' => 204,
        'icon-class' => 'icon-activity',
        'group' => 'Operations & Delivery',
    ],

    // =========================================================
    // GROUP 3: Resource Management (Tracking) — sort 300-399
    // =========================================================

    [
        'key' => 'timesheets',
        'name' => 'admin::app.layouts.timesheets',
        'route' => 'admin.timesheets.index',
        'sort' => 301,
        'icon-class' => 'icon-calendar',
        'group' => 'Resource Management',
    ],



    // =========================================================
    // GROUP 4: Communication — sort 400-499
    // =========================================================

    // Mail Module is safely deprecated — hidden from sidebar.
    // Uncomment below to re-enable when a proper mail solution is in place.
    // [
    //     'key'        => 'mail',
    //     'name'       => 'admin::app.layouts.mail',
    //     'route'      => 'admin.mail.index.index',
    //     'sort'       => 401,
    //     'icon-class' => 'icon-mail',
    //     'group'      => 'Communication',
    // ],

    // =========================================================
    // GROUP 5: System Administration (Footer) — sort 900+
    // =========================================================

    [
        'key' => 'settings',
        'name' => 'admin::app.layouts.settings',
        'route' => 'admin.settings.index',
        'sort' => 901,
        'icon-class' => 'icon-setting',
        'group' => 'System Administration',
    ], [
        'key' => 'settings.user',
        'name' => 'admin::app.layouts.user',
        'route' => 'admin.settings.groups.index',
        'info' => 'admin::app.layouts.user-info',
        'sort' => 1,
        'icon-class' => 'icon-settings-group',
    ], [
        'key' => 'settings.user.groups',
        'name' => 'admin::app.layouts.groups',
        'info' => 'admin::app.layouts.groups-info',
        'route' => 'admin.settings.groups.index',
        'sort' => 1,
        'icon-class' => 'icon-settings-group',
    ], [
        'key' => 'settings.user.roles',
        'name' => 'admin::app.layouts.roles',
        'info' => 'admin::app.layouts.roles-info',
        'route' => 'admin.settings.roles.index',
        'sort' => 2,
        'icon-class' => 'icon-role',
    ], [
        'key' => 'settings.user.users',
        'name' => 'admin::app.layouts.users',
        'info' => 'admin::app.layouts.users-info',
        'route' => 'admin.settings.users.index',
        'sort' => 3,
        'icon-class' => 'icon-user',
    ], [
        'key' => 'settings.user.employees',
        'name' => 'Employees',
        'info' => 'Manage all employees in the CRM',
        'route' => 'company.core.user.employees.index',
        'sort' => 4,
        'icon-class' => 'icon-user',
    ], [
        'key' => 'settings.organization',
        'name' => 'Organization',
        'info' => 'Manage hierarchical departments and designations',
        'route' => 'company.core.department.index',
        'sort' => 2,
        'icon-class' => '',
    ], [
        'key' => 'settings.organization.departments',
        'name' => 'Departments',
        'info' => 'Manage departments and reporting hierarchy',
        'route' => 'company.core.department.index',
        'sort' => 1,
        'icon-class' => 'icon-settings-group',
    ], [
        'key' => 'settings.organization.designations',
        'name' => 'Designations',
        'info' => 'Manage job roles and designations',
        'route' => 'company.core.department.designations.index',
        'sort' => 2,
        'icon-class' => 'icon-role',
    ], [
        'key' => 'settings.lead',
        'name' => 'admin::app.layouts.lead',
        'info' => 'admin::app.layouts.lead-info',
        'route' => 'admin.settings.pipelines.index',
        'sort' => 3,
        'icon-class' => '',
    ], [
        'key' => 'settings.lead.pipelines',
        'name' => 'admin::app.layouts.pipelines',
        'info' => 'admin::app.layouts.pipelines-info',
        'route' => 'admin.settings.pipelines.index',
        'sort' => 1,
        'icon-class' => 'icon-settings-pipeline',
    ], [
        'key' => 'settings.lead.sources',
        'name' => 'admin::app.layouts.sources',
        'info' => 'admin::app.layouts.sources-info',
        'route' => 'admin.settings.sources.index',
        'sort' => 2,
        'icon-class' => 'icon-settings-sources',
    ], [
        'key' => 'settings.lead.types',
        'name' => 'admin::app.layouts.types',
        'info' => 'admin::app.layouts.types-info',
        'route' => 'admin.settings.types.index',
        'sort' => 3,
        'icon-class' => 'icon-settings-type',
    ], [
        'key' => 'settings.warehouse',
        'name' => 'admin::app.layouts.warehouse',
        'info' => 'admin::app.layouts.warehouses-info',
        'route' => 'admin.settings.pipelines.index',
        'sort' => 4,
        'icon-class' => '',
    ], [
        'key' => 'settings.warehouse.warehouses',
        'name' => 'admin::app.layouts.warehouses',
        'info' => 'admin::app.layouts.warehouses-info',
        'route' => 'admin.settings.warehouses.index',
        'sort' => 1,
        'icon-class' => 'icon-settings-warehouse',
    ], [
        'key' => 'settings.automation',
        'name' => 'admin::app.layouts.automation',
        'info' => 'admin::app.layouts.automation-info',
        'route' => 'admin.settings.attributes.index',
        'sort' => 5,
        'icon-class' => '',
    ], [
        'key' => 'settings.automation.attributes',
        'name' => 'admin::app.layouts.attributes',
        'info' => 'admin::app.layouts.attributes-info',
        'route' => 'admin.settings.attributes.index',
        'sort' => 1,
        'icon-class' => 'icon-attribute',
    ], [
        'key' => 'settings.automation.webhooks',
        'name' => 'admin::app.layouts.webhooks',
        'info' => 'admin::app.layouts.webhooks-info',
        'route' => 'admin.settings.webhooks.index',
        'sort' => 2,
        'icon-class' => 'icon-settings-webhooks',
    ], [
        'key' => 'settings.automation.workflows',
        'name' => 'admin::app.layouts.workflows',
        'info' => 'admin::app.layouts.workflows-info',
        'route' => 'admin.settings.workflows.index',
        'sort' => 3,
        'icon-class' => 'icon-settings-flow',
    ], [
        'key' => 'settings.automation.data_transfer',
        'name' => 'admin::app.layouts.data_transfer',
        'info' => 'admin::app.layouts.data_transfer_info',
        'route' => 'admin.settings.data_transfer.imports.index',
        'sort' => 4,
        'icon-class' => 'icon-download',
    ], [
        'key' => 'settings.other_settings',
        'name' => 'admin::app.layouts.other-settings',
        'info' => 'admin::app.layouts.other-settings-info',
        'route' => 'admin.settings.tags.index',
        'sort' => 6,
        'icon-class' => 'icon-settings',
    ], [
        'key' => 'settings.other_settings.tags',
        'name' => 'admin::app.layouts.tags',
        'info' => 'admin::app.layouts.tags-info',
        'route' => 'admin.settings.tags.index',
        'sort' => 1,
        'icon-class' => 'icon-settings-tag',
    ],

    [
        'key' => 'configuration',
        'name' => 'admin::app.layouts.configuration',
        'route' => 'admin.configuration.index',
        'sort' => 902,
        'icon-class' => 'icon-configuration',
        'group' => 'System Administration',
    ],

];
