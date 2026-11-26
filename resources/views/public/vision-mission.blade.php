<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision, Mission &amp; Goals - PT. Global Aspect Technology</title>
    @include('components.seo-meta', [
        'seoTitle' => 'Vision, Mission & Goals — PT Global Aspect Technology',
        'seoDescription' => 'Our vision, engineering mission, and operational values driving industrial PLC automation, machine vision, and long-term manufacturing reliability since 2017.',
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

        .reveal-stagger-6 {
            transition-delay: 0.48s;
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

        /* Editorial Vision-Mission Interactions (Zero Outline, Immune to Bootstrap .border) */
        .vm-mission-row {
            border: 0 !important;
            outline: none !important;
            border-radius: 16px;
            transition: background-color 0.25s ease;
        }

        .vm-mission-row:hover {
            background-color: #F8FAFC;
        }

        .vm-kpi-col {
            border: 0 !important;
            outline: none !important;
            background-color: #ffffff !important;
            border-radius: 24px;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.35);
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }

        .vm-kpi-col:hover {
            background-color: #FFFFFF !important;
            transform: translateY(-4px);
            box-shadow: 0 22px 48px rgba(0, 0, 0, 0.48);
        }

        .vm-value-tile {
            border: 0 !important;
            outline: none !important;
            background-color: #000000 !important;
            box-shadow: 0 16px 38px rgba(0, 0, 0, 0.18);
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
        }

        .vm-value-tile:hover {
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
    <!-- 1. HERO SECTION — GAYA B (Idealworks Dark Full-Bleed with Video)          -->
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
                    <h1 data-lang-en="Vision, Mission &amp; Goals." data-lang-id="Visi, Misi &amp; Tujuan."
                        class="text-4xl sm:text-5xl md:text-6xl lg:text-[68px] font-extrabold font-['Agrandir',sans-serif] tracking-tight text-white leading-[1.06] text-left">
                        Vision, Mission &amp; Goals.
                    </h1>
                </div>
                <div class="lg:col-span-5 min-w-0">
                    <p data-lang-en="Guiding our engineering excellence, fostering enduring client trust, and shaping the future of industrial automation across Indonesia."
                        data-lang-id="Memandu keunggulan rekayasa kami, memupuk kepercayaan klien yang kokoh, dan membentuk masa depan otomasi industri di seluruh Indonesia."
                        class="text-sm sm:text-base lg:text-lg text-slate-200 font-['Questrial',sans-serif] leading-relaxed text-left">
                        Guiding our engineering excellence, fostering enduring client trust, and shaping the future of
                        industrial automation across Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. OUR CORPORATE VISION — Anduril Sticky Split (40% / 60%, Zero Boxes)    -->
    <!-- ========================================================================= -->
    <section id="corporate-vision" class="bg-white text-neutral-900 py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">
                <!-- Left Sticky Manifesto (5 Cols) -->
                <div class="lg:col-span-5 min-w-0 lg:sticky lg:top-28 space-y-5 reveal-on-scroll">
                    <h2 data-lang-en="Becoming Indonesia’s Most Trusted Industrial Integration Partner."
                        data-lang-id="Menjadi Mitra Integrasi Industri Paling Tepercaya di Indonesia."
                        class="text-3xl sm:text-4xl lg:text-[40px] font-extrabold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.15]">
                        Becoming Indonesia’s Most Trusted Industrial Integration Partner.
                    </h2>
                    <p data-lang-en="To become a trusted, world-class industrial system integration company in Indonesia and provide the best guarantee of every solution delivered for consumer needs."
                        data-lang-id="Menjadi perusahaan integrasi sistem industri tepercaya berstandar kelas dunia di Indonesia serta memberikan jaminan terbaik dari setiap solusi yang dihadirkan untuk kebutuhan konsumen."
                        class="text-base sm:text-lg text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        To become a trusted, world-class industrial system integration company in Indonesia and provide
                        the best guarantee of every solution delivered for consumer needs.
                    </p>
                </div>

                <!-- Right Editorial Pillars (7 Cols) — Zero Divider Lines -->
                <div class="lg:col-span-7 min-w-0 space-y-8 sm:space-y-10">
                    <!-- Pillar 1 -->
                    <div class="space-y-3 reveal-on-scroll reveal-stagger-1">
                        <h3 data-lang-en="National Integration Standard" data-lang-id="Standar Integrasi Nasional"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            National Integration Standard
                        </h3>
                        <p data-lang-en="Setting the national benchmark in PLC programming, robotic cell synchronization, and optical quality verification across domestic industries."
                            data-lang-id="Menjadi tolok ukur nasional dalam pemrograman PLC, sinkronisasi sel robotik, dan verifikasi mutu optik di seluruh sektor industri tanah air."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Setting the national benchmark in PLC programming, robotic cell synchronization, and optical
                            quality verification across domestic industries.
                        </p>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="space-y-3 reveal-on-scroll reveal-stagger-2">
                        <h3 data-lang-en="Sustainable Automation" data-lang-id="Otomasi Berkelanjutan"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Sustainable Automation
                        </h3>
                        <p data-lang-en="Delivering resilient industrial architectures that maximize operational efficiency, lower electrical consumption, and eradicate costly production waste."
                            data-lang-id="Menghadirkan arsitektur industri tangguh yang memaksimalkan efisiensi operasional, menekan konsumsi daya listrik, dan memangkas pemborosan produksi."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Delivering resilient industrial architectures that maximize operational efficiency, lower
                            electrical consumption, and eradicate costly production waste.
                        </p>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="space-y-3 reveal-on-scroll reveal-stagger-3">
                        <h3 data-lang-en="Zero-Downtime Guarantee" data-lang-id="Jaminan Tanpa Henti"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Zero-Downtime Guarantee
                        </h3>
                        <p data-lang-en="Providing manufacturing clients with total peace of mind through fail-safe system logic, real-time telemetry, and dedicated after-sales SLA guarantees."
                            data-lang-id="Memberikan ketenangan menyeluruh bagi klien manufaktur melalui logika sistem fail-safe, telemetri real-time, dan jaminan SLA purnajual yang berdedikasi."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Providing manufacturing clients with total peace of mind through fail-safe system logic,
                            real-time telemetry, and dedicated after-sales SLA guarantees.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. OUR GUIDING MISSION — Idealworks 50/50 Actual Photo + Editorial List   -->
    <!-- ========================================================================= -->
    <section class="bg-white text-neutral-900 py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-stretch">
                <!-- Left Actual Machine Video Frame (5 Cols) -->
                <div
                    class="lg:col-span-5 min-w-0 relative rounded-3xl overflow-hidden bg-black min-h-[360px] sm:min-h-[420px] flex flex-col justify-end p-7 sm:p-9 shadow-[0_20px_50px_rgba(13,37,84,0.16)] reveal-on-scroll">
                    <video autoplay loop muted playsinline preload="auto"
                        class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none">
                        <source src="{{ asset('storage/' . rawurlencode('Machine Thermal Inkject.mp4')) }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 pointer-events-none"
                        style="background: linear-gradient(180deg, rgba(13,37,84,0.28) 0%, rgba(0,0,0,0.32) 45%, rgba(0,0,0,0.92) 100%);">
                    </div>

                    <div class="relative z-10 space-y-3">
                        <h2 data-lang-en="Engineered Competence &amp; Uncompromising Support."
                            data-lang-id="Kompetensi Rekayasa &amp; Dukungan Tanpa Kompromi."
                            class="text-2xl sm:text-3xl font-extrabold text-white font-['Agrandir',sans-serif] leading-tight">
                            Engineered Competence &amp; Uncompromising Support.
                        </h2>
                        <p data-lang-en="Competence development of each of our employees, to always be able to provide services to consumer needs and provide the best after-sales support services to consumers."
                            data-lang-id="Pengembangan kompetensi setiap karyawan kami, agar senantiasa mampu memberikan pelayanan terbaik terhadap kebutuhan konsumen serta menghadirkan layanan purnajual yang optimal."
                            class="text-sm text-slate-200 font-['Questrial',sans-serif] leading-relaxed">
                            Competence development of each of our employees, to always be able to provide services to
                            consumer needs and provide the best after-sales support services to consumers.
                        </p>
                    </div>
                </div>

                <!-- Right 3 Guiding Mission Commitments (7 Cols) — Clean Editorial Rows -->
                <div class="lg:col-span-7 min-w-0 flex flex-col justify-center space-y-2">
                    <!-- Mission 1 -->
                    <div class="vm-mission-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-1">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="Client-Centric Tailored Engineering"
                            data-lang-id="Rekayasa Khusus Berorientasi Klien"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Client-Centric Tailored Engineering
                        </h3>
                        <p data-lang-en="Deeply analyzing the unique mechanical parameters, cycle speeds, and factory floor constraints of each client to build customized solutions rather than one-size-fits-all hardware."
                            data-lang-id="Menganalisis secara mendalam parameter mekanis unik, kecepatan siklus, dan kendala lantai pabrik klien demi membangun solusi yang benar-benar sesuai kebutuhan."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Deeply analyzing the unique mechanical parameters, cycle speeds, and factory floor
                            constraints of each client to build customized solutions rather than one-size-fits-all
                            hardware.
                        </p>
                    </div>

                    <!-- Mission 2 -->
                    <div class="vm-mission-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-2">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="Continuous Employee Empowerment"
                            data-lang-id="Pemberdayaan Berkelanjutan Karyawan"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Continuous Employee Empowerment
                        </h3>
                        <p data-lang-en="Investing in continuous training, international manufacturer certifications, and hands-on testing labs for our engineers to ensure mastery over latest industrial IoT and robotics."
                            data-lang-id="Berinvestasi pada pelatihan berkelanjutan, sertifikasi manufaktur global, dan laboratorium uji mandiri untuk memastikan para teknisi menguasai IoT industri dan robotika terkini."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Investing in continuous training, international manufacturer certifications, and hands-on
                            testing labs for our engineers to ensure mastery over latest industrial IoT and robotics.
                        </p>
                    </div>

                    <!-- Mission 3 -->
                    <div class="vm-mission-row p-6 sm:p-7 space-y-2.5 reveal-on-scroll reveal-stagger-3">
                        <div class="w-8 h-1 rounded-full bg-[#3367A5]"></div>
                        <h3 data-lang-en="Uncompromising After-Sales SLA"
                            data-lang-id="Komitmen Purnajual &amp; SLA Tanpa Kompromi"
                            class="text-xl sm:text-2xl font-bold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight">
                            Uncompromising After-Sales SLA
                        </h3>
                        <p data-lang-en="Standing shoulder-to-shoulder with our plant managers long after commissioning with rapid spare parts dispatch, preventive maintenance, and 24/7 technical advisory."
                            data-lang-id="Mendampingi para manajer pabrik secara berkelanjutan setelah komisioning dengan ketersediaan suku cadang cepat, perawatan preventif, dan konsultasi teknis 24/7."
                            class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                            Standing shoulder-to-shoulder with our plant managers long after commissioning with rapid
                            spare parts dispatch, preventive maintenance, and 24/7 technical advisory.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. REAL COMPANY TRACK RECORD & CAPABILITIES (Verified GAT Data)           -->
    <!-- ========================================================================= -->
    <section class="bg-black text-white py-20 sm:py-24 lg:py-32">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <!-- Split Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-8 mb-10 reveal-on-scroll">
                <div class="max-w-2xl">
                    <h2 data-lang-en="Proven Engineering Track Record Across Indonesian Manufacturing."
                        data-lang-id="Rekam Jejak Rekayasa Nyata di Industri Manufaktur Indonesia."
                        class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-white font-['Agrandir',sans-serif] tracking-tight leading-[1.12]">
                        Proven Engineering Track Record Across Indonesian Manufacturing.
                    </h2>
                </div>
                <p data-lang-en="Real operational milestones achieved by PT Global Aspect Technology since 2017 across industrial automation, machine vision, coding, and system integration."
                    data-lang-id="Capaian operasional nyata PT Global Aspect Technology sejak 2017 di bidang otomasi industri, machine vision, coding &amp; marking, dan integrasi sistem."
                    class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed max-w-md lg:text-right">
                    Real operational milestones achieved by PT Global Aspect Technology since 2017 across industrial
                    automation, machine vision, coding, and system integration.
                </p>
            </div>

            <!-- 4-Column White Solid KPI Cards (Verified Real GAT Project Data, Zero Outline) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-7">
                <!-- Metric 1 -->
                <div class="vm-kpi-col p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-1">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        2017</div>
                    <h3 data-lang-en="Established in Indonesia" data-lang-id="Berdiri Sejak 2017"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Established in Indonesia
                    </h3>
                    <p data-lang-en="Hands-on industrial automation engineering, custom PLC panel fabrication, and turnkey factory floor integration."
                        data-lang-id="Pengalaman langsung di lapangan dalam rekayasa otomasi industri, fabrikasi panel PLC kustom, dan integrasi lini pabrik siap pakai."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Hands-on industrial automation engineering, custom PLC panel fabrication, and turnkey factory
                        floor integration.
                    </p>
                </div>

                <!-- Metric 2 -->
                <div class="vm-kpi-col p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-2">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        200+</div>
                    <h3 data-lang-en="Partner Companies" data-lang-id="Mitra Perusahaan"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Partner Companies
                    </h3>
                    <p data-lang-en="Trusted by over 200 industrial companies served across automotive, pharmaceutical, FMCG, packaging, and utility plants."
                        data-lang-id="Dipercaya lebih dari 200 perusahaan industri di sektor otomotif, farmasi, FMCG, pengemasan, dan fasilitas utilitas."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Trusted by over 200 industrial companies served across automotive, pharmaceutical, FMCG,
                        packaging, and utility plants.
                    </p>
                </div>

                <!-- Metric 3 -->
                <div class="vm-kpi-col p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-3">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        1,000+</div>
                    <h3 data-lang-en="Electrical &amp; Mechanical Drawings" data-lang-id="Gambar Elektrikal &amp; Mekanikal"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        Electrical &amp; Mechanical Drawings
                    </h3>
                    <p data-lang-en="Complete 3D mechanical CAD assemblies, panel wiring diagrams, BOM part lists, and as-built factory documentation."
                        data-lang-id="Rakitan CAD mekanikal 3D lengkap, diagram pengkabelan panel, daftar komponen BOM, serta dokumentasi pabrik terpasang."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Complete 3D mechanical CAD assemblies, panel wiring diagrams, BOM part lists, and as-built
                        factory documentation.
                    </p>
                </div>

                <!-- Metric 4 -->
                <div class="vm-kpi-col p-7 sm:p-8 space-y-3 reveal-on-scroll reveal-stagger-4">
                    <div
                        class="text-4xl sm:text-5xl font-extrabold text-[#3367A5] font-['Agrandir',sans-serif] tracking-tight">
                        500+</div>
                    <h3 data-lang-en="PLC, HMI &amp; Vision Programs" data-lang-id="Program PLC, HMI &amp; Vision"
                        class="text-lg font-bold text-neutral-950 font-['Agrandir',sans-serif] leading-snug">
                        PLC, HMI &amp; Vision Programs
                    </h3>
                    <p data-lang-en="Production-tested PLC ladder logic, SCADA/HMI operator screens, and machine vision inspection programs deployed on plant floors."
                        data-lang-id="Program logika PLC, layar operator SCADA/HMI, serta algoritma inspeksi kamera machine vision yang teruji di lini produksi."
                        class="text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                        Production-tested PLC ladder logic, SCADA/HMI operator screens, and machine vision inspection
                        programs deployed on plant floors.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. OUR 4 FOUNDATIONAL VALUES — Swiss 2x2 Borderless Editorial Grid        -->
    <!-- ========================================================================= -->
    <section class="bg-white text-neutral-900 pt-20 sm:pt-24 lg:pt-32 pb-8 sm:pb-12">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <!-- Split Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 sm:mb-14 reveal-on-scroll">
                <div class="max-w-2xl">
                    <h2 data-lang-en="Our 4 Foundational Values" data-lang-id="4 Pilar Nilai Utama Kami"
                        class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-neutral-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.12]">
                        Our 4 Foundational Values
                    </h2>
                </div>
                <p data-lang-en="The enduring cultural tenets that define our relationships with clients, team members, and the manufacturing community."
                    data-lang-id="Prinsip budaya yang mendefinisikan hubungan kami dengan para klien, anggota tim, serta ekosistem industri manufaktur."
                    class="text-sm sm:text-base text-neutral-600 font-['Questrial',sans-serif] leading-relaxed max-w-md lg:text-right">
                    The enduring cultural tenets that define our relationships with clients, team members, and the
                    manufacturing community.
                </p>
            </div>

            <!-- 2x2 Spacious Borderless Obsidian Black Value Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <!-- Value 1 -->
                <div class="vm-value-tile rounded-3xl p-8 sm:p-10 space-y-4 reveal-on-scroll reveal-stagger-1">
                    <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                    <h3 data-lang-en="Lasting Partnerships" data-lang-id="Kemitraan Jangka Panjang"
                        class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                        Lasting Partnerships
                    </h3>
                    <p data-lang-en="Maintain excellent service to foster lasting partnerships with our customers and clients across every project phase."
                        data-lang-id="Menjaga kualitas layanan unggul demi membina kemitraan jangka panjang bersama para pelanggan dan mitra kerja di setiap fase proyek."
                        class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                        Maintain excellent service to foster lasting partnerships with our customers and clients across
                        every project phase.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="vm-value-tile rounded-3xl p-8 sm:p-10 space-y-4 reveal-on-scroll reveal-stagger-2">
                    <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                    <h3 data-lang-en="Kindness &amp; Trust" data-lang-id="Integritas &amp; Kepercayaan"
                        class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                        Kindness &amp; Trust
                    </h3>
                    <p data-lang-en="Believe in treating our customers with sincerity, mutual respect, transparent communication, and enduring trust."
                        data-lang-id="Membangun relasi bersama pelanggan berlandaskan ketulusan, rasa saling menghargai, komunikasi transparan, dan kepercayaan yang kokoh."
                        class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                        Believe in treating our customers with sincerity, mutual respect, transparent communication, and
                        enduring trust.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="vm-value-tile rounded-3xl p-8 sm:p-10 space-y-4 reveal-on-scroll reveal-stagger-3">
                    <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                    <h3 data-lang-en="Creativity &amp; Innovation" data-lang-id="Kreativitas &amp; Inovasi"
                        class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                        Creativity &amp; Innovation
                    </h3>
                    <p data-lang-en="Continue to grow and lead by actively embracing creativity, cutting-edge engineering, and ongoing technological evolution."
                        data-lang-id="Terus berkembang dan memimpin dengan aktif merangkul kreativitas, rekayasa mutakhir, serta evolusi teknologi berkelanjutan."
                        class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                        Continue to grow and lead by actively embracing creativity, cutting-edge engineering, and
                        ongoing technological evolution.
                    </p>
                </div>

                <!-- Value 4 -->
                <div class="vm-value-tile rounded-3xl p-8 sm:p-10 space-y-4 reveal-on-scroll reveal-stagger-4">
                    <div class="w-10 h-1 rounded-full bg-[#7FB0EA]"></div>
                    <h3 data-lang-en="Team Development" data-lang-id="Pengembangan Tim"
                        class="text-xl sm:text-2xl font-bold text-white font-['Agrandir',sans-serif] tracking-tight">
                        Team Development
                    </h3>
                    <p data-lang-en="Constantly enhance the specialized capabilities of our dedicated team to drive service development and lasting operational excellence."
                        data-lang-id="Senantiasa meningkatkan kapabilitas teknis tim demi mendorong kemajuan layanan dan keunggulan operasional yang langgeng."
                        class="text-sm sm:text-base text-slate-300 font-['Questrial',sans-serif] leading-relaxed">
                        Constantly enhance the specialized capabilities of our dedicated team to drive service
                        development and lasting operational excellence.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 6. COLLABORATION CTA (Floating Corporate Royal Blue Card)                 -->
    <!-- ========================================================================= -->
    <x-cta-banner eyebrow-en="" eyebrow-id="" title-en="Ready to Elevate Your Plant's Operational Future?"
        title-id="Siap Meningkatkan Masa Depan Operasional Pabrik Anda?"
        description-en="Partner with our automation and integration engineers to design fail-safe systems tailored to your production goals."
        description-id="Bermitra dengan teknisi otomasi dan integrasi kami untuk merancang sistem fail-safe yang disesuaikan dengan target produksi Anda."
        primary-label-en="Consult With Our Engineers" primary-label-id="Konsultasi Bersama Teknisi Kami"
        wa-message="Halo Tim Marketing PT Global Aspect Technology, saya ingin berdiskusi mengenai solusi otomasi untuk pabrik kami." />

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Smooth Scroll & Reveal Logic -->
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
                console.warn('Lenis scroll initialization error:', e);
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
