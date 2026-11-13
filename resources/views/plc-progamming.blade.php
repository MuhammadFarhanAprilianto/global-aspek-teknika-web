<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLC Programming - GAT Industrial Solutions</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
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

        body {
            font-family: 'Questrial', sans-serif;
            color: #1a1a1a;
            background-color: #ffffff;
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

        .cta-quote-btn {
            border: none !important;
            outline: none !important;
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.4);
            text-decoration: none !important;
        }

        .cta-text-wrapper {
            color: #ffffff !important;
            transition: color 0.35s ease;
        }

        .cta-quote-btn:hover .cta-text-wrapper {
            color: #000000 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full bg-white text-neutral-900 selection:bg-red-600 selection:text-white">

    <!-- Navbar -->
    @include('components.navbar.header')

    <main class="w-full">

        <!-- ========================================================================= -->
        <!-- 1. HERO SECTION (LabsStudio Style Service Detail)                         -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white pt-32 sm:pt-40 pb-16 sm:pb-20 border-b border-neutral-200">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <!-- Hero Headline & Subtitle -->
                <div class="space-y-6 max-w-4xl reveal-on-scroll">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-agrandir tracking-tight text-black leading-tight"
                        data-lang-en="PLC Programming"
                        data-lang-id="Pemrograman PLC">
                        PLC Programming
                    </h1>
                    <p class="text-xl sm:text-2xl text-red-600 font-bold font-agrandir tracking-tight"
                        data-lang-en="Mission-Critical Logic Architecture, Motion Control &amp; System Retrofitting"
                        data-lang-id="Arsitektur Logika Kritis, Kontrol Gerak &amp; Retrofit Sistem">
                        Mission-Critical Logic Architecture, Motion Control &amp; System Retrofitting
                    </p>
                    <p class="text-base sm:text-lg text-neutral-600 font-questrial leading-relaxed max-w-3xl"
                        data-lang-en="We develop, code, optimize, and troubleshoot PLC programs tailored for high-speed industrial environments. Supporting market-leading platforms including Mitsubishi, Omron, Siemens, Keyence, and Allen Bradley to maximize uptime and operational throughput."
                        data-lang-id="Kami mengembangkan, memprogram, mengoptimalkan, dan menangani perbaikan PLC untuk lingkungan industri berkecepatan tinggi. Mendukung platform terkemuka seperti Mitsubishi, Omron, Siemens, Keyence, dan Allen Bradley guna memaksimalkan waktu operasional dan hasil produksi.">
                        We develop, code, optimize, and troubleshoot PLC programs tailored for high-speed industrial environments. Supporting market-leading platforms including Mitsubishi, Omron, Siemens, Keyence, and Allen Bradley to maximize uptime and operational throughput.
                    </p>
                </div>

                <!-- Stats Quick Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-1">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">150+</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Industrial Lines Deployed"
                            data-lang-id="Lini Industri Diterapkan">
                            Industrial Lines Deployed
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-2">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-red-600">99.9%</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Logic Uptime &amp; Safety SLA"
                            data-lang-id="Uptime Logika &amp; SLA Keamanan">
                            Logic Uptime &amp; Safety SLA
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-3">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">24/7</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Emergency On-site Support"
                            data-lang-id="Dukungan Darurat di Lokasi">
                            Emergency On-site Support
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 2. CORE DELIVERABLES / CAPABILITIES CARDS                                 -->
        <!-- ========================================================================= -->
        <section class="w-full bg-[#07080b] py-16 sm:py-24 border-b border-neutral-900 text-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <div class="text-center space-y-3 max-w-2xl mx-auto reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-500 font-agrandir"
                        data-lang-en="Core Capabilities"
                        data-lang-id="Kemampuan Utama">
                        Core Capabilities
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight"
                        data-lang-en="What We Deliver"
                        data-lang-id="Layanan yang Kami Hadirkan">
                        What We Deliver
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400 font-questrial"
                        data-lang-en="Comprehensive PLC lifecycle engineering customized to your exact production demands."
                        data-lang-id="Rekayasa siklus hidup PLC komprehensif yang disesuaikan dengan kebutuhan produksi Anda.">
                        Comprehensive PLC lifecycle engineering customized to your exact production demands.
                    </p>
                </div>

                <!-- 3 Deliverables Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    
                    <!-- Deliverable 1 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-1">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="New Program Development"
                                data-lang-id="Pengembangan Program Baru">
                                New Program Development
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Designing ground-up automation logic, clean structured text, and modular ladder architectures tailored to custom manufacturing machinery."
                                data-lang-id="Merancang logika otomasi dari awal, structured text yang rapi, dan arsitektur ladder modular untuk mesin manufaktur khusus.">
                                Designing ground-up automation logic, clean structured text, and modular ladder architectures tailored to custom manufacturing machinery.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Mitsubishi, Omron, Siemens, Keyence" data-lang-id="Mitsubishi, Omron, Siemens, Keyence">Mitsubishi, Omron, Siemens, Keyence</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Fail-safe Interlocks &amp; Emergency Logic" data-lang-id="Interlock Failsafe &amp; Logika Darurat">Fail-safe Interlocks &amp; Emergency Logic</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Custom Operator HMI Touchscreen Panels" data-lang-id="Panel Layar Sentuh HMI Kustom Operator">Custom Operator HMI Touchscreen Panels</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 2 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-2">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="Modification &amp; Servo Motion"
                                data-lang-id="Modifikasi &amp; Gerak Servo">
                                Modification &amp; Servo Motion
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Upgrading and enhancing existing operating lines, adding multi-axis servo positioning, barcode tracking, and throughput acceleration."
                                data-lang-id="Meningkatkan dan menyempurnakan lini yang sedang beroperasi, menambahkan pemosisian servo multi-sumbu, pelacakan barcode, dan percepatan kapasitas.">
                                Upgrading and enhancing existing operating lines, adding multi-axis servo positioning, barcode tracking, and throughput acceleration.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Multi-Axis Servo &amp; Stepper Integration" data-lang-id="Integrasi Servo &amp; Stepper Multi-Sumbu">Multi-Axis Servo &amp; Stepper Integration</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Cycle Time Optimization &amp; De-bottlenecking" data-lang-id="Optimasi Waktu Siklus &amp; Penghapusan Hambatan">Cycle Time Optimization &amp; De-bottlenecking</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="High-Speed Sensor &amp; Scanner Triggers" data-lang-id="Pemicu Sensor &amp; Pemindai Kecepatan Tinggi">High-Speed Sensor &amp; Scanner Triggers</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 3 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-3">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="Troubleshooting &amp; Retrofit"
                                data-lang-id="Pemecahan Masalah &amp; Retrofit">
                                Troubleshooting &amp; Retrofit
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Rapid diagnostic fault finding and legacy hardware migrations to eliminate unplanned factory downtime and extend machinery lifespan."
                                data-lang-id="Pemeriksaan gangguan diagnostik cepat dan migrasi perangkat keras lama guna meniadakan waktu henti pabrik serta memperpanjang usia mesin.">
                                Rapid diagnostic fault finding and legacy hardware migrations to eliminate unplanned factory downtime and extend machinery lifespan.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Rapid Root-Cause Fault Identification" data-lang-id="Identifikasi Akar Penyebab Gangguan Cepat">Rapid Root-Cause Fault Identification</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Legacy-to-Modern PLC Migrations" data-lang-id="Migrasi PLC Lama ke Sistem Modern">Legacy-to-Modern PLC Migrations</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Real-Time Diagnostic Alarm Logging" data-lang-id="Pencatatan Alarm Diagnostik Real-Time">Real-Time Diagnostic Alarm Logging</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 3. STEP-BY-STEP PROCESS TIMELINE (LabsStudio 01-04 Methodology)            -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white py-16 sm:py-24 border-b border-neutral-200">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <div class="text-center space-y-3 max-w-2xl mx-auto reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir"
                        data-lang-en="Structured Methodology"
                        data-lang-id="Metodologi Terstruktur">
                        Structured Methodology
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight"
                        data-lang-en="Our 4-Phase Process"
                        data-lang-id="Proses 4 Fase Kami">
                        Our 4-Phase Process
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600 font-questrial"
                        data-lang-en="A proven engineering framework that minimizes production disruption and guarantees rock-solid execution."
                        data-lang-id="Kerangka kerja rekayasa teruji yang meminimalkan gangguan produksi dan menjamin eksekusi yang andal.">
                        A proven engineering framework that minimizes production disruption and guarantees rock-solid execution.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Step 01 -->
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-1">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">01</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 1"
                                data-lang-id="Fase 1">Phase 1</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Audit &amp; Architecture"
                            data-lang-id="Audit &amp; Arsitektur">
                            Audit &amp; Architecture
                        </h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Analyzing machinery I/O schematics, mechanical timing requirements, and safety protocols to create a comprehensive logic blueprint."
                            data-lang-id="Menganalisis skema I/O mesin, kebutuhan timing mekanis, dan protokol keamanan untuk membuat cetak biru logika komprehensif.">
                            Analyzing machinery I/O schematics, mechanical timing requirements, and safety protocols to create a comprehensive logic blueprint.
                        </p>
                    </div>

                    <!-- Step 02 -->
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-2">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">02</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 2"
                                data-lang-id="Fase 2">Phase 2</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Programming &amp; HMI"
                            data-lang-id="Pemrograman &amp; HMI">
                            Programming &amp; HMI
                        </h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Writing modular ladder logic, structured text algorithms, and designing clean intuitive HMI touchscreen operator dashboards."
                            data-lang-id="Menulis logika ladder modular, algoritma structured text, serta merancang dashboard layar sentuh HMI operator yang intuitif.">
                            Writing modular ladder logic, structured text algorithms, and designing clean intuitive HMI touchscreen operator dashboards.
                        </p>
                    </div>

                    <!-- Step 03 -->
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-3">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">03</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 3"
                                data-lang-id="Fase 3">Phase 3</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Simulation &amp; FAT"
                            data-lang-id="Simulasi &amp; FAT">
                            Simulation &amp; FAT
                        </h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Executing off-line virtual simulations and strict Factory Acceptance Testing (FAT) to validate edge cases before line shutdown."
                            data-lang-id="Menjalankan simulasi virtual offline dan Pengujian Penerimaan Pabrik (FAT) yang ketat untuk memvalidasi skenario sebelum penghentian lini produksi.">
                            Executing off-line virtual simulations and strict Factory Acceptance Testing (FAT) to validate edge cases before line shutdown.
                        </p>
                    </div>

                    <!-- Step 04 -->
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-4">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">04</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 4"
                                data-lang-id="Fase 4">Phase 4</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Commissioning &amp; Handover"
                            data-lang-id="Uji Operasi &amp; Serah Terima">
                            Commissioning &amp; Handover
                        </h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Live on-site line commissioning, parameter fine-tuning, operator training, and complete documentation sign-off."
                            data-lang-id="Uji operasi langsung di lokasi lini, penyesuaian parameter, pelatihan operator, dan penandatanganan dokumentasi lengkap.">
                            Live on-site line commissioning, parameter fine-tuning, operator training, and complete documentation sign-off.
                        </p>
                    </div>
                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 4. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)                             -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white py-16 sm:py-24 border-b border-neutral-200">
            <div class="max-w-4xl mx-auto px-6 sm:px-12 space-y-8">
                
                <div class="text-center space-y-3 reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir"
                        data-lang-en="FAQS"
                        data-lang-id="TANYA JAWAB">
                        FAQS
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight"
                        data-lang-en="Frequently Asked Questions"
                        data-lang-id="Pertanyaan yang Sering Diajukan">
                        Frequently Asked Questions
                    </h2>
                </div>

                <div class="space-y-4" id="faq-accordion">
                    
                    <!-- FAQ Item 1 -->
                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-1">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Which PLC controller brands do you support?" data-lang-id="Merek pengontrol PLC apa saja yang Anda dukung?">Which PLC controller brands do you support?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="We specialize in all major industrial brands including Mitsubishi (GX Works 2/3), Keyence (KV Studio), Omron (Sysmac Studio / CX-Programmer), Siemens (TIA Portal S7-1200/1500), Allen Bradley (Studio 5000), and Panasonic."
                            data-lang-id="Kami mengkhususkan diri pada semua merek industri terkemuka termasuk Mitsubishi (GX Works 2/3), Keyence (KV Studio), Omron (Sysmac Studio / CX-Programmer), Siemens (TIA Portal S7-1200/1500), Allen Bradley (Studio 5000), dan Panasonic.">
                            We specialize in all major industrial brands including Mitsubishi (GX Works 2/3), Keyence (KV Studio), Omron (Sysmac Studio / CX-Programmer), Siemens (TIA Portal S7-1200/1500), Allen Bradley (Studio 5000), and Panasonic.
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-2">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Can you modify or reverse-engineer an existing running PLC without documentation?" data-lang-id="Dapatkah Anda memodifikasi atau merekayasa balik PLC yang sedang berjalan tanpa dokumentasi?">Can you modify or reverse-engineer an existing running PLC without documentation?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. Our senior automation engineers can upload running logic from the controller, map physical I/O registers, reconstruct comments and rung documentation, and safely implement your requested additions without risking plant operations."
                            data-lang-id="Ya. Insinyur otomasi senior kami dapat mengunggah logika yang berjalan dari pengontrol, memetakan register I/O fisik, merekonstruksi komentar dan dokumentasi rung, serta menerapkan penambahan yang diminta secara aman tanpa mengganggu operasi pabrik.">
                            Yes. Our senior automation engineers can upload running logic from the controller, map physical I/O registers, reconstruct comments and rung documentation, and safely implement your requested additions without risking plant operations.
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-3">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Do you provide on-site emergency troubleshooting in industrial zones?" data-lang-id="Apakah Anda menyediakan pemecahan masalah darurat di lokasi kawasan industri?">Do you provide on-site emergency troubleshooting in industrial zones?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. We provide priority on-site troubleshooting across Jakarta, Cikarang, Karawang, Bekasi, Surabaya, and industrial estates nationwide to rapidly diagnose faults, restore line uptime, and implement permanent fixes."
                            data-lang-id="Ya. Kami menyediakan layanan penanganan darurat prioritas di lokasi di seluruh Jakarta, Cikarang, Karawang, Bekasi, Surabaya, dan kawasan industri nasional untuk mendiagnosis gangguan secara cepat, memulihkan uptime lini produksi, serta memberikan solusi permanen.">
                            Yes. We provide priority on-site troubleshooting across Jakarta, Cikarang, Karawang, Bekasi, Surabaya, and industrial estates nationwide to rapidly diagnose faults, restore line uptime, and implement permanent fixes.
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 5. CONSULTATION / COLLABORATE CTA BANNER                                  -->
        <!-- ========================================================================= -->
        <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
            <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-red-500 font-agrandir"
                    data-lang-en="LET'S COLLABORATE"
                    data-lang-id="MARI BERKOLABORASI">
                    LET'S COLLABORATE
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight leading-tight"
                    data-lang-en="Ready to Build Your Next High-Performance Automation?"
                    data-lang-id="Siap Membangun Otomasi Berkinerja Tinggi Berikutnya?">
                    Ready to Build Your Next High-Performance Automation?
                </h2>
                <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-questrial leading-relaxed"
                    data-lang-en="Let's discuss your machinery specs, cycle time goals, and automation logic. Contact our engineering team for a comprehensive technical consultation."
                    data-lang-id="Mari diskusikan spesifikasi mesin, target waktu siklus, dan logika otomasi Anda. Hubungi tim rekayasa kami untuk konsultasi teknis menyeluruh.">
                    Let's discuss your machinery specs, cycle time goals, and automation logic. Contact our engineering team for a comprehensive technical consultation.
                </p>

                <div class="pt-4 flex items-center justify-center">
                    <a href="{{ route('contact') }}"
                        class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-red-600 font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-agrandir border-0 outline-none isolate">
                        <!-- White Wipe Layer from Left to Right -->
                        <span
                            class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                        <!-- Text & Arrow Layer (White initially, Black on hover) -->
                        <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-agrandir text-sm sm:text-base font-bold">
                            <span data-lang-en="Get A Quote / Consultation" data-lang-id="Minta Penawaran / Konsultasi">Get A Quote / Consultation</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Floating Contact Button -->
    @include('components.button.button')

    <!-- Simple Accordion Script -->
    <script>
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('.faq-icon');
                const isOpen = !content.classList.contains('hidden');

                document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180', 'bg-red-600', 'text-white'));

                if (!isOpen) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'bg-red-600', 'text-white');
                }
            });
        });
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
</body>

</html>
