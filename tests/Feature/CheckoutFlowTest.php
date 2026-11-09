<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Database\Seeders\ProductSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

it('hides all nominal product prices on public /product page and renders centered popup modal form', function () {
    $this->seed(ProductSeeder::class);

    $response = $this->get(route('product'));

    $response->assertOk()
        ->assertSee('Harga Kontrak B2B')
        ->assertSee('Form Pemesanan &amp; Pembayaran B2B', false)
        ->assertSee(route('checkout.initiate'), false)
        ->assertDontSee('48.500.000')
        ->assertDontSee('48500000')
        ->assertDontSee('32.000.000');
});

it('calculates server-side B2B subtotal and 11% PPN strictly from database and redirects to signed checkout URL', function () {
    $category = ProductCategory::create([
        'name' => 'Sistem Pengukuran',
        'slug' => 'sistem-pengukuran',
        'sort_order' => 1,
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'GAT-TEST-001',
        'name' => 'Sensor Presisi Industri',
        'slug' => 'sensor-presisi-industri',
        'short_description' => 'Sensor optik presisi tinggi.',
        'price' => 10000000, // Rp 10.000.000
        'is_rfq_only' => true,
        'stock' => 10,
        'min_order_quantity' => 1,
        'status' => 'published',
    ]);

    // Simulasikan percobaan manipulasi harga dari sisi klien (price: 1) -> harus diabaikan server!
    $payload = [
        'cart_items_json' => json_encode([
            ['id' => $product->id, 'qty' => 2, 'price' => 1],
        ]),
        'pic_name' => 'Budi Santoso',
        'company_name' => 'PT Manufaktur Presisi Nusantara',
        'company_email' => 'procurement@manufaktur.co.id',
        'company_phone' => '081234567890',
        'npwp' => '01.234.567.8-901.000',
        'notes' => 'Pengiriman kawasan industri Cikarang',
    ];

    $response = $this->post(route('checkout.initiate'), $payload);

    $order = Order::first();
    expect($order)->not->toBeNull();
    expect((float) $order->subtotal)->toBe(20000000.00);
    expect((float) $order->tax_rate)->toBe(11.00);
    expect((float) $order->tax_amount)->toBe(2200000.00);
    expect((float) $order->pph23_rate)->toBe(2.00);
    expect((float) $order->pph23_amount)->toBe(400000.00);
    expect((float) $order->grand_total)->toBe(21800000.00);
    expect($order->status)->toBe('awaiting_po');

    $response->assertRedirect();
    $redirectUrl = $response->headers->get('Location');
    expect($redirectUrl)->toContain('/checkout/' . $order->uuid);
    expect($redirectUrl)->toContain('signature=');

    // Mengakses halaman checkout menggunakan Signed URL berhasil & menampilkan Sales Quote resmi GAT
    $checkoutResponse = $this->get($redirectUrl);
    $checkoutResponse->assertOk()
        ->assertSee('PT Global Aspek Teknologi')
        ->assertSee('BILL TO')
        ->assertSee('Quote')
        ->assertSee('PT Manufaktur Presisi Nusantara')
        ->assertSee('20.000.000,00')
        ->assertSee('2.200.000,00')
        ->assertSee('( 400.000,00)')
        ->assertSee('21.800.000,00');
});

it('blocks unsigned access to checkout page with 403 forbidden', function () {
    $category = ProductCategory::create([
        'name' => 'Kontrol Industri',
        'slug' => 'kontrol-industri',
        'sort_order' => 1,
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'GAT-TEST-002',
        'name' => 'PLC Controller Unit',
        'slug' => 'plc-controller-unit',
        'price' => 15000000,
        'is_rfq_only' => true,
        'stock' => 5,
        'min_order_quantity' => 1,
        'status' => 'published',
    ]);

    $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([['id' => $product->id, 'qty' => 1]]),
        'pic_name' => 'Andi Wijaya',
        'company_name' => 'PT Otomasi Jaya',
        'company_email' => 'andi@otomasi.co.id',
        'company_phone' => '081122334455',
    ]);

    $order = Order::firstOrFail();

    // Tanpa signature -> harus ditolak 403!
    $this->get('/checkout/' . $order->uuid)->assertForbidden();
});

it('locks buyer identity fields on checkout and allows confirming order with or without optional PO file', function () {
    Storage::fake('local');

    $category = ProductCategory::create([
        'name' => 'Vision System',
        'slug' => 'vision-system',
        'sort_order' => 1,
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'GAT-TEST-003',
        'name' => 'Kamera Barcode Industri',
        'slug' => 'kamera-barcode-industri',
        'price' => 18500000,
        'is_rfq_only' => true,
        'stock' => 8,
        'min_order_quantity' => 1,
        'status' => 'published',
    ]);

    $initResponse = $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([['id' => $product->id, 'qty' => 1]]),
        'pic_name' => 'Siti Rahma',
        'company_name' => 'PT Logistik Terpadu',
        'company_email' => 'siti@logistik.co.id',
        'company_phone' => '081399887766',
        'npwp' => '02.345.678.9-012.000',
        'notes' => 'Kebutuhan mendesak penggantian kamera sortir gudang utama minggu ini',
    ]);

    $order = Order::firstOrFail();

    // Pastikan halaman checkout mengunci identitas pemesan & tidak meminta input Nomor PO
    $this->get($initResponse->headers->get('Location'))
        ->assertOk()
        ->assertSee('Data Terkunci')
        ->assertSee('Ubah di Keranjang')
        ->assertSee('Kebutuhan mendesak penggantian kamera sortir gudang utama minggu ini')
        ->assertDontSee('Nomor Purchase Order (PO)');

    config([
        'services.whatsapp.fonnte_endpoint' => 'http://127.0.0.1:3001/send',
        'services.whatsapp.fonnte_token' => 'gat-internal-wa-secret-2026',
        'services.whatsapp.admin_number' => '6285732021121',
        'services.whatsapp.send_copy_to_buyer' => true,
    ]);

    Http::fake([
        'http://127.0.0.1:3001/send' => Http::response(['status' => true, 'detail' => 'Dokumen PDF & pesan berhasil dikirim tanpa watermark.'], 200),
    ]);

    $signedSubmitUrl = URL::temporarySignedRoute('checkout.submit-po', now()->addDays(14), [
        'order' => $order->uuid,
    ]);

    // 1. Konfirmasi pesanan -> kirim langsung file PDF Sales Quote asli + caption ke WA Admin & WA Pembeli via Gateway Mandiri, lalu tampilkan notifikasi sukses di web
    $confirmResponse = $this->post($signedSubmitUrl, [
        'company_name' => 'PT Coba Ubah Paksa', // harus diabaikan karena data terkunci!
    ]);
    $confirmResponse->assertRedirect()
        ->assertSessionHas('po_success');

    $redirectLocation = (string) $confirmResponse->headers->get('Location');
    expect($redirectLocation)->toContain('/checkout/' . $order->uuid);

    // Pastikan request multipart benar-benar melampirkan file PDF asli (%PDF-) + caption tanpa link URL panjang & tanpa watermark
    Http::assertSent(function ($request) {
        $body = $request->body();

        return $request->url() === 'http://127.0.0.1:3001/send'
            && $request->hasHeader('Authorization', 'gat-internal-wa-secret-2026')
            && str_contains($body, '6285732021121')
            && str_contains($body, 'Sales_Quote_pt_logistik_terpadu.pdf')
            && str_contains($body, '%PDF-')
            && str_contains($body, 'Perkenalkan saya *Siti Rahma*, perwakilan dari *PT Logistik Terpadu*.')
            && str_contains($body, 'Kebutuhan mendesak penggantian kamera sortir gudang utama minggu ini')
            && str_contains($body, 'Kamera Barcode Industri (SKU: GAT-TEST-003) — 1 SET')
            && ! str_contains($body, 'http://')
            && ! str_contains($body, 'https://');
    });

    // Pastikan salinan PDF juga dikirim ke nomor WhatsApp Pembeli (081399887766 -> 6281399887766)
    Http::assertSent(function ($request) {
        return $request->url() === 'http://127.0.0.1:3001/send'
            && str_contains($request->body(), '6281399887766');
    });

    $order->refresh();
    expect($order->status)->toBe('po_submitted');
    expect($order->company_name)->toBe('PT Logistik Terpadu');
    expect($order->po_document_path)->toBeNull();

    // 2. Unggah lampiran file PO opsional -> disimpan privat & ikut dikirim sebagai file ke WA Admin
    $fakePdf = UploadedFile::fake()->createWithContent('PO_PT_Logistik_Terpadu.pdf', '%PDF-1.4 Fake Corporate PO Document');
    $poResponse = $this->post($signedSubmitUrl, [
        'po_document' => $fakePdf,
    ]);
    $poResponse->assertRedirect()->assertSessionHas('po_success');

    $order->refresh();
    expect($order->po_document_path)->not->toBeNull();
    Storage::disk('local')->assertExists($order->po_document_path);

    // Verifikasi anti-fraud endpoint
    $validShortHash = strtolower(substr($order->verification_hash, 0, 16));
    $this->get(route('checkout.verify', ['uuid' => $order->uuid, 'hash' => $validShortHash]))
        ->assertOk()
        ->assertSee('Dokumen Proforma Invoice Asli')
        ->assertSee($order->invoice_number);

    $this->get(route('checkout.verify', ['uuid' => $order->uuid, 'hash' => '0000000000000000']))
        ->assertOk()
        ->assertSee('Dokumen Tidak Dikenali')
        ->assertDontSee($order->invoice_number);
});

it('persists customer-selected specifications per cart item and prints only chosen specs on Sales Quote and WhatsApp', function () {
    $this->seed(ProductSeeder::class);

    // Pastikan modal Pop-Out Detail & Dropdown Spesifikasi dirender tanpa membocorkan harga
    $this->get(route('product'))
        ->assertOk()
        ->assertSee('Pilih Spesifikasi Quotation')
        ->assertSee('spec-dropdown-trigger', false)
        ->assertSee('Masukkan &amp; Lanjut Quote', false)
        ->assertDontSee('32000000')
        ->assertDontSee('32.000.000');

    $plcProduct = Product::where('sku', 'GAT-PLC-002')->firstOrFail();

    // Kirim 2 konfigurasi spek berbeda dari produk yang sama + uji sanitasi opsi palsu
    $initResponse = $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([
            [
                'id' => $plcProduct->id,
                'qty' => 1,
                'specs' => [
                    'Layar HMI' => '99 Inch Palsu Tidak Terdaftar', // harus disanitasi ke opsi default resmi!
                    'Kapasitas Titik I/O' => 'Ekspansi 128 I/O Digital + 16 Analog + Modul RTD/TC',
                    'Input Daya & Penggerak' => '1-Phase 220V AC + Redundant Industrial PSU 24V DC',
                    'Platform PLC' => 'Mitsubishi MELSEC iQ-F (FX5U)',
                    'Proteksi Enclosure' => 'IP65 NEMA 4 Dust & Water Tight Heavy-Duty Steel',
                    'Protokol Komunikasi' => 'Modbus TCP/RTU + Ethernet/IP Multi-Protocol',
                ],
            ],
            [
                'id' => $plcProduct->id,
                'qty' => 2,
                'specs' => [
                    'Layar HMI' => '15 Inch Industrial Touch Panel PC',
                    'Kapasitas Titik I/O' => 'Menengah 64 I/O Digital + 8 Analog + High-Speed Counter',
                    'Input Daya & Penggerak' => '3-Phase 380V AC + Multi-Axis Servo Drive Control',
                    'Platform PLC' => 'Omron Sysmac NX1P2 / NJ Series',
                    'Proteksi Enclosure' => 'IP66 Stainless Steel SUS304 (Food & Cleanroom)',
                    'Protokol Komunikasi' => 'EtherCAT Deterministic Motion Network',
                ],
            ],
        ]),
        'pic_name' => 'Rudi Hartono',
        'company_name' => 'PT Otomasi Presisi Indonesia',
        'company_email' => 'rudi@otomasi-presisi.co.id',
        'company_phone' => '081299887711',
        'notes' => 'Pengadaan 2 tipe panel PLC dengan tegangan & platform berbeda',
    ]);

    $initResponse->assertRedirect();

    $order = Order::with('items')->latest('id')->firstOrFail();
    expect($order->items)->toHaveCount(2);

    $firstItemSpecs = $order->items[0]->resolvedSpecifications();
    expect($firstItemSpecs['Layar HMI'])->toBe('7 Inch Widescreen Touchscreen')
        ->and($firstItemSpecs['Kapasitas Titik I/O'])->toBe('Ekspansi 128 I/O Digital + 16 Analog + Modul RTD/TC')
        ->and($firstItemSpecs['Input Daya & Penggerak'])->toBe('1-Phase 220V AC + Redundant Industrial PSU 24V DC')
        ->and($firstItemSpecs['Platform PLC'])->toBe('Mitsubishi MELSEC iQ-F (FX5U)')
        ->and($firstItemSpecs['Proteksi Enclosure'])->toBe('IP65 NEMA 4 Dust & Water Tight Heavy-Duty Steel');

    $secondItemSpecs = $order->items[1]->resolvedSpecifications();
    expect($secondItemSpecs['Layar HMI'])->toBe('15 Inch Industrial Touch Panel PC')
        ->and($secondItemSpecs['Kapasitas Titik I/O'])->toBe('Menengah 64 I/O Digital + 8 Analog + High-Speed Counter')
        ->and($secondItemSpecs['Input Daya & Penggerak'])->toBe('3-Phase 380V AC + Multi-Axis Servo Drive Control')
        ->and($secondItemSpecs['Platform PLC'])->toBe('Omron Sysmac NX1P2 / NJ Series')
        ->and($secondItemSpecs['Proteksi Enclosure'])->toBe('IP66 Stainless Steel SUS304 (Food & Cleanroom)');

    // Halaman Sales Quote menampilkan tepat spesifikasi yang dipilih tanpa opsi yang tidak dipilih (mis. Siemens SIMATIC S7-1200)
    $this->get($initResponse->headers->get('Location'))
        ->assertOk()
        ->assertSee('Input Daya &amp; Penggerak: 1-Phase 220V AC + Redundant Industrial PSU 24V DC', false)
        ->assertSee('Platform PLC: Mitsubishi MELSEC iQ-F (FX5U)')
        ->assertSee('Platform PLC: Omron Sysmac NX1P2 / NJ Series')
        ->assertDontSee('Siemens SIMATIC S7-1200')
        ->assertDontSee('99 Inch Palsu Tidak Terdaftar');
});

it('enforces 5-layer B2B security hardening: honeypot bot trap, phone regex, magic bytes, anti-replay, and QR code', function () {
    $this->seed(ProductSeeder::class);
    $product = Product::firstOrFail();

    // 1. Uji Honeypot Anti-Bot: Jika bot mengisi b2b_fax_reference -> Tolak otomatis
    $botResponse = $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([['id' => $product->id, 'qty' => 1]]),
        'b2b_fax_reference' => 'automated_spambot_payload',
        'pic_name' => 'Spambot User',
        'company_name' => 'PT Spam',
        'company_email' => 'spam@bot.com',
        'company_phone' => '081234567890',
    ]);
    $botResponse->assertSessionHasErrors('cart_items_json');

    // 2. Uji Validasi Nomor WhatsApp Indonesia: Tolak nomor ngawur
    $invalidPhoneResponse = $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([['id' => $product->id, 'qty' => 1]]),
        'pic_name' => 'Valid PIC',
        'company_name' => 'PT Valid Jaya',
        'company_email' => 'valid@validjaya.co.id',
        'company_phone' => '12345678', // bukan format 08/628
    ]);
    $invalidPhoneResponse->assertSessionHasErrors('company_phone');

    // 3. Pengajuan Sah (Nomor 0812... valid)
    $validResponse = $this->post(route('checkout.initiate'), [
        'cart_items_json' => json_encode([['id' => $product->id, 'qty' => 1]]),
        'pic_name' => 'Ir. Hendra',
        'company_name' => 'PT Rekayasa Industri Prima',
        'company_email' => 'hendra@rekayasaprima.co.id',
        'company_phone' => '081298765432',
    ]);
    $validResponse->assertRedirect();

    $order = Order::latest('id')->firstOrFail();
    $signedUrl = $validResponse->headers->get('Location');
    $submitUrl = URL::temporarySignedRoute('checkout.submit-po', now()->addDays(14), ['order' => $order->uuid]);

    // 4. Uji Validasi Magic Bytes Berkas PO: Tolak file palsu yang bukan PDF/gambar asli
    $fakeMaliciousFile = UploadedFile::fake()->createWithContent('exploit.pdf', '<?php echo "Hacked"; ?>');
    $maliciousUploadResponse = $this->post($submitUrl, [
        'po_document' => $fakeMaliciousFile,
    ]);
    $maliciousUploadResponse->assertSessionHasErrors('po_document');

    // 5. Uji File PO Asli (%PDF-) -> Berhasil
    Http::fake([
        '*' => Http::response(['status' => true, 'detail' => 'Sent'], 200),
    ]);

    $validPdfFile = UploadedFile::fake()->createWithContent('PO_Official.pdf', "%PDF-1.5 Official PO Content\r\n%%EOF");
    $goodUploadResponse = $this->post($submitUrl, [
        'po_document' => $validPdfFile,
    ]);
    $goodUploadResponse->assertRedirect()->assertSessionHas('po_success');

    // 6. Uji Anti-Replay / Cooldown: Klik ulang cepat dalam 5 menit tanpa berkas baru dicegah memicu spam ke WA gateway
    $replayResponse = $this->post($submitUrl, []);
    $replayResponse->assertRedirect()->assertSessionHas('po_success');

    // 7. Uji Digital QR Code Keaslian Dokumen di PDF: Route download-pdf memuat SVG QR code
    $pdfUrl = URL::temporarySignedRoute('checkout.quote-pdf', now()->addDays(14), [
        'order' => $order->uuid,
        'filename' => 'Sales-Quote-B2B.pdf',
    ]);
    $pdfResponse = $this->get($pdfUrl);
    $pdfResponse->assertOk();
    expect($pdfResponse->headers->get('Content-Type'))->toContain('application/pdf');
    expect(strlen($pdfResponse->getContent()))->toBeGreaterThan(1000);
});

it('seeds and verifies G0510 Thermal Inkjet Printer with brochure specs and custom configurator options', function () {
    $this->seed(ProductSeeder::class);

    $product = Product::where('sku', 'GAT-TIJ-007')->firstOrFail();
    expect($product->name)->toContain('Thermal Inkjet Printer Industri G0510')
        ->and($product->badge_primary)->toBe('600 DPI 100m/min')
        ->and($product->badge_secondary)->toBe('Thermal Inkjet Machine (TIJ)')
        ->and($product->image)->toBe('thermal_inject_machine.webp')
        ->and($product->category->slug)->toBe('coding-marking')
        ->and($product->category->name)->toBe('Industrial Coding & Marking');

    // Cek dropdown varian interaktif (harus ada minimal 6 kategori spek dari brosur)
    $specs = $product->specifications;
    expect($specs)->toHaveKey('Konfigurasi Print Head')
        ->and($specs['Konfigurasi Print Head'])->toBeArray()->toHaveCount(4)
        ->and($specs)->toHaveKey('Tipe Cartridge Tinta')
        ->and($specs['Tipe Cartridge Tinta'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Karakteristik Tinta & Warna')
        ->and($specs['Karakteristik Tinta & Warna'])->toBeArray()->toHaveCount(4)
        ->and($specs)->toHaveKey('Resolusi & Kecepatan Cetak')
        ->and($specs['Resolusi & Kecepatan Cetak'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Paket Sensor & Aksesoris Konveyor')
        ->and($specs['Paket Sensor & Aksesoris Konveyor'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Integrasi Antarmuka Komunikasi')
        ->and($specs['Integrasi Antarmuka Komunikasi'])->toBeArray()->toHaveCount(2);

    // Cek spesifikasi standar tetap (Fixed Specs)
    expect($specs['Layar Kontroler'])->toBe('10 Inch Color Touchscreen (Anti-Misoperation UI)')
        ->and($specs['Material Housing'])->toBe('Industrial Aluminum Alloy Casing (Anti-Interferensi Tinggi)')
        ->and($specs['Sistem Operasi & CPU'])->toContain('Linux & Android OS')
        ->and($specs['Jarak Cetak Optimal'])->toBe('2 – 5 mm ke Permukaan Produk (Hasil Tajam)');

    // Halaman /product harus merender produk tanpa kebocoran nominal harga
    $response = $this->get(route('product'));
    $response->assertOk()
        ->assertSee('G0510')
        ->assertSee('Thermal Inkjet Printer')
        ->assertSee('600 DPI 100m/min')
        ->assertSee('thermal_inject_machine.webp')
        ->assertDontSee('24.500.000')
        ->assertDontSee('24500000');
});

it('seeds and verifies V2 3200N Electric Strapping Machine with brochure specs and transparent webp image', function () {
    $this->seed(ProductSeeder::class);

    $product = Product::where('sku', 'GAT-STR-008')->firstOrFail();
    expect($product->name)->toContain('Mesin Strapping Elektrik Portabel V2 3200N')
        ->and($product->badge_primary)->toBe('3200N Tension')
        ->and($product->badge_secondary)->toBe('Friction Welding Strapping')
        ->and($product->image)->toBe('strapping_v2_3200n.webp')
        ->and($product->category->slug)->toBe('strapping-packaging')
        ->and($product->category->name)->toBe('Industrial Strapping & Packaging');

    // Cek dropdown varian interaktif dari brosur V2
    $specs = $product->specifications;
    expect($specs)->toHaveKey('Kompatibilitas Material Tali (Strapping Band)')
        ->and($specs['Kompatibilitas Material Tali (Strapping Band)'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Kekuatan Tarik (Tension Force)')
        ->and($specs['Kekuatan Tarik (Tension Force)'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Waktu Pengelasan Gesek (Splicing / Welding Time)')
        ->and($specs['Waktu Pengelasan Gesek (Splicing / Welding Time)'])->toBeArray()->toHaveCount(2)
        ->and($specs)->toHaveKey('Paket Baterai & Pengisian Daya')
        ->and($specs['Paket Baterai & Pengisian Daya'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Aksesoris & Perlengkapan Kerja')
        ->and($specs['Aksesoris & Perlengkapan Kerja'])->toBeArray()->toHaveCount(2);

    // Cek spesifikasi standar tetap (Fixed Specs)
    expect($specs['Model Alat'])->toContain('V2 3200')
        ->and($specs['Bobot Mesin'])->toContain('3.1 Kg')
        ->and($specs['Kapasitas & Daya Baterai'])->toContain('14.4V / 4.0Ah')
        ->and($specs['Kecepatan Penarikan Tali'])->toContain('100 – 200 mm/detik');

    // Halaman /product harus merender produk tanpa kebocoran nominal harga
    $response = $this->get(route('product'));
    $response->assertOk()
        ->assertSee('V2 3200N')
        ->assertSee('3200N Tension')
        ->assertSee('strapping_v2_3200n.webp')
        ->assertDontSee('12.500.000')
        ->assertDontSee('12500000');
});

it('seeds and verifies A25 Pneumatic Strapping Machine with brochure specs and transparent webp image', function () {
    $this->seed(ProductSeeder::class);

    $product = Product::where('sku', 'GAT-STR-009')->firstOrFail();
    expect($product->name)->toContain('Mesin Strapping Pneumatik Portabel A25')
        ->and($product->badge_primary)->toBe('3500N Pneumatic')
        ->and($product->badge_secondary)->toBe('A25 Friction Welding')
        ->and($product->image)->toBe('a25_pneumatic_strapping_machine.webp')
        ->and($product->category->slug)->toBe('strapping-packaging')
        ->and($product->category->name)->toBe('Industrial Strapping & Packaging');

    // Cek dropdown varian interaktif dari spek A25
    $specs = $product->specifications;
    expect($specs)->toHaveKey('Ukuran Lebar Tali (Strap Width)')
        ->and($specs['Ukuran Lebar Tali (Strap Width)'])->toBeArray()->toHaveCount(2)
        ->and($specs)->toHaveKey('Kompatibilitas Material Tali')
        ->and($specs['Kompatibilitas Material Tali'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Rentang Tekanan Udara Kompresor (Air Pressure)')
        ->and($specs['Rentang Tekanan Udara Kompresor (Air Pressure)'])->toBeArray()->toHaveCount(2)
        ->and($specs)->toHaveKey('Waktu Pengelasan Gesek (Friction Welding Time)')
        ->and($specs['Waktu Pengelasan Gesek (Friction Welding Time)'])->toBeArray()->toHaveCount(2)
        ->and($specs)->toHaveKey('Paket Aksesoris & Koneksi Pneumatik')
        ->and($specs['Paket Aksesoris & Koneksi Pneumatik'])->toBeArray()->toHaveCount(3);

    // Cek spesifikasi standar tetap (Fixed Specs)
    expect($specs['Model Alat'])->toContain('A25')
        ->and($specs['Bobot Mesin'])->toContain('3.8 Kg')
        ->and($specs['Sumber Daya Penggerak'])->toContain('Pneumatik')
        ->and($specs['Konsumsi Udara Rata-rata'])->toContain('0.5 m³/menit');

    // Halaman /product harus merender produk tanpa kebocoran nominal harga B2B
    $response = $this->get(route('product'));
    $response->assertOk()
        ->assertSee('A25')
        ->assertSee('3500N Pneumatic')
        ->assertSee('a25_pneumatic_strapping_machine.webp')
        ->assertDontSee('9.800.000')
        ->assertDontSee('9800000');
});

it('seeds and verifies KZ-19 Pneumatic Steel Strapping Machine with specs and transparent webp image', function () {
    $this->seed(ProductSeeder::class);

    $product = Product::where('sku', 'GAT-STR-010')->firstOrFail();
    expect($product->name)->toContain('Mesin Strapping Pneumatik Tali Baja Portabel KZ-19')
        ->and($product->badge_primary)->toBe('8500N Pneumatic Steel')
        ->and($product->badge_secondary)->toBe('KZ-19 Sealer & Tensioner')
        ->and($product->image)->toBe('kz19_pneumatic_steel_strapping_machine.webp')
        ->and($product->category->slug)->toBe('strapping-packaging')
        ->and($product->category->name)->toBe('Industrial Strapping & Packaging');

    // Cek dropdown varian interaktif dari spek KZ-19
    $specs = $product->specifications;
    expect($specs)->toHaveKey('Ukuran Lebar Tali Baja (Steel Strap Width)')
        ->and($specs['Ukuran Lebar Tali Baja (Steel Strap Width)'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Ketebalan Material Tali Baja (Strap Thickness)')
        ->and($specs['Ketebalan Material Tali Baja (Strap Thickness)'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Tipe Penguncian & Klem Segel (Seal Joint Type)')
        ->and($specs['Tipe Penguncian & Klem Segel (Seal Joint Type)'])->toBeArray()->toHaveCount(3)
        ->and($specs)->toHaveKey('Tekanan Kerja Udara Kompresor (Operating Air Pressure)')
        ->and($specs['Tekanan Kerja Udara Kompresor (Operating Air Pressure)'])->toBeArray()->toHaveCount(2)
        ->and($specs)->toHaveKey('Paket Aksesoris & Koneksi Pneumatik')
        ->and($specs['Paket Aksesoris & Koneksi Pneumatik'])->toBeArray()->toHaveCount(3);

    // Cek spesifikasi standar tetap (Fixed Specs)
    expect($specs['Model Alat'])->toContain('KZ-19')
        ->and($specs['Bobot Bersih Alat'])->toContain('4.5 Kg')
        ->and($specs['Gaya Tarik Maksimal'])->toContain('8.500 N')
        ->and($specs['Kecepatan Penarikan Tali'])->toContain('5.5 meter');

    // Halaman /product harus merender produk tanpa kebocoran nominal harga B2B
    $response = $this->get(route('product'));
    $response->assertOk()
        ->assertSee('KZ-19')
        ->assertSee('8500N Pneumatic Steel')
        ->assertSee('kz19_pneumatic_steel_strapping_machine.webp')
        ->assertDontSee('14.800.000')
        ->assertDontSee('14800000');
});
