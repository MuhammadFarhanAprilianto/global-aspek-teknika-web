<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision, Mission &amp; Goals - PT. Global Aspect Technology</title>

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
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION (Video / Ambient Dark Header)                             -->
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
            <h1 data-lang-en="VISION, MISSION &amp; GOALS" data-lang-id="VISI, MISI &amp; TUJUAN"
                class="text-3xl sm:text-5xl md:text-6xl lg:text-[64px] font-bold uppercase font-['Agrandir'] tracking-tight text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                VISION, MISSION &amp; GOALS
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-4 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]"></div>

            <p data-lang-en="Guiding our engineering excellence, fostering enduring client trust, and shaping the future of industrial automation across Indonesia."
               data-lang-id="Memandu keunggulan rekayasa kami, memupuk kepercayaan klien yang kokoh, dan membentuk masa depan otomasi industri di seluruh Indonesia."
                class="text-sm sm:text-base md:text-lg text-gray-300 font-['Questrial'] max-w-2xl mt-5 leading-relaxed">
                Guiding our engineering excellence, fostering enduring client trust, and shaping the future of industrial automation across Indonesia.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. VISION SECTION (Strategic Horizons)                                    -->
    <!-- ========================================================================= -->
    <section class="bg-[#000000] text-gray-200 py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="OUR CORPORATE VISION" data-lang-id="VISI PERUSAHAAN KAMI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir'] mt-2">
                    OUR CORPORATE VISION
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="To become a trusted, world-class industrial system integration company in Indonesia and provide the best guarantee of every solution delivered for consumer needs."
                   data-lang-id="Menjadi perusahaan integrasi sistem industri tepercaya berstandar kelas dunia di Indonesia serta memberikan jaminan terbaik dari setiap solusi yang dihadirkan untuk kebutuhan konsumen."
                    class="text-base sm:text-lg text-gray-300 leading-relaxed font-['Questrial']">
                    To become a trusted, world-class industrial system integration company in Indonesia and provide the best guarantee of every solution delivered for consumer needs.
                </p>
            </div>

            <!-- Vision Pillars (3 White Modern Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Pillar 1 -->
                <div class="p-8 rounded-3xl bg-white border border-neutral-100 transition-all duration-300 space-y-4 reveal-on-scroll reveal-stagger-1 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center text-xl font-bold font-['Agrandir'] shadow-xs">
                            01
                        </div>
                        <h3 data-lang-en="National Integration Standard" data-lang-id="Standar Integrasi Nasional"
                            class="text-xl font-bold text-neutral-900 font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            National Integration Standard
                        </h3>
                        <p data-lang-en="Setting the national benchmark in PLC programming, robotic cell synchronization, and optical quality verification across domestic industries."
                           data-lang-id="Menjadi tolok ukur nasional dalam pemrograman PLC, sinkronisasi sel robotik, dan verifikasi mutu optik di seluruh sektor industri tanah air."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.75rem] sm:min-h-[5.25rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Setting the national benchmark in PLC programming, robotic cell synchronization, and optical quality verification across domestic industries.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-[#3367A5] font-bold uppercase tracking-wider font-['Agrandir']"
                        data-lang-en="Tier-1 Engineering" data-lang-id="Rekayasa Tier-1">
                        Tier-1 Engineering
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div class="p-8 rounded-3xl bg-white border border-neutral-100 transition-all duration-300 space-y-4 reveal-on-scroll reveal-stagger-2 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center text-xl font-bold font-['Agrandir'] shadow-xs">
                            02
                        </div>
                        <h3 data-lang-en="Sustainable Automation" data-lang-id="Otomasi Berkelanjutan"
                            class="text-xl font-bold text-neutral-900 font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            Sustainable Automation
                        </h3>
                        <p data-lang-en="Delivering resilient industrial architectures that maximize operational efficiency, lower electrical consumption, and eradicate costly production waste."
                           data-lang-id="Menghadirkan arsitektur industri tangguh yang memaksimalkan efisiensi operasional, menekan konsumsi daya listrik, dan memangkas pemborosan produksi."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.75rem] sm:min-h-[5.25rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Delivering resilient industrial architectures that maximize operational efficiency, lower electrical consumption, and eradicate costly production waste.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-[#3367A5] font-bold uppercase tracking-wider font-['Agrandir']"
                        data-lang-en="Eco-Efficient Operations" data-lang-id="Operasional Eko-Efisien">
                        Eco-Efficient Operations
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div class="p-8 rounded-3xl bg-white border border-neutral-100 transition-all duration-300 space-y-4 reveal-on-scroll reveal-stagger-3 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center text-xl font-bold font-['Agrandir'] shadow-xs">
                            03
                        </div>
                        <h3 data-lang-en="Zero-Downtime Guarantee" data-lang-id="Jaminan Tanpa Henti"
                            class="text-xl font-bold text-neutral-900 font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            Zero-Downtime Guarantee
                        </h3>
                        <p data-lang-en="Providing manufacturing clients with total peace of mind through fail-safe system logic, real-time telemetry, and dedicated after-sales SLA guarantees."
                           data-lang-id="Memberikan ketenangan menyeluruh bagi klien manufaktur melalui logika sistem fail-safe, telemetri real-time, dan jaminan SLA purnajual yang berdedikasi."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.75rem] sm:min-h-[5.25rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Providing manufacturing clients with total peace of mind through fail-safe system logic, real-time telemetry, and dedicated after-sales SLA guarantees.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-neutral-100 text-xs text-[#3367A5] font-bold uppercase tracking-wider font-['Agrandir']"
                        data-lang-en="100% Operational Confidence" data-lang-id="100% Kepastian Operasional">
                        100% Operational Confidence
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. MISSION SECTION (Core Action Commitments)                              -->
    <!-- ========================================================================= -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="OUR GUIDING MISSION" data-lang-id="MISI UTAMA KAMI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] mt-2">
                    OUR GUIDING MISSION
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="Competence development of each of our employees, to always be able to provide services to consumer needs and provide the best after-sales support services to consumers."
                   data-lang-id="Pengembangan kompetensi setiap karyawan kami, agar senantiasa mampu memberikan pelayanan terbaik terhadap kebutuhan konsumen serta menghadirkan layanan purnajual yang optimal."
                    class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    Competence development of each of our employees, to always be able to provide services to consumer needs and provide the best after-sales support services to consumers.
                </p>
            </div>

            <!-- 3 Expanded Mission Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Mission 1 -->
                <div class="rounded-3xl border border-gray-200 p-8 sm:p-9 bg-neutral-50/50 hover:bg-white hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-1 flex flex-col justify-between">
                    <div class="space-y-5">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-lg font-['Agrandir']">
                            01
                        </div>
                        <h3 data-lang-en="Client-Centric Tailored Engineering" data-lang-id="Rekayasa Khusus Berorientasi Klien"
                            class="text-xl font-bold text-black font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            Client-Centric Tailored Engineering
                        </h3>
                        <p data-lang-en="Deeply analyzing the unique mechanical parameters, cycle speeds, and factory floor constraints of each client to build customized solutions rather than one-size-fits-all hardware."
                           data-lang-id="Menganalisis secara mendalam parameter mekanis unik, kecepatan siklus, dan kendala lantai pabrik klien demi membangun solusi yang benar-benar sesuai kebutuhan."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[5rem] sm:min-h-[5.5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Deeply analyzing the unique mechanical parameters, cycle speeds, and factory floor constraints of each client to build customized solutions rather than one-size-fits-all hardware.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-200/80 flex items-center gap-2 text-xs font-semibold text-gray-700 mt-5">
                        <span class="w-2 h-2 rounded-full bg-[#3367A5]"></span>
                        <span data-lang-en="Custom PLC, SCADA &amp; Vision Logic" data-lang-id="Logika Khusus PLC, SCADA &amp; Visi">Custom PLC, SCADA &amp; Vision Logic</span>
                    </div>
                </div>

                <!-- Mission 2 -->
                <div class="rounded-3xl border border-gray-200 p-8 sm:p-9 bg-neutral-50/50 hover:bg-white hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-2 flex flex-col justify-between">
                    <div class="space-y-5">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-lg font-['Agrandir']">
                            02
                        </div>
                        <h3 data-lang-en="Continuous Employee Empowerment" data-lang-id="Pemberdayaan Berkelanjutan Karyawan"
                            class="text-xl font-bold text-black font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            Continuous Employee Empowerment
                        </h3>
                        <p data-lang-en="Investing in continuous training, international manufacturer certifications, and hands-on testing labs for our engineers to ensure mastery over latest industrial IoT and robotics."
                           data-lang-id="Berinvestasi pada pelatihan berkelanjutan, sertifikasi manufaktur global, dan laboratorium uji mandiri untuk memastikan para teknisi menguasai IoT industri dan robotika terkini."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[5rem] sm:min-h-[5.5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Investing in continuous training, international manufacturer certifications, and hands-on testing labs for our engineers to ensure mastery over latest industrial IoT and robotics.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-200/80 flex items-center gap-2 text-xs font-semibold text-gray-700 mt-5">
                        <span class="w-2 h-2 rounded-full bg-[#3367A5]"></span>
                        <span data-lang-en="Certified Field Automation Engineers" data-lang-id="Teknisi Otomasi Lapangan Bersertifikat">Certified Field Automation Engineers</span>
                    </div>
                </div>

                <!-- Mission 3 -->
                <div class="rounded-3xl border border-gray-200 p-8 sm:p-9 bg-neutral-50/50 hover:bg-white hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-3 flex flex-col justify-between">
                    <div class="space-y-5">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-lg font-['Agrandir']">
                            03
                        </div>
                        <h3 data-lang-en="Uncompromising After-Sales SLA" data-lang-id="Komitmen Purnajual &amp; SLA Tanpa Kompromi"
                            class="text-xl font-bold text-black font-['Agrandir'] min-h-[3.25rem] sm:min-h-[3.5rem] flex flex-col justify-start">
                            Uncompromising After-Sales SLA
                        </h3>
                        <p data-lang-en="Standing shoulder-to-shoulder with our plant managers long after commissioning with rapid spare parts dispatch, preventive maintenance, and 24/7 technical advisory."
                           data-lang-id="Mendampingi para manajer pabrik secara berkelanjutan setelah komisioning dengan ketersediaan suku cadang cepat, perawatan preventif, dan konsultasi teknis 24/7."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] leading-relaxed text-justify min-h-[5rem] sm:min-h-[5.5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Standing shoulder-to-shoulder with our plant managers long after commissioning with rapid spare parts dispatch, preventive maintenance, and 24/7 technical advisory.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-200/80 flex items-center gap-2 text-xs font-semibold text-gray-700 mt-5">
                        <span class="w-2 h-2 rounded-full bg-[#3367A5]"></span>
                        <span data-lang-en="24/7 Emergency Support Guarantees" data-lang-id="Jaminan Dukungan Darurat 24/7">24/7 Emergency Support Guarantees</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. STRATEGIC GOALS & MILESTONES (Roadmap 2024 - 2028)                     -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="STRATEGIC CORPORATE GOALS" data-lang-id="TARGET STRATEGIS PERUSAHAAN"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir'] mt-2">
                    STRATEGIC CORPORATE GOALS
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="Clear quantifiable milestones that drive our investments in technology, operational scale, and customer success."
                   data-lang-id="Target terukur dan jelas yang mendorong investasi kami dalam teknologi, skala operasional, dan kesuksesan mitra industri."
                    class="text-base sm:text-lg text-gray-400 leading-relaxed font-['Questrial']">
                    Clear quantifiable milestones that drive our investments in technology, operational scale, and customer success.
                </p>
            </div>

            <!-- 4 Goals Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Goal 1 -->
                <div class="p-7 rounded-3xl bg-neutral-900/80 border border-neutral-800 hover:border-[#3367A5] transition-all duration-300 reveal-on-scroll reveal-stagger-1 space-y-4">
                    <div class="text-3xl sm:text-4xl font-bold text-[#3367A5] font-['Agrandir']">99.98%</div>
                    <h4 data-lang-en="Zero-Defect Quality Target" data-lang-id="Target Nol Defek Mutu"
                        class="text-lg font-bold text-white font-['Agrandir'] min-h-[2.75rem] sm:min-h-[3rem] flex flex-col justify-start">
                        Zero-Defect Quality Target
                    </h4>
                    <p data-lang-en="Achieving sub-micron inspection accuracy across all automated vision lines to eliminate downstream customer product recalls."
                       data-lang-id="Mencapai akurasi inspeksi sub-mikron pada seluruh lini visi otomatis guna meniadakan penarikan produk cacat di tangan konsumen."
                        class="text-xs text-neutral-400 font-['Questrial'] leading-relaxed text-justify min-h-[4rem] sm:min-h-[4.5rem]"
                        style="text-align: justify; text-justify: inter-word;">
                        Achieving sub-micron inspection accuracy across all automated vision lines to eliminate downstream customer product recalls.
                    </p>
                </div>

                <!-- Goal 2 -->
                <div class="p-7 rounded-3xl bg-neutral-900/80 border border-neutral-800 hover:border-[#3367A5] transition-all duration-300 reveal-on-scroll reveal-stagger-2 space-y-4">
                    <div class="text-3xl sm:text-4xl font-bold text-[#3367A5] font-['Agrandir']">500+</div>
                    <h4 data-lang-en="Smart Factory Implementations" data-lang-id="Implementasi Pabrik Cerdas"
                        class="text-lg font-bold text-white font-['Agrandir'] min-h-[2.75rem] sm:min-h-[3rem] flex flex-col justify-start">
                        Smart Factory Implementations
                    </h4>
                    <p data-lang-en="Scaling our SCADA and telemetry architecture to empower 500+ production lines across Java, Sumatra, Kalimantan, and Sulawesi."
                       data-lang-id="Memperluas jangkauan SCADA dan telemetri kami hingga memberdayakan lebih dari 500 lini produksi di berbagai pulau di Indonesia."
                        class="text-xs text-neutral-400 font-['Questrial'] leading-relaxed text-justify min-h-[4rem] sm:min-h-[4.5rem]"
                        style="text-align: justify; text-justify: inter-word;">
                        Scaling our SCADA and telemetry architecture to empower 500+ production lines across Java, Sumatra, Kalimantan, and Sulawesi.
                    </p>
                </div>

                <!-- Goal 3 -->
                <div class="p-7 rounded-3xl bg-neutral-900/80 border border-neutral-800 hover:border-[#3367A5] transition-all duration-300 reveal-on-scroll reveal-stagger-3 space-y-4">
                    <div class="text-3xl sm:text-4xl font-bold text-[#3367A5] font-['Agrandir']">100%</div>
                    <h4 data-lang-en="Paperless IoT Traceability" data-lang-id="Pelacakan Nirkertas IoT Penuh"
                        class="text-lg font-bold text-white font-['Agrandir'] min-h-[2.75rem] sm:min-h-[3rem] flex flex-col justify-start">
                        Paperless IoT Traceability
                    </h4>
                    <p data-lang-en="Transitioning all machine logs and quality shifts directly into cloud-ready SQL historians and automated ERP dispatch systems."
                       data-lang-id="Mengalihkan seluruh catatan log mesin dan shift mutu langsung ke pangkalan data SQL terpusat dan sistem ERP otomatis."
                        class="text-xs text-neutral-400 font-['Questrial'] leading-relaxed text-justify min-h-[4rem] sm:min-h-[4.5rem]"
                        style="text-align: justify; text-justify: inter-word;">
                        Transitioning all machine logs and quality shifts directly into cloud-ready SQL historians and automated ERP dispatch systems.
                    </p>
                </div>

                <!-- Goal 4 -->
                <div class="p-7 rounded-3xl bg-neutral-900/80 border border-neutral-800 hover:border-[#3367A5] transition-all duration-300 reveal-on-scroll reveal-stagger-4 space-y-4">
                    <div class="text-3xl sm:text-4xl font-bold text-[#3367A5] font-['Agrandir']">-20%</div>
                    <h4 data-lang-en="Energy &amp; Carbon Footprint" data-lang-id="Penurunan Konsumsi Daya"
                        class="text-lg font-bold text-white font-['Agrandir'] min-h-[2.75rem] sm:min-h-[3rem] flex flex-col justify-start">
                        Energy &amp; Carbon Footprint
                    </h4>
                    <p data-lang-en="Optimizing motor drives, smart pneumatics, and BMS HVAC balancing to reduce total electrical consumption for our clients."
                       data-lang-id="Mengoptimalkan drive motor, sistem pneumatik cerdas, dan keseimbangan HVAC BMS untuk menghemat konsumsi daya listrik fasilitas."
                        class="text-xs text-neutral-400 font-['Questrial'] leading-relaxed text-justify min-h-[4rem] sm:min-h-[4.5rem]"
                        style="text-align: justify; text-justify: inter-word;">
                        Optimizing motor drives, smart pneumatics, and BMS HVAC balancing to reduce total electrical consumption for our clients.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. CORE VALUES SECTION (The 4 Cultural Pillars)                           -->
    <!-- ========================================================================= -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="OUR 4 FOUNDATIONAL VALUES" data-lang-id="4 PILAR NILAI UTAMA KAMI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] mt-2">
                    OUR 4 FOUNDATIONAL VALUES
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="The enduring cultural tenets that define our relationships with clients, team members, and the manufacturing community."
                   data-lang-id="Prinsip budaya yang mendefinisikan hubungan kami dengan para klien, anggota tim, serta ekosistem industri manufaktur."
                    class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    The enduring cultural tenets that define our relationships with clients, team members, and the manufacturing community.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div class="p-7 rounded-2xl border border-gray-200 bg-white shadow-xs hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-1 space-y-3 flex flex-col justify-between">
                    <div>
                        <div data-lang-en="Value 01" data-lang-id="Nilai 01" class="text-[#3367A5] font-bold text-sm tracking-wider uppercase mb-2">Value 01</div>
                        <h3 data-lang-en="Lasting Partnerships" data-lang-id="Kemitraan Jangka Panjang" class="text-lg font-bold text-gray-950 font-['Agrandir'] min-h-[2.5rem] flex flex-col justify-start">Lasting Partnerships</h3>
                        <p data-lang-en="Maintain excellent service to foster lasting partnerships with our customers and clients across every project phase."
                           data-lang-id="Menjaga kualitas layanan unggul demi membina kemitraan jangka panjang bersama para pelanggan dan mitra kerja di setiap fase proyek."
                            class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.5rem] sm:min-h-[5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Maintain excellent service to foster lasting partnerships with our customers and clients across every project phase.
                        </p>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="p-7 rounded-2xl border border-gray-200 bg-white shadow-xs hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-2 space-y-3 flex flex-col justify-between">
                    <div>
                        <div data-lang-en="Value 02" data-lang-id="Nilai 02" class="text-[#3367A5] font-bold text-sm tracking-wider uppercase mb-2">Value 02</div>
                        <h3 data-lang-en="Kindness &amp; Trust" data-lang-id="Integritas &amp; Kepercayaan" class="text-lg font-bold text-gray-950 font-['Agrandir'] min-h-[2.5rem] flex flex-col justify-start">Kindness &amp; Trust</h3>
                        <p data-lang-en="Believe in treating our customers with sincerity, mutual respect, transparent communication, and enduring trust."
                           data-lang-id="Membangun relasi bersama pelanggan berlandaskan ketulusan, rasa saling menghargai, komunikasi transparan, dan kepercayaan yang kokoh."
                            class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.5rem] sm:min-h-[5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Believe in treating our customers with sincerity, mutual respect, transparent communication, and enduring trust.
                        </p>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="p-7 rounded-2xl border border-gray-200 bg-white shadow-xs hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-3 space-y-3 flex flex-col justify-between">
                    <div>
                        <div data-lang-en="Value 03" data-lang-id="Nilai 03" class="text-[#3367A5] font-bold text-sm tracking-wider uppercase mb-2">Value 03</div>
                        <h3 data-lang-en="Creativity &amp; Innovation" data-lang-id="Kreativitas &amp; Inovasi" class="text-lg font-bold text-gray-950 font-['Agrandir'] min-h-[2.5rem] flex flex-col justify-start">Creativity &amp; Innovation</h3>
                        <p data-lang-en="Continue to grow and lead by actively embracing creativity, cutting-edge engineering, and ongoing technological evolution."
                           data-lang-id="Terus berkembang dan memimpin dengan aktif merangkul kreativitas, rekayasa mutakhir, serta evolusi teknologi berkelanjutan."
                            class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.5rem] sm:min-h-[5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Continue to grow and lead by actively embracing creativity, cutting-edge engineering, and ongoing technological evolution.
                        </p>
                    </div>
                </div>

                <!-- Value 4 -->
                <div class="p-7 rounded-2xl border border-gray-200 bg-white shadow-xs hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-4 space-y-3 flex flex-col justify-between">
                    <div>
                        <div data-lang-en="Value 04" data-lang-id="Nilai 04" class="text-[#3367A5] font-bold text-sm tracking-wider uppercase mb-2">Value 04</div>
                        <h3 data-lang-en="Team Development" data-lang-id="Pengembangan Tim" class="text-lg font-bold text-gray-950 font-['Agrandir'] min-h-[2.5rem] flex flex-col justify-start">Team Development</h3>
                        <p data-lang-en="Constantly enhance the specialized capabilities of our dedicated team to drive service development and lasting operational excellence."
                           data-lang-id="Senantiasa meningkatkan kapabilitas teknis tim demi mendorong kemajuan layanan dan keunggulan operasional yang langgeng."
                            class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify min-h-[4.5rem] sm:min-h-[5rem]"
                            style="text-align: justify; text-justify: inter-word;">
                            Constantly enhance the specialized capabilities of our dedicated team to drive service development and lasting operational excellence.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 6. COLLABORATION CTA                                                      -->
    <!-- ========================================================================= -->
    <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
        <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-['Agrandir'] tracking-tight leading-tight"
                data-lang-en="Ready to Elevate Your Plant's Operational Future?"
                data-lang-id="Siap Meningkatkan Masa Depan Operasional Pabrik Anda?">
                Ready to Elevate Your Plant's Operational Future?
            </h2>
            <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-['Questrial'] leading-relaxed"
                data-lang-en="Partner with our automation and integration engineers to design fail-safe systems tailored to your production goals."
                data-lang-id="Bermitra dengan teknisi otomasi dan integrasi kami untuk merancang sistem fail-safe yang disesuaikan dengan target produksi Anda.">
                Partner with our automation and integration engineers to design fail-safe systems tailored to your production goals.
            </p>

            <div class="pt-4 flex items-center justify-center">
                <a href="{{ route('contact') }}"
                    class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-[#3367A5] font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-['Agrandir'] border-0 outline-none isolate">
                    <span class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>
                    <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-['Agrandir'] text-sm sm:text-base font-bold">
                        <span data-lang-en="Consult With Our Engineers" data-lang-id="Konsultasi Bersama Teknisi Kami">Consult With Our Engineers</span>
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

    <!-- Smooth Scroll & Reveal Logic -->
    <script>
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
                }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>

</html>

