<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications - PT. Global Aspect Technology</title>

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

        /* Domain Tab Button (No border / No outline) */
        .domain-tab-btn {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .domain-tab-btn:focus,
        .domain-tab-btn:active,
        .domain-tab-btn:focus-visible {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Interactive Simulator HMI Styles */
        .sim-range {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 6px;
            background: #262626;
            border-radius: 999px;
            outline: none;
        }
        .sim-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3367A5;
            border: 2px solid #ffffff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(51, 103, 165, 0.8);
            transition: transform 0.15s ease;
        }
        .sim-range::-webkit-slider-thumb:hover {
            transform: scale(1.15);
        }
        .sim-range::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3367A5;
            border: 2px solid #ffffff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(51, 103, 165, 0.8);
        }
        @keyframes conveyorDash {
            to {
                stroke-dashoffset: -24;
            }
        }
        .animate-conveyor {
            animation: conveyorDash 0.6s linear infinite;
        }
        .sim-btn {
            border: none !important;
            outline: none !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-white text-gray-900">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION (Industrial Telemetry & Architecture Header)               -->
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
            <h1 data-lang-en="INDUSTRIAL APPLICATIONS" data-lang-id="APLIKASI INDUSTRI"
                class="text-3xl sm:text-5xl md:text-6xl lg:text-[64px] font-bold uppercase font-['Agrandir'] tracking-tight text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                INDUSTRIAL APPLICATIONS
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-4 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]"></div>

            <p data-lang-en="Smart automation architectures, machine vision quality inspection, and web-based SCADA telemetry engineered for mission-critical production facilities."
               data-lang-id="Arsitektur otomasi cerdas, inspeksi mutu visi optik, dan telemetri SCADA berbasis web yang dirancang untuk fasilitas produksi berstandar tinggi."
                class="text-sm sm:text-base md:text-lg text-gray-300 font-['Questrial'] max-w-2xl mt-5 leading-relaxed">
                Smart automation architectures, machine vision quality inspection, and web-based SCADA telemetry engineered for mission-critical production facilities.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. INTERACTIVE DOMAIN SWITCHER (SmartICS Style)                            -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 lg:py-28 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <!-- Header -->
            <div class="max-w-3xl mx-auto text-center mb-12 lg:mb-16 reveal-on-scroll">
                <h2 data-lang-en="WHERE GAT SYSTEMS ARE DEPLOYED" data-lang-id="PENERAPAN SISTEM GAT DI INDUSTRI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white font-['Agrandir'] mt-2">
                    WHERE GAT SYSTEMS ARE DEPLOYED
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="Select an operational domain below to discover our tailored system architectures, field deployment models, and measurable benefits."
                   data-lang-id="Pilih domain operasional di bawah ini untuk melihat arsitektur sistem, model implementasi lapangan, dan manfaat nyata bagi industri Anda."
                    class="text-base sm:text-lg text-gray-400 leading-relaxed font-['Questrial']">
                    Select an operational domain below to discover our tailored system architectures, field deployment models, and measurable benefits.
                </p>
            </div>

            <!-- Domain Nav Pills -->
            <div class="flex items-center justify-center flex-wrap gap-2.5 sm:gap-3 mb-12 reveal-on-scroll">
                <button type="button" onclick="switchDomain('manufacturing')" id="btn-manufacturing"
                    class="domain-tab-btn active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-300 border-0 outline-none bg-[#3367A5] text-white">
                    <span data-lang-en="Manufacturing &amp; FMCG" data-lang-id="Manufaktur &amp; FMCG">Manufacturing &amp; FMCG</span>
                </button>
                <button type="button" onclick="switchDomain('automotive')" id="btn-automotive"
                    class="domain-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-300 border-0 outline-none bg-white text-neutral-900 hover:bg-neutral-100 hover:text-black">
                    <span data-lang-en="Automotive &amp; Heavy Machinery" data-lang-id="Otomotif &amp; Alat Berat">Automotive &amp; Heavy Machinery</span>
                </button>
                <button type="button" onclick="switchDomain('pharma')" id="btn-pharma"
                    class="domain-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-300 border-0 outline-none bg-white text-neutral-900 hover:bg-neutral-100 hover:text-black">
                    <span data-lang-en="Pharma &amp; Cleanrooms" data-lang-id="Farmasi &amp; Ruang Bersih">Pharma &amp; Cleanrooms</span>
                </button>
                <button type="button" onclick="switchDomain('bms')" id="btn-bms"
                    class="domain-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-300 border-0 outline-none bg-white text-neutral-900 hover:bg-neutral-100 hover:text-black">
                    <span data-lang-en="Smart BMS &amp; Utilities" data-lang-id="Smart BMS &amp; Utilitas">Smart BMS &amp; Utilities</span>
                </button>
                <button type="button" onclick="switchDomain('logistics')" id="btn-logistics"
                    class="domain-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold font-['Agrandir'] transition-all duration-300 border-0 outline-none bg-white text-neutral-900 hover:bg-neutral-100 hover:text-black">
                    <span data-lang-en="End-of-Line Packaging" data-lang-id="Pengemasan Akhir Lini">End-of-Line Packaging</span>
                </button>
            </div>

            <!-- Domain Content Containers -->
            <div id="domain-content-area" class="reveal-on-scroll">
                
                <!-- 1. Manufacturing & FMCG -->
                <div id="pane-manufacturing" class="domain-pane grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-6 space-y-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white"
                            data-lang-en="Integrated Production Lines with Zero-Defect Control"
                            data-lang-id="Lini Produksi Terintegrasi dengan Kendali Nol Cacat">
                            Integrated Production Lines with Zero-Defect Control
                        </h3>
                        <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="FMCG lines demand continuous high throughput without unexpected stops. We synchronize PLC logic across filling, capping, cartooning, and palletizing while running in-line optical cameras that inspect labels, fill levels, and barcodes at speeds exceeding 800 units per minute."
                            data-lang-id="Lini FMCG menuntut output tinggi yang konsisten tanpa henti mendadak. Kami menyelaraskan logika PLC pada proses pengisian, penutupan botol, pengemasan kardus, dan paletisasi sembari menjalankan kamera optik berkecepatan tinggi yang memverifikasi label dan isi hingga 800 botol/menit.">
                            FMCG lines demand continuous high throughput without unexpected stops. We synchronize PLC logic across filling, capping, cartooning, and palletizing while running in-line optical cameras that inspect labels, fill levels, and barcodes at speeds exceeding 800 units per minute.
                        </p>

                        <!-- Key Highlights -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">800+ pcs/m</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Inspection Rate" data-lang-id="Kecepatan Inspeksi">Inspection Rate</div>
                            </div>
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">+32%</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Overall Line OEE" data-lang-id="Peningkatan OEE">Overall Line OEE</div>
                            </div>
                        </div>
                    </div>
                    <!-- Interactive Simulator 1: High-Speed Bottle & Label Vision Inspection -->
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900/95 shadow-2xl p-5 sm:p-6 space-y-4">
                        <!-- Simulator Top Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-neutral-800">
                            <div class="flex items-center gap-2.5">
                                <span id="sim1-dot" class="w-2.5 h-2.5 rounded-full bg-[#3367A5] animate-pulse"></span>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                        data-lang-en="LIVE SIMULATOR // CAM-01 GIGE VISION"
                                        data-lang-id="SIMULATOR LANGSUNG // CAM-01 VISI GIGE">LIVE SIMULATOR // CAM-01 GIGE VISION</div>
                                    <div class="text-sm font-bold text-white font-['Agrandir']"
                                        data-lang-en="Inspection Bottle &amp; Label Simulator"
                                        data-lang-id="Simulator Inspeksi Botol &amp; Label">Inspection Bottle &amp; Label Simulator</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="toggleBottleSim()" id="sim1-toggle-btn"
                                    class="sim-btn px-3.5 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white hover:bg-[#285284] transition-all">
                                    <span id="sim1-toggle-label" data-lang-en="Pause Line" data-lang-id="Jeda Lini">Pause Line</span>
                                </button>
                                <button type="button" onclick="resetBottleSim()"
                                    class="sim-btn px-3 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Reset" data-lang-id="Reset">Reset</button>
                            </div>
                        </div>

                        <!-- Optical Inspection Camera Viewport (SVG + HUD) -->
                        <div class="relative rounded-2xl bg-black border border-neutral-800 p-4 overflow-hidden">
                            <!-- HUD Header Overlay -->
                            <div class="flex items-center justify-between text-[11px] font-mono text-gray-400 mb-2">
                                <span id="sim1-roi-text">ROI: CAP + FILL + LABEL [300 FPS]</span>
                                <span id="sim1-judge-badge" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white">PASS // OK</span>
                            </div>

                            <!-- Conveyor & Bottle SVG Visualization -->
                            <svg viewBox="0 0 500 165" class="w-full h-36 sm:h-40 select-none">
                                <!-- Background Grid -->
                                <g stroke="#171717" stroke-width="1">
                                    <line x1="0" y1="40" x2="500" y2="40" />
                                    <line x1="0" y1="80" x2="500" y2="80" />
                                    <line x1="0" y1="120" x2="500" y2="120" />
                                    <line x1="125" y1="0" x2="125" y2="145" />
                                    <line x1="250" y1="0" x2="250" y2="145" />
                                    <line x1="375" y1="0" x2="375" y2="145" />
                                </g>

                                <!-- Vision Camera Field of View Cone -->
                                <polygon id="sim1-fov-cone" points="215,18 285,18 320,138 180,138" fill="rgba(51,103,165,0.12)" />

                                <!-- Top Optical Camera Head -->
                                <rect x="210" y="2" width="80" height="18" rx="4" fill="#262626" stroke="#3367A5" stroke-width="1.5" />
                                <circle cx="250" cy="11" r="4" fill="#3367A5" />

                                <!-- Incoming Bottle (Left Queue) -->
                                <g opacity="0.45" transform="translate(65, 32)">
                                    <rect x="14" y="0" width="16" height="9" rx="2" fill="#3367A5" />
                                    <path d="M12,9 L32,9 L38,28 L38,98 C38,101 35,104 32,104 L12,104 C9,104 6,101 6,98 L6,28 Z" fill="#171717" stroke="#525252" stroke-width="1.5" />
                                    <rect x="9" y="34" width="26" height="66" rx="2" fill="rgba(51,103,165,0.35)" />
                                    <rect x="8" y="50" width="28" height="24" rx="2" fill="#ffffff" />
                                </g>

                                <!-- Center Inspected Bottle (Active Under Camera) -->
                                <g id="sim1-active-bottle" transform="translate(228, 32)">
                                    <!-- Bottle Cap -->
                                    <rect id="sim1-bottle-cap" x="14" y="0" width="16" height="9" rx="2" fill="#3367A5" />
                                    <!-- Bottle Body -->
                                    <path d="M12,9 L32,9 L38,28 L38,98 C38,101 35,104 32,104 L12,104 C9,104 6,101 6,98 L6,28 Z" fill="#171717" stroke="#ffffff" stroke-width="1.8" />
                                    <!-- Liquid Fill Level -->
                                    <rect id="sim1-bottle-fill" x="9" y="34" width="26" height="66" rx="2" fill="rgba(51,103,165,0.55)" />
                                    <!-- Printed Bottle Label -->
                                    <g id="sim1-bottle-label" transform="rotate(0 22 62)">
                                        <rect x="8" y="50" width="28" height="24" rx="2" fill="#ffffff" />
                                        <rect x="12" y="55" width="20" height="4" fill="#3367A5" />
                                        <rect x="12" y="62" width="14" height="3" fill="#171717" />
                                        <rect x="12" y="67" width="18" height="3" fill="#525252" />
                                    </g>
                                </g>

                                <!-- Optical ROI Bounding Box Around Inspected Bottle -->
                                <rect id="sim1-roi-box" x="218" y="26" width="64" height="114" rx="6" fill="none" stroke="#3367A5" stroke-width="2" stroke-dasharray="5 3" />
                                <!-- Crosshair Target -->
                                <line x1="210" y1="66" x2="290" y2="66" stroke="#3367A5" stroke-width="1" stroke-dasharray="2 2" />

                                <!-- Outgoing Bottle / Pneumatic Rejector Zone (Right) -->
                                <g id="sim1-reject-piston" transform="translate(385, 62)">
                                    <rect x="0" y="0" width="46" height="22" rx="4" fill="#262626" stroke="#525252" stroke-width="1.5" />
                                    <text x="23" y="14" text-anchor="middle" fill="#ffffff" font-size="8" font-family="monospace">EJECTOR</text>
                                </g>

                                <!-- Conveyor Belt Line -->
                                <line x1="10" y1="145" x2="490" y2="145" stroke="#404040" stroke-width="4" />
                                <line id="sim1-belt-anim" x1="10" y1="145" x2="490" y2="145" stroke="#3367A5" stroke-width="3" stroke-dasharray="12 12" class="animate-conveyor" />
                            </svg>

                            <!-- Defect Reason Banner -->
                            <div class="mt-2 flex items-center justify-between text-xs bg-neutral-900/90 px-3 py-2 rounded-xl border border-neutral-800">
                                <span class="text-gray-400" data-lang-en="Camera Diagnostic:" data-lang-id="Diagnostik Kamera:">Camera Diagnostic:</span>
                                <span id="sim1-diag-msg" class="font-bold text-white font-['Agrandir']">CAP OK | FILL 100% | LABEL ALIGNED (0.1°)</span>
                            </div>
                        </div>

                        <!-- Defect Injection Controls & Speed Slider -->
                        <div class="space-y-3 bg-neutral-950/80 p-3.5 rounded-2xl border border-neutral-800/80">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-300 font-['Agrandir']"
                                    data-lang-en="Inject Test Condition (Click to Simulate):"
                                    data-lang-id="Uji Kondisi Inspeksi (Klik untuk Simulasi):">Inject Test Condition (Click to Simulate):</span>
                                <span class="text-[11px] text-[#3367A5] font-bold" id="sim1-mode-indicator">MODE: NORMAL</span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <button type="button" onclick="setBottleDefectMode('normal')" id="sim1-mode-normal"
                                    class="sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                    data-lang-en="Normal (OK)" data-lang-id="Normal (OK)">Normal (OK)</button>
                                <button type="button" onclick="setBottleDefectMode('cap')" id="sim1-mode-cap"
                                    class="sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Missing Cap" data-lang-id="Tanpa Tutup">Missing Cap</button>
                                <button type="button" onclick="setBottleDefectMode('fill')" id="sim1-mode-fill"
                                    class="sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Low Fill" data-lang-id="Isi Kurang">Low Fill</button>
                                <button type="button" onclick="setBottleDefectMode('label')" id="sim1-mode-label"
                                    class="sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Skewed Label" data-lang-id="Label Miring">Skewed Label</button>
                            </div>

                            <!-- Conveyor Throughput Slider -->
                            <div class="pt-1">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400" data-lang-en="Conveyor Speed Setpoint" data-lang-id="Kecepatan Konveyor">Conveyor Speed Setpoint</span>
                                    <span class="font-bold text-white font-['Agrandir']"><span id="sim1-speed-val">600</span> pcs/min</span>
                                </div>
                                <input type="range" id="sim1-speed-slider" min="200" max="850" step="50" value="600"
                                    oninput="updateBottleSpeed(this.value)" class="sim-range">
                            </div>
                        </div>

                        <!-- Live Telemetry Counters -->
                        <div class="grid grid-cols-4 gap-2 text-center">
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim1-cnt-total" class="text-base sm:text-lg font-bold font-['Agrandir'] text-neutral-900">1,240</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Inspected" data-lang-id="Diperiksa">Inspected</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim1-cnt-ok" class="text-base sm:text-lg font-bold font-['Agrandir'] text-[#3367A5]">1,236</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Good (OK)" data-lang-id="Lulus (OK)">Good (OK)</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim1-cnt-ng" class="text-base sm:text-lg font-bold font-['Agrandir'] text-neutral-900">4</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Rejected" data-lang-id="Ditolak">Rejected</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#3367A5] text-white">
                                <div id="sim1-cnt-yield" class="text-base sm:text-lg font-bold font-['Agrandir']">99.7%</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100" data-lang-en="Yield Rate" data-lang-id="Rasio Mutu">Yield Rate</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Automotive & Heavy Machinery -->
                <div id="pane-automotive" class="domain-pane hidden grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-6 space-y-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white"
                            data-lang-en="Robotic Workcells &amp; Sub-Micron Dimensional QA"
                            data-lang-id="Sel Robotik &amp; QA Dimensi Sub-Mikron">
                            Robotic Workcells &amp; Sub-Micron Dimensional QA
                        </h3>
                        <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="Automotive component plants (such as Komatsu and transmission suppliers) require rigorous dimensional tolerances. GAT retrofits hydraulic presses, implements multi-axis robotic loading cells, and integrates telecentric vision cameras verifying gear teeth and hole pitch to 0.001mm accuracy."
                            data-lang-id="Pabrik komponen otomotif (seperti mitra Komatsu) memerlukan toleransi dimensi yang sangat ketat. GAT memodernisasi mesin press hidrolik, mengintegrasikan robot perakitan multi-axis, dan memasang kamera visi telesentris untuk verifikasi gigi roda dan pitch lubang dengan akurasi 0.001mm.">
                            Automotive component plants (such as Komatsu and transmission suppliers) require rigorous dimensional tolerances. GAT retrofits hydraulic presses, implements multi-axis robotic loading cells, and integrates telecentric vision cameras verifying gear teeth and hole pitch to 0.001mm accuracy.
                        </p>

                        <!-- Key Highlights -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">&plusmn;0.001mm</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Optical Tolerance" data-lang-id="Toleransi Optik">Optical Tolerance</div>
                            </div>
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">SIL-3</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Safety Interlock Level" data-lang-id="Tingkat Keamanan">Safety Interlock Level</div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Simulator 2: Sub-Micron Telecentric QA & Live OEE Simulator (with Chart) -->
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900/95 shadow-2xl p-5 sm:p-6 space-y-4">
                        <!-- Simulator Top Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-neutral-800">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#3367A5] animate-pulse"></span>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                        data-lang-en="LIVE SIMULATOR // TELECENTRIC GAUGING &amp; OEE"
                                        data-lang-id="SIMULATOR LANGSUNG // UKUR TELESENTRIS &amp; OEE">LIVE SIMULATOR // TELECENTRIC GAUGING &amp; OEE</div>
                                    <div class="text-sm font-bold text-white font-['Agrandir']"
                                        data-lang-en="OEE Simulator (with Chart) &amp; Gear QA"
                                        data-lang-id="Simulator OEE (Grafik) &amp; QA Roda Gigi">OEE Simulator (with Chart) &amp; Gear QA</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="scanAutomotivePart(false)"
                                    class="sim-btn px-3 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white hover:bg-[#285284] transition-all"
                                    data-lang-en="Scan Good Gear" data-lang-id="Scan Gigi Normal">Scan Good Gear</button>
                                <button type="button" onclick="scanAutomotivePart(true)"
                                    class="sim-btn px-3 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Simulate Deviation" data-lang-id="Simulasi Deviasi">Simulate Deviation</button>
                            </div>
                        </div>

                        <!-- Telecentric Optical Crosshair + Live Dimensional Readout -->
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 bg-black rounded-2xl p-3.5 border border-neutral-800 items-center">
                            <div class="sm:col-span-5 flex items-center justify-center relative">
                                <svg viewBox="0 0 140 140" class="w-28 h-28">
                                    <!-- Outer Telecentric Measurement Ring -->
                                    <circle cx="70" cy="70" r="58" fill="none" stroke="#262626" stroke-width="1.5" />
                                    <circle id="sim2-gear-ring" cx="70" cy="70" r="46" fill="none" stroke="#3367A5" stroke-width="2" stroke-dasharray="8 4" />
                                    <!-- Gear Teeth Representation -->
                                    <circle cx="70" cy="70" r="34" fill="#171717" stroke="#ffffff" stroke-width="4" stroke-dasharray="7 5" />
                                    <!-- Inner Bore -->
                                    <circle cx="70" cy="70" r="16" fill="#000000" stroke="#3367A5" stroke-width="2" />
                                    <!-- Crosshair Lines -->
                                    <line x1="10" y1="70" x2="130" y2="70" stroke="#3367A5" stroke-width="1" stroke-dasharray="3 3" />
                                    <line x1="70" y1="10" x2="70" y2="130" stroke="#3367A5" stroke-width="1" stroke-dasharray="3 3" />
                                </svg>
                            </div>
                            <div class="sm:col-span-7 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-mono text-gray-400">PART: KOMATSU-GEAR-84A</span>
                                    <span id="sim2-judge-pill" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white">PASS // &plusmn;0.001mm</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="p-2 rounded-xl bg-neutral-900 border border-neutral-800">
                                        <div class="text-[10px] text-gray-400" data-lang-en="Pitch Diameter" data-lang-id="Diameter Pitch">Pitch Diameter</div>
                                        <div id="sim2-dim-val" class="text-sm font-bold text-white font-['Agrandir']">84.000 mm</div>
                                    </div>
                                    <div class="p-2 rounded-xl bg-neutral-900 border border-neutral-800">
                                        <div class="text-[10px] text-gray-400" data-lang-en="Optical Deviation" data-lang-id="Deviasi Optik">Optical Deviation</div>
                                        <div id="sim2-dev-val" class="text-sm font-bold text-[#3367A5] font-['Agrandir']">+0.000 mm</div>
                                    </div>
                                </div>
                                <div id="sim2-status-note" class="text-[11px] text-gray-300 font-mono">TELECENTRIC LASER: CONCENTRICITY OK</div>
                            </div>
                        </div>

                        <!-- Interactive OEE Simulator with Real-Time Chart -->
                        <div class="bg-neutral-950/90 rounded-2xl p-4 border border-neutral-800 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-white font-['Agrandir']"
                                    data-lang-en="Interactive OEE Calculator &amp; Live Chart"
                                    data-lang-id="Kalkulator &amp; Grafik OEE Interaktif">Interactive OEE Calculator &amp; Live Chart</span>
                                <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">OEE = A &times; P &times; Q</span>
                            </div>

                            <!-- Sliders for Availability, Performance, Quality -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <div class="flex justify-between text-[11px] mb-1">
                                        <span class="text-gray-400" data-lang-en="Availability" data-lang-id="Ketersediaan">Availability</span>
                                        <span id="sim2-a-label" class="font-bold text-white">94%</span>
                                    </div>
                                    <input type="range" id="sim2-a-slider" min="60" max="100" value="94" oninput="updateOeeSim()" class="sim-range">
                                </div>
                                <div>
                                    <div class="flex justify-between text-[11px] mb-1">
                                        <span class="text-gray-400" data-lang-en="Performance" data-lang-id="Performa">Performance</span>
                                        <span id="sim2-p-label" class="font-bold text-white">96%</span>
                                    </div>
                                    <input type="range" id="sim2-p-slider" min="60" max="100" value="96" oninput="updateOeeSim()" class="sim-range">
                                </div>
                                <div>
                                    <div class="flex justify-between text-[11px] mb-1">
                                        <span class="text-gray-400" data-lang-en="Quality Rate" data-lang-id="Mutu (Quality)">Quality Rate</span>
                                        <span id="sim2-q-label" class="font-bold text-white">99%</span>
                                    </div>
                                    <input type="range" id="sim2-q-slider" min="60" max="100" value="99" oninput="updateOeeSim()" class="sim-range">
                                </div>
                            </div>

                            <!-- Live Visual Bar Chart -->
                            <div class="pt-2 space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="w-20 text-[11px] text-gray-400 font-bold">AVAILABILITY</span>
                                    <div class="flex-1 h-3 bg-neutral-800 rounded-full overflow-hidden">
                                        <div id="sim2-bar-a" class="h-full bg-white rounded-full transition-all duration-300" style="width: 94%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="w-20 text-[11px] text-gray-400 font-bold">PERFORMANCE</span>
                                    <div class="flex-1 h-3 bg-neutral-800 rounded-full overflow-hidden">
                                        <div id="sim2-bar-p" class="h-full bg-white rounded-full transition-all duration-300" style="width: 96%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="w-20 text-[11px] text-gray-400 font-bold">QUALITY</span>
                                    <div class="flex-1 h-3 bg-neutral-800 rounded-full overflow-hidden">
                                        <div id="sim2-bar-q" class="h-full bg-white rounded-full transition-all duration-300" style="width: 99%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 pt-1">
                                    <span class="w-20 text-[11px] text-[#3367A5] font-bold">TOTAL OEE</span>
                                    <div class="flex-1 h-4 bg-neutral-800 rounded-full overflow-hidden">
                                        <div id="sim2-bar-oee" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 89.3%"></div>
                                    </div>
                                    <span id="sim2-oee-score" class="text-sm font-bold text-white font-['Agrandir'] w-14 text-right">89.3%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Pharma & Cleanrooms -->
                <div id="pane-pharma" class="domain-pane hidden grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-6 space-y-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white"
                            data-lang-en="Blister Inspection, Serialization &amp; Cleanroom SCADA"
                            data-lang-id="Inspeksi Blister, Serialisasi &amp; SCADA Ruang Bersih">
                            Blister Inspection, Serialization &amp; Cleanroom SCADA
                        </h3>
                        <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="Pharmaceutical manufacturing demands uncompromised product safety. We integrate vision inspection cameras verifying tablet color and blister seal integrity, synchronized with high-resolution TIJ inkjet batch coding and audit-trail database logging for total GMP compliance."
                            data-lang-id="Manufaktur farmasi menuntut jaminan keamanan produk tanpa kompromi. Kami menghadirkan kamera inspeksi yang memverifikasi warna tablet dan kerapatan seal blister, disinkronkan dengan pencetakan kode batch TIJ resolusi tinggi dan pencatatan audit-trail untuk kepatuhan GMP penuh.">
                            Pharmaceutical manufacturing demands uncompromised product safety. We integrate vision inspection cameras verifying tablet color and blister seal integrity, synchronized with high-resolution TIJ inkjet batch coding and audit-trail database logging for total GMP compliance.
                        </p>

                        <!-- Key Highlights -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">100%</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Audit Compliance" data-lang-id="Kepatuhan Audit">Audit Compliance</div>
                            </div>
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">Zero Fail</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Blister Seal Leakage" data-lang-id="Kebocoran Seal Blister">Blister Seal Leakage</div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Simulator 3: Pharma Blister Matrix & OCR Serialization Simulator -->
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900/95 shadow-2xl p-5 sm:p-6 space-y-4">
                        <!-- Simulator Top Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-neutral-800">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#3367A5] animate-pulse"></span>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                        data-lang-en="LIVE SIMULATOR // GMP BLISTER &amp; 2D OCR"
                                        data-lang-id="SIMULATOR LANGSUNG // BLISTER GMP &amp; OCR 2D">LIVE SIMULATOR // GMP BLISTER &amp; 2D OCR</div>
                                    <div class="text-sm font-bold text-white font-['Agrandir']"
                                        data-lang-en="Blister Cavity Matrix &amp; Batch Verifier"
                                        data-lang-id="Inspeksi Matriks Blister &amp; Kode Batch">Blister Cavity Matrix &amp; Batch Verifier</div>
                                </div>
                            </div>
                            <span id="sim3-overall-badge" class="px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white">GMP PASS // 10/10</span>
                        </div>

                        <!-- Interactive Blister Pack 2x5 Cavity Grid + OCR Serialization Box -->
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3.5 bg-black rounded-2xl p-4 border border-neutral-800 items-center">
                            <!-- 10-Cavity Clickable Blister Pack -->
                            <div class="sm:col-span-7 space-y-2">
                                <div class="flex items-center justify-between text-[11px] text-gray-400">
                                    <span data-lang-en="Click any tablet cavity to toggle defect:" data-lang-id="Klik tablet untuk simulasi cacat:">Click any tablet cavity to toggle defect:</span>
                                    <span id="sim3-cavity-label" class="font-mono text-white font-bold">10 / 10 OK</span>
                                </div>
                                <div id="sim3-blister-grid" class="grid grid-cols-5 gap-2 p-3 rounded-2xl bg-neutral-900 border border-neutral-700">
                                    <!-- 10 Cavities rendered/controlled by JS -->
                                    @for ($i = 0; $i < 10; $i++)
                                        <button type="button" onclick="toggleBlisterCavity({{ $i }})" id="sim3-cav-{{ $i }}"
                                            class="sim-btn h-11 rounded-xl bg-neutral-950 flex items-center justify-center transition-all hover:scale-105"
                                            title="Toggle Cavity #{{ $i + 1 }}">
                                            <span id="sim3-pill-{{ $i }}" class="w-6 h-6 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.6)] block transition-all"></span>
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <!-- 2D DataMatrix & OCR Batch Verification Panel -->
                            <div class="sm:col-span-5 bg-neutral-950 p-3.5 rounded-2xl border border-neutral-800 space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase text-[#3367A5] font-['Agrandir']">2D DATAMATRIX / OCR</span>
                                    <span id="sim3-ocr-conf" class="text-[11px] font-mono font-bold text-white">99.8%</span>
                                </div>
                                <div id="sim3-ocr-box" class="p-2.5 rounded-xl bg-black border border-neutral-800 font-mono text-[11px] text-white space-y-1 transition-all">
                                    <div>BATCH : <span class="text-[#3367A5] font-bold">GAT-2611A</span></div>
                                    <div>EXP   : 11 / 2028</div>
                                    <div>S/N   : 8992014402</div>
                                </div>
                                <div id="sim3-seal-msg" class="text-[11px] text-gray-400 font-mono">FOIL SEAL: ZERO PINHOLE</div>
                            </div>
                        </div>

                        <!-- Quick Scenario Preset Buttons -->
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" onclick="setPharmaScenario('good')" id="sim3-btn-good"
                                class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                data-lang-en="Good Blister (10/10)" data-lang-id="Blister Normal (10/10)">Good Blister (10/10)</button>
                            <button type="button" onclick="setPharmaScenario('missing')" id="sim3-btn-missing"
                                class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                data-lang-en="Simulate Missing Pill" data-lang-id="Simulasi Tablet Kosong">Simulate Missing Pill</button>
                            <button type="button" onclick="setPharmaScenario('ocr')" id="sim3-btn-ocr"
                                class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                data-lang-en="Simulate Blurred OCR" data-lang-id="Simulasi OCR Buram">Simulate Blurred OCR</button>
                        </div>

                        <!-- Pharma Telemetry Footer -->
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim3-stat-cav" class="text-base font-bold font-['Agrandir'] text-[#3367A5]">10 / 10</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Tablet Matrix" data-lang-id="Matriks Tablet">Tablet Matrix</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim3-stat-ocr" class="text-base font-bold font-['Agrandir'] text-neutral-900">GRADE A</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="ISO 15415 OCR" data-lang-id=" Kualitas OCR">ISO 15415 OCR</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#3367A5] text-white">
                                <div id="sim3-stat-audit" class="text-base font-bold font-['Agrandir']">LOG #4892</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100" data-lang-en="21 CFR Part 11" data-lang-id="Audit GMP">21 CFR Part 11</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Smart BMS & Utilities -->
                <div id="pane-bms" class="domain-pane hidden grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-6 space-y-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white"
                            data-lang-en="Building Management &amp; Facility Utilities Telemetry"
                            data-lang-id="Telemetri BMS &amp; Utilitas Fasilitas Gedung">
                            Building Management &amp; Facility Utilities Telemetry
                        </h3>
                        <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="Smart commercial towers and manufacturing plants use our universal web-based SCADA interface to unify multi-chiller sequences, AHU air balances, gas leakage alarms, and electrical sub-meters into one accessible web portal without per-seat licensing fees."
                            data-lang-id="Gedung komersial dan pabrik manufaktur menggunakan antarmuka SCADA web kami untuk menyatukan kontrol chiller, sirkulasi udara AHU, alarm kebocoran gas, dan sub-meter listrik ke dalam satu portal web terpadu tanpa biaya lisensi per-pengguna yang mahal.">
                            Smart commercial towers and manufacturing plants use our universal web-based SCADA interface to unify multi-chiller sequences, AHU air balances, gas leakage alarms, and electrical sub-meters into one accessible web portal without per-seat licensing fees.
                        </p>

                        <!-- Key Highlights -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">-18%</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Chiller Power Saved" data-lang-id="Penghematan Daya Chiller">Chiller Power Saved</div>
                            </div>
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">&lt;2s</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Alarm Dispatch" data-lang-id="Penyampaian Alarm">Alarm Dispatch</div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Simulator 4: EIS Energy Information, EnPI & Cos Phi Simulator -->
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900/95 shadow-2xl p-5 sm:p-6 space-y-4">
                        <!-- Simulator Top Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-neutral-800">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#3367A5] animate-pulse"></span>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                        data-lang-en="LIVE SIMULATOR // EIS-SETUP &amp; COS PHI SCADA"
                                        data-lang-id="SIMULATOR LANGSUNG // EIS-SETUP &amp; SCADA COS PHI">LIVE SIMULATOR // EIS-SETUP &amp; COS PHI SCADA</div>
                                    <div class="text-sm font-bold text-white font-['Agrandir']"
                                        data-lang-en="Energy Information (EnPI), kVarh &amp; Cos &phi; Simulator"
                                        data-lang-id="Simulator Energi (EnPI), kVarh &amp; Cos &phi;">Energy Information (EnPI), kVarh &amp; Cos &phi; Simulator</div>
                                </div>
                            </div>
                            <span id="sim4-mode-badge" class="px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white">GAT VFD OPTIMIZED</span>
                        </div>

                        <!-- Live Chiller & Electrical Sub-Meter Bar Chart -->
                        <div class="bg-black rounded-2xl p-4 border border-neutral-800 space-y-3">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400 font-mono" data-lang-en="SUB-METER LOAD DISTRIBUTION (kW)" data-lang-id="DISTRIBUSI BEBAN SUB-METER (kW)">SUB-METER LOAD DISTRIBUTION (kW)</span>
                                <span id="sim4-enpi-tag" class="font-bold text-[#3367A5] font-['Agrandir']">-18.0% kWh SAVED</span>
                            </div>

                            <!-- 5 Subsystem Bars -->
                            <div class="space-y-2">
                                <div class="flex items-center gap-2.5 text-[11px]">
                                    <span class="w-24 text-gray-300 font-mono">CHILLER #01</span>
                                    <div class="flex-1 h-3 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ch1" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 62%"></div>
                                    </div>
                                    <span id="sim4-val-ch1" class="w-14 text-right font-mono text-white">148 kW</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-[11px]">
                                    <span class="w-24 text-gray-300 font-mono">CHILLER #02</span>
                                    <div class="flex-1 h-3 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ch2" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 55%"></div>
                                    </div>
                                    <span id="sim4-val-ch2" class="w-14 text-right font-mono text-white">132 kW</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-[11px]">
                                    <span class="w-24 text-gray-300 font-mono">AHU &amp; PUMPS</span>
                                    <div class="flex-1 h-3 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ahu" class="h-full bg-white rounded-full transition-all duration-300" style="width: 42%"></div>
                                    </div>
                                    <span id="sim4-val-ahu" class="w-14 text-right font-mono text-white">56 kW</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-[11px]">
                                    <span class="w-24 text-gray-300 font-mono">REACTIVE LOAD</span>
                                    <div class="flex-1 h-3 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-kvar" class="h-full bg-white rounded-full transition-all duration-300" style="width: 24%"></div>
                                    </div>
                                    <span id="sim4-val-kvar" class="w-14 text-right font-mono text-[#3367A5]">68 kVar</span>
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Controls: Cooling Load Slider + GAT Smart VFD & Capacitor Toggle -->
                        <div class="bg-neutral-950/90 p-3.5 rounded-2xl border border-neutral-800 space-y-3">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400" data-lang-en="Building Cooling &amp; Utility Demand" data-lang-id="Beban Pendinginan &amp; Utilitas Gedung">Building Cooling &amp; Utility Demand</span>
                                    <span class="font-bold text-white font-['Agrandir']"><span id="sim4-load-label">80</span>% Load</span>
                                </div>
                                <input type="range" id="sim4-load-slider" min="40" max="100" step="5" value="80"
                                    oninput="updateBmsSim()" class="sim-range">
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" onclick="setBmsOptimization(true)" id="sim4-btn-opt"
                                    class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                    data-lang-en="GAT VFD + Auto Capacitor (ON)" data-lang-id="VFD GAT + Kapasitor (AKTIF)">GAT VFD + Auto Capacitor (ON)</button>
                                <button type="button" onclick="setBmsOptimization(false)" id="sim4-btn-base"
                                    class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Unoptimized Baseline (OFF)" data-lang-id="Mode Standar Tanpa VFD">Unoptimized Baseline (OFF)</button>
                            </div>
                        </div>

                        <!-- Live EIS & Cos Phi Counters -->
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim4-stat-kw" class="text-base sm:text-lg font-bold font-['Agrandir'] text-neutral-900">336 kW</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Total Active Power" data-lang-id="Total Daya Aktif">Total Active Power</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim4-stat-cosphi" class="text-base sm:text-lg font-bold font-['Agrandir'] text-[#3367A5]">0.98</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Power Factor (Cos &phi;)" data-lang-id="Faktor Daya (Cos &phi;)">Power Factor (Cos &phi;)</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#3367A5] text-white">
                                <div id="sim4-stat-enpi" class="text-base sm:text-lg font-bold font-['Agrandir']">-18.0%</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100" data-lang-en="EnPI Efficiency" data-lang-id="Efisiensi EnPI">EnPI Efficiency</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. End-of-Line Packaging -->
                <div id="pane-logistics" class="domain-pane hidden grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-6 space-y-6">
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-white"
                            data-lang-en="Automated Arch Strapping &amp; Warehouse Dispatch"
                            data-lang-id="Otomasi Strapping Busur &amp; Pengiriman Gudang">
                            Automated Arch Strapping &amp; Warehouse Dispatch
                        </h3>
                        <p class="text-sm sm:text-base text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="End-of-line packaging is frequently the primary bottleneck in manufacturing. We install automatic arch strapping units delivering up to 3,500N tension, synchronized with motorized roller turntables and carton sealers to eliminate packaging backlog."
                            data-lang-id="Pengemasan akhir lini kerap menjadi titik hambat utama di pabrik. Kami mengintegrasikan unit strapping busur otomatis dengan kekuatan tarik hingga 3.500N, disinkronkan dengan meja putar rol konveyor dan penutup karton untuk menghilangkan antrean kemasan.">
                            End-of-line packaging is frequently the primary bottleneck in manufacturing. We install automatic arch strapping units delivering up to 3,500N tension, synchronized with motorized roller turntables and carton sealers to eliminate packaging backlog.
                        </p>

                        <!-- Key Highlights -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-[#3367A5] font-['Agrandir']">60+</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Straps / Minute" data-lang-id="Ikatan / Menit">Straps / Minute</div>
                            </div>
                            <div class="p-4 sm:p-5 rounded-2xl bg-white border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                                <div class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">0.2s</div>
                                <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Friction Weld Seal" data-lang-id="Waktu Las Gesek">Friction Weld Seal</div>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Simulator 5: End-of-Line TIJ Coding & Automatic Arch Strapping Simulator -->
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900/95 shadow-2xl p-5 sm:p-6 space-y-4">
                        <!-- Simulator Top Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-neutral-800">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#3367A5] animate-pulse"></span>
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                        data-lang-en="LIVE SIMULATOR // TIJ INKJET &amp; ARCH STRAPPER"
                                        data-lang-id="SIMULATOR LANGSUNG // TIJ INKJET &amp; ARCH STRAPPER">LIVE SIMULATOR // TIJ INKJET &amp; ARCH STRAPPER</div>
                                    <div class="text-sm font-bold text-white font-['Agrandir']"
                                        data-lang-en="Carton TIJ Coding &amp; 3,500N Arch Strapping"
                                        data-lang-id="Simulasi Coding TIJ &amp; Strapping Karton 3.500N">Carton TIJ Coding &amp; 3,500N Arch Strapping</div>
                                </div>
                            </div>
                            <button type="button" onclick="triggerStrapCycle()"
                                class="sim-btn px-3.5 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white hover:bg-[#285284] transition-all"
                                data-lang-en="Strap Next Carton" data-lang-id="Ikat Karton Berikutnya">Strap Next Carton</button>
                        </div>

                        <!-- 3-Stage Packaging Line SVG Viewport -->
                        <div class="bg-black rounded-2xl p-4 border border-neutral-800 space-y-2">
                            <div class="flex items-center justify-between text-[11px] font-mono text-gray-400">
                                <span id="sim5-stage-text">STAGE: PHOTO-SENSOR + TIJ 300 DPI + ARCH WELD</span>
                                <span id="sim5-weld-badge" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white">0.2s WELD OK</span>
                            </div>

                            <svg viewBox="0 0 500 150" class="w-full h-32 sm:h-36 select-none">
                                <!-- Arch Strapping Machine Frame -->
                                <path d="M295,12 L415,12 L415,128 L295,128 Z" fill="none" stroke="#3367A5" stroke-width="3" rx="6" />
                                <rect x="285" y="6" width="140" height="14" rx="3" fill="#262626" stroke="#3367A5" stroke-width="1.5" />
                                <text x="355" y="16" text-anchor="middle" fill="#ffffff" font-size="8" font-family="monospace">ARCH STRAPPER 3500N</text>

                                <!-- TIJ Inkjet Printhead Station -->
                                <rect x="115" y="18" width="66" height="22" rx="4" fill="#262626" stroke="#ffffff" stroke-width="1.5" />
                                <text x="148" y="32" text-anchor="middle" fill="#ffffff" font-size="8" font-family="monospace">TIJ 300DPI</text>
                                <line x1="148" y1="40" x2="148" y2="58" stroke="#3367A5" stroke-width="2" stroke-dasharray="3 2" />

                                <!-- Active Corrugated Carton Inside Arch -->
                                <g id="sim5-carton-box" transform="translate(308, 48)">
                                    <rect x="0" y="0" width="94" height="76" rx="4" fill="#171717" stroke="#ffffff" stroke-width="2" />
                                    <!-- Printed TIJ Barcode Label on Carton -->
                                    <rect x="12" y="14" width="46" height="22" rx="2" fill="#ffffff" />
                                    <line x1="16" y1="18" x2="16" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="21" y1="18" x2="21" y2="32" stroke="#000000" stroke-width="1" />
                                    <line x1="25" y1="18" x2="25" y2="32" stroke="#000000" stroke-width="2.5" />
                                    <line x1="30" y1="18" x2="30" y2="32" stroke="#000000" stroke-width="1.5" />
                                    <line x1="35" y1="18" x2="35" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="41" y1="18" x2="41" y2="32" stroke="#000000" stroke-width="1" />
                                    <line x1="46" y1="18" x2="46" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="51" y1="18" x2="51" y2="32" stroke="#000000" stroke-width="1.5" />

                                    <!-- PET/PP Strap Band #1 -->
                                    <line id="sim5-strap-1" x1="28" y1="-2" x2="28" y2="78" stroke="#3367A5" stroke-width="4" />
                                    <!-- PET/PP Strap Band #2 (Shown in Double Strap Mode) -->
                                    <line id="sim5-strap-2" x1="68" y1="-2" x2="68" y2="78" stroke="#3367A5" stroke-width="4" />
                                </g>

                                <!-- Incoming Queued Carton under TIJ Printer -->
                                <g opacity="0.65" transform="translate(110, 58)">
                                    <rect x="0" y="0" width="76" height="66" rx="4" fill="#171717" stroke="#525252" stroke-width="1.5" />
                                    <rect x="10" y="12" width="38" height="16" rx="2" fill="#ffffff" />
                                </g>

                                <!-- Motorized Roller Conveyor -->
                                <line x1="15" y1="128" x2="485" y2="128" stroke="#404040" stroke-width="4" />
                                <line x1="15" y1="128" x2="485" y2="128" stroke="#3367A5" stroke-width="3" stroke-dasharray="12 12" class="animate-conveyor" />
                            </svg>
                        </div>

                        <!-- Controls: Strap Pattern & Tension Force Slider -->
                        <div class="bg-neutral-950/90 p-3.5 rounded-2xl border border-neutral-800 space-y-3">
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" onclick="setStrapPattern(2)" id="sim5-btn-double"
                                    class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                    data-lang-en="Double Parallel Strap (2x)" data-lang-id="Ikatan Ganda Paralel (2x)">Double Parallel Strap (2x)</button>
                                <button type="button" onclick="setStrapPattern(1)" id="sim5-btn-single"
                                    class="sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Single Center Strap (1x)" data-lang-id="Ikatan Tunggal Tengah (1x)">Single Center Strap (1x)</button>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-400" data-lang-en="PET / PP Arch Tension Force" data-lang-id="Kekuatan Tarik Tali PET / PP">PET / PP Arch Tension Force</span>
                                    <span class="font-bold text-white font-['Agrandir']"><span id="sim5-tension-label">2,800</span> N</span>
                                </div>
                                <input type="range" id="sim5-tension-slider" min="800" max="3500" step="100" value="2800"
                                    oninput="updateStrapTension(this.value)" class="sim-range">
                            </div>
                        </div>

                        <!-- Packaging Telemetry Counters -->
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim5-cnt-cartons" class="text-base sm:text-lg font-bold font-['Agrandir'] text-neutral-900">842</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Cartons Packed" data-lang-id="Karton Terkemas">Cartons Packed</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white text-neutral-900">
                                <div id="sim5-cnt-straps" class="text-base sm:text-lg font-bold font-['Agrandir'] text-[#3367A5]">1,684</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500" data-lang-en="Straps Welded" data-lang-id="Total Ikatan">Straps Welded</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#3367A5] text-white">
                                <div id="sim5-cnt-tension" class="text-base sm:text-lg font-bold font-['Agrandir']">2,800 N</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100" data-lang-en="Applied Tension" data-lang-id="Tensi Aktif">Applied Tension</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. FOUR-LAYER ARCHITECTURE STACK                                          -->
    <!-- ========================================================================= -->
    <section class="bg-white text-gray-900 py-20 sm:py-24 lg:py-28 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 lg:mb-18 reveal-on-scroll">
                <h2 data-lang-en="THE 4-LAYER INTEGRATION STACK" data-lang-id="4 LAPISAN ARSITEKTUR INTEGRASI"
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] mt-2">
                    THE 4-LAYER INTEGRATION STACK
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
                <p data-lang-en="From physical factory floor sensors up to enterprise cloud reporting, our architecture ensures zero packet loss and seamless protocol interoperability."
                   data-lang-id="Dari sensor lantai pabrik hingga pelaporan cloud korporat, arsitektur kami menjamin nol kehilangan data serta interoperabilitas protokol tanpa hambatan."
                    class="text-base sm:text-lg text-gray-600 leading-relaxed font-['Questrial']">
                    From physical factory floor sensors up to enterprise cloud reporting, our architecture ensures zero packet loss and seamless protocol interoperability.
                </p>
            </div>

            <!-- Vertical Stack Layers -->
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Layer 4: Enterprise Layer -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-1 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L4
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Enterprise &amp; Analytics" data-lang-id="Tingkat Enterprise &amp; Analitik">Enterprise &amp; Analytics</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Cloud Database &amp; MES / ERP Integration" data-lang-id="Basis Data Cloud &amp; Integrasi MES / ERP">Cloud Database &amp; MES / ERP Integration</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Automated SQL historian, executive shift summaries, SAP/Oracle sync, and paperless QA audits." data-lang-id="Historian SQL otomatis, ringkasan shift eksekutif, sinkronisasi SAP/Oracle, dan audit mutu nirkertas.">
                                Automated SQL historian, executive shift summaries, SAP/Oracle sync, and paperless QA audits.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">PostgreSQL</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">REST API</span>
                    </div>
                </div>

                <!-- Layer 3: Web SCADA & Telemetry -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-2 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#3367A5] text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L3
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Visualization &amp; Telemetry" data-lang-id="Visualisasi &amp; Telemetri">Visualization &amp; Telemetry</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Web-Based SCADA Portal &amp; Real-Time Andon" data-lang-id="Portal SCADA Berbasis Web &amp; Andon Real-Time">Web-Based SCADA Portal &amp; Real-Time Andon</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Responsive HTML5 multi-touch dashboards accessible across workstations, iPads, and mobile HMIs." data-lang-id="Dashboard responsif HTML5 yang dapat diakses langsung via browser workstation, iPad, dan tablet HMI.">
                                Responsive HTML5 multi-touch dashboards accessible across workstations, iPads, and mobile HMIs.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">HTML5 / Web</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">MQTT / WSS</span>
                    </div>
                </div>

                <!-- Layer 2: Edge Controllers & Gateways -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-3 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L2
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Edge Compute &amp; Control" data-lang-id="Komputasi Edge &amp; Kendali">Edge Compute &amp; Control</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Multi-Brand PLC &amp; Edge Fieldbus Gateways" data-lang-id="PLC Multi-Brand &amp; Gateway Fieldbus Edge">Multi-Brand PLC &amp; Edge Fieldbus Gateways</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Deterministic sub-10ms cycle execution on Mitsubishi, Omron, Siemens, and industrial IPC units." data-lang-id="Eksekusi siklus deterministik sub-10ms pada PLC Mitsubishi, Omron, Siemens, serta IPC industri.">
                                Deterministic sub-10ms cycle execution on Mitsubishi, Omron, Siemens, and industrial IPC units.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">Modbus</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">OPC-UA</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">Profinet</span>
                    </div>
                </div>

                <!-- Layer 1: Physical Machine & Sensors -->
                <div class="p-6 sm:p-7 rounded-3xl border border-gray-200 bg-neutral-50/70 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all duration-300 reveal-on-scroll reveal-stagger-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center font-bold text-sm font-['Agrandir'] shrink-0">
                            L1
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']" data-lang-en="Field Actuation &amp; Optics" data-lang-id="Aktuasi Lapangan &amp; Optik">Field Actuation &amp; Optics</span>
                            <h4 class="text-lg font-bold text-black font-['Agrandir']" data-lang-en="Vision Cameras, Laser Heads, Strappers &amp; Actuators" data-lang-id="Kamera Visi, Head Laser, Mesin Strapping &amp; Aktuator">Vision Cameras, Laser Heads, Strappers &amp; Actuators</h4>
                            <p class="text-xs sm:text-sm text-neutral-600 font-['Questrial'] mt-1" data-lang-en="Sub-micron optical sensors, pneumatic friction welders, high-speed TIJ heads, and photo-electric triggers." data-lang-id="Sensor optik sub-mikron, pengelas gesek pneumatik, head cetak TIJ berkecepatan tinggi, dan pemicu optik.">
                                Sub-micron optical sensors, pneumatic friction welders, high-speed TIJ heads, and photo-electric triggers.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">IO-Link</span>
                        <span class="px-3 py-1 rounded-full bg-neutral-200/80 text-[11px] font-bold text-neutral-700 uppercase">GigE Vision</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. CONSULTATION CTA                                                       -->
    <!-- ========================================================================= -->
    <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
        <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-['Agrandir'] tracking-tight leading-tight"
                data-lang-en="Have an Application in Mind for Your Plant?"
                data-lang-id="Punya Kebutuhan Aplikasi Otomasi untuk Pabrik Anda?">
                Have an Application in Mind for Your Plant?
            </h2>
            <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-['Questrial'] leading-relaxed"
                data-lang-en="Contact our system architects for custom architecture drafting, fieldbus interfacing, and proof-of-concept testing."
                data-lang-id="Hubungi arsitek sistem kami untuk perancangan arsitektur khusus, integrasi fieldbus, dan pengujian proof-of-concept di fasilitas Anda.">
                Contact our system architects for custom architecture drafting, fieldbus interfacing, and proof-of-concept testing.
            </p>

            <div class="pt-4 flex items-center justify-center">
                <a href="{{ route('contact') }}"
                    class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-[#3367A5] font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-['Agrandir'] border-0 outline-none isolate">
                    <span class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>
                    <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-['Agrandir'] text-sm sm:text-base font-bold text-white group-hover:text-black transition-colors duration-300">
                        <span data-lang-en="Request Technical Consultation" data-lang-id="Minta Konsultasi Teknis">Request Technical Consultation</span>
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

    <!-- Script for Domain Switcher, Interactive Live Simulators & Smooth Scroll -->
    <script>
        function switchDomain(domainId) {
            // Update Tab Buttons
            document.querySelectorAll('.domain-tab-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-[#3367A5]', 'text-white');
                btn.classList.add('bg-white', 'text-neutral-900', 'hover:bg-neutral-100', 'hover:text-black');
            });
            const activeBtn = document.getElementById('btn-' + domainId);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-neutral-900', 'hover:bg-neutral-100', 'hover:text-black');
                activeBtn.classList.add('active', 'bg-[#3367A5]', 'text-white');
            }

            // Update Content Panes
            document.querySelectorAll('.domain-pane').forEach(pane => {
                pane.classList.add('hidden');
            });
            const targetPane = document.getElementById('pane-' + domainId);
            if (targetPane) {
                targetPane.classList.remove('hidden');
            }
        }

        /* =====================================================================
         * SIMULATOR 1: HIGH-SPEED BOTTLE & LABEL VISION INSPECTION (FMCG)
         * ===================================================================== */
        const sim1State = {
            running: true,
            mode: 'normal', // 'normal' | 'cap' | 'fill' | 'label'
            speed: 600,
            total: 1240,
            ok: 1236,
            ng: 4,
            timer: null
        };

        function applyBottleVisuals() {
            const capEl = document.getElementById('sim1-bottle-cap');
            const fillEl = document.getElementById('sim1-bottle-fill');
            const labelEl = document.getElementById('sim1-bottle-label');
            const roiBox = document.getElementById('sim1-roi-box');
            const judgeBadge = document.getElementById('sim1-judge-badge');
            const diagMsg = document.getElementById('sim1-diag-msg');
            const modeInd = document.getElementById('sim1-mode-indicator');
            const piston = document.getElementById('sim1-reject-piston');

            if (!capEl || !fillEl || !labelEl) return;

            // Reset defaults
            capEl.setAttribute('opacity', '1');
            fillEl.setAttribute('y', '34');
            fillEl.setAttribute('height', '66');
            labelEl.setAttribute('transform', 'rotate(0 22 62)');

            if (sim1State.mode === 'normal') {
                roiBox.setAttribute('stroke', '#3367A5');
                judgeBadge.textContent = 'PASS // OK';
                judgeBadge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white';
                diagMsg.textContent = 'CAP OK | FILL 100% | LABEL ALIGNED (0.1°)';
                modeInd.textContent = 'MODE: NORMAL';
                if (piston) piston.setAttribute('transform', 'translate(385, 62)');
            } else if (sim1State.mode === 'cap') {
                capEl.setAttribute('opacity', '0.1');
                roiBox.setAttribute('stroke', '#ffffff');
                judgeBadge.textContent = 'REJECT // NG';
                judgeBadge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white text-black';
                diagMsg.textContent = 'FAULT: MISSING BOTTLE CAP -> EJECTED';
                modeInd.textContent = 'MODE: MISSING CAP';
                if (piston) piston.setAttribute('transform', 'translate(362, 62)');
            } else if (sim1State.mode === 'fill') {
                fillEl.setAttribute('y', '64');
                fillEl.setAttribute('height', '36');
                roiBox.setAttribute('stroke', '#ffffff');
                judgeBadge.textContent = 'REJECT // NG';
                judgeBadge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white text-black';
                diagMsg.textContent = 'FAULT: UNDERFILL LEVEL (54%) -> EJECTED';
                modeInd.textContent = 'MODE: LOW FILL';
                if (piston) piston.setAttribute('transform', 'translate(362, 62)');
            } else if (sim1State.mode === 'label') {
                labelEl.setAttribute('transform', 'rotate(14 22 62)');
                roiBox.setAttribute('stroke', '#ffffff');
                judgeBadge.textContent = 'REJECT // NG';
                judgeBadge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white text-black';
                diagMsg.textContent = 'FAULT: LABEL SKEW (+14.0°) -> EJECTED';
                modeInd.textContent = 'MODE: SKEWED LABEL';
                if (piston) piston.setAttribute('transform', 'translate(362, 62)');
            }
        }

        function stepBottleSim() {
            sim1State.total += 1;
            if (sim1State.mode === 'normal') {
                sim1State.ok += 1;
            } else {
                sim1State.ng += 1;
            }

            const totalEl = document.getElementById('sim1-cnt-total');
            const okEl = document.getElementById('sim1-cnt-ok');
            const ngEl = document.getElementById('sim1-cnt-ng');
            const yieldEl = document.getElementById('sim1-cnt-yield');
            const activeBottle = document.getElementById('sim1-active-bottle');

            if (totalEl) totalEl.textContent = sim1State.total.toLocaleString();
            if (okEl) okEl.textContent = sim1State.ok.toLocaleString();
            if (ngEl) ngEl.textContent = sim1State.ng.toLocaleString();
            if (yieldEl) {
                const y = ((sim1State.ok / sim1State.total) * 100).toFixed(1);
                yieldEl.textContent = y + '%';
            }

            // Subtle bottle pulse on each camera trigger
            if (activeBottle) {
                activeBottle.setAttribute('transform', 'translate(225, 32)');
                setTimeout(() => {
                    activeBottle.setAttribute('transform', 'translate(228, 32)');
                }, 140);
            }
        }

        function restartBottleTimer() {
            if (sim1State.timer) clearInterval(sim1State.timer);
            if (!sim1State.running) return;
            const intervalMs = Math.max(260, Math.round(1100 - (sim1State.speed * 0.9)));
            sim1State.timer = setInterval(stepBottleSim, intervalMs);
        }

        function setBottleDefectMode(mode) {
            sim1State.mode = mode;
            ['normal', 'cap', 'fill', 'label'].forEach(m => {
                const btn = document.getElementById('sim1-mode-' + m);
                if (!btn) return;
                if (m === mode) {
                    btn.className = "sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
                } else {
                    btn.className = "sim-btn sim1-mode-btn px-2.5 py-2 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
                }
            });
            applyBottleVisuals();
            stepBottleSim();
        }

        function updateBottleSpeed(val) {
            sim1State.speed = parseInt(val, 10) || 600;
            const label = document.getElementById('sim1-speed-val');
            if (label) label.textContent = sim1State.speed;
            restartBottleTimer();
        }

        function toggleBottleSim() {
            sim1State.running = !sim1State.running;
            const label = document.getElementById('sim1-toggle-label');
            const belt = document.getElementById('sim1-belt-anim');
            const dot = document.getElementById('sim1-dot');
            const isId = localStorage.getItem('selectedLang') === 'id';

            if (sim1State.running) {
                if (label) label.textContent = isId ? 'Jeda Lini' : 'Pause Line';
                if (belt) belt.classList.add('animate-conveyor');
                if (dot) dot.classList.add('animate-pulse');
                restartBottleTimer();
            } else {
                if (label) label.textContent = isId ? 'Jalankan Lini' : 'Start Line';
                if (belt) belt.classList.remove('animate-conveyor');
                if (dot) dot.classList.remove('animate-pulse');
                if (sim1State.timer) clearInterval(sim1State.timer);
            }
        }

        function resetBottleSim() {
            sim1State.total = 0;
            sim1State.ok = 0;
            sim1State.ng = 0;
            setBottleDefectMode('normal');
        }

        /* =====================================================================
         * SIMULATOR 2: TELECENTRIC GEAR QA & OEE SIMULATOR WITH CHART
         * ===================================================================== */
        function scanAutomotivePart(injectDefect) {
            const dimVal = document.getElementById('sim2-dim-val');
            const devVal = document.getElementById('sim2-dev-val');
            const pill = document.getElementById('sim2-judge-pill');
            const note = document.getElementById('sim2-status-note');
            const ring = document.getElementById('sim2-gear-ring');

            if (!injectDefect) {
                const micro = ((Math.random() * 0.0016) - 0.0008).toFixed(3);
                const sign = parseFloat(micro) >= 0 ? '+' : '';
                const measured = (84.0 + parseFloat(micro)).toFixed(3);
                if (dimVal) dimVal.textContent = measured + ' mm';
                if (devVal) {
                    devVal.textContent = sign + micro + ' mm';
                    devVal.className = "text-sm font-bold text-[#3367A5] font-['Agrandir']";
                }
                if (pill) {
                    pill.textContent = 'PASS // ±0.001mm';
                    pill.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white';
                }
                if (note) note.textContent = 'TELECENTRIC LASER: CONCENTRICITY OK';
                if (ring) ring.setAttribute('stroke', '#3367A5');
            } else {
                const dev = '+0.009';
                if (dimVal) dimVal.textContent = '84.009 mm';
                if (devVal) {
                    devVal.textContent = dev + ' mm';
                    devVal.className = "text-sm font-bold text-white font-['Agrandir']";
                }
                if (pill) {
                    pill.textContent = 'REJECT // OUT OF SPEC';
                    pill.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white text-black';
                }
                if (note) note.textContent = 'FAULT: TOOTH PITCH EXCEEDS ±0.001mm -> LOCKOUT';
                if (ring) ring.setAttribute('stroke', '#ffffff');
            }
        }

        function updateOeeSim() {
            const a = parseInt(document.getElementById('sim2-a-slider')?.value || 94, 10);
            const p = parseInt(document.getElementById('sim2-p-slider')?.value || 96, 10);
            const q = parseInt(document.getElementById('sim2-q-slider')?.value || 99, 10);

            const oee = ((a * p * q) / 10000).toFixed(1);

            const aLbl = document.getElementById('sim2-a-label');
            const pLbl = document.getElementById('sim2-p-label');
            const qLbl = document.getElementById('sim2-q-label');
            const barA = document.getElementById('sim2-bar-a');
            const barP = document.getElementById('sim2-bar-p');
            const barQ = document.getElementById('sim2-bar-q');
            const barOee = document.getElementById('sim2-bar-oee');
            const score = document.getElementById('sim2-oee-score');

            if (aLbl) aLbl.textContent = a + '%';
            if (pLbl) pLbl.textContent = p + '%';
            if (qLbl) qLbl.textContent = q + '%';
            if (barA) barA.style.width = a + '%';
            if (barP) barP.style.width = p + '%';
            if (barQ) barQ.style.width = q + '%';
            if (barOee) barOee.style.width = oee + '%';
            if (score) score.textContent = oee + '%';
        }

        /* =====================================================================
         * SIMULATOR 3: PHARMA BLISTER MATRIX & 2D OCR SERIALIZATION
         * ===================================================================== */
        const sim3State = {
            cavities: [true, true, true, true, true, true, true, true, true, true],
            ocrOk: true,
            auditLog: 4892
        };

        function renderPharmaSim() {
            let okCount = 0;
            sim3State.cavities.forEach((present, idx) => {
                if (present) okCount++;
                const pill = document.getElementById('sim3-pill-' + idx);
                const cav = document.getElementById('sim3-cav-' + idx);
                if (pill && cav) {
                    if (present) {
                        pill.className = 'w-6 h-6 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.6)] block transition-all';
                        cav.className = 'sim-btn h-11 rounded-xl bg-neutral-950 flex items-center justify-center transition-all hover:scale-105';
                    } else {
                        pill.className = 'w-4 h-4 rounded-full border-2 border-dashed border-neutral-500 bg-transparent block transition-all';
                        cav.className = 'sim-btn h-11 rounded-xl bg-neutral-800 flex items-center justify-center transition-all hover:scale-105';
                    }
                }
            });

            sim3State.auditLog += 1;

            const cavLabel = document.getElementById('sim3-cavity-label');
            const statCav = document.getElementById('sim3-stat-cav');
            const statOcr = document.getElementById('sim3-stat-ocr');
            const statAudit = document.getElementById('sim3-stat-audit');
            const ocrConf = document.getElementById('sim3-ocr-conf');
            const ocrBox = document.getElementById('sim3-ocr-box');
            const sealMsg = document.getElementById('sim3-seal-msg');
            const badge = document.getElementById('sim3-overall-badge');

            if (cavLabel) cavLabel.textContent = okCount + ' / 10 OK';
            if (statCav) statCav.textContent = okCount + ' / 10';
            if (statAudit) statAudit.textContent = 'LOG #' + sim3State.auditLog;

            if (sim3State.ocrOk) {
                if (ocrConf) ocrConf.textContent = '99.8%';
                if (ocrBox) ocrBox.style.filter = 'none';
                if (statOcr) statOcr.textContent = 'GRADE A';
            } else {
                if (ocrConf) ocrConf.textContent = '41.2% NG';
                if (ocrBox) ocrBox.style.filter = 'blur(1.8px)';
                if (statOcr) statOcr.textContent = 'OCR FAIL';
            }

            const allPass = (okCount === 10) && sim3State.ocrOk;
            if (badge) {
                if (allPass) {
                    badge.textContent = 'GMP PASS // 10/10';
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white";
                    if (sealMsg) sealMsg.textContent = 'FOIL SEAL: ZERO PINHOLE // VERIFIED';
                } else {
                    badge.textContent = 'AUTO-REJECT // NG';
                    badge.className = "px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-black";
                    if (sealMsg) {
                        sealMsg.textContent = okCount < 10 ? 'FAULT: MISSING TABLET IN MATRIX' : 'FAULT: ILLEGIBLE BATCH OCR';
                    }
                }
            }
        }

        function toggleBlisterCavity(idx) {
            sim3State.cavities[idx] = !sim3State.cavities[idx];
            renderPharmaSim();
        }

        function setPharmaScenario(type) {
            const btnGood = document.getElementById('sim3-btn-good');
            const btnMissing = document.getElementById('sim3-btn-missing');
            const btnOcr = document.getElementById('sim3-btn-ocr');

            [btnGood, btnMissing, btnOcr].forEach(b => {
                if (b) b.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
            });

            if (type === 'good') {
                sim3State.cavities = [true, true, true, true, true, true, true, true, true, true];
                sim3State.ocrOk = true;
                if (btnGood) btnGood.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            } else if (type === 'missing') {
                sim3State.cavities = [true, true, false, true, true, true, true, false, true, true];
                sim3State.ocrOk = true;
                if (btnMissing) btnMissing.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            } else if (type === 'ocr') {
                sim3State.cavities = [true, true, true, true, true, true, true, true, true, true];
                sim3State.ocrOk = false;
                if (btnOcr) btnOcr.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            }
            renderPharmaSim();
        }

        /* =====================================================================
         * SIMULATOR 4: SMART BMS EIS ENERGY, CHILLER & COS PHI SIMULATOR
         * ===================================================================== */
        const sim4State = {
            optimized: true,
            load: 80
        };

        function updateBmsSim() {
            const slider = document.getElementById('sim4-load-slider');
            sim4State.load = parseInt(slider?.value || 80, 10);
            const loadLabel = document.getElementById('sim4-load-label');
            if (loadLabel) loadLabel.textContent = sim4State.load;

            const factor = sim4State.load / 80;
            const effMultiplier = sim4State.optimized ? 0.82 : 1.0;

            const ch1 = Math.round(180 * factor * effMultiplier);
            const ch2 = Math.round(160 * factor * effMultiplier);
            const ahu = Math.round(70 * factor * effMultiplier);
            const totalKw = ch1 + ch2 + ahu;
            const kvar = sim4State.optimized ? Math.round(68 * factor) : Math.round(245 * factor);
            const cosPhi = sim4State.optimized ? '0.98' : '0.78';
            const enpi = sim4State.optimized ? '-18.0%' : '0.0%';

            const barCh1 = document.getElementById('sim4-bar-ch1');
            const barCh2 = document.getElementById('sim4-bar-ch2');
            const barAhu = document.getElementById('sim4-bar-ahu');
            const barKvar = document.getElementById('sim4-bar-kvar');

            if (barCh1) barCh1.style.width = Math.min(100, Math.round((ch1 / 230) * 100)) + '%';
            if (barCh2) barCh2.style.width = Math.min(100, Math.round((ch2 / 230) * 100)) + '%';
            if (barAhu) barAhu.style.width = Math.min(100, Math.round((ahu / 120) * 100)) + '%';
            if (barKvar) barKvar.style.width = Math.min(100, Math.round((kvar / 320) * 100)) + '%';

            const valCh1 = document.getElementById('sim4-val-ch1');
            const valCh2 = document.getElementById('sim4-val-ch2');
            const valAhu = document.getElementById('sim4-val-ahu');
            const valKvar = document.getElementById('sim4-val-kvar');

            if (valCh1) valCh1.textContent = ch1 + ' kW';
            if (valCh2) valCh2.textContent = ch2 + ' kW';
            if (valAhu) valAhu.textContent = ahu + ' kW';
            if (valKvar) valKvar.textContent = kvar + ' kVar';

            const statKw = document.getElementById('sim4-stat-kw');
            const statCos = document.getElementById('sim4-stat-cosphi');
            const statEnpi = document.getElementById('sim4-stat-enpi');
            const enpiTag = document.getElementById('sim4-enpi-tag');
            const modeBadge = document.getElementById('sim4-mode-badge');

            if (statKw) statKw.textContent = totalKw + ' kW';
            if (statCos) statCos.textContent = cosPhi;
            if (statEnpi) statEnpi.textContent = enpi;

            if (sim4State.optimized) {
                if (enpiTag) enpiTag.textContent = '-18.0% kWh SAVED';
                if (modeBadge) {
                    modeBadge.textContent = 'GAT VFD OPTIMIZED';
                    modeBadge.className = "px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white";
                }
            } else {
                if (enpiTag) enpiTag.textContent = 'UNOPTIMIZED BASELINE';
                if (modeBadge) {
                    modeBadge.textContent = 'MANUAL BASELINE';
                    modeBadge.className = "px-3 py-1 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-black";
                }
            }
        }

        function setBmsOptimization(isOpt) {
            sim4State.optimized = isOpt;
            const btnOpt = document.getElementById('sim4-btn-opt');
            const btnBase = document.getElementById('sim4-btn-base');
            if (isOpt) {
                if (btnOpt) btnOpt.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
                if (btnBase) btnBase.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
            } else {
                if (btnOpt) btnOpt.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
                if (btnBase) btnBase.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            }
            updateBmsSim();
        }

        /* =====================================================================
         * SIMULATOR 5: END-OF-LINE TIJ CODING & ARCH STRAPPING SIMULATOR
         * ===================================================================== */
        const sim5State = {
            strapsPerCarton: 2,
            tension: 2800,
            cartons: 842,
            straps: 1684
        };

        function setStrapPattern(count) {
            sim5State.strapsPerCarton = count;
            const strap1 = document.getElementById('sim5-strap-1');
            const strap2 = document.getElementById('sim5-strap-2');
            const btnDouble = document.getElementById('sim5-btn-double');
            const btnSingle = document.getElementById('sim5-btn-single');

            if (count === 2) {
                if (strap1) {
                    strap1.setAttribute('x1', '28');
                    strap1.setAttribute('x2', '28');
                }
                if (strap2) strap2.setAttribute('opacity', '1');
                if (btnDouble) btnDouble.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
                if (btnSingle) btnSingle.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
            } else {
                if (strap1) {
                    strap1.setAttribute('x1', '47');
                    strap1.setAttribute('x2', '47');
                }
                if (strap2) strap2.setAttribute('opacity', '0');
                if (btnDouble) btnDouble.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
                if (btnSingle) btnSingle.className = "sim-btn py-2 px-3 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            }
        }

        function updateStrapTension(val) {
            sim5State.tension = parseInt(val, 10) || 2800;
            const formatted = sim5State.tension.toLocaleString();
            const lbl = document.getElementById('sim5-tension-label');
            const cnt = document.getElementById('sim5-cnt-tension');
            if (lbl) lbl.textContent = formatted;
            if (cnt) cnt.textContent = formatted + ' N';
        }

        function triggerStrapCycle() {
            sim5State.cartons += 1;
            sim5State.straps += sim5State.strapsPerCarton;

            const cartonsEl = document.getElementById('sim5-cnt-cartons');
            const strapsEl = document.getElementById('sim5-cnt-straps');
            const cartonSvg = document.getElementById('sim5-carton-box');
            const badge = document.getElementById('sim5-weld-badge');

            if (cartonsEl) cartonsEl.textContent = sim5State.cartons.toLocaleString();
            if (strapsEl) strapsEl.textContent = sim5State.straps.toLocaleString();

            if (badge) {
                badge.textContent = 'WELDING (' + sim5State.tension + 'N)...';
                badge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-white text-black';
                setTimeout(() => {
                    badge.textContent = '0.2s WELD OK';
                    badge.className = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#3367A5] text-white';
                }, 280);
            }

            if (cartonSvg) {
                cartonSvg.setAttribute('transform', 'translate(298, 48)');
                setTimeout(() => {
                    cartonSvg.setAttribute('transform', 'translate(308, 48)');
                }, 220);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Start Bottle Simulator Loop
            restartBottleTimer();

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

