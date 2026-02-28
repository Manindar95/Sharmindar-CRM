<?php

return [
    [
        'key' => 'settings.audit_logs',
        'name' => 'Audit Logs',
        'info' => 'View system activity and audit trails',
        'route' => 'company.core.activity.login_history.index',
        'sort' => 5,
        'icon-class' => 'icon-activity',
    ],
    [
        'key' => 'settings.audit_logs.login_history',
        'name' => 'Login History',
        'info' => 'View user login and logout history',
        'route' => 'company.core.activity.login_history.index',
        'sort' => 1,
        'icon-class' => 'icon-user',
    ],
    [
        'key' => 'settings.audit_logs.activity_logs',
        'name' => 'Activity Logs',
        'info' => 'View general system activity',
        'route' => 'company.core.activity.activity_logs.index',
        'sort' => 2,
        'icon-class' => 'icon-activity',
    ],
    [
        'key' => 'settings.audit_logs.audit_trails',
        'name' => 'Audit Trails',
        'info' => 'View data creation, update, and deletion history',
        'route' => 'company.core.activity.audit_trails.index',
        'sort' => 3,
        'icon-class' => 'icon-note',
    ],
];
