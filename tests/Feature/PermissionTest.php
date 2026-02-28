<?php

/**
 * ---------------------------------------------------------------
 * Permission Tests
 * ---------------------------------------------------------------
 * Tests role-based access control across the CRM, verifying
 * that admin users can access protected resources and
 * unauthenticated/unauthorized users are properly blocked.
 */

it('admin user can access the dashboard', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.dashboard.index'));

    $response->assertOk();
});

it('admin user can access leads index', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.leads.index'));

    $response->assertOk();
});

it('admin user can access contacts persons index', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.contacts.persons.index'));

    $response->assertOk();
});

it('admin user can access projects index', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.projects.index'));

    $response->assertOk();
});

it('admin user can access tasks index', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.tasks.index'));

    $response->assertOk();
});

it('admin user can access settings page', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.settings.index'));

    $response->assertOk();
});

it('admin user can use all global search endpoints', function () {
    $admin = getDefaultAdmin();

    $searchEndpoints = [
        'admin.global_search.users',
        'admin.global_search.projects',
        'admin.global_search.tasks',
        'admin.global_search.clients',
    ];

    foreach ($searchEndpoints as $routeName) {
        $response = test()->actingAs($admin)->getJson(
            route($routeName, ['search' => 'test'])
        );

        $response->assertOk();
    }
});

it('unauthenticated user cannot access dashboard', function () {
    $response = test()->get(route('admin.dashboard.index'));

    $response->assertStatus(302);
});

it('unauthenticated user cannot access leads', function () {
    $response = test()->get(route('admin.leads.index'));

    $response->assertStatus(302);
});

it('unauthenticated user cannot access settings', function () {
    $response = test()->get(route('admin.settings.index'));

    $response->assertStatus(302);
});

it('unauthenticated user cannot access projects', function () {
    $response = test()->get(route('admin.projects.index'));

    $response->assertStatus(302);
});

it('unauthenticated user cannot access tasks', function () {
    $response = test()->get(route('admin.tasks.index'));

    $response->assertStatus(302);
});

it('widget canAccess respects empty permissions as accessible', function () {
    $widget = new class extends \Company\Core\Dashboard\Widgets\BaseWidget {
        public function getId(): string {
                    return 'open.widget';
                }
                public function getName(): string {
                    return 'Open Widget';
                }
                public function getType(): string {
                    return 'card';
                }
                public function render() {
                    return '<div>Open</div>';
                }
            };

            expect($widget->canAccess())->toBeTrue();        });

it('admin user can access their own profile', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.user.account.edit'));

    $response->assertOk();
});
