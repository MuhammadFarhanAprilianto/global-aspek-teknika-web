<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive System Simulator - PT. Global Aspect Technology</title>

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

        /* Domain Tab & Simulator Buttons (Zero Border / Zero Outline) */
        .domain-tab-btn,
        .sim-btn {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }
        .domain-tab-btn:focus,
        .domain-tab-btn:active,
        .domain-tab-btn:focus-visible,
        .sim-btn:focus,
        .sim-btn:active,
        .sim-btn:focus-visible {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Interactive Simulator Range Sliders */
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
            width: 18px;
            height: 18px;
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
            width: 18px;
            height: 18px;
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
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-neutral-950 text-white">
    <!-- Navbar -->
    @include('components.navbar.header')

    @php
        $currentDomain = $activeDomain ?? 'manufacturing';
    @endphp

    <!-- ========================================================================= -->
    <!-- DEDICATED INTERACTIVE PROJECT SIMULATOR WORKBENCH                         -->
    <!-- ========================================================================= -->
    <section class="pt-32 sm:pt-36 pb-20 sm:pb-28 bg-neutral-950 min-h-screen">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">

            <!-- Back Link & Page Title Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-8 border-b border-neutral-800">
                <div>
                    <a href="{{ route('application') }}#domain-content-area"
                        class="sim-btn inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-neutral-900 hover:bg-neutral-200 text-xs font-bold font-['Agrandir'] transition-all mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span data-lang-en="Back to Applications" data-lang-id="Kembali ke Halaman Aplikasi">Back to Applications</span>
                    </a>
                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold font-['Agrandir'] text-white mt-1"
                        data-lang-en="PROJECT SYSTEM SIMULATOR"
                        data-lang-id="SIMULATOR SISTEM PROYEK">
                        PROJECT SYSTEM SIMULATOR
                    </h1>
                </div>

                <!-- Domain Simulator Switcher Pills -->
                <div class="flex items-center flex-wrap gap-2">
                    <button type="button" onclick="switchSimulator('manufacturing')" id="btn-manufacturing"
                        class="domain-tab-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] transition-all {{ $currentDomain === 'manufacturing' ? 'bg-[#3367A5] text-white active' : 'bg-white text-neutral-900 hover:bg-neutral-200' }}">
                        <span data-lang-en="1. Bottle Vision (FMCG)" data-lang-id="1. Visi Botol (FMCG)">1. Bottle Vision (FMCG)</span>
                    </button>
                    <button type="button" onclick="switchSimulator('automotive')" id="btn-automotive"
                        class="domain-tab-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] transition-all {{ $currentDomain === 'automotive' ? 'bg-[#3367A5] text-white active' : 'bg-white text-neutral-900 hover:bg-neutral-200' }}">
                        <span data-lang-en="2. Gear QA &amp; OEE Chart" data-lang-id="2. QA Roda Gigi &amp; OEE">2. Gear QA &amp; OEE Chart</span>
                    </button>
                    <button type="button" onclick="switchSimulator('pharma')" id="btn-pharma"
                        class="domain-tab-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] transition-all {{ $currentDomain === 'pharma' ? 'bg-[#3367A5] text-white active' : 'bg-white text-neutral-900 hover:bg-neutral-200' }}">
                        <span data-lang-en="3. Pharma Blister &amp; OCR" data-lang-id="3. Blister Farmasi &amp; OCR">3. Pharma Blister &amp; OCR</span>
                    </button>
                    <button type="button" onclick="switchSimulator('bms')" id="btn-bms"
                        class="domain-tab-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] transition-all {{ $currentDomain === 'bms' ? 'bg-[#3367A5] text-white active' : 'bg-white text-neutral-900 hover:bg-neutral-200' }}">
                        <span data-lang-en="4. EIS Energy &amp; Cos &phi;" data-lang-id="4. EIS Energi &amp; Cos &phi;">4. EIS Energy &amp; Cos &phi;</span>
                    </button>
                    <button type="button" onclick="switchSimulator('logistics')" id="btn-logistics"
                        class="domain-tab-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] transition-all {{ $currentDomain === 'logistics' ? 'bg-[#3367A5] text-white active' : 'bg-white text-neutral-900 hover:bg-neutral-200' }}">
                        <span data-lang-en="5. TIJ &amp; Arch Strapping" data-lang-id="5. TIJ &amp; Strapping Karton">5. TIJ &amp; Arch Strapping</span>
                    </button>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 1: MANUFACTURING & FMCG (INSPECTION BOTTLE SIMULATOR)   -->
            <!-- ================================================================= -->
            <div id="sim-pane-manufacturing" class="sim-pane {{ $currentDomain === 'manufacturing' ? '' : 'hidden' }} pt-8">
                <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-6">
                    
                    <!-- Header / Title matching Image 3 -->
                    <div class="pb-2">
                        <h2 class="text-2xl sm:text-3xl font-normal text-slate-800 tracking-tight" style="font-family: 'Questrial', -apple-system, BlinkMacSystemFont, sans-serif;">
                            Inspection Bottle Simulator
                        </h2>
                    </div>

                    <!-- 6 Parameter Cards Grid matching Image 3 (3 columns x 2 rows) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                        <!-- Card 1: Conveyor 1 -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 1</h3>
                            
                            <div>
                                <label for="cv1-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed (mm/s):</label>
                                <input type="number" id="cv1-speed" value="433" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv1-cpm" class="block text-xs text-gray-500 font-medium mb-1">CPM:</label>
                                <input type="number" id="cv1-cpm" value="130" min="10" max="2000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv1-length" class="block text-xs text-gray-500 font-medium mb-1">Length (mm):</label>
                                <input type="number" id="cv1-length" value="3000" min="500" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 text-xs text-gray-600 font-medium">
                                Spacing: <span id="cv1-spacing-text">199.8</span> mm
                            </div>
                        </div>

                        <!-- Card 2: Conveyor 2 -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 2</h3>

                            <div>
                                <label for="cv2-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed (mm/s):</label>
                                <input type="number" id="cv2-speed" value="500" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv2-length" class="block text-xs text-gray-500 font-medium mb-1">Length (mm):</label>
                                <input type="number" id="cv2-length" value="1000" min="200" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 space-y-1 text-xs text-gray-600 font-medium">
                                <div>Spacing: <span id="cv2-spacing-text">230.8</span> mm</div>
                                <div>Time per bottle: <span id="cv2-time-text">0.46</span> s</div>
                            </div>
                        </div>

                        <!-- Card 3: Conveyor 3 -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 3</h3>

                            <div>
                                <label for="cv3-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed (mm/s):</label>
                                <input type="number" id="cv3-speed" value="500" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv3-length" class="block text-xs text-gray-500 font-medium mb-1">Length (mm):</label>
                                <input type="number" id="cv3-length" value="2000" min="500" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 text-xs text-gray-600 font-medium">
                                Spacing: <span id="cv3-spacing-text">230.8</span> mm
                            </div>
                        </div>

                        <!-- Card 4: Camera Settings (CV2) -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Camera Settings (CV2)</h3>

                            <div>
                                <label for="cam-pos" class="block text-xs text-gray-500 font-medium mb-1">Position (mm):</label>
                                <input type="number" id="cam-pos" value="130" min="0" max="5000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cam-len" class="block text-xs text-gray-500 font-medium mb-1">Inspection Length (mm):</label>
                                <input type="number" id="cam-len" value="300" min="10" max="5000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cam-offset" class="block text-xs text-gray-500 font-medium mb-1">Vertical Offset (px):</label>
                                <input type="number" id="cam-offset" value="35" min="0" max="200"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cam-speed" class="block text-xs text-gray-500 font-medium mb-1">Inspection Speed (mm/s):</label>
                                <input type="number" id="cam-speed" value="750" min="10" max="5000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 space-y-1 text-xs text-gray-600 font-medium">
                                <div>Bottles in inspection: <span id="cam-bottles-text" class="font-bold text-gray-800">0</span></div>
                                <div>Inspection Time: <span id="cam-time-text">0.40</span> s</div>
                            </div>
                        </div>

                        <!-- Card 5: Delay Zone (Gate) -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Delay Zone (Gate)</h3>

                            <div>
                                <label for="gate-pos" class="block text-xs text-gray-500 font-medium mb-1">Position (mm):</label>
                                <input type="number" id="gate-pos" value="10" min="0" max="5000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="gate-len" class="block text-xs text-gray-500 font-medium mb-1">Length (mm):</label>
                                <input type="number" id="gate-len" value="80" min="10" max="2000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="gate-offset" class="block text-xs text-gray-500 font-medium mb-1">Vertical Offset (px):</label>
                                <input type="number" id="gate-offset" value="50" min="0" max="200"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 space-y-1 text-xs text-gray-600 font-medium">
                                <div>Bottles in delay: <span id="gate-bottles-text" class="font-bold text-gray-800">0</span></div>
                                <div>Last Delay: <span id="gate-last-delay-text">0.00</span> s</div>
                                <div>Average Delay: <span id="gate-avg-delay-text">0.00</span> s</div>
                            </div>
                        </div>

                        <!-- Card 6: Control -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <h3 class="text-sm font-bold text-gray-800 mb-4">Control</h3>
                                <div class="flex items-center gap-2.5">
                                    <button type="button" id="bottleSimBtnStart" onclick="startBottleSim()"
                                        class="flex-1 py-2.5 px-3 rounded-full bg-[#3367A5] hover:bg-[#285284] text-white font-medium text-xs sm:text-sm transition-all shadow-sm flex items-center justify-center gap-1">
                                        Start
                                    </button>
                                    <button type="button" id="bottleSimBtnStop" onclick="stopBottleSim()"
                                        class="flex-1 py-2.5 px-3 rounded-full bg-neutral-900 hover:bg-black text-white font-medium text-xs sm:text-sm transition-all shadow-sm flex items-center justify-center gap-1">
                                        Stop
                                    </button>
                                    <button type="button" id="bottleSimBtnReset" onclick="resetBottleSim()"
                                        class="flex-1 py-2.5 px-3 rounded-full bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-800 font-medium text-xs sm:text-sm transition-all shadow-sm flex items-center justify-center gap-1">
                                        Reset
                                    </button>
                                </div>
                            </div>
                            <div class="text-[11px] text-gray-400 mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span>Real-time Multi-Conveyor Physics</span>
                                <span id="bottleSimStatusPill" class="px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300">STOPPED</span>
                            </div>
                        </div>

                    </div>

                    <!-- Canvas Simulation Container matching Image 3 -->
                    <div class="border border-gray-300 rounded-2xl bg-white p-3 sm:p-5 overflow-hidden relative shadow-sm">
                        <canvas id="bottleSimCanvas" class="w-full block" style="height: 360px; min-height: 320px;"></canvas>
                    </div>

                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 2: AUTOMOTIVE (TELECENTRIC QA & OEE CHART SIMULATOR)    -->
            <!-- ================================================================= -->
            <div id="sim-pane-automotive" class="sim-pane {{ $currentDomain === 'automotive' ? '' : 'hidden' }} pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Left: Telecentric Laser Gauging Viewport -->
                    <div class="lg:col-span-6 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-neutral-800">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                    data-lang-en="PROJECT SIMULATOR 02 // AUTOMOTIVE &amp; HEAVY MACHINERY"
                                    data-lang-id="SIMULATOR PROYEK 02 // OTOMOTIF &amp; ALAT BERAT">PROJECT SIMULATOR 02 // AUTOMOTIVE &amp; HEAVY MACHINERY</span>
                                <h2 class="text-xl sm:text-2xl font-bold text-white font-['Agrandir'] mt-0.5"
                                    data-lang-en="Sub-Micron Telecentric Gear Gauging (&plusmn;0.001mm)"
                                    data-lang-id="Pengukuran Roda Gigi Telesentris Sub-Mikron (&plusmn;0.001mm)">
                                    Sub-Micron Telecentric Gear Gauging (&plusmn;0.001mm)
                                </h2>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="scanAutomotivePart(false)"
                                    class="sim-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white hover:bg-[#285284] transition-all"
                                    data-lang-en="Scan Good Gear" data-lang-id="Scan Gigi Normal">Scan Good Gear</button>
                                <button type="button" onclick="scanAutomotivePart(true)"
                                    class="sim-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                    data-lang-en="Simulate Deviation" data-lang-id="Simulasi Deviasi">Simulate Deviation</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 bg-black rounded-2xl p-6 border border-neutral-800 items-center">
                            <div class="sm:col-span-5 flex items-center justify-center">
                                <svg viewBox="0 0 140 140" class="w-40 h-40">
                                    <circle cx="70" cy="70" r="60" fill="none" stroke="#262626" stroke-width="1.5" />
                                    <circle id="sim2-gear-ring" cx="70" cy="70" r="46" fill="none" stroke="#3367A5" stroke-width="2.5" stroke-dasharray="8 4" />
                                    <circle cx="70" cy="70" r="34" fill="#171717" stroke="#ffffff" stroke-width="4" stroke-dasharray="7 5" />
                                    <circle cx="70" cy="70" r="16" fill="#000000" stroke="#3367A5" stroke-width="2" />
                                    <line x1="10" y1="70" x2="130" y2="70" stroke="#3367A5" stroke-width="1" stroke-dasharray="3 3" />
                                    <line x1="70" y1="10" x2="70" y2="130" stroke="#3367A5" stroke-width="1" stroke-dasharray="3 3" />
                                </svg>
                            </div>
                            <div class="sm:col-span-7 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono text-gray-400">PART: KOMATSU-GEAR-84A</span>
                                    <span id="sim2-judge-pill" class="px-3 py-1 rounded-full text-xs font-bold bg-[#3367A5] text-white">PASS // &plusmn;0.001mm</span>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="p-3.5 rounded-xl bg-neutral-900 border border-neutral-800">
                                        <div class="text-xs text-gray-400" data-lang-en="Pitch Diameter" data-lang-id="Diameter Pitch">Pitch Diameter</div>
                                        <div id="sim2-dim-val" class="text-lg font-bold text-white font-['Agrandir'] mt-1">84.000 mm</div>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-neutral-900 border border-neutral-800">
                                        <div class="text-xs text-gray-400" data-lang-en="Optical Deviation" data-lang-id="Deviasi Optik">Optical Deviation</div>
                                        <div id="sim2-dev-val" class="text-lg font-bold text-[#3367A5] font-['Agrandir'] mt-1">+0.000 mm</div>
                                    </div>
                                </div>
                                <div id="sim2-status-note" class="text-xs text-gray-300 font-mono bg-neutral-900 px-3 py-2 rounded-xl border border-neutral-800">
                                    TELECENTRIC LASER: CONCENTRICITY OK
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Interactive OEE Simulator with Live Chart -->
                    <div class="lg:col-span-6 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b border-neutral-800">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']">REAL-TIME PLANT METRICS</span>
                                <h3 class="text-xl sm:text-2xl font-bold text-white font-['Agrandir'] mt-0.5"
                                    data-lang-en="OEE Simulator (with Live Chart)"
                                    data-lang-id="Simulator OEE (dengan Grafik Langsung)">OEE Simulator (with Live Chart)</h3>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-white text-neutral-900 text-xs font-bold font-['Agrandir']">OEE = A &times; P &times; Q</span>
                        </div>

                        <!-- Sliders -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-neutral-950 p-4 rounded-2xl border border-neutral-800">
                            <div>
                                <div class="flex justify-between text-xs mb-1.5">
                                    <span class="text-gray-400" data-lang-en="Availability" data-lang-id="Ketersediaan">Availability</span>
                                    <span id="sim2-a-label" class="font-bold text-white">94%</span>
                                </div>
                                <input type="range" id="sim2-a-slider" min="60" max="100" value="94" oninput="updateOeeSim()" class="sim-range">
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1.5">
                                    <span class="text-gray-400" data-lang-en="Performance" data-lang-id="Performa">Performance</span>
                                    <span id="sim2-p-label" class="font-bold text-white">96%</span>
                                </div>
                                <input type="range" id="sim2-p-slider" min="60" max="100" value="96" oninput="updateOeeSim()" class="sim-range">
                            </div>
                            <div>
                                <div class="flex justify-between text-xs mb-1.5">
                                    <span class="text-gray-400" data-lang-en="Quality Rate" data-lang-id="Mutu (Quality)">Quality Rate</span>
                                    <span id="sim2-q-label" class="font-bold text-white">99%</span>
                                </div>
                                <input type="range" id="sim2-q-slider" min="60" max="100" value="99" oninput="updateOeeSim()" class="sim-range">
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="space-y-3 bg-black p-5 rounded-2xl border border-neutral-800">
                            <div class="flex items-center gap-3">
                                <span class="w-28 text-xs text-gray-400 font-bold">AVAILABILITY</span>
                                <div class="flex-1 h-4 bg-neutral-800 rounded-full overflow-hidden">
                                    <div id="sim2-bar-a" class="h-full bg-white rounded-full transition-all duration-300" style="width: 94%"></div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-28 text-xs text-gray-400 font-bold">PERFORMANCE</span>
                                <div class="flex-1 h-4 bg-neutral-800 rounded-full overflow-hidden">
                                    <div id="sim2-bar-p" class="h-full bg-white rounded-full transition-all duration-300" style="width: 96%"></div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-28 text-xs text-gray-400 font-bold">QUALITY RATE</span>
                                <div class="flex-1 h-4 bg-neutral-800 rounded-full overflow-hidden">
                                    <div id="sim2-bar-q" class="h-full bg-white rounded-full transition-all duration-300" style="width: 99%"></div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 pt-2 border-t border-neutral-800">
                                <span class="w-28 text-xs text-[#3367A5] font-bold">OVERALL OEE</span>
                                <div class="flex-1 h-5 bg-neutral-800 rounded-full overflow-hidden">
                                    <div id="sim2-bar-oee" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 89.3%"></div>
                                </div>
                                <span id="sim2-oee-score" class="text-lg font-bold text-white font-['Agrandir'] w-16 text-right">89.3%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 3: PHARMA & CLEANROOMS (BLISTER MATRIX & 2D OCR)        -->
            <!-- ================================================================= -->
            <div id="sim-pane-pharma" class="sim-pane {{ $currentDomain === 'pharma' ? '' : 'hidden' }} pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-neutral-800">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                    data-lang-en="PROJECT SIMULATOR 03 // PHARMA &amp; CLEANROOMS"
                                    data-lang-id="SIMULATOR PROYEK 03 // FARMASI &amp; RUANG BERSIH">PROJECT SIMULATOR 03 // PHARMA &amp; CLEANROOMS</span>
                                <h2 class="text-xl sm:text-2xl font-bold text-white font-['Agrandir'] mt-0.5"
                                    data-lang-en="Blister Pack 10-Cavity Matrix &amp; 2D OCR Serialization"
                                    data-lang-id="Inspeksi Matriks 10-Rongga Blister &amp; Serialisasi OCR 2D">
                                    Blister Pack 10-Cavity Matrix &amp; 2D OCR Serialization
                                </h2>
                            </div>
                            <span id="sim3-overall-badge" class="px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white">GMP PASS // 10/10</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 bg-black rounded-2xl p-6 border border-neutral-800 items-center">
                            <!-- 10-Cavity Clickable Blister Grid -->
                            <div class="sm:col-span-7 space-y-3">
                                <div class="flex items-center justify-between text-xs text-gray-400">
                                    <span data-lang-en="Click any tablet cavity to toggle defect:" data-lang-id="Klik tablet untuk simulasi cacat:">Click any tablet cavity to toggle defect:</span>
                                    <span id="sim3-cavity-label" class="font-mono text-white font-bold">10 / 10 OK</span>
                                </div>
                                <div class="grid grid-cols-5 gap-3 p-4 rounded-2xl bg-neutral-900 border border-neutral-700">
                                    @for ($i = 0; $i < 10; $i++)
                                        <button type="button" onclick="toggleBlisterCavity({{ $i }})" id="sim3-cav-{{ $i }}"
                                            class="sim-btn h-14 rounded-xl bg-neutral-950 flex items-center justify-center transition-all hover:scale-105"
                                            title="Toggle Cavity #{{ $i + 1 }}">
                                            <span id="sim3-pill-{{ $i }}" class="w-7 h-7 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.6)] block transition-all"></span>
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <!-- 2D DataMatrix & OCR Box -->
                            <div class="sm:col-span-5 bg-neutral-950 p-4 rounded-2xl border border-neutral-800 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase text-[#3367A5] font-['Agrandir']">2D DATAMATRIX / OCR</span>
                                    <span id="sim3-ocr-conf" class="text-xs font-mono font-bold text-white">99.8%</span>
                                </div>
                                <div id="sim3-ocr-box" class="p-3.5 rounded-xl bg-black border border-neutral-800 font-mono text-xs text-white space-y-1.5 transition-all">
                                    <div>BATCH : <span class="text-[#3367A5] font-bold">GAT-2611A</span></div>
                                    <div>EXP   : 11 / 2028</div>
                                    <div>S/N   : 8992014402</div>
                                </div>
                                <div id="sim3-seal-msg" class="text-xs text-gray-400 font-mono">FOIL SEAL: ZERO PINHOLE // VERIFIED</div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wider text-white font-['Agrandir'] mb-3"
                                data-lang-en="Select Pharma Test Scenario"
                                data-lang-id="Pilih Skenario Uji Farmasi">Select Pharma Test Scenario</h3>
                            <div class="grid grid-cols-1 gap-3">
                                <button type="button" onclick="setPharmaScenario('good')" id="sim3-btn-good"
                                    class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all text-left"
                                    data-lang-en="1. Good Blister Pack (10/10 Tablets + Grade-A OCR)"
                                    data-lang-id="1. Blister Normal (10/10 Tablet + OCR Grade-A)">1. Good Blister Pack (10/10 Tablets + Grade-A OCR)</button>
                                <button type="button" onclick="setPharmaScenario('missing')" id="sim3-btn-missing"
                                    class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all text-left"
                                    data-lang-en="2. Simulate Missing Tablet in Blister Matrix"
                                    data-lang-id="2. Simulasi Tablet Kosong pada Matriks Blister">2. Simulate Missing Tablet in Blister Matrix</button>
                                <button type="button" onclick="setPharmaScenario('ocr')" id="sim3-btn-ocr"
                                    class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all text-left"
                                    data-lang-en="3. Simulate Blurred TIJ Inkjet Batch / Expiry Code"
                                    data-lang-id="3. Simulasi Kode Batch / Kedaluwarsa TIJ Buram">3. Simulate Blurred TIJ Inkjet Batch / Expiry Code</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-3 text-center">
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim3-stat-cav" class="text-xl font-bold font-['Agrandir'] text-[#3367A5]">10 / 10</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="Tablet Matrix" data-lang-id="Matriks Tablet">Tablet Matrix</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim3-stat-ocr" class="text-xl font-bold font-['Agrandir'] text-neutral-900">GRADE A</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="ISO 15415 OCR" data-lang-id="Mutu OCR">ISO 15415 OCR</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#3367A5] text-white">
                                <div id="sim3-stat-audit" class="text-xl font-bold font-['Agrandir']">LOG #4892</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100 mt-1" data-lang-en="21 CFR Part 11" data-lang-id="Audit GMP">21 CFR Part 11</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 4: SMART BMS & UTILITIES (EIS, ENPI & COS PHI)          -->
            <!-- ================================================================= -->
            <div id="sim-pane-bms" class="sim-pane {{ $currentDomain === 'bms' ? '' : 'hidden' }} pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-neutral-800">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                    data-lang-en="PROJECT SIMULATOR 04 // SMART BMS &amp; UTILITIES"
                                    data-lang-id="SIMULATOR PROYEK 04 // SMART BMS &amp; UTILITAS">PROJECT SIMULATOR 04 // SMART BMS &amp; UTILITIES</span>
                                <h2 class="text-xl sm:text-2xl font-bold text-white font-['Agrandir'] mt-0.5"
                                    data-lang-en="EIS Energy Information, EnPI Calculator &amp; Cos &phi; Dashboard"
                                    data-lang-id="Sistem Informasi Energi (EIS), Kalkulator EnPI &amp; Cos &phi;">
                                    EIS Energy Information, EnPI Calculator &amp; Cos &phi; Dashboard
                                </h2>
                            </div>
                            <span id="sim4-mode-badge" class="px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white">GAT VFD OPTIMIZED</span>
                        </div>

                        <div class="bg-black rounded-2xl p-6 border border-neutral-800 space-y-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400 font-mono">SUB-METER LOAD DISTRIBUTION (kW / kVar)</span>
                                <span id="sim4-enpi-tag" class="font-bold text-[#3367A5] font-['Agrandir']">-18.0% kWh SAVED</span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="w-28 text-gray-300 font-mono">CHILLER #01</span>
                                    <div class="flex-1 h-4 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ch1" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 62%"></div>
                                    </div>
                                    <span id="sim4-val-ch1" class="w-16 text-right font-mono text-white">148 kW</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="w-28 text-gray-300 font-mono">CHILLER #02</span>
                                    <div class="flex-1 h-4 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ch2" class="h-full bg-[#3367A5] rounded-full transition-all duration-300" style="width: 55%"></div>
                                    </div>
                                    <span id="sim4-val-ch2" class="w-16 text-right font-mono text-white">132 kW</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="w-28 text-gray-300 font-mono">AHU &amp; PUMPS</span>
                                    <div class="flex-1 h-4 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-ahu" class="h-full bg-white rounded-full transition-all duration-300" style="width: 42%"></div>
                                    </div>
                                    <span id="sim4-val-ahu" class="w-16 text-right font-mono text-white">56 kW</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="w-28 text-gray-300 font-mono">REACTIVE LOAD</span>
                                    <div class="flex-1 h-4 bg-neutral-900 rounded-full overflow-hidden">
                                        <div id="sim4-bar-kvar" class="h-full bg-white rounded-full transition-all duration-300" style="width: 24%"></div>
                                    </div>
                                    <span id="sim4-val-kvar" class="w-16 text-right font-mono text-[#3367A5]">68 kVar</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400" data-lang-en="Building Cooling &amp; Utility Demand" data-lang-id="Beban Pendinginan &amp; Utilitas Gedung">Building Cooling &amp; Utility Demand</span>
                                <span class="font-bold text-white font-['Agrandir']"><span id="sim4-load-label">80</span>% Load</span>
                            </div>
                            <input type="range" id="sim4-load-slider" min="40" max="100" step="5" value="80"
                                oninput="updateBmsSim()" class="sim-range">
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <button type="button" onclick="setBmsOptimization(true)" id="sim4-btn-opt"
                                class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                data-lang-en="Activate GAT Smart VFD + Capacitor Bank (ON)"
                                data-lang-id="Aktifkan VFD Cerdas GAT + Bank Kapasitor (ON)">Activate GAT Smart VFD + Capacitor Bank (ON)</button>
                            <button type="button" onclick="setBmsOptimization(false)" id="sim4-btn-base"
                                class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                data-lang-en="Switch to Unoptimized Baseline Mode (OFF)"
                                data-lang-id="Mode Standar Tanpa Optimasi VFD (OFF)">Switch to Unoptimized Baseline Mode (OFF)</button>
                        </div>

                        <div class="grid grid-cols-3 gap-3 text-center">
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim4-stat-kw" class="text-xl font-bold font-['Agrandir'] text-neutral-900">336 kW</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="Active Power" data-lang-id="Daya Aktif">Active Power</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim4-stat-cosphi" class="text-xl font-bold font-['Agrandir'] text-[#3367A5]">0.98</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="Cos &phi; Factor" data-lang-id="Faktor Cos &phi;">Cos &phi; Factor</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#3367A5] text-white">
                                <div id="sim4-stat-enpi" class="text-xl font-bold font-['Agrandir']">-18.0%</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100 mt-1" data-lang-en="EnPI Saved" data-lang-id="Hemat EnPI">EnPI Saved</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 5: END-OF-LINE PACKAGING (TIJ & ARCH STRAPPING)         -->
            <!-- ================================================================= -->
            <div id="sim-pane-logistics" class="sim-pane {{ $currentDomain === 'logistics' ? '' : 'hidden' }} pt-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-neutral-800">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']"
                                    data-lang-en="PROJECT SIMULATOR 05 // END-OF-LINE PACKAGING"
                                    data-lang-id="SIMULATOR PROYEK 05 // PENGEMASAN AKHIR LINI">PROJECT SIMULATOR 05 // END-OF-LINE PACKAGING</span>
                                <h2 class="text-xl sm:text-2xl font-bold text-white font-['Agrandir'] mt-0.5"
                                    data-lang-en="TIJ 300 DPI Coding &amp; 3,500N Automatic Arch Strapping"
                                    data-lang-id="Coding TIJ 300 DPI &amp; Pengikatan Busur Otomatis 3.500N">
                                    TIJ 300 DPI Coding &amp; 3,500N Automatic Arch Strapping
                                </h2>
                            </div>
                            <button type="button" onclick="triggerStrapCycle()"
                                class="sim-btn px-4 py-2 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white hover:bg-[#285284] transition-all"
                                data-lang-en="Strap Next Carton" data-lang-id="Ikat Karton Berikutnya">Strap Next Carton</button>
                        </div>

                        <div class="bg-black rounded-2xl p-5 border border-neutral-800 space-y-3">
                            <div class="flex items-center justify-between text-xs font-mono text-gray-400">
                                <span>STAGE: PHOTO-SENSOR + TIJ 300 DPI + ARCH WELD</span>
                                <span id="sim5-weld-badge" class="px-3 py-1 rounded-full text-xs font-bold bg-[#3367A5] text-white">0.2s WELD OK</span>
                            </div>

                            <svg viewBox="0 0 500 155" class="w-full h-48 sm:h-56 select-none">
                                <path d="M295,12 L415,12 L415,128 L295,128 Z" fill="none" stroke="#3367A5" stroke-width="3" rx="6" />
                                <rect x="285" y="6" width="140" height="14" rx="3" fill="#262626" stroke="#3367A5" stroke-width="1.5" />
                                <text x="355" y="16" text-anchor="middle" fill="#ffffff" font-size="8" font-family="monospace">ARCH STRAPPER 3500N</text>

                                <rect x="115" y="18" width="66" height="22" rx="4" fill="#262626" stroke="#ffffff" stroke-width="1.5" />
                                <text x="148" y="32" text-anchor="middle" fill="#ffffff" font-size="8" font-family="monospace">TIJ 300DPI</text>
                                <line x1="148" y1="40" x2="148" y2="58" stroke="#3367A5" stroke-width="2" stroke-dasharray="3 2" />

                                <g id="sim5-carton-box" transform="translate(308, 48)">
                                    <rect x="0" y="0" width="94" height="76" rx="4" fill="#171717" stroke="#ffffff" stroke-width="2" />
                                    <rect x="12" y="14" width="46" height="22" rx="2" fill="#ffffff" />
                                    <line x1="16" y1="18" x2="16" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="21" y1="18" x2="21" y2="32" stroke="#000000" stroke-width="1" />
                                    <line x1="25" y1="18" x2="25" y2="32" stroke="#000000" stroke-width="2.5" />
                                    <line x1="30" y1="18" x2="30" y2="32" stroke="#000000" stroke-width="1.5" />
                                    <line x1="35" y1="18" x2="35" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="41" y1="18" x2="41" y2="32" stroke="#000000" stroke-width="1" />
                                    <line x1="46" y1="18" x2="46" y2="32" stroke="#000000" stroke-width="2" />
                                    <line x1="51" y1="18" x2="51" y2="32" stroke="#000000" stroke-width="1.5" />
                                    <line id="sim5-strap-1" x1="28" y1="-2" x2="28" y2="78" stroke="#3367A5" stroke-width="4" />
                                    <line id="sim5-strap-2" x1="68" y1="-2" x2="68" y2="78" stroke="#3367A5" stroke-width="4" />
                                </g>

                                <g opacity="0.65" transform="translate(110, 58)">
                                    <rect x="0" y="0" width="76" height="66" rx="4" fill="#171717" stroke="#525252" stroke-width="1.5" />
                                    <rect x="10" y="12" width="38" height="16" rx="2" fill="#ffffff" />
                                </g>

                                <line x1="15" y1="128" x2="485" y2="128" stroke="#404040" stroke-width="4" />
                                <line x1="15" y1="128" x2="485" y2="128" stroke="#3367A5" stroke-width="3" stroke-dasharray="12 12" class="animate-conveyor" />
                            </svg>
                        </div>
                    </div>

                    <div class="lg:col-span-5 rounded-3xl bg-neutral-900 border border-neutral-800 p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" onclick="setStrapPattern(2)" id="sim5-btn-double"
                                class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all"
                                data-lang-en="Double Parallel Strap (2x)" data-lang-id="Ikatan Ganda Paralel (2x)">Double Parallel Strap (2x)</button>
                            <button type="button" onclick="setStrapPattern(1)" id="sim5-btn-single"
                                class="sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all"
                                data-lang-en="Single Center Strap (1x)" data-lang-id="Ikatan Tunggal Tengah (1x)">Single Center Strap (1x)</button>
                        </div>

                        <div class="p-4 rounded-2xl bg-neutral-950 border border-neutral-800 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400" data-lang-en="PET / PP Arch Tension Force" data-lang-id="Kekuatan Tarik Tali PET / PP">PET / PP Arch Tension Force</span>
                                <span class="font-bold text-white font-['Agrandir']"><span id="sim5-tension-label">2,800</span> N</span>
                            </div>
                            <input type="range" id="sim5-tension-slider" min="800" max="3500" step="100" value="2800"
                                oninput="updateStrapTension(this.value)" class="sim-range">
                        </div>

                        <div class="grid grid-cols-3 gap-3 text-center">
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim5-cnt-cartons" class="text-xl font-bold font-['Agrandir'] text-neutral-900">842</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="Cartons Packed" data-lang-id="Karton Terkemas">Cartons Packed</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white text-neutral-900">
                                <div id="sim5-cnt-straps" class="text-xl font-bold font-['Agrandir'] text-[#3367A5]">1,684</div>
                                <div class="text-[10px] font-bold uppercase text-neutral-500 mt-1" data-lang-en="Straps Welded" data-lang-id="Total Ikatan">Straps Welded</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#3367A5] text-white">
                                <div id="sim5-cnt-tension" class="text-xl font-bold font-['Agrandir']">2,800 N</div>
                                <div class="text-[10px] font-bold uppercase text-blue-100 mt-1" data-lang-en="Applied Tension" data-lang-id="Tensi Aktif">Applied Tension</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <script>
        function switchSimulator(domainId) {
            document.querySelectorAll('.domain-tab-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-[#3367A5]', 'text-white');
                btn.classList.add('bg-white', 'text-neutral-900', 'hover:bg-neutral-200');
            });
            const activeBtn = document.getElementById('btn-' + domainId);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-neutral-900', 'hover:bg-neutral-200');
                activeBtn.classList.add('active', 'bg-[#3367A5]', 'text-white');
            }

            document.querySelectorAll('.sim-pane').forEach(pane => {
                pane.classList.add('hidden');
            });
            const targetPane = document.getElementById('sim-pane-' + domainId);
            if (targetPane) {
                targetPane.classList.remove('hidden');
            }

            if (domainId === 'manufacturing') {
                setTimeout(resizeBottleCanvas, 60);
            }

            if (window.history && window.history.replaceState) {
                window.history.replaceState({}, '', '/simulator/' + domainId);
            }
        }

        /* ========================================================================= */
        /* SIMULATOR 1: INSPECTION BOTTLE SIMULATOR ENGINE (SMARTEK-STYLE REPLICA)   */
        /* ========================================================================= */
        const bottleSim = {
            running: false, // Idle/stopped initially until user clicks Start
            animId: null,
            lastTimestamp: 0,
            bottles: [], // Empty initially - no bottles on conveyor until started
            spawnTimer: 0,
            lastDelay: 0,
            delays: [],
            avgDelay: 0
        };

        function getBottleSimParams() {
            const cv1_speed = parseFloat(document.getElementById('cv1-speed')?.value) || 433;
            const cv1_cpm = parseFloat(document.getElementById('cv1-cpm')?.value) || 600;
            const cv1_len = parseFloat(document.getElementById('cv1-length')?.value) || 3000;

            const cv2_speed = parseFloat(document.getElementById('cv2-speed')?.value) || 500;
            const cv2_len = parseFloat(document.getElementById('cv2-length')?.value) || 1000;

            const cv3_speed = parseFloat(document.getElementById('cv3-speed')?.value) || 500;
            const cv3_len = parseFloat(document.getElementById('cv3-length')?.value) || 2000;

            const cam_pos = parseFloat(document.getElementById('cam-pos')?.value) || 130;
            const cam_len = parseFloat(document.getElementById('cam-len')?.value) || 300;
            const cam_offset = parseFloat(document.getElementById('cam-offset')?.value) || 35;
            const cam_speed = parseFloat(document.getElementById('cam-speed')?.value) || 1000;

            const gate_pos = parseFloat(document.getElementById('gate-pos')?.value) || 10;
            const gate_len = parseFloat(document.getElementById('gate-len')?.value) || 80;
            const gate_offset = parseFloat(document.getElementById('gate-offset')?.value) || 50;

            const bps = cv1_cpm > 0 ? (cv1_cpm / 60) : 10;
            const cv1_spacing = bps > 0 ? (cv1_speed / bps) : 43.3;
            const cv2_spacing = bps > 0 ? (cv2_speed / bps) : 50.0;
            const cv3_spacing = bps > 0 ? (cv3_speed / bps) : 50.0;
            const cv2_time = cv2_speed > 0 ? (cv2_spacing / cv2_speed) : 0.10;
            const cam_time = cam_speed > 0 ? (cam_len / cam_speed) : 0.30;

            return {
                cv1_speed, cv1_cpm, cv1_len, cv1_spacing,
                cv2_speed, cv2_len, cv2_spacing, cv2_time,
                cv3_speed, cv3_len, cv3_spacing,
                cam_pos, cam_len, cam_offset, cam_speed, cam_time,
                gate_pos, gate_len, gate_offset,
                total_len: cv1_len + cv2_len + cv3_len
            };
        }

        function updateBottleParamDisplays() {
            const p = getBottleSimParams();
            const el1 = document.getElementById('cv1-spacing-text');
            const el2 = document.getElementById('cv2-spacing-text');
            const el3 = document.getElementById('cv2-time-text');
            const el4 = document.getElementById('cv3-spacing-text');
            const el5 = document.getElementById('cam-time-text');

            if (el1) el1.textContent = p.cv1_spacing.toFixed(1);
            if (el2) el2.textContent = p.cv2_spacing.toFixed(1);
            if (el3) el3.textContent = p.cv2_time.toFixed(2);
            if (el4) el4.textContent = p.cv3_spacing.toFixed(1);
            if (el5) el5.textContent = p.cam_time.toFixed(2);
        }

        function resizeBottleCanvas() {
            const canvas = document.getElementById('bottleSimCanvas');
            if (!canvas) return;
            const rect = canvas.getBoundingClientRect();
            const dpr = window.devicePixelRatio || 1;
            canvas.width = Math.max(600, rect.width) * dpr;
            canvas.height = 360 * dpr;
        }

        function renderBottleSim(timestamp) {
            if (!bottleSim.lastTimestamp) bottleSim.lastTimestamp = timestamp;
            const dt = Math.min(0.06, (timestamp - bottleSim.lastTimestamp) / 1000);
            bottleSim.lastTimestamp = timestamp;

            const canvas = document.getElementById('bottleSimCanvas');
            if (canvas && canvas.offsetParent !== null) { // visible in DOM
                const ctx = canvas.getContext('2d');
                const dpr = window.devicePixelRatio || 1;
                const p = getBottleSimParams();

                // Logical canvas dimensions
                const w = canvas.width / dpr;
                const h = canvas.height / dpr;
                const padX = 25;
                const drawW = w - (2 * padX);
                const baselineY = h * 0.73;

                function mmToPx(mm) {
                    return padX + (mm / p.total_len) * drawW;
                }

                const gateStartMm = p.cv1_len + p.gate_pos;
                const gateEndMm = gateStartMm + p.gate_len;
                const camStartMm = p.cv1_len + p.cam_pos;
                const camEndMm = camStartMm + p.cam_len;

                // --- PHYSICS UPDATE (ONLY WHEN RUNNING) ---
                if (bottleSim.running && dt > 0) {
                    // 1. Spawning bottles at CV1 entrance based on CPM
                    const ratePerSec = p.cv1_cpm > 0 ? (p.cv1_cpm / 60) : 2.17;
                    const spawnInterval = 1 / ratePerSec;
                    bottleSim.spawnTimer += dt;

                    const minGapMm = 28; // Minimum physical spacing between bottle centers

                    if (bottleSim.spawnTimer >= spawnInterval) {
                        const firstBottle = bottleSim.bottles[0];
                        // Only spawn if entrance at pos 0 is clear
                        if (!firstBottle || firstBottle.pos >= Math.max(minGapMm, p.cv1_spacing * 0.85)) {
                            bottleSim.bottles.unshift({
                                pos: 0,
                                passedGate: false,
                                inDelay: false,
                                delayTimer: 0,
                                inCam: false
                            });
                            bottleSim.spawnTimer = 0;
                        }
                    }

                    // 2. Check if Camera Zone or approach is occupied
                    // In machine vision logic: Delay Zone holds next bottle while camera is inspecting
                    const isCameraOccupied = bottleSim.bottles.some(b => b.passedGate && b.pos >= camStartMm && b.pos <= camEndMm);
                    const isBetweenGateAndCam = bottleSim.bottles.some(b => b.passedGate && b.pos >= gateStartMm && b.pos < camStartMm);
                    const canReleaseFromGate = !isCameraOccupied && !isBetweenGateAndCam;

                    // 3. Move existing bottles (from rightmost to leftmost)
                    let prevPosAhead = Infinity;
                    let hasReleasedOne = false;

                    for (let i = bottleSim.bottles.length - 1; i >= 0; i--) {
                        const b = bottleSim.bottles[i];
                        b.inCam = false;

                        if (b.passedGate) {
                            b.inDelay = false;
                            // Bottle is past the gate: CV2 -> Camera Zone -> CV3
                            if (b.pos >= camStartMm && b.pos <= camEndMm) {
                                // Under optical inspection in Camera Zone
                                b.inCam = true;
                                b.pos += p.cam_speed * dt;
                            } else if (b.pos < p.cv1_len + p.cv2_len) {
                                // Moving along CV2
                                b.pos += p.cv2_speed * dt;
                            } else {
                                // Moving along CV3
                                b.pos += p.cv3_speed * dt;
                            }
                        } else {
                            // Bottle is approaching or at Delay Zone gate
                            if (b.pos >= gateStartMm - 2) {
                                if (canReleaseFromGate && !hasReleasedOne) {
                                    // Release this single bottle into Camera Zone!
                                    b.passedGate = true;
                                    b.inDelay = false;
                                    hasReleasedOne = true;

                                    if (b.delayTimer > 0) {
                                        bottleSim.lastDelay = b.delayTimer;
                                        bottleSim.delays.push(b.delayTimer);
                                        if (bottleSim.delays.length > 20) bottleSim.delays.shift();
                                        bottleSim.avgDelay = bottleSim.delays.reduce((acc, v) => acc + v, 0) / bottleSim.delays.length;
                                    }
                                    b.pos = Math.max(gateStartMm + 2, b.pos + p.cv2_speed * dt);
                                } else {
                                    // Gate holds bottle while preceding item is in Camera Zone
                                    b.inDelay = true;
                                    b.delayTimer += dt;
                                    b.pos = gateStartMm;
                                }
                            } else {
                                // Moving along CV1 towards gate
                                b.inDelay = false;
                                const maxAllowable = Math.min(gateStartMm, prevPosAhead - minGapMm);
                                b.pos = Math.min(b.pos + (p.cv1_speed * dt), maxAllowable);
                            }
                        }

                        prevPosAhead = b.pos;
                    }

                    // Remove bottles that exited off the right
                    bottleSim.bottles = bottleSim.bottles.filter(b => b.pos <= p.total_len + 50);
                }

                // --- CANVAS DRAWING ---
                ctx.save();
                ctx.scale(dpr, dpr);
                ctx.clearRect(0, 0, w, h);

                // Pure white background
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, w, h);

                // 1. Boundary Vertical Dashed Red Lines
                const x_bound_1 = mmToPx(p.cv1_len);
                const x_bound_2 = mmToPx(p.cv1_len + p.cv2_len);

                ctx.setLineDash([5, 5]);
                ctx.strokeStyle = '#ef4444';
                ctx.lineWidth = 1.4;

                ctx.beginPath();
                ctx.moveTo(x_bound_1, 15);
                ctx.lineTo(x_bound_1, h - 15);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(x_bound_2, 15);
                ctx.lineTo(x_bound_2, h - 15);
                ctx.stroke();

                ctx.setLineDash([]); // Reset line dash

                // 2. Delay Zone (Gate) Bracket - Green
                const gatePxX = mmToPx(gateStartMm);
                const gatePxW = Math.max(10, mmToPx(gateEndMm) - gatePxX);
                const gateH = Math.max(35, p.gate_offset || 50);
                const gateBelow = 8; // Bracket clamps slightly across baseline like reference
                const gateRightX = gatePxX + gatePxW;

                ctx.fillStyle = 'rgba(16, 185, 129, 0.22)';
                ctx.strokeStyle = '#10b981';
                ctx.lineWidth = 2;
                ctx.fillRect(gatePxX, baselineY - (gateH - gateBelow), gatePxW, gateH);
                ctx.strokeRect(gatePxX, baselineY - (gateH - gateBelow), gatePxW, gateH);

                // Delay Zone text centered above green gate, placed higher to prevent clashing (matching video)
                ctx.fillStyle = '#10b981';
                ctx.font = 'bold 9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(`Delay Zone: ${(p.gate_len / 1000).toFixed(2)} m`, gatePxX + (gatePxW / 2), baselineY - gateH - 18);

                // 3. Camera Zone Bracket - Amber / Orange
                const camPxX = mmToPx(camStartMm);
                const camPxW = Math.max(16, mmToPx(camEndMm) - camPxX);
                const camH = Math.max(32, p.cam_offset || 35);

                ctx.fillStyle = 'rgba(245, 158, 11, 0.16)';
                ctx.strokeStyle = '#f59e0b';
                ctx.lineWidth = 2;
                ctx.fillRect(camPxX, baselineY - camH, camPxW, camH);
                ctx.strokeRect(camPxX, baselineY - camH, camPxW, camH);

                // Camera Zone text centered directly above orange camera box (matching video)
                ctx.fillStyle = '#d97706';
                ctx.font = 'bold 9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(`Camera Zone: ${(p.cam_len / 1000).toFixed(2)} m`, camPxX + (camPxW / 2), baselineY - camH - 6);

                // Camera Zone Sub-labels below line
                ctx.fillStyle = '#d97706';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(`Speed: ${p.cam_speed} mm/s`, camPxX + (camPxW / 2), baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv2_spacing.toFixed(1)} mm`, camPxX + (camPxW / 2), baselineY + 31);

                // 4. Main Conveyor Belt Baseline
                ctx.beginPath();
                ctx.moveTo(padX, baselineY);
                ctx.lineTo(padX + drawW, baselineY);
                ctx.strokeStyle = '#1e293b';
                ctx.lineWidth = 2;
                ctx.stroke();

                // 5. Annotations
                // CV1 Labels
                const cv1MidX = mmToPx(p.cv1_len * 0.5);
                ctx.textAlign = 'center';
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV1: ${(p.cv1_len / 1000).toFixed(2)} m`, cv1MidX, baselineY - 14);

                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv1_speed} mm/s`, cv1MidX, baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv1_spacing.toFixed(1)} mm`, cv1MidX, baselineY + 31);

                // CV2 Labels (stacked high above camera & gate matching Image 2 reference)
                const cv2MidX = mmToPx(p.cv1_len + (p.cv2_len * 0.5));
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV2: ${(p.cv2_len / 1000).toFixed(2)} m`, cv2MidX, baselineY - 110);
                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv2_speed} mm/s`, cv2MidX, baselineY - 96);
                ctx.fillText(`Spacing: ${p.cv2_spacing.toFixed(1)} mm`, cv2MidX, baselineY - 82);

                // CV3 Labels
                const cv3MidX = mmToPx(p.cv1_len + p.cv2_len + (p.cv3_len * 0.5));
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV3: ${(p.cv3_len / 1000).toFixed(2)} m`, cv3MidX, baselineY - 14);

                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv3_speed} mm/s`, cv3MidX, baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv3_spacing.toFixed(1)} mm`, cv3MidX, baselineY + 31);

                // 6. Draw Moving Blue Circular Bottles
                let inCamCount = 0;
                let inDelayCount = 0;
                const bottleRadius = 5.5;

                bottleSim.bottles.forEach(b => {
                    const bx = mmToPx(b.pos);
                    const by = baselineY - bottleRadius;

                    if (b.inCam) inCamCount++;
                    if (b.inDelay) inDelayCount++;

                    ctx.beginPath();
                    ctx.arc(bx, by, bottleRadius, 0, Math.PI * 2);
                    ctx.fillStyle = '#38bdf8'; // vibrant sky blue circle
                    ctx.strokeStyle = '#0284c7'; // dark blue border
                    ctx.lineWidth = 1.3;
                    ctx.fill();
                    ctx.stroke();

                    // Subtle optical inspection highlight when inside camera zone
                    if (b.inCam) {
                        ctx.beginPath();
                        ctx.arc(bx, by, bottleRadius + 2.5, 0, Math.PI * 2);
                        ctx.strokeStyle = 'rgba(245, 158, 11, 0.8)';
                        ctx.lineWidth = 1.5;
                        ctx.stroke();
                    }
                });

                // 7. Update Live UI Counters in Parameter Cards
                const camBottlesEl = document.getElementById('cam-bottles-text');
                const gateBottlesEl = document.getElementById('gate-bottles-text');
                const lastDelayEl = document.getElementById('gate-last-delay-text');
                const avgDelayEl = document.getElementById('gate-avg-delay-text');

                if (camBottlesEl) camBottlesEl.textContent = inCamCount;
                if (gateBottlesEl) gateBottlesEl.textContent = inDelayCount;
                if (lastDelayEl) lastDelayEl.textContent = bottleSim.lastDelay > 0 ? bottleSim.lastDelay.toFixed(2) + ' s' : '0.00 s';
                if (avgDelayEl) avgDelayEl.textContent = bottleSim.avgDelay > 0 ? bottleSim.avgDelay.toFixed(2) + ' s' : '0.00 s';

                ctx.restore();
            }

            bottleSim.animId = requestAnimationFrame(renderBottleSim);
        }

        function startBottleSim() {
            bottleSim.running = true;
            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'RUNNING';
                statusPill.className = 'px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200';
            }
        }

        function stopBottleSim() {
            bottleSim.running = false;
            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'STOPPED';
                statusPill.className = 'px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300';
            }
        }

        function resetBottleSim() {
            bottleSim.running = false;
            bottleSim.bottles = [];
            bottleSim.lastDelay = 0;
            bottleSim.delays = [];
            bottleSim.avgDelay = 0;
            bottleSim.spawnTimer = 0;

            const camBottlesEl = document.getElementById('cam-bottles-text');
            const gateBottlesEl = document.getElementById('gate-bottles-text');
            const lastDelayEl = document.getElementById('gate-last-delay-text');
            const avgDelayEl = document.getElementById('gate-avg-delay-text');

            if (camBottlesEl) camBottlesEl.textContent = '0';
            if (gateBottlesEl) gateBottlesEl.textContent = '0';
            if (lastDelayEl) lastDelayEl.textContent = '0.00 s';
            if (avgDelayEl) avgDelayEl.textContent = '0.00 s';

            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'STOPPED';
                statusPill.className = 'px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300';
            }
            updateBottleParamDisplays();
        }

        // Attach dynamic input listeners to recalculate spacing & time in real-time
        document.addEventListener('DOMContentLoaded', () => {
            const inputIds = [
                'cv1-speed', 'cv1-cpm', 'cv1-length',
                'cv2-speed', 'cv2-length',
                'cv3-speed', 'cv3-length',
                'cam-pos', 'cam-len', 'cam-offset', 'cam-speed',
                'gate-pos', 'gate-len', 'gate-offset'
            ];

            inputIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', () => {
                        updateBottleParamDisplays();
                    });
                }
            });

            resizeBottleCanvas();
            resetBottleSim(); // Empty state on initial load matching user reference
            updateBottleParamDisplays();
            window.addEventListener('resize', resizeBottleCanvas);
            bottleSim.animId = requestAnimationFrame(renderBottleSim);
        });

        /* Simulator 2: Automotive Gear & OEE */
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
                    devVal.className = "text-lg font-bold text-[#3367A5] font-['Agrandir'] mt-1";
                }
                if (pill) {
                    pill.textContent = 'PASS // ±0.001mm';
                    pill.className = 'px-3 py-1 rounded-full text-xs font-bold bg-[#3367A5] text-white';
                }
                if (note) note.textContent = 'TELECENTRIC LASER: CONCENTRICITY OK';
                if (ring) ring.setAttribute('stroke', '#3367A5');
            } else {
                if (dimVal) dimVal.textContent = '84.009 mm';
                if (devVal) {
                    devVal.textContent = '+0.009 mm';
                    devVal.className = "text-lg font-bold text-white font-['Agrandir'] mt-1";
                }
                if (pill) {
                    pill.textContent = 'REJECT // OUT OF SPEC';
                    pill.className = 'px-3 py-1 rounded-full text-xs font-bold bg-white text-black';
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

            document.getElementById('sim2-a-label').textContent = a + '%';
            document.getElementById('sim2-p-label').textContent = p + '%';
            document.getElementById('sim2-q-label').textContent = q + '%';
            document.getElementById('sim2-bar-a').style.width = a + '%';
            document.getElementById('sim2-bar-p').style.width = p + '%';
            document.getElementById('sim2-bar-q').style.width = q + '%';
            document.getElementById('sim2-bar-oee').style.width = oee + '%';
            document.getElementById('sim2-oee-score').textContent = oee + '%';
        }

        /* Simulator 3: Pharma Blister Matrix */
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
                        pill.className = 'w-7 h-7 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.6)] block transition-all';
                        cav.className = 'sim-btn h-14 rounded-xl bg-neutral-950 flex items-center justify-center transition-all hover:scale-105';
                    } else {
                        pill.className = 'w-5 h-5 rounded-full border-2 border-dashed border-neutral-500 bg-transparent block transition-all';
                        cav.className = 'sim-btn h-14 rounded-xl bg-neutral-800 flex items-center justify-center transition-all hover:scale-105';
                    }
                }
            });

            sim3State.auditLog += 1;
            document.getElementById('sim3-cavity-label').textContent = okCount + ' / 10 OK';
            document.getElementById('sim3-stat-cav').textContent = okCount + ' / 10';
            document.getElementById('sim3-stat-audit').textContent = 'LOG #' + sim3State.auditLog;

            const ocrConf = document.getElementById('sim3-ocr-conf');
            const ocrBox = document.getElementById('sim3-ocr-box');
            const statOcr = document.getElementById('sim3-stat-ocr');
            const sealMsg = document.getElementById('sim3-seal-msg');
            const badge = document.getElementById('sim3-overall-badge');

            if (sim3State.ocrOk) {
                ocrConf.textContent = '99.8%';
                ocrBox.style.filter = 'none';
                statOcr.textContent = 'GRADE A';
            } else {
                ocrConf.textContent = '41.2% NG';
                ocrBox.style.filter = 'blur(1.8px)';
                statOcr.textContent = 'OCR FAIL';
            }

            const allPass = (okCount === 10) && sim3State.ocrOk;
            if (allPass) {
                badge.textContent = 'GMP PASS // 10/10';
                badge.className = "px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white";
                sealMsg.textContent = 'FOIL SEAL: ZERO PINHOLE // VERIFIED';
            } else {
                badge.textContent = 'AUTO-REJECT // NG';
                badge.className = "px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-black";
                sealMsg.textContent = okCount < 10 ? 'FAULT: MISSING TABLET IN MATRIX' : 'FAULT: ILLEGIBLE BATCH OCR';
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
                if (b) b.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all text-left";
            });

            if (type === 'good') {
                sim3State.cavities = [true, true, true, true, true, true, true, true, true, true];
                sim3State.ocrOk = true;
                btnGood.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all text-left";
            } else if (type === 'missing') {
                sim3State.cavities = [true, true, false, true, true, true, true, false, true, true];
                sim3State.ocrOk = true;
                btnMissing.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all text-left";
            } else if (type === 'ocr') {
                sim3State.cavities = [true, true, true, true, true, true, true, true, true, true];
                sim3State.ocrOk = false;
                btnOcr.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all text-left";
            }
            renderPharmaSim();
        }

        /* Simulator 4: Smart BMS */
        const sim4State = { optimized: true, load: 80 };

        function updateBmsSim() {
            const slider = document.getElementById('sim4-load-slider');
            sim4State.load = parseInt(slider?.value || 80, 10);
            document.getElementById('sim4-load-label').textContent = sim4State.load;

            const factor = sim4State.load / 80;
            const effMultiplier = sim4State.optimized ? 0.82 : 1.0;

            const ch1 = Math.round(180 * factor * effMultiplier);
            const ch2 = Math.round(160 * factor * effMultiplier);
            const ahu = Math.round(70 * factor * effMultiplier);
            const totalKw = ch1 + ch2 + ahu;
            const kvar = sim4State.optimized ? Math.round(68 * factor) : Math.round(245 * factor);

            document.getElementById('sim4-bar-ch1').style.width = Math.min(100, Math.round((ch1 / 230) * 100)) + '%';
            document.getElementById('sim4-bar-ch2').style.width = Math.min(100, Math.round((ch2 / 230) * 100)) + '%';
            document.getElementById('sim4-bar-ahu').style.width = Math.min(100, Math.round((ahu / 120) * 100)) + '%';
            document.getElementById('sim4-bar-kvar').style.width = Math.min(100, Math.round((kvar / 320) * 100)) + '%';

            document.getElementById('sim4-val-ch1').textContent = ch1 + ' kW';
            document.getElementById('sim4-val-ch2').textContent = ch2 + ' kW';
            document.getElementById('sim4-val-ahu').textContent = ahu + ' kW';
            document.getElementById('sim4-val-kvar').textContent = kvar + ' kVar';

            document.getElementById('sim4-stat-kw').textContent = totalKw + ' kW';
            document.getElementById('sim4-stat-cosphi').textContent = sim4State.optimized ? '0.98' : '0.78';
            document.getElementById('sim4-stat-enpi').textContent = sim4State.optimized ? '-18.0%' : '0.0%';

            const enpiTag = document.getElementById('sim4-enpi-tag');
            const modeBadge = document.getElementById('sim4-mode-badge');
            if (sim4State.optimized) {
                enpiTag.textContent = '-18.0% kWh SAVED';
                modeBadge.textContent = 'GAT VFD OPTIMIZED';
                modeBadge.className = "px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white";
            } else {
                enpiTag.textContent = 'UNOPTIMIZED BASELINE';
                modeBadge.textContent = 'MANUAL BASELINE';
                modeBadge.className = "px-4 py-1.5 rounded-full text-xs font-bold font-['Agrandir'] bg-white text-black";
            }
        }

        function setBmsOptimization(isOpt) {
            sim4State.optimized = isOpt;
            const btnOpt = document.getElementById('sim4-btn-opt');
            const btnBase = document.getElementById('sim4-btn-base');
            if (isOpt) {
                btnOpt.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
                btnBase.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
            } else {
                btnOpt.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
                btnBase.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            }
            updateBmsSim();
        }

        /* Simulator 5: End-of-Line Strapping */
        const sim5State = { strapsPerCarton: 2, tension: 2800, cartons: 842, straps: 1684 };

        function setStrapPattern(count) {
            sim5State.strapsPerCarton = count;
            const strap1 = document.getElementById('sim5-strap-1');
            const strap2 = document.getElementById('sim5-strap-2');
            const btnDouble = document.getElementById('sim5-btn-double');
            const btnSingle = document.getElementById('sim5-btn-single');

            if (count === 2) {
                strap1.setAttribute('x1', '28');
                strap1.setAttribute('x2', '28');
                strap2.setAttribute('opacity', '1');
                btnDouble.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
                btnSingle.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
            } else {
                strap1.setAttribute('x1', '47');
                strap1.setAttribute('x2', '47');
                strap2.setAttribute('opacity', '0');
                btnDouble.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-white text-neutral-900 hover:bg-neutral-200 transition-all";
                btnSingle.className = "sim-btn py-3 px-4 rounded-xl text-xs font-bold font-['Agrandir'] bg-[#3367A5] text-white transition-all";
            }
        }

        function updateStrapTension(val) {
            sim5State.tension = parseInt(val, 10) || 2800;
            const formatted = sim5State.tension.toLocaleString();
            document.getElementById('sim5-tension-label').textContent = formatted;
            document.getElementById('sim5-cnt-tension').textContent = formatted + ' N';
        }

        function triggerStrapCycle() {
            sim5State.cartons += 1;
            sim5State.straps += sim5State.strapsPerCarton;
            document.getElementById('sim5-cnt-cartons').textContent = sim5State.cartons.toLocaleString();
            document.getElementById('sim5-cnt-straps').textContent = sim5State.straps.toLocaleString();

            const badge = document.getElementById('sim5-weld-badge');
            const cartonSvg = document.getElementById('sim5-carton-box');
            badge.textContent = 'WELDING (' + sim5State.tension + 'N)...';
            badge.className = 'px-3 py-1 rounded-full text-xs font-bold bg-white text-black';
            setTimeout(() => {
                badge.textContent = '0.2s WELD OK';
                badge.className = 'px-3 py-1 rounded-full text-xs font-bold bg-[#3367A5] text-white';
            }, 280);

            cartonSvg.setAttribute('transform', 'translate(298, 48)');
            setTimeout(() => {
                cartonSvg.setAttribute('transform', 'translate(308, 48)');
            }, 220);
        }

        document.addEventListener('DOMContentLoaded', function () {
            restartBottleTimer();
        });
    </script>
</body>

</html>

