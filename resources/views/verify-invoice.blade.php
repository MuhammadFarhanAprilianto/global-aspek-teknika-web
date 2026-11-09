<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Verifikasi Keaslian Proforma Invoice - PT. Global Aspect Technology</title>

    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

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
    </style>
</head>

<body class="bg-white text-gray-900 font-questrial font-['Questrial',sans-serif] min-h-screen flex flex-col justify-between">

    @include('components.navbar.header')

    <main class="flex-1 pt-32 sm:pt-40 pb-20 px-4 sm:px-6 flex items-center justify-center bg-white">
        <div class="w-full max-w-xl bg-white border border-gray-200 rounded-3xl p-6 sm:p-8 shadow-[0_12px_40px_rgba(0,0,0,0.06)] space-y-6">

            @if ($isValid && $order)
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 block">Terverifikasi Resmi (SHA-256)</span>
                        <h1 class="text-lg sm:text-xl font-bold font-agrandir text-gray-900">Dokumen Proforma Invoice Asli</h1>
                    </div>
                </div>

                <div class="p-4 sm:p-5 rounded-2xl bg-gray-50 border border-gray-200 space-y-2.5 text-xs sm:text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">No. Dokumen:</span>
                        <span class="font-mono font-semibold text-gray-900">{{ $order->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">Diterbitkan Oleh:</span>
                        <span class="font-semibold text-gray-900">PT. Global Aspect Technology</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">Perusahaan Tujuan:</span>
                        <span class="font-semibold text-gray-900 text-right">{{ $order->company_name }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">Tanggal Penerbitan:</span>
                        <span class="text-gray-800">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">Nilai Tagihan Resmi (Termasuk PPN):</span>
                        <span class="font-bold text-gray-900">{{ $order->formatted_grand_total }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">Status Pengajuan:</span>
                        <span class="font-semibold {{ $order->status === 'po_submitted' ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $order->status === 'po_submitted' ? 'PO Korporat Diterima' : 'Menunggu Pengajuan PO' }}
                        </span>
                    </div>
                    <div class="pt-2 border-t border-gray-200 flex justify-between gap-4">
                        <span class="text-gray-500">Kode Otentikasi:</span>
                        <span class="font-mono text-xs text-gray-700">{{ $providedHash }}</span>
                    </div>
                </div>

                <p class="text-xs text-gray-600 leading-relaxed">
                    Pastikan seluruh nominal pada dokumen cetak sama persis dengan nilai terverifikasi di atas sebelum memproses persetujuan Purchase Order (PO) atau pembayaran ke rekening korporat resmi <strong class="text-gray-900">PT. Global Aspect Technology</strong>.
                </p>
            @else
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-200 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-red-600 block">Verifikasi Gagal</span>
                        <h1 class="text-lg sm:text-xl font-bold font-agrandir text-gray-900">Dokumen Tidak Dikenali</h1>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Kode otentikasi kriptografis tidak cocok dengan basis data resmi <strong class="text-gray-900">PT. Global Aspect Technology</strong>. Mohon berhati-hati dan hubungi tim kami melalui halaman Kontak Resmi sebelum melakukan transaksi apa pun.
                </p>
            @endif

            <div class="pt-2 flex flex-wrap items-center justify-between gap-3">
                <a href="{{ route('product') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold transition-colors">
                    &larr; Kembali ke Katalog Produk
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition-colors">
                    Hubungi Tim Resmi GAT
                </a>
            </div>

        </div>
    </main>

    @include('components.footer.footer')

    <script>
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
        });
    </script>
</body>

</html>

