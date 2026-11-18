<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications - PT. Global Aspect Technology</title>

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
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&family=Questrial&family=Syne:wght@400..800&family=Viga&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
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

        /* Agency Scroll Reveal Animation with Subtle Motion */
        .reveal-on-scroll {
            opacity: 0;
            filter: blur(8px);
            transform: translateY(24px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        filter 0.8s cubic-bezier(0.16, 1, 0.3, 1);
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

        /* CTA Quote Button Hover Style */
        .cta-quote-btn {
            border: none !important;
            outline: none !important;
            text-decoration: none !important;
        }
        .cta-quote-btn .cta-text-wrapper {
            color: #ffffff;
            transition: color 0.35s ease;
        }
        .cta-quote-btn:hover .cta-text-wrapper,
        .cta-quote-btn:hover .cta-text-wrapper * {
            color: #000000 !important;
        }

        /* Domain Tab Button (No border / No outline) */
        .domain-tab-btn {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .domain-tab-btn:focus,
        .domain-tab-btn:active,
        .domain-tab-btn:focus-visible {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Interactive Simulator HMI Styles */
        .sim-range {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 6px;
            background: #262626;
            border-radius: 999px;
            outline: none;
        }
        .sim-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3367A5;
            border: 2px solid #ffffff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(51, 103, 165, 0.8);
            transition: transform 0.15s ease;
        }
        .sim-range::-webkit-slider-thumb:hover {
            transform: scale(1.15);
        }
        .sim-range::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3367A5;
            border: 2px solid #ffffff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(51, 103, 165, 0.8);
        }
        @keyframes conveyorDash {
            to {
                stroke-dashoffset: -24;
            }
        }
        .animate-conveyor {
            animation: conveyorDash 0.6s linear infinite;
        }
        .sim-btn {
            border: none !important;
            outline: none !important;
        }

        /* Simulation Launch Button (Under Domain Images) */
        .sim-launch-btn {
            background-color: #3367A5 !important;
            color: #ffffff !important;
            border: none !important;
            outline: none !important;
            text-decoration: none !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .sim-launch-btn * {
            color: #ffffff !important;
            transition: color 0.3s ease, stroke 0.3s ease !important;
        }
        .sim-launch-btn svg {
            stroke: #ffffff !important;
        }
        .sim-launch-btn:hover {
            background-color: #ffffff !important;
            color: #000000 !important;
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.18) !important;
        }
        .sim-launch-btn:hover * {
            color: #000000 !important;
        }
        .sim-launch-btn:hover svg {
            stroke: #000000 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION (Industrial Telemetry & Architecture Header)               -->
    <!-- ========================================================================= -->
    <section class="relative w-full min-h-[65vh] sm:min-h-[75vh] lg:min-h-[82vh] bg-black text-white text-center py-36 sm:py-44 lg:py-52 overflow-hidden flex items-center justify-center">
        <!-- Video Background with Fallback -->
        <div class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none flex items-center justify-center">
            <video autoplay loop muted playsinline preload="auto"
                class="w-full h-full object-cover object-center opacity-60"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/Company_Profile.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/Company_Profile.webm') }}" type="video/webm">
            </video>
            <!-- Contrast Overlays -->
            <div class="absolute inset-0 bg-black/55"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/70"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <h1 data-lang-en="INDUSTRIAL APPLICATIONS" data-lang-id="APLIKASI INDUSTRI"
                class="text-3xl sm:text-5xl md:text-6xl lg:text-[64px] font-bold uppercase font-['Agrandir'] tracking-tight text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                INDUSTRIAL APPLICATIONS
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-4 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]"></div>

            <p data-lang-en="Smart automation architectures, machine vision quality inspection, and web-based SCADA telemetry engineered for mission-critical production facilities."
               data-lang-id="Arsitektur otomasi cerdas, inspeksi mutu visi optik, dan telemetri SCADA berbasis web yang dirancang untuk fasilitas produksi berstandar tinggi."
                class="text-sm sm:text-base md:text-lg text-gray-300 font-['Questrial'] max-w-2xl mt-5 leading-relaxed">
                Smart automation architectures, machine vision quality inspection, and web-based SCADA telemetry engineered for mission-critical production facilities.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. OPERATIONAL DOMAINS INTERACTIVE SHOWCASE                               -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']">Specialized Sectors</span>
                <h2 data-lang-en="WHERE GAT SYSTEMS ARE DEPLOYED" data-lang-id="PENERAPAN SISTEM GAT DI INDUSTRI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir'] mt-2">
                    WHERE GAT SYSTEMS ARE DEPLOYED
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="Hover or select any operational domain below to preview its architecture on the side, or visit its dedicated standalone page."
                   data-lang-id="Arahkan kursor atau pilih domain operasional di bawah untuk melihat pratinjau di samping, atau kunjungi halaman khusus masing-masing."
                    class="text-base sm:text-lg text-gray-400 leading-relaxed font-['Questrial']">
                    Hover or select any operational domain below to preview its architecture on the side, or visit its dedicated standalone page.
                </p>
            </div>

            <!-- Split Interactive Domain Layout (Side Menu + Side Flyout Preview) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start max-w-7xl mx-auto">
                
                <!-- Left Column: Vertical Domain Selector Menu -->
                <div class="lg:col-span-5 space-y-3 reveal-on-scroll">
                    <div class="p-2 sm:p-3 rounded-3xl bg-neutral-900/90 border border-neutral-800 shadow-xl space-y-2">
                        <div class="px-4 py-2 flex items-center justify-between border-b border-neutral-800/80 mb-1">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-neutral-400 font-['Agrandir']" data-lang-en="Operational Domains" data-lang-id="Domain Operasional">
                                Operational Domains
                            </span>
                            <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-[#3367A5]/20 text-[#3367A5] font-bold font-['Agrandir']">5 Sectors</span>
                        </div>

                        <!-- Item 01: Manufacturing & FMCG -->
                        <div id="domain-item-manufacturing"
                             onmouseenter="selectDomain('manufacturing')"
                             onclick="selectDomain('manufacturing')"
                             class="domain-tab-item group flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 cursor-pointer bg-[#3367A5]/15 border-[#3367A5] text-white">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="domain-num w-9 h-9 rounded-xl bg-[#3367A5] text-white text-xs font-bold font-['Agrandir'] flex items-center justify-center shrink-0 transition-colors">01</span>
                                <div class="min-w-0">
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir'] text-white group-hover:text-[#3367A5] transition-colors truncate">Manufacturing &amp; FMCG</h4>
                                    <p class="text-xs text-neutral-400 font-['Questrial'] truncate">High-speed inspection &amp; packaging</p>
                                </div>
                            </div>
                            <svg class="domain-arrow w-4 h-4 text-[#3367A5] transform group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>

                        <!-- Item 02: Automotive & Heavy Machinery -->
                        <div id="domain-item-automotive"
                             onmouseenter="selectDomain('automotive')"
                             onclick="selectDomain('automotive')"
                             class="domain-tab-item group flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 cursor-pointer bg-neutral-900/60 border-neutral-800 text-neutral-300 hover:border-neutral-700 hover:bg-neutral-850">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="domain-num w-9 h-9 rounded-xl bg-neutral-800 text-neutral-400 group-hover:bg-[#3367A5] group-hover:text-white text-xs font-bold font-['Agrandir'] flex items-center justify-center shrink-0 transition-colors">02</span>
                                <div class="min-w-0">
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir'] text-white group-hover:text-[#3367A5] transition-colors truncate">Automotive &amp; Machinery</h4>
                                    <p class="text-xs text-neutral-400 font-['Questrial'] truncate">Robotic cells &amp; sub-micron QA</p>
                                </div>
                            </div>
                            <svg class="domain-arrow w-4 h-4 text-neutral-500 transform group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>

                        <!-- Item 03: Pharma & Cleanrooms -->
                        <div id="domain-item-pharma"
                             onmouseenter="selectDomain('pharma')"
                             onclick="selectDomain('pharma')"
                             class="domain-tab-item group flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 cursor-pointer bg-neutral-900/60 border-neutral-800 text-neutral-300 hover:border-neutral-700 hover:bg-neutral-850">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="domain-num w-9 h-9 rounded-xl bg-neutral-800 text-neutral-400 group-hover:bg-[#3367A5] group-hover:text-white text-xs font-bold font-['Agrandir'] flex items-center justify-center shrink-0 transition-colors">03</span>
                                <div class="min-w-0">
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir'] text-white group-hover:text-[#3367A5] transition-colors truncate">Pharma &amp; Cleanrooms</h4>
                                    <p class="text-xs text-neutral-400 font-['Questrial'] truncate">Blister seal integrity &amp; 2D OCR</p>
                                </div>
                            </div>
                            <svg class="domain-arrow w-4 h-4 text-neutral-500 transform group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>

                        <!-- Item 04: Smart BMS & Utilities -->
                        <div id="domain-item-bms"
                             onmouseenter="selectDomain('bms')"
                             onclick="selectDomain('bms')"
                             class="domain-tab-item group flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 cursor-pointer bg-neutral-900/60 border-neutral-800 text-neutral-300 hover:border-neutral-700 hover:bg-neutral-850">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="domain-num w-9 h-9 rounded-xl bg-neutral-800 text-neutral-400 group-hover:bg-[#3367A5] group-hover:text-white text-xs font-bold font-['Agrandir'] flex items-center justify-center shrink-0 transition-colors">04</span>
                                <div class="min-w-0">
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir'] text-white group-hover:text-[#3367A5] transition-colors truncate">Smart BMS &amp; Utilities</h4>
                                    <p class="text-xs text-neutral-400 font-['Questrial'] truncate">Web SCADA &amp; energy telemetry</p>
                                </div>
                            </div>
                            <svg class="domain-arrow w-4 h-4 text-neutral-500 transform group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>

                        <!-- Item 05: End-of-Line Packaging -->
                        <div id="domain-item-packaging"
                             onmouseenter="selectDomain('packaging')"
                             onclick="selectDomain('packaging')"
                             class="domain-tab-item group flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 cursor-pointer bg-neutral-900/60 border-neutral-800 text-neutral-300 hover:border-neutral-700 hover:bg-neutral-850">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <span class="domain-num w-9 h-9 rounded-xl bg-neutral-800 text-neutral-400 group-hover:bg-[#3367A5] group-hover:text-white text-xs font-bold font-['Agrandir'] flex items-center justify-center shrink-0 transition-colors">05</span>
                                <div class="min-w-0">
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir'] text-white group-hover:text-[#3367A5] transition-colors truncate">End-of-Line Packaging</h4>
                                    <p class="text-xs text-neutral-400 font-['Questrial'] truncate">3,500N arch strapping &amp; turntables</p>
                                </div>
                            </div>
                            <svg class="domain-arrow w-4 h-4 text-neutral-500 transform group-hover:translate-x-1 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Side-Opening Flyout / Preview Showcase Area -->
                <div class="lg:col-span-7 reveal-on-scroll reveal-stagger-1">
                    <div class="relative bg-neutral-900 rounded-3xl border border-neutral-800 p-6 sm:p-8 lg:p-9 shadow-2xl min-h-[520px] flex flex-col justify-between overflow-hidden">
                        
                        <!-- Panel 01: Manufacturing & FMCG -->
                        <div id="domain-panel-manufacturing" class="domain-preview-panel space-y-6 transition-all duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span class="px-3.5 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir']">
                                    DOMAIN 01 &bull; FMCG &amp; BOTTLING
                                </span>
                                <span class="text-xs text-neutral-400 font-medium font-['Questrial']">Zero-Defect Quality Control</span>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white leading-tight">
                                    Integrated Production Lines with Zero-Defect Control
                                </h3>
                                <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed">
                                    FMCG lines demand continuous high throughput without unexpected stops. We synchronize PLC logic across filling, capping, cartooning, and palletizing while running in-line optical cameras that inspect labels, fill levels, and barcodes at speeds exceeding 800 units per minute.
                                </p>
                            </div>

                            <!-- Showcase Video -->
                            <div class="rounded-2xl overflow-hidden border border-neutral-800 bg-neutral-950 relative">
                                <video autoplay loop muted playsinline preload="auto" class="w-full h-52 sm:h-64 object-cover object-center block">
                                    <source src="{{ asset('storage/VideoSection02.mp4') }}" type="video/mp4">
                                </video>
                            </div>

                            <!-- Metric Stats -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">800+ pcs/m</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Inspection Rate</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">+32%</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Overall Line OEE</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-2 flex flex-wrap items-center gap-3.5">
                                <a href="{{ route('application.manufacturing') }}"
                                    class="flex-1 min-w-[200px] inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#3367A5] hover:bg-white hover:text-black text-white font-bold font-['Agrandir'] text-sm shadow-lg transition-all duration-300">
                                    <span>Open Dedicated FMCG Page</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('simulator.show', 'manufacturing') }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-bold font-['Agrandir'] text-sm transition">
                                    <span>Simulation</span>
                                </a>
                            </div>
                        </div>

                        <!-- Panel 02: Automotive & Heavy Machinery -->
                        <div id="domain-panel-automotive" class="domain-preview-panel hidden space-y-6 transition-all duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span class="px-3.5 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir']">
                                    DOMAIN 02 &bull; AUTOMOTIVE &amp; HEAVY EQUIPMENT
                                </span>
                                <span class="text-xs text-neutral-400 font-medium font-['Questrial']">Sub-Micron Precision</span>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white leading-tight">
                                    Robotic Workcells &amp; Sub-Micron Dimensional QA
                                </h3>
                                <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed">
                                    Automotive component plants require rigorous dimensional tolerances. GAT retrofits hydraulic presses, implements multi-axis robotic loading cells, and integrates telecentric vision cameras verifying gear teeth and hole pitch to 0.001mm accuracy.
                                </p>
                            </div>

                            <div class="rounded-2xl overflow-hidden border border-neutral-800 bg-neutral-950 relative">
                                <img src="{{ asset('storage/turnkey_integration.webp') }}" alt="Automotive Integration" class="w-full h-52 sm:h-64 object-cover object-center block">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">&plusmn;0.001mm</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Optical Tolerance</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">SIL-3</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Safety Interlock</div>
                                </div>
                            </div>

                            <div class="pt-2 flex flex-wrap items-center gap-3.5">
                                <a href="{{ route('application.automotive') }}"
                                    class="flex-1 min-w-[200px] inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#3367A5] hover:bg-white hover:text-black text-white font-bold font-['Agrandir'] text-sm shadow-lg transition-all duration-300">
                                    <span>Open Dedicated Automotive Page</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('simulator.show', 'automotive') }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-bold font-['Agrandir'] text-sm transition">
                                    <span>Simulation</span>
                                </a>
                            </div>
                        </div>

                        <!-- Panel 03: Pharma & Cleanrooms -->
                        <div id="domain-panel-pharma" class="domain-preview-panel hidden space-y-6 transition-all duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span class="px-3.5 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir']">
                                    DOMAIN 03 &bull; PHARMACEUTICAL &amp; CLEANROOM
                                </span>
                                <span class="text-xs text-neutral-400 font-medium font-['Questrial']">FDA 21 CFR Part 11</span>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white leading-tight">
                                    Blister Inspection, Serialization &amp; Cleanroom SCADA
                                </h3>
                                <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed">
                                    Pharmaceutical manufacturing demands uncompromised product safety. We integrate vision inspection cameras verifying tablet color and blister seal integrity, synchronized with high-resolution TIJ inkjet batch coding and audit-trail database logging.
                                </p>
                            </div>

                            <div class="rounded-2xl overflow-hidden border border-neutral-800 bg-neutral-950 relative">
                                <img src="{{ asset('storage/automated_vision_system.webp') }}" alt="Pharma Optical Inspection" class="w-full h-52 sm:h-64 object-cover object-center block">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">100%</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Audit Compliance</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">Zero Fail</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Blister Seal Leakage</div>
                                </div>
                            </div>

                            <div class="pt-2 flex flex-wrap items-center gap-3.5">
                                <a href="{{ route('application.pharma') }}"
                                    class="flex-1 min-w-[200px] inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#3367A5] hover:bg-white hover:text-black text-white font-bold font-['Agrandir'] text-sm shadow-lg transition-all duration-300">
                                    <span>Open Dedicated Pharma Page</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('simulator.show', 'pharma') }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-bold font-['Agrandir'] text-sm transition">
                                    <span>Simulation</span>
                                </a>
                            </div>
                        </div>

                        <!-- Panel 04: Smart BMS & Utilities -->
                        <div id="domain-panel-bms" class="domain-preview-panel hidden space-y-6 transition-all duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span class="px-3.5 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir']">
                                    DOMAIN 04 &bull; SMART BMS &amp; UTILITIES
                                </span>
                                <span class="text-xs text-neutral-400 font-medium font-['Questrial']">Zero-License Web SCADA</span>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white leading-tight">
                                    Building Management &amp; Facility Utilities Telemetry
                                </h3>
                                <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed">
                                    Smart commercial towers and manufacturing plants use our universal web-based SCADA interface to unify multi-chiller sequences, AHU air balances, gas leakage alarms, and electrical sub-meters into one accessible web portal without per-seat licensing fees.
                                </p>
                            </div>

                            <div class="rounded-2xl overflow-hidden border border-neutral-800 bg-neutral-950 relative">
                                <img src="{{ asset('storage/smartics_building_bms.jpg') }}" alt="Building Management Systems" class="w-full h-52 sm:h-64 object-cover object-center block">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">-18%</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Chiller Power Saved</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">&lt;2s</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Alarm Dispatch</div>
                                </div>
                            </div>

                            <div class="pt-2 flex flex-wrap items-center gap-3.5">
                                <a href="{{ route('application.bms') }}"
                                    class="flex-1 min-w-[200px] inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#3367A5] hover:bg-white hover:text-black text-white font-bold font-['Agrandir'] text-sm shadow-lg transition-all duration-300">
                                    <span>Open Dedicated BMS Page</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('simulator.show', 'bms') }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-bold font-['Agrandir'] text-sm transition">
                                    <span>Simulation</span>
                                </a>
                            </div>
                        </div>

                        <!-- Panel 05: End-of-Line Packaging -->
                        <div id="domain-panel-packaging" class="domain-preview-panel hidden space-y-6 transition-all duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <span class="px-3.5 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir']">
                                    DOMAIN 05 &bull; PACKAGING &amp; LOGISTICS
                                </span>
                                <span class="text-xs text-neutral-400 font-medium font-['Questrial']">Backlog Elimination</span>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white leading-tight">
                                    Automated Arch Strapping &amp; Warehouse Dispatch
                                </h3>
                                <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed">
                                    End-of-line packaging is frequently the primary bottleneck in manufacturing. We install automatic arch strapping units delivering up to 3,500N tension, synchronized with motorized roller turntables and carton sealers to eliminate packaging backlog.
                                </p>
                            </div>

                            <div class="rounded-2xl overflow-hidden border border-neutral-800 bg-neutral-950 relative">
                                <img src="{{ asset('storage/strapping_panel_system.webp') }}" alt="Strapping System Integration" class="w-full h-52 sm:h-64 object-cover object-center block">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">60+</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Straps / Minute</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-white text-neutral-900 shadow-md">
                                    <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">0.2s</div>
                                    <div class="text-xs text-neutral-600 font-medium font-['Questrial'] mt-0.5">Friction Weld Seal</div>
                                </div>
                            </div>

                            <div class="pt-2 flex flex-wrap items-center gap-3.5">
                                <a href="{{ route('application.packaging') }}"
                                    class="flex-1 min-w-[200px] inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#3367A5] hover:bg-white hover:text-black text-white font-bold font-['Agrandir'] text-sm shadow-lg transition-all duration-300">
                                    <span>Open Dedicated Packaging Page</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('simulator.show', 'logistics') }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-2xl bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-bold font-['Agrandir'] text-sm transition">
                                    <span>Simulation</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. FOUR-LAYER ARCHITECTURE STACK                                          -->
    <!-- ========================================================================= -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="THE 4-LAYER INTEGRATION STACK" data-lang-id="4 LAPISAN ARSITEKTUR INTEGRASI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] mt-2">
                    THE 4-LAYER INTEGRATION STACK
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="From physical factory floor sensors up to enterprise cloud reporting, our architecture ensures zero packet loss and seamless protocol interoperability."
                   data-lang-id="Dari sensor lantai pabrik hingga pelaporan cloud korporat, arsitektur kami menjamin nol kehilangan data serta interoperabilitas protokol tanpa hambatan."
                    class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    From physical factory floor sensors up to enterprise cloud reporting, our architecture ensures zero packet loss and seamless protocol interoperability.
                </p>
            </div>

            <!-- Vertical Stack Layers -->
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Layer 4: Enterprise Layer -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-1 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L4
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Enterprise &amp; Analytics" data-lang-id="Tingkat Enterprise &amp; Analitik">Enterprise &amp; Analytics</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Cloud Database &amp; MES / ERP Integration" data-lang-id="Basis Data Cloud &amp; Integrasi MES / ERP">Cloud Database &amp; MES / ERP Integration</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Automated SQL historian, executive shift summaries, SAP/Oracle sync, and paperless QA audits." data-lang-id="Historian SQL otomatis, ringkasan shift eksekutif, sinkronisasi SAP/Oracle, dan audit mutu nirkertas.">
                                Automated SQL historian, executive shift summaries, SAP/Oracle sync, and paperless QA audits.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">PostgreSQL</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">REST API</span>
                    </div>
                </div>

                <!-- Layer 3: Web SCADA & Telemetry -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#3367A5] text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L3
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Visualization &amp; Telemetry" data-lang-id="Visualisasi &amp; Telemetri">Visualization &amp; Telemetry</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Web-Based SCADA Portal &amp; Real-Time Andon" data-lang-id="Portal SCADA Berbasis Web &amp; Andon Real-Time">Web-Based SCADA Portal &amp; Real-Time Andon</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Responsive HTML5 multi-touch dashboards accessible across workstations, iPads, and mobile HMIs." data-lang-id="Dashboard responsif HTML5 yang dapat diakses langsung via browser workstation, iPad, dan tablet HMI.">
                                Responsive HTML5 multi-touch dashboards accessible across workstations, iPads, and mobile HMIs.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">HTML5 / Web</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">MQTT / WSS</span>
                    </div>
                </div>

                <!-- Layer 2: Edge Controllers & Gateways -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-3 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L2
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Edge Compute &amp; Control" data-lang-id="Komputasi Edge &amp; Kendali">Edge Compute &amp; Control</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Multi-Brand PLC &amp; Edge Fieldbus Gateways" data-lang-id="PLC Multi-Brand &amp; Gateway Fieldbus Edge">Multi-Brand PLC &amp; Edge Fieldbus Gateways</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Deterministic sub-10ms cycle execution on Mitsubishi, Omron, Siemens, and industrial IPC units." data-lang-id="Eksekusi siklus deterministik sub-10ms pada PLC Mitsubishi, Omron, Siemens, serta IPC industri.">
                                Deterministic sub-10ms cycle execution on Mitsubishi, Omron, Siemens, and industrial IPC units.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">Modbus</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">OPC-UA</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">Profinet</span>
                    </div>
                </div>

                <!-- Layer 1: Physical Machine & Sensors -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L1
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Field Actuation &amp; Optics" data-lang-id="Aktuasi Lapangan &amp; Optik">Field Actuation &amp; Optics</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Vision Cameras, Laser Heads, Strappers &amp; Actuators" data-lang-id="Kamera Visi, Head Laser, Mesin Strapping &amp; Aktuator">Vision Cameras, Laser Heads, Strappers &amp; Actuators</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Sub-micron optical sensors, pneumatic friction welders, high-speed TIJ heads, and photo-electric triggers." data-lang-id="Sensor optik sub-mikron, pengelas gesek pneumatik, head cetak TIJ berkecepatan tinggi, dan pemicu optik.">
                                Sub-micron optical sensors, pneumatic friction welders, high-speed TIJ heads, and photo-electric triggers.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">IO-Link</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">GigE Vision</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. CONSULTATION CTA                                                       -->
    <!-- ========================================================================= -->
    <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
        <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-['Agrandir'] tracking-tight leading-tight"
                data-lang-en="Have an Application in Mind for Your Plant?"
                data-lang-id="Punya Kebutuhan Aplikasi Otomasi untuk Pabrik Anda?">
                Have an Application in Mind for Your Plant?
            </h2>
            <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-['Questrial'] leading-relaxed"
                data-lang-en="Contact our system architects for custom architecture drafting, fieldbus interfacing, and proof-of-concept testing."
                data-lang-id="Hubungi arsitek sistem kami untuk perancangan arsitektur khusus, integrasi fieldbus, dan pengujian proof-of-concept di fasilitas Anda.">
                Contact our system architects for custom architecture drafting, fieldbus interfacing, and proof-of-concept testing.
            </p>

            <div class="pt-4 flex items-center justify-center">
                <a href="{{ route('contact') }}"
                    class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-[#3367A5] font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-['Agrandir'] border-0 outline-none isolate">
                    <span class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>
                    <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-['Agrandir'] text-sm sm:text-base font-bold text-white group-hover:text-black transition-colors duration-300">
                        <span data-lang-en="Request Technical Consultation" data-lang-id="Minta Konsultasi Teknis">Request Technical Consultation</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Script for Smooth Scroll, Observer & Domain Flyout Selector -->
    <script>
        function selectDomain(domainKey) {
            // Reset all tab items
            document.querySelectorAll('.domain-tab-item').forEach(function(el) {
                el.classList.remove('bg-[#3367A5]/15', 'border-[#3367A5]', 'text-white');
                el.classList.add('bg-neutral-900/60', 'border-neutral-800', 'text-neutral-300');
                var num = el.querySelector('.domain-num');
                if (num) {
                    num.classList.remove('bg-[#3367A5]', 'text-white');
                    num.classList.add('bg-neutral-800', 'text-neutral-400');
                }
                var arrow = el.querySelector('.domain-arrow');
                if (arrow) {
                    arrow.classList.remove('text-[#3367A5]');
                    arrow.classList.add('text-neutral-500');
                }
            });

            // Activate chosen tab item
            var activeItem = document.getElementById('domain-item-' + domainKey);
            if (activeItem) {
                activeItem.classList.remove('bg-neutral-900/60', 'border-neutral-800', 'text-neutral-300');
                activeItem.classList.add('bg-[#3367A5]/15', 'border-[#3367A5]', 'text-white');
                var num = activeItem.querySelector('.domain-num');
                if (num) {
                    num.classList.remove('bg-neutral-800', 'text-neutral-400');
                    num.classList.add('bg-[#3367A5]', 'text-white');
                }
                var arrow = activeItem.querySelector('.domain-arrow');
                if (arrow) {
                    arrow.classList.remove('text-neutral-500');
                    arrow.classList.add('text-[#3367A5]');
                }
            }

            // Hide all panels
            document.querySelectorAll('.domain-preview-panel').forEach(function(panel) {
                panel.classList.add('hidden');
            });

            // Show selected panel
            var targetPanel = document.getElementById('domain-panel-' + domainKey);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {

            // Initialize Lenis Smooth Scroll
            try {
                if (typeof Lenis !== 'undefined') {
                    const lenis = new Lenis({
                        duration: 1.2,
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

            // Scroll Reveal Observer
            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>

</html>

