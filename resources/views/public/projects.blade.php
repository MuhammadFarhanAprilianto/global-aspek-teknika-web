<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects &amp; Case Studies - PT Global Aspect Technology</title>
    @include('components.seo-meta', [
        'seoTitle' => 'Projects & Case Studies — PT Global Aspect Technology',
        'seoDescription' => 'Verified industrial automation, machine vision inspection, PLC/HMI panel retrofits, and telemetry installations deployed across Indonesia.',
    ])

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Brand Typography (Strictly Questrial & Agrandir) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
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

        /* Subtle Architectural Engineering Grid Background for Minimal Hero */
        .hero-blueprint-grid {
            background-image:
                linear-gradient(to right, rgba(51, 103, 165, 0.06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(51, 103, 165, 0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Scroll Reveal Animation */
        .reveal-on-scroll {
            opacity: 0;
            filter: blur(6px);
            transform: translateY(20px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                        filter 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform, filter;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1 !important;
            filter: blur(0px) !important;
            transform: translateY(0) !important;
        }
        .reveal-stagger-1 { transition-delay: 0.06s; }
        .reveal-stagger-2 { transition-delay: 0.12s; }
        .reveal-stagger-3 { transition-delay: 0.18s; }

        /* Mega Dropdown Hover Handling */
        .mega-dropdown-wrapper {
            position: relative;
        }
        .mega-dropdown-menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%) translateY(8px);
            top: 100%;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s;
            z-index: 1000;
        }
        .mega-dropdown-wrapper:hover .mega-dropdown-menu,
        .mega-dropdown-wrapper:focus-within .mega-dropdown-menu,
        .mega-dropdown-menu:hover {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: translateX(-50%) translateY(0) !important;
        }

        /* Infinite Continuous Logo Marquee */
        @keyframes marqueeScrollLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marqueeScrollRight {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .animate-marquee-left {
            display: flex;
            width: max-content;
            animation: marqueeScrollLeft 45s linear infinite;
        }
        .animate-marquee-right {
            display: flex;
            width: max-content;
            animation: marqueeScrollRight 48s linear infinite;
        }
        .animate-marquee-left-alt {
            display: flex;
            width: max-content;
            animation: marqueeScrollLeft 52s linear infinite;
        }
        .marquee-wrapper:hover .animate-marquee-left,
        .marquee-wrapper:hover .animate-marquee-right,
        .marquee-wrapper:hover .animate-marquee-left-alt {
            animation-play-state: paused;
        }

        /* Full-Bleed Showcase Card Transitions (No Image Zoom — Pure Photo Default, Smooth Slide-Up Overlay on Hover) */
        .showcase-card {
            transition: box-shadow 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .showcase-card:hover {
            box-shadow: 0 22px 46px -14px rgba(15, 23, 42, 0.32);
        }
        .showcase-card .showcase-img {
            transform: none !important;
        }
        .showcase-overlay-bg {
            opacity: 0;
            transition: opacity 0.32s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .showcase-card:hover .showcase-overlay-bg,
        .showcase-card:focus-visible .showcase-overlay-bg {
            opacity: 1;
        }
        /* Staggered Sequential Hover Reveal: 1. Nama PT -> 2. Heading -> 3. Paragraf -> 4. Tombol Panah */
        .showcase-step {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1) 0ms,
                        transform 0.32s cubic-bezier(0.16, 1, 0.3, 1) 0ms;
            will-change: opacity, transform;
        }
        .showcase-card:hover .showcase-step,
        .showcase-card:focus-visible .showcase-step {
            opacity: 1;
            transform: translateY(0);
            transition-duration: 0.42s, 0.48s;
        }
        .showcase-card:hover .showcase-step-1,
        .showcase-card:focus-visible .showcase-step-1 {
            transition-delay: 60ms, 60ms;
        }
        .showcase-card:hover .showcase-step-2,
        .showcase-card:focus-visible .showcase-step-2 {
            transition-delay: 145ms, 145ms;
        }
        .showcase-card:hover .showcase-step-3,
        .showcase-card:focus-visible .showcase-step-3 {
            transition-delay: 230ms, 230ms;
        }
        .showcase-card:hover .showcase-step-4,
        .showcase-card:focus-visible .showcase-step-4 {
            transition-delay: 315ms, 315ms;
        }
        .showcase-arrow-btn {
            background-color: #ffffff;
            color: #000000;
            transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease;
        }
        .showcase-arrow-btn:hover {
            background-color: #3367A5 !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(51, 103, 165, 0.38), 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .showcase-arrow-btn svg {
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .showcase-arrow-btn:hover svg {
            transform: translateX(2.5px);
        }
        /* Guaranteed Multi-line Clamping (Immune to Bootstrap CSS conflicts) */
        .project-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        @media (hover: none) {
            .showcase-overlay-bg,
            .showcase-step {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-slate-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    @php
        $dbProjects = \App\Models\Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $publicMarketingWa = \App\Models\SiteSetting::publicWaNumber();

        $categoryCounts = [
            'all' => $dbProjects->count(),
            'automotive' => 0,
            'fmcg' => 0,
            'pharma' => 0,
            'bms' => 0,
            'packaging' => 0,
        ];

        $preparedProjects = $dbProjects->values()->map(function ($proj, $index) use (&$categoryCounts) {
            $normCat = strtolower((string) ($proj->category ?? 'automotive'));
            if (str_contains($normCat, 'auto')) {
                $catKey = 'automotive';
            } elseif (str_contains($normCat, 'fmcg') || str_contains($normCat, 'food')) {
                $catKey = 'fmcg';
            } elseif (str_contains($normCat, 'pharma')) {
                $catKey = 'pharma';
            } elseif (str_contains($normCat, 'bms') || str_contains($normCat, 'infras') || str_contains($normCat, 'building') || str_contains($normCat, 'smart') || str_contains($normCat, 'util')) {
                $catKey = 'bms';
            } elseif (str_contains($normCat, 'pack') || str_contains($normCat, 'logis')) {
                $catKey = 'packaging';
            } else {
                $catKey = 'automotive';
            }

            $categoryCounts[$catKey]++;

            return [
                'model' => $proj,
                'index' => $index,
                'cat_key' => $catKey,
                'image' => $proj->imageUrl() ?: asset('storage/turnkey_integration.webp'),
                'category_label' => strtoupper($proj->category ?: 'AUTOMATION'),
                'client_label' => $proj->client_name ?: 'Enterprise Manufacturer',
                'year_label' => $proj->year ?: '2024',
            ];
        });

        $totalProjectsCount = $preparedProjects->count();
    @endphp

    <!-- ========================================================================= -->
    <!-- 1. SPLIT CINEMATIC VIDEO HERO HEADER (Gaya 2 + Video Background)          -->
    <!-- ========================================================================= -->
    <section class="relative w-full bg-black text-white pt-32 sm:pt-40 lg:pt-44 pb-14 sm:pb-16 lg:pb-20 overflow-hidden">
        <!-- Full-Bleed Looping Video Background -->
        <div class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none">
            <video autoplay loop muted playsinline preload="auto"
                class="w-full h-full object-cover object-center opacity-70"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/Company_Profile.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/Company_Profile.webm') }}" type="video/webm">
            </video>
            <!-- High-Contrast Editorial Overlay -->
            <div class="absolute inset-0 bg-black/55"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/35 to-black/75"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-end">
                <!-- Left: Headline & Engineering Subtitle -->
                <div class="lg:col-span-7 space-y-4 reveal-on-scroll">
                    <h1 data-lang-en="PROJECTS &amp; CASE STUDIES"
                        data-lang-id="PROYEK &amp; STUDI KASUS"
                        class="text-3xl sm:text-5xl lg:text-[52px] font-bold uppercase font-['Agrandir',sans-serif] tracking-tight text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.65)] leading-[1.08]">
                        PROJECTS &amp; CASE STUDIES
                    </h1>
                    <div class="w-20 h-1.5 bg-[#3367A5] rounded-full shadow-[0_0_16px_rgba(51,103,165,0.85)]"></div>
                    <p data-lang-en="Real-world industrial automation, machine vision quality inspection, and smart telemetry systems engineered for Indonesia's leading manufacturers."
                       data-lang-id="Implementasi nyata otomasi industri, inspeksi mutu visi optik, dan sistem telemetri cerdas bagi manufaktur terkemuka di Indonesia."
                       class="text-sm sm:text-base text-slate-200 font-['Questrial',sans-serif] max-w-xl leading-relaxed">
                        Real-world industrial automation, machine vision quality inspection, and smart telemetry systems engineered for Indonesia's leading manufacturers.
                    </p>
                </div>

                <!-- Right: Solid Clean White Executive KPI Strip -->
                <div class="lg:col-span-5 reveal-on-scroll reveal-stagger-1">
                    <div class="grid grid-cols-3 gap-3 p-4 sm:p-5 rounded-2xl bg-white border-0 shadow-[0_12px_36px_rgba(0,0,0,0.28)]">
                        <div class="px-2 py-1 border-r border-slate-200">
                            <div class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-black">200+</div>
                            <div class="text-[11px] text-black font-['Questrial',sans-serif] mt-0.5 leading-snug" data-lang-en="Projects Completed" data-lang-id="Proyek Selesai">Projects Completed</div>
                        </div>
                        <div class="px-2 py-1 border-r border-slate-200">
                            <div class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-black">200+</div>
                            <div class="text-[11px] text-black font-['Questrial',sans-serif] mt-0.5 leading-snug" data-lang-en="Partner Companies" data-lang-id="Mitra Perusahaan">Partner Companies</div>
                        </div>
                        <div class="px-2 py-1">
                            <div class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-black">375+</div>
                            <div class="text-[11px] text-black font-['Questrial',sans-serif] mt-0.5 leading-snug" data-lang-en="Field Service Reports" data-lang-id="Laporan Servis Lapangan">Field Service Reports</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Pills + Instant Search Bar (Positioned cleanly inside dark Hero above shadow fade) -->
            <div class="mt-10 sm:mt-12 pt-2 flex flex-col lg:flex-row lg:items-center justify-between gap-4 reveal-on-scroll">
                <!-- Category Filter Pills with Live Count Badges -->
                <div class="flex items-center flex-wrap gap-2">
                    @php
                        $filterPills = [
                            ['key' => 'all', 'en' => 'All', 'id' => 'Semua'],
                            ['key' => 'automotive', 'en' => 'Automotive', 'id' => 'Otomotif'],
                            ['key' => 'fmcg', 'en' => 'FMCG & Food', 'id' => 'FMCG & Makanan'],
                            ['key' => 'pharma', 'en' => 'Pharmaceutical', 'id' => 'Farmasi'],
                            ['key' => 'bms', 'en' => 'BMS & Utilities', 'id' => 'BMS & Utilitas'],
                            ['key' => 'packaging', 'en' => 'Packaging', 'id' => 'Pengemasan'],
                        ];
                    @endphp
                    @foreach ($filterPills as $pill)
                        <button type="button"
                                onclick="setProjectCategory('{{ $pill['key'] }}')"
                                id="filter-{{ $pill['key'] }}"
                                class="project-filter-btn inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full text-xs font-bold font-['Agrandir',sans-serif] transition-all duration-200 cursor-pointer {{ $pill['key'] === 'all' ? 'active bg-white text-black shadow-sm' : 'bg-white/10 text-white/85 hover:bg-white/20 hover:text-white' }}">
                            <span data-lang-en="{{ $pill['en'] }}" data-lang-id="{{ $pill['id'] }}">{{ $pill['en'] }}</span>
                            <span class="filter-count text-[10px] font-['Questrial',sans-serif] px-1.5 py-0.5 rounded-full {{ $pill['key'] === 'all' ? 'bg-black text-white' : 'bg-white/15 text-white/90' }}">
                                {{ $categoryCounts[$pill['key']] }}
                            </span>
                        </button>
                    @endforeach
                </div>

                <!-- Instant Search Input -->
                <div class="relative w-full lg:w-72 shrink-0">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                    </svg>
                    <input type="text" id="project-search-input"
                           oninput="applyProjectFilters()"
                           placeholder="Search project, client, sector..."
                           class="w-full pl-10 pr-9 py-2.5 rounded-full border-0 bg-white/95 focus:bg-white text-xs sm:text-sm text-slate-900 placeholder:text-slate-400 outline-none focus:ring-2 focus:ring-[#3367A5]/40 shadow-sm transition">
                    <button type="button" id="project-search-clear" onclick="clearProjectSearch()"
                            class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 cursor-pointer"
                            aria-label="Clear search">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. FULL-BLEED IMAGE SHOWCASE GALLERY (Gaya 2 Asymmetric Grid)             -->
    <!-- ========================================================================= -->
    <section class="bg-white pt-12 sm:pt-16 pb-10 sm:pb-14 lg:pb-16">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

            <!-- Asymmetric Full-Bleed 12-Column Showcase Grid -->
            <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-12 gap-5 sm:gap-6">
                @forelse ($preparedProjects as $entry)
                    @php
                        /** @var \App\Models\Project $proj */
                        $proj = $entry['model'];
                        $idx = $entry['index'];

                        // Gaya 2 balanced asymmetric rhythm for 10 items:
                        // Row 1 (0, 1): 7 + 5 (60/40 hero showcase)
                        // Row 2 (2, 3, 4): 4 + 4 + 4
                        // Row 3 (5, 6, 7): 4 + 4 + 4
                        // Row 4 (8, 9): 6 + 6 (balanced 2-card bottom row, zero orphan!)
                        if ($totalProjectsCount === 10) {
                            $spanClass = match ($idx) {
                                0 => 'md:col-span-7 h-[330px] sm:h-[400px]',
                                1 => 'md:col-span-5 h-[330px] sm:h-[400px]',
                                8, 9 => 'md:col-span-6 h-[320px] sm:h-[365px]',
                                default => 'md:col-span-4 h-[310px] sm:h-[355px]',
                            };
                        } elseif ($idx === 0 && $totalProjectsCount >= 2) {
                            $spanClass = 'md:col-span-7 h-[330px] sm:h-[400px]';
                        } elseif ($idx === 1 && $totalProjectsCount >= 2) {
                            $spanClass = 'md:col-span-5 h-[330px] sm:h-[400px]';
                        } else {
                            $spanClass = 'md:col-span-4 h-[310px] sm:h-[355px]';
                        }

                        $isLargeCard = str_contains($spanClass, 'col-span-7') || str_contains($spanClass, 'col-span-6');
                    @endphp

                    <article
                        onclick="openCaseModal('proj-db-{{ $proj->id }}')"
                        role="button"
                        tabindex="0"
                        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); openCaseModal('proj-db-{{ $proj->id }}'); }"
                        data-category="{{ $entry['cat_key'] }}"
                        data-default-span="{{ $spanClass }}"
                        data-search="{{ strtolower($proj->title . ' ' . $entry['client_label'] . ' ' . $entry['category_label'] . ' ' . $proj->description) }}"
                        class="project-item showcase-card group relative rounded-[26px] overflow-hidden bg-black cursor-pointer select-none reveal-on-scroll reveal-stagger-{{ ($idx % 3) + 1 }} {{ $spanClass }}">

                        <!-- Full-Bleed Industrial Photograph (Clean & Steady — Zero Zoom) -->
                        <img src="{{ $entry['image'] }}"
                             alt="{{ $proj->title }}"
                             loading="eager"
                             class="showcase-img absolute inset-0 w-full h-full object-cover object-center">

                        <!-- Translucent Black Hover Veil (Hidden by Default, Smooth Fade on Hover) -->
                        <div class="showcase-overlay-bg absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/45"></div>

                        <!-- Staggered Slide-Up Content Overlay (1. PT -> 2. Heading -> 3. Paragraf -> 4. Arrow Icon) -->
                        <div class="absolute inset-0 z-10 {{ $isLargeCard ? 'p-6 sm:p-7' : 'p-5 sm:p-6' }} flex flex-col justify-end">
                            <!-- Bottom Text + Circular Action Button -->
                            <div class="flex items-end justify-between gap-3.5 sm:gap-4">
                                <div class="min-w-0 flex-1 space-y-1.5">
                                    <p class="showcase-step showcase-step-1 text-[11px] sm:text-xs font-semibold text-[#7FB0EA] font-['Questrial',sans-serif] tracking-wide truncate">
                                        {{ $entry['client_label'] }}
                                    </p>
                                    <h3 class="showcase-step showcase-step-2 {{ $isLargeCard ? 'text-xl sm:text-2xl' : 'text-base sm:text-[17px]' }} font-bold text-white font-['Agrandir',sans-serif] leading-snug tracking-tight project-clamp-2">
                                        {{ $proj->title }}
                                    </h3>
                                    <p class="showcase-step showcase-step-3 {{ $isLargeCard ? 'text-xs sm:text-[13px]' : 'text-[11px] sm:text-xs' }} text-slate-200/90 font-['Questrial',sans-serif] leading-relaxed project-clamp-2 pt-0.5">
                                        {{ $proj->description }}
                                    </p>
                                </div>

                                <!-- Step 4: Circular Arrow Button -->
                                <div class="showcase-step showcase-step-4 shrink-0">
                                    <button type="button" aria-label="Lihat detail {{ $proj->title }}"
                                            class="showcase-arrow-btn w-10 h-10 rounded-full flex items-center justify-center shadow-lg cursor-pointer border-0 outline-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400">
                        <p class="text-base font-semibold">Belum ada proyek yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty Filter/Search State -->
            <div id="projects-empty-state" class="hidden py-16 text-center space-y-3">
                <p class="text-base font-bold text-slate-700 font-['Agrandir',sans-serif]"
                   data-lang-en="No matching projects found."
                   data-lang-id="Tidak ada proyek yang sesuai pencarian.">
                    No matching projects found.
                </p>
                <button type="button" onclick="resetAllProjectFilters()"
                        class="px-5 py-2 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-xs font-bold font-['Agrandir',sans-serif] transition cursor-pointer">
                    <span data-lang-en="Show All Projects" data-lang-id="Tampilkan Semua Proyek">Show All Projects</span>
                </button>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. TRUSTED BY INDUSTRY LEADERS SECTION                                    -->
    <!-- ========================================================================= -->
    <section class="bg-black text-white py-20 sm:py-24 relative overflow-hidden">
        <div class="container mx-auto px-6 mb-12 sm:mb-14 text-center reveal-on-scroll">
            <span
                class="inline-block text-xs sm:text-sm font-semibold uppercase tracking-widest text-[#7FB0EA] font-['Agrandir',sans-serif] mb-2"
                data-lang-en="Trusted Partners"
                data-lang-id="Mitra Tepercaya">
                Trusted Partners
            </span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold font-['Agrandir',sans-serif] text-white"
                data-lang-en="Trusted by 200+ Industrial Manufacturers"
                data-lang-id="Dipercaya oleh 200+ Produsen Industri">
                Trusted by 200+ Industrial Manufacturers
            </h2>
            <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-4 rounded-full"></div>
            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial',sans-serif] mt-4 max-w-xl mx-auto"
                data-lang-en="Delivering cutting-edge industrial automation, robotics, and smart manufacturing to Indonesia's industry leaders."
                data-lang-id="Menghadirkan otomasi industri terdepan, robotika, dan manufaktur cerdas untuk para pemimpin industri di Indonesia.">
                Delivering cutting-edge industrial automation, robotics, and smart manufacturing to Indonesia's industry leaders.
            </p>
        </div>

        <div class="absolute left-0 top-0 bottom-0 w-20 sm:w-40 bg-gradient-to-r from-black via-black/80 to-transparent pointer-events-none z-20"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 sm:w-40 bg-gradient-to-l from-black via-black/80 to-transparent pointer-events-none z-20"></div>

        <div class="marquee-wrapper space-y-4 sm:space-y-6 overflow-hidden py-4 select-none reveal-on-scroll reveal-stagger-2">
            <!-- Row 1 (Marquee Left) -->
            <div class="animate-marquee-left flex items-center gap-6 sm:gap-10">
                @php
                    $row1Brands = [
                        ['name' => 'Actavis', 'file' => 'Actavis.webp'],
                        ['name' => 'Akasha International', 'file' => 'Akasha.webp'],
                        ['name' => 'PT Federal Karyatama', 'file' => 'FederalOil.webp'],
                        ['name' => 'Hitachi Astemo', 'file' => 'Hitachi.webp'],
                        ['name' => 'Hokkan Indonesia', 'file' => 'Hokkan.webp', 'class' => 'scale-150 sm:scale-165'],
                        ['name' => 'Knauf Gypsum', 'file' => 'Knauf.webp'],
                        ['name' => 'Komatsu Indonesia', 'file' => 'Komatsu.webp'],
                        ['name' => 'Orang Tua (OT)', 'file' => 'OT.webp'],
                        ['name' => 'Panasonic Manufacturing', 'file' => 'Panasonic.webp'],
                        ['name' => 'Rayovac', 'file' => 'Rayovac.webp'],
                        ['name' => 'Rejuve', 'file' => 'Rejuve.webp'],
                        ['name' => 'PT HM Sampoerna Tbk', 'file' => 'Sampoerna.webp'],
                        ['name' => 'PT Mayora Indah Tbk', 'file' => 'Mayora.png', 'class' => 'scale-120 sm:scale-130'],
                    ];
                @endphp
                @foreach (array_merge($row1Brands, $row1Brands) as $brand)
                    <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                        <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                            class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                    </div>
                @endforeach
            </div>

            <!-- Row 2 (Marquee Right) -->
            <div class="animate-marquee-right flex items-center gap-6 sm:gap-10">
                @php
                    $row2Brands = [
                        ['name' => 'PT Jotun Indonesia', 'file' => 'Jotun.svg', 'class' => 'scale-130 sm:scale-140'],
                        ['name' => 'LG Electronics', 'file' => 'LG.svg', 'class' => 'scale-110 sm:scale-120'],
                        ['name' => 'PT Denso Indonesia', 'file' => 'Denso.svg'],
                        ['name' => 'PT Daikin Manufacturing Indonesia', 'file' => 'Daikin.svg'],
                        ['name' => 'PT Akebono Brake Astra', 'file' => 'Akebono.svg'],
                        ['name' => 'PT Amerta Indah Otsuka', 'file' => 'Otsuka.svg'],
                        ['name' => 'PT Pertamina Lubricants', 'file' => 'Pertamina.svg'],
                        ['name' => 'PT Indolakto (Indomilk)', 'file' => 'Indomilk.svg'],
                        ['name' => 'PT Bintang Toedjoe', 'file' => 'BintangToedjoe.png'],
                        ['name' => 'PT DIC Astra', 'file' => 'DICAstra.png'],
                        ['name' => 'PT APM Armada Autoparts', 'file' => 'APM.svg', 'class' => 'scale-110 sm:scale-120'],
                        ['name' => 'PT Coca-Cola Bottling Indonesia', 'file' => 'CocaCola.svg'],
                        ['name' => 'PT Gajah Tunggal Tbk', 'file' => 'GajahTunggal.png'],
                    ];
                @endphp
                @foreach (array_merge($row2Brands, $row2Brands) as $brand)
                    <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                        <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                            class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                    </div>
                @endforeach
            </div>

            <!-- Row 3 (Marquee Left Alt) -->
            <div class="animate-marquee-left-alt flex items-center gap-6 sm:gap-10">
                @php
                    $row3Brands = [
                        ['name' => 'PT Mandom Indonesia Tbk', 'file' => 'Mandom.svg'],
                        ['name' => 'PT Perfetti Van Melle Indonesia', 'file' => 'Perfetti.png'],
                        ['name' => 'PT Forsta Kalmedic Global', 'file' => 'Forsta.png'],
                        ['name' => 'PT SSWP Sumiden', 'file' => 'SSWP.png'],
                        ['name' => 'TMS Engineering', 'file' => 'TMS.webp', 'class' => 'scale-120'],
                        ['name' => 'Syngenta Indonesia', 'file' => 'Syngenta.webp'],
                        ['name' => 'PT Sumiden Wire Products', 'file' => 'Sumiden.webp'],
                        ['name' => 'PT Sankei Gohsyu Industries (SGI)', 'file' => 'SGI.webp'],
                        ['name' => 'Dankos Laboratories (Kalbe)', 'file' => 'Dankos.webp'],
                        ['name' => 'BMI Monier', 'file' => 'Monier.webp'],
                        ['name' => 'PT Satyamitra Kemas Lestari Tbk', 'file' => 'SKL.webp'],
                        ['name' => 'PT Mitra Alam Mandiri (MAM)', 'file' => 'MAM.webp'],
                        ['name' => 'PT Mulia Ceramics Indahraya', 'file' => 'MuliaCeramics.webp', 'class' => 'scale-120 sm:scale-130'],
                    ];
                @endphp
                @foreach (array_merge($row3Brands, $row3Brands) as $brand)
                    <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                        <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                            class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. FLOATING CORPORATE ROYAL BLUE CTA CARD (Gaya 2 Modern Finish)          -->
    <!-- ========================================================================= -->
    <x-cta-banner
        eyebrow-en="Start Your Automation Project"
        eyebrow-id="Mulai Proyek Otomasi Anda"
        title-en="Have a Project Challenge in Your Production Facility?"
        title-id="Menghadapi Tantangan Produksi di Fasilitas Pabrik Anda?"
        description-en="Discuss your throughput requirements, cycle times, and machine integration specs with our engineering team."
        description-id="Diskusikan kebutuhan kapasitas output, kecepatan siklus, dan integrasi mesin Anda bersama tim rekayasa kami."
        primary-label-en="Discuss Your Project"
        primary-label-id="Diskusikan Proyek Anda"
        wa-message="Halo Tim Marketing PT Global Aspect Technology, saya ingin berdiskusi mengenai proyek otomasi industri di fasilitas kami."
    />

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- ========================================================================= -->
    <!-- SPLIT 2-COLUMN CASE STUDY DETAIL MODAL (With Full Project Photograph)     -->
    <!-- ========================================================================= -->
    <div id="case-modal"
         class="fixed inset-0 z-[120] bg-black/75 backdrop-blur-sm hidden items-center justify-center p-3 sm:p-6 transition-opacity duration-300">
        <div class="relative bg-white rounded-[28px] max-w-4xl w-full p-2.5 sm:p-3 shadow-2xl border border-slate-200/80 max-h-[92vh] flex flex-col md:grid md:grid-cols-12 overflow-hidden">
            <!-- Close Button -->
            <button type="button" onclick="closeCaseModal()" aria-label="Close"
                    class="absolute top-4 right-4 z-30 w-9 h-9 rounded-full bg-white/90 hover:bg-slate-100 text-slate-600 hover:text-black border border-slate-200/80 flex items-center justify-center shadow-xs transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Left Column: Full Project Image -->
            <div class="md:col-span-5 relative rounded-[22px] overflow-hidden bg-black min-h-[210px] sm:min-h-[260px] md:min-h-[380px] shrink-0">
                <img id="modal-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="Project Preview"
                     class="absolute inset-0 w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/25"></div>
                <div class="absolute top-4 left-4 flex items-center gap-2">
                    <span id="modal-category" class="px-3 py-1 rounded-full bg-black/75 backdrop-blur-md border border-white/20 text-white text-[10px] font-bold uppercase tracking-wider font-['Agrandir',sans-serif]">
                        CASE STUDY
                    </span>
                </div>
                <div class="absolute bottom-4 left-4 right-4 text-white">
                    <p class="text-[10px] uppercase tracking-widest text-[#7FB0EA] font-bold font-['Agrandir',sans-serif]">PT Global Aspect Technology</p>
                    <p id="modal-year-badge" class="text-xs text-white/90 font-['Questrial',sans-serif] mt-0.5"></p>
                </div>
            </div>

            <!-- Right Column: Technical Narrative & Actions -->
            <div class="md:col-span-7 p-5 sm:p-7 flex flex-col justify-between gap-5 overflow-y-auto">
                <div class="space-y-4 pr-6">
                    <h3 id="modal-title" class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-black leading-snug">
                        Project Details
                    </h3>
                    <p id="modal-description" class="text-xs sm:text-sm text-slate-600 font-['Questrial',sans-serif] leading-relaxed text-justify">
                        Detailed engineering scope and results.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-white border border-slate-200/80">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider font-['Agrandir',sans-serif]"
                                 data-lang-en="Client / Facility" data-lang-id="Klien / Fasilitas">
                                Client / Facility
                            </div>
                            <div id="modal-deliverable" class="text-xs sm:text-sm font-bold text-slate-900 mt-1 font-['Agrandir',sans-serif]">
                                Enterprise Manufacturer
                            </div>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#f8fafd] border border-slate-200/80">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider font-['Agrandir',sans-serif]"
                                 data-lang-en="Sector &amp; Year" data-lang-id="Sektor &amp; Tahun">
                                Sector &amp; Year
                            </div>
                            <div id="modal-impact" class="text-xs sm:text-sm font-bold text-[#3367A5] mt-1 font-['Agrandir',sans-serif]">
                                Automation
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2.5">
                    <a id="modal-wa-link" href="#" target="_blank" rel="noopener noreferrer"
                       class="px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center gap-2 transition shadow-xs">
                        <span data-lang-en="Ask via WhatsApp" data-lang-id="Tanya via WhatsApp">Ask via WhatsApp</span>
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-5 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-xs font-bold font-['Agrandir',sans-serif] inline-flex items-center justify-center transition shadow-xs">
                        <span data-lang-en="Contact About Similar Solution" data-lang-id="Konsultasikan Solusi Serupa">Contact About Similar Solution</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Filtering, Search, Modal & Smooth Scroll -->
    <script>
        let currentProjectCategory = 'all';
        const publicMarketingWa = @json($publicMarketingWa);

        function setProjectCategory(cat) {
            currentProjectCategory = cat;

            document.querySelectorAll('.project-filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-black', 'shadow-sm');
                btn.classList.add('bg-white/10', 'text-white/85', 'hover:bg-white/20', 'hover:text-white');
                const badge = btn.querySelector('.filter-count');
                if (badge) {
                    badge.classList.remove('bg-black', 'text-white');
                    badge.classList.add('bg-white/15', 'text-white/90');
                }
            });

            const activeBtn = document.getElementById('filter-' + cat);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white/10', 'text-white/85', 'hover:bg-white/20', 'hover:text-white');
                activeBtn.classList.add('active', 'bg-white', 'text-black', 'shadow-sm');
                const badge = activeBtn.querySelector('.filter-count');
                if (badge) {
                    badge.classList.remove('bg-white/15', 'text-white/90');
                    badge.classList.add('bg-black', 'text-white');
                }
            }

            applyProjectFilters();
        }

        function clearProjectSearch() {
            const input = document.getElementById('project-search-input');
            if (input) input.value = '';
            applyProjectFilters();
        }

        function resetAllProjectFilters() {
            const input = document.getElementById('project-search-input');
            if (input) input.value = '';
            setProjectCategory('all');
        }

        function applyProjectFilters() {
            const input = document.getElementById('project-search-input');
            const clearBtn = document.getElementById('project-search-clear');
            const q = (input ? input.value : '').trim().toLowerCase();

            if (clearBtn) {
                clearBtn.classList.toggle('hidden', q === '');
            }

            const isFiltered = currentProjectCategory !== 'all' || q !== '';
            const cards = document.querySelectorAll('.project-item');
            let visibleCount = 0;

            cards.forEach(card => {
                const matchCat = currentProjectCategory === 'all' || card.getAttribute('data-category') === currentProjectCategory;
                const matchSearch = q === '' || (card.getAttribute('data-search') || '').includes(q);
                const visible = matchCat && matchSearch;

                if (visible) {
                    visibleCount++;
                    card.classList.remove('hidden');
                    // Restore asymmetric editorial spans on full gallery, or clean uniform cards while filtered
                    const defaultSpan = card.getAttribute('data-default-span') || '';
                    card.classList.remove('md:col-span-7', 'md:col-span-6', 'md:col-span-5', 'md:col-span-4', 'h-[330px]', 'sm:h-[400px]', 'h-[320px]', 'sm:h-[365px]', 'h-[310px]', 'sm:h-[355px]');
                    if (isFiltered) {
                        card.classList.add('md:col-span-6', 'lg:col-span-4', 'h-[320px]', 'sm:h-[355px]');
                    } else {
                        card.classList.remove('lg:col-span-4');
                        defaultSpan.split(' ').filter(Boolean).forEach(cls => card.classList.add(cls));
                    }
                } else {
                    card.classList.add('hidden');
                }
            });

            const emptyEl = document.getElementById('projects-empty-state');
            if (emptyEl) {
                emptyEl.classList.toggle('hidden', visibleCount > 0);
            }
        }

        const projectDetails = {
            @foreach ($preparedProjects as $entry)
                @php $proj = $entry['model']; @endphp
                'proj-db-{{ $proj->id }}': {
                    cat: @json($entry['category_label']),
                    title: @json($proj->title),
                    desc: @json($proj->description),
                    image: @json($entry['image']),
                    deliverable: @json($entry['client_label']),
                    impact: @json($entry['category_label'] . ' · ' . $entry['year_label']),
                    year: @json('Tahun Implementasi: ' . $entry['year_label'])
                },
            @endforeach
        };

        function openCaseModal(key) {
            const data = projectDetails[key];
            if (!data) return;

            document.getElementById('modal-category').innerText = data.cat;
            document.getElementById('modal-title').innerText = data.title;
            document.getElementById('modal-description').innerText = data.desc;
            document.getElementById('modal-deliverable').innerText = data.deliverable;
            document.getElementById('modal-impact').innerText = data.impact;
            document.getElementById('modal-year-badge').innerText = data.year;

            const imgEl = document.getElementById('modal-image');
            if (imgEl) {
                imgEl.src = data.image;
                imgEl.alt = data.title;
            }

            const waEl = document.getElementById('modal-wa-link');
            if (waEl) {
                const msg = `Halo Tim Marketing PT Global Aspect Technology, saya tertarik dengan studi kasus proyek "${data.title}" (${data.cat}) dan ingin berdiskusi untuk fasilitas kami.`;
                waEl.href = `https://wa.me/${publicMarketingWa}?text=${encodeURIComponent(msg)}`;
            }

            const modal = document.getElementById('case-modal');
            document.body.style.overflow = 'hidden';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCaseModal() {
            const modal = document.getElementById('case-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.getElementById('case-modal').addEventListener('click', function (e) {
            if (e.target === this) closeCaseModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeCaseModal();
        });

        document.addEventListener('DOMContentLoaded', function () {
            try {
                if (typeof Lenis !== 'undefined') {
                    const lenis = new Lenis({
                        duration: 1.15,
                        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                        direction: 'vertical',
                        gestureDirection: 'vertical',
                        smooth: true,
                        smoothTouch: false,
                        touchMultiplier: 2,
                    });
                    function raf(time) {
                        lenis.raf(time);
                        requestAnimationFrame(raf);
                    }
                    requestAnimationFrame(raf);
                }
            } catch (e) {
                console.warn('Lenis scroll error:', e);
            }

            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>

</html>
