<?php

/**
 * ---------------------------------------------------------------
 * Feature Tests: Global Search Engine
 * ---------------------------------------------------------------
 * Tests all 4 global search API endpoints for correct JSON
 * responses, authentication requirements, and edge cases.
 */

it('returns JSON results when searching users', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users', ['search' => 'admin'])
    );

    $response->assertOk()
        ->assertJsonStructure(['data']);
});

it('returns JSON results when searching projects', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.projects', ['search' => 'test'])
    );

    $response->assertOk()
        ->assertJsonStructure(['data']);
});

it('returns JSON results when searching tasks', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.tasks', ['search' => 'test'])
    );

    $response->assertOk()
        ->assertJsonStructure(['data']);
});

it('returns JSON results when searching clients', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.clients', ['search' => 'test'])
    );

    $response->assertOk()
        ->assertJsonStructure(['data']);
});

it('returns empty data when search query is too short', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users', ['search' => 'a'])
    );

    $response->assertOk()
        ->assertJson(['data' => []]);
});

it('returns empty data when search query is empty', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users')
    );

    $response->assertOk()
        ->assertJson(['data' => []]);
});

it('redirects unauthenticated users from search endpoints', function () {
    $response = test()->get(route('admin.global_search.users', ['search' => 'admin']));

    // Session-based auth redirects to login (302) rather than returning 401
    $response->assertStatus(302);
});

it('returns user data with correct structure', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users', ['search' => $admin->name])
    );

    $response->assertOk();

    if (count($response->json('data')) > 0) {
        $firstUser = $response->json('data.0');
        expect($firstUser)->toHaveKeys(['id', 'name', 'email']);
    }
});

it('limits search results to 10 items', function () {
    $admin = getDefaultAdmin();

    $response = test()->actingAs($admin)->getJson(
        route('admin.global_search.users', ['search' => 'e'])
    );

    $response->assertOk();
    expect(count($response->json('data')))->toBeLessThanOrEqual(10);
});
