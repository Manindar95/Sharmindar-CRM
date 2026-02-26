<?php

return [
    /**
     * Dashboard.
     */
    [
        'key'        => 'dashboard',
        'name'       => 'admin::app.layouts.dashboard',
        'route'      => 'admin.dashboard.index',
        'sort'       => 1,
        'icon-class' => 'icon-dashboard',
    ],

    /**
     * Accounts Department.
     */
    [
        'key'        => 'accounts-dept',
        'name'       => 'admin::app.layouts.accounts-dept',
        'route'      => 'admin.quotes.index',
        'sort'       => 2,
        'icon-class' => 'icon-product',
    ], [
        'key'        => 'accounts-dept.quotes',
        'name'       => 'admin::app.layouts.quotes',
        'route'      => 'admin.quotes.index',
        'sort'       => 1,
        'icon-class' => 'icon-quote',
    ], [
        'key'        => 'accounts-dept.payments',
        'name'       => 'admin::app.layouts.payments',
        'route'      => 'admin.payments.index',
        'sort'       => 2,
        'icon-class' => 'icon-product',
    ],

    /**
     * Marketing Department.
     */
    [
        'key'        => 'marketing-dept',
        'name'       => 'admin::app.layouts.marketing-dept',
        'route'      => 'admin.leads.index',
        'sort'       => 3,
        'icon-class' => 'icon-leads',
    ], [
        'key'        => 'marketing-dept.leads',
        'name'       => 'admin::app.layouts.leads',
        'route'      => 'admin.leads.index',
        'sort'       => 1,
        'icon-class' => 'icon-leads',
    ], [
        'key'        => 'marketing-dept.proposals',
        'name'       => 'admin::app.proposals.index.title',
        'route'      => 'admin.proposals.index',
        'sort'       => 2,
        'icon-class' => 'icon-quote',
    ], [
        'key'        => 'marketing-dept.contacts',
        'name'       => 'admin::app.layouts.contacts',
        'route'      => 'admin.contacts.persons.index',
        'sort'       => 3,
        'icon-class' => 'icon-contact',
    ], [
        'key'        => 'marketing-dept.contacts.persons',
        'name'       => 'admin::app.layouts.persons',
        'route'      => 'admin.contacts.persons.index',
        'sort'       => 1,
        'icon-class' => '',
    ], [
        'key'        => 'marketing-dept.contacts.organizations',
        'name'       => 'admin::app.layouts.organizations',
        'route'      => 'admin.contacts.organizations.index',
        'sort'       => 2,
        'icon-class' => '',
    ],

    /**
     * Operations Department.
     */
    [
        'key'        => 'operations-dept',
        'name'       => 'admin::app.layouts.operations-dept',
        'route'      => 'admin.projects.index',
        'sort'       => 4,
        'icon-class' => 'icon-note',
    ], [
        'key'        => 'operations-dept.projects',
        'name'       => 'admin::app.layouts.projects',
        'route'      => 'admin.projects.index',
        'sort'       => 1,
        'icon-class' => 'icon-note',
    ], [
        'key'        => 'operations-dept.tasks',
        'name'       => 'admin::app.layouts.tasks',
        'route'      => 'admin.tasks.index',
        'sort'       => 2,
        'icon-class' => 'icon-activity',
    ], [
        'key'        => 'operations-dept.timesheets',
        'name'       => 'admin::app.layouts.timesheets',
        'route'      => 'admin.timesheets.index',
        'sort'       => 3,
        'icon-class' => 'icon-calendar',
    ],

    /**
     * General.
     */
    [
        'key'        => 'general',
        'name'       => 'admin::app.layouts.general',
        'route'      => 'admin.products.index',
        'sort'       => 5,
        'icon-class' => 'icon-settings',
    ], [
        'key'        => 'general.products',
        'name'       => 'admin::app.layouts.products',
        'route'      => 'admin.products.index',
        'sort'       => 1,
        'icon-class' => 'icon-product',
    ], [
        'key'        => 'general.activities',
        'name'       => 'admin::app.layouts.activities',
        'route'      => 'admin.activities.index',
        'sort'       => 2,
        'icon-class' => 'icon-activity',
    ],

    /**
     * Settings.
     */
    [
        'key'        => 'settings',
        'name'       => 'admin::app.layouts.settings',
        'route'      => 'admin.settings.index',
        'sort'       => 7,
        'icon-class' => 'icon-setting',
    ], [
        'key'        => 'settings.user',
        'name'       => 'admin::app.layouts.user',
        'route'      => 'admin.settings.groups.index',
        'info'       => 'admin::app.layouts.user-info',
        'sort'       => 1,
        'icon-class' => 'icon-settings-group',
    ], [
        'key'        => 'settings.user.groups',
        'name'       => 'admin::app.layouts.groups',
        'info'       => 'admin::app.layouts.groups-info',
        'route'      => 'admin.settings.groups.index',
        'sort'       => 1,
        'icon-class' => 'icon-settings-group',
    ], [
        'key'        => 'settings.user.roles',
        'name'       => 'admin::app.layouts.roles',
        'info'       => 'admin::app.layouts.roles-info',
        'route'      => 'admin.settings.roles.index',
        'sort'       => 2,
        'icon-class' => 'icon-role',
    ], [
        'key'        => 'settings.user.users',
        'name'       => 'admin::app.layouts.users',
        'info'       => 'admin::app.layouts.users-info',
        'route'      => 'admin.settings.users.index',
        'sort'       => 3,
        'icon-class' => 'icon-user',
    ], [
        'key'        => 'settings.lead',
        'name'       => 'admin::app.layouts.lead',
        'info'       => 'admin::app.layouts.lead-info',
        'route'      => 'admin.settings.pipelines.index',
        'sort'       => 2,
        'icon-class' => '',
    ], [
        'key'        => 'settings.lead.pipelines',
        'name'       => 'admin::app.layouts.pipelines',
        'info'       => 'admin::app.layouts.pipelines-info',
        'route'      => 'admin.settings.pipelines.index',
        'sort'       => 1,
        'icon-class' => 'icon-settings-pipeline',
    ], [
        'key'        => 'settings.lead.sources',
        'name'       => 'admin::app.layouts.sources',
        'info'       => 'admin::app.layouts.sources-info',
        'route'      => 'admin.settings.sources.index',
        'sort'       => 2,
        'icon-class' => 'icon-settings-sources',
    ], [
        'key'        => 'settings.lead.types',
        'name'       => 'admin::app.layouts.types',
        'info'       => 'admin::app.layouts.types-info',
        'route'      => 'admin.settings.types.index',
        'sort'       => 3,
        'icon-class' => 'icon-settings-type',
    ], [
        'key'        => 'settings.warehouse',
        'name'       => 'admin::app.layouts.warehouse',
        'info'       => 'admin::app.layouts.warehouses-info',
        'route'      => 'admin.settings.pipelines.index',
        'icon-class' => '',
        'sort'       => 2,
    ], [
        'key'        => 'settings.warehouse.warehouses',
        'name'       => 'admin::app.layouts.warehouses',
        'info'       => 'admin::app.layouts.warehouses-info',
        'route'      => 'admin.settings.warehouses.index',
        'sort'       => 1,
        'icon-class' => 'icon-settings-warehouse',
    ], [
        'key'        => 'settings.automation',
        'name'       => 'admin::app.layouts.automation',
        'info'       => 'admin::app.layouts.automation-info',
        'route'      => 'admin.settings.attributes.index',
        'sort'       => 3,
        'icon-class' => '',
    ], [
        'key'        => 'settings.automation.attributes',
        'name'       => 'admin::app.layouts.attributes',
        'info'       => 'admin::app.layouts.attributes-info',
        'route'      => 'admin.settings.attributes.index',
        'sort'       => 1,
        'icon-class' => 'icon-attribute',
    ], [
        'key'        => 'settings.automation.email_templates',
        'name'       => 'admin::app.layouts.email-templates',
        'info'       => 'admin::app.layouts.email-templates-info',
        'route'      => 'admin.settings.email_templates.index',
        'sort'       => 2,
        'icon-class' => 'icon-settings-mail',
    ], [
        'key'        => 'settings.automation.events',
        'name'       => 'admin::app.layouts.events',
        'info'       => 'admin::app.layouts.events-info',
        'route'      => 'admin.settings.marketing.events.index',
        'sort'       => 2,
        'icon-class' => 'icon-calendar',
    ], [
        'key'        => 'settings.automation.campaigns',
        'name'       => 'admin::app.layouts.campaigns',
        'info'       => 'admin::app.layouts.campaigns-info',
        'route'      => 'admin.settings.marketing.campaigns.index',
        'sort'       => 2,
        'icon-class' => 'icon-note',
    ], [
        'key'        => 'settings.automation.webhooks',
        'name'       => 'admin::app.layouts.webhooks',
        'info'       => 'admin::app.layouts.webhooks-info',
        'route'      => 'admin.settings.webhooks.index',
        'sort'       => 2,
        'icon-class' => 'icon-settings-webhooks',
    ], [
        'key'        => 'settings.automation.workflows',
        'name'       => 'admin::app.layouts.workflows',
        'info'       => 'admin::app.layouts.workflows-info',
        'route'      => 'admin.settings.workflows.index',
        'sort'       => 3,
        'icon-class' => 'icon-settings-flow',
    ], [
        'key'        => 'settings.automation.data_transfer',
        'name'       => 'admin::app.layouts.data_transfer',
        'info'       => 'admin::app.layouts.data_transfer_info',
        'route'      => 'admin.settings.data_transfer.imports.index',
        'sort'       => 4,
        'icon-class' => 'icon-download',
    ], [
        'key'        => 'settings.other_settings',
        'name'       => 'admin::app.layouts.other-settings',
        'info'       => 'admin::app.layouts.other-settings-info',
        'route'      => 'admin.settings.tags.index',
        'sort'       => 4,
        'icon-class' => 'icon-settings',
    ], [
        'key'        => 'settings.other_settings.tags',
        'name'       => 'admin::app.layouts.tags',
        'info'       => 'admin::app.layouts.tags-info',
        'route'      => 'admin.settings.tags.index',
        'sort'       => 1,
        'icon-class' => 'icon-settings-tag',
    ], [
        'key'        => 'settings.other_settings.web_forms',
        'name'       => 'web_form::app.menu.title',
        'info'       => 'web_form::app.menu.title-info',
        'route'      => 'admin.settings.web_forms.index',
        'sort'       => 2,
        'icon-class' => 'icon-settings-webforms',
    ], [
        'key'        => 'settings.other_settings.audit_logs',
        'name'       => 'admin::app.settings.audit-logs.index.title',
        'info'       => 'admin::app.settings.audit-logs.index.info',
        'route'      => 'admin.settings.audit_logs.index',
        'sort'       => 3,
        'icon-class' => 'icon-activity',
    ],

    /**
     * Configuration.
     */
    [
        'key'        => 'configuration',
        'name'       => 'admin::app.layouts.configuration',
        'route'      => 'admin.configuration.index',
        'sort'       => 8,
        'icon-class' => 'icon-configuration',
    ],

    /**
     * Emails.
     */
    [
        'key'        => 'mail',
        'name'       => 'admin::app.layouts.mail.title',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'inbox'],
        'sort'       => 6,
        'icon-class' => 'icon-mail',
    ], [
        'key'        => 'mail.inbox',
        'name'       => 'admin::app.layouts.mail.inbox',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'inbox'],
        'sort'       => 2,
        'icon-class' => '',
    ], [
        'key'        => 'mail.draft',
        'name'       => 'admin::app.layouts.mail.draft',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'draft'],
        'sort'       => 3,
        'icon-class' => '',
    ], [
        'key'        => 'mail.outbox',
        'name'       => 'admin::app.layouts.mail.outbox',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'outbox'],
        'sort'       => 4,
        'icon-class' => '',
    ], [
        'key'        => 'mail.sent',
        'name'       => 'admin::app.layouts.mail.sent',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'sent'],
        'sort'       => 4,
        'icon-class' => '',
    ], [
        'key'        => 'mail.trash',
        'name'       => 'admin::app.layouts.mail.trash',
        'route'      => 'admin.mail.index',
        'params'     => ['route' => 'trash'],
        'sort'       => 5,
        'icon-class' => '',
    ],
];
