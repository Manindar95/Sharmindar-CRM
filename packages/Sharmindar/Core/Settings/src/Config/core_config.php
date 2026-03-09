<?php

return [
    /**
     * Top-Level Company Settings Tab.
     */
    [
        'key' => 'company_settings',
        'name' => 'Company Settings',
        'info' => 'Centralize your organization configuration setup here.',
        'sort' => 2,
    ],

    /**
     * 1. General Settings
     */
    [
        'key' => 'company_settings.general',
        'name' => 'General',
        'info' => 'Configure your fundamental business details.',
        'icon' => 'icon-setting',
        'sort' => 1,
    ],
    [
        'key' => 'company_settings.general.general_info',
        'name' => 'General Information',
        'info' => 'Update your business name, address, and primary identity.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'company_name',
                'title' => 'Company Name',
                'type' => 'text',
                'default' => 'My Company',
            ],
            [
                'name' => 'company_logo',
                'title' => 'Company Logo',
                'type' => 'image',
                'validation' => 'mimes:bmp,jpeg,jpg,png,webp,svg',
            ],
            [
                'name' => 'address',
                'title' => 'Address',
                'type' => 'textarea',
                'default' => '',
            ],
            [
                'name' => 'timezone',
                'title' => 'Timezone',
                'type' => 'select',
                'default' => 'UTC',
                'options' => 'Sharmindar\Core\Settings\Helpers\Core@timezones',
            ],
            [
                'name' => 'currency',
                'title' => 'Currency',
                'type' => 'select',
                'default' => 'USD',
                'options' => 'Sharmindar\Core\Settings\Helpers\Core@currencies',
            ],
            [
                'name' => 'language',
                'title' => 'Language',
                'type' => 'select',
                'default' => 'en',
                'options' => 'Sharmindar\Core\Settings\Helpers\Core@locales',
            ]
        ],
    ],

    /**
     * 2. Email Configuration
     */
    [
        'key' => 'company_settings.email',
        'name' => 'Email',
        'info' => 'Set up global SMTP services and template defaults.',
        'icon' => 'icon-mail',
        'sort' => 2,
    ],
    [
        'key' => 'company_settings.email.smtp',
        'name' => 'SMTP Configuration',
        'info' => 'Configure outbound mail servers for the CRM.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'host',
                'title' => 'Host',
                'type' => 'text',
                'default' => '',
            ],
            [
                'name' => 'port',
                'title' => 'Port',
                'type' => 'text',
                'default' => '587',
            ],
            [
                'name' => 'username',
                'title' => 'Username',
                'type' => 'text',
                'default' => '',
            ],
            [
                'name' => 'password',
                'title' => 'Password',
                'type' => 'password',
                'default' => '',
            ],
            [
                'name' => 'encryption',
                'title' => 'Encryption',
                'type' => 'select',
                'default' => 'tls',
                'options' => [
                    ['title' => 'TLS', 'value' => 'tls'],
                    ['title' => 'SSL', 'value' => 'ssl'],
                    ['title' => 'None', 'value' => '']
                ],
            ]
        ],
    ],
    [
        'key' => 'company_settings.email.templates',
        'name' => 'Email Templates',
        'info' => 'Define global email footers and signatures.',
        'sort' => 2,
        'fields' => [
            [
                'name' => 'default_signature',
                'title' => 'Default Signature',
                'type' => 'editor',
                'tinymce' => true,
                'default' => '',
            ]
        ],
    ],

    /**
     * 3. Notifications
     */
    [
        'key' => 'company_settings.notifications',
        'name' => 'Notifications',
        'info' => 'Manage system-wide alerts and reminders.',
        'icon' => 'icon-bell',
        'sort' => 3,
    ],
    [
        'key' => 'company_settings.notifications.preferences',
        'name' => 'Global Notification Preferences',
        'info' => 'Enable or disable major notification channels.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'email_alerts',
                'title' => 'Email Alerts Enabled',
                'type' => 'boolean',
                'default' => 1,
            ],
            [
                'name' => 'system_alerts',
                'title' => 'System Alerts Enabled',
                'type' => 'boolean',
                'default' => 1,
            ],
            [
                'name' => 'reminder_rules',
                'title' => 'Default Reminder Rules (Days before due)',
                'type' => 'select',
                'default' => '1',
                'options' => [
                    ['title' => '1 Day', 'value' => '1'],
                    ['title' => '3 Days', 'value' => '3'],
                    ['title' => '1 Week', 'value' => '7'],
                ],
            ]
        ],
    ],

    /**
     * 4. Finance Defaults
     */
    [
        'key' => 'company_settings.finance',
        'name' => 'Finance Defaults',
        'info' => 'Configure base tax logic and currency presentation.',
        'icon' => 'icon-rupee',
        'sort' => 4,
    ],
    [
        'key' => 'company_settings.finance.defaults',
        'name' => 'Global Finance Config',
        'info' => 'Set the default accounting and quoting parameters.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'default_tax',
                'title' => 'Default Tax (%)',
                'type' => 'text',
                'default' => '0',
            ],
            [
                'name' => 'currency_format',
                'title' => 'Currency Format',
                'type' => 'text',
                'default' => '$1,234.56',
            ]
        ],
    ],

    /**
     * 5. Project Defaults
     */
    [
        'key' => 'company_settings.project',
        'name' => 'Project Defaults',
        'info' => 'Configure task statuses and priorities globally.',
        'icon' => 'icon-project',
        'sort' => 5,
    ],
    [
        'key' => 'company_settings.project.defaults',
        'name' => 'Global Project Config',
        'info' => 'Define the standard progression paths for tasks.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'default_task_statuses',
                'title' => 'Default Task Statuses (Comma separated)',
                'type' => 'textarea',
                'default' => 'To Do, In Progress, Review, Completed',
            ],
            [
                'name' => 'priority_levels',
                'title' => 'Default Priority Levels (Comma separated)',
                'type' => 'textarea',
                'default' => 'Low, Medium, High, Critical',
            ]
        ],
    ],

    /**
     * 6. Notification Engines
     */
    [
        'key' => 'company_settings.notification_engines',
        'name' => 'Notification Engines',
        'info' => 'Set up API keys and connections for push, SMS, and WhatsApp.',
        'icon' => 'icon-activity',
        'sort' => 6,
    ],
    [
        'key' => 'company_settings.notification_engines.whatsapp',
        'name' => 'WhatsApp API (Twilio / Meta)',
        'info' => 'Configure your WhatsApp Business API connection.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'whatsapp_provider',
                'title' => 'WhatsApp Provider',
                'type' => 'select',
                'default' => 'twilio',
                'options' => [
                    ['title' => 'Twilio', 'value' => 'twilio'],
                    ['title' => 'Meta Official API', 'value' => 'meta'],
                ],
            ],
            [
                'name' => 'whatsapp_sid',
                'title' => 'Account SID / App ID',
                'type' => 'text',
                'default' => '',
            ],
            [
                'name' => 'whatsapp_token',
                'title' => 'Auth Token',
                'type' => 'password',
                'default' => '',
            ],
            [
                'name' => 'whatsapp_from',
                'title' => 'Sender Phone Number',
                'type' => 'text',
                'default' => '',
            ]
        ],
    ],
    [
        'key' => 'company_settings.notification_engines.push',
        'name' => 'Push Notifications (FCM / Pusher)',
        'info' => 'Configure Web and Mobile Push architecture.',
        'sort' => 2,
        'fields' => [
            [
                'name' => 'push_provider',
                'title' => 'Push Provider',
                'type' => 'select',
                'default' => 'fcm',
                'options' => [
                    ['title' => 'Firebase (FCM)', 'value' => 'fcm'],
                    ['title' => 'Pusher', 'value' => 'pusher'],
                    ['title' => 'OneSignal', 'value' => 'onesignal'],
                ],
            ],
            [
                'name' => 'push_api_key',
                'title' => 'Project API Key / Server Key',
                'type' => 'password',
                'default' => '',
            ],
            [
                'name' => 'push_app_id',
                'title' => 'App ID',
                'type' => 'text',
                'default' => '',
            ]
        ],
    ],

    /**
     * 7. Security Management
     */
    [
        'key' => 'company_settings.security',
        'name' => 'Security',
        'info' => 'Manage system-wide security, rate limits, and allowed networks.',
        'icon' => 'icon-user',
        'sort' => 7,
    ],
    [
        'key' => 'company_settings.security.network',
        'name' => 'Network Restrictions',
        'info' => 'Lock down the CRM to specific office or VPN IP addresses.',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'allowed_ips',
                'title' => 'Allowed IPv4/IPv6 Addresses (Comma separated)',
                'type' => 'textarea',
                'default' => '',
                'info' => 'Leave completely blank to allow all IPs. Enter IPs separated by commas (e.g. 192.168.1.1, 10.0.0.5)'
            ]
        ],
    ],
    [
        'key' => 'company_settings.security.limits',
        'name' => 'Access Limits',
        'info' => 'Throttle login attempts to prevent brute-force attacks.',
        'sort' => 2,
        'fields' => [
            [
                'name' => 'max_login_attempts',
                'title' => 'Max Login Attempts (Per Minute)',
                'type' => 'text',
                'default' => '5',
            ]
        ],
    ]
];
