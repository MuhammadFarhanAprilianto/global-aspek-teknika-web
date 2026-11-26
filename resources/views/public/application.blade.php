<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Applications - PT. Global Aspect Technology</title>
    @include('components.seo-meta', [
        'seoTitle' => 'Industrial Applications — PLC, HMI & Vision Control | PT Global Aspect Technology',
        'seoDescription' => 'Explore PLC sequence programming, touchscreen HMI control panels, IEC 61439 electrical systems, and machine vision applications across Automotive, Pharma, FMCG, Packaging, and Smart BMS.',
    ])

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
        html.lenis,
        html.lenis body {
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

        .reveal-stagger-1 {
            transition-delay: 0.08s;
        }

        .reveal-stagger-2 {
            transition-delay: 0.16s;
        }

        .reveal-stagger-3 {
            transition-delay: 0.24s;
        }

        .reveal-stagger-4 {
            transition-delay: 0.32s;
        }

        .reveal-stagger-5 {
            transition-delay: 0.40s;
        }

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

        /* Editorial Application Rows (Zero Outline, Zero Movement on Hover) */
        .app-capability-row {
            border: 0 !important;
            outline: none !important;
            border-radius: 16px;
        }

        .app-kpi-card {
            border: 0 !important;
            outline: none !important;
            background-color: #ffffff !important;
            border-radius: 24px;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.35);
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }

        .app-kpi-card:hover {
            background-color: #FFFFFF !important;
            transform: translateY(-4px);
            box-shadow: 0 22px 48px rgba(0, 0, 0, 0.48);
        }

        .app-sector-card {
            border: 0 !important;
            outline: none !important;
            text-decoration: none !important;
            background-color: #000000 !important;
            box-shadow: 0 16px 38px rgba(0, 0, 0, 0.18);
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }

        .app-sector-card:hover,
        .app-sector-card:focus {
            border: 0 !important;
            outline: none !important;
            text-decoration: none !important;
            background-color: #121316 !important;
            transform: translateY(-4px);
            box-shadow: 0 22px 48px rgba(0, 0, 0, 0.28);
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION — Dark Full-Bleed Asymmetric Editorial with Video         -->
    <!-- ========================================================================= -->
    <section
        class="relative w-full min-h-[78vh] sm:min-h-[84vh] lg:min-h-[90vh] bg-black text-white pt-32 sm:pt-40 pb-12 sm:pb-16 lg:pb-20 overflow-hidden flex flex-col justify-between">
        <!-- Video Background (Preserved) -->
        <div class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none">
            <video autoplay loop muted playsinline preload="auto"
                class="w-full h-full object-cover object-center opacity-55"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/Company_Profile.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/Company_Profile.webm') }}" type="video/webm">
            </video>
            <!-- Clean Cinematic Gradient Scrim -->
            <div class="absolute inset-0"
                style="background: linear-gradient(180deg, rgba(0,0,0,0.68) 0%, rgba(0,0,0,0.42) 45%, rgba(0,0,0,0.92) 100%);">
            </div>
        </div>

        <!-- Bottom Asymmetric Editorial Headline (Left) + Narrative Intro (Right) -->
        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10 mt-auto pt-16 sm:pt-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-end reveal-on-scroll">
                <div class="lg:col-span-7 min-w-0">
                    <h1 data-lang-en="Industrial Applications." data-lang-id="Aplikasi Industri."
                        class="text-4xl sm:text-5xl md:text-6xl lg:text-[68px] font-extrabold font-['Agrandir',sans-serif] tracking-tight text-white leading-[1.06] text-left">
                        Industrial Applications.
                    </h1>
                </div>
                <div class="lg:col-span-5 min-w-0">
                    <p data-lang-en="Integrated PLC control systems, HMI operator panels, and machine vision inspection engineered for real production floors."
                        data-lang-id="Sistem kendali PLC terpadu, panel operator HMI, dan inspeksi visi mesin yang dirancang langsung untuk lini produksi pabrik."
                        class="text-sm sm:text-base lg:text-lg text-slate-200 font-['Questrial',sans-serif] leading-relaxed text-left">
                        Integrated PLC control systems, HMI operator panels, and machine vision inspection engineered
                        for real production floors.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. ARCHITECTURE & INTEGRATION STACK — 50/50 Centered Split (Pure White)   -->
    <!-- ========================================================================= -->
    <section id="integration-stack" class="bg-white text-neutral-900 py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                <!-- Left Editorial Heading & Manifesto (6 Cols, Equal Width, Centered) -->
                <div
                    class="lg:col-span-6 min-w-0 flex flex-col items-center justify-center text-center space-y-6 reveal-on-scroll">
                    <h2 data-lang-en="PLC, HMI &amp; Electrical Control Architecture."
                        data-lang-id="Arsitektur Kontrol PLC, HMI &amp; Panel Elektrikal."
                        class="text-3xl sm:text-4xl lg:text-[48px] font-extrabold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.12] max-w-xl">
                        PLC, HMI &amp; Electrical Control Architecture.
                    </h2>
                    <p data-lang-en="From 24V DC field sensors and motorized actuators up to PLC logic panels and operator touchscreen HMIs, every system is engineered for safe, reliable, and continuous production."
                        data-lang-id="Dari sensor lapangan 24V DC dan aktuator mesin hingga panel logika PLC dan layar sentuh HMI operator, setiap sistem dirancang untuk kendali produksi yang aman, presisi, dan stabil."
                        class="text-base sm:text-lg lg:text-xl text-neutral-600 font-['Questrial',sans-serif] leading-relaxed max-w-lg">
                        From 24V DC field sensors and motorized actuators up to PLC logic panels and operator
                        touchscreen HMIs, every system is engineered for safe, reliable, and continuous production.
                    </p>
                </div>

                <!-- Right Editorial Architecture Layers (6 Cols, Equal Width, 2x2 Grid, Zero Lines, Zero Outline) -->
                <div class="lg:col-span-6 min-w-0 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-8">
                    <!-- Layer 4 -->
                    <div class="space-y-2.5 reveal-on-scroll reveal-stagger-1">
                        <h3 data-lang-en="Industrial HMI Touchscreen &amp; SCADA Monitoring"
                            data-lang-id="Layar Sentuh HMI Industri &amp; Pemantauan SCADA"
                            class="text-lg sm:text-xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-snug">
                            Industrial HMI Touchscreen &amp; SCADA Monitoring
                        </h3>
                        <p data-lang-en="Custom touchscreen HMI operator screens for start/stop sequencing, conveyor speed control, fault alarm diagnostics, production counters, and multi-SKU recipe switching."
                            data-lang-id="Pemrograman antarmuka HMI layar sentuh untuk pengaturan Start/Stop mesin, kecepatan konveyor, alarm gangguan, penghitung output, dan pemilihan resep produksi secara terpusat."
                            class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Custom touchscreen HMI operator screens for start/stop sequencing, conveyor speed control,
                            fault alarm diagnostics, production counters, and multi-SKU recipe switching.
                        </p>
                    </div>

                    <!-- Layer 3 -->
                    <div class="space-y-2.5 reveal-on-scroll reveal-stagger-2">
                        <h3 data-lang-en="PLC Logic Programming &amp; Sequence Control"
                            data-lang-id="Pemrograman Logika PLC &amp; Sekuens Mesin"
                            class="text-lg sm:text-xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-snug">
                            PLC Logic Programming &amp; Sequence Control
                        </h3>
                        <p data-lang-en="Structured Ladder Diagram programming, I/O interlock safety, high-speed counting, and control retrofits across Mitsubishi, Omron, Siemens, and Allen-Bradley PLCs."
                            data-lang-id="Pembuatan program Ladder Diagram terstruktur, interlock pengaman I/O, high-speed counter, serta retrofit sistem kendali lama pada PLC Mitsubishi, Omron, Siemens, dan Allen-Bradley."
                            class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Structured Ladder Diagram programming, I/O interlock safety, high-speed counting, and
                            control
                            retrofits across Mitsubishi, Omron, Siemens, and Allen-Bradley PLCs.
                        </p>
                    </div>

                    <!-- Layer 2 -->
                    <div class="space-y-2.5 reveal-on-scroll reveal-stagger-3">
                        <h3 data-lang-en="Electrical Control Panels, Drives &amp; Safety Wiring"
                            data-lang-id="Panel Kontrol Elektrikal, Inverter &amp; Pengkabelan"
                            class="text-lg sm:text-xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-snug">
                            Electrical Control Panels, Drives &amp; Safety Wiring
                        </h3>
                        <p data-lang-en="3-phase 380V power and 24V DC control panel fabrication to IEC 61439 standards, integrating VFD inverters, servo drives, EPLAN schematics, and Cat.3 E-Stop safety."
                            data-lang-id="Fabrikasi panel kontrol daya 3-fase 380V dan 24V DC berstandar IEC 61439 lengkap dengan inverter VFD, servo drive, skematik EPLAN, serta pengaman E-Stop Cat.3."
                            class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            3-phase 380V power and 24V DC control panel fabrication to IEC 61439 standards, integrating
                            VFD inverters, servo drives, EPLAN schematics, and Cat.3 E-Stop safety.
                        </p>
                    </div>

                    <!-- Layer 1 -->
                    <div class="space-y-2.5 reveal-on-scroll reveal-stagger-4">
                        <h3 data-lang-en="Field Sensors, Vision Cameras, TIJ/Laser &amp; Actuators"
                            data-lang-id="Sensor Lapangan, Kamera Visi, TIJ/Laser &amp; Aktuator"
                            class="text-lg sm:text-xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-snug">
                            Field Sensors, Vision Cameras, TIJ/Laser &amp; Actuators
                        </h3>
                        <p data-lang-en="Direct 24V PNP/NPN hardware interfacing for photoelectric triggers, optical inspection cameras, TIJ/laser printers, pneumatic reject cylinders, and conveyor drives."
                            data-lang-id="Integrasi langsung I/O 24V PNP/NPN ke sensor fotoelektrik, kamera inspeksi optik &amp; barcode, printer TIJ/laser, silinder reject pneumatik, serta unit penggerak konveyor."
                            class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Direct 24V PNP/NPN hardware interfacing for photoelectric triggers, optical inspection
                            cameras,
                            TIJ/laser printers, pneumatic reject cylinders, and conveyor drives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. ON-SITE DEPLOYMENT — 50/50 Actual Video + Editorial Capabilities       -->
    <!-- ========================================================================= -->
    <section class="bg-white text-neutral-900 py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-stretch">
                <!-- Left Actual Automation Video Frame (5 Cols) -->
                <div
                    class="lg:col-span-5 min-w-0 relative rounded-3xl overflow-hidden bg-black min-h-[360px] sm:min-h-[420px] flex flex-col justify-end p-7 sm:p-9 shadow-[0_20px_50px_rgba(13,37,84,0.16)] reveal-on-scroll">
                    <video autoplay loop muted playsinline preload="auto"
                        class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none">
                        <source src="{{ asset('storage/' . rawurlencode('Simulation Bottle.mp4')) }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 pointer-events-none"
                        style="background: linear-gradient(180deg, rgba(13,37,84,0.28) 0%, rgba(0,0,0,0.32) 45%, rgba(0,0,0,0.92) 100%);">
                    </div>

                    <div class="relative z-10 space-y-3">
                        <h2 data-lang-en="Engineered Directly for Real Production Floors."
                            data-lang-id="Dirancang Langsung untuk Lantai Produksi Nyata."
                            class="text-2xl sm:text-3xl font-extrabold text-white font-['Agrandir',sans-serif] leading-tight">
                            Engineered Directly for Real Production Floors.
                        </h2>
                        <p data-lang-en="Every application integrates hardware sensors, deterministic PLC control, and real-time operator visibility without disrupting existing plant lines."
                            data-lang-id="Setiap aplikasi memadukan sensor lapangan, kendali PLC deterministik, dan visibilitas operator real-time tanpa mengganggu lini produksi yang sudah berjalan."
                            class="text-sm text-slate-200 font-['Questrial',sans-serif] leading-relaxed">
                            Every application integrates hardware sensors, deterministic PLC control, and real-time
                            operator visibility without disrupting existing plant lines.
                        </p>
                    </div>
                </div>

                <!-- Right 3 Application Deployment Capabilities (7 Cols) -->
                <div class="lg:col-span-7 min-w-0 flex flex-col justify-center space-y-2">
                    <!-- Capability 1 -->
                    <div class="app-capability-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-1">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="Multi-Protocol Fieldbus Interfacing"
                            data-lang-id="Integrasi Fieldbus Multi-Protokol"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Multi-Protocol Fieldbus Interfacing
                        </h3>
                        <p data-lang-en="Seamless bridging between Siemens, Mitsubishi, Omron PLCs, Keyence/Cognex vision controllers, and industrial IPC gateways using Modbus, Profinet, and OPC-UA."
                            data-lang-id="Menghubungkan PLC Siemens, Mitsubishi, Omron, kontroler visi Keyence/Cognex, dan gateway IPC industri secara mulus melalui Modbus, Profinet, dan OPC-UA."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Seamless bridging between Siemens, Mitsubishi, Omron PLCs, Keyence/Cognex vision
                            controllers, and industrial IPC gateways using Modbus, Profinet, and OPC-UA.
                        </p>
                    </div>

                    <!-- Capability 2 -->
                    <div class="app-capability-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-2">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="High-Speed Inline Inspection &amp; Reject Control"
                            data-lang-id="Inspeksi Inline Kecepatan Tinggi &amp; Kontrol Reject"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            High-Speed Inline Inspection &amp; Reject Control
                        </h3>
                        <p data-lang-en="Synchronized optical defect detection, OCR/barcode verification, capper alignment checks, and pneumatic reject actuators operating cleanly at full conveyor speed."
                            data-lang-id="Deteksi cacat optik tersinkronisasi, verifikasi OCR/barcode, pemeriksaan posisi tutup botol, serta aktuator reject pneumatik pada kecepatan penuh konveyor."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Synchronized optical defect detection, OCR/barcode verification, capper alignment checks,
                            and pneumatic reject actuators operating cleanly at full conveyor speed.
                        </p>
                    </div>

                    <!-- Capability 3 -->
                    <div class="app-capability-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-3">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="Real-Time OEE, Utility &amp; Alarm Telemetry"
                            data-lang-id="Telemetri OEE, Utilitas &amp; Alarm Real-Time"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Real-Time OEE, Utility &amp; Alarm Telemetry
                        </h3>
                        <p data-lang-en="Live shift output tracking, cleanroom temperature &amp; humidity logging, electrical power monitoring, and instant anomaly alerts for plant engineering teams."
                            data-lang-id="Pemantauan output shift secara langsung, pencatatan suhu &amp; kelembapan ruang steril, monitoring daya listrik, serta notifikasi anomali instan bagi tim teknisi."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Live shift output tracking, cleanroom temperature &amp; humidity logging, electrical power
                            monitoring, and instant anomaly alerts for plant engineering teams.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. REAL APPLICATION PERFORMANCE METRICS — Dark Band + 4 White Solid Cards -->
    <!-- ========================================================================= -->
    <section class="bg-black text-white py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <!-- Split Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-8 mb-10 reveal-on-scroll">
                <div class="max-w-2xl">
                    <h2 data-lang-en="Proven Performance Across Mission-Critical Production Lines."
                        data-lang-id="Performa Terbukti di Lini Produksi Berstandar Tinggi."
                        class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-white font-['Agrandir',sans-serif] tracking-tight leading-[1.12]">
                        Proven Performance Across Mission-Critical Production Lines.
                    </h2>
                </div>
                <p data-lang-en="Real engineering capabilities verified across industrial installations by PT Global Aspect Technology since 2017."
                    data-lang-id="Kapabilitas rekayasa nyata yang teruji di berbagai instalasi industri PT Global Aspect Technology sejak 2017."
                    class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed max-w-md lg:text-right">
                    Real engineering capabilities verified across industrial installations by PT Global Aspect
                    Technology since 2017.
                </p>
            </div>

            <!-- 4-Column Pure White Solid KPI Cards (Zero Outline, Verified D:\GAT-Teknisi Engineering Metrics) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-7">
                <!-- Metric 1 -->
                <div class="app-kpi-card p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-1">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        500+</div>
                    <h3 data-lang-en="PLC, HMI &amp; Vision Programs" data-lang-id="Program PLC, HMI &amp; Vision"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        PLC, HMI &amp; Vision Programs
                    </h3>
                    <p data-lang-en="Production-tested PLC ladder logic, touchscreen HMI operator interfaces, and machine vision inspection programs deployed across lines."
                        data-lang-id="Program logika PLC, antarmuka operator HMI layar sentuh, dan program inspeksi kamera machine vision di berbagai lini pabrik."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Production-tested PLC ladder logic, touchscreen HMI operator interfaces, and machine vision
                        inspection programs deployed across lines.
                    </p>
                </div>

                <!-- Metric 2 -->
                <div class="app-kpi-card p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-2">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        256+ I/O</div>
                    <h3 data-lang-en="Modular PLC Control Panels" data-lang-id="Panel Kontrol PLC Modular"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Modular PLC Control Panels
                    </h3>
                    <p data-lang-en="Scalable 32 to 256+ digital &amp; analog I/O capacity across Siemens, Mitsubishi, Omron, and Allen-Bradley PLC panels built to IEC 61439."
                        data-lang-id="Kapasitas I/O digital &amp; analog 32 hingga 256+ titik pada panel PLC Siemens, Mitsubishi, Omron, dan Allen-Bradley standar IEC 61439."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Scalable 32 to 256+ digital &amp; analog I/O capacity across Siemens, Mitsubishi, Omron, and
                        Allen-Bradley PLC panels built to IEC 61439.
                    </p>
                </div>

                <!-- Metric 3 -->
                <div class="app-kpi-card p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-3">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        1,000+</div>
                    <h3 data-lang-en="Electrical &amp; Mechanical Drawings" data-lang-id="Gambar Elektrikal &amp; Mekanikal"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Electrical &amp; Mechanical Drawings
                    </h3>
                    <p data-lang-en="Engineered 3D mechanical CAD assemblies, IEC 61439 electrical panel wiring schematics, and commissioning documentation."
                        data-lang-id="Desain CAD mekanikal 3D, skematik pengkabelan panel listrik standar IEC 61439, serta dokumentasi komisioning lapangan."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Engineered 3D mechanical CAD assemblies, IEC 61439 electrical panel wiring schematics, and
                        commissioning documentation.
                    </p>
                </div>

                <!-- Metric 4 -->
                <div class="app-kpi-card p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-4">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        200+</div>
                    <h3 data-lang-en="Partner Manufacturing Companies" data-lang-id="Perusahaan Mitra Manufaktur"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Partner Manufacturing Companies
                    </h3>
                    <p data-lang-en="Trusted by over 200 Indonesian and multinational production plants supported directly from our engineering team."
                        data-lang-id="Dipercaya lebih dari 200 pabrik manufaktur nasional dan multinasional dengan dukungan tim teknisi lapangan kami."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Trusted by over 200 Indonesian and multinational production plants supported directly from our
                        engineering team.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. EXPLORE INDUSTRY SECTORS — 5 Obsidian Black Solid Cards (3 + 2 Grid)   -->
    <!-- ========================================================================= -->
    <section class="bg-white text-neutral-900 pt-20 sm:pt-24 lg:pt-32 pb-8 sm:pb-12">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <!-- Split Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 sm:mb-14 reveal-on-scroll">
                <div class="max-w-2xl">
                    <h2 data-lang-en="Explore Industry Sectors" data-lang-id="Jelajahi Sektor Industri"
                        class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.12]">
                        Explore Industry Sectors
                    </h2>
                </div>
                <p data-lang-en="Select an industrial domain to inspect tailored automation architectures, real deployment scopes, and interactive simulations."
                    data-lang-id="Pilih sektor industri untuk melihat arsitektur otomasi khusus, ruang lingkup implementasi nyata, dan simulasi interaktif."
                    class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed max-w-md lg:text-right">
                    Select an industrial domain to inspect tailored automation architectures, real deployment scopes,
                    and interactive simulations.
                </p>
            </div>

            <!-- Balanced 3 + 2 Obsidian Black Solid Cards (Zero Outline) -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6 lg:gap-7">
                <!-- Sector 1: Manufacturing & FMCG -->
                <a href="{{ route('application.manufacturing') }}"
                    class="app-sector-card group md:col-span-2 rounded-3xl p-8 sm:p-9 flex flex-col justify-between gap-6 reveal-on-scroll reveal-stagger-1">
                    <div class="space-y-4">
                        <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                        <h3 data-lang-en="Manufacturing &amp; FMCG" data-lang-id="Manufaktur &amp; FMCG"
                            class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                            Manufacturing &amp; FMCG
                        </h3>
                        <p data-lang-en="High-speed bottling lines, automated case packing, inline coding &amp; marking, and real-time OEE production telemetry."
                            data-lang-id="Lini pembotolan kecepatan tinggi, pengemasan karton otomatis, coding &amp; marking inline, dan telemetri OEE real-time."
                            class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                            High-speed bottling lines, automated case packing, inline coding &amp; marking, and
                            real-time OEE production telemetry.
                        </p>
                    </div>
                    <div class="pt-2 flex items-center justify-between text-xs sm:text-sm font-semibold text-white group-hover:text-[#7FB0EA] transition-colors font-['Questrial',sans-serif]">
                        <span data-lang-en="Explore Manufacturing" data-lang-id="Lihat Manufaktur">Explore
                            Manufacturing</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>

                <!-- Sector 2: Automotive Assembly -->
                <a href="{{ route('application.automotive') }}"
                    class="app-sector-card group md:col-span-2 rounded-3xl p-8 sm:p-9 flex flex-col justify-between gap-6 reveal-on-scroll reveal-stagger-2">
                    <div class="space-y-4">
                        <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                        <h3 data-lang-en="Automotive Assembly" data-lang-id="Perakitan Otomotif"
                            class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                            Automotive Assembly
                        </h3>
                        <p data-lang-en="Precision part-presence verification, laser traceability marking, poka-yoke assembly jigs, and multi-axis PLC synchronization."
                            data-lang-id="Verifikasi presisi komponen, laser marking ketertelusuran, jig perakitan poka-yoke, dan sinkronisasi PLC multi-sumbu."
                            class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                            Precision part-presence verification, laser traceability marking, poka-yoke assembly jigs,
                            and multi-axis PLC synchronization.
                        </p>
                    </div>
                    <div class="pt-2 flex items-center justify-between text-xs sm:text-sm font-semibold text-white group-hover:text-[#7FB0EA] transition-colors font-['Questrial',sans-serif]">
                        <span data-lang-en="Explore Automotive" data-lang-id="Lihat Otomotif">Explore
                            Automotive</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>

                <!-- Sector 3: Pharmaceutical & Cleanroom -->
                <a href="{{ route('application.pharma') }}"
                    class="app-sector-card group md:col-span-2 rounded-3xl p-8 sm:p-9 flex flex-col justify-between gap-6 reveal-on-scroll reveal-stagger-3">
                    <div class="space-y-4">
                        <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                        <h3 data-lang-en="Pharmaceutical &amp; Cleanroom" data-lang-id="Farmasi &amp; Ruang Steril"
                            class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                            Pharmaceutical &amp; Cleanroom
                        </h3>
                        <p data-lang-en="GMP-compliant ampoule &amp; blister vision inspection, 2D batch serialization, print OCR verification, and sterile filling integration."
                            data-lang-id="Inspeksi visi ampul &amp; blister standar CPOB/GMP, serialisasi batch 2D, verifikasi cetak OCR, dan integrasi mesin filling steril."
                            class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                            GMP-compliant ampoule &amp; blister vision inspection, 2D batch serialization, print OCR
                            verification, and sterile filling integration.
                        </p>
                    </div>
                    <div class="pt-2 flex items-center justify-between text-xs sm:text-sm font-semibold text-white group-hover:text-[#7FB0EA] transition-colors font-['Questrial',sans-serif]">
                        <span data-lang-en="Explore Pharma" data-lang-id="Lihat Farmasi">Explore Pharma</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>

                <!-- Sector 4: Packaging & Logistics -->
                <a href="{{ route('application.packaging') }}"
                    class="app-sector-card group md:col-span-3 rounded-3xl p-8 sm:p-10 flex flex-col justify-between gap-6 reveal-on-scroll reveal-stagger-4">
                    <div class="space-y-4">
                        <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                        <h3 data-lang-en="Packaging &amp; End-of-Line Logistics"
                            data-lang-id="Pengemasan &amp; Logistik Akhir Lini"
                            class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                            Packaging &amp; End-of-Line Logistics
                        </h3>
                        <p data-lang-en="Automated carton counting, checkweighers, friction-weld strapping cells, barcode sorting conveyors, and palletizing integration."
                            data-lang-id="Penghitungan karton otomatis, checkweigher, stasiun strapping las gesek, konveyor sortir barcode, dan integrasi paletisasi."
                            class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                            Automated carton counting, checkweighers, friction-weld strapping cells, barcode sorting
                            conveyors, and palletizing integration.
                        </p>
                    </div>
                    <div class="pt-2 flex items-center justify-between text-xs sm:text-sm font-semibold text-white group-hover:text-[#7FB0EA] transition-colors font-['Questrial',sans-serif]">
                        <span data-lang-en="Explore Packaging &amp; Logistics"
                            data-lang-id="Lihat Pengemasan &amp; Logistik">Explore Packaging &amp; Logistics</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>

                <!-- Sector 5: Smart BMS & Utilities -->
                <a href="{{ route('application.bms') }}"
                    class="app-sector-card group md:col-span-3 rounded-3xl p-8 sm:p-10 flex flex-col justify-between gap-6 reveal-on-scroll reveal-stagger-5">
                    <div class="space-y-4">
                        <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                        <h3 data-lang-en="Smart BMS &amp; Industrial Utilities"
                            data-lang-id="Smart BMS &amp; Utilitas Industri"
                            class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                            Smart BMS &amp; Industrial Utilities
                        </h3>
                        <p data-lang-en="Centralized HVAC &amp; cleanroom environmental monitoring, chiller &amp; exhaust telemetry, electrical power metering, and ISO 50001 energy analytics."
                            data-lang-id="Pemantauan HVAC &amp; lingkungan ruang steril terpusat, telemetri chiller &amp; exhaust, pengukuran daya listrik, serta analitik energi ISO 50001."
                            class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                            Centralized HVAC &amp; cleanroom environmental monitoring, chiller &amp; exhaust telemetry,
                            electrical power metering, and ISO 50001 energy analytics.
                        </p>
                    </div>
                    <div class="pt-2 flex items-center justify-between text-xs sm:text-sm font-semibold text-white group-hover:text-[#7FB0EA] transition-colors font-['Questrial',sans-serif]">
                        <span data-lang-en="Explore Smart BMS" data-lang-id="Lihat Smart BMS">Explore Smart BMS</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 6. CONSULTATION CTA (Floating Corporate Royal Blue Card, No Eyebrow)      -->
    <!-- ========================================================================= -->
    <x-cta-banner eyebrow-en="" eyebrow-id="" title-en="Have an Application in Mind for Your Plant?"
        title-id="Punya Kebutuhan Aplikasi Otomasi untuk Pabrik Anda?"
        description-en="Contact our system architects for custom architecture drafting, fieldbus interfacing, and proof-of-concept testing."
        description-id="Hubungi arsitek sistem kami untuk perancangan arsitektur khusus, integrasi fieldbus, dan pengujian proof-of-concept di fasilitas Anda."
        primary-label-en="Request Technical Consultation" primary-label-id="Minta Konsultasi Teknis"
        wa-message="Halo Tim Marketing PT Global Aspect Technology, saya ingin berdiskusi mengenai kebutuhan aplikasi otomasi untuk pabrik kami." />

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Script for Smooth Scroll & Observer -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                });
                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>

</html>
