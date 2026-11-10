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
    <!-- Single Slide Hero Section (Inspired by Sevensense Robotics Blueprint Layout) -->
    <section
        class="relative w-full min-h-[calc(100vh-92px)] pt-28 sm:pt-32 lg:pt-36 pb-12 sm:pb-14 lg:pb-16 flex items-center bg-white overflow-hidden">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- 1. Top-Center Engineering Headline -->
            <div class="text-center max-w-4xl mx-auto mb-4 sm:mb-6">
                <!-- Main Bold Engineering Headline -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-black text-gray-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.12]">
                    Tailored Automation &amp;<br class="hidden sm:inline">
                    <span class="text-red-600">Smart Integrated Systems.</span>
                </h1>
            </div>

            <!-- 2. Centerpiece Stage: Transparent Hardware Sensor Unit with CAD Blueprint Lines -->
            <div class="relative w-full max-w-5xl mx-auto flex flex-col items-center justify-center select-none py-1 sm:py-2">
                <div class="relative w-full flex items-center justify-center">
                    <picture>
                        <source srcset="{{ asset('images/HeroSection01_transparent.webp') }}" type="image/webp">
                        <img src="{{ asset('images/HeroSection01_transparent.png') }}" 
                            alt="PT Global Aspect Technology - Smart Optical Vision & Inspection System"
                            class="w-full max-h-[460px] sm:max-h-[520px] lg:max-h-[580px] object-contain block pointer-events-none drop-shadow-[0_20px_45px_rgba(0,0,0,0.06)]">
                    </picture>

                    <!-- Technical Sub-Narrative Placed in the Gambar 3 Area (Lower-Right near Connection Interface) -->
                    <div class="hidden md:block absolute bottom-4 lg:bottom-8 right-2 lg:right-6 max-w-[280px] lg:max-w-[320px] text-left pointer-events-auto">
                        <div class="text-[11px] lg:text-xs font-bold text-gray-900 uppercase tracking-wider font-['Poppins']">
                            Machine Vision &amp; AI Integration
                        </div>
                        <p class="text-[11px] lg:text-xs text-gray-600 font-['Poppins'] leading-relaxed mt-1">
                            Sub-micron optical inspection, automated packaging, and Tier-1 PLC telemetry engineered for 24/7 reliability.
                        </p>
                    </div>
                </div>

                <!-- Mobile View for Technical Sub-Narrative (Cleanly positioned below image on small screens) -->
                <div class="md:hidden w-full max-w-sm text-left mt-4 px-2">
                    <div class="text-xs font-bold text-gray-900 uppercase tracking-wider font-['Poppins']">
                        Machine Vision &amp; AI Integration
                    </div>
                    <p class="text-xs text-gray-600 font-['Poppins'] leading-relaxed mt-1">
                        Sub-micron optical inspection, automated packaging, and Tier-1 PLC telemetry engineered for 24/7 reliability.
                    </p>
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

            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

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

                <!-- Right Column: Interactive Smart Factory & Productivity Bento Grid -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end reveal-on-scroll reveal-stagger-2">
                    <div
                        class="w-full max-w-xl xl:max-w-2xl bg-white rounded-3xl shadow-[0_25px_70px_rgba(0,0,0,0.5)] border border-gray-100 overflow-hidden flex flex-col p-5 sm:p-7 gap-5 text-gray-900 select-none">
                        
                        <!-- Top Bento Card: Plant Performance & OEE Growth Chart -->
                        <div class="w-full bg-[#FAFAFA] rounded-2xl p-5 border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                            <!-- Header -->
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold font-['Agrandir',sans-serif] text-gray-950 tracking-tight">
                                    Plant Performance Growth
                                </h3>
                                <p class="text-xs text-gray-500 font-['Questrial',sans-serif] mt-1">
                                    Visualize improvements and identify areas that need attention.
                                </p>
                            </div>

                            <!-- Pinned Badges / Legend -->
                            <div class="flex items-center justify-center gap-2.5 mb-2 flex-wrap">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/90 text-[11px] font-semibold text-blue-700 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                    <span>Plant OEE: 94.8%</span>
                                </div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 border border-orange-200/90 text-[11px] font-semibold text-orange-700 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    <span>Defect Scrap: -78%</span>
                                </div>
                            </div>

                            <!-- Vector Chart Area -->
                            <div class="relative w-full pt-1">
                                <svg viewBox="0 0 540 160" class="w-full h-auto overflow-visible" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="gatBlueGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#93C5FD" />
                                            <stop offset="50%" stop-color="#3B82F6" />
                                            <stop offset="100%" stop-color="#2563EB" />
                                        </linearGradient>
                                        <linearGradient id="gatOrangeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#FDBA74" />
                                            <stop offset="50%" stop-color="#FB923C" />
                                            <stop offset="100%" stop-color="#EA580C" />
                                        </linearGradient>
                                        <linearGradient id="gatBlueArea" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#3B82F6" stop-opacity="0.08" />
                                            <stop offset="100%" stop-color="#3B82F6" stop-opacity="0.0" />
                                        </linearGradient>
                                        <filter id="softGlow" x="-10%" y="-10%" width="120%" height="120%">
                                            <feDropShadow dx="0" dy="2" stdDeviation="2.5" flood-opacity="0.12" />
                                        </filter>
                                    </defs>

                                    <!-- Grid Lines -->
                                    <line x1="15" y1="35" x2="525" y2="35" stroke="#E5E7EB" stroke-width="1" stroke-dasharray="4 4" stroke-opacity="0.7" />
                                    <line x1="15" y1="80" x2="525" y2="80" stroke="#E5E7EB" stroke-width="1" stroke-dasharray="4 4" stroke-opacity="0.7" />
                                    <line x1="15" y1="125" x2="525" y2="125" stroke="#E5E7EB" stroke-width="1" stroke-dasharray="4 4" stroke-opacity="0.7" />

                                    <!-- Vertical Target Line at x=315 (Jul) -->
                                    <line x1="315" y1="15" x2="315" y2="145" stroke="#CBD5E1" stroke-width="1.5" stroke-dasharray="2 2" />

                                    <!-- Area Fill Under Blue Curve -->
                                    <path d="M 20 105 C 80 105, 120 65, 180 65 C 240 65, 275 85, 315 85 C 365 85, 410 55, 460 52 C 495 50, 520 42, 535 40 L 535 145 L 20 145 Z" fill="url(#gatBlueArea)" />

                                    <!-- Top Curve: OEE Efficiency (Blue) -->
                                    <path d="M 20 105 C 80 105, 120 65, 180 65 C 240 65, 275 85, 315 85 C 365 85, 410 55, 460 52 C 495 50, 520 42, 535 40" stroke="url(#gatBlueGrad)" stroke-width="2.5" stroke-linecap="round" filter="url(#softGlow)" />

                                    <!-- Bottom Curve: Scrap / Defect Rate (Orange, decreasing) -->
                                    <path d="M 20 135 C 80 138, 130 135, 190 130 C 250 125, 280 110, 315 108 C 365 105, 395 85, 440 88 C 485 92, 510 122, 535 95" stroke="url(#gatOrangeGrad)" stroke-width="2.5" stroke-linecap="round" filter="url(#softGlow)" />

                                    <!-- Intersection Nodes at x=315 -->
                                    <circle cx="315" cy="85" r="4.5" fill="#2563EB" stroke="#FFFFFF" stroke-width="2" />
                                    <circle cx="315" cy="108" r="4.5" fill="#EA580C" stroke="#FFFFFF" stroke-width="2" />
                                </svg>

                                <!-- X-Axis Months Row -->
                                <div class="flex justify-between items-center text-[10px] sm:text-xs text-gray-400 font-['Questrial',sans-serif] px-1 sm:px-2 pt-2 border-t border-gray-100">
                                    <span>Feb</span>
                                    <span>Mar</span>
                                    <span>Apr</span>
                                    <span>May</span>
                                    <span>Jun</span>
                                    <span class="font-bold text-gray-900 border-b-2 border-red-500 pb-0.5">Jul</span>
                                    <span>Aug</span>
                                    <span>Sep</span>
                                    <span>Oct</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Grid: 2 Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Bottom-Left Card: Hardware Integration -->
                            <div class="bg-[#FAFAFA] rounded-2xl p-5 border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                                <div>
                                    <h4 class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-gray-950">
                                        Unified Integration
                                    </h4>
                                    <p class="text-xs text-gray-500 font-['Questrial',sans-serif] mt-1.5 leading-relaxed">
                                        Integrate smoothly with Tier-1 automation controllers, PLC, and enterprise SCADA telemetries.
                                    </p>
                                </div>

                                <div class="pt-3">
                                    <div class="inline-flex items-center gap-1.5 text-[11px] font-medium text-blue-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                        <span>Multi-Brand Controller Support</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom-Right Card: 3X Efficiency (Matching 3X >>>> in reference) -->
                            <div class="bg-[#FAFAFA] rounded-2xl p-5 border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-between transition-all duration-300 hover:shadow-md">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-3xl sm:text-4xl font-black font-['Agrandir',sans-serif] text-gray-950 tracking-tight leading-none">
                                            3X
                                        </span>
                                        <span class="text-base sm:text-lg font-bold text-gray-300 tracking-wider select-none">
                                            &rsaquo;&rsaquo;&rsaquo;&rsaquo;
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 font-['Questrial',sans-serif] leading-relaxed mt-3">
                                        Boost team &amp; plant efficiency by 3X with automated workflows and streamlined communication.
                                    </p>
                                </div>

                                <div class="pt-3">
                                    <div class="inline-flex items-center gap-1.5 text-[11px] font-medium text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>99.9% Uptime Reliability</span>
                                    </div>
                                </div>
                            </div>

                        </div>

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