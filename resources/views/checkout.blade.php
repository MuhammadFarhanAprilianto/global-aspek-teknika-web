<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Sales Quote - {{ $order->company_name }} - PT Global Aspek Teknologi</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <style>
        .font-agrandir {
            font-family: 'Agrandir', sans-serif !important;
        }

        .font-questrial {
            font-family: 'Questrial', sans-serif !important;
        }

        .quote-paper {
            font-family: Arial, Helvetica, sans-serif !important;
            color: #000000;
        }

        .quote-bar-slate {
            background-color: #788595 !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 14mm 14mm 14mm 14mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: #ffffff !important;
                color: #000000 !important;
            }

            .no-print,
            #site-header,
            #mobile-menu,
            footer {
                display: none !important;
            }

            #checkout-main-wrapper {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                background: #ffffff !important;
            }

            #checkout-main-wrapper > div {
                max-width: 100% !important;
                padding: 0 !important;
            }

            #proforma-invoice-sheet {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                min-height: 265mm;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-900 font-questrial font-['Questrial',sans-serif] overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Navbar (Hidden on Print) -->
    <div class="no-print">
        @include('components.navbar.header')
    </div>

    <!-- Main Checkout & Proforma Invoice Section -->
    <main id="checkout-main-wrapper" class="flex-1 pt-28 sm:pt-36 pb-16 sm:pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            <!-- Top Action Bar (Hidden on Print) -->
            <div class="no-print flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
                <div class="space-y-1">
                    <a href="{{ route('product') }}"
                        class="inline-flex items-center gap-2 text-xs sm:text-sm text-gray-500 hover:text-gray-900 font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali ke Katalog Produk</span>
                    </a>
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold font-agrandir text-gray-900 tracking-tight">
                        Tahap Pembayaran &amp; Pengajuan PO B2B
                    </h1>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <a href="{{ $quotePdfUrl }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-neutral-900 text-white hover:bg-neutral-800 text-xs font-semibold transition-colors cursor-pointer shadow-xs">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Unduh / Cetak PDF</span>
                    </a>
                </div>
            </div>

            <!-- Two-Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

                <!-- LEFT COLUMN: Official PT Global Aspek Teknologi Sales Quote Sheet -->
                <div class="lg:col-span-8">
                    <div id="proforma-invoice-sheet"
                        class="quote-paper bg-white border border-gray-200 rounded-sm p-6 sm:p-10 lg:p-12 shadow-[0_8px_32px_rgba(0,0,0,0.06)] min-h-[820px] flex flex-col justify-between">

                        <div>
                            <!-- 1. Official Company Letterhead (Exact Match to PDF) -->
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-start mb-10">
                                <div class="sm:col-span-5 pt-1">
                                    <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT Global Aspek Teknologi"
                                        class="w-44 sm:w-52 h-auto object-contain">
                                </div>

                                <div class="sm:col-span-7 text-[12px] sm:text-[13px] leading-[1.48] text-black">
                                    <p class="font-bold text-[13px] sm:text-[14px] mb-0.5">PT Global Aspek Teknologi</p>
                                    <p>Cibis Nine Building Lantai 11</p>
                                    <p>Jl. TB Simatupang No.2 RT:001/RW:005 Kel. Cilandak Timur, Kec.</p>
                                    <p>Ps. Minggu - Kota Jakarta Selatan, 12560</p>
                                    <p>globalaspektek84@gmail.com</p>
                                </div>
                            </div>

                            <!-- 2. BILL TO (Left) & QUOTE # / DATE / EXPIRED DATE Bars (Right) -->
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-6 mb-9">
                                <div class="max-w-sm text-[12px] leading-[1.48] text-black">
                                    <p class="uppercase mb-2.5 tracking-wide">BILL TO</p>
                                    <p class="mb-0.5">{{ $order->pic_name }}</p>
                                    <p class="mb-1.5">{{ $order->company_name }}</p>
                                    @if ($order->company_address)
                                        <p class="whitespace-pre-line mb-1">{{ $order->company_address }}</p>
                                    @endif
                                    <p>{{ $order->company_email }}</p>
                                    <p>{{ $order->company_phone }}</p>
                                    @if ($order->npwp && $order->npwp !== '-')
                                        <p class="mt-0.5">NPWP: {{ $order->npwp }}</p>
                                    @endif
                                    @if ($order->po_number)
                                        <p class="mt-1 font-bold">PO #: {{ $order->po_number }}</p>
                                    @endif
                                </div>

                                <div class="w-full sm:w-[275px] shrink-0">
                                    <h2 class="text-right text-2xl sm:text-[28px] font-bold text-black tracking-tight leading-none mb-2.5">
                                        Quote
                                    </h2>
                                    <div class="space-y-[3px] text-[11px] sm:text-[12px] font-bold">
                                        <div class="quote-bar-slate px-3 py-1.5 flex items-center">
                                            <span class="w-[48%] uppercase">DATE</span>
                                            <span class="w-[52%]">{{ $order->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="quote-bar-slate px-3 py-1.5 flex items-center">
                                            <span class="w-[48%] uppercase">EXPIRED DATE</span>
                                            <span class="w-[52%]">{{ optional($order->expires_at)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Line Items Table (Description | Qty | Discount | Price (Rp.) | Amount (Rp.)) -->
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse text-[12px] text-black">
                                    <thead>
                                        <tr class="quote-bar-slate font-bold">
                                            <th class="py-2 px-3 text-left w-[46%]">Description</th>
                                            <th class="py-2 px-2 text-center w-[10%] whitespace-nowrap">Qty</th>
                                            <th class="py-2 px-2 text-right w-[12%] whitespace-nowrap">Discount</th>
                                            <th class="py-2 px-2 text-right w-[16%] whitespace-nowrap">Price (Rp.)</th>
                                            <th class="py-2 px-3 text-right w-[16%] whitespace-nowrap">Amount (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr class="border-b border-[#788595]/70 align-top">
                                                <td class="py-3 px-3 leading-[1.48]">
                                                    <p class="font-bold text-black">{{ $item->product_name }}</p>
                                                    <div class="mt-0.5 space-y-0.5 text-black">
                                                        <p>- SKU: {{ $item->sku }}</p>
                                                        @foreach ($item->resolvedSpecifications() as $specKey => $specVal)
                                                            <p>- {{ is_string($specKey) ? $specKey . ': ' . $specVal : $specVal }}</p>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="py-3 px-2 text-center leading-[1.35] whitespace-nowrap">
                                                    <span class="block">{{ $item->quantity }}</span>
                                                    <span class="block uppercase">SET</span>
                                                </td>
                                                <td class="py-3 px-2 text-right whitespace-nowrap">
                                                    0.0%
                                                </td>
                                                <td class="py-3 px-2 text-right whitespace-nowrap">
                                                    {{ number_format((float) $item->unit_price, 2, ',', '.') }}
                                                </td>
                                                <td class="py-3 px-3 text-right whitespace-nowrap">
                                                    {{ number_format((float) $item->line_total, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- 4. Totals Summary (SUBTOTAL, PPN 11% 11.0%, Slate Bar TOTAL) -->
                            <div class="mt-8 flex flex-col sm:flex-row justify-between items-start gap-6">
                                <div class="sm:max-w-xs text-[11px] text-black leading-relaxed">
                                    @if ($order->notes)
                                        <p class="font-bold mb-0.5">Notes:</p>
                                        <p>{{ $order->notes }}</p>
                                    @endif
                                </div>

                                <div class="w-full sm:w-[320px] ml-auto text-[12px] text-black">
                                    <div class="px-3 py-1.5 flex items-center justify-between">
                                        <span>SUBTOTAL</span>
                                        <span>{{ number_format((float) $order->subtotal, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="px-3 py-1.5 flex items-center justify-between">
                                        <span>PPN {{ number_format((float) $order->tax_rate, 0) }}% &nbsp; {{ number_format((float) $order->tax_rate, 1) }}%</span>
                                        <span>{{ number_format((float) $order->tax_amount, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="px-3 py-1.5 flex items-center justify-between">
                                        <span>PPh 23 &nbsp; {{ number_format((float) ($order->pph23_rate ?? 2), 1) }}%</span>
                                        <span>( {{ number_format((float) $order->pph23_amount, 2, ',', '.') }})</span>
                                    </div>
                                    <div class="quote-bar-slate font-bold px-3 py-2 flex items-center justify-between mt-1">
                                        <span>TOTAL</span>
                                        <span>{{ number_format((float) $order->grand_total, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Official Bottom Footer (Sales Quote | Page 1 of 1) -->
                        <div class="mt-16 pt-4 flex items-center justify-between text-[11px] text-gray-500">
                            <span>Sales Quote</span>
                            <span>Page 1 of 1</span>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: Locked Buyer Identity & Order Confirmation Panel (Hidden on Print) -->
                <div class="lg:col-span-4 no-print space-y-5 lg:sticky lg:top-28">

                    @if (session('po_success'))
                        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs leading-relaxed">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-bold text-emerald-950 mb-1">Pesanan Berhasil Dikonfirmasi</p>
                                    <p>{{ session('po_success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('whatsapp_warning'))
                        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs leading-relaxed">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-bold text-amber-950 mb-1">Status Pengiriman WhatsApp Gateway</p>
                                    <p>{{ session('whatsapp_warning') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Locked Buyer Identity & Confirm Order Card -->
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-[0_12px_40px_rgba(0,0,0,0.06)] space-y-4">
                            <div>
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-base sm:text-lg font-bold font-agrandir text-gray-900 leading-snug">
                                        Data Pemesan &amp; Konfirmasi
                                    </h3>
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-gray-500 shrink-0">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Data Terkunci
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                    Periksa kembali rincian Quote di samping dan pastikan data perusahaan Anda sudah sesuai sebelum dikonfirmasi.
                                </p>
                            </div>

                            @if ($errors->any())
                                <div class="p-3 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                                    @foreach ($errors->all() as $err)
                                        <p>• {{ $err }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Locked Read-Only Buyer Fields -->
                            <div class="space-y-2.5">
                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">Nama Pemesan (PIC)</label>
                                    <input type="text" value="{{ $order->pic_name }}" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-medium text-gray-700 cursor-not-allowed select-none">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">Nama Perusahaan (PT)</label>
                                    <input type="text" value="{{ $order->company_name }}" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-medium text-gray-700 cursor-not-allowed select-none">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">Nomor Telepon / WhatsApp</label>
                                    <input type="text" value="{{ $order->company_phone }}" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-medium text-gray-700 cursor-not-allowed select-none">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">Email Perusahaan</label>
                                    <input type="email" value="{{ $order->company_email }}" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-medium text-gray-700 cursor-not-allowed select-none">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">NPWP Perusahaan</label>
                                    <input type="text" value="{{ $order->npwp ?: '-' }}" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-mono font-medium text-gray-700 cursor-not-allowed select-none">
                                </div>

                                <div>
                                    <label class="block text-[11px] font-medium text-gray-500 mb-1">Urgensi / Kebutuhan Pesanan</label>
                                    <textarea rows="2" readonly disabled
                                        class="w-full px-3.5 py-2 rounded-xl bg-gray-100/90 border border-gray-200 text-xs sm:text-sm font-medium text-gray-700 cursor-not-allowed select-none resize-none">{{ $order->notes ?: 'Pengadaan kebutuhan operasional perusahaan' }}</textarea>
                                </div>

                                <div class="pt-1 flex items-center justify-between gap-2 text-[11px]">
                                    <span class="text-gray-400">Ada data yang perlu diperbaiki?</span>
                                    <a href="{{ route('product', ['edit_cart' => 1]) }}"
                                        class="font-semibold text-red-600 hover:text-red-700 underline shrink-0">
                                        &larr; Ubah di Keranjang
                                    </a>
                                </div>
                            </div>

                            <!-- Optional PO Upload + Confirm Order Form -->
                            <form method="POST" action="{{ $submitPoUrl }}" enctype="multipart/form-data" class="pt-3 border-t border-gray-200 space-y-3.5 js-confirm-order-form">
                                @csrf

                                @if ($order->status === 'po_submitted')
                                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between gap-2 text-xs text-emerald-900">
                                        <span class="inline-flex items-center gap-1.5 font-bold text-emerald-800">
                                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Telah Dikonfirmasi ke WhatsApp
                                        </span>
                                        <span class="text-[10px] text-emerald-600 font-medium">Diproses Tim GAT</span>
                                    </div>
                                @endif

                                <div>
                                    <label for="po-document-input" class="block text-xs font-medium text-gray-700 mb-1">
                                        Lampiran Dokumen PO Resmi <span class="text-gray-400 font-normal">(Opsional)</span>
                                    </label>
                                    <div class="p-3 rounded-xl bg-gray-50 border border-dashed border-gray-300">
                                        <input type="file" id="po-document-input" name="po_document"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-neutral-900 file:text-white hover:file:bg-neutral-800 cursor-pointer">
                                        <p class="text-[11px] text-gray-500 mt-2 leading-relaxed">
                                            PDF, JPG, atau PNG (Maks. 5 MB). Kosongkan jika dokumen PO belum diterbitkan oleh tim Finance Anda.
                                        </p>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs sm:text-sm transition-colors shadow-sm cursor-pointer active:scale-[0.99]">
                                    <span>{{ $order->status === 'po_submitted' ? 'Kirim Ulang / Perbarui Lampiran PO' : 'Konfirmasi Pesanan ke Admin' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </form>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Footer (Hidden on Print) -->
    <div class="no-print">
        @include('components.footer.footer')
    </div>

    <script>
        // Kosongkan keranjang & draft form lokal setelah pesanan dikonfirmasi ke Admin
        function clearLocalB2BCart() {
            try {
                localStorage.removeItem('gat_rfq_cart');
                localStorage.removeItem('gat_rfq_buyer');
                localStorage.removeItem('gat_cart');
            } catch (e) {}
        }

        @if (session('clear_rfq_cart'))
            clearLocalB2BCart();
        @endif

        // Mobile Navbar Toggle & Form Submit Cleanup
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.getElementById('menu-toggle');
            const menuClose = document.getElementById('menu-close');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', () => mobileMenu.classList.remove('hidden'));
            }
            if (menuClose && mobileMenu) {
                menuClose.addEventListener('click', () => mobileMenu.classList.add('hidden'));
            }

            document.querySelectorAll('.js-confirm-order-form').forEach(formEl => {
                formEl.addEventListener('submit', () => {
                    clearLocalB2BCart();
                    const btn = formEl.querySelector('button[type="submit"]');
                    if (btn) {
                        btn.disabled = true;
                        btn.classList.add('opacity-75', 'pointer-events-none');
                        const labelSpan = btn.querySelector('span');
                        if (labelSpan) labelSpan.textContent = 'Menghubungkan ke WhatsApp Admin...';
                    }
                });
            });
        });
    </script>
</body>

</html>

