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
            if (!dotsGroup.node()) return;

            const indonesiaDots = [[40.2, 70.6], [40.2, 59.7], [50.4, 81.5], [50.4, 70.6], [50.4, 59.7], [60.7, 92.4], [60.7, 81.5], [60.7, 70.6], [70.9, 92.4], [70.9, 81.5], [70.9, 70.6], [81.1, 147.0], [81.1, 103.3], [81.1, 92.4], [81.1, 81.5], [81.1, 70.6], [91.3, 125.2], [91.3, 114.3], [91.3, 103.3], [91.3, 92.4], [91.3, 81.5], [101.5, 125.2], [101.5, 114.3], [101.5, 103.3], [101.5, 92.4], [111.7, 212.5], [111.7, 201.6], [111.7, 147.0], [111.7, 136.1], [111.7, 125.2], [111.7, 114.3], [111.7, 103.3], [122.0, 168.9], [122.0, 157.9], [122.0, 147.0], [122.0, 136.1], [122.0, 125.2], [122.0, 114.3], [122.0, 103.3], [132.2, 179.8], [132.2, 168.9], [132.2, 157.9], [132.2, 147.0], [132.2, 136.1], [132.2, 125.2], [142.4, 201.6], [142.4, 190.7], [142.4, 179.8], [142.4, 168.9], [142.4, 157.9], [142.4, 147.0], [142.4, 136.1], [152.6, 223.4], [152.6, 212.5], [152.6, 201.6], [152.6, 190.7], [152.6, 179.8], [152.6, 168.9], [152.6, 157.9], [152.6, 147.0], [152.6, 136.1], [162.8, 234.4], [162.8, 223.4], [162.8, 212.5], [162.8, 201.6], [162.8, 190.7], [162.8, 179.8], [162.8, 168.9], [162.8, 157.9], [162.8, 147.0], [162.8, 136.1], [173.0, 245.3], [173.0, 234.4], [173.0, 223.4], [173.0, 212.5], [173.0, 201.6], [173.0, 190.7], [173.0, 179.8], [173.0, 168.9], [173.0, 157.9], [173.0, 147.0], [183.3, 256.2], [183.3, 245.3], [183.3, 234.4], [183.3, 223.4], [183.3, 212.5], [183.3, 201.6], [183.3, 190.7], [183.3, 179.8], [183.3, 168.9], [183.3, 157.9], [183.3, 147.0], [193.5, 267.1], [193.5, 256.2], [193.5, 245.3], [193.5, 234.4], [193.5, 223.4], [193.5, 212.5], [193.5, 201.6], [193.5, 190.7], [193.5, 179.8], [193.5, 168.9], [193.5, 157.9], [203.7, 278.0], [203.7, 267.1], [203.7, 256.2], [203.7, 245.3], [203.7, 234.4], [203.7, 223.4], [203.7, 212.5], [203.7, 201.6], [203.7, 179.8], [203.7, 168.9], [203.7, 157.9], [213.9, 289.0], [213.9, 278.0], [213.9, 267.1], [213.9, 256.2], [213.9, 245.3], [213.9, 234.4], [213.9, 223.4], [213.9, 212.5], [213.9, 201.6], [224.1, 299.9], [224.1, 289.0], [224.1, 278.0], [224.1, 267.1], [224.1, 256.2], [224.1, 245.3], [224.1, 234.4], [224.1, 223.4], [224.1, 212.5], [224.1, 179.8], [234.3, 299.9], [234.3, 289.0], [234.3, 278.0], [234.3, 267.1], [234.3, 256.2], [234.3, 245.3], [234.3, 234.4], [244.6, 289.0], [244.6, 278.0], [244.6, 267.1], [244.6, 256.2], [244.6, 245.3], [244.6, 234.4], [244.6, 212.5], [254.8, 321.7], [254.8, 310.8], [254.8, 245.3], [254.8, 234.4], [254.8, 223.4], [254.8, 212.5], [265.0, 332.6], [265.0, 321.7], [265.0, 310.8], [265.0, 234.4], [275.2, 332.6], [275.2, 321.7], [275.2, 310.8], [285.4, 332.6], [285.4, 321.7], [285.4, 310.8], [295.7, 343.6], [295.7, 332.6], [295.7, 321.7], [295.7, 245.3], [295.7, 234.4], [305.9, 343.6], [305.9, 332.6], [305.9, 321.7], [316.1, 343.6], [316.1, 332.6], [316.1, 168.9], [316.1, 157.9], [326.3, 343.6], [326.3, 332.6], [326.3, 201.6], [326.3, 190.7], [326.3, 179.8], [326.3, 168.9], [326.3, 157.9], [326.3, 147.0], [326.3, 136.1], [336.5, 343.6], [336.5, 332.6], [336.5, 201.6], [336.5, 190.7], [336.5, 179.8], [336.5, 168.9], [336.5, 157.9], [346.7, 343.6], [346.7, 332.6], [346.7, 234.4], [346.7, 223.4], [346.7, 212.5], [346.7, 201.6], [346.7, 190.7], [346.7, 179.8], [346.7, 168.9], [346.7, 157.9], [357.0, 354.5], [357.0, 343.6], [357.0, 332.6], [357.0, 321.7], [357.0, 234.4], [357.0, 223.4], [357.0, 212.5], [357.0, 201.6], [357.0, 190.7], [357.0, 179.8], [357.0, 168.9], [357.0, 157.9], [367.2, 354.5], [367.2, 343.6], [367.2, 332.6], [367.2, 321.7], [367.2, 234.4], [367.2, 223.4], [367.2, 212.5], [367.2, 201.6], [367.2, 190.7], [367.2, 179.8], [367.2, 168.9], [367.2, 157.9], [377.4, 354.5], [377.4, 343.6], [377.4, 332.6], [377.4, 245.3], [377.4, 234.4], [377.4, 223.4], [377.4, 212.5], [377.4, 201.6], [377.4, 190.7], [377.4, 179.8], [377.4, 168.9], [377.4, 157.9], [387.6, 354.5], [387.6, 343.6], [387.6, 332.6], [387.6, 245.3], [387.6, 234.4], [387.6, 223.4], [387.6, 212.5], [387.6, 201.6], [387.6, 190.7], [387.6, 179.8], [387.6, 168.9], [387.6, 157.9], [387.6, 147.0], [397.8, 354.5], [397.8, 343.6], [397.8, 332.6], [397.8, 234.4], [397.8, 223.4], [397.8, 212.5], [397.8, 201.6], [397.8, 190.7], [397.8, 179.8], [397.8, 168.9], [397.8, 157.9], [397.8, 147.0], [408.0, 354.5], [408.0, 332.6], [408.0, 234.4], [408.0, 223.4], [408.0, 212.5], [408.0, 201.6], [408.0, 190.7], [408.0, 179.8], [408.0, 168.9], [408.0, 157.9], [408.0, 147.0], [418.3, 354.5], [418.3, 343.6], [418.3, 245.3], [418.3, 234.4], [418.3, 223.4], [418.3, 212.5], [418.3, 201.6], [418.3, 190.7], [418.3, 179.8], [418.3, 168.9], [418.3, 157.9], [418.3, 147.0], [428.5, 365.4], [428.5, 354.5], [428.5, 245.3], [428.5, 234.4], [428.5, 223.4], [428.5, 212.5], [428.5, 201.6], [428.5, 190.7], [428.5, 179.8], [428.5, 168.9], [428.5, 157.9], [428.5, 147.0], [438.7, 354.5], [438.7, 256.2], [438.7, 245.3], [438.7, 234.4], [438.7, 223.4], [438.7, 212.5], [438.7, 201.6], [438.7, 190.7], [438.7, 179.8], [438.7, 168.9], [438.7, 157.9], [438.7, 147.0], [438.7, 136.1], [438.7, 125.2], [448.9, 365.4], [448.9, 354.5], [448.9, 256.2], [448.9, 245.3], [448.9, 234.4], [448.9, 223.4], [448.9, 212.5], [448.9, 201.6], [448.9, 190.7], [448.9, 179.8], [448.9, 168.9], [448.9, 157.9], [448.9, 136.1], [448.9, 125.2], [448.9, 114.3], [459.1, 245.3], [459.1, 234.4], [459.1, 223.4], [459.1, 212.5], [459.1, 201.6], [459.1, 190.7], [459.1, 179.8], [459.1, 168.9], [459.1, 157.9], [459.1, 147.0], [459.1, 136.1], [459.1, 125.2], [459.1, 114.3], [459.1, 103.3], [459.1, 92.4], [459.1, 81.5], [469.3, 365.4], [469.3, 223.4], [469.3, 201.6], [469.3, 190.7], [469.3, 179.8], [469.3, 168.9], [469.3, 157.9], [469.3, 147.0], [469.3, 136.1], [469.3, 125.2], [469.3, 114.3], [469.3, 103.3], [469.3, 92.4], [469.3, 81.5], [479.6, 365.4], [479.6, 190.7], [479.6, 179.8], [479.6, 168.9], [479.6, 157.9], [479.6, 147.0], [479.6, 136.1], [479.6, 125.2], [479.6, 114.3], [479.6, 103.3], [479.6, 92.4], [479.6, 81.5], [489.8, 365.4], [489.8, 354.5], [489.8, 168.9], [489.8, 157.9], [489.8, 147.0], [489.8, 136.1], [489.8, 125.2], [489.8, 114.3], [489.8, 103.3], [489.8, 92.4], [500.0, 354.5], [500.0, 157.9], [500.0, 147.0], [500.0, 125.2], [510.2, 365.4], [510.2, 147.0], [520.4, 365.4], [520.4, 245.3], [520.4, 234.4], [530.7, 387.2], [530.7, 289.0], [530.7, 256.2], [530.7, 245.3], [530.7, 234.4], [530.7, 223.4], [530.7, 212.5], [530.7, 201.6], [540.9, 387.2], [540.9, 365.4], [540.9, 289.0], [540.9, 278.0], [540.9, 267.1], [540.9, 256.2], [540.9, 245.3], [540.9, 234.4], [540.9, 223.4], [540.9, 212.5], [540.9, 201.6], [540.9, 190.7], [540.9, 179.8], [540.9, 168.9], [551.1, 398.2], [551.1, 387.2], [551.1, 365.4], [551.1, 310.8], [551.1, 234.4], [551.1, 223.4], [551.1, 212.5], [551.1, 201.6], [561.3, 365.4], [561.3, 223.4], [561.3, 212.5], [561.3, 157.9], [561.3, 147.0], [571.5, 365.4], [571.5, 278.0], [571.5, 267.1], [571.5, 256.2], [571.5, 245.3], [571.5, 234.4], [571.5, 223.4], [571.5, 212.5], [571.5, 201.6], [571.5, 157.9], [581.7, 365.4], [581.7, 289.0], [581.7, 278.0], [581.7, 267.1], [581.7, 256.2], [581.7, 245.3], [581.7, 234.4], [581.7, 201.6], [581.7, 157.9], [592.0, 365.4], [592.0, 289.0], [592.0, 267.1], [592.0, 201.6], [592.0, 157.9], [602.2, 289.0], [602.2, 278.0], [602.2, 267.1], [602.2, 190.7], [602.2, 157.9], [612.4, 212.5], [612.4, 157.9], [622.6, 398.2], [622.6, 387.2], [622.6, 157.9], [632.8, 387.2], [632.8, 376.3], [632.8, 354.5], [632.8, 212.5], [632.8, 157.9], [643.0, 354.5], [643.0, 147.0], [663.5, 343.6], [673.7, 343.6], [673.7, 256.2], [673.7, 245.3], [683.9, 256.2], [683.9, 245.3], [694.1, 212.5], [694.1, 201.6], [694.1, 190.7], [694.1, 147.0], [704.3, 354.5], [704.3, 256.2], [704.3, 245.3], [704.3, 212.5], [704.3, 157.9], [714.6, 245.3], [714.6, 147.0], [714.6, 125.2], [724.8, 245.3], [735.0, 245.3], [745.2, 245.3], [755.4, 256.2], [755.4, 245.3], [755.4, 179.8], [765.7, 354.5], [765.7, 343.6], [765.7, 201.6], [765.7, 179.8], [775.9, 343.6], [775.9, 201.6], [786.1, 201.6], [786.1, 190.7], [796.3, 234.4], [796.3, 223.4], [796.3, 212.5], [796.3, 201.6], [796.3, 190.7], [806.5, 299.9], [806.5, 256.2], [806.5, 245.3], [806.5, 234.4], [806.5, 223.4], [806.5, 212.5], [806.5, 201.6], [806.5, 190.7], [816.7, 267.1], [816.7, 245.3], [816.7, 234.4], [816.7, 223.4], [816.7, 212.5], [816.7, 201.6], [827.0, 256.2], [827.0, 245.3], [827.0, 234.4], [827.0, 223.4], [827.0, 212.5], [827.0, 201.6], [837.2, 310.8], [837.2, 299.9], [837.2, 256.2], [837.2, 245.3], [837.2, 234.4], [847.4, 267.1], [847.4, 256.2], [857.6, 267.1], [857.6, 256.2], [857.6, 190.7], [867.8, 267.1], [867.8, 256.2], [867.8, 245.3], [867.8, 212.5], [878.0, 278.0], [878.0, 267.1], [878.0, 256.2], [878.0, 245.3], [878.0, 234.4], [878.0, 223.4], [888.3, 278.0], [888.3, 267.1], [888.3, 256.2], [888.3, 245.3], [888.3, 234.4], [888.3, 223.4], [898.5, 278.0], [898.5, 267.1], [898.5, 256.2], [898.5, 245.3], [898.5, 234.4], [898.5, 223.4], [898.5, 212.5], [908.7, 354.5], [908.7, 343.6], [908.7, 289.0], [908.7, 278.0], [908.7, 267.1], [908.7, 256.2], [908.7, 245.3], [908.7, 234.4], [908.7, 223.4], [908.7, 212.5], [918.9, 354.5], [918.9, 343.6], [918.9, 310.8], [918.9, 299.9], [918.9, 289.0], [918.9, 278.0], [918.9, 267.1], [918.9, 256.2], [918.9, 245.3], [918.9, 234.4], [918.9, 223.4], [929.1, 343.6], [929.1, 321.7], [929.1, 310.8], [929.1, 299.9], [929.1, 289.0], [929.1, 278.0], [929.1, 267.1], [929.1, 256.2], [929.1, 245.3], [929.1, 234.4], [929.1, 223.4], [939.3, 343.6], [939.3, 332.6], [939.3, 321.7], [939.3, 310.8], [939.3, 299.9], [939.3, 289.0], [939.3, 278.0], [939.3, 267.1], [939.3, 256.2], [939.3, 245.3], [939.3, 234.4], [949.6, 354.5], [949.6, 343.6], [949.6, 332.6], [949.6, 321.7], [949.6, 310.8], [949.6, 299.9], [949.6, 289.0], [949.6, 278.0], [949.6, 267.1], [949.6, 256.2], [949.6, 245.3], [949.6, 234.4], [959.8, 354.5], [959.8, 343.6], [959.8, 332.6], [959.8, 321.7], [959.8, 310.8], [959.8, 299.9], [959.8, 289.0], [959.8, 278.0], [959.8, 267.1], [959.8, 256.2], [959.8, 245.3], [959.8, 234.4], [970.0, 365.4], [970.0, 354.5], [970.0, 343.6], [970.0, 310.8], [970.0, 299.9], [970.0, 289.0], [970.0, 278.0], [970.0, 267.1], [970.0, 256.2], [970.0, 245.3], [970.0, 234.4]];

            dotsGroup.selectAll("circle")
                .data(indonesiaDots)
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