<?php

use App\Models\User;
use Livewire\Volt\Volt as LivewireVolt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('non-admin users are rejected on login screen', function () {
    $user = User::factory()->create(['role' => 'user']);

    $response = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response->assertHasErrors(['email']);
    $this->assertGuest();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('remember me saves encrypted device credentials cookie and pre-fills login form', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $loginResponse = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->set('remember', true)
        ->call('login');

    $loginResponse
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.dashboard', absolute: false));

    $this->post('/logout');

    $encryptedPayload = \Illuminate\Support\Facades\Crypt::encryptString(json_encode([
        'email' => $user->email,
        'password' => 'password',
    ]));

    $revisit = $this->withCookie('gat_saved_credentials', $encryptedPayload)
        ->get('/login');

    $revisit->assertStatus(200);
    $revisit->assertSee($user->email);

    $uncheckResponse = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->set('remember', false)
        ->call('login');

    $uncheckResponse->assertHasNoErrors();
});

test('standard POST login applies rate limiting after repeated failed attempts', function () {
    $user = User::factory()->create(['role' => 'admin']);

    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-pass-' . $i,
        ]);
    }

    $blocked = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $blocked->assertSessionHasErrors('email');
    $this->assertGuest();
});
