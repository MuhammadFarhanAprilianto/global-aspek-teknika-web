<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution - GAT</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">
    <!-- D3.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>

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
        .reveal-stagger-5 { transition-delay: 0.40s; }
        .reveal-stagger-6 { transition-delay: 0.48s; }
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

        .solution-action-btn {
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .solution-action-btn:hover {
            color: #000000 !important;
        }

        .solution-action-btn .btn-text-content {
            color: #ffffff;
            transition: color 0.4s ease;
        }

        .solution-action-btn:hover .btn-text-content {
            color: #000000 !important;
        }

        .solution-action-btn:hover svg {
            stroke: #000000 !important;
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
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-questrial">

    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- SERVICE SECTION (D3.js Indonesia Dotted Map with Jakarta Pin & Card)      -->
    <!-- ========================================================================= -->
    <section id="service-section"
        class="w-full bg-black min-h-[500px] md:min-h-[700px] lg:min-h-[88vh] relative flex items-center justify-end py-10 sm:py-14 px-0 overflow-hidden">

        <!-- Ambient Subtle Red Glow -->
        <div
            class="absolute top-1/2 right-0 translate-x-1/4 -translate-y-1/2 w-[750px] h-[380px] bg-red-600/10 rounded-full blur-[160px] pointer-events-none">
        </div>

        <!-- D3 Map Container with Overlay (Flush Right, z-10) -->
        <div
            class="w-full max-w-6xl lg:max-w-7xl xl:max-w-[1380px] ml-auto mr-0 sm:translate-x-4 md:translate-x-8 lg:translate-x-12 xl:translate-x-16 flex items-center justify-end relative z-10">

            <!-- SVG Map Canvas -->
            <svg id="d3-indonesia-map" viewBox="0 0 1000 460" class="w-full h-auto max-h-[400px] sm:max-h-[500px] lg:max-h-[650px] select-none">
                <!-- Dot matrix rendered via D3 -->
                <g id="d3-dots-group"></g>

                <!-- Regional Marker Pins (Static Clean Red Dots aligned to real provincial locations) -->
                <!-- 1. Jakarta (DKI Jakarta) -->
                <g id="jakarta-pin" transform="translate(275, 311)">
                    <circle r="4" fill="#ef4444" stroke="#ffffff" stroke-width="1.5" />
                    <circle r="1.5" fill="#ffffff" />
                </g>

                <!-- 2. Surabaya (Jawa Timur) -->
                <g id="surabaya-pin" transform="translate(398, 333)">
                    <circle r="4" fill="#ef4444" stroke="#ffffff" stroke-width="1.5" />
                    <circle r="1.5" fill="#ffffff" />
                </g>

                <!-- 3. Balikpapan (Kalimantan Timur) -->
                <g id="balikpapan-pin" transform="translate(480, 191)">
                    <circle r="4" fill="#ef4444" stroke="#ffffff" stroke-width="1.5" />
                    <circle r="1.5" fill="#ffffff" />
                </g>

                <!-- 4. Makassar (Sulawesi Selatan) -->
                <g id="makassar-pin" transform="translate(531, 289)">
                    <circle r="4" fill="#ef4444" stroke="#ffffff" stroke-width="1.5" />
                    <circle r="1.5" fill="#ffffff" />
                </g>

                <!-- 5. Jayapura (Papua) -->
                <g id="jayapura-pin" transform="translate(940, 225)">
                    <circle r="4" fill="#ef4444" stroke="#ffffff" stroke-width="1.5" />
                    <circle r="1.5" fill="#ffffff" />
                </g>
            </svg>

            <!-- 1. Jakarta (DKI Jakarta) Micro Card -->
            <div
                class="absolute left-[27.5%] top-[67.6%] -translate-x-1/2 -translate-y-[calc(100%+6px)] z-20 bg-[#101217]/95 backdrop-blur-xl border border-neutral-700/80 rounded-md sm:rounded-lg p-1.5 sm:p-2 shadow-2xl w-[125px] sm:w-[142px] text-white pointer-events-auto transition-all">
                <div
                    class="absolute -bottom-0.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#101217] border-r border-b border-neutral-700/80 rotate-45">
                </div>
                <div class="flex items-center justify-between gap-1 mb-1 pb-0.5 border-b border-neutral-800/80">
                    <div class="flex items-center gap-1 whitespace-nowrap min-w-0">
                        <span
                            class="bg-neutral-800 text-gray-200 text-[5.5px] sm:text-[6px] font-bold px-1 py-[0.5px] rounded">ID</span>
                        <span class="font-agrandir font-bold text-[7px] sm:text-[8px] text-white">Jakarta</span>
                        <span class="text-gray-400 text-[5.5px] sm:text-[6.5px] font-questrial">• DKI Jakarta</span>
                    </div>
                    <div class="flex text-yellow-400 text-[5.5px] sm:text-[6.5px] tracking-tight shrink-0">★★★★★</div>
                </div>
                <p class="text-[6.5px] sm:text-[7.5px] text-gray-300 font-questrial leading-relaxed">
                    “Flawless execution from initial automated vision & PLC concept to factory deployment.”
                </p>
            </div>

            <!-- 3. Surabaya (Jawa Timur) Micro Card -->
            <div
                class="absolute left-[39.8%] top-[72.4%] -translate-x-1/2 -translate-y-[calc(100%+6px)] z-20 bg-[#101217]/95 backdrop-blur-xl border border-neutral-700/80 rounded-md sm:rounded-lg p-1.5 sm:p-2 shadow-2xl w-[125px] sm:w-[142px] text-white pointer-events-auto transition-all">
                <div
                    class="absolute -bottom-0.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#101217] border-r border-b border-neutral-700/80 rotate-45">
                </div>
                <div class="flex items-center justify-between gap-1 mb-1 pb-0.5 border-b border-neutral-800/80">
                    <div class="flex items-center gap-1 whitespace-nowrap min-w-0">
                        <span
                            class="bg-neutral-800 text-gray-200 text-[5.5px] sm:text-[6px] font-bold px-1 py-[0.5px] rounded">ID</span>
                        <span class="font-agrandir font-bold text-[7px] sm:text-[8px] text-white">Surabaya</span>
                        <span class="text-gray-400 text-[5.5px] sm:text-[6.5px] font-questrial">• Jatim</span>
                    </div>
                    <div class="flex text-yellow-400 text-[5.5px] sm:text-[6.5px] tracking-tight shrink-0">★★★★★</div>
                </div>
                <p class="text-[6.5px] sm:text-[7.5px] text-gray-300 font-questrial leading-relaxed">
                    “Precision robotic sorting and conveyor automation for FMCG logistics.”
                </p>
            </div>

            <!-- 4. Balikpapan (Kalimantan Timur) Micro Card -->
            <div
                class="absolute left-[48.0%] top-[41.5%] -translate-x-1/2 -translate-y-[calc(100%+6px)] z-20 bg-[#101217]/95 backdrop-blur-xl border border-neutral-700/80 rounded-md sm:rounded-lg p-1.5 sm:p-2 shadow-2xl w-[125px] sm:w-[142px] text-white pointer-events-auto transition-all">
                <div
                    class="absolute -bottom-0.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#101217] border-r border-b border-neutral-700/80 rotate-45">
                </div>
                <div class="flex items-center justify-between gap-1 mb-1 pb-0.5 border-b border-neutral-800/80">
                    <div class="flex items-center gap-1 whitespace-nowrap min-w-0">
                        <span
                            class="bg-neutral-800 text-gray-200 text-[5.5px] sm:text-[6px] font-bold px-1 py-[0.5px] rounded">ID</span>
                        <span class="font-agrandir font-bold text-[7px] sm:text-[8px] text-white">Balikpapan</span>
                        <span class="text-gray-400 text-[5.5px] sm:text-[6.5px] font-questrial">• Kaltim</span>
                    </div>
                    <div class="flex text-yellow-400 text-[5.5px] sm:text-[6.5px] tracking-tight shrink-0">★★★★★</div>
                </div>
                <p class="text-[6.5px] sm:text-[7.5px] text-gray-300 font-questrial leading-relaxed">
                    “Heavy-duty industrial telemetry and automated safety monitoring system.”
                </p>
            </div>

            <!-- 5. Makassar (Sulawesi Selatan) Micro Card -->
            <div
                class="absolute left-[53.1%] top-[62.8%] -translate-x-1/2 -translate-y-[calc(100%+6px)] z-20 bg-[#101217]/95 backdrop-blur-xl border border-neutral-700/80 rounded-md sm:rounded-lg p-1.5 sm:p-2 shadow-2xl w-[125px] sm:w-[142px] text-white pointer-events-auto transition-all">
                <div
                    class="absolute -bottom-0.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#101217] border-r border-b border-neutral-700/80 rotate-45">
                </div>
                <div class="flex items-center justify-between gap-1 mb-1 pb-0.5 border-b border-neutral-800/80">
                    <div class="flex items-center gap-1 whitespace-nowrap min-w-0">
                        <span
                            class="bg-neutral-800 text-gray-200 text-[5.5px] sm:text-[6px] font-bold px-1 py-[0.5px] rounded">ID</span>
                        <span class="font-agrandir font-bold text-[7px] sm:text-[8px] text-white">Makassar</span>
                        <span class="text-gray-400 text-[5.5px] sm:text-[6.5px] font-questrial">• Sulsel</span>
                    </div>
                    <div class="flex text-yellow-400 text-[5.5px] sm:text-[6.5px] tracking-tight shrink-0">★★★★★</div>
                </div>
                <p class="text-[6.5px] sm:text-[7.5px] text-gray-300 font-questrial leading-relaxed">
                    “Seamless SCADA modernization and real-time processing plant control.”
                </p>
            </div>

            <!-- 5. Jayapura (Papua) Micro Card -->
            <div
                class="absolute left-[94%] top-[48.9%] -translate-x-[85%] -translate-y-[calc(100%+6px)] z-20 bg-[#101217]/95 backdrop-blur-xl border border-neutral-700/80 rounded-md sm:rounded-lg p-1.5 sm:p-2 shadow-2xl w-[125px] sm:w-[142px] text-white pointer-events-auto transition-all">
                <div
                    class="absolute -bottom-0.5 left-[85%] -translate-x-1/2 w-1.5 h-1.5 bg-[#101217] border-r border-b border-neutral-700/80 rotate-45">
                </div>
                <div class="flex items-center justify-between gap-1 mb-1 pb-0.5 border-b border-neutral-800/80">
                    <div class="flex items-center gap-1 whitespace-nowrap min-w-0">
                        <span
                            class="bg-neutral-800 text-gray-200 text-[5.5px] sm:text-[6px] font-bold px-1 py-[0.5px] rounded">ID</span>
                        <span class="font-agrandir font-bold text-[7px] sm:text-[8px] text-white">Jayapura</span>
                        <span class="text-gray-400 text-[5.5px] sm:text-[6.5px] font-questrial">• Papua</span>
                    </div>
                    <div class="flex text-yellow-400 text-[5.5px] sm:text-[6.5px] tracking-tight shrink-0">★★★★★</div>
                </div>
                <p class="text-[6.5px] sm:text-[7.5px] text-gray-300 font-questrial leading-relaxed">
                    “Reliable automated sensor network across regional supply chain hubs.”
                </p>
            </div>

        </div>

        <!-- Black Overlay Layers (Positioned ON TOP of Map & All Review Comment Cards) -->
        <div class="absolute inset-0 bg-black/40 pointer-events-none z-30"></div>
        <div
            class="absolute top-0 left-0 w-full h-44 bg-gradient-to-b from-black via-black/85 to-transparent pointer-events-none z-30">
        </div>
        <div
            class="absolute bottom-0 left-0 w-full h-44 bg-gradient-to-t from-black via-black/85 to-transparent pointer-events-none z-30">
        </div>
        <div
            class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_40%,rgba(0,0,0,0.85)_100%)] pointer-events-none z-30">
        </div>

        <!-- Bottom-Left Solution Title Block (Directly attached to section's absolute left edge, z-40) -->
        <div
            class="absolute bottom-6 sm:bottom-10 md:bottom-12 lg:bottom-16 left-4 sm:left-8 md:left-10 lg:left-16 z-40 pointer-events-none select-none reveal-on-scroll">
            <div class="flex items-center gap-2 mb-1.5 sm:mb-2">
                <span class="w-5 sm:w-8 h-[2px] bg-red-600 rounded-full inline-block"></span>
                <span
                    class="text-xs sm:text-sm font-semibold uppercase tracking-widest text-red-500 font-questrial">Automation
                    &amp; Engineering Excellence</span>
            </div>
            <h1
                class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold font-agrandir text-white uppercase tracking-tight leading-none">
                Solution
            </h1>
        </div>

    </section>

    <!-- ========================================================================= -->
    <!-- PORTFOLIO / SOLUTION SECTION (LabsStudio Modern Dark Card Style)          -->
    <!-- ========================================================================= -->
    <section class="bg-white text-black py-16 sm:py-20 lg:py-24 px-6 md:px-12 border-t border-neutral-200">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14 lg:mb-16 reveal-on-scroll">
                <span
                    class="inline-block text-sm sm:text-base font-bold uppercase tracking-widest text-red-500 font-questrial mb-2">Our
                    Capabilities</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold font-agrandir text-black uppercase tracking-tight">Integrated
                    Solutions</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Solution 1: PLC Programming -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-1">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            PLC Programming
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Robust, fail-safe ladder & structured text control architectures.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Involves developing, coding and maintaining PLC programs. We also partner with Mitsubishi,
                            Keyence, Omron, Siemens, Allan Bradley and others.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Custom Ladder & Structured Text Logic</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Multi-Brand PLC Migration & Retrofit</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>HMI / Touchscreen Operator Interface</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Safety Interlock & Fault Diagnostics</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>On-Site Commissioning & Support</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Mitsubishi</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Siemens</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Omron</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Keyence</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Allen
                                Bradley</span>
                        </div>

                        <a href="{{ route('plc-progamming') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Solution 2: Inspection & Record Data -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-2">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            Inspection & Record Data
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Ultra high-speed optical inspection up to 800 pcs/minute.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Using a visual camera to sort products that do not match the batch, with a very high machine
                            speed (800pcs/minute) this system can help in the Quality Control (QC) process.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>High-Speed Optical Sorting (800 pcs/min)</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Batch & Expiration Verification</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Defect Ejection & Reject Mechanism</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Historical Log & Production Reports</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Multi-Angle Camera Setup</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Cognex</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Keyence
                                Vision</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Python
                                OpenCV</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">High-Speed
                                Trigger</span>
                        </div>

                        <a href="{{ route('inspection') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Solution 3: Monitoring System -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-3">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            Monitoring System
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Integrated Andon IoT dashboards with real-time process control.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Development of an Andon “Monitoring” system integrated with Internet of Things (IoT)
                            technology to monitor, control, and optimize production or operational processes.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Live Andon Status Display Boards</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>IoT Gateway & Local/Cloud SCADA</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>OEE & Production Rate Tracking</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Instant Alert Notifications</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Mobile & Tablet Dashboard Access</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">IoT
                                Gateway</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">SCADA</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">MQTT
                                / Modbus</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Web
                                Dashboard</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">OEE</span>
                        </div>

                        <a href="{{ route('monitoring') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Solution 4: Integrator System -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-4">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            Integrator System
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Turnkey multidisciplinary engineering across industrial facilities.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Can work in various industries and engineering fields, such as Information Technology,
                            Manufacturing, Industrial Automation, Transportation, Smart Buildings, and IoT.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>End-to-End Plant Automation Architecture</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>MES & ERP Factory Floor Bridging</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Robotics & Motion Controller Setup</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Smart Building Energy & HVAC Control</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Multi-Protocol Hardware Interfacing</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">SCADA</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">OPC-UA</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Robotics</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">PLC
                                Integration</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">EtherCAT</span>
                        </div>

                        <a href="{{ route('intergrator') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Solution 5: Laser Marking & Inkjet -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-5">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            Laser Marking & Inkjet
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Permanent high-precision coding & high-speed barcode spraying.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Laser Marking uses laser beams to create permanent marks on materials. Inkjet Printing uses
                            ink spray technology to print batch text, images, or barcodes on product lines.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Fiber & CO2 Laser Marking Systems</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Continuous Inkjet (CIJ) Printing</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>2D DataMatrix & QR Code Stamping</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Batch Serialization & Traceability</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Integrated Conveyor Line Sync</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Fiber
                                Laser</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">CIJ
                                Printer</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">DataMatrix</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Barcode
                                128</span>
                        </div>

                        <a href="{{ route('laser-marking') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Solution 6: Strapping & Packaging -->
                <div
                    class="bg-[#000000] border border-neutral-800/90 hover:border-neutral-700 rounded-3xl p-7 md:p-8 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-red-600/10 group reveal-on-scroll reveal-stagger-6">
                    <div>
                        <!-- Card Title -->
                <h3
                            class="text-xl sm:text-2xl font-bold font-agrandir text-white leading-tight mb-2 group-hover:text-red-500 transition-colors">
                            Strapping & Packaging
                        </h3>

                        <!-- Value Proposition Line -->
                        <p class="text-xs sm:text-sm font-semibold text-red-500 font-questrial mb-3">
                            Heavy-duty automated binding & sealing for secure transport.
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-400 font-questrial leading-relaxed mb-6 text-justify">
                            Strapping in automation machinery refers to the process of binding or sealing packages using
                            plastic or metal straps to ensure secure transport and storage.
                        </p>

                        <!-- Core Deliverables -->
                        <div class="border-t border-neutral-800/80 pt-5 mb-5">
                            <span
                                class="text-[11px] font-bold tracking-wider text-gray-400 uppercase font-agrandir mb-3 block">
                                Core Deliverables
                            </span>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Fully Automatic Arch Strapping</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>High-Tension PP & PET Banding</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Palletizer & Conveyor Line Integration</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Smart Package Dimension Sensors</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-300 font-questrial">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1.5 shrink-0"></span>
                                    <span>Low-Maintenance Sealing Heads</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Tags & Action Button -->
                    <div class="pt-2">
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">PP/PET
                                Strapping</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Sealing
                                Head</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Conveyor
                                Sensor</span>
                            <span
                                class="bg-neutral-900 border border-neutral-800 text-gray-400 text-[10px] sm:text-[11px] font-questrial px-2.5 py-1 rounded-md">Pallet
                                Loader</span>
                        </div>

                        <a href="{{ route('strapping') }}"
                            class="solution-action-btn group/btn relative inline-flex items-center justify-between w-full overflow-hidden py-3.5 px-5 bg-[#ef4444] font-agrandir font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-red-600/20 hover:shadow-xl transition-all duration-700 active:scale-95 border-0 outline-none isolate">
                            <!-- White Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-white -translate-x-[105%] group-hover/btn:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                            <!-- Text & Arrow Layer -->
                            <span class="btn-text-content relative z-10 flex items-center justify-between w-full">
                                <span>Explore Solution</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1.5 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- CLIENTS SECTION (LabsStudio Modern Dark Infinite Logo Marquee)             -->
    <!-- ========================================================================= -->
    <section class="bg-[#000000] text-white py-24 relative overflow-hidden border-t border-neutral-900">
        <div class="container mx-auto px-6 mb-14 text-center reveal-on-scroll">
            <span
                class="inline-block text-xs sm:text-sm font-semibold uppercase tracking-widest text-red-500 font-agrandir mb-2">
                Trusted Partners
            </span>
            <h2 class="text-3xl md:text-5xl font-bold uppercase font-agrandir tracking-tight text-white">
                Our Clients
            </h2>
            <div class="w-16 h-1 bg-red-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-xs sm:text-sm text-gray-400 font-questrial mt-4 max-w-xl mx-auto">
                Delivering cutting-edge industrial automation, robotics, and smart manufacturing to Indonesia's industry leaders.
            </p>
        </div>

        <!-- Left & Right Gradient Fades (Signature LabsStudio Marquee Vignette) -->
        <div class="absolute left-0 top-0 bottom-0 w-24 sm:w-44 bg-gradient-to-r from-black via-black/80 to-transparent pointer-events-none z-20"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 sm:w-44 bg-gradient-to-l from-black via-black/80 to-transparent pointer-events-none z-20"></div>

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
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-60 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
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
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-60 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
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
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-60 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
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
                        class="max-h-8 sm:max-h-11 w-auto max-w-[130px] sm:max-w-[170px] object-contain opacity-60 hover:opacity-100 hover:scale-110 transition-all duration-300 filter drop-shadow {{ $brand['class'] ?? '' }}">
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Floating Button -->
    @include('components.button.button')

    <!-- ========================================================================= -->
    <!-- D3.JS INDONESIA DOTTED MAP RENDER SCRIPT                                  -->
    <!-- ========================================================================= -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dotsGroup = d3.select("#d3-dots-group");

            // Load GeoJSON-derived dot coordinates for Indonesia
            fetch("{{ asset('indonesia_dots.json') }}")
                .then(response => response.json())
                .then(dots => {
                    dotsGroup.selectAll("circle")
                        .data(dots)
                        .enter()
                        .append("circle")
                        .attr("cx", d => d[0])
                        .attr("cy", d => d[1])
                        .attr("r", 2.3)
                        .attr("fill", "#ffffff")
                        .attr("opacity", 0.85)
                        .style("cursor", "pointer")
                        .style("transition", "all 0.25s ease")
                        .on("mouseover", function () {
                            d3.select(this)
                                .attr("r", 4.2)
                                .attr("fill", "#ef4444")
                                .attr("opacity", 1);
                        })
                        .on("mouseout", function () {
                            d3.select(this)
                                .attr("r", 2.3)
                                .attr("fill", "#ffffff")
                                .attr("opacity", 0.85);
                        });
                })
                .catch(err => {
                    console.error("Error loading Indonesia dotted map:", err);
                });
        });
    </script>
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