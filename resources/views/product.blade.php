<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - GAT</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600&family=Questrial&family=Syne:wght@400..800&family=Viga&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
        .font-agrandir {
            font-family: 'Agrandir', sans-serif !important;
        }
        .font-questrial {
            font-family: 'Questrial', sans-serif !important;
        }

        /* Lenis Smooth Scroll System */
        html.lenis, html.lenis body {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }

        /* LabsStdio Agency Scroll Reveal Animation with Motion Blur */
        .reveal-on-scroll {
            opacity: 0;
            filter: blur(10px);
            transform: translateY(28px);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                        filter 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform, filter;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1 !important;
            filter: blur(0px) !important;
            transform: translateY(0) !important;
        }
        .reveal-stagger-1 { transition-delay: 0.08s; }
        .reveal-stagger-2 { transition-delay: 0.16s; }
        .reveal-stagger-3 { transition-delay: 0.24s; }
        .reveal-stagger-4 { transition-delay: 0.32s; }
        .reveal-stagger-5 { transition-delay: 0.40s; }
        .reveal-stagger-6 { transition-delay: 0.48s; }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-questrial font-['Questrial',sans-serif]">
    <!-- Navbar -->

    @include('components.navbar.header')

    <!-- Hero Section (Product Video Background - Expanded Full-Height like About Us, Title Bottom-Aligned) -->
    <section
        class="relative w-full min-h-[75vh] sm:min-h-[85vh] lg:min-h-[92vh] xl:min-h-[96vh] bg-black text-white text-center pt-44 sm:pt-56 pb-12 sm:pb-16 lg:pb-20 overflow-hidden flex flex-col justify-end items-center">
        <!-- Background Video Centered Top-Bottom-Left-Right with WebM Primary and MP4 Fallback -->
        <div
            class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none flex items-center justify-center">
            <video autoplay loop muted playsinline preload="auto" class="w-full h-full object-cover object-center opacity-70"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/ProductCompany.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/ProductCompany.webm') }}" type="video/webm">
            </video>
            <!-- Overlay to guarantee text contrast & cinematic depth -->
            <div class="absolute inset-0 bg-black/35 backdrop-blur-[0.5px]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-[66px] xl:text-[72px] font-extrabold uppercase font-agrandir font-['Agrandir',sans-serif] tracking-wider text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                Product
            </h1>
            <div class="w-20 sm:w-24 h-1.5 bg-red-600 mx-auto mt-2 rounded-full">
            </div>
        </div>
    </section>

    <!-- Featured Case Studies / Product List Section (LabsStdio Style) -->
    <section class="w-full bg-[#000000] py-16 sm:py-20 lg:py-24 font-['Questrial',sans-serif]">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">

            <!-- Search & Category Dropdown Bar (Clean White Box Edition with Black Text) -->
            <form id="product-filter-form" action="{{ route('product') }}" method="GET" class="relative z-30 max-w-4xl mx-auto mb-12 sm:mb-16 px-2 reveal-on-scroll">
                <input type="hidden" name="category" id="filter-category-input" value="{{ $selectedCategory ?? 'all' }}">

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-3.5">
                    
                    <!-- 1. Custom Category Dropdown (Clean White Pill, Black Text) -->
                    <div class="relative z-30 w-full sm:w-[320px] lg:w-[340px] shrink-0" id="category-dropdown-wrapper">
                        <!-- Dropdown Trigger Button -->
                        <button type="button" id="category-dropdown-trigger"
                            class="w-full flex items-center justify-between gap-3 px-5 py-3 rounded-full bg-white text-gray-900 border border-gray-200 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-600/40">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <!-- Category Icon -->
                                <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                                @php
                                    $activeCatName = 'Semua Kategori';
                                    if(!empty($selectedCategory) && $selectedCategory !== 'all') {
                                        $found = $categories->firstWhere('slug', $selectedCategory);
                                        if($found) $activeCatName = $found->name;
                                    }
                                @endphp
                                <span class="truncate text-xs sm:text-sm font-semibold tracking-wide text-gray-900" id="selected-category-label">
                                    {{ $activeCatName }}
                                </span>
                            </div>

                            <!-- Chevron Arrow -->
                            <svg id="category-dropdown-chevron" class="w-4 h-4 text-gray-500 transition-transform duration-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu Panel (Clean White Card, 100% Opaque, Floats Above Cards) -->
                        <div id="category-dropdown-menu"
                            class="absolute top-full left-0 mt-2 hidden z-40 w-full sm:w-[340px] rounded-2xl bg-white border border-gray-200 shadow-[0_25px_60px_rgba(0,0,0,0.5)] p-2 space-y-1.5 overflow-hidden transition-all duration-200">
                            
                            <!-- All Categories Option -->
                            <button type="button" data-slug="all"
                                class="category-option-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold transition-colors {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-red-600 text-white font-bold shadow-sm' : 'text-gray-900 bg-white hover:bg-gray-100 hover:text-black' }}">
                                <span class="truncate">Semua Kategori</span>
                                <span class="ml-2 text-xs font-semibold px-2.5 py-0.5 rounded-full {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-700' }}">({{ $categories->sum('products_count') }})</span>
                            </button>

                            <!-- Individual Category Options -->
                            @foreach($categories as $cat)
                            <button type="button" data-slug="{{ $cat->slug }}"
                                class="category-option-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold transition-colors {{ ($selectedCategory ?? '') === $cat->slug ? 'bg-red-600 text-white font-bold shadow-sm' : 'text-gray-900 bg-white hover:bg-gray-100 hover:text-black' }}">
                                <span class="truncate">{{ $cat->name }}</span>
                                <span class="ml-2 text-xs font-semibold px-2.5 py-0.5 rounded-full {{ ($selectedCategory ?? '') === $cat->slug ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-700' }}">({{ $cat->products_count }})</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Fast Search Box (Clean White Pill, Black Text, Red Lens Button) -->
                    <div class="relative flex-1 w-full flex items-center rounded-full bg-white border border-gray-200 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:border-gray-300 focus-within:ring-2 focus-within:ring-red-600/40 focus-within:border-red-600 transition-all duration-300 p-1.5 pl-5">
                        <input type="text" name="search" id="product-search-input" value="{{ $search ?? '' }}"
                            placeholder="Cari komponen, PLC, sensor, atau SKU..."
                            autocomplete="off"
                            class="w-full bg-transparent text-gray-900 placeholder-gray-400 text-xs sm:text-sm font-medium focus:outline-none pr-2 font-questrial">

                        <!-- Dynamic Clear Search Button (Instant client-side reset) -->
                        <button type="button" id="clear-search-btn"
                            class="p-1.5 mr-1 text-gray-400 hover:text-gray-700 transition-colors cursor-pointer {{ empty($search) ? 'hidden' : '' }}"
                            title="Hapus kata kunci pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <!-- Dedicated Lens Action Button (Icon Lensa - Direct Scroll to Product) -->
                        <button type="submit" id="product-search-submit-btn"
                            class="inline-flex items-center justify-center size-9 sm:size-10 rounded-full bg-red-600 hover:bg-red-500 text-white shadow-md transition-all duration-300 hover:scale-105 shrink-0 cursor-pointer"
                            title="Cari & Langsung ke Produk">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Active Filter Tags / Status Notification (Real-Time Synchronized) -->
                <div id="live-status-container" class="mt-4 flex flex-wrap items-center justify-center gap-2 text-xs text-neutral-300 {{ empty($search) && (empty($selectedCategory) || $selectedCategory === 'all') ? 'hidden' : '' }}">
                    <span>Ditemukan <strong class="text-white" id="live-match-count">{{ $products->count() }}</strong> produk</span>
                    <span id="live-keyword-badge" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white {{ empty($search) ? 'hidden' : '' }}">
                        Kata kunci: <strong class="text-red-400" id="live-keyword-text">"{{ $search ?? '' }}"</strong>
                    </span>
                    <span id="live-category-badge" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'hidden' : '' }}">
                        Kategori: <strong class="text-red-400" id="live-category-text">{{ $activeCatName }}</strong>
                    </span>
                    <button type="button" id="live-reset-all-btn" class="text-red-400 hover:text-red-300 font-semibold underline underline-offset-2 ml-1 cursor-pointer">
                        Reset Filter
                    </button>
                </div>
            </form>

            <!-- 3x3 Responsive LabsStdio Grid (3 Columns Per Row - Dynamic Database Loop) -->
            <div id="product-grid-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 lg:gap-x-7 xl:gap-x-8 gap-y-2 sm:gap-y-3 lg:gap-y-3 relative z-0">

                @forelse($products as $index => $product)
                <!-- Card: {{ $product->name }} -->
                <div
                    class="product-card-item group relative rounded-[24px] sm:rounded-[28px] overflow-hidden bg-transparent transition-all duration-500 min-h-[340px] sm:min-h-[365px] flex flex-col justify-end p-3.5 sm:p-4 pb-2.5 sm:pb-3 text-left cursor-pointer reveal-on-scroll reveal-stagger-{{ ($index % 6) + 1 }}"
                    data-product-id="{{ $product->id }}"
                    data-name="{{ strtolower($product->name) }}"
                    data-sku="{{ strtolower($product->sku) }}"
                    data-category="{{ strtolower($product->category->slug ?? '') }}"
                    data-badges="{{ strtolower(($product->badge_primary ?? '') . ' ' . ($product->badge_secondary ?? '')) }}"
                    data-desc="{{ strtolower($product->short_description ?? '') }}"
                    role="button"
                    tabindex="0"
                    aria-label="Lihat keterangan dan pilih spesifikasi {{ $product->name }}">
                    
                    <!-- Product Image (High Positioned, Minimal Top Space) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center pt-1 px-3 sm:px-4 pb-30 sm:pb-32">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-contain object-center opacity-95 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                    </div>

                    <!-- Ambient Contrast Gradient (Gentle fade behind text) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent pointer-events-none z-10"></div>

                    <!-- Card Content (Compact & Clean Typography) -->
                    <div class="relative z-20">
                        <!-- Badges Row -->
                        <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                            @if($product->badge_primary)
                            <span
                                class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-xs">
                                {{ $product->badge_primary }}
                            </span>
                            @endif
                            <span
                                class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-medium font-['Questrial',sans-serif] bg-white/15 hover:bg-white/25 backdrop-blur-md text-white tracking-wide transition-colors">
                                {{ $product->badge_secondary ?? ($product->category->name ?? 'GAT Product') }}
                            </span>
                        </div>

                        <!-- Title (Compact 2-Line Max, Elegant Size) -->
                        <h3
                            class="text-sm sm:text-[15px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-snug mb-1 group-hover:text-red-400 transition-colors line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <!-- Description (Refined Compact Text) -->
                        <p
                            class="text-[11px] sm:text-xs font-normal font-questrial font-['Questrial',sans-serif] text-neutral-400 leading-normal text-justify line-clamp-2 mb-2">
                            {{ $product->short_description }}
                        </p>

                        <!-- B2B Private RFQ Footer: SKU & Spec Picker Trigger (Tanpa Eksposur Nominal Harga) -->
                        <div class="pt-2 border-t border-neutral-800/80 flex items-center justify-between gap-2">
                            <div>
                                <span class="block text-[9px] uppercase tracking-wider text-neutral-400 font-mono leading-none mb-1">SKU: {{ $product->sku }}</span>
                                <span class="inline-flex items-center gap-1 text-xs sm:text-[13px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white group-hover:text-red-400 transition-colors leading-none">
                                    <svg class="w-3 h-3 text-neutral-400 group-hover:text-red-400 transition-colors shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span>{{ $product->formatted_price }}</span>
                                </span>
                            </div>

                            <!-- Open Product Detail & Specification Picker Pop-Out -->
                            <button type="button"
                                class="btn-add-to-cart inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-semibold bg-red-600 hover:bg-red-500 text-white transition-all duration-300 shadow-sm shrink-0 active:scale-95 cursor-pointer"
                                data-id="{{ $product->id }}"
                                title="Lihat keterangan barang & pilih spesifikasi Quotation">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.1" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                                <span>Pilih Spek</span>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-16 text-center text-neutral-400">
                    <p class="text-lg">Belum ada produk yang ditemukan untuk kategori ini.</p>
                    <a href="{{ route('product') }}" class="mt-4 inline-block px-5 py-2 rounded-full bg-red-600 text-white text-sm">Lihat Semua Produk</a>
                </div>
                @endforelse

                <!-- Dynamic Live Instant Search Empty State -->
                <div id="live-search-empty-state" class="hidden col-span-full py-16 text-center text-neutral-400">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-red-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-white mb-2">Produk Tidak Ditemukan</p>
                    <p class="text-sm text-neutral-400 max-w-md mx-auto" id="live-search-empty-text">Tidak ada produk yang cocok dengan kata kunci tersebut.</p>
                    <button type="button" id="live-search-empty-reset-btn" class="mt-5 px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-500 text-white text-xs font-semibold transition-all shadow-md cursor-pointer">
                        Tampilkan Semua Produk
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- ========================================================================= -->
    <!-- B2B CENTERED POP-UP FORM MODAL & FLOATING CART TRIGGER                    -->
    <!-- ========================================================================= -->

    <!-- Floating Cart Pill Trigger Button -->
    <button type="button" id="cart-drawer-trigger"
        class="fixed bottom-6 right-24 sm:bottom-8 sm:right-28 z-40 flex items-center gap-2 px-4 py-2.5 rounded-full bg-white text-gray-900 border border-gray-200 shadow-[0_8px_30px_rgba(0,0,0,0.25)] hover:bg-gray-50 transition-all duration-300 cursor-pointer font-['Questrial',sans-serif] text-xs sm:text-sm font-semibold group/cart">
        <span class="relative flex items-center justify-center">
            <svg class="w-4 h-4 text-red-600 transition-transform group-hover/cart:scale-110" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </span>
        <span>Keranjang</span>
        <span id="cart-counter-badge" class="ml-0.5 px-2 py-0.5 rounded-full bg-red-600 text-white text-[10px] sm:text-xs font-bold leading-none">0</span>
    </button>

    <!-- Subtle Corporate Toast Notification (Zero Neon) -->
    <div id="spec-added-toast"
        class="fixed bottom-20 right-6 sm:bottom-24 sm:right-28 z-[170] pointer-events-none opacity-0 translate-y-2 transition-all duration-200 flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-gray-900 text-white border border-gray-800 shadow-lg font-['Questrial',sans-serif] text-xs">
        <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </span>
        <span id="spec-added-toast-text">Spesifikasi produk disimpan ke keranjang.</span>
    </div>

    <!-- ========================================================================= -->
    <!-- POP-OUT PRODUCT DETAIL & SPECIFICATION PICKER MODAL (CLEAN WHITE)         -->
    <!-- ========================================================================= -->
    <div id="product-detail-modal-wrapper"
        class="fixed inset-0 z-[160] hidden items-center justify-center p-4 sm:p-6 font-['Questrial',sans-serif]"
        role="dialog" aria-modal="true" aria-labelledby="detail-modal-title">

        <!-- Backdrop -->
        <div id="product-detail-modal-backdrop"
            class="fixed inset-0 bg-black/75 backdrop-blur-sm opacity-0 transition-opacity duration-200"></div>

        <!-- Centered Modal Card (Clean Corporate White - Zero Neon) -->
        <div id="product-detail-modal-card"
            data-lenis-prevent
            class="relative z-10 w-full max-w-3xl max-h-[90vh] bg-white border border-gray-200 rounded-3xl shadow-[0_24px_64px_rgba(0,0,0,0.45)] text-gray-900 flex flex-col overflow-hidden opacity-0 scale-95 transition-all duration-200 ease-out">

            <!-- Modal Top Header -->
            <div class="px-5 sm:px-6 py-3.5 border-b border-gray-100 flex items-center justify-between shrink-0 bg-white">
                <div class="flex items-center gap-2.5 min-w-0">
                    <span id="detail-modal-badge-primary" class="hidden px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-bold font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide"></span>
                    <span id="detail-modal-badge-secondary" class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-[11px] font-medium bg-gray-100 text-gray-700 border border-gray-200 tracking-wide truncate"></span>
                </div>

                <button type="button" id="product-detail-modal-close"
                    class="p-1.5 rounded-xl text-gray-400 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer shrink-0"
                    title="Tutup Detail Produk">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Scrollable 2-Column Content -->
            <div id="detail-modal-scroll-body" class="flex-1 overflow-y-auto grid grid-cols-1 md:grid-cols-12 bg-white" data-lenis-prevent>
                <!-- Left Column: Visual Preview & B2B Metadata -->
                <div class="md:col-span-5 bg-gray-50/80 border-b md:border-b-0 md:border-r border-gray-100 p-5 sm:p-6 flex flex-col justify-between gap-4">
                    <div class="flex items-center justify-center bg-white border border-gray-200/80 rounded-2xl p-4 h-48 sm:h-56">
                        <img id="detail-modal-image" src="" alt="" class="max-h-full max-w-full object-contain">
                    </div>

                    <div class="rounded-2xl bg-white border border-gray-200 p-3.5 space-y-2.5 text-xs">
                        <div class="flex items-center justify-between gap-2 pb-2 border-b border-gray-100">
                            <span class="text-gray-500">Kode Katalog</span>
                            <span id="detail-modal-sku" class="font-mono font-semibold text-gray-900">SKU: -</span>
                        </div>
                        <div class="flex items-center justify-between gap-2 pb-2 border-b border-gray-100">
                            <span class="text-gray-500">Min. Pemesanan</span>
                            <span id="detail-modal-moq-label" class="font-semibold text-gray-900">1 SET</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-gray-500">Skema Harga</span>
                            <span class="inline-flex items-center gap-1 font-bold font-['Agrandir',sans-serif] text-gray-900">
                                <svg class="w-3.5 h-3.5 text-gray-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span id="detail-modal-price-label">Harga Kontrak B2B</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Description & Interactive Specification Dropdowns -->
                <div class="md:col-span-7 p-5 sm:p-6 pb-8 space-y-4">
                    <div>
                        <h3 id="detail-modal-title" class="text-base sm:text-lg font-bold font-agrandir font-['Agrandir',sans-serif] text-gray-900 leading-snug mb-2">
                            Nama Produk
                        </h3>
                        <p id="detail-modal-description" class="text-xs sm:text-[13px] text-gray-600 leading-relaxed text-justify">
                            Keterangan lengkap produk.
                        </p>
                    </div>

                    <!-- Selectable Variant Specifications (Custom GAT Website Dropdowns) -->
                    <div id="detail-modal-selectable-section" class="pt-3 border-t border-gray-100 space-y-3">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">Pilih Spesifikasi Quotation</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-gray-100 text-[10px] font-medium text-gray-600">Tercetak di Sales Quote</span>
                        </div>
                        <div id="detail-modal-selectable-list" class="space-y-3">
                            <!-- Custom GAT Dropdowns injected via JS -->
                        </div>
                    </div>

                    <!-- Fixed Standard Specifications -->
                    <div id="detail-modal-fixed-section" class="pt-3 border-t border-gray-100 space-y-2">
                        <span class="block text-xs font-semibold uppercase tracking-wider text-gray-500">Spesifikasi Standar Unit</span>
                        <div id="detail-modal-fixed-list" class="rounded-2xl bg-gray-50 border border-gray-200/80 p-3 space-y-1.5 text-xs">
                            <!-- Fixed key-value specs injected via JS -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Sticky Footer: Quantity & Cart Actions -->
            <div class="px-5 sm:px-6 py-4 border-t border-gray-100 bg-gray-50/90 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 shrink-0">
                <div class="flex items-center justify-between sm:justify-start gap-3">
                    <span class="text-xs font-medium text-gray-600">Jumlah Unit (SET):</span>
                    <div class="inline-flex items-center border border-gray-300 rounded-xl overflow-hidden bg-white">
                        <button type="button" id="detail-qty-minus" class="px-3 py-1.5 text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer">-</button>
                        <span id="detail-qty-value" class="px-3.5 py-1.5 text-xs sm:text-sm font-bold text-gray-900 min-w-[36px] text-center">1</span>
                        <button type="button" id="detail-qty-plus" class="px-3 py-1.5 text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer">+</button>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <button type="button" id="detail-save-only-btn"
                        class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-100 text-gray-800 font-semibold text-xs transition-colors cursor-pointer">
                        <span>+ Simpan ke Keranjang</span>
                    </button>

                    <button type="button" id="detail-save-and-checkout-btn"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs sm:text-sm transition-colors shadow-sm cursor-pointer">
                        <span id="detail-primary-btn-label">Masukkan &amp; Lanjut Quote</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered Pop-Up Modal Wrapper -->
    <div id="cart-modal-wrapper"
        class="fixed inset-0 z-[150] hidden items-center justify-center p-4 sm:p-6 font-['Questrial',sans-serif]"
        role="dialog" aria-modal="true" aria-labelledby="cart-modal-title">

        <!-- Backdrop -->
        <div id="cart-modal-backdrop"
            class="fixed inset-0 bg-black/75 backdrop-blur-sm opacity-0 transition-opacity duration-200"></div>

        <!-- Centered Modal Card (Clean Corporate White - Zero Neon) -->
        <div id="cart-modal-card"
            data-lenis-prevent
            class="relative z-10 w-full max-w-xl max-h-[90vh] bg-white border border-gray-200 rounded-3xl shadow-[0_24px_64px_rgba(0,0,0,0.45)] text-gray-900 flex flex-col overflow-hidden opacity-0 scale-95 transition-all duration-200 ease-out">

            <!-- Modal Header -->
            <div class="px-5 sm:px-6 py-4 border-b border-gray-100 flex items-center justify-between shrink-0 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 id="cart-modal-title" class="text-sm sm:text-base font-bold font-agrandir font-['Agrandir',sans-serif] text-gray-900 leading-snug">
                            Form Pemesanan &amp; Pembayaran B2B
                        </h3>
                        <p class="text-[11px] sm:text-xs text-gray-500" id="cart-drawer-count-label">0 jenis produk (0 unit)</p>
                    </div>
                </div>

                <button type="button" id="cart-modal-close"
                    class="p-2 rounded-xl text-gray-400 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer"
                    title="Tutup Form">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Scrollable Body -->
            <form id="b2b-checkout-modal-form" method="POST" action="{{ route('checkout.initiate') }}"
                data-lenis-prevent
                class="flex-1 overflow-y-auto px-5 sm:px-6 py-4 space-y-4 bg-white">
                @csrf
                <input type="hidden" name="cart_items_json" id="cart-items-json-input" value="{{ old('cart_items_json', '[]') }}">

                <!-- Honeypot Anti-Bot Field (Perangkap Bot Tersembunyi - Zero Captcha) -->
                <div class="hidden pointer-events-none absolute -left-[9999px]" aria-hidden="true">
                    <label for="b2b_fax_reference">Do not fill this field</label>
                    <input type="text" name="b2b_fax_reference" id="b2b_fax_reference" tabindex="-1" autocomplete="off" value="">
                </div>

                @if ($errors->any())
                    <div class="p-3 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                        <p class="font-semibold text-red-900">Mohon periksa kembali data pengajuan Anda:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Section 1: Selected Cart Items -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Daftar Produk Dipilih</span>
                        <div class="flex items-center gap-3 text-[11px]">
                            <button type="button" id="cart-continue-shopping" class="text-gray-700 hover:text-red-600 font-semibold transition-colors cursor-pointer">
                                + Tambah Produk Lain
                            </button>
                            <span class="text-gray-300">|</span>
                            <button type="button" id="cart-clear-btn" class="text-gray-400 hover:text-red-600 transition-colors cursor-pointer">
                                Kosongkan
                            </button>
                        </div>
                    </div>

                    <div id="cart-items-container" class="space-y-2.5 max-h-56 overflow-y-auto pr-1" data-lenis-prevent>
                        <!-- Injected dynamically via JS -->
                    </div>
                </div>

                <!-- Section 2: Corporate Buyer Form -->
                <div class="pt-3 border-t border-gray-100 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Identitas Pemesan Korporat</span>
                        <span class="text-[11px] text-gray-400"><span class="text-red-600">*</span> Wajib diisi</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="modal-pic-name" class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap PIC <span class="text-red-600">*</span></label>
                            <input type="text" id="modal-pic-name" name="pic_name" required maxlength="120"
                                value="{{ old('pic_name') }}"
                                placeholder="Contoh: Budi Santoso"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div>
                            <label for="modal-company-name" class="block text-xs font-medium text-gray-700 mb-1">Nama Perusahaan / PT <span class="text-red-600">*</span></label>
                            <input type="text" id="modal-company-name" name="company_name" required maxlength="160"
                                value="{{ old('company_name') }}"
                                placeholder="Contoh: PT Manufaktur Presisi"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div>
                            <label for="modal-company-email" class="block text-xs font-medium text-gray-700 mb-1">Email Korporat <span class="text-red-600">*</span></label>
                            <input type="email" id="modal-company-email" name="company_email" required maxlength="160"
                                value="{{ old('company_email') }}"
                                placeholder="procurement@perusahaan.co.id"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div>
                            <label for="modal-company-phone" class="block text-xs font-medium text-gray-700 mb-1">No. Telepon / WhatsApp <span class="text-red-600">*</span></label>
                            <input type="tel" id="modal-company-phone" name="company_phone" required maxlength="25"
                                value="{{ old('company_phone') }}"
                                placeholder="0812xxxxxxxx atau 62812xxxxxxxx"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="modal-company-address" class="block text-xs font-medium text-gray-700 mb-1">Alamat Lengkap Perusahaan (BILL TO) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="text" id="modal-company-address" name="company_address" maxlength="500"
                                value="{{ old('company_address') }}"
                                placeholder="Contoh: Jl. Kawasan Industri Jababeka Blok C No. 12, Cikarang, Jawa Barat"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="modal-npwp" class="block text-xs font-medium text-gray-700 mb-1">NPWP Perusahaan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="text" id="modal-npwp" name="npwp" maxlength="40"
                                value="{{ old('npwp') }}"
                                placeholder="Untuk keperluan Faktur Pajak PPN & PPh 23"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="modal-notes" class="block text-xs font-medium text-gray-700 mb-1">Urgensi / Kebutuhan Pesanan <span class="text-red-600">*</span></label>
                            <textarea id="modal-notes" name="notes" required rows="2" maxlength="1000"
                                placeholder="Contoh: Pengadaan mendesak penggantian sensor lini produksi minggu ini / kebutuhan proyek otomasi baru"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-gray-900 focus:outline-none text-xs sm:text-sm text-gray-900 placeholder-gray-400 transition-colors resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5 px-3.5 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-[11px] text-gray-600 leading-relaxed">
                        <svg class="w-4 h-4 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Rincian harga satuan resmi B2B, perhitungan PPN 11% &amp; PPh 23, serta dokumen <strong class="text-gray-900 font-semibold">Sales Quote</strong> akan dibuka pada halaman pembayaran terenkripsi setelah form ini dikirim.</span>
                    </div>
                </div>
            </form>

            <!-- Modal Footer -->
            <div class="px-5 sm:px-6 py-4 border-t border-gray-100 bg-gray-50/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 shrink-0">
                <div>
                    <span class="text-[11px] text-gray-500 block">Total Permintaan</span>
                    <span class="text-sm font-bold font-agrandir font-['Agrandir',sans-serif] text-gray-900" id="cart-subtotal-units">0 Unit (0 SKU)</span>
                </div>

                <button type="submit" form="b2b-checkout-modal-form" id="cart-checkout-btn"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-semibold text-xs sm:text-sm tracking-wide transition-colors shadow-sm cursor-pointer active:scale-[0.99]">
                    <span id="cart-checkout-btn-label">Lanjut ke Halaman Pembayaran</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- JavaScript for Menu Toggle (Safe Guard) -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });
        }
        if (menuClose && mobileMenu) {
            menuClose.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }
    </script>

    <!-- Lenis Smooth Scroll & Scroll Reveal Animation -->
    <script>
        // 1. Initialize Lenis Smooth Scroll
        if (typeof Lenis !== 'undefined') {
            window.lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                orientation: 'vertical',
                gestureOrientation: 'vertical',
                smoothWheel: true,
                wheelMultiplier: 1.0,
                touchMultiplier: 1.8,
                infinite: false,
            });

            function raf(time) {
                window.lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);
        }

        // 2. Scroll Reveal Intersection Observer with Fail-safe
        function initScrollReveal() {
            const elements = document.querySelectorAll('.reveal-on-scroll');
            if (!elements.length) return;

            const observerOptions = {
                threshold: 0.01,
                rootMargin: '100px 0px 50px 0px'
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting || entry.intersectionRatio > 0) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight + 100 && rect.bottom > -100) {
                    el.classList.add('is-revealed');
                } else {
                    revealObserver.observe(el);
                }
            });

            // Fail-safe: ensure all elements become visible even if observer fails or on quick scroll
            setTimeout(() => {
                elements.forEach(el => el.classList.add('is-revealed'));
            }, 2000);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initScrollReveal);
        } else {
            initScrollReveal();
        }
        window.addEventListener('load', initScrollReveal);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const v = document.querySelector('video');
            if (v) {
                v.muted = true;
                v.playsInline = true;
                const playPromise = v.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log('Autoplay:', error);
                    });
                }
            }
        });
    </script>

    <!-- Category Dropdown & Real-Time Instant Search Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const trigger = document.getElementById('category-dropdown-trigger');
            const menu = document.getElementById('category-dropdown-menu');
            const chevron = document.getElementById('category-dropdown-chevron');
            const categoryLabel = document.getElementById('selected-category-label');
            const hiddenCategory = document.getElementById('filter-category-input');
            const form = document.getElementById('product-filter-form');
            const optionBtns = document.querySelectorAll('.category-option-btn');
            
            const searchInput = document.getElementById('product-search-input');
            const clearBtn = document.getElementById('clear-search-btn');
            const cards = document.querySelectorAll('.product-card-item');
            
            // Status Badges & Counters
            const liveStatusContainer = document.getElementById('live-status-container');
            const liveMatchCount = document.getElementById('live-match-count');
            const liveKeywordBadge = document.getElementById('live-keyword-badge');
            const liveKeywordText = document.getElementById('live-keyword-text');
            const liveCategoryBadge = document.getElementById('live-category-badge');
            const liveCategoryText = document.getElementById('live-category-text');
            const liveResetBtn = document.getElementById('live-reset-all-btn');
            
            // Empty State
            const emptyState = document.getElementById('live-search-empty-state');
            const emptyText = document.getElementById('live-search-empty-text');
            const emptyResetBtn = document.getElementById('live-search-empty-reset-btn');

            // 1. Dropdown Open / Close Handling
            if (trigger && menu) {
                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = !menu.classList.contains('hidden');
                    if (isOpen) {
                        menu.classList.add('hidden');
                        if (chevron) chevron.classList.remove('rotate-180');
                    } else {
                        menu.classList.remove('hidden');
                        if (chevron) chevron.classList.add('rotate-180');
                    }
                });

                document.addEventListener('click', (e) => {
                    if (!menu.contains(e.target) && !trigger.contains(e.target)) {
                        menu.classList.add('hidden');
                        if (chevron) chevron.classList.remove('rotate-180');
                    }
                });
            }

            // 2. Update Active Styling pada Pilihan Dropdown
            function updateDropdownActiveState(selectedSlug) {
                optionBtns.forEach(btn => {
                    const slug = btn.getAttribute('data-slug');
                    const badgePill = btn.querySelector('span:last-child');
                    const isSelected = (slug === selectedSlug) || (selectedSlug === 'all' && slug === 'all');

                    if (isSelected) {
                        btn.className = 'category-option-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs sm:text-sm font-bold bg-red-600 text-white shadow-sm transition-colors';
                        if (badgePill) {
                            badgePill.className = 'ml-2 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-white/20 text-white';
                        }
                    } else {
                        btn.className = 'category-option-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold text-gray-900 bg-white hover:bg-gray-100 hover:text-black transition-colors';
                        if (badgePill) {
                            badgePill.className = 'ml-2 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-700';
                        }
                    }
                });
            }

            // 3. Core Instant Filter Logic (0ms Client-Side, Tanpa Refresh)
            function applyFilter(shouldScroll = false) {
                const currentCat = (hiddenCategory ? hiddenCategory.value : 'all').toLowerCase().trim();
                const rawKeyword = searchInput ? searchInput.value.trim() : '';
                const keyword = rawKeyword.toLowerCase();

                // Toggle Clear Button
                if (clearBtn) {
                    if (keyword !== '') {
                        clearBtn.classList.remove('hidden');
                    } else {
                        clearBtn.classList.add('hidden');
                    }
                }

                let visibleCount = 0;
                let firstMatchingCard = null;

                cards.forEach(card => {
                    const cardName = card.getAttribute('data-name') || '';
                    const cardSku = card.getAttribute('data-sku') || '';
                    const cardCat = card.getAttribute('data-category') || '';
                    const cardBadges = card.getAttribute('data-badges') || '';
                    const cardDesc = card.getAttribute('data-desc') || '';

                    // Evaluasi Kategori
                    const matchCategory = (currentCat === 'all' || currentCat === '' || cardCat === currentCat);

                    // Evaluasi Kata Kunci (Real-Time substring matching)
                    let matchSearch = true;
                    if (keyword !== '') {
                        matchSearch = cardName.includes(keyword) ||
                                      cardSku.includes(keyword) ||
                                      cardBadges.includes(keyword) ||
                                      cardDesc.includes(keyword) ||
                                      cardCat.includes(keyword);
                    }

                    if (matchCategory && matchSearch) {
                        card.style.display = '';
                        card.classList.add('is-revealed');
                        visibleCount++;
                        if (!firstMatchingCard) {
                            firstMatchingCard = card;
                        }
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update Counter
                if (liveMatchCount) {
                    liveMatchCount.textContent = visibleCount;
                }

                // Update Active Filter Badges
                const hasSearch = keyword !== '';
                const hasCategory = currentCat !== 'all' && currentCat !== '';

                if (liveKeywordBadge && liveKeywordText) {
                    if (hasSearch) {
                        liveKeywordBadge.classList.remove('hidden');
                        liveKeywordText.textContent = `"${rawKeyword}"`;
                    } else {
                        liveKeywordBadge.classList.add('hidden');
                    }
                }

                if (liveCategoryBadge && liveCategoryText) {
                    if (hasCategory) {
                        liveCategoryBadge.classList.remove('hidden');
                        liveCategoryText.textContent = categoryLabel ? categoryLabel.textContent.trim() : currentCat;
                    } else {
                        liveCategoryBadge.classList.add('hidden');
                    }
                }

                if (liveStatusContainer) {
                    if (hasSearch || hasCategory) {
                        liveStatusContainer.classList.remove('hidden');
                    } else {
                        liveStatusContainer.classList.add('hidden');
                    }
                }

                // Empty State Handler
                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.classList.remove('hidden');
                        if (emptyText) {
                            if (hasSearch && hasCategory) {
                                emptyText.textContent = `Tidak ada produk dengan kata kunci "${rawKeyword}" di kategori "${categoryLabel ? categoryLabel.textContent.trim() : currentCat}".`;
                            } else if (hasSearch) {
                                emptyText.textContent = `Tidak ada produk yang cocok dengan kata kunci "${rawKeyword}".`;
                            } else {
                                emptyText.textContent = `Belum ada produk untuk kategori ini.`;
                            }
                        }
                    } else {
                        emptyState.classList.add('hidden');
                    }
                }

                // Update URL Query Parameters Secara Senyap (History replaceState tanpa reload)
                const currentUrl = new URL(window.location.href);
                if (hasCategory) {
                    currentUrl.searchParams.set('category', currentCat);
                } else {
                    currentUrl.searchParams.delete('category');
                }

                if (hasSearch) {
                    currentUrl.searchParams.set('search', rawKeyword);
                } else {
                    currentUrl.searchParams.delete('search');
                }
                window.history.replaceState({}, '', currentUrl.toString());

                // 4. Langsung Lompat ke Barang (Enter Key Action) - Clean Smooth Scroll (Tanpa Efek Neon)
                if (shouldScroll && firstMatchingCard) {
                    if (window.lenis && typeof window.lenis.scrollTo === 'function') {
                        window.lenis.scrollTo(firstMatchingCard, { offset: -110, duration: 1.2 });
                    } else {
                        firstMatchingCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }

                    // Lepaskan focus input pada mobile agar keyboard tertutup
                    if (window.innerWidth < 768 && searchInput) {
                        searchInput.blur();
                    }
                }
            }

            // 5. Event Listener: Real-Time Instant Search saat mengetik (0ms latency)
            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    applyFilter(false);
                });

                // Event Listener: Tekan Enter -> Langsung scroll ke barang tanpa refresh!
                searchInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault(); // MENCEGAH PAGE REFRESH!
                        applyFilter(true);  // Filter dan langsung scroll ke barang!
                    }
                });
            }

            // 6. Form Submit Listener & Tombol Lensa Merah -> Cegah Refresh & Scroll ke Barang
            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault(); // MENCEGAH PAGE REFRESH!
                    applyFilter(true);
                });
            }

            // 7. Event Listener: Klik Pilihan Dropdown Kategori
            optionBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const slug = btn.getAttribute('data-slug');
                    const catNameSpan = btn.querySelector('span:first-child');
                    const catName = catNameSpan ? catNameSpan.textContent.trim() : 'Semua Kategori';

                    if (hiddenCategory) {
                        hiddenCategory.value = slug;
                    }
                    if (categoryLabel) {
                        categoryLabel.textContent = catName;
                    }

                    // Tutup dropdown menu
                    if (menu) menu.classList.add('hidden');
                    if (chevron) chevron.classList.remove('rotate-180');

                    // Update styling tombol dropdown
                    updateDropdownActiveState(slug);

                    // Terapkan filter langsung tanpa refresh
                    applyFilter(false);
                });
            });

            // 8. Event Listener: Clear Search Button (Tombol Silang)
            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    if (searchInput) {
                        searchInput.value = '';
                        searchInput.focus();
                    }
                    applyFilter(false);
                });
            }

            // 9. Reset Filter Helpers
            function resetAllFilters() {
                if (hiddenCategory) hiddenCategory.value = 'all';
                if (categoryLabel) categoryLabel.textContent = 'Semua Kategori';
                if (searchInput) searchInput.value = '';
                updateDropdownActiveState('all');
                applyFilter(false);
            }

            if (liveResetBtn) {
                liveResetBtn.addEventListener('click', resetAllFilters);
            }
            if (emptyResetBtn) {
                emptyResetBtn.addEventListener('click', resetAllFilters);
            }

            // 10. Initial execution on page load (sinkronkan URL jika ada)
            const initialCategory = hiddenCategory ? hiddenCategory.value : 'all';
            updateDropdownActiveState(initialCategory);
            applyFilter(false);
        });
    </script>

    @php
        $publicCatalogMap = [];
        foreach ($products as $prod) {
            $publicCatalogMap[$prod->id] = [
                'id' => (int) $prod->id,
                'sku' => (string) $prod->sku,
                'name' => (string) $prod->name,
                'badge_primary' => (string) ($prod->badge_primary ?? ''),
                'badge_secondary' => (string) ($prod->badge_secondary ?? ($prod->category->name ?? 'GAT Product')),
                'image' => (string) $prod->image_url,
                'short_description' => (string) ($prod->short_description ?? ''),
                'description' => (string) ($prod->description ?: ($prod->short_description ?? '')),
                'formatted_price' => (string) $prod->formatted_price,
                'moq' => max(1, (int) ($prod->min_order_quantity ?? 1)),
                'specifications' => is_array($prod->specifications) ? $prod->specifications : [],
            ];
        }
    @endphp

    <!-- B2B Product Detail Spec-Picker & Centered Cart Modal Engine (Zero Price Exposure) -->
    <script>
        const gatCatalogMap = @json($publicCatalogMap);

        // Bersihkan cache keranjang lama yang pernah menyimpan nominal harga
        try {
            localStorage.removeItem('gat_cart');
        } catch (e) {}

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function parseProductSpecs(rawSpecs) {
            const selectable = [];
            const fixed = [];
            if (!rawSpecs || typeof rawSpecs !== 'object') {
                return { selectable, fixed };
            }

            Object.entries(rawSpecs).forEach(([key, val]) => {
                const label = String(key || '').trim();
                if (!label) return;

                let options = [];
                if (Array.isArray(val)) {
                    options = val.map(v => String(v || '').trim()).filter(Boolean);
                } else if (typeof val === 'string' && val.includes(' / ')) {
                    options = val.split(' / ').map(v => v.trim()).filter(Boolean);
                }

                if (options.length > 1) {
                    selectable.push({ label, options });
                } else {
                    const fixedVal = Array.isArray(val) ? (options[0] || '') : String(val || '').trim();
                    if (fixedVal) {
                        fixed.push({ label, value: fixedVal });
                    }
                }
            });

            return { selectable, fixed };
        }

        function normalizeSelectedSpecs(productId, candidateSpecs) {
            const product = gatCatalogMap[productId];
            const cleanCandidate = (candidateSpecs && typeof candidateSpecs === 'object' && !Array.isArray(candidateSpecs))
                ? candidateSpecs
                : {};

            if (!product) {
                const fallback = {};
                Object.entries(cleanCandidate).forEach(([k, v]) => {
                    if (typeof v === 'string' || typeof v === 'number') {
                        fallback[String(k)] = String(v);
                    }
                });
                return fallback;
            }

            const { selectable } = parseProductSpecs(product.specifications);
            const normalized = {};
            selectable.forEach(({ label, options }) => {
                const picked = typeof cleanCandidate[label] === 'string' ? cleanCandidate[label].trim() : '';
                normalized[label] = options.includes(picked) ? picked : options[0];
            });
            return normalized;
        }

        function buildCartSignature(productId, specs) {
            const cleanSpecs = specs && typeof specs === 'object' ? specs : {};
            const sortedPairs = Object.keys(cleanSpecs)
                .sort()
                .map(k => `${k}:${cleanSpecs[k]}`);
            return `${Number(productId)}::${sortedPairs.join('|')}`;
        }

        let gatRfqCart = [];
        try {
            const parsed = JSON.parse(localStorage.getItem('gat_rfq_cart') || '[]');
            if (Array.isArray(parsed)) {
                // Sanitasi ketat: hanya izinkan atribut non-harga + spesifikasi terpilih
                gatRfqCart = parsed.map(item => {
                    const id = Number(item.id) || 0;
                    const catalogItem = gatCatalogMap[id];
                    return {
                        id,
                        name: String(catalogItem ? catalogItem.name : (item.name || '')),
                        sku: String(catalogItem ? catalogItem.sku : (item.sku || '')),
                        image: String(catalogItem ? catalogItem.image : (item.image || '')),
                        qty: Math.max(1, parseInt(item.qty, 10) || 1),
                        specs: normalizeSelectedSpecs(id, item.specs),
                    };
                }).filter(item => item.id > 0 && item.sku !== '');
            }
        } catch (e) {
            gatRfqCart = [];
        }

        function saveCart() {
            localStorage.setItem('gat_rfq_cart', JSON.stringify(gatRfqCart));
            updateCartUI();
        }

        function syncCartHiddenInput() {
            const jsonInput = document.getElementById('cart-items-json-input');
            if (jsonInput) {
                const minimalPayload = gatRfqCart.map(item => ({
                    id: Number(item.id),
                    qty: Number(item.qty),
                    specs: item.specs && typeof item.specs === 'object' ? item.specs : {},
                }));
                jsonInput.value = JSON.stringify(minimalPayload);
            }
        }

        let toastTimer = null;
        function showSpecToast(message) {
            const toast = document.getElementById('spec-added-toast');
            const textEl = document.getElementById('spec-added-toast-text');
            if (!toast || !textEl) return;

            textEl.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-2');
            toast.classList.add('opacity-100', 'translate-y-0');

            if (toastTimer) clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-2');
            }, 2600);
        }

        function updateCartUI() {
            const counter = document.getElementById('cart-counter-badge');
            const countLabel = document.getElementById('cart-drawer-count-label');
            const itemsContainer = document.getElementById('cart-items-container');
            const totalUnitsEl = document.getElementById('cart-subtotal-units');
            const checkoutBtn = document.getElementById('cart-checkout-btn');

            const totalUnits = gatRfqCart.reduce((sum, item) => sum + item.qty, 0);
            const totalSkus = gatRfqCart.length;

            if (counter) counter.textContent = totalUnits;
            if (countLabel) countLabel.textContent = `${totalSkus} item konfigurasi (${totalUnits} unit)`;
            if (totalUnitsEl) totalUnitsEl.textContent = `${totalUnits} Unit (${totalSkus} Baris Quote)`;

            syncCartHiddenInput();

            if (itemsContainer) {
                if (gatRfqCart.length === 0) {
                    itemsContainer.innerHTML = `
                        <div class="py-6 px-4 rounded-2xl bg-gray-50 border border-gray-200 text-center text-gray-500">
                            <p class="text-xs sm:text-sm font-semibold text-gray-900 mb-1">Belum ada produk dipilih</p>
                            <p class="text-[11px] text-gray-500">Tutup pop-up ini dan klik salah satu kartu produk untuk memilih spesifikasi Quotation.</p>
                        </div>
                    `;
                    if (checkoutBtn) {
                        checkoutBtn.disabled = true;
                        checkoutBtn.classList.add('opacity-50', 'pointer-events-none');
                    }
                } else {
                    if (checkoutBtn) {
                        checkoutBtn.disabled = false;
                        checkoutBtn.classList.remove('opacity-50', 'pointer-events-none');
                    }
                    itemsContainer.innerHTML = gatRfqCart.map((item, idx) => {
                        const specEntries = item.specs && typeof item.specs === 'object' ? Object.entries(item.specs) : [];
                        const specsBadgesHtml = specEntries.length > 0
                            ? `<div class="mt-1.5 flex flex-wrap gap-1">
                                ${specEntries.map(([k, v]) => `
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white border border-gray-200 text-[10px] text-gray-700 leading-tight">
                                        <span class="text-gray-400 mr-1">${escapeHtml(k)}:</span>
                                        <strong class="font-semibold text-gray-900">${escapeHtml(v)}</strong>
                                    </span>
                                `).join('')}
                               </div>`
                            : '';

                        const canEditSpec = Boolean(gatCatalogMap[item.id]);

                        return `
                            <div class="flex items-start gap-3 p-3 rounded-2xl bg-gray-50 border border-gray-200/90 hover:border-gray-300 transition-colors">
                                <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}" class="w-12 h-12 object-contain rounded-xl bg-white p-1 shrink-0 border border-gray-200 mt-0.5">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs sm:text-[13px] font-bold font-agrandir text-gray-900 leading-snug line-clamp-1" title="${escapeHtml(item.name)}">${escapeHtml(item.name)}</h4>
                                    <div class="flex flex-wrap items-center gap-2 mt-0.5">
                                        <span class="text-[10px] text-gray-500 font-mono">SKU: ${escapeHtml(item.sku)}</span>
                                        ${canEditSpec ? `
                                            <button type="button" onclick="editCartItemSpecs(${idx})" class="text-[10px] font-semibold text-red-600 hover:text-red-700 underline underline-offset-2 cursor-pointer">
                                                Ubah Spek
                                            </button>
                                        ` : ''}
                                    </div>
                                    ${specsBadgesHtml}
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0 mt-0.5">
                                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white">
                                        <button type="button" class="px-2 py-1 text-xs text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer" onclick="changeCartQty(${idx}, -1)">-</button>
                                        <span class="px-2 py-1 text-xs font-bold text-gray-900 min-w-[22px] text-center">${Number(item.qty)}</span>
                                        <button type="button" class="px-2 py-1 text-xs text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors cursor-pointer" onclick="changeCartQty(${idx}, 1)">+</button>
                                    </div>
                                    <button type="button" class="p-1.5 text-gray-400 hover:text-red-600 transition-colors cursor-pointer" onclick="removeCartItem(${idx})" title="Hapus produk">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        `;
                    }).join('');
                }
            }
        }

        window.changeCartQty = function(idx, delta) {
            if (idx < 0 || idx >= gatRfqCart.length) return;
            gatRfqCart[idx].qty += delta;
            if (gatRfqCart[idx].qty <= 0) {
                gatRfqCart.splice(idx, 1);
            }
            saveCart();
        };

        window.removeCartItem = function(idx) {
            if (idx < 0 || idx >= gatRfqCart.length) return;
            gatRfqCart.splice(idx, 1);
            saveCart();
        };

        // =========================================================================
        // PRODUCT DETAIL & SPECIFICATION PICKER MODAL LOGIC
        // =========================================================================
        let activeDetailState = {
            productId: null,
            qty: 1,
            moq: 1,
            selectedSpecs: {},
            editingCartIndex: null,
        };

        function syncBodyScrollLock() {
            const detailWrapper = document.getElementById('product-detail-modal-wrapper');
            const cartWrapper = document.getElementById('cart-modal-wrapper');
            const anyOpen = (detailWrapper && !detailWrapper.classList.contains('hidden'))
                || (cartWrapper && !cartWrapper.classList.contains('hidden'));

            if (anyOpen) {
                document.body.classList.add('overflow-hidden');
                if (window.lenis && typeof window.lenis.stop === 'function') {
                    window.lenis.stop();
                }
            } else {
                document.body.classList.remove('overflow-hidden');
                if (window.lenis && typeof window.lenis.start === 'function') {
                    window.lenis.start();
                }
            }
        }

        function closeAllSpecDropdowns(exceptWrapper = null) {
            const selectableList = document.getElementById('detail-modal-selectable-list');
            if (!selectableList) return;

            selectableList.querySelectorAll('.spec-dropdown-wrapper').forEach(wrapper => {
                if (exceptWrapper && wrapper === exceptWrapper) return;
                wrapper.classList.remove('z-40');
                wrapper.classList.add('z-10');
                const menuEl = wrapper.querySelector('.spec-dropdown-menu');
                const chevronEl = wrapper.querySelector('.spec-dropdown-chevron');
                const triggerEl = wrapper.querySelector('.spec-dropdown-trigger');
                if (menuEl) menuEl.classList.add('hidden');
                if (chevronEl) chevronEl.classList.remove('rotate-180');
                if (triggerEl) triggerEl.setAttribute('aria-expanded', 'false');
            });
        }

        function renderDetailSpecOptions() {
            const product = gatCatalogMap[activeDetailState.productId];
            if (!product) return;

            const { selectable, fixed } = parseProductSpecs(product.specifications);
            const selectableSection = document.getElementById('detail-modal-selectable-section');
            const selectableList = document.getElementById('detail-modal-selectable-list');
            const fixedSection = document.getElementById('detail-modal-fixed-section');
            const fixedList = document.getElementById('detail-modal-fixed-list');
            const scrollBody = document.getElementById('detail-modal-scroll-body');

            if (selectableSection && selectableList) {
                if (selectable.length === 0) {
                    selectableSection.classList.add('hidden');
                    selectableList.innerHTML = '';
                } else {
                    selectableSection.classList.remove('hidden');
                    selectableList.innerHTML = selectable.map(({ label, options }, groupIdx) => {
                        const currentPick = activeDetailState.selectedSpecs[label] || options[0];
                        return `
                            <div class="spec-dropdown-wrapper relative z-10" data-group-index="${groupIdx}">
                                <div class="flex items-center justify-between mb-1.5 px-0.5">
                                    <span class="text-xs font-semibold text-gray-800">${escapeHtml(label)}</span>
                                    <span class="text-[10px] font-medium text-gray-400">${options.length} pilihan</span>
                                </div>

                                <!-- Custom Website Dropdown Trigger (Clean White Pill, Black Text, Red Icon & Chevron) -->
                                <button type="button"
                                    aria-expanded="false"
                                    class="spec-dropdown-trigger w-full flex items-center justify-between gap-3 px-4 py-2.5 rounded-full bg-white text-gray-900 border border-gray-200 shadow-[0_3px_12px_rgba(0,0,0,0.06)] hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-600/35 cursor-pointer text-left">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <svg class="w-3.5 h-3.5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                        </svg>
                                        <span class="spec-selected-label truncate text-xs sm:text-[13px] font-semibold tracking-wide text-gray-900">
                                            ${escapeHtml(currentPick)}
                                        </span>
                                    </div>
                                    <svg class="spec-dropdown-chevron w-4 h-4 text-gray-500 transition-transform duration-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu Panel (Clean White Card, Active Option Red Pill - Identik dengan Website) -->
                                <div data-lenis-prevent
                                    class="spec-dropdown-menu absolute top-full left-0 mt-1.5 hidden z-50 w-full rounded-2xl bg-white border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.28)] p-1.5 space-y-1 max-h-52 overflow-y-auto transition-all duration-150">
                                    ${options.map((opt, optIdx) => {
                                        const isSelected = opt === currentPick;
                                        const itemClasses = isSelected
                                            ? 'bg-red-600 text-white font-bold shadow-sm'
                                            : 'text-gray-900 bg-white hover:bg-gray-100 hover:text-black font-semibold';
                                        return `
                                            <button type="button"
                                                data-spec-group="${groupIdx}"
                                                data-spec-option="${optIdx}"
                                                class="spec-dropdown-option w-full flex items-center justify-between gap-2.5 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] transition-colors text-left cursor-pointer ${itemClasses}">
                                                <span class="leading-snug">${escapeHtml(opt)}</span>
                                                ${isSelected ? `
                                                    <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                ` : ''}
                                            </button>
                                        `;
                                    }).join('')}
                                </div>
                            </div>
                        `;
                    }).join('');

                    selectableList.querySelectorAll('.spec-dropdown-wrapper').forEach(wrapper => {
                        const triggerEl = wrapper.querySelector('.spec-dropdown-trigger');
                        const menuEl = wrapper.querySelector('.spec-dropdown-menu');
                        const chevronEl = wrapper.querySelector('.spec-dropdown-chevron');

                        if (triggerEl && menuEl) {
                            triggerEl.addEventListener('click', (e) => {
                                e.stopPropagation();
                                const isOpen = !menuEl.classList.contains('hidden');
                                closeAllSpecDropdowns(wrapper);

                                if (isOpen) {
                                    wrapper.classList.remove('z-40');
                                    wrapper.classList.add('z-10');
                                    menuEl.classList.add('hidden');
                                    if (chevronEl) chevronEl.classList.remove('rotate-180');
                                    triggerEl.setAttribute('aria-expanded', 'false');
                                } else {
                                    // Auto-flip ke atas jika posisi dropdown berada di bagian bawah modal agar tidak terpotong
                                    if (scrollBody) {
                                        const triggerRect = triggerEl.getBoundingClientRect();
                                        const scrollRect = scrollBody.getBoundingClientRect();
                                        const spaceBelow = scrollRect.bottom - triggerRect.bottom;
                                        const spaceAbove = triggerRect.top - scrollRect.top;

                                        if (spaceBelow < 215 && spaceAbove > spaceBelow) {
                                            menuEl.classList.remove('top-full', 'mt-1.5');
                                            menuEl.classList.add('bottom-full', 'mb-1.5');
                                        } else {
                                            menuEl.classList.remove('bottom-full', 'mb-1.5');
                                            menuEl.classList.add('top-full', 'mt-1.5');
                                        }
                                    }

                                    wrapper.classList.remove('z-10');
                                    wrapper.classList.add('z-40');
                                    menuEl.classList.remove('hidden');
                                    if (chevronEl) chevronEl.classList.add('rotate-180');
                                    triggerEl.setAttribute('aria-expanded', 'true');
                                }
                            });
                        }
                    });

                    selectableList.querySelectorAll('.spec-dropdown-option').forEach(optBtn => {
                        optBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            const gIdx = parseInt(optBtn.getAttribute('data-spec-group'), 10);
                            const oIdx = parseInt(optBtn.getAttribute('data-spec-option'), 10);
                            const group = selectable[gIdx];
                            if (group && group.options[oIdx] !== undefined) {
                                activeDetailState.selectedSpecs[group.label] = group.options[oIdx];
                                renderDetailSpecOptions();
                            }
                        });
                    });
                }
            }

            if (fixedSection && fixedList) {
                if (fixed.length === 0) {
                    fixedSection.classList.add('hidden');
                    fixedList.innerHTML = '';
                } else {
                    fixedSection.classList.remove('hidden');
                    fixedList.innerHTML = fixed.map(({ label, value }) => `
                        <div class="flex items-start justify-between gap-3 py-1 border-b border-gray-200/60 last:border-b-0">
                            <span class="text-gray-500 shrink-0">${escapeHtml(label)}</span>
                            <span class="text-gray-900 font-medium text-right">${escapeHtml(value)}</span>
                        </div>
                    `).join('');
                }
            }
        }

        function updateDetailQtyUI() {
            const qtyValEl = document.getElementById('detail-qty-value');
            if (qtyValEl) {
                qtyValEl.textContent = String(activeDetailState.qty);
            }
        }

        function openProductDetailModal(productId, options = {}) {
            const product = gatCatalogMap[productId];
            if (!product) return;

            const wrapper = document.getElementById('product-detail-modal-wrapper');
            const backdrop = document.getElementById('product-detail-modal-backdrop');
            const card = document.getElementById('product-detail-modal-card');
            if (!wrapper || !backdrop || !card) return;

            const editingIdx = (typeof options.editingCartIndex === 'number' && gatRfqCart[options.editingCartIndex])
                ? options.editingCartIndex
                : null;

            const initialSpecs = editingIdx !== null
                ? normalizeSelectedSpecs(product.id, gatRfqCart[editingIdx].specs)
                : normalizeSelectedSpecs(product.id, {});

            const initialQty = editingIdx !== null
                ? Math.max(product.moq, gatRfqCart[editingIdx].qty)
                : product.moq;

            activeDetailState = {
                productId: product.id,
                qty: initialQty,
                moq: product.moq,
                selectedSpecs: initialSpecs,
                editingCartIndex: editingIdx,
            };

            // Populate Visuals & Texts
            const badgePrimaryEl = document.getElementById('detail-modal-badge-primary');
            const badgeSecondaryEl = document.getElementById('detail-modal-badge-secondary');
            const imgEl = document.getElementById('detail-modal-image');
            const skuEl = document.getElementById('detail-modal-sku');
            const moqEl = document.getElementById('detail-modal-moq-label');
            const priceEl = document.getElementById('detail-modal-price-label');
            const titleEl = document.getElementById('detail-modal-title');
            const descEl = document.getElementById('detail-modal-description');
            const saveOnlyBtn = document.getElementById('detail-save-only-btn');
            const primaryBtnLabel = document.getElementById('detail-primary-btn-label');

            if (badgePrimaryEl) {
                if (product.badge_primary) {
                    badgePrimaryEl.textContent = product.badge_primary;
                    badgePrimaryEl.classList.remove('hidden');
                } else {
                    badgePrimaryEl.classList.add('hidden');
                }
            }
            if (badgeSecondaryEl) badgeSecondaryEl.textContent = product.badge_secondary;
            if (imgEl) {
                imgEl.src = product.image;
                imgEl.alt = product.name;
            }
            if (skuEl) skuEl.textContent = product.sku;
            if (moqEl) moqEl.textContent = `${product.moq} SET`;
            if (priceEl) priceEl.textContent = product.formatted_price;
            if (titleEl) titleEl.textContent = product.name;
            if (descEl) descEl.textContent = product.description;

            if (saveOnlyBtn) {
                if (editingIdx !== null) {
                    saveOnlyBtn.classList.add('hidden');
                } else {
                    saveOnlyBtn.classList.remove('hidden');
                }
            }
            if (primaryBtnLabel) {
                primaryBtnLabel.textContent = editingIdx !== null
                    ? 'Simpan Perubahan Spesifikasi'
                    : 'Masukkan & Lanjut Quote';
            }

            renderDetailSpecOptions();
            updateDetailQtyUI();

            wrapper.classList.remove('hidden');
            wrapper.classList.add('flex');
            syncBodyScrollLock();

            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                card.classList.remove('opacity-0', 'scale-95');
                card.classList.add('opacity-100', 'scale-100');
            });
        }

        function closeProductDetailModal(onClosedCallback) {
            const wrapper = document.getElementById('product-detail-modal-wrapper');
            const backdrop = document.getElementById('product-detail-modal-backdrop');
            const card = document.getElementById('product-detail-modal-card');
            if (!wrapper || !backdrop || !card) return;

            backdrop.classList.add('opacity-0');
            card.classList.remove('opacity-100', 'scale-100');
            card.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                wrapper.classList.add('hidden');
                wrapper.classList.remove('flex');
                syncBodyScrollLock();
                if (typeof onClosedCallback === 'function') {
                    onClosedCallback();
                }
            }, 180);
        }

        function commitDetailProductToCart(openCheckoutModalAfter) {
            const product = gatCatalogMap[activeDetailState.productId];
            if (!product) return;

            const chosenSpecs = normalizeSelectedSpecs(product.id, activeDetailState.selectedSpecs);
            const targetSignature = buildCartSignature(product.id, chosenSpecs);
            const qtyToCommit = Math.max(product.moq, activeDetailState.qty);

            if (activeDetailState.editingCartIndex !== null && gatRfqCart[activeDetailState.editingCartIndex]) {
                const editIdx = activeDetailState.editingCartIndex;
                // Cek apakah ada baris lain di keranjang dengan produk + spek yang persis sama
                const duplicateIdx = gatRfqCart.findIndex((item, idx) =>
                    idx !== editIdx && buildCartSignature(item.id, item.specs) === targetSignature
                );

                if (duplicateIdx !== -1) {
                    gatRfqCart[duplicateIdx].qty += qtyToCommit;
                    gatRfqCart.splice(editIdx, 1);
                } else {
                    gatRfqCart[editIdx].qty = qtyToCommit;
                    gatRfqCart[editIdx].specs = chosenSpecs;
                }
            } else {
                const existing = gatRfqCart.find(item => buildCartSignature(item.id, item.specs) === targetSignature);
                if (existing) {
                    existing.qty += qtyToCommit;
                } else {
                    gatRfqCart.push({
                        id: product.id,
                        name: product.name,
                        sku: product.sku,
                        image: product.image,
                        qty: qtyToCommit,
                        specs: chosenSpecs,
                    });
                }
            }

            saveCart();

            const wasEditing = activeDetailState.editingCartIndex !== null;
            closeProductDetailModal(() => {
                if (openCheckoutModalAfter || wasEditing) {
                    openCartModal();
                } else {
                    showSpecToast(`${product.sku} berhasil ditambahkan ke keranjang.`);
                }
            });
        }

        window.editCartItemSpecs = function(idx) {
            const item = gatRfqCart[idx];
            if (!item || !gatCatalogMap[item.id]) return;
            closeCartModal(() => {
                openProductDetailModal(item.id, { editingCartIndex: idx });
            });
        };

        function openCartModal() {
            const wrapper = document.getElementById('cart-modal-wrapper');
            const backdrop = document.getElementById('cart-modal-backdrop');
            const card = document.getElementById('cart-modal-card');
            if (!wrapper || !backdrop || !card) return;

            syncCartHiddenInput();
            wrapper.classList.remove('hidden');
            wrapper.classList.add('flex');
            syncBodyScrollLock();

            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                card.classList.remove('opacity-0', 'scale-95');
                card.classList.add('opacity-100', 'scale-100');
            });
        }

        function closeCartModal(onClosedCallback) {
            const wrapper = document.getElementById('cart-modal-wrapper');
            const backdrop = document.getElementById('cart-modal-backdrop');
            const card = document.getElementById('cart-modal-card');
            if (!wrapper || !backdrop || !card) return;

            backdrop.classList.add('opacity-0');
            card.classList.remove('opacity-100', 'scale-100');
            card.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                wrapper.classList.add('hidden');
                wrapper.classList.remove('flex');
                syncBodyScrollLock();
                if (typeof onClosedCallback === 'function') {
                    onClosedCallback();
                }
            }, 180);
        }

        const buyerFieldIds = [
            'modal-pic-name',
            'modal-company-name',
            'modal-company-email',
            'modal-company-phone',
            'modal-company-address',
            'modal-npwp',
            'modal-notes',
        ];

        function saveBuyerDraft() {
            try {
                const draft = {};
                buyerFieldIds.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) draft[id] = el.value;
                });
                localStorage.setItem('gat_rfq_buyer', JSON.stringify(draft));
            } catch (e) {}
        }

        function restoreBuyerDraft() {
            try {
                const draft = JSON.parse(localStorage.getItem('gat_rfq_buyer') || '{}');
                if (draft && typeof draft === 'object') {
                    buyerFieldIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el && !el.value && typeof draft[id] === 'string') {
                            el.value = draft[id];
                        }
                    });
                }
            } catch (e) {}
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartUI();
            restoreBuyerDraft();

            buyerFieldIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', saveBuyerDraft);
            });

            // Buka otomatis jika ada error validasi form dari server atau kembali dari tombol "Ubah di Keranjang"
            const hasValidationErrors = @json($errors->any());
            const urlParams = new URLSearchParams(window.location.search);
            const shouldEditCart = urlParams.get('edit_cart') === '1';

            if (hasValidationErrors || shouldEditCart) {
                openCartModal();
                if (shouldEditCart) {
                    urlParams.delete('edit_cart');
                    const cleanSearch = urlParams.toString();
                    const cleanUrl = window.location.pathname + (cleanSearch ? `?${cleanSearch}` : '');
                    window.history.replaceState({}, '', cleanUrl);
                }
            }

            // Klik pada masing-masing Product Card -> buka Pop-Out Keterangan Barang & Pilih Spesifikasi
            document.querySelectorAll('.product-card-item').forEach(cardEl => {
                cardEl.addEventListener('click', () => {
                    const id = parseInt(cardEl.getAttribute('data-product-id'), 10);
                    if (id) openProductDetailModal(id);
                });
                cardEl.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const id = parseInt(cardEl.getAttribute('data-product-id'), 10);
                        if (id) openProductDetailModal(id);
                    }
                });
            });

            // Klik tombol "Pilih Spek" di dalam Card -> buka Pop-Out yang sama
            document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const id = parseInt(btn.getAttribute('data-id'), 10);
                    if (id) openProductDetailModal(id);
                });
            });

            // Kontrol Pop-Out Product Detail & Spec Picker Modal
            const detailCloseBtn = document.getElementById('product-detail-modal-close');
            const detailBackdrop = document.getElementById('product-detail-modal-backdrop');
            const detailQtyMinus = document.getElementById('detail-qty-minus');
            const detailQtyPlus = document.getElementById('detail-qty-plus');
            const detailSaveOnlyBtn = document.getElementById('detail-save-only-btn');
            const detailSaveAndCheckoutBtn = document.getElementById('detail-save-and-checkout-btn');

            if (detailCloseBtn) {
                detailCloseBtn.addEventListener('click', () => {
                    const returnToCart = activeDetailState.editingCartIndex !== null;
                    closeProductDetailModal(() => {
                        if (returnToCart) openCartModal();
                    });
                });
            }
            if (detailBackdrop) {
                detailBackdrop.addEventListener('click', () => {
                    const returnToCart = activeDetailState.editingCartIndex !== null;
                    closeProductDetailModal(() => {
                        if (returnToCart) openCartModal();
                    });
                });
            }
            if (detailQtyMinus) {
                detailQtyMinus.addEventListener('click', () => {
                    if (activeDetailState.qty > activeDetailState.moq) {
                        activeDetailState.qty -= 1;
                        updateDetailQtyUI();
                    }
                });
            }
            if (detailQtyPlus) {
                detailQtyPlus.addEventListener('click', () => {
                    if (activeDetailState.qty < 9999) {
                        activeDetailState.qty += 1;
                        updateDetailQtyUI();
                    }
                });
            }
            if (detailSaveOnlyBtn) {
                detailSaveOnlyBtn.addEventListener('click', () => commitDetailProductToCart(false));
            }
            if (detailSaveAndCheckoutBtn) {
                detailSaveAndCheckoutBtn.addEventListener('click', () => commitDetailProductToCart(true));
            }

            // Trigger open modal dari floating cart button
            const trigger = document.getElementById('cart-drawer-trigger');
            if (trigger) trigger.addEventListener('click', openCartModal);

            // Close Cart modal buttons & Escape key
            const closeBtn = document.getElementById('cart-modal-close');
            const backdrop = document.getElementById('cart-modal-backdrop');
            const continueBtn = document.getElementById('cart-continue-shopping');
            if (closeBtn) closeBtn.addEventListener('click', () => closeCartModal());
            if (backdrop) backdrop.addEventListener('click', () => closeCartModal());
            if (continueBtn) continueBtn.addEventListener('click', () => closeCartModal());

            // Tutup dropdown spesifikasi otomatis saat klik di luar area dropdown
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.spec-dropdown-wrapper')) {
                    closeAllSpecDropdowns();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const openSpecMenu = document.querySelector('#detail-modal-selectable-list .spec-dropdown-menu:not(.hidden)');
                    if (openSpecMenu) {
                        closeAllSpecDropdowns();
                        return;
                    }

                    const detailWrapper = document.getElementById('product-detail-modal-wrapper');
                    const cartWrapper = document.getElementById('cart-modal-wrapper');
                    if (detailWrapper && !detailWrapper.classList.contains('hidden')) {
                        const returnToCart = activeDetailState.editingCartIndex !== null;
                        closeProductDetailModal(() => {
                            if (returnToCart) openCartModal();
                        });
                    } else if (cartWrapper && !cartWrapper.classList.contains('hidden')) {
                        closeCartModal();
                    }
                }
            });

            // Clear Cart
            const clearBtn = document.getElementById('cart-clear-btn');
            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    if (gatRfqCart.length > 0 && confirm('Kosongkan semua produk yang dipilih?')) {
                        gatRfqCart = [];
                        saveCart();
                    }
                });
            }

            // Form Submit Guard -> pastikan payload keranjang tersinkronisasi & cegah klik ganda
            const modalForm = document.getElementById('b2b-checkout-modal-form');
            if (modalForm) {
                modalForm.addEventListener('submit', (e) => {
                    if (gatRfqCart.length === 0) {
                        e.preventDefault();
                        return;
                    }
                    syncCartHiddenInput();
                    saveBuyerDraft();
                    const submitBtn = document.getElementById('cart-checkout-btn');
                    const submitLabel = document.getElementById('cart-checkout-btn-label');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-75', 'pointer-events-none');
                    }
                    if (submitLabel) {
                        submitLabel.textContent = 'Menyiapkan Halaman Pembayaran...';
                    }
                });
            }
        });
    </script>
</body>

</html>