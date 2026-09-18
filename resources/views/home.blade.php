<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Aspek Teknologi</title>

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
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600;700;800;900&family=Syne:wght@400..800&family=Viga&display=swap"
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
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full">

    <!-- Navbar -->
    @include('components.navbar.header')


    <!-- Single Slide Hero Section with Orbital Ecosystem -->
    <section
        class="relative w-full min-h-[calc(100vh-80px)] pt-32 pb-10 sm:pb-12 lg:pt-36 lg:pb-14 flex items-center bg-white overflow-hidden">
        <!-- Subtle Background Ambient Radial Lighting -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-radial from-red-50/50 via-gray-100/30 to-transparent rounded-full pointer-events-none blur-3xl -z-0">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-8">

                <!-- Left Column: High-Impact Typography & CTA -->
                <div class="w-full lg:w-[55%] text-left">
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-[48px] xl:text-[54px] font-black text-gray-950 font-['Agrandir',sans-serif] leading-[1.15] tracking-tight mb-6 text-left">
                        <span class="block sm:whitespace-nowrap">Empowering Industry 4.0</span>
                        <span class="block sm:whitespace-nowrap">Through Seamless Automation.</span>
                    </h1>

                    <p
                        class="text-base sm:text-lg lg:text-xl text-gray-600 font-['Agrandir',sans-serif] leading-relaxed max-w-xl text-left mb-8">
                        Streamline your industrial processes and integrate smart IoT telemetry with world-class
                        automation in just a few clicks.
                    </p>

                    <!-- CTA Capsule Pill Button with 600ms Red Sliding Fill Hover -->
                    <div class="flex justify-start">
                        <a href="{{ route('solution') }}"
                            class="group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-black px-8 py-4 text-sm sm:text-base font-medium text-white shadow-[0_12px_30px_rgba(0,0,0,0.25)] transition-all duration-1000 hover:shadow-[0_16px_35px_rgba(220,38,38,0.35)] hover:-translate-y-0.5">
                            <!-- Red slide-in layer (1000ms duration) -->
                            <span
                                class="absolute inset-0 bg-red-600 -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>

                            <!-- Content -->
                            <span class="relative z-10 flex items-center gap-2.5 font-['Poppins'] tracking-wide">
                                <span>Innovate once. Automate everywhere.</span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Orbital Diagram Ecosystem with Central 3D Laptop Mockup -->
                <div
                    class="w-full lg:w-[45%] flex items-center justify-center relative min-h-[360px] sm:min-h-[480px] lg:min-h-[580px]">
                    <div
                        class="relative w-[310px] h-[310px] sm:w-[440px] sm:h-[440px] lg:w-[540px] lg:h-[540px] flex items-center justify-center">

                        <!-- Ambient Soft Radial Lighting -->
                        <div
                            class="absolute -inset-10 bg-gradient-to-tr from-red-500/10 via-blue-500/5 to-transparent rounded-full blur-3xl pointer-events-none">
                        </div>

                        <!-- SVG Orbit Ellipses & Trajectory Lines -->
                        <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 500 500"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Orbit 1 (Tilted -28 deg) -->
                            <ellipse cx="250" cy="250" rx="225" ry="95" transform="rotate(-28 250 250)" stroke="#E2E8F0"
                                stroke-width="1.6" />
                            <!-- Orbit 2 (Tilted +28 deg) -->
                            <ellipse cx="250" cy="250" rx="225" ry="105" transform="rotate(28 250 250)" stroke="#E2E8F0"
                                stroke-width="1.6" />
                            <!-- Orbit 3 (Tilted +75 deg) -->
                            <ellipse cx="250" cy="250" rx="215" ry="100" transform="rotate(75 250 250)" stroke="#CBD5E1"
                                stroke-width="1.4" stroke-opacity="0.8" />

                            <!-- Subtle Connection Dotted Guide Lines -->
                            <line x1="250" y1="250" x2="395" y2="40" stroke="#E2E8F0" stroke-width="1.2"
                                stroke-dasharray="3 3" opacity="0.6" />
                            <line x1="250" y1="250" x2="65" y2="280" stroke="#E2E8F0" stroke-width="1.2"
                                stroke-dasharray="3 3" opacity="0.6" />
                            <line x1="250" y1="250" x2="435" y2="380" stroke="#E2E8F0" stroke-width="1.2"
                                stroke-dasharray="3 3" opacity="0.6" />
                        </svg>

                        <!-- Center Core: 3D Laptop Mockup (Replacing "Orbit" text) -->
                        <div
                            class="relative z-10 w-[230px] sm:w-[340px] lg:w-[440px] flex items-center justify-center select-none">
                            <img src="{{ asset('storage/Hero Section.webp') }}"
                                alt="PT. Global Aspect Technology - Industrial Dashboard"
                                class="w-full h-auto object-contain drop-shadow-[0_20px_40px_rgba(0,0,0,0.16)] pointer-events-none">
                        </div>

                        <!-- Orbit Item 1: Top Center-Left - PLC Programming (PLC-ICON.webp) -->
                        <div
                            class="absolute top-[8%] left-[10%] sm:top-[6%] sm:left-[14%] z-20 group cursor-pointer animate-float-2">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#18181b] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(0,0,0,0.35)] transition-transform duration-300 hover:scale-115 border border-white/15">
                                <img src="{{ asset('storage/PLC-ICON.webp') }}" alt="PLC Programming"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                PLC Programming
                            </div>
                        </div>

                        <!-- Orbit Item 2: Top Right - Scan & Inspection (ScanSearch.webp) -->
                        <div
                            class="absolute top-[1%] right-[10%] sm:top-[1%] sm:right-[14%] z-20 group cursor-pointer animate-float-1">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#0057ff] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(0,87,255,0.4)] transition-transform duration-300 hover:scale-115">
                                <img src="{{ asset('storage/ScanSearch.webp') }}" alt="Scan & Inspection"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                Scan & Inspection
                            </div>
                        </div>

                        <!-- Orbit Item 3: Mid Right - Content Manager (Content Manager.webp) -->
                        <div
                            class="absolute top-[32%] -right-[4%] sm:top-[30%] sm:-right-[7%] lg:-right-[9%] z-20 group cursor-pointer animate-float-1">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#2d3139] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(0,0,0,0.3)] transition-transform duration-300 hover:scale-115 border border-white/15">
                                <img src="{{ asset('storage/Content Manager.webp') }}" alt="Content Manager"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                Content Manager
                            </div>
                        </div>

                        <!-- Orbit Item 4: Mid Left - Integrator System (Integrator System.webp) -->
                        <div
                            class="absolute top-[52%] -left-[2%] sm:top-[50%] sm:-left-[2%] z-20 group cursor-pointer animate-float-3">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#ea4c89] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(234,76,137,0.4)] transition-transform duration-300 hover:scale-115">
                                <img src="{{ asset('storage/Integrator System.webp') }}" alt="System Integrator"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                System Integrator
                            </div>
                        </div>

                        <!-- Orbit Item 5: Bottom Center - Laser Marking & Printing (Laser Marking & Inkjet Printing.webp) -->
                        <div
                            class="absolute -bottom-[1%] left-[42%] sm:-bottom-[1%] sm:left-[43%] z-20 group cursor-pointer animate-float-3">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#111215] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(0,0,0,0.35)] transition-transform duration-300 hover:scale-115 border border-white/15">
                                <img src="{{ asset('storage/Laser Marking & Inkjet Printing.webp') }}"
                                    alt="Laser Marking & Printing"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                Laser Marking & Printing
                            </div>
                        </div>

                        <!-- Orbit Item 6: Bottom Right - Strapping Machine (Strapping ICON.webp) -->
                        <div
                            class="absolute bottom-[10%] right-[6%] sm:bottom-[8%] sm:right-[10%] z-20 group cursor-pointer animate-float-2">
                            <div
                                class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[68px] lg:h-[68px] bg-[#dc2626] rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-2.5 lg:p-3 shadow-[0_8px_20px_rgba(220,38,38,0.4)] transition-transform duration-300 hover:scale-115">
                                <img src="{{ asset('storage/Strapping ICON.webp') }}" alt="Strapping Machine"
                                    class="w-full h-full object-contain filter drop-shadow">
                            </div>
                            <div
                                class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bg-gray-900 text-white text-[11px] font-semibold py-1 px-2.5 rounded-full whitespace-nowrap shadow-lg">
                                Strapping Machine
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Floating Badge Animations -->
    <style>
        @keyframes floatSlow1 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-8px) scale(1.02);
            }
        }

        @keyframes floatSlow2 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(10px) scale(0.98);
            }
        }

        @keyframes floatSlow3 {

            0%,
            100% {
                transform: translateX(0px) translateY(0px);
            }

            50% {
                transform: translateX(-5px) translateY(-6px);
            }
        }

        .animate-float-1 {
            animation: floatSlow1 5s ease-in-out infinite;
        }

        .animate-float-2 {
            animation: floatSlow2 6s ease-in-out infinite 0.8s;
        }

        .animate-float-3 {
            animation: floatSlow3 5.5s ease-in-out infinite 1.5s;
        }
    </style>



    <!-- Section 1: Welcome & Company Overview -->
    <section class="relative bg-black text-white py-16 sm:py-20 lg:py-24 overflow-hidden">
        <!-- Ambient Radial Glow Accents -->
        <div class="absolute top-1/4 -left-48 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-10 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <!-- Section 1 Tagline Banner -->
            <div class="text-center mb-12 sm:mb-14 lg:mb-16 reveal-on-scroll">
                <h2
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-[42px] font-normal text-white font-['Agrandir',sans-serif] leading-snug tracking-tight">
                    We Are The Solution Partner In Automation Industry
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch gap-12 lg:gap-16">

                <!-- Left Column: Content (Headline, Narrative & Bottom-Aligned Stats) -->
                <div class="w-full lg:w-1/2 text-left pt-2 sm:pt-4 lg:pt-6 flex flex-col justify-between reveal-on-scroll reveal-stagger-1">
                    <div>
                        <!-- Main Headline (2 Baris Rata Kiri dengan Jarak Baris Proporsional) -->
                        <h2
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-[50px] xl:text-[54px] font-extrabold text-white font-['Agrandir',sans-serif] leading-[1.25] sm:leading-[1.28] tracking-tight mb-7 text-left">
                            <span class="block sm:whitespace-nowrap">Welcome to the</span>
                            <span class="block sm:whitespace-nowrap mt-1">Industry 4.0 Revolution</span>
                        </h2>

                        <!-- Narrative Summary Paragraph (5-6 baris dengan Line Spacing Nyaman) -->
                        <p class="text-base sm:text-lg text-gray-300 font-['Agrandir',sans-serif] leading-[1.65] text-justify mb-8"
                            style="line-height: 1.65;">
                            Founded in 2017, <strong class="text-white font-semibold">PT. Global Aspect
                                Technology</strong> specializes in delivering tailored integrated systems in automation,
                            software development, monitoring, and control for manufacturing and non-industrial sectors
                            of all scales. As Industry 4.0 transforms modern production, we empower businesses to
                            harness cutting-edge technologies—such as the Internet of Things (IoT), artificial
                            intelligence (AI), and real-time cloud telemetry—to streamline operations, enhance
                            decision-making, and reduce costs. Our close collaborative approach and end-to-end
                            integration expertise ensure high efficiency, reliability, and long-term agility in an
                            ever-evolving digital landscape.
                        </p>

                        <!-- 6 Solution Technology Icon Boxes Row (Strictly Outline Only, No Zoom on Hover) -->
                        <div class="flex flex-wrap items-center gap-2.5 sm:gap-3.5 lg:gap-4.5 pt-2">
                            <!-- Icon 1: PLC Programming -->
                            <a href="{{ route('plc-progamming') }}" class="group relative block"
                                title="PLC Programming">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/PLC-ICON.webp') }}" alt="PLC Programming"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>

                            <!-- Icon 2: Scan & Inspection -->
                            <a href="{{ route('inspection') }}" class="group relative block"
                                title="Machine Vision & Inspection">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/ScanSearch.webp') }}" alt="Scan & Inspection"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>

                            <!-- Icon 3: Content Manager / Monitoring -->
                            <a href="{{ route('monitoring') }}" class="group relative block" title="SCADA & Telemetry">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/Content Manager.webp') }}" alt="Content Manager"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>

                            <!-- Icon 4: Integrator System -->
                            <a href="{{ route('intergrator') }}" class="group relative block" title="System Integrator">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/Integrator System.webp') }}" alt="System Integrator"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>

                            <!-- Icon 5: Laser Marking & Printing -->
                            <a href="{{ route('laser-marking') }}" class="group relative block"
                                title="Laser Marking Technology">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/Laser Marking & Inkjet Printing.webp') }}"
                                        alt="Laser Marking & Printing"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>

                            <!-- Icon 6: Strapping Machine -->
                            <a href="{{ route('strapping') }}" class="group relative block"
                                title="Industrial Strapping Machines">
                                <div
                                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-[72px] lg:h-[72px] bg-transparent rounded-xl sm:rounded-2xl lg:rounded-[22px] flex items-center justify-center p-2 sm:p-3 lg:p-3.5 border border-white/35 transition-colors duration-300 group-hover:border-white">
                                    <img src="{{ asset('storage/Strapping ICON.webp') }}" alt="Strapping Machine"
                                        class="w-full h-full object-contain filter drop-shadow">
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Stats & CTA Row (Bottom-Aligned with Card) -->
                    <div
                        class="flex flex-wrap items-center gap-6 sm:gap-7 mt-10 lg:mt-auto pt-7 sm:pt-8 border-t border-white/10">
                        <!-- Stat 1: Year -->
                        <div>
                            <div
                                class="text-2xl sm:text-3xl lg:text-[34px] font-black text-white tracking-tight font-['Agrandir',sans-serif]">
                                2017</div>
                            <div class="text-xs sm:text-[13px] text-gray-400 font-['Questrial',sans-serif] mt-1">
                                Established</div>
                        </div>

                        <!-- Divider -->
                        <div class="h-8 w-px bg-white/20"></div>

                        <!-- Stat 2: Projects -->
                        <div>
                            <div
                                class="text-2xl sm:text-3xl lg:text-[34px] font-black text-white tracking-tight font-['Agrandir',sans-serif]">
                                100+</div>
                            <div class="text-xs sm:text-[13px] text-gray-400 font-['Questrial',sans-serif] mt-1">
                                Projects Done</div>
                        </div>

                        <!-- Divider -->
                        <div class="h-8 w-px bg-white/20"></div>

                        <!-- Stat 3: Reliability -->
                        <div>
                            <div
                                class="text-2xl sm:text-3xl lg:text-[34px] font-black text-[#ef4444] tracking-tight font-['Agrandir',sans-serif]">
                                99.9%</div>
                            <div class="text-xs sm:text-[13px] text-gray-400 font-['Questrial',sans-serif] mt-1">
                                Reliability</div>
                        </div>

                        <!-- CTA Button (Gliding Red Wipe Button like Get A Quote) -->
                        <div class="sm:ml-auto pt-2 sm:pt-0">
                            <a href="{{ route('about') }}"
                                class="group relative inline-flex items-center justify-center overflow-hidden py-3.5 px-6 sm:px-7 bg-white text-black hover:text-white text-xs sm:text-sm font-semibold font-['Questrial',sans-serif] tracking-wide rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.2)] hover:shadow-[0_6px_22px_rgba(220,38,38,0.4)] active:scale-95 whitespace-nowrap"
                                style="transition: all 1000ms cubic-bezier(0.25, 1, 0.5, 1);">
                                <!-- Red Wipe Layer from Left to Right -->
                                <span
                                    class="absolute inset-0 bg-red-600 rounded-full -translate-x-full group-hover:translate-x-0"
                                    style="transition: transform 1000ms cubic-bezier(0.25, 1, 0.5, 1);"></span>

                                <!-- Text & Arrow Layer -->
                                <span class="relative z-10 flex items-center gap-2">
                                    <span>Explore Our Story</span>
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Plain White Card with Card Section 1 Image -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end reveal-on-scroll reveal-stagger-2">
                    <div
                        class="w-full max-w-xl xl:max-w-2xl min-h-[560px] sm:min-h-[640px] lg:min-h-[720px] bg-white rounded-3xl shadow-[0_25px_70px_rgba(0,0,0,0.5)] border border-gray-100 overflow-hidden flex items-center justify-center p-4 sm:p-6 lg:p-8">
                        <img src="{{ asset('storage/Card Section 1.webp') }}?v={{ time() }}"
                            alt="PT. Global Aspect Technology Solution"
                            class="w-full h-full object-contain rounded-2xl">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section 2: Dedicated Solutions Banner Section -->
    <section class="w-full bg-white py-8 sm:py-10 border-t border-b border-gray-100 text-center reveal-on-scroll">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <h2
                class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-normal font-['Questrial',sans-serif] text-black leading-snug tracking-tight">
                Providing Professional And Reliable Solutions For Various Industry
            </h2>
        </div>
    </section>

    <!-- Section 3 -->
    <section class="flex items-center bg-white text-black pt-4 sm:pt-6 lg:pt-8 pb-10 sm:pb-14 lg:pb-16">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16 flex flex-col md:flex-row items-start gap-8 lg:gap-14">
            <div class="w-full md:w-1/2 reveal-on-scroll reveal-stagger-1">
                <img src="{{ asset('storage/modul2.webp') }}" alt="Industrial Product"
                    class="w-full scale-100 max-w-3xl rounded-2xl shadow-xl">
            </div>
            <div class="w-full md:w-1/2 px-4 sm:px-6 lg:px-8 mt-6 md:mt-0 pt-1 sm:pt-2 reveal-on-scroll reveal-stagger-2">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-[72px] xl:text-[82px] 2xl:text-[90px] font-extrabold font-['Agrandir',sans-serif] text-black leading-[1.07] tracking-tight">
                    <span class="block">Elevating the</span>
                    <span class="block">Industrial</span>
                    <span class="block">Experience</span>
                </h1>
                <p class="text-base sm:text-lg text-gray-600 mt-8 sm:mt-12 lg:mt-14 xl:mt-20 font-['Questrial',sans-serif] leading-[1.65] text-justify max-w-2xl"
                    style="line-height: 1.65;">
                    Transforming traditional manufacturing into intelligent, high-efficiency ecosystems, we engineer
                    bespoke automation systems, advanced PLC programming, and precision robotics tailored to meet the
                    complex demands of modern high-speed industrial environments. By embedding smart IoT telemetry,
                    machine vision inspection, and real-time cloud data, we empower enterprises to eliminate operational
                    bottlenecks, optimize productivity, and significantly reduce operating costs while establishing a
                    resilient foundation for continuous industrial innovation.
                </p>
                <div class="mt-10 sm:mt-12 lg:mt-14">
                    <a href="{{ route('about') }}"
                        class="group relative inline-flex items-center justify-center overflow-hidden px-8 py-3.5 sm:py-4 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-base sm:text-lg font-normal tracking-wide rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(220,38,38,0.4)] hover:border-red-500/60 active:scale-95 whitespace-nowrap font-['Questrial',sans-serif]"
                        style="transition: all 1000ms cubic-bezier(0.25, 1, 0.5, 1);">
                        <!-- Red Wipe Layer from Left to Right -->
                        <span
                            class="absolute inset-0 bg-red-600 rounded-full -translate-x-full group-hover:translate-x-0"
                            style="transition: transform 1000ms cubic-bezier(0.25, 1, 0.5, 1);"></span>

                        <!-- Text Layer -->
                        <span class="relative z-10 font-['Questrial',sans-serif]">
                            Explore Our About Us
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Industrial Frontier Banner (Dark Theme) -->
    <section class="w-full bg-[#0B0C10] text-white py-12 sm:py-14 lg:py-16 border-t border-b border-neutral-800 reveal-on-scroll">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16">
                <div class="reveal-on-scroll reveal-stagger-1">
                    <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold font-['Agrandir',sans-serif] text-white tracking-tight leading-snug">
                        Advancing the Industrial Frontier
                    </h2>
                    <p class="mt-4 sm:mt-5 text-base sm:text-lg text-gray-300 font-['Questrial',sans-serif] leading-relaxed text-justify">
                        Pioneering next-generation integrated engineering solutions and smart automation architectures to drive sustainable industrial growth, maximize efficiency, and empower future-ready manufacturing operations.
                    </p>
                </div>
                <div class="reveal-on-scroll reveal-stagger-2">
                    <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold font-['Agrandir',sans-serif] text-white tracking-tight leading-snug">
                        Empowering the Industrial Revolution 4
                    </h2>
                    <p class="mt-4 sm:mt-5 text-base sm:text-lg text-gray-300 font-['Questrial',sans-serif] leading-relaxed text-justify">
                        Redefining the boundaries of Industry 4.0 through advanced robotics, intelligent IoT telemetries, and high-precision PLC systems tailored for seamlessly connected, high-speed industrial environments.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Amplifying Industrial Potential Banner -->
    <section class="w-full bg-white py-6 sm:py-8 border-t border-b border-gray-100 text-center reveal-on-scroll">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-normal font-['Questrial',sans-serif] text-black leading-snug tracking-tight">
                Amplifying Industrial Potential
            </h2>
        </div>
    </section>

    <!-- Section 4: Feature Showcase (White Theme) -->
    <section class="w-full bg-white text-black pt-4 sm:pt-6 pb-16 lg:pb-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Image Column: Plain White Card matching Section 1 -->
                <div class="w-full flex justify-center lg:justify-start reveal-on-scroll reveal-stagger-1">
                    <div
                        class="w-full max-w-xl xl:max-w-2xl min-h-[460px] sm:min-h-[520px] lg:min-h-[580px] bg-white rounded-3xl shadow-[0_25px_70px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden flex items-center justify-center p-4 sm:p-6 lg:p-8">
                        <img src="{{ asset('storage/Section 4.webp') }}?v={{ time() }}" alt="Smart Factory Telemetry Dashboard"
                            class="w-full h-full object-contain rounded-2xl">
                    </div>
                </div>

                <!-- Content Column -->
                <div class="reveal-on-scroll reveal-stagger-2">
                    <div class="space-y-8 sm:space-y-9">
                        <div>
                            <h3 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold font-['Agrandir',sans-serif] text-black tracking-tight leading-snug">
                                Powering Innovation
                            </h3>
                            <p class="mt-2.5 sm:mt-3 text-base sm:text-lg lg:text-[19px] text-gray-600 font-['Questrial',sans-serif] leading-relaxed text-justify">
                                Unlocking the full potential of integrated smart automation architectures to streamline complex industrial processes, eliminate downtime, and accelerate end-to-end production efficiency.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold font-['Agrandir',sans-serif] text-black tracking-tight leading-snug">
                                Bridging the Future
                            </h3>
                            <p class="mt-2.5 sm:mt-3 text-base sm:text-lg lg:text-[19px] text-gray-600 font-['Questrial',sans-serif] leading-relaxed text-justify">
                                Transforming modern manufacturing landscapes through high-precision robotics, intelligent IoT connectivity, and real-time telemetry for superior operational agility and sustainability.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold font-['Agrandir',sans-serif] text-black tracking-tight leading-snug">
                                Synergy at its Finest
                            </h3>
                            <p class="mt-2.5 sm:mt-3 text-base sm:text-lg lg:text-[19px] text-gray-600 font-['Questrial',sans-serif] leading-relaxed text-justify">
                                Harnessing the synergistic power of advanced PLC programming, machine vision inspection, and custom systems integration tailored for high-speed industrial environments.
                            </p>
                        </div>
                    </div>

                    <!-- CTA Button with 1000ms Red Wipe Hover -->
                    <div class="mt-10">
                        <a href="{{ route('solution') }}"
                            class="group relative inline-flex items-center justify-center overflow-hidden px-8 py-3.5 sm:py-4 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-base sm:text-lg font-normal tracking-wide rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(220,38,38,0.4)] hover:border-red-500/60 active:scale-95 whitespace-nowrap font-['Questrial',sans-serif]"
                            style="transition: all 1000ms cubic-bezier(0.25, 1, 0.5, 1);">
                            <!-- Red Wipe Layer -->
                            <span
                                class="absolute inset-0 bg-red-600 rounded-full -translate-x-full group-hover:translate-x-0"
                                style="transition: transform 1000ms cubic-bezier(0.25, 1, 0.5, 1);"></span>

                            <!-- Text Layer -->
                            <span class="relative z-10 font-['Questrial',sans-serif]">
                                Embrace the Future, Today
                            </span>
                        </a>
                    </div>
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

    <!-- Floating Button 1 -->
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