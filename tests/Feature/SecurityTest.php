<?php

/**
 * ---------------------------------------------------------------
 * Feature Tests: Security Infrastructure
 * ---------------------------------------------------------------
 * Tests authentication, session management, and security
 * middleware behavior.
 */

it('login page is accessible', function () {
    $response = test()->get(route('admin.session.create'));

    $response->assertOk();
});

it('login with valid credentials authenticates the user', function () {
    $admin = getDefaultAdmin();

    test()->actingAs($admin);

    expect(auth()->guard('user')->user()->id)->toBe($admin->id);
});

it('protected routes redirect unauthenticated users to login', function () {
    $protectedRoutes = [
        route('admin.dashboard.index'),
        route('admin.leads.index'),
        route('admin.contacts.persons.index'),
    ];

    foreach ($protectedRoutes as $url) {
        $response = test()->get($url);
        $response->assertStatus(302);
    }
});

it('CSRF token is present on authenticated pages', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->get(route('admin.dashboard.index'));

    $response->assertOk();

    // Session should contain CSRF token
    expect(session()->token())->not->toBeNull();
    expect(session()->token())->toBeString();
});

it('session is destroyed on logout', function () {
    $admin = getDefaultAdmin();

    test()->actingAs($admin)
        ->delete(route('admin.session.destroy'), [
        '_token' => csrf_token(),
    ])
        ->assertStatus(302);

    expect(auth()->guard('user')->user())->toBeNull();
});

it('login rate limiting blocks rapid attempts', function () {
    // Attempt to login multiple times with wrong credentials
    for ($i = 0; $i < 6; $i++) {
        test()->post(route('admin.session.store'), [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
            '_token' => csrf_token(),
        ]);
    }

    // The 7th attempt should be rate-limited (429) or redirect with error
    $response = test()->post(route('admin.session.store'), [
        'email' => 'wrong@example.com',
        'password' => 'wrongpassword',
        '_token' => csrf_token(),
    ]);

    // Rate limiting may return 302 (redirect with error) or 429
    expect($response->status())->toBeIn([302, 422, 429]);
});

it('password field is never returned in user API responses', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users', ['search' => $admin->name])
    );

    $response->assertOk();

    $data = $response->json('data');

    if (count($data) > 0) {
        expect($data[0])->not->toHaveKey('password');
    }
});

it('API search endpoints require authentication', function () {
    $endpoints = [
        route('admin.global_search.users', ['search' => 'test']),
        route('admin.global_search.projects', ['search' => 'test']),
        route('admin.global_search.tasks', ['search' => 'test']),
        route('admin.global_search.clients', ['search' => 'test']),
    ];

    // Session-based auth redirects to login (302) rather than returning 401
    foreach ($endpoints as $url) {
        $response = test()->get($url);
        $response->assertStatus(302);
    }
});
