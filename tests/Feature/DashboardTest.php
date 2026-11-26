<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated admin users are redirected from /dashboard to admin dashboard', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertRedirect(route('admin.dashboard', absolute: false));
});
