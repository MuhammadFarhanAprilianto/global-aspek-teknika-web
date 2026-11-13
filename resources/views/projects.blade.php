<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - PT. Global Aspect Technology</title>

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

        /* LabsStudio Style Infinite Continuous Logo Marquee */
        @keyframes marqueeScrollLeft {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes marqueeScrollRight {
            0% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(0);
            }
        }

        .animate-marquee-left {
            display: flex;
            width: max-content;
            animation: marqueeScrollLeft 36s linear infinite;
        }

        .animate-marquee-right {
            display: flex;
            width: max-content;
            animation: marqueeScrollRight 40s linear infinite;
        }

        .marquee-wrapper:hover .animate-marquee-left,
        .marquee-wrapper:hover .animate-marquee-right {
            animation-play-state: paused;
        }

        /* Project Card Hover Animation */
        .project-card {
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.35s ease;
        }
        .project-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.09);
            border-color: #3367A5;
        }
        .project-card:hover .project-card-img {
            transform: scale(1.05);
        }
        .project-card-img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION (Projects Showcase Header)                                -->
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
            <h1 data-lang-en="PROJECTS &amp; CASE STUDIES" data-lang-id="PROYEK &amp; STUDI KASUS"
                class="text-3xl sm:text-5xl md:text-6xl lg:text-[64px] font-bold uppercase font-['Agrandir'] tracking-tight text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                PROJECTS &amp; CASE STUDIES
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-4 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]"></div>

            <p data-lang-en="Real-world industrial automation, machine vision quality inspection, and IoT telemetry systems engineered for Indonesia's leading manufacturers."
               data-lang-id="Otomasi industri nyata, inspeksi mutu visi optik, dan sistem telemetri IoT yang direkayasa untuk produsen terkemuka di Indonesia."
                class="text-sm sm:text-base md:text-lg text-gray-300 font-['Questrial'] max-w-2xl mt-5 leading-relaxed">
                Real-world industrial automation, machine vision quality inspection, and IoT telemetry systems engineered for Indonesia's leading manufacturers.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. PROJECT GALLERY SECTION (SmartICS 3-Column Grid)                        -->
    <!-- ========================================================================= -->
    <section class="bg-white py-14 sm:py-20 lg:py-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16 max-w-7xl">
            
            <!-- Category Filter Pills (SmartICS Style) -->
            <div class="flex items-center justify-center flex-wrap gap-2 sm:gap-2.5 mb-12 sm:mb-16 reveal-on-scroll">
                <button type="button" onclick="filterProjects('all')" id="filter-all"
                    class="project-filter-btn active px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-neutral-900 text-white shadow-sm">
                    <span data-lang-en="All Projects" data-lang-id="Semua Proyek">All Projects</span>
                </button>
                <button type="button" onclick="filterProjects('automotive')" id="filter-automotive"
                    class="project-filter-btn px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-gray-100 text-gray-600 hover:text-black hover:bg-gray-200">
                    <span data-lang-en="Automotive" data-lang-id="Otomotif">Automotive</span>
                </button>
                <button type="button" onclick="filterProjects('fmcg')" id="filter-fmcg"
                    class="project-filter-btn px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-gray-100 text-gray-600 hover:text-black hover:bg-gray-200">
                    <span data-lang-en="FMCG &amp; Food" data-lang-id="FMCG &amp; Makanan">FMCG &amp; Food</span>
                </button>
                <button type="button" onclick="filterProjects('pharma')" id="filter-pharma"
                    class="project-filter-btn px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-gray-100 text-gray-600 hover:text-black hover:bg-gray-200">
                    <span data-lang-en="Pharmaceutical" data-lang-id="Farmasi">Pharmaceutical</span>
                </button>
                <button type="button" onclick="filterProjects('bms')" id="filter-bms"
                    class="project-filter-btn px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-gray-100 text-gray-600 hover:text-black hover:bg-gray-200">
                    <span data-lang-en="BMS &amp; Utilities" data-lang-id="BMS &amp; Utilitas">BMS &amp; Utilities</span>
                </button>
                <button type="button" onclick="filterProjects('packaging')" id="filter-packaging"
                    class="project-filter-btn px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-200 bg-gray-100 text-gray-600 hover:text-black hover:bg-gray-200">
                    <span data-lang-en="Packaging &amp; Logistics" data-lang-id="Pengemasan &amp; Logistik">Packaging &amp; Logistics</span>
                </button>
            </div>

            <!-- 3-Column Projects Grid -->
            <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Project 1: Automotive Nonstop Transmission -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-1"
                    data-category="automotive">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/turnkey_integration.webp') }}" alt="Automotive Parts Inspection"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="AUTOMOTIVE" data-lang-id="OTOMOTIF">
                                AUTOMOTIVE
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="GAT Ensures Nonstop Production at Indonesia's Top Car Parts Maker"
                                data-lang-id="GAT Menjamin Produksi Tanpa Henti di Produsen Komponen Mobil Terkemuka">
                                GAT Ensures Nonstop Production at Indonesia's Top Car Parts Maker
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Implemented robotic handling cells and telecentric optical cameras for sub-micron transmission gear defect inspection, eliminating scrap escape to final assembly."
                                data-lang-id="Mengintegrasikan sel robotik dan kamera optik telesentris untuk inspeksi cacat roda gigi transmisi sub-mikron, meniadakan komponen cacat ke perakitan akhir.">
                                Implemented robotic handling cells and telecentric optical cameras for sub-micron transmission gear defect inspection, eliminating scrap escape to final assembly.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">&plusmn;0.001mm Precision</span>
                        <button type="button" onclick="openCaseModal('proj-automotive-gears')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 2: Airport Telemetry & Critical Hubs -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-2"
                    data-category="bms">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/gat_scada_interface_dark.jpg') }}" alt="Airport Telemetry SCADA"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="CRITICAL INFRASTRUCTURE" data-lang-id="INFRASTRUKTUR KRITIS">
                                CRITICAL INFRASTRUCTURE
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="Uninterrupted Critical Systems Telemetry for Eastern Indonesia Hub"
                                data-lang-id="Telemetri Sistem Kritis Tanpa Gangguan untuk Hub Indonesia Timur">
                                Uninterrupted Critical Systems Telemetry for Eastern Indonesia Hub
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Unified emergency generators, UPS banks, and runway airfield lighting status into a single responsive web-based SCADA dashboard with instant SMS and audio alarm dispatch."
                                data-lang-id="Menyatukan status generator darurat, bank UPS, dan tata cahaya landasan pacu ke dalam satu dashboard SCADA web responsif dengan peringatan instan.">
                                Unified emergency generators, UPS banks, and runway airfield lighting status into a single responsive web-based SCADA dashboard with instant SMS and audio alarm dispatch.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">99.99% Telemetry Uptime</span>
                        <button type="button" onclick="openCaseModal('proj-aviation-telemetry')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 3: Commercial Mall BMS & Energy Optimization -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-3"
                    data-category="bms">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/smartics_building_bms.jpg') }}" alt="Commercial Mall BMS"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="SMART BMS" data-lang-id="SMART BMS">
                                SMART BMS
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="GAT Reduces Operating Costs for Premier Jakarta Shopping Mall"
                                data-lang-id="GAT Menurunkan Biaya Operasional untuk Mall Premium Jakarta">
                                GAT Reduces Operating Costs for Premier Jakarta Shopping Mall
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Centralized multi-chiller sequencing, ventilation cooling tower balancing, and electrical tenant sub-metering to deliver substantial annual kilowatt savings."
                                data-lang-id="Menghadirkan otomasi sekuens chiller terpusat, penyeimbangan menara pendingin AHU, dan sub-metering listrik guna mewujudkan efisiensi biaya energi tahunan yang signifikan.">
                                Centralized multi-chiller sequencing, ventilation cooling tower balancing, and electrical tenant sub-metering to deliver substantial annual kilowatt savings.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">-18% Power Reduction</span>
                        <button type="button" onclick="openCaseModal('proj-mall-bms')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 4: Automotive Battery Assembly Plant -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-1"
                    data-category="automotive">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/gat_3d_smart_factory_diorama.webp') }}" alt="Battery Assembly Line"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="AUTOMOTIVE BATTERY" data-lang-id="BATERAI OTOMOTIF">
                                AUTOMOTIVE BATTERY
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="GAT Empowers Automated Production at Leading Battery Assembly Line"
                                data-lang-id="GAT Mendukung Otomasi Produksi di Lini Perakitan Baterai Terkemuka">
                                GAT Empowers Automated Production at Leading Battery Assembly Line
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Synchronized multi-station transfer conveyors, automated weld-joint optical inspection, and battery cell charge telemetry across 24/7 continuous operations."
                                data-lang-id="Menyelaraskan konveyor transfer multi-stasiun, inspeksi optik sambungan las otomatis, dan telemetri pengisian daya sel baterai secara berkelanjutan 24/7.">
                                Synchronized multi-station transfer conveyors, automated weld-joint optical inspection, and battery cell charge telemetry across 24/7 continuous operations.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">100% Cell Traceability</span>
                        <button type="button" onclick="openCaseModal('proj-battery-assembly')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 5: Major Coffee Roasting Facility -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-2"
                    data-category="fmcg">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/gat_analytics_telemetry_dashboard.jpg') }}" alt="Coffee Roasting SCADA"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="FOOD &amp; BEVERAGE" data-lang-id="MAKANAN &amp; MINUMAN">
                                FOOD &amp; BEVERAGE
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="Smart Telemetry &amp; Roasting Automation at Major Coffee Plant"
                                data-lang-id="Telemetri Cerdas &amp; Otomasi Roasting di Pabrik Kopi Terbesar">
                                Smart Telemetry &amp; Roasting Automation at Major Coffee Plant
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Monitoring gas burner temperatures, air pressure valves, and silo load cells with automated batch consistency recipes and historical flavor profile tracking."
                                data-lang-id="Memantau suhu burner gas, katup tekanan udara, dan load cell silo secara otomatis dengan resep konsistensi batch dan pelacakan profil rasa historis.">
                                Monitoring gas burner temperatures, air pressure valves, and silo load cells with automated batch consistency recipes and historical flavor profile tracking.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">Zero Scorched Batches</span>
                        <button type="button" onclick="openCaseModal('proj-coffee-roasting')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 6: Confectionery & Biscuit Manufacturer -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-3"
                    data-category="fmcg">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/strapping_panel_system.webp') }}" alt="Confectionery Packaging Line"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="FMCG CONFECTIONERY" data-lang-id="FMCG BISKUIT &amp; PERMEN">
                                FMCG CONFECTIONERY
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="High-Speed Strapping &amp; Packaging Lines for Leading Confectionery Maker"
                                data-lang-id="Lini Strapping &amp; Pengemasan Cepat untuk Produsen Biskuit Nasional">
                                High-Speed Strapping &amp; Packaging Lines for Leading Confectionery Maker
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Integrated 6 in-line automatic arch strapping machines with friction-weld technology, synchronizing with carton flow to prevent end-of-line bottlenecks."
                                data-lang-id="Mengintegrasikan 6 mesin strapping busur otomatis dengan teknologi las gesek, tersinkronisasi dengan alur karton demi mencegah hambatan akhir lini.">
                                Integrated 6 in-line automatic arch strapping machines with friction-weld technology, synchronizing with carton flow to prevent end-of-line bottlenecks.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">60+ straps / min</span>
                        <button type="button" onclick="openCaseModal('proj-confectionery-pack')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 7: Pharmaceutical Rigorous Quality Control -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-1"
                    data-category="pharma">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/automated_vision_system.webp') }}" alt="Pharma Blister Inspection"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="PHARMACEUTICAL" data-lang-id="FARMASI">
                                PHARMACEUTICAL
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="GAT Ensures Rigorous Production Control at Top Pharma Company"
                                data-lang-id="GAT Menjamin Kendali Mutu Ketat di Perusahaan Farmasi Terbesar">
                                GAT Ensures Rigorous Production Control at Top Pharma Company
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Equipped blister packaging lines with matrix optical cameras inspecting tablet integrity, pinholes, and foil seal boundaries at 600 pcs/min with instant reject sorting."
                                data-lang-id="Memasang kamera optik matriks pada lini pengemasan blister untuk memeriksa integritas tablet, pinhole, dan seal foil pada kecepatan 600 pcs/menit dengan pemilah reject instan.">
                                Equipped blister packaging lines with matrix optical cameras inspecting tablet integrity, pinholes, and foil seal boundaries at 600 pcs/min with instant reject sorting.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">600 pcs / min</span>
                        <button type="button" onclick="openCaseModal('proj-pharma-qc')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 8: Chemical Dosing & Agro-Chemical Facility -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-2"
                    data-category="bms">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/sensor_aliran.webp') }}" alt="Chemical Flow Sensor"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="AGROCHEMICAL &amp; UTILITIES" data-lang-id="AGROKIMIA &amp; UTILITAS">
                                AGROCHEMICAL &amp; UTILITIES
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="Compliance &amp; Automated Flow Telemetry for Leading Agrochemical Group"
                                data-lang-id="Kepatuhan &amp; Telemetri Aliran untuk Pabrik Formulasi Agrokimia">
                                Compliance &amp; Automated Flow Telemetry for Leading Agrochemical Group
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Installed electromagnetic flow transmitters and automated proportional valves linking batch reactors directly to safety interlocks and remote web monitoring."
                                data-lang-id="Memasang transmiter aliran elektromagnetik dan katup proporsional otomatis yang menghubungkan reaktor batch langsung ke interlock pengaman dan monitoring web.">
                                Installed electromagnetic flow transmitters and automated proportional valves linking batch reactors directly to safety interlocks and remote web monitoring.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">Fail-Safe Certified</span>
                        <button type="button" onclick="openCaseModal('proj-agrochemical-flow')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

                <!-- Project 9: Ceramic Tile Marking & Strapping Logistics -->
                <div class="project-item project-card bg-white rounded-3xl border border-gray-200/90 overflow-hidden flex flex-col justify-between shadow-xs reveal-on-scroll reveal-stagger-3"
                    data-category="packaging">
                    <div>
                        <div class="w-full h-52 sm:h-56 overflow-hidden bg-gray-100 relative">
                            <img src="{{ asset('storage/thermal_inject_machine.webp') }}" alt="Thermal Inkjet Machine"
                                class="project-card-img w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 backdrop-blur-md text-white text-[11px] font-bold uppercase tracking-wider rounded-full font-['Agrandir']"
                                data-lang-en="BUILDING MATERIALS &amp; PACKAGING" data-lang-id="MATERIAL BANGUNAN &amp; KEMASAN">
                                BUILDING MATERIALS &amp; PACKAGING
                            </span>
                        </div>
                        <div class="p-6 sm:p-7 space-y-3">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-950 font-['Agrandir'] leading-snug"
                                data-lang-en="High-Speed TIJ Coding &amp; Pallet Bundling for Ceramic Tile Exporter"
                                data-lang-id="Pengkodean TIJ Cepat &amp; Pengikatan Palet untuk Eksportir Keramik">
                                High-Speed TIJ Coding &amp; Pallet Bundling for Ceramic Tile Exporter
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify"
                                data-lang-en="Implemented high-resolution non-contact TIJ inkjet printing on heavy tile cartons synchronized with heavy-duty 3,500N PET pallet strapping systems."
                                data-lang-id="Mengintegrasikan pencetakan inkjet TIJ nirkontak pada kardus keramik berkecepatan tinggi yang disinkronkan dengan sistem strapping palet PET 3.500N.">
                                Implemented high-resolution non-contact TIJ inkjet printing on heavy tile cartons synchronized with heavy-duty 3,500N PET pallet strapping systems.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 sm:px-7 pb-6 pt-2 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">100 m/min Coding</span>
                        <button type="button" onclick="openCaseModal('proj-ceramic-coding')"
                            class="text-xs font-bold text-gray-900 hover:text-[#3367A5] flex items-center gap-1 font-['Agrandir'] transition-colors">
                            <span data-lang-en="Find out more &rarr;" data-lang-id="Selengkapnya &rarr;">Find out more &rarr;</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. TRUSTED BY INDUSTRY LEADERS SECTION                                    -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 relative overflow-hidden border-b border-neutral-900">
        <div class="container mx-auto px-6 mb-12 sm:mb-14 text-center reveal-on-scroll">
            <span
                class="inline-block text-xs sm:text-sm font-semibold uppercase tracking-widest text-[#3367A5] font-['Agrandir'] mb-2"
                data-lang-en="Trusted Partners"
                data-lang-id="Mitra Tepercaya">
                Trusted Partners
            </span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold font-['Agrandir'] text-white"
                data-lang-en="Trusted by Over 20+ Enterprise Manufacturers"
                data-lang-id="Dipercaya Lebih Dari 20+ Produsen Korporasi">
                Trusted by Over 20+ Enterprise Manufacturers
            </h2>
            <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-4 rounded-full"></div>
            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-4 max-w-xl mx-auto"
                data-lang-en="Delivering cutting-edge industrial automation, robotics, and smart manufacturing to Indonesia's industry leaders."
                data-lang-id="Menghadirkan otomasi industri terdepan, robotika, dan manufaktur cerdas untuk para pemimpin industri di Indonesia.">
                Delivering cutting-edge industrial automation, robotics, and smart manufacturing to Indonesia's industry leaders.
            </p>
        </div>

        <!-- Left & Right Gradient Fades (Signature Vignette) -->
        <div class="absolute left-0 top-0 bottom-0 w-20 sm:w-40 bg-gradient-to-r from-neutral-950 via-neutral-950/80 to-transparent pointer-events-none z-20"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 sm:w-40 bg-gradient-to-l from-neutral-950 via-neutral-950/80 to-transparent pointer-events-none z-20"></div>

        <!-- Marquee Rows Container -->
        <div class="marquee-wrapper space-y-6 sm:space-y-8 overflow-hidden py-4 select-none reveal-on-scroll reveal-stagger-2">
            
            <!-- Row 1: Scrolling Left -->
            <div class="animate-marquee-left flex items-center gap-6 sm:gap-10">
                <!-- 1st Copy of Row 1 Items -->
                @foreach([
                    ['name' => 'Actavis', 'file' => 'Actavis.webp'],
                    ['name' => 'Akasha International', 'file' => 'Akasha.webp'],
                    ['name' => 'Federal Oil', 'file' => 'FederalOil.webp'],
                    ['name' => 'Hitachi', 'file' => 'Hitachi.webp'],
                    ['name' => 'Hokkan Indonesia', 'file' => 'Hokkan.webp', 'class' => 'scale-150 sm:scale-165'],
                    ['name' => 'Knauf Gypsum', 'file' => 'Knauf.webp'],
                    ['name' => 'Komatsu', 'file' => 'Komatsu.webp'],
                    ['name' => 'Orang Tua (OT)', 'file' => 'OT.webp'],
                    ['name' => 'Panasonic', 'file' => 'Panasonic.webp'],
                    ['name' => 'Rayovac', 'file' => 'Rayovac.webp'],
                    ['name' => 'Rejuve', 'file' => 'Rejuve.webp'],
                    ['name' => 'PT HM Sampoerna Tbk', 'file' => 'Sampoerna.webp'],
                ] as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach

                <!-- 2nd Copy of Row 1 Items (for seamless infinite loop) -->
                @foreach([
                    ['name' => 'Actavis', 'file' => 'Actavis.webp'],
                    ['name' => 'Akasha International', 'file' => 'Akasha.webp'],
                    ['name' => 'Federal Oil', 'file' => 'FederalOil.webp'],
                    ['name' => 'Hitachi', 'file' => 'Hitachi.webp'],
                    ['name' => 'Hokkan Indonesia', 'file' => 'Hokkan.webp', 'class' => 'scale-150 sm:scale-165'],
                    ['name' => 'Knauf Gypsum', 'file' => 'Knauf.webp'],
                    ['name' => 'Komatsu', 'file' => 'Komatsu.webp'],
                    ['name' => 'Orang Tua (OT)', 'file' => 'OT.webp'],
                    ['name' => 'Panasonic', 'file' => 'Panasonic.webp'],
                    ['name' => 'Rayovac', 'file' => 'Rayovac.webp'],
                    ['name' => 'Rejuve', 'file' => 'Rejuve.webp'],
                    ['name' => 'PT HM Sampoerna Tbk', 'file' => 'Sampoerna.webp'],
                ] as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach
            </div>

            <!-- Row 2: Scrolling Right -->
            <div class="animate-marquee-right flex items-center gap-6 sm:gap-10">
                <!-- 1st Copy of Row 2 Items -->
                @foreach([
                    ['name' => 'TMS Engineering', 'file' => 'TMS.webp', 'class' => 'scale-120'],
                    ['name' => 'Syngenta', 'file' => 'Syngenta.webp'],
                    ['name' => 'Sumiden Wire', 'file' => 'Sumiden.webp'],
                    ['name' => 'SGI', 'file' => 'SGI.webp'],
                    ['name' => 'Dankos Laboratories', 'file' => 'Dankos.webp'],
                    ['name' => 'BMI Monier', 'file' => 'Monier.webp'],
                    ['name' => 'PT Satyamitra Kemas Lestari Tbk', 'file' => 'SKL.webp'],
                    ['name' => 'MAM', 'file' => 'MAM.webp'],
                    ['name' => 'Mulia Ceramics', 'file' => 'MuliaCeramics.webp', 'class' => 'scale-120 sm:scale-130'],
                ] as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach

                <!-- 2nd Copy of Row 2 Items (for seamless infinite loop) -->
                @foreach([
                    ['name' => 'TMS Engineering', 'file' => 'TMS.webp', 'class' => 'scale-120'],
                    ['name' => 'Syngenta', 'file' => 'Syngenta.webp'],
                    ['name' => 'Sumiden Wire', 'file' => 'Sumiden.webp'],
                    ['name' => 'SGI', 'file' => 'SGI.webp'],
                    ['name' => 'Dankos Laboratories', 'file' => 'Dankos.webp'],
                    ['name' => 'BMI Monier', 'file' => 'Monier.webp'],
                    ['name' => 'PT Satyamitra Kemas Lestari Tbk', 'file' => 'SKL.webp'],
                    ['name' => 'MAM', 'file' => 'MAM.webp'],
                    ['name' => 'Mulia Ceramics', 'file' => 'MuliaCeramics.webp', 'class' => 'scale-120 sm:scale-130'],
                ] as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0 cursor-pointer">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-85 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. CONSULTATION CTA BANNER                                                -->
    <!-- ========================================================================= -->
    <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
        <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-['Agrandir'] tracking-tight leading-tight"
                data-lang-en="Have a Project Challenge in Your Production Facility?"
                data-lang-id="Menghadapi Tantangan Produksi di Fasilitas Pabrik Anda?">
                Have a Project Challenge in Your Production Facility?
            </h2>
            <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-['Questrial'] leading-relaxed"
                data-lang-en="Discuss your throughput requirements, cycle times, and machine integration specs with our engineering team."
                data-lang-id="Diskusikan kebutuhan kapasitas output, kecepatan siklus, dan integrasi mesin Anda bersama tim rekayasa kami.">
                Discuss your throughput requirements, cycle times, and machine integration specs with our engineering team.
            </p>

            <div class="pt-4 flex items-center justify-center">
                <a href="{{ route('contact') }}"
                    class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-[#3367A5] font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-['Agrandir'] border-0 outline-none isolate">
                    <span class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>
                    <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-['Agrandir'] text-sm sm:text-base font-bold text-white group-hover:text-black transition-colors duration-300">
                        <span data-lang-en="Discuss Your Project" data-lang-id="Diskusikan Proyek Anda">Discuss Your Project</span>
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

    <!-- Modal for Project Details -->
    <div id="case-modal" class="fixed inset-0 z-[120] bg-black/70 backdrop-blur-sm hidden items-center justify-center p-4 sm:p-6 transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 relative shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <span id="modal-category" class="px-3.5 py-1 bg-[#3367A5]/10 text-[#3367A5] border border-[#3367A5]/20 rounded-full text-xs font-bold uppercase font-['Agrandir']">
                    CASE STUDY
                </span>
                <button type="button" onclick="closeCaseModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-black">
                    ✕
                </button>
            </div>
            <div class="space-y-4">
                <h3 id="modal-title" class="text-xl sm:text-2xl font-bold font-['Agrandir'] text-gray-950">
                    Project Details
                </h3>
                <p id="modal-description" class="text-sm text-gray-600 font-['Questrial'] leading-relaxed text-justify">
                    Detailed engineering scope and results.
                </p>
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                    <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="text-xs text-gray-500 font-bold uppercase font-['Agrandir']" data-lang-en="Key Deliverable" data-lang-id="Hasil Utama">Key Deliverable</div>
                        <div id="modal-deliverable" class="text-sm sm:text-base font-bold text-gray-900 mt-1">Complete Turnkey System</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="text-xs text-gray-500 font-bold uppercase font-['Agrandir']" data-lang-en="Field Impact" data-lang-id="Dampak Lapangan">Field Impact</div>
                        <div id="modal-impact" class="text-sm sm:text-base font-bold text-[#3367A5] mt-1">Zero Downtime Achieved</div>
                    </div>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <a href="{{ route('contact') }}" class="px-6 py-2.5 bg-black hover:bg-[#3367A5] text-white text-xs sm:text-sm font-bold rounded-full transition-colors font-['Agrandir']">
                    <span data-lang-en="Contact About Similar Solution" data-lang-id="Konsultasikan Solusi Serupa">Contact About Similar Solution</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Script for Filter & Modal -->
    <script>
        function filterProjects(cat) {
            // Update Buttons
            document.querySelectorAll('.project-filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-neutral-900', 'text-white', 'shadow-sm');
                btn.classList.add('bg-gray-100', 'text-gray-600');
            });
            const activeBtn = document.getElementById('filter-' + cat);
            if (activeBtn) {
                activeBtn.classList.remove('bg-gray-100', 'text-gray-600');
                activeBtn.classList.add('active', 'bg-neutral-900', 'text-white', 'shadow-sm');
            }

            // Filter Cards
            const cards = document.querySelectorAll('.project-item');
            cards.forEach(card => {
                if (cat === 'all' || card.getAttribute('data-category') === cat) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        const projectDetails = {
            'proj-automotive-gears': {
                cat: 'AUTOMOTIVE',
                title: 'Nonstop Robotic Quality Inspection for Automotive Gear Manufacturer',
                desc: 'GAT designed and installed custom robotic loading cells combined with high-resolution telecentric optical sensors. The line inspects 100% of finished transmission gears, measuring runout, tooth pitch, and bevel angles in under 1.2 seconds per unit. This eliminated critical assembly line recalls.',
                deliverable: 'Robotic Cell & Telecentric Vision',
                impact: '+35% Throughput & Zero Defect Escape'
            },
            'proj-aviation-telemetry': {
                cat: 'CRITICAL INFRASTRUCTURE',
                title: 'Real-Time SCADA Telemetry for Aviation Power Hub',
                desc: 'Providing continuous remote monitoring of airfield emergency generators, high-voltage transformers, and runway lighting circuits across a primary regional airport. Built on web standards, technicians receive telemetry and instant SMS notifications across tablets and mobile devices.',
                deliverable: 'Web SCADA & Modbus Telemetry',
                impact: '99.99% Reliability'
            },
            'proj-mall-bms': {
                cat: 'SMART BMS',
                title: 'Chiller Plant & Air Handling Optimization for Commercial Mall',
                desc: 'Integrated smart flow sensors and PID frequency inverters across 4 central centrifugal chillers. The system continuously balances refrigerant load against ambient humidity and occupancy levels, saving over 18% in monthly facility power bills.',
                deliverable: 'BMS Chiller Sequencing',
                impact: '18% Power Reduction'
            },
            'proj-battery-assembly': {
                cat: 'AUTOMOTIVE BATTERY',
                title: 'Automated Battery Cell Assembly & Conveyor Synchronization',
                desc: 'Implemented high-speed conveyor transfers with pneumatic indexers and automated laser-weld inspection cameras. Tracks every battery serial code through manufacturing into final packaging with complete automated historian logging.',
                deliverable: 'PLC & Laser Weld QA Cell',
                impact: '100% Traceability'
            },
            'proj-coffee-roasting': {
                cat: 'FMCG & FOOD',
                title: 'Silo Level & Gas Burner Telemetry at Mega Coffee Facility',
                desc: 'Modernized legacy roasting controls with modern PLC multi-loop PID controllers. Operators monitor bean chamber temperature profiles with automated cutoff curves to ensure optimal flavor development with zero scorched lots.',
                deliverable: 'Roaster PID & Silo Monitoring',
                impact: 'Zero Scorched Batches'
            },
            'proj-confectionery-pack': {
                cat: 'FMCG CONFECTIONERY',
                title: 'High-Speed Automated Arch Strapping Line for Biscuit Giant',
                desc: 'Integrated 6 automatic friction-weld strapping machines synchronized with upstream case sealers and downstream palletizers. Bundles over 60 carton cases per minute with automated strap tension feedback to prevent box deformation.',
                deliverable: '6x Arch Strapping Machines',
                impact: '60+ Straps/min Throughput'
            },
            'proj-pharma-qc': {
                cat: 'PHARMACEUTICAL',
                title: 'High-Speed Blister Pack Optical Inspection & Serialization',
                desc: 'Installed color CMOS matrix cameras inspecting tablet color, foil perforation, and pocket completeness at 600 blisters/min. Any defect is ejected pneumatically within 15 milliseconds without stopping the blister packing machine.',
                deliverable: 'High-Speed Optical Vision System',
                impact: '600 pcs/min & Zero Leakage'
            },
            'proj-agrochemical-flow': {
                cat: 'AGROCHEMICAL',
                title: 'Fail-Safe Chemical Dosing & Batch Monitoring',
                desc: 'Installed electromagnetic flow meters and automated ball valves linking active chemical reactors to emergency deluge interlocks. Delivers real-time volume logging to ERP systems with automated formulation batching.',
                deliverable: 'Flow Transmitters & Safety PLC',
                impact: 'SIL-2 Safety Certified'
            },
            'proj-ceramic-coding': {
                cat: 'PACKAGING & LOGISTICS',
                title: 'TIJ Non-Contact Inkjet Coding & Heavy Strapping for Tile Exporter',
                desc: 'Mounted 600 DPI Thermal Inkjet printheads along carton conveyor lines printing real-time QR codes and lot dates at 100 m/min, followed by dual-axis PET strapping with 3,500N holding tension for maritime container exports.',
                deliverable: 'TIJ Printing & Heavy Strapping',
                impact: '100 m/min Coding Speed'
            }
        };

        function openCaseModal(key) {
            const data = projectDetails[key];
            if (!data) return;
            document.getElementById('modal-category').innerText = data.cat;
            document.getElementById('modal-title').innerText = data.title;
            document.getElementById('modal-description').innerText = data.desc;
            document.getElementById('modal-deliverable').innerText = data.deliverable;
            document.getElementById('modal-impact').innerText = data.impact;

            const modal = document.getElementById('case-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCaseModal() {
            const modal = document.getElementById('case-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('case-modal').addEventListener('click', function (e) {
            if (e.target === this) closeCaseModal();
        });

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

