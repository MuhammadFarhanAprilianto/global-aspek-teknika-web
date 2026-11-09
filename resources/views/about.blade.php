<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PT. Global Aspect Technology</title>

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

        /* Marquee Animation for Industry Client Logos */
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
            animation: marqueeScrollLeft 38s linear infinite;
        }
        .animate-marquee-right {
            display: flex;
            width: max-content;
            animation: marqueeScrollRight 42s linear infinite;
        }
        .marquee-wrapper:hover .animate-marquee-left,
        .marquee-wrapper:hover .animate-marquee-right {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- 1. Hero Section (Company Profile Video Background) -->
    <section
        class="relative w-full min-h-[70vh] sm:min-h-[80vh] lg:min-h-[88vh] bg-black text-white text-center py-36 sm:py-48 lg:py-56 overflow-hidden flex items-center justify-center">
        <!-- Background Video with WebM Primary and MP4 Fallback -->
        <div class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none flex items-center justify-center">
            <video autoplay loop muted playsinline preload="auto"
                class="w-full h-full object-cover object-center opacity-65"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/Company_Profile.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/Company_Profile.webm') }}" type="video/webm">
            </video>
            <!-- Overlays for strong text contrast -->
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-[66px] xl:text-[72px] font-bold uppercase font-['Questrial',sans-serif] tracking-wider text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                COMPANY PROFILE
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-red-600 mx-auto mt-2 rounded-full shadow-[0_0_20px_rgba(220,38,38,1)]"></div>
        </div>
    </section>

    <!-- 2. About Company & Key Impact Stats Section -->
    <section class="bg-[#000000] text-gray-200 py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir']">
                    ABOUT COMPANY
                </h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 mb-6 rounded-full"></div>
                <p class="text-base sm:text-lg text-gray-400 leading-relaxed font-['Questrial']">
                    Bridging advanced control technology with real-world production line needs to create manufacturing processes that are more efficient, precise, and highly competitive.
                </p>
            </div>

            <!-- Story & Overview (2 Balanced Columns) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center mb-16 lg:mb-20">
                <div class="space-y-5 text-gray-300 text-base sm:text-lg leading-relaxed font-['Questrial'] reveal-on-scroll reveal-stagger-1 text-justify">
                    <p class="text-justify">
                        <strong class="text-white font-medium">PT. Global Aspect Technology</strong>, established in 2017, is a company that focuses on providing integrated systems for various industries, both manufacturing and non-industrial, from small to large scale. Since our inception, we have been committed to providing the best and most innovative solutions to meet the needs of system automation, software development, monitoring, and control of production processes.
                    </p>
                    <p class="text-justify">
                        We understand the importance of efficiency, productivity, and quality in every business process. Therefore, we put forward technology that is not only advanced, but also customizable to each client's specific needs. With extensive experience in various industrial sectors, we continue to innovate to provide timely, reliable, and cost-effective solutions.
                    </p>
                    <p class="text-justify">
                        With a team of experienced professionals, PT. Global Aspect Technology is ready to be your reliable partner in facing the challenges of an ever-evolving industry. We are committed to continuously innovate and adapt to market needs, ensuring every solution we offer has added value to your business.
                    </p>
                </div>

                <!-- 4 Key Impact Stats (White Box Cards, No Outline) -->
                <div class="grid grid-cols-2 gap-4 sm:gap-6 reveal-on-scroll reveal-stagger-2">
                    <!-- Stat 1 -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] tracking-tight">
                            2017
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-red-600 mt-2">
                            Year Established
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed text-justify">
                            Over 8 years of industrial automation engineering experience across Indonesia.
                        </p>
                    </div>

                    <!-- Stat 2 -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] tracking-tight">
                            150+
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-red-600 mt-2">
                            Projects Delivered
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed text-justify">
                            Proven PLC, SCADA, quality inspection, and packaging conveyor integrations.
                        </p>
                    </div>

                    <!-- Stat 3 -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] tracking-tight">
                            20+
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-red-600 mt-2">
                            Enterprise Clients
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed text-justify">
                            Trusted by leading national manufacturers and multinational industrial giants.
                        </p>
                    </div>

                    <!-- Stat 4 -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] tracking-tight">
                            100%
                        </div>
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-red-600 mt-2">
                            Custom &amp; SLA Support
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed text-justify">
                            Tailored engineering designs backed by responsive after-sales service guarantees.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Vision, Mission & Core Values Section -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir']">
                    VISION &amp; MISSION
                </h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 mb-6 rounded-full"></div>
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    Our enduring commitment to providing the highest quality integrated solutions and dependable after-sales services for every client's needs.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Vision Card (5 Columns) -->
                <div class="lg:col-span-5 bg-neutral-900 text-white p-8 sm:p-10 rounded-2xl flex flex-col justify-between reveal-on-scroll reveal-stagger-1 shadow-sm">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 text-xs font-semibold tracking-wider uppercase text-gray-300 mb-6">
                            Vision
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold font-['Agrandir'] text-white uppercase tracking-wide">
                            OUR VISION
                        </h3>
                        <p class="text-base sm:text-lg text-gray-300 font-['Questrial'] leading-relaxed mt-5 text-justify">
                            To become a trusted industrial system integration company in Indonesia and provide the best guarantee of every solution provided for consumer needs.
                        </p>
                    </div>

                    <div class="pt-8 border-t border-neutral-800 mt-8">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-red-600/20 text-red-500 flex items-center justify-center font-bold text-lg shrink-0">
                                &check;
                            </div>
                            <div class="text-xs sm:text-sm text-gray-400 text-justify">
                                Dedicated to quality assurance, technological excellence, and reliable industrial solutions.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission Card (7 Columns) -->
                <div class="lg:col-span-7 bg-gray-50 border border-gray-200/80 p-8 sm:p-10 rounded-2xl flex flex-col justify-between reveal-on-scroll reveal-stagger-2">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-red-50 border border-red-200 text-xs font-semibold tracking-wider uppercase text-red-700 mb-6">
                            Mission
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold font-['Agrandir'] text-gray-900 uppercase tracking-wide">
                            OUR MISSION
                        </h3>
                        <p class="text-base sm:text-lg text-gray-700 font-['Questrial'] leading-relaxed mt-5 text-justify">
                            Competence development of each of our employees, to always be able to provide services to consumer needs and provide the best after-sales support services to consumers.
                        </p>

                        <div class="space-y-5 mt-8 pt-6 border-t border-gray-200/70">
                            <!-- Pillar 1 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-black text-white shrink-0 flex items-center justify-center font-bold text-xs mt-0.5">
                                    01
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-bold text-gray-950 font-['Agrandir']">
                                        Client-Centric Solutions
                                    </h4>
                                    <p class="text-sm sm:text-base text-gray-600 font-['Questrial'] mt-1 leading-relaxed text-justify">
                                        Understanding each client's unique operational challenges and delivering precise, customizable technology.
                                    </p>
                                </div>
                            </div>

                            <!-- Pillar 2 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-black text-white shrink-0 flex items-center justify-center font-bold text-xs mt-0.5">
                                    02
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-bold text-gray-950 font-['Agrandir']">
                                        Employee Competence &amp; Skill Development
                                    </h4>
                                    <p class="text-sm sm:text-base text-gray-600 font-['Questrial'] mt-1 leading-relaxed text-justify">
                                        Constantly enhancing the specialized engineering skills of our team to drive continuous service excellence.
                                    </p>
                                </div>
                            </div>

                            <!-- Pillar 3 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-black text-white shrink-0 flex items-center justify-center font-bold text-xs mt-0.5">
                                    03
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-bold text-gray-950 font-['Agrandir']">
                                        Best-in-Class After-Sales Support
                                    </h4>
                                    <p class="text-sm sm:text-base text-gray-600 font-['Questrial'] mt-1 leading-relaxed text-justify">
                                        Ensuring ongoing reliability and lasting value through dedicated technical assistance and maintenance.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core Values Row (4 Clean Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
                <div class="p-6 rounded-xl border border-gray-200 bg-white shadow-xs reveal-on-scroll reveal-stagger-1">
                    <div class="text-red-600 font-bold text-sm tracking-wider uppercase mb-1">Value 01</div>
                    <div class="text-lg font-bold text-gray-900 font-['Agrandir']">Lasting Partnerships</div>
                    <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-2 leading-relaxed text-justify">
                        Maintain excellent service to foster lasting partnerships with our customers and clients.
                    </p>
                </div>

                <div class="p-6 rounded-xl border border-gray-200 bg-white shadow-xs reveal-on-scroll reveal-stagger-2">
                    <div class="text-red-600 font-bold text-sm tracking-wider uppercase mb-1">Value 02</div>
                    <div class="text-lg font-bold text-gray-900 font-['Agrandir']">Kindness &amp; Trust</div>
                    <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-2 leading-relaxed text-justify">
                        Believe in treating our customers with kindness, mutual respect, and enduring trust.
                    </p>
                </div>

                <div class="p-6 rounded-xl border border-gray-200 bg-white shadow-xs reveal-on-scroll reveal-stagger-3">
                    <div class="text-red-600 font-bold text-sm tracking-wider uppercase mb-1">Value 03</div>
                    <div class="text-lg font-bold text-gray-900 font-['Agrandir']">Creativity &amp; Innovation</div>
                    <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-2 leading-relaxed text-justify">
                        Continue to grow and lead by actively embracing creativity, innovation, and technological evolution.
                    </p>
                </div>

                <div class="p-6 rounded-xl border border-gray-200 bg-white shadow-xs reveal-on-scroll reveal-stagger-4">
                    <div class="text-red-600 font-bold text-sm tracking-wider uppercase mb-1">Value 04</div>
                    <div class="text-lg font-bold text-gray-900 font-['Agrandir']">Team Development</div>
                    <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-2 leading-relaxed text-justify">
                        Constantly enhance the skills of our dedicated team to drive service development and excellence.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Why Choose Us (6 Combined Pillars: Core Solutions + Value Proposition) -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir']">
                    WHY CHOOSE US
                </h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 mb-6 rounded-full"></div>
                <p class="text-base sm:text-lg text-gray-400 leading-relaxed font-['Questrial']">
                    Combining tailored engineering integration, proven industrial solutions, and dependable after-sales guarantees for manufacturing facilities across Indonesia.
                </p>
            </div>

            <!-- 6 Feature Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Card 1: Turnkey System Integration -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-1">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/turnkey_integration.webp') }}" alt="Turnkey System Integration"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Robotics &amp; Material Flow
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                Turnkey System Integration
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                Custom robotic workcells, material handling conveyors, and end-to-end plant automation engineered to accelerate throughput and eliminate production bottlenecks.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: PLC Programming & Retrofitting -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-2">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/plc_programming_ladder.webp') }}" alt="PLC Programming & Retrofitting"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Machine Control Systems
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                PLC Programming &amp; Retrofitting
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                Developing new PLC logic, modifying existing machine sequences, and replacing obsolete control panels across top industrial brands including Mitsubishi, Omron, and Siemens.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Automated Vision & Data Recording -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-3">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/automated_vision_system.webp') }}" alt="Automated Vision & Data Recording"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Automated Quality Control
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                Automated Vision &amp; Data Recording
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                High-speed optical inspection cameras for automated 1D/2D barcode tracking, dimensional verification, and automated reject mechanisms ensuring zero defective products escape.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 4: SCADA & Monitoring -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-4">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/scada_telemetry_system.webp') }}" alt="Real-Time SCADA & Telemetry"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Plant Telemetry &amp; IoT
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                Real-Time SCADA &amp; Telemetry
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                Centralized visualization of all machine statuses and production lines with automated shift data logging directly to SQL/MES, delivering complete paperless traceability.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Laser Marking & Strapping -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-5">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/strapping_panel_system.webp') }}" alt="Industrial Marking & Strapping"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Traceability &amp; Packaging
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                Industrial Marking &amp; Strapping
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                High-speed batch coding and carton/pallet strapping solutions—featuring Thermal Inkjet (TIJ) printers, fiber laser markers, and heavy-duty battery or pneumatic strapping tools.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Dedicated SLA & After-Sales Support -->
                <div class="group bg-neutral-900 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col reveal-on-scroll reveal-stagger-6">
                    <div class="w-full h-56 overflow-hidden bg-neutral-950 relative">
                        <img src="{{ asset('storage/support_after_sales.webp') }}" alt="Dedicated SLA & After-Sales Support"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-neutral-800 text-gray-300 text-xs rounded-full font-medium mb-3">
                                Engineering Excellence
                            </span>
                            <h3 class="text-lg sm:text-xl font-bold text-white font-['Agrandir'] group-hover:text-red-500 transition-colors">
                                Dedicated SLA &amp; After-Sales Support
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-400 font-['Questrial'] mt-2.5 leading-relaxed text-justify">
                                Rapid-response on-site engineering maintenance, readily available spare parts, and dependable technical guarantees to safeguard your facility from costly unplanned downtime.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Engineering Workflow (4 Steps) -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir']">
                    HOW WE WORK
                </h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 mb-6 rounded-full"></div>
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    A transparent, four-phase engineering framework ensuring every automation project is completed safely, on schedule, and fully guaranteed.
                </p>
            </div>

            <!-- Workflow 4 Steps Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                <!-- Step 1 -->
                <div class="p-7 rounded-2xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between relative reveal-on-scroll reveal-stagger-1">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-black text-white font-bold font-['Agrandir'] flex items-center justify-center text-lg mb-5 shadow-xs">
                            01
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                            Site Survey &amp; Needs Assessment
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-3 leading-relaxed">
                            Our senior engineers visit your facility to inspect existing machinery, map workflow constraints, and define concrete operational targets.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200/60 text-xs font-semibold text-red-600 uppercase tracking-wider">
                        Discovery Phase
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-7 rounded-2xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between relative reveal-on-scroll reveal-stagger-2">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-black text-white font-bold font-['Agrandir'] flex items-center justify-center text-lg mb-5 shadow-xs">
                            02
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                            System Engineering &amp; Costing
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-3 leading-relaxed">
                            Developing detailed electrical schematics, selecting tier-one industrial hardware, and presenting transparent, itemized B2B proposals.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200/60 text-xs font-semibold text-red-600 uppercase tracking-wider">
                        Design Phase
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-7 rounded-2xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between relative reveal-on-scroll reveal-stagger-3">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-black text-white font-bold font-['Agrandir'] flex items-center justify-center text-lg mb-5 shadow-xs">
                            03
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                            Fabrication &amp; Integration
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-3 leading-relaxed">
                            Precision control panel assembly, clean PLC programming, certified cabling, and physical mechanical integration compliant with workplace safety.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200/60 text-xs font-semibold text-red-600 uppercase tracking-wider">
                        Execution Phase
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-7 rounded-2xl bg-gray-50 border border-gray-200/80 flex flex-col justify-between relative reveal-on-scroll reveal-stagger-4">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-black text-white font-bold font-['Agrandir'] flex items-center justify-center text-lg mb-5 shadow-xs">
                            04
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                            Commissioning &amp; SLA Warranty
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 font-['Questrial'] mt-3 leading-relaxed">
                            Full-load test runs on live production lines, comprehensive operator handover training, full technical documentation, and dedicated warranty support.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200/60 text-xs font-semibold text-red-600 uppercase tracking-wider">
                        Handover Phase
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Trusted By Industry Leaders (23 Client Logos Marquee) -->
    <section class="bg-white text-gray-900 pt-20 sm:pt-24 lg:pt-28 pb-32 sm:pb-40 lg:pb-48 overflow-hidden border-b border-gray-100 relative">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20 text-center mb-12 sm:mb-16 lg:mb-20 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] tracking-tight">
                TRUSTED BY INDUSTRY LEADERS
            </h2>
            <div class="w-16 h-1 bg-red-600 mx-auto mt-3 mb-6 rounded-full"></div>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial'] max-w-3xl mx-auto">
                Leading national manufacturers and multinational enterprises that rely on our industrial automation and systems integration.
            </p>
        </div>

        <!-- Left & Right Gradient Fades for Smooth Screen Transition -->
        <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-r from-white via-white/80 to-transparent pointer-events-none z-20"></div>
        <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-l from-white via-white/80 to-transparent pointer-events-none z-20"></div>

        @php
            $row1Logos = [
                ['name' => 'Actavis', 'file' => 'Actavis.webp'],
                ['name' => 'Akasha International', 'file' => 'Akasha.webp'],
                ['name' => 'Federal Oil', 'file' => 'FederalOil.webp'],
                ['name' => 'Hitachi', 'file' => 'Hitachi_dark.webp'],
                ['name' => 'Hokkan Indonesia', 'file' => 'Hokkan.webp', 'class' => 'scale-125 sm:scale-135'],
                ['name' => 'Knauf Gypsum', 'file' => 'Knauf.webp'],
                ['name' => 'Komatsu', 'file' => 'Komatsu.webp'],
                ['name' => 'Orang Tua (OT)', 'file' => 'OT.webp'],
                ['name' => 'Panasonic', 'file' => 'Panasonic.webp'],
                ['name' => 'Rayovac', 'file' => 'Rayovac_dark.webp'],
                ['name' => 'Rejuve', 'file' => 'Rejuve.webp'],
                ['name' => 'PT HM Sampoerna Tbk', 'file' => 'Sampoerna.webp'],
            ];

            $row2Logos = [
                ['name' => 'TMS Engineering', 'file' => 'TMS.webp'],
                ['name' => 'Syngenta', 'file' => 'Syngenta.webp'],
                ['name' => 'Sumiden Wire', 'file' => 'Sumiden_dark.webp'],
                ['name' => 'SGI', 'file' => 'SGI.webp'],
                ['name' => 'Dankos Laboratories', 'file' => 'Dankos.webp'],
                ['name' => 'BMI Monier', 'file' => 'Monier_dark.webp'],
                ['name' => 'PT Satyamitra Kemas Lestari Tbk', 'file' => 'SKL.webp'],
                ['name' => 'MAM', 'file' => 'MAM.webp'],
                ['name' => 'Mulia Ceramics', 'file' => 'MuliaCeramics.webp'],
                ['name' => 'Cipta Nissin', 'file' => 'Cipta Nissin Logo.webp'],
                ['name' => 'DIC Corporation', 'file' => 'DIC Logo.webp'],
            ];
        @endphp

        <!-- Marquee Container -->
        <div class="marquee-wrapper space-y-6 sm:space-y-8 overflow-hidden py-4 sm:py-6 select-none reveal-on-scroll reveal-stagger-2">
            <!-- Row 1: Scrolling Left -->
            <div class="animate-marquee-left flex items-center gap-6 sm:gap-10">
                @foreach($row1Logos as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-75 hover:opacity-100 transition-all duration-300 {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach

                <!-- Duplicate Row 1 for Infinite Seamless Marquee Loop -->
                @foreach($row1Logos as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-75 hover:opacity-100 transition-all duration-300 {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach
            </div>

            <!-- Row 2: Scrolling Right -->
            <div class="animate-marquee-right flex items-center gap-6 sm:gap-10">
                @foreach($row2Logos as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-75 hover:opacity-100 transition-all duration-300 {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach

                <!-- Duplicate Row 2 for Infinite Seamless Marquee Loop -->
                @foreach($row2Logos as $brand)
                <div class="flex items-center justify-center h-16 sm:h-20 px-6 sm:px-10 shrink-0">
                    <img src="{{ asset('storage/logocus/' . $brand['file']) }}" alt="{{ $brand['name'] }}"
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-75 hover:opacity-100 transition-all duration-300 {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 7. Call To Action (Bottom Clean Industrial Banner) -->
    <section class="bg-black text-white py-20 sm:py-24 lg:py-28 border-t border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-4xl mx-auto text-center reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-['Agrandir'] text-white leading-tight">
                    Ready to Elevate Your Plant’s Productivity?
                </h2>
                <p class="text-base sm:text-lg text-gray-400 font-['Questrial'] max-w-2xl mx-auto mt-4 leading-relaxed">
                    Consult your production line challenges with our engineering team, or explore our complete catalog of industrial automation machinery and components.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8 sm:mt-10">
                    <a href="{{ route('product') }}"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-white text-black font-semibold text-sm hover:bg-gray-200 transition-colors shadow-sm">
                        Explore Our Products
                    </a>
                    <a href="{{ route('contact') }}"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-red-600 text-white font-semibold text-sm hover:bg-red-700 transition-colors shadow-sm">
                        Schedule Engineering Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Floating Button Component -->
    @include('components.button.button')

    <!-- JavaScript for Mobile Menu Safe Toggle -->
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

            // Fail-safe: ensure elements are revealed after 1.5s
            setTimeout(() => {
                elements.forEach(el => el.classList.add('is-revealed'));
            }, 1500);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initScrollReveal);
        } else {
            initScrollReveal();
        }
        window.addEventListener('load', initScrollReveal);

        // 3. Autoplay video safeguard
        document.addEventListener('DOMContentLoaded', () => {
            const v = document.querySelector('video');
            if (v) {
                v.muted = true;
                v.playsInline = true;
                const playPromise = v.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log('Autoplay handled:', error);
                    });
                }
            }
        });
    </script>
</body>

</html>
