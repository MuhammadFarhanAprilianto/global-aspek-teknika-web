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

test('admin dashboard and live-traffic endpoint reflect real DB telemetry accurately', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    // 0 orders -> po_submitted_pct must be 0 (not fake 73.4%)
    $this->getJson(route('admin.api.live-traffic'))
        ->assertOk()
        ->assertJsonPath('total_orders', 0)
        ->assertJsonPath('order_stats.po_submitted_pct', 0);

    // Public visit with browser headers logs VisitorLog
    $this->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/130.0.0.0 Safari/537.36',
        'Sec-Fetch-Dest' => 'document',
    ])->get('/')->assertOk();

    // Real Order, SimulationLead & ContactMessage
    \App\Models\Order::create([
        'uuid' => (string) \Illuminate\Support\Str::uuid(),
        'invoice_number' => 'QU/9001/26',
        'verification_hash' => hash('sha256', 'live-check'),
        'pic_name' => 'Farhan',
        'company_name' => 'PT Uji Real-Time',
        'company_email' => 'farhan@example.com',
        'company_phone' => '081234567890',
        'subtotal' => 10000000,
        'tax_rate' => 11,
        'tax_amount' => 1100000,
        'pph23_rate' => 2,
        'pph23_amount' => 200000,
        'grand_total' => 10900000,
        'status' => 'po_submitted',
    ]);

    \App\Models\SimulationLead::create([
        'domain' => 'bms',
        'pic_name' => 'Budi',
        'company_name' => 'PT Energy Uji',
        'email' => 'budi@example.com',
        'phone' => '081299988877',
        'status' => 'new',
    ]);

    \App\Models\ContactMessage::create([
        'name' => 'Siti',
        'email' => 'siti@example.com',
        'message' => 'Tanya produk',
        'status' => 'unread',
    ]);

    $this->getJson(route('admin.api.live-traffic'))
        ->assertOk()
        ->assertJsonPath('today', 1)
        ->assertJsonPath('total', 1)
        ->assertJsonPath('online_now', 1)
        ->assertJsonPath('total_orders', 1)
        ->assertJsonPath('order_stats.po_submitted_count', 1)
        ->assertJsonPath('order_stats.po_submitted_pct', 100)
        ->assertJsonPath('total_leads', 1)
        ->assertJsonPath('new_leads', 1)
        ->assertJsonPath('total_inquiries', 1)
        ->assertJsonPath('unread_inquiries', 1);

    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('PT Uji Real-Time')
        ->assertSee('10.900.000');
});
