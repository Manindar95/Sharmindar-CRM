<?php

return [
    [
        'key'   => 'dashboard',
        'name'  => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept',
        'name'  => 'admin::app.layouts.marketing-dept',
        'route' => 'admin.leads.index',
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.leads',
        'name'  => 'admin::app.acl.leads',
        'route' => 'admin.leads.index',
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept.leads.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.leads.create', 'admin.leads.store'],
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept.leads.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.leads.view',
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.leads.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.leads.edit', 'admin.leads.update', 'admin.leads.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'marketing-dept.leads.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.leads.delete', 'admin.leads.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'accounts-dept',
        'name'  => 'admin::app.layouts.accounts-dept',
        'route' => 'admin.quotes.index',
        'sort'  => 3,
    ], [
        'key'   => 'accounts-dept.quotes',
        'name'  => 'admin::app.acl.quotes',
        'route' => 'admin.quotes.index',
        'sort'  => 1,
    ], [
        'key'   => 'accounts-dept.quotes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.quotes.create', 'admin.quotes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'accounts-dept.quotes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.quotes.edit', 'admin.quotes.update'],
        'sort'  => 2,
    ], [
        'key'   => 'accounts-dept.quotes.print',
        'name'  => 'admin::app.acl.print',
        'route' => 'admin.quotes.print',
        'sort'  => 3,
    ], [
        'key'   => 'accounts-dept.quotes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.quotes.delete', 'admin.quotes.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'mail',
        'name'  => 'admin::app.acl.mail',
        'route' => 'admin.mail.index',
        'sort'  => 4,
    ], [
        'key'   => 'mail.inbox',
        'name'  => 'admin::app.acl.inbox',
        'route' => 'admin.mail.index',
        'sort'  => 1,
    ], [
        'key'   => 'mail.draft',
        'name'  => 'admin::app.acl.draft',
        'route' => 'admin.mail.index',
        'sort'  => 2,
    ], [
        'key'   => 'mail.outbox',
        'name'  => 'admin::app.acl.outbox',
        'route' => 'admin.mail.index',
        'sort'  => 3,
    ], [
        'key'   => 'mail.sent',
        'name'  => 'admin::app.acl.sent',
        'route' => 'admin.mail.index',
        'sort'  => 4,
    ], [
        'key'   => 'mail.trash',
        'name'  => 'admin::app.acl.trash',
        'route' => 'admin.mail.index',
        'sort'  => 5,
    ], [
        'key'   => 'mail.compose',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.mail.store'],
        'sort'  => 6,
    ], [
        'key'   => 'mail.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.mail.view',
        'sort'  => 7,
    ], [
        'key'   => 'mail.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => 'admin.mail.update',
        'sort'  => 8,
    ], [
        'key'   => 'mail.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.mail.delete', 'admin.mail.mass_delete'],
        'sort'  => 9,
    ], [
        'key'   => 'general',
        'name'  => 'admin::app.layouts.general',
        'route' => 'admin.activities.index',
        'sort'  => 5,
    ], [
        'key'   => 'general.activities',
        'name'  => 'admin::app.acl.activities',
        'route' => 'admin.activities.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.activities.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.activities.create', 'admin.activities.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.activities.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.activities.edit', 'admin.activities.update', 'admin.activities.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.activities.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.activities.delete', 'admin.activities.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'marketing-dept.contacts',
        'name'  => 'admin::app.acl.contacts',
        'route' => 'admin.contacts.users.index',
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.contacts.persons',
        'name'  => 'admin::app.acl.persons',
        'route' => 'admin.contacts.persons.index',
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept.contacts.persons.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.persons.create', 'admin.contacts.persons.store'],
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.contacts.persons.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.persons.edit', 'admin.contacts.persons.update'],
        'sort'  => 3,
    ], [
        'key'   => 'marketing-dept.contacts.persons.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.persons.delete', 'admin.contacts.persons.mass_delete'],
        'sort'  => 4,
    ],  [
        'key'   => 'marketing-dept.contacts.persons.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.contacts.persons.view',
        'sort'  => 5,
    ], [
        'key'   => 'marketing-dept.contacts.organizations',
        'name'  => 'admin::app.acl.organizations',
        'route' => 'admin.contacts.organizations.index',
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.contacts.organizations.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.organizations.create', 'admin.contacts.organizations.store'],
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept.contacts.organizations.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.organizations.edit', 'admin.contacts.organizations.update'],
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.contacts.organizations.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.organizations.delete', 'admin.contacts.organizations.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'general.products',
        'name'  => 'admin::app.acl.products',
        'route' => 'admin.products.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.products.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.products.create', 'admin.products.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.products.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.products.edit', 'admin.products.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.products.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.products.delete', 'admin.products.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'general.products.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.products.view',
        'sort'  => 3,
    ], [
        'key'   => 'settings.settings',
        'name'  => 'admin::app.acl.settings',
        'route' => 'admin.settings.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user',
        'name'  => 'admin::app.acl.user',
        'route' => ['admin.settings.groups.index', 'admin.settings.roles.index', 'admin.settings.users.index'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.user.groups',
        'name'  => 'admin::app.acl.groups',
        'route' => 'admin.settings.groups.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.user.groups.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.groups.create', 'admin.settings.groups.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.user.groups.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.groups.edit', 'admin.settings.groups.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.user.groups.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.groups.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.user.roles',
        'name'  => 'admin::app.acl.roles',
        'route' => 'admin.settings.roles.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.user.roles.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.roles.create', 'admin.settings.roles.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.user.roles.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.roles.edit', 'admin.settings.roles.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.user.roles.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.roles.delete',
        'sort'  => 3,
    ],  [
        'key'   => 'general.settings.user.users',
        'name'  => 'admin::app.acl.users',
        'route' => 'admin.settings.users.index',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.user.users.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.users.create', 'admin.settings.users.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.user.users.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.users.edit', 'admin.settings.users.update', 'admin.settings.users.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.user.users.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.users.delete', 'admin.settings.users.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead',
        'name'  => 'admin::app.acl.lead',
        'route' => ['admin.settings.pipelines.index', 'admin.settings.sources.index', 'admin.settings.types.index'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.lead.pipelines',
        'name'  => 'admin::app.acl.pipelines',
        'route' => 'admin.settings.pipelines.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.lead.pipelines.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.pipelines.create', 'admin.settings.pipelines.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.lead.pipelines.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.pipelines.edit', 'admin.settings.pipelines.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.lead.pipelines.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.pipelines.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.lead.sources',
        'name'  => 'admin::app.acl.sources',
        'route' => 'admin.settings.sources.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.lead.sources.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.sources.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.lead.sources.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.sources.edit', 'admin.settings.sources.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.lead.sources.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.sources.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.lead.types',
        'name'  => 'admin::app.acl.types',
        'route' => 'admin.settings.types.index',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.lead.types.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.types.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.lead.types.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.types.edit', 'admin.settings.types.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.lead.types.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.types.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation',
        'name'  => 'admin::app.acl.automation',
        'route' => ['admin.settings.attributes.index', 'admin.settings.email_templates.index', 'admin.settings.workflows.index'],
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.attributes',
        'name'  => 'admin::app.acl.attributes',
        'route' => 'admin.settings.attributes.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.attributes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.attributes.create', 'admin.settings.attributes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.attributes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.attributes.edit', 'admin.settings.attributes.update', 'admin.settings.attributes.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.attributes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.attributes.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.email_templates',
        'name'  => 'admin::app.acl.email-templates',
        'route' => 'admin.settings.email_templates.index',
        'sort'  => 7,
    ], [
        'key'   => 'general.settings.automation.email_templates.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.email_templates.create', 'admin.settings.email_templates.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.email_templates.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.email_templates.edit', 'admin.settings.email_templates.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.email_templates.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.email_templates.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.workflows',
        'name'  => 'admin::app.acl.workflows',
        'route' => 'admin.settings.workflows.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.workflows.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.workflows.create', 'admin.settings.workflows.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.workflows.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.workflows.edit', 'admin.settings.workflows.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.workflows.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.workflows.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.events',
        'name'  => 'admin::app.acl.event',
        'route' => 'admin.settings.marketing.events.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.events.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.marketing.events.create', 'admin.settings.marketing.events.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.events.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.marketing.events.edit', 'admin.settings.marketing.events.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.events.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.marketing.events.delete', 'admin.settings.marketing.events.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.campaigns',
        'name'  => 'admin::app.acl.campaigns',
        'route' => 'admin.settings.marketing.campaigns.index',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.campaigns.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.marketing.campaigns.create', 'admin.settings.marketing.campaigns.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.campaigns.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.marketing.campaigns.edit', 'admin.settings.marketing.campaigns.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.campaigns.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.marketing.campaigns.delete', 'admin.settings.marketing.campaigns.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.automation.webhooks',
        'name'  => 'admin::app.acl.webhook',
        'route' => 'admin.settings.webhooks.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.webhooks.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.webhooks.create', 'admin.settings.webhooks.store'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.automation.webhooks.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.webhooks.edit', 'admin.settings.webhooks.update'],
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.automation.webhooks.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.webhooks.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.other_settings',
        'name'  => 'admin::app.acl.other-settings',
        'route' => 'admin.settings.tags.index',
        'sort'  => 4,
    ], [
        'key'   => 'general.settings.other_settings.tags',
        'name'  => 'admin::app.acl.tags',
        'route' => 'admin.settings.tags.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.other_settings.tags.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.tags.create', 'admin.settings.tags.store', 'admin.leads.tags.attach'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.other_settings.tags.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.tags.edit', 'admin.settings.tags.update'],
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.other_settings.tags.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.tags.delete', 'admin.settings.tags.mass_delete', 'admin.leads.tags.detach'],
        'sort'  => 2,
    ],
    [
        'key'   => 'settings.data_transfer',
        'name'  => 'admin::app.acl.data-transfer',
        'route' => 'admin.settings.data_transfer.imports.index',
        'sort'  => 10,
    ], [
        'key'   => 'general.settings.data_transfer.imports',
        'name'  => 'admin::app.acl.imports',
        'route' => 'admin.settings.data_transfer.imports.index',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.data_transfer.imports.create',
        'name'  => 'admin::app.acl.create',
        'route' => 'admin.settings.data_transfer.imports.create',
        'sort'  => 1,
    ], [
        'key'   => 'general.settings.data_transfer.imports.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => 'admin.settings.data_transfer.imports.edit',
        'sort'  => 2,
    ], [
        'key'   => 'general.settings.data_transfer.imports.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.data_transfer.imports.delete',
        'sort'  => 3,
    ], [
        'key'   => 'general.settings.data_transfer.imports.import',
        'name'  => 'admin::app.acl.import',
        'route' => 'admin.settings.data_transfer.imports.imports',
        'sort'  => 4,
    ], [
        'key'   => 'accounts-dept.payments',
        'name'  => 'admin::app.acl.payments',
        'route' => 'admin.payments.index',
        'sort'  => 2,
    ], [
        'key'   => 'accounts-dept.payments.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.payments.create', 'admin.payments.store'],
        'sort'  => 1,
    ], [
        'key'   => 'accounts-dept.payments.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.payments.edit', 'admin.payments.update'],
        'sort'  => 2,
    ], [
        'key'   => 'accounts-dept.payments.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.payments.delete', 'admin.payments.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'marketing-dept.proposals',
        'name'  => 'admin::app.acl.proposals',
        'route' => 'admin.proposals.index',
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.proposals.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.proposals.create', 'admin.proposals.store'],
        'sort'  => 1,
    ], [
        'key'   => 'marketing-dept.proposals.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.proposals.edit', 'admin.proposals.update'],
        'sort'  => 2,
    ], [
        'key'   => 'marketing-dept.proposals.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.proposals.delete', 'admin.proposals.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'operations-dept',
        'name'  => 'admin::app.acl.projects',
        'route' => 'admin.projects.index',
        'sort'  => 4,
    ], [
        'key'   => 'operations-dept.projects',
        'name'  => 'admin::app.acl.projects',
        'route' => 'admin.projects.index',
        'sort'  => 1,
    ], [
        'key'   => 'operations-dept.tasks',
        'name'  => 'admin::app.acl.tasks',
        'route' => 'admin.tasks.index',
        'sort'  => 2,
    ], [
        'key'   => 'operations-dept.timesheets',
        'name'  => 'admin::app.acl.timesheets',
        'route' => 'admin.timesheets.index',
        'sort'  => 3,
    ], [
        'key'   => 'configuration',
        'name'  => 'admin::app.acl.configuration',
        'route' => 'admin.configuration.index',
        'sort'  => 4,
    ],
];
