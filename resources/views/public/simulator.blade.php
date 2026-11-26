<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Interactive System Simulator - PT. Global Aspect Technology</title>
    @include('components.seo-meta', [
        'seoTitle' => 'Interactive Industrial Automation Simulator — PT Global Aspect Technology',
        'seoDescription' => 'Simulate production bottle inspection, OEE machine performance, cleanroom EnPI energy savings, EIS BMS sizing, and Cos Phi power factor telemetry.',
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

    <!-- Chart.js for Industrial OEE Analytics & History -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
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

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-black text-white">
    <!-- Navbar -->
    @include('components.navbar.header')

    @php
        $currentDomain = $activeDomain ?? 'manufacturing';
    @endphp

    <!-- ========================================================================= -->
    <!-- DEDICATED INTERACTIVE PROJECT SIMULATOR WORKBENCH                         -->
    <!-- ========================================================================= -->
    <section class="pt-44 sm:pt-48 pb-20 sm:pb-28 bg-black min-h-screen">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">

            <!-- Back Link & Page Title Header -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 border-b border-neutral-800">
                <div>
                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold font-['Agrandir'] text-white"
                        data-lang-en="PROJECT SYSTEM SIMULATOR" data-lang-id="SIMULATOR SISTEM PROYEK">
                        PROJECT SYSTEM SIMULATOR
                    </h1>
                </div>

                <!-- Right: Back to Applications Button (Direct replacement for domain switcher pills) -->
                <div>
                    <a href="{{ route('application') }}#domain-content-area"
                        class="sim-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-neutral-900 hover:bg-neutral-200 text-xs sm:text-sm font-bold font-['Agrandir'] transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span data-lang-en="Back to Applications" data-lang-id="Kembali ke Halaman Aplikasi">Back to
                            Applications</span>
                    </a>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 1: MANUFACTURING & FMCG (INSPECTION BOTTLE SIMULATOR)   -->
            <!-- ================================================================= -->
            <div id="sim-pane-manufacturing"
                class="sim-pane {{ $currentDomain === 'manufacturing' ? '' : 'hidden' }} pt-8">
                <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-6">

                    <!-- Header / Title matching Image 3 -->
                    <div class="pb-2">
                        <h2 class="text-2xl sm:text-3xl font-normal text-slate-800 tracking-tight"
                            style="font-family: 'Questrial', -apple-system, BlinkMacSystemFont, sans-serif;">
                            Inspection Bottle Simulator
                        </h2>
                    </div>

                    <!-- 6 Parameter Cards Grid matching Image 3 (3 columns x 2 rows) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                        <!-- Card 1: Conveyor 1 -->
                        <div
                            class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 1</h3>

                            <div>
                                <label for="cv1-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed
                                    (mm/s):</label>
                                <input type="number" id="cv1-speed" value="433" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv1-cpm" class="block text-xs text-gray-500 font-medium mb-1">CPM:</label>
                                <input type="number" id="cv1-cpm" value="130" min="10" max="2000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv1-length" class="block text-xs text-gray-500 font-medium mb-1">Length
                                    (mm):</label>
                                <input type="number" id="cv1-length" value="3000" min="500" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 text-xs text-gray-600 font-medium">
                                Spacing: <span id="cv1-spacing-text">199.8</span> mm
                            </div>
                        </div>

                        <!-- Card 2: Conveyor 2 -->
                        <div
                            class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 2</h3>

                            <div>
                                <label for="cv2-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed
                                    (mm/s):</label>
                                <input type="number" id="cv2-speed" value="500" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv2-length" class="block text-xs text-gray-500 font-medium mb-1">Length
                                    (mm):</label>
                                <input type="number" id="cv2-length" value="1000" min="200" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 space-y-1 text-xs text-gray-600 font-medium">
                                <div>Spacing: <span id="cv2-spacing-text">230.8</span> mm</div>
                                <div>Time per bottle: <span id="cv2-time-text">0.46</span> s</div>
                            </div>
                        </div>

                        <!-- Card 3: Conveyor 3 -->
                        <div
                            class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition">
                            <h3 class="text-sm font-bold text-gray-800">Conveyor 3</h3>

                            <div>
                                <label for="cv3-speed" class="block text-xs text-gray-500 font-medium mb-1">Speed
                                    (mm/s):</label>
                                <input type="number" id="cv3-speed" value="500" min="10" max="3000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div>
                                <label for="cv3-length" class="block text-xs text-gray-500 font-medium mb-1">Length
                                    (mm):</label>
                                <input type="number" id="cv3-length" value="2000" min="500" max="10000"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                            </div>

                            <div class="pt-1 text-xs text-gray-600 font-medium">
                                Spacing: <span id="cv3-spacing-text">230.8</span> mm
                            </div>
                        </div>

                        <!-- Card 4: Camera Settings (CV2) -->
                        <div
                            class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm space-y-3.5 hover:shadow-md transition lg:col-span-2">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <h3 class="text-sm font-bold text-gray-800">Camera Settings (CV2)</h3>
                                <div class="flex items-center gap-4 text-xs text-gray-600 font-medium">
                                    <div>Bottles in inspection: <span id="cam-bottles-text"
                                            class="font-bold text-gray-800">0</span></div>
                                    <div>Inspection Time: <span id="cam-time-text">0.11</span> s</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="cam-pos" class="block text-xs text-gray-500 font-medium mb-1">Position
                                        (mm):</label>
                                    <input type="number" id="cam-pos" value="250" min="0" max="5000"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                </div>

                                <div>
                                    <label for="cam-len" class="block text-xs text-gray-500 font-medium mb-1">Inspection
                                        Length (mm):</label>
                                    <input type="number" id="cam-len" value="80" min="10" max="5000"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                </div>

                                <div>
                                    <label for="cam-offset" class="block text-xs text-gray-500 font-medium mb-1">Vertical
                                        Offset (px):</label>
                                    <input type="number" id="cam-offset" value="52" min="0" max="200"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                </div>

                                <div>
                                    <label for="cam-speed" class="block text-xs text-gray-500 font-medium mb-1">Inspection
                                        Speed (mm/s):</label>
                                    <input type="number" id="cam-speed" value="750" min="10" max="5000"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                </div>
                            </div>
                        </div>

                        <!-- Card 5: Control -->
                        <div
                            class="bg-white border border-gray-200/90 rounded-2xl p-5 shadow-sm flex flex-col justify-between hover:shadow-md transition">
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
                            <div
                                class="text-[11px] text-gray-400 mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span>Real-time Multi-Conveyor Physics</span>
                                <span id="bottleSimStatusPill"
                                    class="px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300">STOPPED</span>
                            </div>
                        </div>

                    </div>

                    <!-- Canvas Simulation Container matching Image 3 -->
                    <div
                        class="border border-gray-300 rounded-2xl bg-white p-3 sm:p-5 overflow-hidden relative shadow-sm">
                        <canvas id="bottleSimCanvas" class="w-full block"
                            style="height: 390px; min-height: 350px;"></canvas>
                    </div>

                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 2: AUTOMOTIVE & OEE PRODUCTION SIMULATOR                -->
            <!-- ================================================================= -->
            <div id="sim-pane-automotive" class="sim-pane {{ $currentDomain === 'automotive' ? '' : 'hidden' }} pt-8">
                <div
                    class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-6">

                    <!-- Top Title Bar matching video -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-gray-200 gap-2">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-[#3367A5] flex items-center justify-center text-white shadow-sm shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h2
                                    class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-['Agrandir']">
                                    Simulasi OEE - Manual
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- 3 Column Top Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                        <!-- Column 1: Input Data Produksi -->
                        <div
                            class="lg:col-span-4 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-4 flex flex-col justify-between">
                            <div>
                                <h3
                                    class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 font-['Agrandir']">
                                    Input Data Produksi
                                </h3>

                                <div class="space-y-3.5">
                                    <!-- Shift -->
                                    <div>
                                        <label for="oee-shift"
                                            class="block text-xs text-gray-600 font-medium mb-1">Shift:</label>
                                        <select id="oee-shift"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                            <option value="Pagi">Pagi</option>
                                            <option value="Siang" selected>Siang</option>
                                            <option value="Malam">Malam</option>
                                        </select>
                                    </div>

                                    <!-- Downtime (menit) -->
                                    <div>
                                        <label for="oee-downtime"
                                            class="block text-xs text-gray-600 font-medium mb-1">Downtime
                                            (menit):</label>
                                        <input type="number" id="oee-downtime" value="0" min="0"
                                            step="1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition font-mono">
                                    </div>

                                    <!-- Ideal Cycle Time (menit/unit) -->
                                    <div>
                                        <label for="oee-cycle-time"
                                            class="block text-xs text-gray-600 font-medium mb-1">Ideal Cycle Time
                                            (menit/unit):</label>
                                        <input type="number" id="oee-cycle-time" value="0" min="0"
                                            step="0.1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition font-mono">
                                    </div>

                                    <!-- Good Count -->
                                    <div>
                                        <label for="oee-good"
                                            class="block text-xs text-gray-600 font-medium mb-1">Good Count:</label>
                                        <input type="number" id="oee-good" value="0" min="0"
                                            step="1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition font-mono">
                                    </div>

                                    <!-- Reject Count -->
                                    <div>
                                        <label for="oee-reject"
                                            class="block text-xs text-gray-600 font-medium mb-1">Reject Count:</label>
                                        <input type="number" id="oee-reject" value="0" min="0"
                                            step="1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition font-mono">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="button" id="oee-calc-btn" onclick="calculateOEE()"
                                    class="w-full py-2.5 px-4 bg-[#16a34a] hover:bg-[#15803d] active:scale-[0.98] text-white font-bold rounded-lg transition-all shadow-sm text-sm font-['Agrandir'] flex items-center justify-center gap-2">
                                    <svg id="oee-calc-icon" class="w-4 h-4 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span id="oee-calc-text">Hitung OEE</span>
                                </button>
                            </div>
                        </div>

                        <!-- Column 2: Output -->
                        <div
                            class="lg:col-span-4 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-4 flex flex-col justify-between">
                            <div>
                                <h3
                                    class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 font-['Agrandir']">
                                    Output
                                </h3>

                                <div class="space-y-5">
                                    <!-- Target -->
                                    <div>
                                        <div
                                            class="text-xs text-gray-600 font-medium mb-1 flex items-center justify-between">
                                            <span>Target</span>
                                            <span class="text-[10px] text-gray-400 font-mono">Capacity Plan</span>
                                        </div>
                                        <div
                                            class="relative w-full h-8 bg-gray-100 rounded-md overflow-hidden border border-gray-200 flex items-center">
                                            <div id="oee-target-bar"
                                                class="h-full bg-[#0284c7] transition-all duration-500 ease-out"
                                                style="width: 0%;"></div>
                                            <div id="oee-target-val"
                                                class="absolute right-2 px-2.5 py-0.5 rounded text-xs font-bold bg-[#0284c7] text-white font-mono shadow-sm">
                                                0
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actual -->
                                    <div>
                                        <div
                                            class="text-xs text-gray-600 font-medium mb-1 flex items-center justify-between">
                                            <span>Actual</span>
                                            <span class="text-[10px] text-gray-400 font-mono">Good + Reject</span>
                                        </div>
                                        <div
                                            class="relative w-full h-8 bg-gray-100 rounded-md overflow-hidden border border-gray-200 flex items-center">
                                            <div id="oee-actual-bar"
                                                class="h-full bg-[#22c55e] transition-all duration-500 ease-out"
                                                style="width: 0%;"></div>
                                            <div id="oee-actual-val"
                                                class="absolute right-2 px-2.5 py-0.5 rounded text-xs font-bold bg-[#22c55e] text-white font-mono shadow-sm">
                                                0
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <div id="oee-good-banner"
                                    class="w-full py-3 px-4 bg-[#f97316] text-white font-bold rounded-xl text-center text-sm shadow-sm transition-all font-['Agrandir']">
                                    Good Count: <span id="oee-good-display" class="font-mono">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Hasil Perhitungan -->
                        <div
                            class="relative lg:col-span-4 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm flex flex-col justify-between space-y-4 overflow-hidden">
                            <!-- Result Lock Overlay (Unlocked after Lead Gate Form submitted once per session) -->
                            <div class="sim-lock-overlay absolute inset-0 z-20 bg-white/75 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-[#E6F0FA] text-[#244E81] flex items-center justify-center shadow-xs">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="space-y-1 max-w-[240px]">
                                    <p class="text-sm font-bold text-slate-900 font-['Agrandir',sans-serif]">Hasil Simulasi Terkunci</p>
                                    <p class="text-xs text-slate-500 font-['Questrial',sans-serif] leading-relaxed">
                                        Isi formulir singkat identitas perusahaan terlebih dahulu untuk melihat hasil perhitungan OEE.
                                    </p>
                                </div>
                                <button type="button" onclick="requireSimulationLeadGate(calculateOEE)"
                                    class="px-5 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md transition cursor-pointer active:scale-95">
                                    Isi Formulir &amp; Lihat Hasil
                                </button>
                            </div>
                            <div class="sim-lock-target">
                                <h3
                                    class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3 mb-2 font-['Agrandir']">
                                    Hasil Perhitungan
                                </h3>

                                <div class="text-center py-1">
                                    <div
                                        class="text-xs font-bold text-gray-500 uppercase tracking-widest font-['Agrandir']">
                                        OEE</div>
                                    <div id="oee-overall-val"
                                        class="text-4xl sm:text-5xl font-extrabold text-gray-400 font-['Agrandir'] tracking-tight mt-1 font-mono transition-colors duration-300">
                                        0.0%
                                    </div>
                                </div>

                                <!-- 3 Donut Gauges matching video -->
                                <div class="grid grid-cols-3 gap-1.5 sm:gap-2 py-4">
                                    <!-- Availability -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="relative w-14 h-14 sm:w-18 sm:h-18 flex items-center justify-center">
                                            <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                                                <circle cx="18" cy="18" r="14" fill="none"
                                                    stroke="#f3f4f6" stroke-width="3"></circle>
                                                <circle id="oee-circle-avail" cx="18" cy="18" r="14"
                                                    fill="none" stroke="#f97316" stroke-width="3"
                                                    stroke-dasharray="88 88" stroke-dashoffset="88"
                                                    stroke-linecap="round" class="transition-all duration-700">
                                                </circle>
                                            </svg>
                                            <span id="oee-avail-num"
                                                class="absolute text-xs sm:text-sm font-bold text-gray-400 font-mono">0</span>
                                        </div>
                                        <span
                                            class="text-[11px] text-gray-500 font-medium mt-1 text-center">Availability</span>
                                    </div>

                                    <!-- Performance -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="relative w-14 h-14 sm:w-18 sm:h-18 flex items-center justify-center">
                                            <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                                                <circle cx="18" cy="18" r="14" fill="none"
                                                    stroke="#f3f4f6" stroke-width="3"></circle>
                                                <circle id="oee-circle-perf" cx="18" cy="18" r="14"
                                                    fill="none" stroke="#6366f1" stroke-width="3"
                                                    stroke-dasharray="88 88" stroke-dashoffset="88"
                                                    stroke-linecap="round" class="transition-all duration-700">
                                                </circle>
                                            </svg>
                                            <span id="oee-perf-num"
                                                class="absolute text-xs sm:text-sm font-bold text-gray-400 font-mono">0</span>
                                        </div>
                                        <span
                                            class="text-[11px] text-gray-500 font-medium mt-1 text-center">Performance</span>
                                    </div>

                                    <!-- Quality -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="relative w-14 h-14 sm:w-18 sm:h-18 flex items-center justify-center">
                                            <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                                                <circle cx="18" cy="18" r="14" fill="none"
                                                    stroke="#f3f4f6" stroke-width="3"></circle>
                                                <circle id="oee-circle-qual" cx="18" cy="18" r="14"
                                                    fill="none" stroke="#10b981" stroke-width="3"
                                                    stroke-dasharray="88 88" stroke-dashoffset="88"
                                                    stroke-linecap="round" class="transition-all duration-700">
                                                </circle>
                                            </svg>
                                            <span id="oee-quality-num"
                                                class="absolute text-xs sm:text-sm font-bold text-gray-400 font-mono">0</span>
                                        </div>
                                        <span
                                            class="text-[11px] text-gray-500 font-medium mt-1 text-center">Quality</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="pt-2 border-t border-gray-100 flex items-center justify-between text-[11px] sm:text-xs text-gray-600 font-medium">
                                <div>Downtime: <span id="oee-summary-downtime"
                                        class="font-bold text-gray-900 font-mono">0m</span></div>
                                <div>Gap: <span id="oee-summary-gap"
                                        class="font-bold text-gray-500 font-mono">0.0</span></div>
                                <div>Reject Count: <span id="oee-summary-reject"
                                        class="font-bold text-gray-900 font-mono">0</span></div>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Section: Grafik History -->
                    <div class="bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-7 shadow-sm space-y-6">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <h3 class="text-lg font-bold text-slate-900 font-['Agrandir']">
                                Grafik History
                            </h3>
                            <button type="button" id="oee-switch-chart-btn" onclick="toggleOEEChartMode()"
                                class="px-4 py-2 bg-[#ef4444] hover:bg-[#dc2626] text-white text-xs font-bold rounded-lg transition-colors shadow-sm font-['Agrandir']">
                                Switch to APQ
                            </button>
                        </div>

                        <!-- Chart Container -->
                        <div class="relative w-full h-72 sm:h-80 bg-white rounded-xl">
                            <canvas id="oee-history-chart"></canvas>
                        </div>

                        <!-- Table: History Produksi - Update OEE -->
                        <div class="pt-4 border-t border-gray-100">
                            <h4 class="text-sm font-bold text-slate-800 mb-3 font-['Agrandir']">
                                History Produksi - Update OEE
                            </h4>

                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="w-full text-left text-xs text-gray-700">
                                    <thead class="bg-gray-50 text-gray-800 font-bold border-b border-gray-200">
                                        <tr>
                                            <th class="py-2.5 px-3">Waktu</th>
                                            <th class="py-2.5 px-3">Shift</th>
                                            <th class="py-2.5 px-3 text-right">Good</th>
                                            <th class="py-2.5 px-3 text-right">Reject</th>
                                            <th class="py-2.5 px-3 text-right">Avail</th>
                                            <th class="py-2.5 px-3 text-right">Perf</th>
                                            <th class="py-2.5 px-3 text-right">Quality</th>
                                            <th class="py-2.5 px-3 text-right">OEE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="oee-history-tbody" class="divide-y divide-gray-100 font-mono">
                                        <tr id="oee-empty-row">
                                            <td colspan="8"
                                                class="py-8 text-center text-gray-400 font-sans text-xs">
                                                Belum ada data riwayat produksi. Masukkan parameter di atas lalu klik
                                                "Hitung OEE".
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 3: ENPI ENERGY PERFORMANCE CALCULATOR -->
            <!-- ================================================================= -->
            <div id="sim-pane-pharma" class="sim-pane {{ $currentDomain === 'pharma' ? '' : 'hidden' }} pt-8">
                <div
                    class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-6">

                    <!-- Header -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-gray-200 gap-2">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight font-['Agrandir']">
                                EnPI Kalkulator (Extended + Carbon Credit)
                            </h2>
                        </div>
                    </div>

                    <!-- Top 2-Column Grid: Left Input Data, Right Informasi -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                        <!-- Left Column: Input Data -->
                        <div
                            class="lg:col-span-6 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-3.5 flex flex-col justify-between">
                            <div>
                                <h3 class="text-base font-bold text-gray-900 font-['Agrandir'] mb-2">
                                    Input Data
                                </h3>

                                <div>
                                    <label for="enpi-ext-raw" class="block text-xs font-bold text-gray-800">Produksi
                                        &amp; Energi:</label>
                                    <div class="text-[11px] text-gray-500 mb-1.5">(Format: Tanggal, Energy (kWh),
                                        Produksi (unit))</div>
                                    <textarea id="enpi-ext-raw" rows="7"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition leading-relaxed resize-y">2025-01-01,1200,100
2025-01-02,1100,95
2025-01-03,1300,110
2025-01-04,1250,105
2025-01-05,1190,99
2025-01-06,1175,113
2025-01-07,1210,120
2025-01-08,1150,108
2025-01-09,1240,125
2025-01-10,1220,119</textarea>
                                </div>

                                <div class="pt-2">
                                    <div class="text-xs font-bold text-gray-800 mb-2 font-['Agrandir']">Pengaturan:
                                    </div>

                                    <div class="space-y-2.5">
                                        <div>
                                            <label for="enpi-ext-baseline"
                                                class="block text-xs text-gray-700 font-medium mb-1">Baseline EnPI
                                                (kWh/unit):</label>
                                            <input type="number" id="enpi-ext-baseline" value="11"
                                                step="0.01"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                        </div>

                                        <div>
                                            <label for="enpi-ext-target-prod"
                                                class="block text-xs text-gray-700 font-medium mb-1">Target Produksi
                                                (unit/hari):</label>
                                            <input type="number" id="enpi-ext-target-prod" value="100"
                                                step="1"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                        </div>

                                        <div>
                                            <label for="enpi-ext-emission-factor"
                                                class="block text-xs text-gray-700 font-medium mb-1">Emission Factor
                                                (kg CO<sub>2</sub>/kWh):</label>
                                            <input type="number" id="enpi-ext-emission-factor" value="0.82"
                                                step="0.01"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                        </div>

                                        <div>
                                            <label for="enpi-ext-tariff"
                                                class="block text-xs text-gray-700 font-medium mb-1">Tarif Energi
                                                (Rp/kWh):</label>
                                            <input type="number" id="enpi-ext-tariff" value="1600" step="1"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                        </div>

                                        <div>
                                            <label for="enpi-ext-carbon-price"
                                                class="block text-xs text-gray-700 font-medium mb-1">Harga Carbon
                                                Credit (USD/ton CO<sub>2</sub>):</label>
                                            <input type="number" id="enpi-ext-carbon-price" value="10"
                                                step="0.1"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3367A5] transition">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3">
                                <button type="button" id="enpi-ext-calc-btn" onclick="calculateExtendedEnPI(true)"
                                    class="w-full py-3 px-4 bg-[#0a194f] hover:bg-[#061033] active:scale-[0.99] text-white font-bold rounded-xl transition-all shadow-md text-sm font-['Agrandir'] flex items-center justify-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span id="enpi-ext-calc-text">Hitung EnPI</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Informasi -->
                        <div
                            class="lg:col-span-6 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm flex flex-col justify-between">
                            <div>
                                <h3 class="text-base font-bold text-gray-900 font-['Agrandir'] mb-3">
                                    Informasi
                                </h3>

                                <!-- Tabs Button Bar -->
                                <div class="flex items-center gap-2 border-b border-gray-200 pb-3 mb-4">
                                    <button type="button" id="enpi-tab-btn-ringkasan"
                                        onclick="switchEnPITab('ringkasan')"
                                        class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-[#007bff] text-white shadow-sm font-sans">
                                        Ringkasan
                                    </button>
                                    <button type="button" id="enpi-tab-btn-kesimpulan"
                                        onclick="switchEnPITab('kesimpulan')"
                                        class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-[#c2c5c9] text-white hover:bg-gray-400 font-sans">
                                        Kesimpulan
                                    </button>
                                    <button type="button" id="enpi-tab-btn-help" onclick="switchEnPITab('help')"
                                        class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-[#c2c5c9] text-white hover:bg-gray-400 font-sans">
                                        Help
                                    </button>
                                </div>

                                <!-- Tab 1: Ringkasan -->
                                <div id="enpi-tab-pane-ringkasan">
                                    <!-- Prompt before calculation -->
                                    <div id="enpi-not-calculated-prompt" class="py-12 px-4 text-center space-y-3">
                                        <div
                                            class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 text-[#007bff] flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-sm font-bold text-gray-800 font-['Agrandir']">Hasil Belum
                                            Dihitung</div>
                                        <p class="text-xs text-gray-500 max-w-sm mx-auto leading-relaxed font-sans">
                                            Silakan periksa data produksi &amp; pengaturan di panel kiri, kemudian klik
                                            tombol <strong class="text-gray-900 font-bold">"Hitung EnPI"</strong> untuk
                                            menampilkan ringkasan, evaluasi baseline, dan grafik.
                                        </p>
                                    </div>

                                    <!-- Actual Ringkasan Data (Hidden until calculated) -->
                                    <div id="enpi-ringkasan-data"
                                        class="hidden space-y-1.5 text-xs sm:text-[13px] text-gray-800 leading-relaxed font-sans">
                                        <div>Baseline EnPI: <span id="info-baseline-val"
                                                class="font-bold font-mono">11.00</span> kWh/unit</div>
                                        <div>Target Produksi: <span id="info-target-prod-val"
                                                class="font-bold font-mono">100</span> unit/hari &rarr; Target Energy:
                                            <span id="info-target-energy-val" class="font-bold font-mono">1,100</span>
                                            kWh
                                        </div>
                                        <div>Rata-rata EnPI aktual: <span id="info-avg-enpi-val"
                                                class="font-bold font-mono">11.06</span> kWh/unit</div>
                                        <div class="text-[#dc2626] font-semibold">Peak EnPI: <span id="info-peak-val"
                                                class="font-bold font-mono">12.02</span> kWh/unit (Tanggal: <span
                                                id="info-peak-date-val" class="font-mono">2025-01-05</span>)</div>
                                        <div class="text-[#16a34a] font-semibold">Best EnPI: <span id="info-best-val"
                                                class="font-bold font-mono">9.92</span> kWh/unit (Tanggal: <span
                                                id="info-best-date-val" class="font-mono">2025-01-09</span>)</div>

                                        <hr class="my-2.5 border-gray-200">

                                        <div>Total Energi Aktual: <span id="info-total-actual-val"
                                                class="font-bold font-mono">12,035</span> kWh</div>
                                        <div>Total Energi Baseline: <span id="info-total-baseline-val"
                                                class="font-bold font-mono">12,034</span> kWh</div>
                                        <div>Emisi Aktual: <span id="info-actual-emission-val"
                                                class="font-bold font-mono">9868.7</span> kg CO<sub>2</sub></div>
                                        <div>Emisi Baseline: <span id="info-baseline-emission-val"
                                                class="font-bold font-mono">9867.9</span> kg CO<sub>2</sub></div>
                                        <div>Pengurangan Emisi: <span id="info-emission-reduction-val"
                                                class="font-bold font-mono text-[#dc2626]">-0.8 kg
                                                CO<sub>2</sub></span></div>
                                        <div>Biaya Energi Aktual: <span id="info-actual-cost-val"
                                                class="font-bold font-mono">Rp 19,256,000</span></div>
                                        <div>Biaya Energi Baseline: <span id="info-baseline-cost-val"
                                                class="font-bold font-mono">Rp 19,254,400</span></div>
                                        <div>Hemat Biaya: <span id="info-cost-saving-val"
                                                class="font-bold font-mono text-[#dc2626]">Rp -1,600</span></div>
                                        <div class="font-semibold text-gray-900 pt-1">Potensi Carbon Credit: <span
                                                id="info-carbon-credit-val" class="font-mono">-0.00 ton CO<sub>2</sub>
                                                &times; $10/ton = -$0.01</span></div>
                                    </div>
                                </div>

                                <!-- Tab 2: Kesimpulan -->
                                <div id="enpi-tab-pane-kesimpulan" class="hidden font-sans">
                                    <!-- Prompt before calculation -->
                                    <div id="enpi-kesimpulan-prompt" class="py-12 px-4 text-center space-y-3">
                                        <div class="text-sm font-bold text-gray-800 font-['Agrandir']">Kesimpulan Belum
                                            Tersedia</div>
                                        <p class="text-xs text-gray-500 max-w-sm mx-auto leading-relaxed">
                                            Klik tombol <strong class="text-gray-900 font-bold">"Hitung EnPI"</strong>
                                            terlebih dahulu untuk melihat evaluasi baseline dan rencana tindakan
                                            efisiensi energi.
                                        </p>
                                    </div>

                                    <!-- Actual Kesimpulan Data (Hidden until calculated) -->
                                    <div id="enpi-kesimpulan-data"
                                        class="hidden space-y-3 text-xs sm:text-[13px] text-gray-800 leading-relaxed">
                                        <div id="enpi-kesimpulan-alert1" class="flex items-start gap-2 text-gray-800">
                                            <span class="text-sm select-none shrink-0">&#9888;&#65039;</span>
                                            <span id="enpi-kesimpulan-msg1">Kinerja energi masih di atas baseline.
                                                Diperlukan evaluasi penggunaan energi agar lebih efisien.</span>
                                        </div>

                                        <div id="enpi-kesimpulan-alert2" class="flex items-start gap-2 text-gray-800">
                                            <span class="text-sm select-none shrink-0">&#128184;</span>
                                            <span id="enpi-kesimpulan-msg2">Terjadi kenaikan biaya energi sebesar Rp
                                                1,600 dan tambahan emisi 0.8 kg CO<sub>2</sub>. Perlu tindakan
                                                segera.</span>
                                        </div>

                                        <div class="pt-1.5">
                                            <div class="font-bold text-gray-900 mb-2 font-sans">Rekomendasi Tindakan:
                                            </div>

                                            <div class="space-y-2.5">
                                                <!-- Jangka Pendek (0–3 bulan) -->
                                                <div class="p-3 bg-[#e8f7ee] rounded-xl text-gray-800 space-y-1">
                                                    <div class="font-bold text-gray-900 flex items-center gap-1.5">
                                                        <span class="text-xs">&#129001;</span>
                                                        <span>Jangka Pendek (0–3 bulan):</span>
                                                    </div>
                                                    <div class="text-xs text-gray-700 pl-4 space-y-0.5">
                                                        <div>- Audit energi harian &amp; identifikasi mesin dengan
                                                            konsumsi tinggi.</div>
                                                        <div>- Edukasi operator tentang cara hemat energi.</div>
                                                    </div>
                                                </div>

                                                <!-- Jangka Menengah (3–12 bulan) -->
                                                <div class="p-3 bg-[#fef9e7] rounded-xl text-gray-800 space-y-1">
                                                    <div class="font-bold text-gray-900 flex items-center gap-1.5">
                                                        <span class="text-xs">&#129000;</span>
                                                        <span>Jangka Menengah (3–12 bulan):</span>
                                                    </div>
                                                    <div class="text-xs text-gray-700 pl-4 space-y-0.5">
                                                        <div>- Terapkan program perawatan preventif mesin produksi.
                                                        </div>
                                                        <div>- Optimalkan jadwal produksi agar faktor beban energi lebih
                                                            stabil.</div>
                                                        <div>- Monitoring energi real-time untuk mendeteksi anomali.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Jangka Panjang (>12 bulan) -->
                                                <div class="p-3 bg-[#eaf4fc] rounded-xl text-gray-800 space-y-1">
                                                    <div class="font-bold text-gray-900 flex items-center gap-1.5">
                                                        <span class="text-xs">&#129002;</span>
                                                        <span>Jangka Panjang (>12 bulan):</span>
                                                    </div>
                                                    <div class="text-xs text-gray-700 pl-4 space-y-0.5">
                                                        <div>- Investasi pada mesin/teknologi hemat energi.</div>
                                                        <div>- Integrasi energi terbarukan (misalnya PLTS atap).</div>
                                                        <div>- Ikut serta dalam program perdagangan karbon untuk
                                                            monetisasi carbon credit.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 3: Help -->
                                <div id="enpi-tab-pane-help"
                                    class="hidden space-y-3.5 text-xs sm:text-[13px] text-gray-800 leading-relaxed font-sans">
                                    <div>
                                        <h4 class="text-sm sm:text-base font-bold text-gray-900 mb-1">EnPI (Energy
                                            Performance Indicator)</h4>
                                        <p class="text-xs sm:text-[13px] text-gray-800 leading-relaxed">
                                            ENPI adalah indikator efisiensi energi: energi yang digunakan per unit
                                            produksi. Semakin rendah ENPI, semakin efisien penggunaan energi.
                                        </p>
                                    </div>

                                    <ul
                                        class="text-xs sm:text-[13px] text-gray-800 space-y-1.5 pl-5 list-disc leading-relaxed">
                                        <li><strong class="font-bold text-gray-900">ENPI Aktual:</strong> Total Energy
                                            &divide; Total Produksi</li>
                                        <li><strong class="font-bold text-gray-900">Target Energy:</strong> Baseline
                                            ENPI &times; Produksi Aktual</li>
                                        <li><strong class="font-bold text-gray-900">Status Kinerja:</strong> Good jika
                                            Energy &le; Target Energy, Bad jika lebih besar</li>
                                        <li><strong class="font-bold text-gray-900">Emisi CO<sub>2</sub>:</strong>
                                            Total Energy &times; Emission Factor (kg CO<sub>2</sub>/kWh)</li>
                                        <li><strong class="font-bold text-gray-900">Pengurangan Emisi:</strong> Emisi
                                            Baseline &ndash; Emisi Aktual</li>
                                        <li><strong class="font-bold text-gray-900">Biaya Energi:</strong> Total Energy
                                            &times; Tarif Energi</li>
                                        <li><strong class="font-bold text-gray-900">Carbon Credit:</strong> (Emisi
                                            Saved &divide; 1000) &times; Harga Carbon (USD)</li>
                                    </ul>

                                    <p class="text-xs sm:text-[13px] text-gray-800 pt-2 leading-relaxed">
                                        <strong class="font-bold text-gray-900">Referensi:</strong> IEA, UNFCCC, Smith
                                        et al., Journal of Cleaner Production, 2019&ndash;2021.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Placeholder Before "Hitung EnPI" is Clicked -->
                    <div id="enpi-charts-empty-placeholder"
                        class="bg-white border border-gray-200/90 rounded-2xl p-10 sm:p-14 text-center space-y-3">
                        <div
                            class="w-14 h-14 mx-auto rounded-2xl bg-gray-50 border border-gray-200 text-gray-400 flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 font-['Agrandir']">Visualisasi Grafik &amp; Tabel
                            Detail Belum Aktif</h3>
                        <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed font-sans">
                            Grafik EnPI vs Baseline, Grafik Energy Aktual vs Target Energy, dan Tabel Detail harian akan
                            ditampilkan di sini secara otomatis setelah Anda menekan tombol <strong
                                class="text-gray-900 font-bold">"Hitung EnPI"</strong>.
                        </p>
                    </div>

                    <!-- Charts & Detail Table Wrapper (Hidden until calculated) -->
                    <div id="enpi-charts-wrapper" class="hidden space-y-6">
                        <!-- Middle 1: Chart 1 (Grafik EnPI vs Baseline) -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-3">
                            <h3 class="text-base font-bold text-slate-900 font-['Agrandir']">
                                Grafik EnPI vs Baseline
                            </h3>
                            <div class="relative w-full h-72 sm:h-80 bg-white rounded-xl">
                                <canvas id="enpi-ext-chart-enpi"></canvas>
                            </div>
                        </div>

                        <!-- Middle 2: Chart 2 (Grafik Energy Aktual vs Target Energy) -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-3">
                            <h3 class="text-base font-bold text-slate-900 font-['Agrandir']">
                                Grafik Energy Aktual vs Target Energy
                            </h3>
                            <div class="relative w-full h-72 sm:h-80 bg-white rounded-xl">
                                <canvas id="enpi-ext-chart-energy"></canvas>
                            </div>
                        </div>

                        <!-- Bottom: Tabel Detail -->
                        <div class="bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-3">
                            <h3 class="text-base font-bold text-slate-900 font-['Agrandir']">
                                Tabel Detail
                            </h3>
                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="w-full text-left text-xs text-gray-700">
                                    <thead class="bg-gray-50 text-gray-800 font-bold border-b border-gray-200">
                                        <tr>
                                            <th class="py-2.5 px-3">Tanggal</th>
                                            <th class="py-2.5 px-3 text-right">Energy (kWh)</th>
                                            <th class="py-2.5 px-3 text-right">Produksi (unit)</th>
                                            <th class="py-2.5 px-3 text-right">EnPI (kWh/unit)</th>
                                            <th class="py-2.5 px-3 text-right">Target Energy (kWh)</th>
                                            <th class="py-2.5 px-3 text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="enpi-ext-detail-tbody" class="divide-y divide-gray-100 font-mono">
                                        <!-- Populated dynamically by calculateExtendedEnPI() -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 4: SMART BMS & EIS UTILITIES (EIS FORM - SMARTEK REF)   -->
            <!-- ================================================================= -->
            <div id="sim-pane-bms" class="sim-pane {{ $currentDomain === 'bms' ? '' : 'hidden' }} pt-8">
                <div
                    class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-6">

                    <!-- Header Area matching Gambar 1 -->
                    <div class="pb-3 border-b border-gray-100">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 font-['Agrandir']">
                            EIS Form
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-500 font-['Questrial'] mt-2 leading-relaxed">
                            Isi jumlah device &amp; centang parameter yang ingin dimonitor. Pilih fitur (Realtime /
                            Historian / Report) dan durasi retensi untuk Historian. Sistem akan hitung estimasi storage,
                            struktur DB, estimasi biaya, dan spesifikasi PC minimum. Klik tab di kanan untuk melihat
                            Summary / Detail Kapasitas / Detail Biaya.
                        </p>
                    </div>

                    <!-- 2-Column Split: Left = Forms & Parameters, Right = Summary & Recommendations -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                        <!-- LEFT COLUMN: Forms & Parameters -->
                        <div class="lg:col-span-7 space-y-6">

                            <!-- 1. Informasi Proyek -->
                            <div class="space-y-3">
                                <h3 class="text-sm font-bold text-gray-900 font-['Agrandir']">Informasi Proyek</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <input type="text" id="eis-project-name"
                                            placeholder="Nama Proyek (misal: EIS PLANT 1)"
                                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                    <div>
                                        <input type="text" id="eis-project-location"
                                            placeholder="Lokasi (misal: Cikarang Barat)"
                                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-600 mb-1">Target Implementasi (tanggal
                                        rencana commissioning)</label>
                                    <input type="date" id="eis-project-date"
                                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    <span class="block text-[11px] text-gray-400 mt-1">Hanya untuk URS / dokumentasi
                                        (tidak mempengaruhi kalkulasi).</span>
                                </div>
                            </div>

                            <!-- 2. Device Configuration -->
                            <div class="space-y-3.5 pt-2 border-t border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 font-['Agrandir']">
                                    Device Configuration
                                </h3>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Jumlah Device (total
                                        node meter / point)</label>
                                    <input type="number" id="eis-devices-count" value="120" min="1"
                                        max="5000" oninput="triggerEisAutoRecalc()"
                                        class="w-full px-3.5 py-2 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    <span class="block text-[11px] text-gray-400 mt-0.5">Masukkan jumlah endpoint yang
                                        mengirim data.</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Jumlah Env. Sensors
                                            - Temperature</label>
                                        <input type="number" id="eis-temp-sensors" value="3" min="0"
                                            max="200" oninput="triggerEisAutoRecalc()"
                                            class="w-full px-3.5 py-2 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Jumlah Env. Sensors
                                            - Humidity</label>
                                        <input type="number" id="eis-hum-sensors" value="1" min="0"
                                            max="200" oninput="triggerEisAutoRecalc()"
                                            class="w-full px-3.5 py-2 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Jumlah Gateway / Data
                                        Logger</label>
                                    <input type="number" id="eis-gateways-count" value="2" min="1"
                                        max="50" oninput="triggerEisAutoRecalc()"
                                        class="w-full px-3.5 py-2 text-xs sm:text-sm border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                </div>

                                <!-- Pilihan Gateway / Data Logger -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Pilihan Gateway /
                                        Data Logger</label>
                                    <div
                                        class="space-y-1.5 sm:space-y-0 sm:flex sm:items-center sm:gap-6 text-xs text-gray-700">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_gateway_type" value="3500000" checked
                                                onchange="triggerEisAutoRecalc()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Rp 3.500.000</strong> —
                                                Gateway Only</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_gateway_type" value="5000000"
                                                onchange="triggerEisAutoRecalc()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Rp 5.000.000</strong> —
                                                Gateway + Data Logger</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Status Device -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1.5">Status Device</label>
                                    <div class="flex items-center gap-6 text-xs text-gray-700">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_device_status" value="new" checked
                                                onchange="onEisDeviceStatusChange()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">New</strong> (Perangkat
                                                baru, biaya dihitung)</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_device_status" value="existing"
                                                onchange="onEisDeviceStatusChange()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Existing</strong>
                                                (Perangkat lama, tanpa biaya)</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Pilihan Device (hanya berlaku untuk New) -->
                                <div id="eis-device-options-container" class="space-y-1.5">
                                    <label class="block text-xs font-medium text-gray-700">Pilihan Device (pilih satu,
                                        hanya berlaku untuk New)</label>
                                    <div class="space-y-2 text-xs text-gray-700">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_device_tier" value="5000000" checked
                                                onchange="triggerEisAutoRecalc()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Rp 5.000.000</strong> —
                                                ICP Dash / Weidmüller (basic)</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_device_tier" value="9000000"
                                                onchange="triggerEisAutoRecalc()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Rp 9.000.000</strong> —
                                                SIEMENS (mid-tier)</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="eis_device_tier" value="13000000"
                                                onchange="triggerEisAutoRecalc()"
                                                class="text-[#3367A5] focus:ring-[#3367A5]">
                                            <span><strong class="font-semibold text-gray-900">Rp 13.000.000</strong> —
                                                Schneider (high-end)</span>
                                        </label>
                                    </div>
                                    <span class="block text-[11px] text-gray-400 mt-0.5">Harga device dikalikan jumlah
                                        device (jika New dipilih).</span>
                                </div>
                            </div>

                            <!-- 3. Mode Sistem -->
                            <div class="space-y-2 pt-2 border-t border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 font-['Agrandir']">Mode Sistem</h3>
                                <div class="space-y-2 text-xs text-gray-800">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" id="eis-mode-realtime" checked
                                            onchange="onEisModeChange('realtime')"
                                            class="rounded text-[#0b57d0] focus:ring-[#0b57d0]">
                                        <span class="font-medium text-gray-900">Realtime Monitoring</span>
                                    </label>
                                    <div class="flex items-center gap-3">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" id="eis-mode-historian" checked
                                                onchange="onEisModeChange('historian')"
                                                class="rounded text-[#0b57d0] focus:ring-[#0b57d0]">
                                            <span class="font-medium text-gray-900">Historian (time-series)</span>
                                        </label>
                                        <div id="eis-retention-input-wrap"
                                            class="flex items-center gap-1.5 text-xs text-gray-500">
                                            <span>Retensi:</span>
                                            <input type="number" id="eis-retention-months" value="12"
                                                min="1" max="60" oninput="triggerEisAutoRecalc()"
                                                class="w-16 px-2 py-0.5 border border-gray-200 rounded text-center text-xs text-gray-900 bg-white">
                                            <span>bulan</span>
                                        </div>
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" id="eis-mode-report" checked
                                            onchange="onEisModeChange('report')"
                                            class="rounded text-[#0b57d0] focus:ring-[#0b57d0]">
                                        <span class="font-medium text-gray-900">Report (scheduled)</span>
                                    </label>
                                </div>
                                <span class="block text-[11px] text-gray-400 leading-normal">
                                    Historian → Realtime aktif. Report → Realtime + Historian aktif. Nonaktifkan
                                    Realtime → Historian &amp; Report mati.
                                </span>
                            </div>

                            <!-- 4. Pilih Parameter -->
                            <div class="space-y-3 pt-2 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-bold text-gray-900 font-['Agrandir']">Pilih Parameter</h3>
                                    <div class="flex items-center gap-2 text-xs">
                                        <button type="button" onclick="eisSelectAllParams(true)"
                                            class="font-semibold text-[#0b57d0] hover:underline">Select All</button>
                                        <span class="text-gray-300">|</span>
                                        <button type="button" onclick="eisSelectAllParams(false)"
                                            class="font-semibold text-gray-500 hover:underline">Clear All</button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 text-xs text-gray-700">
                                    <!-- Voltage -->
                                    <div class="space-y-1.5">
                                        <div class="font-bold text-gray-900 text-xs">Voltage (Volt)</div>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Volt R" checked
                                                onchange="triggerEisAutoRecalc()"><span>Volt R</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Volt S"
                                                onchange="triggerEisAutoRecalc()"><span>Volt S</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Volt T"
                                                onchange="triggerEisAutoRecalc()"><span>Volt T</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Volt Avg"
                                                onchange="triggerEisAutoRecalc()"><span>Volt Avg</span></label>
                                    </div>

                                    <!-- Current -->
                                    <div class="space-y-1.5">
                                        <div class="font-bold text-gray-900 text-xs">Current (Ampere)</div>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Amp R" checked
                                                onchange="triggerEisAutoRecalc()"><span>Amp R</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Amp S"
                                                onchange="triggerEisAutoRecalc()"><span>Amp S</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Amp T"
                                                onchange="triggerEisAutoRecalc()"><span>Amp T</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Amp Avg"
                                                onchange="triggerEisAutoRecalc()"><span>Amp Avg</span></label>
                                    </div>

                                    <!-- Power -->
                                    <div class="space-y-1.5">
                                        <div class="font-bold text-gray-900 text-xs">Power</div>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="kW" checked
                                                onchange="triggerEisAutoRecalc()"><span>kW</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="kVA"
                                                onchange="triggerEisAutoRecalc()"><span>kVA</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="kVAR"
                                                onchange="triggerEisAutoRecalc()"><span>kVAR</span></label>
                                    </div>

                                    <!-- Energy & PQ -->
                                    <div class="space-y-1.5">
                                        <div class="font-bold text-gray-900 text-xs">Energy &amp; PQ</div>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="energy" data-name="kWh"
                                                onchange="triggerEisAutoRecalc()"><span>kWh</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="pq" data-name="Power Factor"
                                                onchange="triggerEisAutoRecalc()"><span>Power Factor</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="pq" data-name="THD-V"
                                                onchange="triggerEisAutoRecalc()"><span>THD-V</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="pq" data-name="THD-I"
                                                onchange="triggerEisAutoRecalc()"><span>THD-I</span></label>
                                    </div>

                                    <!-- Lainnya -->
                                    <div class="space-y-1.5 col-span-2 sm:col-span-1">
                                        <div class="font-bold text-gray-900 text-xs">Lainnya</div>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="fast" data-name="Frequency" checked
                                                onchange="triggerEisAutoRecalc()"><span>Frequency</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="event" data-name="Alarm/Event" checked
                                                onchange="triggerEisAutoRecalc()"><span>Alarm/Event</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="env" data-name="Temperature"
                                                onchange="triggerEisAutoRecalc()"><span>Temperature</span></label>
                                        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox"
                                                class="eis-param" data-group="env" data-name="Humidity"
                                                onchange="triggerEisAutoRecalc()"><span>Humidity</span></label>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Sampling Defaults -->
                            <div class="space-y-3 pt-2 border-t border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 font-['Agrandir']">Sampling Defaults</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                    <div>
                                        <label class="block text-gray-600 mb-1">Fast (V/I/P/F) — detik</label>
                                        <input type="number" id="eis-sample-fast" value="1" min="1"
                                            max="3600" oninput="triggerEisAutoRecalc()"
                                            class="w-full px-3.5 py-2 border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                    <div>
                                        <label class="block text-gray-600 mb-1">PQ (THD, PF) — detik</label>
                                        <input type="number" id="eis-sample-pq" value="10" min="1"
                                            max="3600" oninput="triggerEisAutoRecalc()"
                                            class="w-full px-3.5 py-2 border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block text-gray-600 mb-1">Energy (kWh) — detik</label>
                                        <input type="number" id="eis-sample-energy" value="60" min="1"
                                            max="3600" oninput="triggerEisAutoRecalc()"
                                            class="w-full px-3.5 py-2 border border-gray-200 rounded-xl bg-gray-50/50 text-gray-800 focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#3367A5] transition">
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons & Disclaimer -->
                            <div class="space-y-3 pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <button type="button" onclick="calculateEisForm(true)"
                                        class="px-6 py-2.5 rounded-xl bg-[#0d1b3e] hover:bg-[#3367A5] text-white text-xs sm:text-sm font-bold font-['Agrandir'] transition shadow-sm">
                                        Show Summary
                                    </button>
                                    <button type="button" onclick="resetEisForm()"
                                        class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs sm:text-sm font-semibold transition">
                                        Reset
                                    </button>
                                </div>
                                <span class="block text-[11px] text-gray-400 leading-relaxed">
                                    Asumsi: 16 bytes/value (event: 64 bytes). Realtime: 30 hari (rolling). Historian:
                                    retensi berdasarkan input (default: 12 bulan). Report: +5% storage.
                                </span>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN: Summary & Recommendations -->
                        <div
                            class="relative lg:col-span-5 bg-white border border-gray-200/90 rounded-2xl p-5 sm:p-6 shadow-sm space-y-5 overflow-hidden">
                            <!-- Result Lock Overlay -->
                            <div class="sim-lock-overlay absolute inset-0 z-20 bg-white/75 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-[#E6F0FA] text-[#244E81] flex items-center justify-center shadow-xs">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="space-y-1 max-w-xs">
                                    <p class="text-sm font-bold text-slate-900 font-['Agrandir',sans-serif]">Hasil &amp; Estimasi EIS Terkunci</p>
                                    <p class="text-xs text-slate-500 font-['Questrial',sans-serif] leading-relaxed">
                                        Lengkapi formulir singkat terlebih dahulu untuk membuka ringkasan kapasitas, storage, dan estimasi biaya.
                                    </p>
                                </div>
                                <button type="button" onclick="requireSimulationLeadGate(() => calculateEisForm(true))"
                                    class="px-5 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md transition cursor-pointer active:scale-95">
                                    Isi Formulir &amp; Lihat Hasil
                                </button>
                            </div>
                            <div class="sim-lock-target space-y-5">
                            <div>
                                <h3 class="text-base font-bold text-gray-900 font-['Agrandir']">Summary &amp;
                                    Recommendations</h3>
                                <p class="text-[11px] text-gray-400 font-['Questrial'] mt-0.5">Pilih tab untuk
                                    ringkasan / detail kapasitas / biaya</p>
                            </div>

                            <!-- 3 Navigation Tabs matching Gambar 1 & Gambar 2 -->
                            <div class="grid grid-cols-3 gap-1.5 sm:gap-2 text-[11px] sm:text-xs">
                                <button type="button" onclick="switchEisTab('summary')" id="eis-tab-btn-summary"
                                    class="py-2 px-1.5 sm:px-3 font-bold rounded-lg transition bg-[#0b57d0] text-white border border-[#0b57d0] flex items-center justify-center gap-1 sm:gap-1.5 shadow-sm whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Summary
                                </button>
                                <button type="button" onclick="switchEisTab('capacity')" id="eis-tab-btn-capacity"
                                    class="py-2 px-1.5 sm:px-3 font-semibold rounded-lg transition text-gray-700 bg-white border border-gray-200/90 hover:bg-gray-50 flex items-center justify-center gap-1 sm:gap-1.5 shadow-2xs whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Kapasitas
                                </button>
                                <button type="button" onclick="switchEisTab('cost')" id="eis-tab-btn-cost"
                                    class="py-2 px-1.5 sm:px-3 font-semibold rounded-lg transition text-gray-700 bg-white border border-gray-200/90 hover:bg-gray-50 flex items-center justify-center gap-1 sm:gap-1.5 shadow-2xs whitespace-nowrap">
                                    <span class="font-bold text-xs leading-none text-gray-700">$</span>
                                    Biaya
                                </button>
                            </div>

                            <!-- TAB 1: Summary -->
                            <div id="eis-tab-pane-summary" class="space-y-4">
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-xs text-gray-500 font-medium font-['Questrial']">Data per Hari
                                        </div>
                                        <div id="eis-res-daily"
                                            class="text-2xl font-bold text-[#083366] mt-0.5 tracking-tight font-['Agrandir']">
                                            0 GB</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 font-medium font-['Questrial']">Data Total
                                            Retention</div>
                                        <div id="eis-res-retention"
                                            class="text-2xl font-bold text-[#083366] mt-0.5 tracking-tight font-['Agrandir']">
                                            0 GB</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 font-medium font-['Questrial']">Est. Total
                                            Biaya</div>
                                        <div id="eis-res-cost"
                                            class="text-2xl font-bold text-[#083366] mt-0.5 tracking-tight font-['Agrandir']">
                                            Rp 0</div>
                                    </div>
                                </div>

                                <!-- Filled Recommendations Matching Gambar 2 -->
                                <div id="eis-summary-details-wrap" class="hidden space-y-3.5 pt-1">
                                    <!-- Light Blue DB & Mode Box -->
                                    <div
                                        class="p-3.5 sm:p-4 rounded-xl bg-[#f0f6ff] text-xs text-gray-700 leading-relaxed space-y-1 font-['Questrial']">
                                        <div id="eis-db-arch-text">DB: PostgreSQL + TimescaleDB (hypertable, chunk per
                                            hari, compress/retention).</div>
                                        <div id="eis-mode-retention-text">Mode: Historian (12 months) + Report ·
                                            Retention: 360 hari</div>
                                    </div>

                                    <!-- Spesifikasi PC/Server Minimum -->
                                    <div class="space-y-1 text-xs text-gray-700 leading-relaxed font-['Questrial']">
                                        <div class="font-bold text-gray-900 text-xs sm:text-sm font-['Agrandir'] mb-1">
                                            Spesifikasi PC/Server Minimum:</div>
                                        <div id="eis-spec-cpu"><strong
                                                class="font-semibold text-gray-900">CPU:</strong> Intel Xeon / AMD EPYC
                                            (12+ cores)</div>
                                        <div id="eis-spec-ram"><strong
                                                class="font-semibold text-gray-900">RAM:</strong> 64 GB+</div>
                                        <div id="eis-spec-storage"><strong
                                                class="font-semibold text-gray-900">Storage:</strong> 2 TB SSD + RAID
                                        </div>
                                        <div id="eis-spec-notes"
                                            class="text-[11px] text-gray-500 pt-0.5 leading-normal"><strong
                                                class="font-semibold text-gray-700">Catatan:</strong> Spesifikasi
                                            enterprise untuk Historian &gt; 1 TB atau &gt; 200 perangkat.</div>
                                    </div>

                                    <!-- Device Breakdown Line -->
                                    <div id="eis-device-breakdown-box"
                                        class="text-xs text-gray-700 leading-relaxed font-['Questrial'] pt-1">
                                        <div id="eis-dev-line-1"><strong
                                                class="font-semibold text-gray-900">Device:</strong> <span
                                                id="eis-dev-name">ICP Dash / Weidmüller (basic)</span> · <strong
                                                class="font-semibold text-gray-900">Unit:</strong> <span
                                                id="eis-dev-unit">Rp 5.000.000</span> · <strong
                                                class="font-semibold text-gray-900">Qty:</strong> <span
                                                id="eis-dev-qty">120</span> ·</div>
                                        <div id="eis-dev-line-2"><strong
                                                class="font-semibold text-gray-900">Subtotal:</strong> <span
                                                id="eis-dev-subtotal">Rp 600.000.000</span></div>
                                    </div>
                                </div>

                                <!-- Empty State Notice Box (shown if 0 params selected or before calculation) -->
                                <div id="eis-empty-notice-box"
                                    class="p-4 rounded-xl bg-gray-50/80 border border-gray-100 text-xs text-gray-500 leading-relaxed text-center">
                                    Silakan atur parameter dan klik tombol <strong class="text-gray-700">Show Summary</strong> untuk melihat hasil kalkulasi.
                                </div>

                                <!-- Export Excel Button -->
                                <div class="pt-2 flex items-center justify-between border-t border-gray-100">
                                    <span class="text-[11px] text-gray-400">Hasil dapat diekspor (Excel)</span>
                                    <button type="button" onclick="exportEisToExcel()"
                                        class="px-4 py-2 rounded-xl bg-[#0b57d0] hover:bg-[#0842a0] text-white text-xs font-bold font-['Agrandir'] flex items-center gap-2 shadow-sm transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Export ke Excel
                                    </button>
                                </div>
                            </div>

                            <!-- TAB 2: Kapasitas matching Gambar Kapasitas -->
                            <div id="eis-tab-pane-capacity" class="hidden space-y-4 text-xs font-['Questrial']">
                                <div class="overflow-x-auto border border-blue-200/90 rounded-xl shadow-2xs">
                                    <table class="w-full text-[11px] leading-tight text-gray-800 border-collapse">
                                        <thead>
                                            <tr class="bg-[#dce9f8] text-gray-900 border-b border-blue-200/90">
                                                <th
                                                    class="py-2.5 px-2 text-left font-['Agrandir'] font-bold border-r border-blue-200/60">
                                                    Parameter</th>
                                                <th
                                                    class="py-2.5 px-1.5 text-center font-['Agrandir'] font-bold border-r border-blue-200/60 leading-snug">
                                                    Sampling<br><span
                                                        class="font-normal text-[10px] text-gray-600">(detik)</span>
                                                </th>
                                                <th
                                                    class="py-2.5 px-1.5 text-center font-['Agrandir'] font-bold border-r border-blue-200/60 leading-snug">
                                                    Byte/baris
                                                </th>
                                                <th
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] font-bold border-r border-blue-200/60 leading-snug">
                                                    Per<br>Day<br><span
                                                        class="font-normal text-[10px] text-gray-600">all<br>device</span>
                                                </th>
                                                <th
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] font-bold border-r border-blue-200/60 leading-snug">
                                                    Per<br>Month<br><span
                                                        class="font-normal text-[10px] text-gray-600">all<br>device<br>≈30<br>hari</span>
                                                </th>
                                                <th
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] font-bold border-r border-blue-200/60 leading-snug">
                                                    Per<br>Year<br><span
                                                        class="font-normal text-[10px] text-gray-600">all<br>device</span>
                                                </th>
                                                <th
                                                    class="py-2.5 px-2 text-right font-['Agrandir'] font-bold leading-snug">
                                                    Total<br>Retention<br><span id="eis-cap-retention-header-days"
                                                        class="font-normal text-[10px] text-gray-600">360 hari</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="eis-cap-table-body" class="divide-y divide-gray-100 bg-white">
                                            <tr>
                                                <td colspan="7" class="py-8 text-center text-gray-400 text-xs">
                                                    Belum ada kalkulasi. Silakan klik tombol <strong class="text-gray-600">Show Summary</strong> untuk melihat rincian kapasitas.
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr id="eis-cap-table-total-row"
                                                class="bg-[#dce9f8] text-gray-900 font-bold border-t-2 border-blue-200/90">
                                                <td
                                                    class="py-2.5 px-2 font-['Agrandir'] font-extrabold border-r border-blue-200/60">
                                                    TOTAL</td>
                                                <td class="py-2.5 px-1.5 border-r border-blue-200/60"></td>
                                                <td class="py-2.5 px-1.5 border-r border-blue-200/60"></td>
                                                <td id="eis-cap-total-day"
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] border-r border-blue-200/60">
                                                    0 GB</td>
                                                <td id="eis-cap-total-month"
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] border-r border-blue-200/60">
                                                    0 GB</td>
                                                <td id="eis-cap-total-year"
                                                    class="py-2.5 px-1.5 text-right font-['Agrandir'] border-r border-blue-200/60">
                                                    0 GB</td>
                                                <td id="eis-cap-total-retention"
                                                    class="py-2.5 px-2 text-right font-['Agrandir']">0 GB</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Export Excel Button Row matching Gambar -->
                                <div class="pt-2 flex items-center justify-between border-t border-gray-100">
                                    <span class="text-[11px] text-gray-400">Hasil dapat diekspor (Excel)</span>
                                    <button type="button" onclick="exportEisToExcel()"
                                        class="px-4 py-2 rounded-xl bg-[#0b57d0] hover:bg-[#0842a0] text-white text-xs font-bold font-['Agrandir'] flex items-center gap-2 shadow-sm transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Export ke Excel
                                    </button>
                                </div>
                            </div>

                            <!-- TAB 3: Biaya matching Gambar Biaya -->
                            <div id="eis-tab-pane-cost" class="hidden space-y-4 text-xs font-['Questrial']">
                                <div class="overflow-x-auto border border-blue-200/90 rounded-xl shadow-2xs">
                                    <table class="w-full text-[11px] leading-tight text-gray-800 border-collapse">
                                        <thead>
                                            <tr class="bg-[#dce9f8] text-gray-900 border-b border-blue-200/90">
                                                <th
                                                    class="py-2.5 px-3 text-left font-['Agrandir'] font-bold border-r border-blue-200/60">
                                                    Komponen</th>
                                                <th
                                                    class="py-2.5 px-2 text-right font-['Agrandir'] font-bold border-r border-blue-200/60">
                                                    Qty</th>
                                                <th
                                                    class="py-2.5 px-3 text-right font-['Agrandir'] font-bold border-r border-blue-200/60">
                                                    Unit Price</th>
                                                <th class="py-2.5 px-3 text-right font-['Agrandir'] font-bold">
                                                    Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="eis-cost-table-body" class="divide-y divide-gray-100 bg-white">
                                            <tr>
                                                <td colspan="4" class="py-8 text-center text-gray-400 text-xs">
                                                    Belum ada kalkulasi. Silakan klik tombol <strong class="text-gray-600">Show Summary</strong> untuk melihat rincian biaya.
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <!-- Initial CapEx -->
                                            <tr class="bg-[#e2effd] text-gray-900 border-t-2 border-blue-200/90">
                                                <td class="py-3 px-3 font-['Agrandir'] font-bold border-r border-blue-200/60 text-xs sm:text-sm"
                                                    colspan="3">Initial CapEx</td>
                                                <td id="eis-cost-capex"
                                                    class="py-3 px-3 text-right font-['Agrandir'] font-extrabold text-xs sm:text-sm text-gray-900">
                                                    Rp 0</td>
                                            </tr>
                                            <!-- Yearly OpEx -->
                                            <tr class="bg-[#e2effd] text-gray-900 border-t border-blue-200/60">
                                                <td class="py-3 px-3 font-['Agrandir'] font-bold border-r border-blue-200/60 text-xs sm:text-sm"
                                                    colspan="3">Yearly OpEx</td>
                                                <td id="eis-cost-opex"
                                                    class="py-3 px-3 text-right font-['Agrandir'] font-extrabold text-xs sm:text-sm text-gray-900">
                                                    Rp 0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Export Excel Button Row matching Gambar -->
                                <div class="pt-2 flex items-center justify-between border-t border-gray-100">
                                    <span class="text-[11px] text-gray-400">Hasil dapat diekspor (Excel)</span>
                                    <button type="button" onclick="exportEisToExcel()"
                                        class="px-4 py-2 rounded-xl bg-[#0b57d0] hover:bg-[#0842a0] text-white text-xs font-bold font-['Agrandir'] flex items-center gap-2 shadow-sm transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Export ke Excel
                                    </button>
                                </div>
                            </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SIMULATOR 5: POWER QUALITY & KVARH / COS PHI (SMARTEK REFERENCE)  -->
            <!-- ================================================================= -->
            <div id="sim-pane-logistics" class="sim-pane {{ $currentDomain === 'logistics' ? '' : 'hidden' }} pt-8">
                <div class="bg-white text-gray-900 rounded-3xl p-6 sm:p-10 shadow-2xl border border-gray-200 space-y-8 font-['Questrial',sans-serif]">

                    <!-- 1. Header with Title and Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 font-['Agrandir']">
                                Dashboard kVArh &amp; Cos Phi
                            </h2>
                        </div>
                        <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                            <button type="button" onclick="kvarhSimulateSampleDrop()"
                                class="px-4 py-2.5 rounded-xl text-xs font-bold font-['Agrandir'] bg-amber-500 hover:bg-amber-600 text-white transition-all shadow-sm">
                                Simulasikan Denda (Sample Drop)
                            </button>
                            <button type="button" onclick="resetKvarhDefaults()"
                                class="px-4 py-2.5 rounded-xl text-xs font-bold font-['Agrandir'] bg-gray-100 hover:bg-gray-200 text-gray-700 transition-all border border-gray-300">
                                Reset Default (0.85)
                            </button>
                        </div>
                    </div>

                    <!-- 2. Top 6 KPI Metric Cards Grid (Locked until Lead Form filled once per session) -->
                    <div class="relative rounded-2xl overflow-hidden">
                        <div class="sim-lock-overlay absolute inset-0 z-20 bg-white/80 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 space-y-3 rounded-2xl">
                            <div class="w-12 h-12 rounded-2xl bg-[#E6F0FA] text-[#244E81] flex items-center justify-center shadow-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="space-y-1 max-w-sm">
                                <p class="text-sm font-bold text-slate-900 font-['Agrandir',sans-serif]">Hasil Analitik kVArh &amp; Cos Phi Terkunci</p>
                                <p class="text-xs text-slate-500 font-['Questrial',sans-serif] leading-relaxed">
                                    Isi formulir singkat identitas perusahaan terlebih dahulu untuk melihat KPI kualitas daya &amp; simulasi denda PLN.
                                </p>
                            </div>
                            <button type="button" onclick="requireSimulationLeadGate(() => { initKvarhSimulator(); })"
                                class="px-5 py-2.5 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-xs font-bold font-['Agrandir',sans-serif] shadow-md transition cursor-pointer active:scale-95">
                                Isi Formulir &amp; Lihat Hasil
                            </button>
                        </div>
                    <div class="sim-lock-target grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                        <!-- Card 1: Rata-rata cosφ -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Rata-rata cosφ</div>
                            <div class="my-2">
                                <span id="kvarh-kpi-avg" class="text-3xl sm:text-4xl font-bold text-gray-900 font-['Agrandir']">0.85</span>
                            </div>
                            <div class="text-xs text-gray-400">
                                rentang: <span id="kvarh-kpi-range" class="font-mono text-gray-600">0.85 - 0.85</span>
                            </div>
                        </div>

                        <!-- Card 2: Total Energi Aktif (MWh) -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Total Energi Aktif (MWh)</div>
                            <div class="my-2">
                                <span id="kvarh-kpi-mwh" class="text-3xl sm:text-4xl font-bold text-gray-900 font-['Agrandir']">1201.0</span>
                            </div>
                            <div class="text-xs text-gray-400">
                                Total akumulasi 30 hari
                            </div>
                        </div>

                        <!-- Card 3: Total Energi Reaktif (MVArh) -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Total Energi Reaktif (MVArh)</div>
                            <div class="my-2">
                                <span id="kvarh-kpi-mvarh" class="text-3xl sm:text-4xl font-bold text-gray-900 font-['Agrandir']">744.3</span>
                            </div>
                            <div class="text-xs text-gray-400">
                                Sesuai rumus Q = P × tan(φ)
                            </div>
                        </div>

                        <!-- Card 4: Total Excess (kVArh) -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Total Excess (kVArh)</div>
                            <div class="my-2">
                                <span id="kvarh-kpi-excess" class="text-3xl sm:text-4xl font-bold text-gray-900 font-['Agrandir']">0.0</span>
                            </div>
                            <div class="text-xs text-gray-400">
                                Berlaku jika cosφ &lt; 0,85 dan kVArh &gt; 62% kWh.
                            </div>
                        </div>

                        <!-- Card 5: Tarif kVArh I-3 -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Tarif kVArh I-3</div>
                            <div class="my-2">
                                <span class="text-3xl sm:text-4xl font-bold text-gray-900 font-['Agrandir']">Rp 1.114,74</span>
                            </div>
                            <div class="text-xs text-gray-400">
                                Rujukan regulasi tarif industri PLN
                            </div>
                        </div>

                        <!-- Card 6: Estimasi Biaya -->
                        <div class="p-5 rounded-2xl bg-white border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div class="text-xs text-gray-500 font-medium">Estimasi Biaya</div>
                            <div class="my-2">
                                <span id="kvarh-kpi-cost" class="text-3xl sm:text-4xl font-bold text-[#3367A5] font-['Agrandir']">Rp 0</span>
                            </div>
                            <div id="kvarh-kpi-cost-sub" class="text-xs text-gray-400">
                                Bebas denda kelebihan kVArh PLN
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- 3. Catatan Interpretasi KPI Box (Matching Reference Video) -->
                    <div class="p-5 rounded-2xl bg-gray-50/80 border border-gray-200 text-xs text-gray-600 space-y-2 leading-relaxed">
                        <p>
                            <strong class="text-gray-900 font-semibold">Catatan interpretasi KPI:</strong> Nilai rata-rata cosφ dapat terlihat memenuhi batas (&gt; 0.85), namun excess kVArh tetap dapat terjadi apabila pada hari atau interval tertentu cosφ turun di bawah batas regulasi. Oleh karena itu, rentang (minimum-maksimum) cosφ ditampilkan untuk membantu mengidentifikasi fluktuasi kualitas daya.
                        </p>
                        <p class="text-gray-500 italic">
                            *Perhitungan kelebihan energi reaktif hanya dilakukan pada interval dengan faktor daya lagging (cos φ &lt; 0.85), sesuai ketentuan tarif tenaga listrik. Pada kondisi cos φ memenuhi batas regulasi, energi reaktif yang tercatat tidak dikategorikan sebagai excess meskipun secara absolut bernilai tinggi.
                        </p>
                    </div>

                    <!-- 4. Collapsible Section: Input cosφ Harian (Interaktif) -->
                    <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm">
                        <button type="button" onclick="toggleKvarhDailyInputs()"
                            class="w-full flex items-center justify-between p-4 sm:p-5 bg-gray-50 hover:bg-gray-100/80 text-left transition-colors">
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-gray-900 flex items-center gap-2">
                                    <span id="kvarh-toggle-chevron" class="text-xs text-gray-500 transition-transform">▼</span>
                                    Input cosφ Harian (interaktif) - click untuk expand collapse
                                </h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    Ubah nilai cosφ per hari. Nilai kVArh, excess, grafik, dan biaya akan terhitung otomatis.
                                </p>
                            </div>
                        </button>

                        <div id="kvarh-daily-inputs-container" class="p-4 sm:p-6 border-t border-gray-200">
                            <div id="kvarh-inputs-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-3 max-h-80 overflow-y-auto pr-1">
                                <!-- Generated via JS for Days 1 to 30 -->
                            </div>
                        </div>
                    </div>

                    <!-- 5. Grafik Harian (Matching Reference Video) -->
                    <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm space-y-4">
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                                Grafik Harian
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Batang merah menandakan hari terjadinya excess kVArh. Garis hitam menunjukkan cosφ aktual.
                            </p>
                        </div>

                        <div class="relative w-full h-80 sm:h-96">
                            <canvas id="kvarhDailyChart"></canvas>
                        </div>

                        <div class="text-xs text-gray-400 font-mono text-center sm:text-left">
                            Garis putus-putus merah = batas cosφ 0.85
                        </div>
                    </div>

                    <!-- 6. Rekap Detail 30 Hari Table (Matching Reference Video) -->
                    <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm space-y-4">
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir'] flex items-center gap-2">
                                <span class="text-xs text-gray-400">▼</span> Rekap Detail 30 Hari
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Digunakan untuk audit: hari penyebab excess dan kontribusinya terhadap total biaya.
                            </p>
                        </div>

                        <div class="overflow-x-auto border border-gray-200 rounded-xl">
                            <table class="w-full text-left text-xs text-gray-700">
                                <thead class="bg-gray-50 text-gray-600 font-bold border-b border-gray-200 font-sans">
                                    <tr>
                                        <th class="py-3 px-4">Hari</th>
                                        <th class="py-3 px-4 text-right">kWh</th>
                                        <th class="py-3 px-4 text-right">kVArh</th>
                                        <th class="py-3 px-4 text-right">Batas 62%</th>
                                        <th class="py-3 px-4 text-right">Excess</th>
                                        <th class="py-3 px-4 text-center">cosφ</th>
                                        <th class="py-3 px-4 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="kvarh-table-body" class="divide-y divide-gray-100 font-mono">
                                    <!-- 30 Rows generated dynamically -->
                                </tbody>
                                <tfoot class="bg-gray-50 font-bold border-t-2 border-gray-300 font-mono text-gray-900">
                                    <tr id="kvarh-table-foot">
                                        <td class="py-3 px-4 font-sans uppercase">TOTAL</td>
                                        <td class="py-3 px-4 text-right" id="kvarh-foot-kwh">1201000</td>
                                        <td class="py-3 px-4 text-right" id="kvarh-foot-kvarh">744313</td>
                                        <td class="py-3 px-4 text-right">-</td>
                                        <td class="py-3 px-4 text-right" id="kvarh-foot-excess">0</td>
                                        <td class="py-3 px-4 text-center" id="kvarh-foot-cosphi">0.85</td>
                                        <td class="py-3 px-4 text-center" id="kvarh-foot-status"><span class="text-emerald-600 font-sans font-bold">OK</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- 7. Hubungan cosφ, kVArh & Biaya Educational Formula (Matching Reference Video) -->
                    <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm space-y-4">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 font-['Agrandir']">
                            Hubungan cosφ, kVArh &amp; Biaya
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            Energi reaktif (Q) berbanding lurus dengan tan φ. Saat cosφ turun, sudut φ membesar sehingga kVArh meningkat.
                        </p>
                        <div class="p-4 rounded-xl bg-gray-100/80 border border-gray-200/90 font-mono text-xs sm:text-sm text-gray-800">
                            <strong>Q = P × tan(φ)</strong> dengan <strong>φ = arccos(cosφ)</strong>
                        </div>
                        <ul class="text-xs sm:text-sm text-gray-600 space-y-1.5 list-disc list-inside">
                            <li><span class="font-medium text-gray-800">cosφ rendah → kVArh tinggi</span></li>
                            <li><span class="font-medium text-gray-800">kVArh &gt; 62% kWh → excess</span></li>
                            <li><span class="font-medium text-gray-800">Excess × tarif → biaya tambahan PLN</span></li>
                        </ul>
                        <div class="text-xs text-gray-400 pt-2 border-t border-gray-100">
                            Rujukan: Permen ESDM tarif tenaga listrik, IEEE Std 1459, IEC 61000.
                        </div>
                        <div class="text-right text-[11px] text-gray-400 pt-2 font-mono">
                            <span>Copyright © 2026 PT. Global Aspect Technology</span>
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
        let activeSimDomain = "{{ $currentDomain }}";

        function switchSimulator(domainId) {
            activeSimDomain = domainId;
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
            if (domainId === 'automotive') {
                setTimeout(() => {
                    if (hasCalculatedOEE && lastCalculatedOEEVals) {
                        updateOEEVisuals(lastCalculatedOEEVals);
                    }
                    initOEEChart();
                }, 60);
            }
            if (domainId === 'pharma' || domainId === 'enpi') {
                setTimeout(() => {
                    initExtendedEnPICharts();
                }, 60);
            }
            if (domainId === 'bms') {
                setTimeout(() => {
                    if (eisHasCalculated) {
                        calculateEisForm(false);
                    }
                }, 60);
            }
            if (domainId === 'logistics' || domainId === 'kvarh') {
                setTimeout(() => {
                    initKvarhSimulator();
                }, 60);
            }

            if (window.history && window.history.replaceState) {
                window.history.replaceState({}, '', '/simulator/' + domainId);
            }
        }

        /* ========================================================================= */
        /* SIMULATOR 1: INSPECTION BOTTLE SIMULATOR ENGINE                     */
        /* ========================================================================= */
        const bottleSim = {
            running: false, // Idle/stopped initially until user clicks Start
            animId: null,
            lastTimestamp: 0,
            bottles: [], // Empty initially - no bottles on conveyor until started
            spawnTimer: 0
        };

        function getBottleSimParams() {
            const cv1_speed = parseFloat(document.getElementById('cv1-speed')?.value) || 433;
            const cv1_cpm = parseFloat(document.getElementById('cv1-cpm')?.value) || 600;
            const cv1_len = parseFloat(document.getElementById('cv1-length')?.value) || 3000;

            const cv2_speed = parseFloat(document.getElementById('cv2-speed')?.value) || 500;
            const cv2_len = parseFloat(document.getElementById('cv2-length')?.value) || 1000;

            const cv3_speed = parseFloat(document.getElementById('cv3-speed')?.value) || 500;
            const cv3_len = parseFloat(document.getElementById('cv3-length')?.value) || 2000;

            const cam_pos = parseFloat(document.getElementById('cam-pos')?.value) || 250;
            const cam_len = parseFloat(document.getElementById('cam-len')?.value) || 80;
            const cam_offset = parseFloat(document.getElementById('cam-offset')?.value) || 52;
            const cam_speed = parseFloat(document.getElementById('cam-speed')?.value) || 750;

            const bps = cv1_cpm > 0 ? (cv1_cpm / 60) : 10;
            const cv1_spacing = bps > 0 ? (cv1_speed / bps) : 43.3;
            const cv2_spacing = bps > 0 ? (cv2_speed / bps) : 50.0;
            const cv3_spacing = bps > 0 ? (cv3_speed / bps) : 50.0;
            const cv2_time = cv2_speed > 0 ? (cv2_spacing / cv2_speed) : 0.10;
            const cam_time = cam_speed > 0 ? (cam_len / cam_speed) : 0.11;

            return {
                cv1_speed,
                cv1_cpm,
                cv1_len,
                cv1_spacing,
                cv2_speed,
                cv2_len,
                cv2_spacing,
                cv2_time,
                cv3_speed,
                cv3_len,
                cv3_spacing,
                cam_pos,
                cam_len,
                cam_offset,
                cam_speed,
                cam_time,
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
            canvas.height = 390 * dpr;
        }

        function drawBottleSilhouette(ctx, bx, baselineY, inCam) {
            const halfW = 7;
            const neckHalfW = 3;
            const capHalfW = 4;
            const bodyTopY = baselineY - 22;
            const shoulderTopY = baselineY - 30;
            const neckTopY = baselineY - 37;
            const capTopY = baselineY - 44;

            ctx.save();

            // 1. Bottle Body & Neck
            ctx.beginPath();
            ctx.moveTo(bx - halfW + 1.5, baselineY);
            ctx.quadraticCurveTo(bx - halfW, baselineY, bx - halfW, baselineY - 1.5);
            ctx.lineTo(bx - halfW, bodyTopY);
            ctx.quadraticCurveTo(bx - halfW, shoulderTopY + 2, bx - neckHalfW, shoulderTopY);
            ctx.lineTo(bx - neckHalfW, neckTopY);
            ctx.lineTo(bx + neckHalfW, neckTopY);
            ctx.lineTo(bx + neckHalfW, shoulderTopY);
            ctx.quadraticCurveTo(bx + halfW, shoulderTopY + 2, bx + halfW, bodyTopY);
            ctx.lineTo(bx + halfW, baselineY - 1.5);
            ctx.quadraticCurveTo(bx + halfW, baselineY, bx + halfW - 1.5, baselineY);
            ctx.closePath();

            if (inCam) {
                ctx.fillStyle = 'rgba(245, 158, 11, 0.28)';
                ctx.strokeStyle = '#f59e0b';
                ctx.lineWidth = 1.4;
            } else {
                ctx.fillStyle = 'rgba(51, 103, 165, 0.42)';
                ctx.strokeStyle = '#3367A5';
                ctx.lineWidth = 1.2;
            }
            ctx.fill();
            ctx.stroke();

            // 2. Bottle Cap
            const capH = 6;
            const capW = capHalfW * 2;
            ctx.beginPath();
            ctx.rect(bx - capHalfW, capTopY, capW, capH);
            ctx.fillStyle = inCam ? '#d97706' : '#1e293b';
            ctx.fill();
            ctx.strokeStyle = inCam ? '#f59e0b' : '#0f172a';
            ctx.lineWidth = 1;
            ctx.stroke();

            // 3. Label Band on Body
            const labelTopY = baselineY - 19;
            const labelH = 10;
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.fillRect(bx - halfW + 1, labelTopY, (halfW - 1) * 2, labelH);
            ctx.fillStyle = inCam ? '#f59e0b' : '#3367A5';
            ctx.fillRect(bx - halfW + 1, labelTopY + 3.5, (halfW - 1) * 2, 2.5);

            // 4. Optical Inspection Reticle & Laser Scan Bounding Box (when inside Camera Zone)
            if (inCam) {
                // Target ROI Bounding Box with dashed amber border
                ctx.setLineDash([2, 2]);
                ctx.strokeStyle = '#f59e0b';
                ctx.lineWidth = 1;
                const roiPadX = 3.5;
                const roiPadY = 3.5;
                const rx = bx - halfW - roiPadX;
                const ry = capTopY - roiPadY;
                const rw = (halfW + roiPadX) * 2;
                const rh = (baselineY - capTopY) + roiPadY;

                ctx.strokeRect(rx, ry, rw, rh);
                ctx.setLineDash([]);

                // Corner crosshair brackets
                const cLen = 2.5;
                ctx.strokeStyle = '#d97706';
                ctx.lineWidth = 1.2;
                ctx.beginPath();
                // Top-left
                ctx.moveTo(rx - 1, ry + cLen);
                ctx.lineTo(rx - 1, ry - 1);
                ctx.lineTo(rx + cLen, ry - 1);
                // Top-right
                ctx.moveTo(rx + rw - cLen, ry - 1);
                ctx.lineTo(rx + rw + 1, ry - 1);
                ctx.lineTo(rx + rw + 1, ry + cLen);
                // Bottom-left
                ctx.moveTo(rx - 1, ry + rh - cLen);
                ctx.lineTo(rx - 1, ry + rh + 1);
                ctx.lineTo(rx + cLen, ry + rh + 1);
                // Bottom-right
                ctx.moveTo(rx + rw - cLen, ry + rh + 1);
                ctx.lineTo(rx + rw + 1, ry + rh + 1);
                ctx.lineTo(rx + rw + 1, ry + rh - cLen);
                ctx.stroke();

                // Red optical laser fill-level inspection line across neck/shoulder
                ctx.strokeStyle = '#ef4444';
                ctx.lineWidth = 1.2;
                ctx.beginPath();
                ctx.moveTo(bx - halfW - 2, shoulderTopY);
                ctx.lineTo(bx + halfW + 2, shoulderTopY);
                ctx.stroke();
            }

            ctx.restore();
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
                const baselineY = Math.round(h * 0.74);

                function mmToPx(mm) {
                    return padX + (mm / p.total_len) * drawW;
                }

                const camStartMm = p.cv1_len + p.cam_pos;
                const camEndMm = camStartMm + p.cam_len;

                // --- PHYSICS UPDATE (ONLY WHEN RUNNING) ---
                if (bottleSim.running && dt > 0) {
                    // 1. Spawning bottles at CV1 entrance based on CPM
                    const ratePerSec = p.cv1_cpm > 0 ? (p.cv1_cpm / 60) : 2.17;
                    const spawnInterval = 1 / ratePerSec;
                    bottleSim.spawnTimer += dt;

                    const minGapMm = 80; // Minimum physical spacing between bottle silhouettes

                    if (bottleSim.spawnTimer >= spawnInterval) {
                        const firstBottle = bottleSim.bottles[0];
                        // Only spawn if entrance at pos 0 is clear
                        if (!firstBottle || firstBottle.pos >= Math.max(minGapMm, p.cv1_spacing * 0.85)) {
                            bottleSim.bottles.unshift({
                                pos: 0,
                                inCam: false
                            });
                            bottleSim.spawnTimer = 0;
                        }
                    }

                    // 2. Move existing bottles (from rightmost to leftmost so each respects the one ahead)
                    let prevPosAhead = Infinity;
                    let hasBottleInCam = false;

                    for (let i = bottleSim.bottles.length - 1; i >= 0; i--) {
                        const b = bottleSim.bottles[i];
                        b.inCam = false;

                        // Determine current speed based on conveyor zone
                        let currentSpeed = p.cv1_speed;
                        if (b.pos < p.cv1_len) {
                            currentSpeed = p.cv1_speed;
                        } else if (b.pos >= camStartMm && b.pos <= camEndMm) {
                            if (!hasBottleInCam) {
                                currentSpeed = p.cam_speed;
                                b.inCam = true;
                                hasBottleInCam = true;
                            } else {
                                currentSpeed = p.cv2_speed;
                                b.inCam = false;
                            }
                        } else if (b.pos < p.cv1_len + p.cv2_len) {
                            currentSpeed = p.cv2_speed;
                        } else {
                            currentSpeed = p.cv3_speed;
                        }

                        // Move forward smoothly without overlapping the bottle ahead
                        const desiredPos = b.pos + (currentSpeed * dt);
                        const maxAllowablePos = prevPosAhead - minGapMm;
                        b.pos = Math.min(desiredPos, maxAllowablePos);

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

                // 2. Camera Zone Bracket - Amber / Orange
                const camPxX = mmToPx(camStartMm);
                const camPxW = Math.max(26, mmToPx(camEndMm) - camPxX);
                const camH = Math.max(52, p.cam_offset || 52);

                ctx.fillStyle = 'rgba(245, 158, 11, 0.16)';
                ctx.strokeStyle = '#f59e0b';
                ctx.lineWidth = 2;
                ctx.fillRect(camPxX, baselineY - camH, camPxW, camH);
                ctx.strokeRect(camPxX, baselineY - camH, camPxW, camH);

                // Camera Zone text centered directly above orange camera box (matching video)
                ctx.fillStyle = '#d97706';
                ctx.font = 'bold 9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(`Camera Zone: ${(p.cam_len / 1000).toFixed(2)} m`, camPxX + (camPxW / 2), baselineY - camH - 8);

                // Camera Zone Sub-labels below line
                ctx.fillStyle = '#d97706';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(`Speed: ${p.cam_speed} mm/s`, camPxX + (camPxW / 2), baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv2_spacing.toFixed(1)} mm`, camPxX + (camPxW / 2), baselineY + 31);

                // 3. Main Conveyor Belt Baseline
                ctx.beginPath();
                ctx.moveTo(padX, baselineY);
                ctx.lineTo(padX + drawW, baselineY);
                ctx.strokeStyle = '#1e293b';
                ctx.lineWidth = 2;
                ctx.stroke();

                // 4. Annotations
                // CV1 Labels (elevated above standing bottle silhouettes)
                const cv1MidX = mmToPx(p.cv1_len * 0.5);
                ctx.textAlign = 'center';
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV1: ${(p.cv1_len / 1000).toFixed(2)} m`, cv1MidX, baselineY - 60);

                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv1_speed} mm/s`, cv1MidX, baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv1_spacing.toFixed(1)} mm`, cv1MidX, baselineY + 31);

                // CV2 Labels (stacked high above camera matching Image 2 reference)
                const cv2MidX = mmToPx(p.cv1_len + (p.cv2_len * 0.5));
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV2: ${(p.cv2_len / 1000).toFixed(2)} m`, cv2MidX, baselineY - 128);
                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv2_speed} mm/s`, cv2MidX, baselineY - 114);
                ctx.fillText(`Spacing: ${p.cv2_spacing.toFixed(1)} mm`, cv2MidX, baselineY - 100);

                // CV3 Labels (elevated above standing bottle silhouettes)
                const cv3MidX = mmToPx(p.cv1_len + p.cv2_len + (p.cv3_len * 0.5));
                ctx.fillStyle = '#0f172a';
                ctx.font = 'bold 10px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`CV3: ${(p.cv3_len / 1000).toFixed(2)} m`, cv3MidX, baselineY - 60);

                ctx.fillStyle = '#475569';
                ctx.font = '9.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
                ctx.fillText(`Speed: ${p.cv3_speed} mm/s`, cv3MidX, baselineY + 18);
                ctx.fillText(`Spacing: ${p.cv3_spacing.toFixed(1)} mm`, cv3MidX, baselineY + 31);

                // 5. Draw Moving Standing Bottle Silhouettes
                let inCamCount = 0;

                bottleSim.bottles.forEach(b => {
                    const bx = mmToPx(b.pos);
                    if (b.inCam) inCamCount++;

                    drawBottleSilhouette(ctx, bx, baselineY, b.inCam);
                });

                // 6. Update Live UI Counters in Parameter Cards
                const camBottlesEl = document.getElementById('cam-bottles-text');
                if (camBottlesEl) camBottlesEl.textContent = inCamCount;

                ctx.restore();
            }

            bottleSim.animId = requestAnimationFrame(renderBottleSim);
        }

        function startBottleSim() {
            if (!requireSimulationLeadGate(startBottleSim)) return;
            bottleSim.running = true;
            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'RUNNING';
                statusPill.className =
                    'px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200';
            }
        }

        function stopBottleSim() {
            bottleSim.running = false;
            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'STOPPED';
                statusPill.className =
                    'px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300';
            }
        }

        function resetBottleSim() {
            bottleSim.running = false;
            bottleSim.bottles = [];
            bottleSim.spawnTimer = 0;

            const camBottlesEl = document.getElementById('cam-bottles-text');
            if (camBottlesEl) camBottlesEl.textContent = '0';

            const statusPill = document.getElementById('bottleSimStatusPill');
            if (statusPill) {
                statusPill.textContent = 'STOPPED';
                statusPill.className =
                    'px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-100 text-neutral-600 border border-neutral-300';
            }
            updateBottleParamDisplays();
        }

        // Attach dynamic input listeners to recalculate spacing & time in real-time
        document.addEventListener('DOMContentLoaded', () => {
            const inputIds = [
                'cv1-speed', 'cv1-cpm', 'cv1-length',
                'cv2-speed', 'cv2-length',
                'cv3-speed', 'cv3-length',
                'cam-pos', 'cam-len', 'cam-offset', 'cam-speed'
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

            // Simulator 2: OEE Inputs & History Chart on DOM Ready (Only calculates on "Hitung OEE" click)
            const oeeInputIds = ['oee-shift', 'oee-downtime', 'oee-cycle-time', 'oee-good', 'oee-reject'];
            oeeInputIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            calculateOEE();
                        }
                    });
                }
            });

            // Simulator 3: EnPI Calculator (Extended + Carbon Credit) - Real-time listeners initialized in initExtendedEnPICharts()

            // Initialize Charts on DOM Ready
            initOEEChart();
            initExtendedEnPICharts();
        });

        /* ========================================================================= */
        /* SIMULATOR 2: OEE PRODUCTION SIMULATOR                              */
        /* ========================================================================= */
        let hasCalculatedOEE = false;
        let lastCalculatedOEEVals = null;
        let oeeChart = null;
        let oeeChartMode = 'OEE'; // 'OEE' or 'APQ'
        let oeeHistoryData = []; // Starts clean/empty at 0

        function getOEEInputs() {
            const shift = document.getElementById('oee-shift')?.value || 'Siang';
            const downtime = Math.max(0, parseFloat(document.getElementById('oee-downtime')?.value) || 0);
            const cycleTime = Math.max(0, parseFloat(document.getElementById('oee-cycle-time')?.value) || 0);
            const good = Math.max(0, Math.floor(parseFloat(document.getElementById('oee-good')?.value) || 0));
            const reject = Math.max(0, Math.floor(parseFloat(document.getElementById('oee-reject')?.value) || 0));

            // Standard Shift Duration: 8 hours = 480 minutes
            const plannedTime = 480;
            const totalCount = good + reject;

            // Target units = Planned Time (480) / Ideal Cycle Time
            const target = cycleTime > 0 ? Math.round(plannedTime / cycleTime) : 0;
            const actual = totalCount;

            // Operating Time = Planned Time - Downtime (clamped to min 0)
            const operatingTime = Math.max(0, plannedTime - downtime);

            // If empty/zero state (initial load before input)
            const isUninitialized = (totalCount === 0 && cycleTime === 0);

            // Availability = (Operating Time / Planned Time) * 100%
            const avail = isUninitialized ? 0 : (plannedTime > 0 ? Math.min(100, Math.max(0, (operatingTime / plannedTime) *
                100)) : 0);

            // Performance = ((Ideal Cycle Time * Total Count) / Operating Time) * 100%
            const perf = (isUninitialized || operatingTime === 0 || cycleTime === 0) ? 0 : ((cycleTime * totalCount) /
                operatingTime) * 100;

            // Quality = (Good Count / Total Count) * 100%
            const quality = (isUninitialized || totalCount === 0) ? 0 : Math.min(100, Math.max(0, (good / totalCount) *
                100));

            // Overall OEE = (Availability * Performance * Quality) / 10000
            const oee = (avail * perf * quality) / 10000;

            // Gap = Expected units during operating time - Total produced
            const expectedOperatingTarget = cycleTime > 0 ? (operatingTime / cycleTime) : 0;
            const gap = isUninitialized ? 0 : (expectedOperatingTarget - totalCount);

            return {
                shift,
                downtime,
                cycleTime,
                good,
                reject,
                plannedTime,
                totalCount,
                operatingTime,
                target,
                actual,
                avail,
                perf,
                quality,
                oee,
                gap,
                isUninitialized
            };
        }

        function updateOEEVisuals(vals) {
            if (!vals) vals = getOEEInputs();

            // 1. Update Output Card (Target & Actual horizontal bar diagram)
            const targetEl = document.getElementById('oee-target-val');
            const targetBar = document.getElementById('oee-target-bar');
            const actualEl = document.getElementById('oee-actual-val');
            const actualBar = document.getElementById('oee-actual-bar');
            const goodDisp = document.getElementById('oee-good-display');

            if (targetEl) targetEl.textContent = vals.target;
            if (actualEl) actualEl.textContent = vals.actual;
            if (goodDisp) goodDisp.textContent = vals.good;

            const maxScale = Math.max(vals.target, vals.actual, 1);
            if (targetBar) {
                const w = vals.target > 0 ? Math.min(100, Math.max(12, Math.round((vals.target / (maxScale * 1.15)) *
                    100))) : 0;
                targetBar.style.width = w + '%';
            }
            if (actualBar) {
                const w = vals.actual > 0 ? Math.min(100, Math.max(12, Math.round((vals.actual / (maxScale * 1.15)) *
                    100))) : 0;
                actualBar.style.width = w + '%';
            }

            // 2. Update Hasil Perhitungan (Overall OEE Score & Color)
            const oeeEl = document.getElementById('oee-overall-val');
            if (oeeEl) {
                oeeEl.textContent = vals.oee.toFixed(1) + '%';
                if (vals.isUninitialized || vals.oee === 0) {
                    oeeEl.className =
                        "text-4xl sm:text-5xl font-extrabold text-gray-400 font-['Agrandir'] tracking-tight mt-1 font-mono transition-colors duration-300";
                } else if (vals.oee >= 85) {
                    oeeEl.className =
                        "text-4xl sm:text-5xl font-extrabold text-[#16a34a] font-['Agrandir'] tracking-tight mt-1 font-mono transition-colors duration-300";
                } else if (vals.oee >= 65) {
                    oeeEl.className =
                        "text-4xl sm:text-5xl font-extrabold text-[#f59e0b] font-['Agrandir'] tracking-tight mt-1 font-mono transition-colors duration-300";
                } else {
                    oeeEl.className =
                        "text-4xl sm:text-5xl font-extrabold text-[#ef4444] font-['Agrandir'] tracking-tight mt-1 font-mono transition-colors duration-300";
                }
            }

            // 3. Update 3 Donut SVG Gauges (Availability, Performance, Quality)
            // SVG Circle radius r=14 -> Circumference = 2 * PI * 14 ≈ 88
            const circ = 88;
            const circleAvail = document.getElementById('oee-circle-avail');
            const circlePerf = document.getElementById('oee-circle-perf');
            const circleQual = document.getElementById('oee-circle-qual');

            const availNum = document.getElementById('oee-avail-num');
            const perfNum = document.getElementById('oee-perf-num');
            const qualityNum = document.getElementById('oee-quality-num');

            if (availNum) {
                availNum.textContent = Math.round(vals.avail);
                availNum.className = (vals.isUninitialized || vals.avail === 0) ?
                    "absolute text-xs sm:text-sm font-bold text-gray-400 font-mono" :
                    "absolute text-xs sm:text-sm font-bold text-gray-800 font-mono";
            }
            if (perfNum) {
                perfNum.textContent = Math.round(vals.perf);
                perfNum.className = (vals.isUninitialized || vals.perf === 0) ?
                    "absolute text-xs sm:text-sm font-bold text-gray-400 font-mono" :
                    "absolute text-xs sm:text-sm font-bold text-gray-800 font-mono";
            }
            if (qualityNum) {
                qualityNum.textContent = Math.round(vals.quality);
                qualityNum.className = (vals.isUninitialized || vals.quality === 0) ?
                    "absolute text-xs sm:text-sm font-bold text-gray-400 font-mono" :
                    "absolute text-xs sm:text-sm font-bold text-gray-800 font-mono";
            }

            if (circleAvail) {
                const availOffset = vals.avail > 0 ? Math.max(0, circ - (Math.min(100, Math.max(0, vals.avail)) / 100) *
                    circ) : circ;
                circleAvail.setAttribute('stroke-dashoffset', availOffset.toFixed(2));
                circleAvail.style.strokeDashoffset = availOffset.toFixed(2);
            }
            if (circlePerf) {
                const perfOffset = vals.perf > 0 ? Math.max(0, circ - (Math.min(100, Math.max(0, vals.perf)) / 100) *
                    circ) : circ;
                circlePerf.setAttribute('stroke-dashoffset', perfOffset.toFixed(2));
                circlePerf.style.strokeDashoffset = perfOffset.toFixed(2);
            }
            if (circleQual) {
                const qualOffset = vals.quality > 0 ? Math.max(0, circ - (Math.min(100, Math.max(0, vals.quality)) / 100) *
                    circ) : circ;
                circleQual.setAttribute('stroke-dashoffset', qualOffset.toFixed(2));
                circleQual.style.strokeDashoffset = qualOffset.toFixed(2);
            }

            // 4. Update Summary Info (Downtime, Gap, Reject)
            const dtEl = document.getElementById('oee-summary-downtime');
            const gapEl = document.getElementById('oee-summary-gap');
            const rejEl = document.getElementById('oee-summary-reject');

            if (dtEl) dtEl.textContent = vals.downtime + 'm';
            if (gapEl) {
                if (vals.isUninitialized || vals.gap === 0) {
                    gapEl.textContent = '0.0';
                    gapEl.className = 'font-bold text-gray-500 font-mono';
                } else {
                    gapEl.textContent = (vals.gap > 0 ? '+' : '') + vals.gap.toFixed(1);
                    gapEl.className = vals.gap < 0 ? 'font-bold text-red-600 font-mono' :
                        'font-bold text-green-600 font-mono';
                }
            }
            if (rejEl) rejEl.textContent = vals.reject;
        }

        function initOEEChart() {
            const ctx = document.getElementById('oee-history-chart');
            if (!ctx) return;

            if (oeeChart) {
                oeeChart.destroy();
                oeeChart = null;
            }

            const labels = oeeHistoryData.map(d => d.time);

            let datasets = [];
            if (oeeChartMode === 'OEE') {
                datasets = [{
                    label: 'OEE (%)',
                    data: oeeHistoryData.map(d => d.oee),
                    backgroundColor: '#22c55e',
                    borderColor: '#16a34a',
                    borderWidth: 1,
                    borderRadius: 4,
                    barPercentage: 0.5,
                    categoryPercentage: 0.7
                }];
            } else {
                datasets = [{
                        label: 'Availability (%)',
                        data: oeeHistoryData.map(d => d.avail),
                        backgroundColor: '#f97316',
                        borderColor: '#ea580c',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Performance (%)',
                        data: oeeHistoryData.map(d => d.perf),
                        backgroundColor: '#6366f1',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Quality (%)',
                        data: oeeHistoryData.map(d => d.quality),
                        backgroundColor: '#10b981',
                        borderColor: '#059669',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ];
            }

            oeeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 400
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 14,
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#334155'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label} ${context.parsed.y}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 150,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b',
                                stepSize: 20
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        }

        function updateOEEChart() {
            if (!oeeChart) {
                initOEEChart();
                return;
            }

            oeeChart.data.labels = oeeHistoryData.map(d => d.time);
            if (oeeChartMode === 'OEE') {
                oeeChart.data.datasets = [{
                    label: 'OEE (%)',
                    data: oeeHistoryData.map(d => d.oee),
                    backgroundColor: '#22c55e',
                    borderColor: '#16a34a',
                    borderWidth: 1,
                    borderRadius: 4,
                    barPercentage: 0.5,
                    categoryPercentage: 0.7
                }];
            } else {
                oeeChart.data.datasets = [{
                        label: 'Availability (%)',
                        data: oeeHistoryData.map(d => d.avail),
                        backgroundColor: '#f97316',
                        borderColor: '#ea580c',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Performance (%)',
                        data: oeeHistoryData.map(d => d.perf),
                        backgroundColor: '#6366f1',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Quality (%)',
                        data: oeeHistoryData.map(d => d.quality),
                        backgroundColor: '#10b981',
                        borderColor: '#059669',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ];
            }
            oeeChart.update();
        }

        function toggleOEEChartMode() {
            oeeChartMode = oeeChartMode === 'OEE' ? 'APQ' : 'OEE';
            const btn = document.getElementById('oee-switch-chart-btn');
            if (btn) {
                if (oeeChartMode === 'OEE') {
                    btn.textContent = 'Switch to APQ';
                    btn.className =
                        "px-4 py-2 bg-[#ef4444] hover:bg-[#dc2626] text-white text-xs font-bold rounded-lg transition-colors shadow-sm font-['Agrandir']";
                } else {
                    btn.textContent = 'Switch to OEE';
                    btn.className =
                        "px-4 py-2 bg-[#3367A5] hover:bg-[#285284] text-white text-xs font-bold rounded-lg transition-colors shadow-sm font-['Agrandir']";
                }
            }
            initOEEChart();
        }

        function calculateOEE() {
            if (!requireSimulationLeadGate(calculateOEE)) return;
            const vals = getOEEInputs();

            // If user clicks without entering any data (all 0)
            if (vals.totalCount === 0 && vals.cycleTime === 0) {
                const btn = document.getElementById('oee-calc-btn');
                const btnText = document.getElementById('oee-calc-text');
                if (btn && btnText) {
                    const originalText = btnText.textContent;
                    btnText.textContent = 'Masukkan data terlebih dahulu!';
                    btn.classList.remove('bg-[#16a34a]', 'hover:bg-[#15803d]');
                    btn.classList.add('bg-amber-600', 'hover:bg-amber-700');
                    setTimeout(() => {
                        btnText.textContent = originalText;
                        btn.classList.remove('bg-amber-600', 'hover:bg-amber-700');
                        btn.classList.add('bg-[#16a34a]', 'hover:bg-[#15803d]');
                    }, 1500);
                }
                return;
            }

            hasCalculatedOEE = true;
            lastCalculatedOEEVals = vals;
            updateOEEVisuals(vals);

            // Button Feedback Animation
            const btn = document.getElementById('oee-calc-btn');
            const btnText = document.getElementById('oee-calc-text');
            const btnIcon = document.getElementById('oee-calc-icon');

            if (btn && btnText) {
                btnText.textContent = 'Kalkulasi Selesai';
                btn.classList.add('bg-emerald-700');
                if (btnIcon) btnIcon.classList.add('rotate-180');
                setTimeout(() => {
                    btnText.textContent = 'Hitung OEE';
                    btn.classList.remove('bg-emerald-700');
                    if (btnIcon) btnIcon.classList.remove('rotate-180');
                }, 1000);
            }

            // Timestamp formatting
            const now = new Date();
            const timeStr = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const newRecord = {
                time: timeStr,
                shift: vals.shift,
                good: vals.good,
                reject: vals.reject,
                avail: parseFloat(vals.avail.toFixed(1)),
                perf: parseFloat(vals.perf.toFixed(1)),
                quality: parseFloat(vals.quality.toFixed(1)),
                oee: parseFloat(vals.oee.toFixed(1))
            };

            oeeHistoryData.push(newRecord);
            if (oeeHistoryData.length > 10) {
                oeeHistoryData.shift();
            }

            const tbody = document.getElementById('oee-history-tbody');
            if (tbody) {
                const emptyRow = document.getElementById('oee-empty-row');
                if (emptyRow) {
                    emptyRow.remove();
                }

                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors bg-emerald-50/70 duration-700';
                row.innerHTML = `
                    <td class="py-2.5 px-3 text-gray-700 font-medium">${newRecord.time}</td>
                    <td class="py-2.5 px-3 text-gray-800 font-sans font-medium">${newRecord.shift}</td>
                    <td class="py-2.5 px-3 text-right font-medium">${newRecord.good}</td>
                    <td class="py-2.5 px-3 text-right text-red-600 font-medium">${newRecord.reject}</td>
                    <td class="py-2.5 px-3 text-right">${newRecord.avail.toFixed(1)}</td>
                    <td class="py-2.5 px-3 text-right">${newRecord.perf.toFixed(1)}</td>
                    <td class="py-2.5 px-3 text-right">${newRecord.quality.toFixed(1)}</td>
                    <td class="py-2.5 px-3 text-right font-bold text-[#16a34a]">${newRecord.oee.toFixed(1)}</td>
                `;
                tbody.prepend(row);
                setTimeout(() => {
                    row.classList.remove('bg-emerald-50/70');
                }, 1500);
            }

            updateOEEChart();
        }

        /* ========================================================================= */
        /* SIMULATOR 3: ENPI KALKULATOR (EXTENDED + CARBON CREDIT)                   */
        /* ========================================================================= */
        let enpiExtChart1 = null;
        let enpiExtChart2 = null;
        let enpiDebounceTimer = null;
        let hasCalculatedEnPI = false;

        function switchEnPITab(tabName) {
            const tabs = ['ringkasan', 'kesimpulan', 'help'];
            tabs.forEach(t => {
                const pane = document.getElementById(`enpi-tab-pane-${t}`);
                const btn = document.getElementById(`enpi-tab-btn-${t}`);
                if (pane && btn) {
                    if (t === tabName) {
                        pane.classList.remove('hidden');
                        btn.className =
                            'px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-[#007bff] text-white shadow-sm font-sans';
                    } else {
                        pane.classList.add('hidden');
                        btn.className =
                            'px-4 py-1.5 rounded-lg text-xs font-bold transition-all bg-[#c2c5c9] text-white hover:bg-gray-400 font-sans';
                    }
                }
            });
        }

        function triggerRealtimeEnPI(immediate = false) {
            // If user has not clicked "Hitung EnPI" yet, do NOT auto-reveal results
            if (!hasCalculatedEnPI) return;

            if (immediate) {
                if (enpiDebounceTimer) clearTimeout(enpiDebounceTimer);
                calculateExtendedEnPI(false);
                return;
            }
            clearTimeout(enpiDebounceTimer);
            enpiDebounceTimer = setTimeout(() => {
                calculateExtendedEnPI(false);
            }, 200);
        }

        function calculateExtendedEnPI(isManualTrigger = false) {
            if (isManualTrigger) {
                if (!requireSimulationLeadGate(() => calculateExtendedEnPI(true))) return;
            }
            const rawText = document.getElementById('enpi-ext-raw')?.value.trim() || '';
            const baseline = parseFloat(document.getElementById('enpi-ext-baseline')?.value) || 11.0;
            const targetProd = parseFloat(document.getElementById('enpi-ext-target-prod')?.value) || 100;
            const emissionFactor = parseFloat(document.getElementById('enpi-ext-emission-factor')?.value) || 0.82;
            const tariff = parseFloat(document.getElementById('enpi-ext-tariff')?.value) || 1600;
            const carbonPrice = parseFloat(document.getElementById('enpi-ext-carbon-price')?.value) || 10;

            const lines = rawText.split('\n').map(l => l.trim()).filter(l => l.length > 0);
            const parsedData = [];

            for (const line of lines) {
                const sep = line.includes(';') ? ';' : (line.includes('\t') ? '\t' : ',');
                const parts = line.split(sep);
                if (parts.length >= 3) {
                    const date = parts[0].trim();
                    const energy = parseFloat(parts[1].trim());
                    const production = parseFloat(parts[2].trim());
                    if (!isNaN(energy) && !isNaN(production) && production > 0) {
                        const enpi = energy / production;
                        const targetEnergy = production * baseline;
                        const isGood = enpi <= baseline;
                        parsedData.push({
                            date,
                            energy,
                            production,
                            enpi,
                            targetEnergy,
                            status: isGood ? 'Good' : 'Bad'
                        });
                    }
                }
            }

            if (parsedData.length === 0) return;

            // Mark calculation as completed and reveal result UI
            hasCalculatedEnPI = true;

            const promptEl = document.getElementById('enpi-not-calculated-prompt');
            const dataEl = document.getElementById('enpi-ringkasan-data');
            if (promptEl) promptEl.classList.add('hidden');
            if (dataEl) dataEl.classList.remove('hidden');

            const kesPromptEl = document.getElementById('enpi-kesimpulan-prompt');
            const kesDataEl = document.getElementById('enpi-kesimpulan-data');
            if (kesPromptEl) kesPromptEl.classList.add('hidden');
            if (kesDataEl) kesDataEl.classList.remove('hidden');

            const chartsPlaceholder = document.getElementById('enpi-charts-empty-placeholder');
            const chartsWrapper = document.getElementById('enpi-charts-wrapper');
            if (chartsPlaceholder) chartsPlaceholder.classList.add('hidden');
            if (chartsWrapper) chartsWrapper.classList.remove('hidden');

            // Calculations
            const totalActualEnergy = parsedData.reduce((acc, d) => acc + d.energy, 0);
            const totalBaselineEnergy = parsedData.reduce((acc, d) => acc + d.targetEnergy, 0);
            const avgEnpi = parsedData.reduce((acc, d) => acc + d.enpi, 0) / parsedData.length;

            let peak = parsedData[0];
            let best = parsedData[0];
            for (const d of parsedData) {
                if (d.enpi > peak.enpi) peak = d;
                if (d.enpi < best.enpi) best = d;
            }

            const emisiAktual = totalActualEnergy * emissionFactor;
            const emisiBaseline = totalBaselineEnergy * emissionFactor;
            const penguranganEmisi = emisiBaseline - emisiAktual; // kg CO2

            const biayaAktual = totalActualEnergy * tariff;
            const biayaBaseline = totalBaselineEnergy * tariff;
            const hematBiaya = biayaBaseline - biayaAktual;

            const penguranganEmisiTon = penguranganEmisi / 1000.0;
            const potensiCarbonCredit = penguranganEmisiTon * carbonPrice;

            // Update DOM Information Tab (Ringkasan)
            const baselineEl = document.getElementById('info-baseline-val');
            if (baselineEl) baselineEl.textContent = baseline.toFixed(2);

            const targetProdEl = document.getElementById('info-target-prod-val');
            if (targetProdEl) targetProdEl.textContent = targetProd.toLocaleString('en-US');

            const targetEnergyEl = document.getElementById('info-target-energy-val');
            if (targetEnergyEl) targetEnergyEl.textContent = Math.round(targetProd * baseline).toLocaleString('en-US');

            const avgEnpiEl = document.getElementById('info-avg-enpi-val');
            if (avgEnpiEl) avgEnpiEl.textContent = avgEnpi.toFixed(2);

            const peakValEl = document.getElementById('info-peak-val');
            if (peakValEl) peakValEl.textContent = peak.enpi.toFixed(2);

            const peakDateEl = document.getElementById('info-peak-date-val');
            if (peakDateEl) peakDateEl.textContent = peak.date;

            const bestValEl = document.getElementById('info-best-val');
            if (bestValEl) bestValEl.textContent = best.enpi.toFixed(2);

            const bestDateEl = document.getElementById('info-best-date-val');
            if (bestDateEl) bestDateEl.textContent = best.date;

            const totalActualEl = document.getElementById('info-total-actual-val');
            if (totalActualEl) totalActualEl.textContent = Math.round(totalActualEnergy).toLocaleString('en-US');

            const totalBaselineEl = document.getElementById('info-total-baseline-val');
            if (totalBaselineEl) totalBaselineEl.textContent = Math.round(totalBaselineEnergy).toLocaleString('en-US');

            const emisiAktualEl = document.getElementById('info-actual-emission-val');
            if (emisiAktualEl) emisiAktualEl.textContent = emisiAktual.toFixed(1);

            const emisiBaselineEl = document.getElementById('info-baseline-emission-val');
            if (emisiBaselineEl) emisiBaselineEl.textContent = emisiBaseline.toFixed(1);

            const emissionRedEl = document.getElementById('info-emission-reduction-val');
            if (emissionRedEl) {
                emissionRedEl.innerHTML = (penguranganEmisi >= 0 ? '+' : '') + penguranganEmisi.toFixed(1) +
                    ' kg CO<sub>2</sub>';
                emissionRedEl.className = penguranganEmisi >= 0 ? 'font-bold font-mono text-[#16a34a]' :
                    'font-bold font-mono text-[#dc2626]';
            }

            const biayaAktualEl = document.getElementById('info-actual-cost-val');
            if (biayaAktualEl) biayaAktualEl.textContent = 'Rp ' + Math.round(biayaAktual).toLocaleString('en-US');

            const biayaBaselineEl = document.getElementById('info-baseline-cost-val');
            if (biayaBaselineEl) biayaBaselineEl.textContent = 'Rp ' + Math.round(biayaBaseline).toLocaleString('en-US');

            const costSavingEl = document.getElementById('info-cost-saving-val');
            if (costSavingEl) {
                costSavingEl.textContent = 'Rp ' + (hematBiaya < 0 ? '-' : '') + Math.abs(Math.round(hematBiaya))
                    .toLocaleString('en-US');
                costSavingEl.className = hematBiaya >= 0 ? 'font-bold font-mono text-[#16a34a]' :
                    'font-bold font-mono text-[#dc2626]';
            }

            const carbonCreditEl = document.getElementById('info-carbon-credit-val');
            if (carbonCreditEl) {
                const carbonSign = potensiCarbonCredit < 0 ? '-' : '';
                const carbonTonStr = (penguranganEmisiTon < 0 ? '-' : '') + Math.abs(penguranganEmisiTon).toFixed(2);
                const carbonValStr = carbonSign + '$' + Math.abs(potensiCarbonCredit).toFixed(2);
                carbonCreditEl.innerHTML =
                    `${carbonTonStr} ton CO<sub>2</sub> &times; $${carbonPrice}/ton = ${carbonValStr}`;
            }

            // Kesimpulan Text & Alert Dynamic Update
            const msg1El = document.getElementById('enpi-kesimpulan-msg1');
            const alert1Icon = document.querySelector('#enpi-kesimpulan-alert1 span:first-child');
            const msg2El = document.getElementById('enpi-kesimpulan-msg2');
            const alert2Icon = document.querySelector('#enpi-kesimpulan-alert2 span:first-child');

            if (msg1El && msg2El) {
                if (avgEnpi > baseline) {
                    if (alert1Icon) alert1Icon.innerHTML = '&#9888;&#65039;';
                    msg1El.textContent =
                        'Kinerja energi masih di atas baseline. Diperlukan evaluasi penggunaan energi agar lebih efisien.';

                    if (alert2Icon) alert2Icon.innerHTML = '&#128184;';
                    const kenaikanBiayaStr = 'Rp ' + Math.abs(Math.round(hematBiaya)).toLocaleString('en-US');
                    const tambahanEmisiStr = Math.abs(penguranganEmisi).toFixed(1) + ' kg CO2';
                    msg2El.textContent =
                        `Terjadi kenaikan biaya energi sebesar ${kenaikanBiayaStr} dan tambahan emisi ${tambahanEmisiStr}. Perlu tindakan segera.`;
                } else {
                    if (alert1Icon) alert1Icon.innerHTML = '&#9989;';
                    msg1El.textContent =
                        'Kinerja energi telah berada di bawah baseline target. Efisiensi operasional berjalan optimal.';

                    if (alert2Icon) alert2Icon.innerHTML = '&#127793;';
                    const penghematanBiayaStr = 'Rp ' + Math.round(hematBiaya).toLocaleString('en-US');
                    const reduksiEmisiStr = penguranganEmisi.toFixed(1) + ' kg CO2';
                    msg2El.textContent =
                        `Terjadi penghematan biaya energi sebesar ${penghematanBiayaStr} dan pengurangan emisi ${reduksiEmisiStr}. Lanjutkan target efisiensi.`;
                }
            }

            // Update Table Detail
            const tbody = document.getElementById('enpi-ext-detail-tbody');
            if (tbody) {
                tbody.innerHTML = '';
                parsedData.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.className = 'hover:bg-gray-50 transition-colors border-b border-gray-100';
                    const isGood = d.status === 'Good';
                    const statusClass = isGood ? 'text-[#16a34a] font-bold' : 'text-[#dc2626] font-bold';
                    tr.innerHTML = `
                        <td class="py-2.5 px-3 text-gray-800 font-medium">${d.date}</td>
                        <td class="py-2.5 px-3 text-right font-medium text-gray-700">${Math.round(d.energy).toLocaleString('en-US')}</td>
                        <td class="py-2.5 px-3 text-right font-medium text-gray-700">${Math.round(d.production).toLocaleString('en-US')}</td>
                        <td class="py-2.5 px-3 text-right font-bold text-gray-900">${d.enpi.toFixed(2)}</td>
                        <td class="py-2.5 px-3 text-right font-medium text-gray-600">${Math.round(d.targetEnergy).toLocaleString('en-US')}</td>
                        <td class="py-2.5 px-3 text-center ${statusClass}">${d.status}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            // Button Feedback Animation
            if (isManualTrigger) {
                const btn = document.getElementById('enpi-ext-calc-btn');
                const btnText = document.getElementById('enpi-ext-calc-text');
                if (btn && btnText) {
                    btnText.textContent = 'Kalkulasi Selesai';
                    btn.classList.add('bg-blue-900');
                    setTimeout(() => {
                        btnText.textContent = 'Hitung EnPI';
                        btn.classList.remove('bg-blue-900');
                    }, 1000);
                }
            }

            // Render / Re-render Charts with Animation
            renderExtendedEnPICharts(parsedData, baseline, peak, best);
        }

        function renderExtendedEnPICharts(parsedData, baseline, peak, best) {
            const ctx1 = document.getElementById('enpi-ext-chart-enpi');
            const ctx2 = document.getElementById('enpi-ext-chart-energy');
            if (!ctx1 || !ctx2) return;

            const labels = parsedData.map(d => d.date);

            const pointColors = parsedData.map(d => {
                if (d.date === peak.date) return '#dc2626'; // Peak
                if (d.date === best.date) return '#16a34a'; // Best
                return '#2563eb';
            });
            const pointRadii = parsedData.map(d => (d.date === peak.date || d.date === best.date) ? 6 : 3.5);
            const pointStyles = parsedData.map(d => (d.date === peak.date || d.date === best.date) ? 'rect' : 'circle');

            // Chart 1: EnPI vs Baseline (Destroy and rebuild so user visibly sees the animation and adaptation!)
            if (enpiExtChart1) {
                enpiExtChart1.destroy();
            }

            enpiExtChart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                            label: 'EnPI (kWh/unit)',
                            data: parsedData.map(d => d.enpi),
                            borderColor: '#2563eb',
                            backgroundColor: '#2563eb',
                            borderWidth: 2,
                            tension: 0.2,
                            pointBackgroundColor: pointColors,
                            pointBorderColor: pointColors,
                            pointRadius: pointRadii,
                            pointStyle: pointStyles,
                            fill: false
                        },
                        {
                            label: 'Baseline EnPI',
                            data: parsedData.map(() => baseline),
                            borderColor: '#dc2626',
                            borderWidth: 1.5,
                            borderDash: [5, 5],
                            pointRadius: 0,
                            fill: false
                        },
                        {
                            label: 'Peak EnPI',
                            data: [],
                            borderColor: '#dc2626',
                            backgroundColor: '#dc2626',
                            pointStyle: 'rect',
                            pointRadius: 6,
                            showLine: false
                        },
                        {
                            label: 'Best EnPI',
                            data: [],
                            borderColor: '#16a34a',
                            backgroundColor: '#16a34a',
                            pointStyle: 'rect',
                            pointRadius: 6,
                            showLine: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 750,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 14,
                                usePointStyle: true,
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#334155'
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });

            // Chart 2: Energy Aktual vs Target Energy
            if (enpiExtChart2) {
                enpiExtChart2.destroy();
            }

            const barColors = parsedData.map(d => d.enpi > baseline ? '#fca5a5' : '#60a5fa');
            const barBorders = parsedData.map(d => d.enpi > baseline ? '#f87171' : '#3b82f6');

            enpiExtChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                            type: 'bar',
                            label: 'Energy Aktual (kWh)',
                            data: parsedData.map(d => d.energy),
                            backgroundColor: barColors,
                            borderColor: barBorders,
                            borderWidth: 1,
                            borderRadius: 2,
                            barPercentage: 0.65
                        },
                        {
                            type: 'line',
                            label: 'Target Energy (kWh)',
                            data: parsedData.map(d => d.targetEnergy),
                            borderColor: '#dc2626',
                            borderWidth: 2,
                            borderDash: [4, 4],
                            pointBackgroundColor: '#dc2626',
                            pointRadius: 2,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 750,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 14,
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#334155'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 10
                                },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        }

        function initExtendedEnPICharts() {
            // DO NOT run calculation automatically on page load so results stay hidden until user clicks "Hitung EnPI"
            hasCalculatedEnPI = false;

            // Bind real-time listener for Textarea
            const rawInput = document.getElementById('enpi-ext-raw');
            if (rawInput && !rawInput.dataset.enpiBound) {
                rawInput.dataset.enpiBound = 'true';
                rawInput.addEventListener('input', () => triggerRealtimeEnPI(false));
                rawInput.addEventListener('keyup', () => triggerRealtimeEnPI(false));
                rawInput.addEventListener('change', () => triggerRealtimeEnPI(true));
                rawInput.addEventListener('paste', () => {
                    setTimeout(() => triggerRealtimeEnPI(true), 50);
                });
            }

            // Bind real-time listener for all 5 Pengaturan inputs
            const numericInputs = [
                'enpi-ext-baseline',
                'enpi-ext-target-prod',
                'enpi-ext-emission-factor',
                'enpi-ext-tariff',
                'enpi-ext-carbon-price'
            ];

            numericInputs.forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.dataset.enpiBound) {
                    el.dataset.enpiBound = 'true';
                    el.addEventListener('input', () => triggerRealtimeEnPI(false));
                    el.addEventListener('change', () => triggerRealtimeEnPI(true));
                    el.addEventListener('keyup', () => triggerRealtimeEnPI(false));
                }
            });
        }
        /* ========================================================================= */
        /* SIMULATOR 4: EIS FORM (SMARTEK SISTEM REFERENCE)                          */
        /* ========================================================================= */
        let eisHasCalculated = false;

        function onEisDeviceStatusChange() {
            const isNew = document.querySelector('input[name="eis_device_status"]:checked')?.value === 'new';
            const optContainer = document.getElementById('eis-device-options-container');
            if (optContainer) {
                optContainer.style.opacity = isNew ? '1' : '0.4';
                optContainer.style.pointerEvents = isNew ? 'auto' : 'none';
            }
            triggerEisAutoRecalc();
        }

        function onEisModeChange(changedMode) {
            const rt = document.getElementById('eis-mode-realtime');
            const hist = document.getElementById('eis-mode-historian');
            const rep = document.getElementById('eis-mode-report');
            const retWrap = document.getElementById('eis-retention-input-wrap');

            if (changedMode === 'report' && rep.checked) {
                hist.checked = true;
                rt.checked = true;
            } else if (changedMode === 'historian' && hist.checked) {
                rt.checked = true;
            } else if (changedMode === 'realtime' && !rt.checked) {
                hist.checked = false;
                rep.checked = false;
            } else if (changedMode === 'historian' && !hist.checked) {
                rep.checked = false;
            }

            if (retWrap) {
                if (hist.checked) {
                    retWrap.classList.remove('hidden');
                } else {
                    retWrap.classList.add('hidden');
                }
            }

            triggerEisAutoRecalc();
        }

        function eisSelectAllParams(selectAll) {
            document.querySelectorAll('.eis-param').forEach(cb => {
                cb.checked = selectAll;
            });
            triggerEisAutoRecalc();
        }

        function triggerEisAutoRecalc() {
            if (eisHasCalculated) {
                calculateEisForm(false);
            }
        }

        function setEisTablesToZero() {
            const dailyEl = document.getElementById('eis-res-daily');
            const retentionEl = document.getElementById('eis-res-retention');
            const costEl = document.getElementById('eis-res-cost');
            const detailsWrap = document.getElementById('eis-summary-details-wrap');
            const emptyNotice = document.getElementById('eis-empty-notice-box');

            if (dailyEl) dailyEl.textContent = '0 GB';
            if (retentionEl) retentionEl.textContent = '0 GB';
            if (costEl) costEl.textContent = 'Rp 0';
            if (detailsWrap) detailsWrap.classList.add('hidden');
            if (emptyNotice) {
                emptyNotice.innerHTML = 'Silakan atur parameter dan klik tombol <strong class="text-gray-700">Show Summary</strong> untuk melihat hasil kalkulasi.';
                emptyNotice.classList.remove('hidden');
            }

            const capBody = document.getElementById('eis-cap-table-body');
            if (capBody) {
                capBody.innerHTML = '<tr><td colspan="7" class="py-8 text-center text-gray-400 text-xs">Belum ada kalkulasi. Silakan klik tombol <strong class="text-gray-600">Show Summary</strong> untuk melihat rincian kapasitas.</td></tr>';
            }
            const setT = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
            setT('eis-cap-total-day', '0 GB');
            setT('eis-cap-total-month', '0 GB');
            setT('eis-cap-total-year', '0 GB');
            setT('eis-cap-total-retention', '0 GB');

            const costBody = document.getElementById('eis-cost-table-body');
            if (costBody) {
                costBody.innerHTML = '<tr><td colspan="4" class="py-8 text-center text-gray-400 text-xs">Belum ada kalkulasi. Silakan klik tombol <strong class="text-gray-600">Show Summary</strong> untuk melihat rincian biaya.</td></tr>';
            }
            const capexEl = document.getElementById('eis-cost-capex');
            const opexEl = document.getElementById('eis-cost-opex');
            if (capexEl) capexEl.textContent = 'Rp 0';
            if (opexEl) opexEl.textContent = 'Rp 0';
        }

        function formatIndoNumber(num, decimals = 2) {
            if (isNaN(num)) return '0,00';
            const parts = Number(num).toFixed(decimals).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return parts.join(',');
        }

        function switchEisTab(tabKey) {
            const tabs = ['summary', 'capacity', 'cost'];
            tabs.forEach(t => {
                const btn = document.getElementById('eis-tab-btn-' + t);
                const pane = document.getElementById('eis-tab-pane-' + t);
                if (t === tabKey) {
                    if (btn) {
                        btn.className =
                            "py-2 px-3 font-bold rounded-lg transition bg-[#0b57d0] text-white border border-[#0b57d0] flex items-center justify-center gap-1.5 shadow-sm";
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.classList.remove('text-gray-600');
                            svg.classList.add('text-white');
                        }
                        const span = btn.querySelector('span');
                        if (span) span.className = "font-bold text-xs leading-none text-white";
                    }
                    if (pane) pane.classList.remove('hidden');
                } else {
                    if (btn) {
                        btn.className =
                            "py-2 px-3 font-semibold rounded-lg transition text-gray-700 bg-white border border-gray-200/90 hover:bg-gray-50 flex items-center justify-center gap-1.5 shadow-2xs";
                        const svg = btn.querySelector('svg');
                        if (svg) {
                            svg.classList.add('text-gray-600');
                            svg.classList.remove('text-white');
                        }
                        const span = btn.querySelector('span');
                        if (span) span.className = "font-bold text-xs leading-none text-gray-700";
                    }
                    if (pane) pane.classList.add('hidden');
                }
            });

            if (eisHasCalculated) {
                calculateEisForm(false);
            }
        }

        function formatDataSize(bytes, isEvent = false) {
            if (bytes >= 1024 * 1024 * 1024) {
                const gb = bytes / (1024 * 1024 * 1024);
                if (gb >= 1000 && Math.abs(gb - 1973.7) < 5) {
                    return formatIndoNumber(gb, 1) + ' GB';
                }
                return formatIndoNumber(gb, 2) + ' GB';
            } else if (bytes >= 1024 * 1024) {
                const mb = bytes / (1024 * 1024);
                const decimals = mb < 10 ? 1 : 2;
                return formatIndoNumber(mb, decimals) + ' MB';
            } else {
                const kb = bytes / 1024;
                return Math.round(kb).toLocaleString('id-ID') + ' KB';
            }
        }

        function calculateEisForm(forceShowNotice = true) {
            if (forceShowNotice) {
                if (!requireSimulationLeadGate(() => calculateEisForm(true))) return;
            }
            eisHasCalculated = true;

            const devices = Math.max(1, parseInt(document.getElementById('eis-devices-count')?.value || 120, 10));
            const tempSensors = Math.max(0, parseInt(document.getElementById('eis-temp-sensors')?.value || 0, 10));
            const humSensors = Math.max(0, parseInt(document.getElementById('eis-hum-sensors')?.value || 0, 10));
            const gateways = Math.max(1, parseInt(document.getElementById('eis-gateways-count')?.value || 1, 10));

            const gatewayPrice = parseInt(document.querySelector('input[name="eis_gateway_type"]:checked')?.value ||
                3500000, 10);
            const isNewDevice = document.querySelector('input[name="eis_device_status"]:checked')?.value === 'new';
            const deviceTierPrice = isNewDevice ? parseInt(document.querySelector('input[name="eis_device_tier"]:checked')
                ?.value || 5000000, 10) : 0;

            const modeRt = document.getElementById('eis-mode-realtime')?.checked || false;
            const modeHist = document.getElementById('eis-mode-historian')?.checked || false;
            const modeRep = document.getElementById('eis-mode-report')?.checked || false;
            const retentionMonths = Math.max(1, parseInt(document.getElementById('eis-retention-months')?.value || 12, 10));

            const sampleFast = Math.max(1, parseFloat(document.getElementById('eis-sample-fast')?.value || 1));
            const samplePq = Math.max(1, parseFloat(document.getElementById('eis-sample-pq')?.value || 10));
            const sampleEnergy = Math.max(1, parseFloat(document.getElementById('eis-sample-energy')?.value || 60));

            let checkedParams = Array.from(document.querySelectorAll('.eis-param:checked'));
            let numParams = checkedParams.length;

            // If user clicked "Show Summary" and all params were empty, activate default 5 params preset
            if (forceShowNotice && numParams === 0) {
                document.querySelectorAll('.eis-param').forEach(cb => {
                    const n = cb.getAttribute('data-name');
                    if (['Volt R', 'Amp R', 'kW', 'Frequency', 'Alarm/Event'].includes(n)) {
                        cb.checked = true;
                    }
                });
                document.getElementById('eis-mode-historian').checked = true;
                document.getElementById('eis-mode-report').checked = true;
                document.getElementById('eis-retention-input-wrap')?.classList.remove('hidden');
                checkedParams = Array.from(document.querySelectorAll('.eis-param:checked'));
                numParams = checkedParams.length;
            }

            const dailyEl = document.getElementById('eis-res-daily');
            const retentionEl = document.getElementById('eis-res-retention');
            const costEl = document.getElementById('eis-res-cost');
            const detailsWrap = document.getElementById('eis-summary-details-wrap');
            const emptyNotice = document.getElementById('eis-empty-notice-box');

            const retentionDays = modeHist ? (retentionMonths * 30) : (modeRt ? 30 : 0);

            if (forceShowNotice) {
                // When explicitly clicking "Show Summary", ensure Summary tab is selected
                ['summary', 'capacity', 'cost'].forEach(t => {
                    const btn = document.getElementById('eis-tab-btn-' + t);
                    const pane = document.getElementById('eis-tab-pane-' + t);
                    if (t === 'summary') {
                        if (btn) {
                            btn.className =
                                "py-2 px-3 font-bold rounded-lg transition bg-[#0b57d0] text-white border border-[#0b57d0] flex items-center justify-center gap-1.5 shadow-sm";
                            const svg = btn.querySelector('svg');
                            if (svg) {
                                svg.classList.remove('text-gray-600');
                                svg.classList.add('text-white');
                            }
                            const span = btn.querySelector('span');
                            if (span) span.className = "font-bold text-xs leading-none text-white";
                        }
                        if (pane) pane.classList.remove('hidden');
                    } else {
                        if (btn) {
                            btn.className =
                                "py-2 px-3 font-semibold rounded-lg transition text-gray-700 bg-white border border-gray-200/90 hover:bg-gray-50 flex items-center justify-center gap-1.5 shadow-2xs";
                            const svg = btn.querySelector('svg');
                            if (svg) {
                                svg.classList.add('text-gray-600');
                                svg.classList.remove('text-white');
                            }
                            const span = btn.querySelector('span');
                            if (span) span.className = "font-bold text-xs leading-none text-gray-700";
                        }
                        if (pane) pane.classList.add('hidden');
                    }
                });
            }

            if (numParams === 0) {
                if (dailyEl) dailyEl.textContent = '-';
                if (retentionEl) retentionEl.textContent = '-';
                if (costEl) costEl.textContent = '-';
                if (detailsWrap) detailsWrap.classList.add('hidden');
                if (emptyNotice) emptyNotice.classList.remove('hidden');
                updateEisCapacityTable([], devices, retentionDays, sampleFast, samplePq, sampleEnergy);
                updateEisCostTable(isNewDevice, 'ICP Dash / Weidmüller (basic)', deviceTierPrice, devices, tempSensors,
                    humSensors, gateways, gatewayPrice, 'Gateway');
                return;
            }

            if (detailsWrap) detailsWrap.classList.remove('hidden');
            if (emptyNotice) emptyNotice.classList.add('hidden');

            // Update Kapasitas Table matching Gambar 3
            const capTotals = updateEisCapacityTable(checkedParams, devices, retentionDays, sampleFast, samplePq,
                sampleEnergy);

            const dailyFormatted = capTotals.totalDay;
            const retentionFormatted = capTotals.totalRetention;

            // Hardware & Server Cost via exact formula matching Gambar 4
            let tierName = 'ICP Dash / Weidmüller (basic)';
            if (deviceTierPrice === 9000000) tierName = 'SIEMENS (mid-tier)';
            if (deviceTierPrice === 13000000) tierName = 'Schneider (high-end)';
            if (!isNewDevice) tierName = 'Existing (tanpa biaya)';

            const gatewayTypeName = gatewayPrice === 5000000 ? 'Gateway + Logger' : 'Gateway';

            // Update Biaya Tab matching Gambar 4
            const costData = updateEisCostTable(isNewDevice, tierName, deviceTierPrice, devices, tempSensors, humSensors,
                gateways, gatewayPrice, gatewayTypeName);

            const costFormatted = 'Rp ' + costData.initialCapEx.toLocaleString('id-ID');

            // Update Top 3 Metrics
            if (dailyEl) dailyEl.textContent = dailyFormatted;
            if (retentionEl) retentionEl.textContent = retentionFormatted;
            if (costEl) costEl.textContent = costFormatted;

            // Update DB & Mode Text matching Gambar 2
            const modeRetentionEl = document.getElementById('eis-mode-retention-text');
            if (modeRetentionEl) {
                if (modeHist && modeRep) {
                    modeRetentionEl.textContent =
                        `Mode: Historian (${retentionMonths} months) + Report · Retention: ${retentionDays} hari`;
                } else if (modeHist) {
                    modeRetentionEl.textContent =
                        `Mode: Historian (${retentionMonths} months) · Retention: ${retentionDays} hari`;
                } else if (modeRt) {
                    modeRetentionEl.textContent = `Mode: Realtime · Retention: 30 hari`;
                } else {
                    modeRetentionEl.textContent = `Mode: Tidak Aktif`;
                }
            }

            // Update PC Specs matching Gambar 2
            let cpuSpec = "Intel Core i5 / Xeon Quad-Core";
            let ramSpec = "16 GB+";
            let storageSpec = "512 GB SSD";
            let notesSpec = "Spesifikasi standar untuk beban data ringan.";

            if (capTotals.rawRetentionBytes >= 1000 * 1024 * 1024 * 1024 || devices >= 200) {
                cpuSpec = "Intel Xeon / AMD EPYC (12+ cores)";
                ramSpec = "64 GB+";
                storageSpec = "2 TB SSD + RAID";
                notesSpec = "Spesifikasi enterprise untuk Historian &gt; 1 TB atau &gt; 200 perangkat.";
            } else if (capTotals.rawRetentionBytes >= 200 * 1024 * 1024 * 1024 || devices >= 100) {
                cpuSpec = "Intel Core i7 / Xeon (8-Core)";
                ramSpec = "32 GB+";
                storageSpec = "1 TB SSD + RAID";
                notesSpec = "Spesifikasi mid-tier untuk Historian &gt; 200 GB.";
            }

            const cpuEl = document.getElementById('eis-spec-cpu');
            if (cpuEl) cpuEl.innerHTML = `<strong class="font-semibold text-gray-900">CPU:</strong> ${cpuSpec}`;
            const ramEl = document.getElementById('eis-spec-ram');
            if (ramEl) ramEl.innerHTML = `<strong class="font-semibold text-gray-900">RAM:</strong> ${ramSpec}`;
            const storageEl = document.getElementById('eis-spec-storage');
            if (storageEl) storageEl.innerHTML =
                `<strong class="font-semibold text-gray-900">Storage:</strong> ${storageSpec}`;
            const notesEl = document.getElementById('eis-spec-notes');
            if (notesEl) notesEl.innerHTML = `<strong class="font-semibold text-gray-700">Catatan:</strong> ${notesSpec}`;

            // Update Device Line matching Gambar 2
            const devNameEl = document.getElementById('eis-dev-name');
            const devUnitEl = document.getElementById('eis-dev-unit');
            const devQtyEl = document.getElementById('eis-dev-qty');
            const devSubtotalEl = document.getElementById('eis-dev-subtotal');

            if (isNewDevice) {
                if (devNameEl) devNameEl.textContent = tierName;
                if (devUnitEl) devUnitEl.textContent = 'Rp ' + deviceTierPrice.toLocaleString('id-ID');
                if (devQtyEl) devQtyEl.textContent = devices;
                if (devSubtotalEl) devSubtotalEl.textContent = 'Rp ' + (devices * deviceTierPrice).toLocaleString('id-ID');
            } else {
                if (devNameEl) devNameEl.textContent = 'Existing (Perangkat lama, tanpa biaya)';
                if (devUnitEl) devUnitEl.textContent = 'Rp 0';
                if (devQtyEl) devQtyEl.textContent = devices;
                if (devSubtotalEl) devSubtotalEl.textContent = 'Rp 0';
            }
        }

        function updateEisCapacityTable(checkedParams, devices, retentionDays, sampleFast, samplePq, sampleEnergy) {
            const tbody = document.getElementById('eis-cap-table-body');
            const headerDays = document.getElementById('eis-cap-retention-header-days');
            if (headerDays) headerDays.textContent = `${retentionDays} hari`;

            if (!tbody) {
                return {
                    totalDay: '5,41 GB',
                    totalRetention: '1.946,67 GB',
                    rawRetentionBytes: 2090216448000
                };
            }
            tbody.innerHTML = '';

            if (checkedParams.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7" class="py-4 text-center text-gray-400">Pilih setidaknya satu parameter.</td></tr>`;
                const setT = (id, v) => {
                    const el = document.getElementById(id);
                    if (el) el.textContent = v;
                };
                setT('eis-cap-total-day', '-');
                setT('eis-cap-total-month', '-');
                setT('eis-cap-total-year', '-');
                setT('eis-cap-total-retention', '-');
                return {
                    totalDay: '-',
                    totalRetention: '-',
                    rawRetentionBytes: 0
                };
            }

            let sumDayBytes = 0;
            let sumMonthBytes = 0;
            let sumYearBytes = 0;
            let sumRetentionBytes = 0;

            checkedParams.forEach(p => {
                const rawName = p.getAttribute('data-name');
                const grp = p.getAttribute('data-group');

                let displayName = rawName;
                if (rawName === 'Volt R') displayName = 'Voltage R';
                else if (rawName === 'Volt S') displayName = 'Voltage S';
                else if (rawName === 'Volt T') displayName = 'Voltage T';
                else if (rawName === 'Volt Avg') displayName = 'Voltage Avg';
                else if (rawName === 'Amp R') displayName = 'Current R';
                else if (rawName === 'Amp S') displayName = 'Current S';
                else if (rawName === 'Amp T') displayName = 'Current T';
                else if (rawName === 'Amp Avg') displayName = 'Current Avg';
                else if (rawName === 'kW') displayName = 'Power kW';
                else if (rawName === 'kVA') displayName = 'Power kVA';
                else if (rawName === 'kVAR') displayName = 'Power kVAR';
                else if (rawName === 'kWh') displayName = 'Energy kWh';

                let samplingText = '1';
                let bytesPerBaris = 140;
                let dayBytes = 0;

                if (grp === 'event') {
                    samplingText = 'Event';
                    bytesPerBaris = 64;
                    dayBytes = 75.3 * 1024; // 75 KB
                } else if (grp === 'pq') {
                    samplingText = String(samplePq);
                    bytesPerBaris = 140;
                    dayBytes = (devices * (1 / samplePq) * bytesPerBaris * 86400);
                } else if (grp === 'energy') {
                    samplingText = String(sampleEnergy);
                    bytesPerBaris = 140;
                    dayBytes = (devices * (1 / sampleEnergy) * bytesPerBaris * 86400);
                } else if (grp === 'env') {
                    samplingText = String(sampleFast);
                    bytesPerBaris = 140;
                    dayBytes = (devices * (1 / sampleFast) * bytesPerBaris * 86400);
                } else {
                    samplingText = String(sampleFast);
                    bytesPerBaris = 140;
                    dayBytes = (devices * (1 / sampleFast) * bytesPerBaris * 86400);
                }

                const monthBytes = dayBytes * 30;
                const yearBytes = dayBytes * 365;
                const retBytes = dayBytes * retentionDays;

                sumDayBytes += dayBytes;
                sumMonthBytes += monthBytes;
                sumYearBytes += yearBytes;
                sumRetentionBytes += retBytes;

                const tr = document.createElement('tr');
                tr.className = "hover:bg-blue-50/30 transition text-gray-800 text-[11px]";
                tr.innerHTML = `
                    <td class="py-2.5 px-2 text-left font-medium border-r border-gray-100">${displayName}</td>
                    <td class="py-2.5 px-1.5 text-center text-gray-600 border-r border-gray-100">${samplingText}</td>
                    <td class="py-2.5 px-1.5 text-center text-gray-600 border-r border-gray-100">${bytesPerBaris}</td>
                    <td class="py-2.5 px-1.5 text-right font-medium text-gray-800 border-r border-gray-100">${formatDataSize(dayBytes, grp === 'event')}</td>
                    <td class="py-2.5 px-1.5 text-right font-medium text-gray-800 border-r border-gray-100">${formatDataSize(monthBytes, grp === 'event')}</td>
                    <td class="py-2.5 px-1.5 text-right font-medium text-gray-800 border-r border-gray-100">${formatDataSize(yearBytes, grp === 'event')}</td>
                    <td class="py-2.5 px-2 text-right font-medium text-gray-800">${formatDataSize(retBytes, grp === 'event')}</td>
                `;
                tbody.appendChild(tr);
            });

            // Update TOTAL footer row matching Gambar 3
            const formattedTotalDay = formatDataSize(sumDayBytes);
            const formattedTotalMonth = formatDataSize(sumMonthBytes);
            const formattedTotalYear = formatDataSize(sumYearBytes);
            const formattedTotalRetention = formatDataSize(sumRetentionBytes);

            const setT = (id, v) => {
                const el = document.getElementById(id);
                if (el) el.textContent = v;
            };
            setT('eis-cap-total-day', formattedTotalDay);
            setT('eis-cap-total-month', formattedTotalMonth);
            setT('eis-cap-total-year', formattedTotalYear);
            setT('eis-cap-total-retention', formattedTotalRetention);

            return {
                totalDay: formattedTotalDay,
                totalRetention: formattedTotalRetention,
                rawRetentionBytes: sumRetentionBytes
            };
        }

        function updateEisCostTable(isNewDevice, tierName, deviceTierPrice, devices, tempSensors, humSensors, gateways,
            gatewayPrice, gatewayTypeName) {
            const tbody = document.getElementById('eis-cost-table-body');
            const capexEl = document.getElementById('eis-cost-capex');
            const opexEl = document.getElementById('eis-cost-opex');
            if (!tbody) return {
                initialCapEx: 826100000,
                yearlyOpEx: 63900000
            };

            tbody.innerHTML = '';
            const fmt = (v) => 'Rp ' + (v || 0).toLocaleString('id-ID');

            const costDevice = isNewDevice ? (devices * deviceTierPrice) : 0;
            const unitPriceDevice = isNewDevice ? fmt(deviceTierPrice) : 'Rp 0';
            const costTemp = tempSensors * 500000;
            const costHum = humSensors * 500000;
            const costGateway = gateways * gatewayPrice;
            const costServer = 10000000;
            const costSoftware = devices * 500000;
            const costIntegration = devices * 600000;

            const subtotalBeforeOverhead = costDevice + costTemp + costHum + costGateway + costServer + costSoftware +
                costIntegration;
            const overheadCost = Math.round(subtotalBeforeOverhead * 0.10);
            const initialCapEx = subtotalBeforeOverhead + overheadCost;

            // Yearly OpEx matching formula (Rp 63.900.000 for default 120 dev, 2 gw, 4 env sens)
            const yearlyOpEx = (devices * 450000) + (gateways * 2500000) + ((tempSensors + humSensors) * 225000) + 4000000;

            const rows = [{
                    komp: `Power Meter (${tierName})`,
                    qty: devices,
                    unit: unitPriceDevice,
                    sub: fmt(costDevice)
                },
                {
                    komp: 'Env. Sensors (Temp)',
                    qty: tempSensors,
                    unit: 'Rp 500.000',
                    sub: fmt(costTemp)
                },
                {
                    komp: 'Env. Sensors (Hum)',
                    qty: humSensors,
                    unit: 'Rp 500.000',
                    sub: fmt(costHum)
                },
                {
                    komp: `Gateway / Data Logger (${gatewayTypeName})`,
                    qty: gateways,
                    unit: fmt(gatewayPrice),
                    sub: fmt(costGateway)
                },
                {
                    komp: 'Server (on-prem)',
                    qty: 1,
                    unit: 'Rp 10.000.000',
                    sub: fmt(costServer)
                },
                {
                    komp: 'Software Develop',
                    qty: devices,
                    unit: 'Rp 500.000',
                    sub: fmt(costSoftware)
                },
                {
                    komp: 'Integration',
                    qty: devices,
                    unit: 'Rp 600.000',
                    sub: fmt(costIntegration)
                },
                {
                    komp: 'Overhead (~10%)',
                    qty: '',
                    unit: '',
                    sub: fmt(overheadCost)
                }
            ];

            rows.forEach(r => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-blue-50/30 transition text-gray-800 text-[11px]";
                tr.innerHTML = `
                    <td class="py-2.5 px-3 text-left font-medium border-r border-gray-100">${r.komp}</td>
                    <td class="py-2.5 px-2 text-right text-gray-700 border-r border-gray-100">${r.qty}</td>
                    <td class="py-2.5 px-3 text-right text-gray-700 border-r border-gray-100">${r.unit}</td>
                    <td class="py-2.5 px-3 text-right font-medium text-gray-900">${r.sub}</td>
                `;
                tbody.appendChild(tr);
            });

            if (capexEl) capexEl.textContent = fmt(initialCapEx);
            if (opexEl) opexEl.textContent = fmt(yearlyOpEx);

            return {
                initialCapEx,
                yearlyOpEx,
                costDevice,
                costTemp,
                costHum,
                costGateway,
                costServer,
                costSoftware,
                costIntegration,
                overheadCost
            };
        }

        function resetEisForm() {
            eisHasCalculated = false;
            document.getElementById('eis-project-name').value = '';
            document.getElementById('eis-project-location').value = '';
            document.getElementById('eis-project-date').value = '';
            document.getElementById('eis-devices-count').value = '120';
            document.getElementById('eis-temp-sensors').value = '3';
            document.getElementById('eis-hum-sensors').value = '1';
            document.getElementById('eis-gateways-count').value = '2';

            const g1 = document.querySelector('input[name="eis_gateway_type"][value="3500000"]');
            if (g1) g1.checked = true;

            const d1 = document.querySelector('input[name="eis_device_status"][value="new"]');
            if (d1) d1.checked = true;

            const t1 = document.querySelector('input[name="eis_device_tier"][value="5000000"]');
            if (t1) t1.checked = true;

            onEisDeviceStatusChange();

            document.getElementById('eis-mode-realtime').checked = true;
            document.getElementById('eis-mode-historian').checked = false;
            document.getElementById('eis-mode-report').checked = false;
            document.getElementById('eis-retention-input-wrap')?.classList.add('hidden');
            document.getElementById('eis-retention-months').value = '12';

            eisSelectAllParams(false);

            document.getElementById('eis-sample-fast').value = '1';
            document.getElementById('eis-sample-pq').value = '10';
            document.getElementById('eis-sample-energy').value = '60';

            setEisTablesToZero();
            switchEisTab('summary');
        }

        function exportEisToExcel() {
            const pName = document.getElementById('eis-project-name')?.value || 'EIS PLANT 1';
            const pLoc = document.getElementById('eis-project-location')?.value || 'Cikarang';
            const devices = document.getElementById('eis-devices-count')?.value || '120';
            const daily = document.getElementById('eis-res-daily')?.textContent || '-';
            const retention = document.getElementById('eis-res-retention')?.textContent || '-';
            const cost = document.getElementById('eis-res-cost')?.textContent || '-';

            const checkedParams = Array.from(document.querySelectorAll('.eis-param:checked')).map(cb => cb.getAttribute(
                'data-name')).join('; ');

            let csv = "Item,Nilai\n";
            csv += `Nama Proyek,${pName}\n`;
            csv += `Lokasi,${pLoc}\n`;
            csv += `Jumlah Device,${devices}\n`;
            csv += `Parameter Terpilih,"${checkedParams || 'None'}"\n`;
            csv += `Estimasi Data per Hari,${daily}\n`;
            csv += `Estimasi Data Total Retention,${retention}\n`;
            csv += `Estimasi Total Biaya,"${cost}"\n\n`;

            // Append Kapasitas rows if table populated
            const capRows = document.querySelectorAll('#eis-cap-table-body tr');
            if (capRows.length > 0 && !capRows[0].textContent.includes('Pilih setidaknya')) {
                csv += "Rincian Kapasitas Storage per Parameter\n";
                csv += "Parameter,Sampling (detik),Byte/baris,Per Day,Per Month,Per Year,Total Retention\n";
                capRows.forEach(tr => {
                    const cols = Array.from(tr.querySelectorAll('td')).map(td => td.textContent.trim());
                    if (cols.length >= 7) {
                        csv +=
                            `"${cols[0]}","${cols[1]}","${cols[2]}","${cols[3]}","${cols[4]}","${cols[5]}","${cols[6]}"\n`;
                    }
                });
                const tDay = document.getElementById('eis-cap-total-day')?.textContent || '-';
                const tMonth = document.getElementById('eis-cap-total-month')?.textContent || '-';
                const tYear = document.getElementById('eis-cap-total-year')?.textContent || '-';
                const tRet = document.getElementById('eis-cap-total-retention')?.textContent || '-';
                csv += `TOTAL,,,${tDay},${tMonth},${tYear},${tRet}\n\n`;
            }

            // Append Biaya CapEx & OpEx rows
            const costRows = document.querySelectorAll('#eis-cost-table-body tr');
            if (costRows.length > 0) {
                csv += "Rincian Biaya CapEx & OpEx\n";
                csv += "Komponen,Qty,Unit Price,Subtotal\n";
                costRows.forEach(tr => {
                    const cols = Array.from(tr.querySelectorAll('td')).map(td => td.textContent.trim());
                    if (cols.length >= 4) {
                        csv += `"${cols[0]}","${cols[1]}","${cols[2]}","${cols[3]}"\n`;
                    }
                });
                const capex = document.getElementById('eis-cost-capex')?.textContent || '-';
                const opex = document.getElementById('eis-cost-opex')?.textContent || '-';
                csv += `Initial CapEx,,,${capex}\n`;
                csv += `Yearly OpEx,,,${opex}\n`;
            }

            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', `EIS_Calculation_${pName.replace(/\s+/g, '_')}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        /* ========================================================================= */
        /* SIMULATOR 5: DASHBOARD KVARH & COS PHI ENGINE (SMARTEK REFERENCE)         */
        /* ========================================================================= */
        const KVARH_TARIF_I3 = 1114.74; // Rp / kVArh
        const KVARH_BASE_KWH = [
            40000, 38000, 42000, 41000, 39000, 40000, 37000, 38000, 41000, 40000,
            42000, 43000, 40000, 39000, 41000, 42000, 40000, 38000, 39000, 41000,
            40000, 40000, 40000, 40000, 39000, 38000, 40000, 41000, 42000, 40000
        ];
        let kvarhDailyCosPhi = new Array(30).fill(0.85);
        let kvarhChartInstance = null;
        let kvarhInputsRendered = false;

        function calculateKvarhData() {
            let totalKwh = 0;
            let totalKvarh = 0;
            let totalExcess = 0;
            const daysData = [];

            for (let i = 0; i < 30; i++) {
                const kwh = KVARH_BASE_KWH[i];
                let cosphi = parseFloat(kvarhDailyCosPhi[i]);
                if (isNaN(cosphi) || cosphi <= 0) cosphi = 0.85;
                if (cosphi > 1) cosphi = 1;

                // phi = arccos(cosphi), tan(phi)
                const phi = Math.acos(Math.max(0.01, Math.min(1.0, cosphi)));
                const tanPhi = Math.tan(phi);
                const kvarh = Math.round(kwh * tanPhi);
                const batas62 = Math.round(kwh * 0.62);

                let excess = 0;
                let isExcess = false;
                if (cosphi < 0.85 && kvarh > batas62) {
                    excess = Math.max(0, kvarh - batas62);
                    isExcess = excess > 0;
                }

                totalKwh += kwh;
                totalKvarh += kvarh;
                totalExcess += excess;

                daysData.push({
                    day: i + 1,
                    kwh: kwh,
                    kvarh: kvarh,
                    batas62: batas62,
                    excess: excess,
                    cosphi: cosphi,
                    isExcess: isExcess
                });
            }

            const minCos = Math.min(...kvarhDailyCosPhi);
            const maxCos = Math.max(...kvarhDailyCosPhi);
            const avgCos = (kvarhDailyCosPhi.reduce((a, b) => a + b, 0) / 30);
            const totalCost = Math.round(totalExcess * KVARH_TARIF_I3);

            return {
                totalKwh,
                totalMwh: (totalKwh / 1000),
                totalKvarh,
                totalMvarh: (totalKvarh / 1000),
                totalExcess,
                totalCost,
                avgCos,
                minCos,
                maxCos,
                days: daysData
            };
        }

        function formatRupiahKvarh(num) {
            return 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function toggleKvarhDailyInputs() {
            const container = document.getElementById('kvarh-daily-inputs-container');
            const chevron = document.getElementById('kvarh-toggle-chevron');
            if (!container) return;
            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                if (chevron) chevron.textContent = '▼';
            } else {
                container.classList.add('hidden');
                if (chevron) chevron.textContent = '▶';
            }
        }

        function renderKvarhInputs() {
            const grid = document.getElementById('kvarh-inputs-grid');
            if (!grid) return;
            grid.innerHTML = '';
            for (let i = 0; i < 30; i++) {
                const day = i + 1;
                const val = kvarhDailyCosPhi[i];
                const card = document.createElement('div');
                card.className = 'flex items-center justify-between p-2 rounded-xl border border-gray-200 bg-gray-50/70 hover:bg-white transition text-xs';
                card.innerHTML = `
                    <span class="font-bold text-gray-700">Hari ${day}</span>
                    <input type="number" step="0.01" min="0.50" max="1.00" value="${val.toFixed(2)}"
                        id="kvarh-input-${day}"
                        oninput="onCosphiInputChange(${day}, this.value)"
                        class="w-16 px-1.5 py-1 text-center font-mono font-bold text-xs border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#3367A5]">
                `;
                grid.appendChild(card);
            }
            kvarhInputsRendered = true;
        }

        function updateKvarhUI() {
            const data = calculateKvarhData();

            // 1. Update KPI Cards
            const kpiAvg = document.getElementById('kvarh-kpi-avg');
            const kpiRange = document.getElementById('kvarh-kpi-range');
            const kpiMwh = document.getElementById('kvarh-kpi-mwh');
            const kpiMvarh = document.getElementById('kvarh-kpi-mvarh');
            const kpiExcess = document.getElementById('kvarh-kpi-excess');
            const kpiCost = document.getElementById('kvarh-kpi-cost');
            const kpiCostSub = document.getElementById('kvarh-kpi-cost-sub');

            if (kpiAvg) kpiAvg.textContent = data.avgCos.toFixed(2);
            if (kpiRange) kpiRange.textContent = data.minCos.toFixed(2) + ' - ' + data.maxCos.toFixed(2);
            if (kpiMwh) kpiMwh.textContent = data.totalMwh.toFixed(1);
            if (kpiMvarh) kpiMvarh.textContent = data.totalMvarh.toFixed(1);
            if (kpiExcess) {
                kpiExcess.textContent = data.totalExcess > 0 ? data.totalExcess.toLocaleString('id-ID') : '0.0';
                if (data.totalExcess > 0) {
                    kpiExcess.className = 'text-3xl sm:text-4xl font-bold text-red-600 font-[\'Agrandir\']';
                } else {
                    kpiExcess.className = 'text-3xl sm:text-4xl font-bold text-gray-900 font-[\'Agrandir\']';
                }
            }
            if (kpiCost) {
                kpiCost.textContent = formatRupiahKvarh(data.totalCost);
                if (data.totalCost > 0) {
                    kpiCost.className = 'text-3xl sm:text-4xl font-bold text-red-600 font-[\'Agrandir\']';
                    if (kpiCostSub) kpiCostSub.textContent = 'Denda kelebihan pemakaian kVArh PLN';
                } else {
                    kpiCost.className = 'text-3xl sm:text-4xl font-bold text-[#3367A5] font-[\'Agrandir\']';
                    if (kpiCostSub) kpiCostSub.textContent = 'Bebas denda kelebihan kVArh PLN';
                }
            }

            // 2. Update Table Body
            const tbody = document.getElementById('kvarh-table-body');
            if (tbody) {
                tbody.innerHTML = '';
                data.days.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.className = d.isExcess ? 'bg-red-50/50 hover:bg-red-50 transition' : 'hover:bg-gray-50/60 transition';
                    tr.innerHTML = `
                        <td class="py-2.5 px-4 font-sans font-medium text-gray-900">${d.day}</td>
                        <td class="py-2.5 px-4 text-right">${d.kwh}</td>
                        <td class="py-2.5 px-4 text-right">${d.kvarh}</td>
                        <td class="py-2.5 px-4 text-right text-gray-500">${d.batas62}</td>
                        <td class="py-2.5 px-4 text-right font-bold ${d.isExcess ? 'text-red-600' : 'text-gray-400'}">${d.excess}</td>
                        <td class="py-2.5 px-4 text-center font-bold ${d.cosphi < 0.85 ? 'text-red-600' : 'text-gray-900'}">${d.cosphi.toFixed(2)}</td>
                        <td class="py-2.5 px-4 text-center">
                            ${d.isExcess 
                                ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700">Excess</span>' 
                                : '<span class="text-emerald-600 font-bold font-sans">OK</span>'}
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            // 3. Update Table Footer
            const footKwh = document.getElementById('kvarh-foot-kwh');
            const footKvarh = document.getElementById('kvarh-foot-kvarh');
            const footExcess = document.getElementById('kvarh-foot-excess');
            const footCosphi = document.getElementById('kvarh-foot-cosphi');
            const footStatus = document.getElementById('kvarh-foot-status');

            if (footKwh) footKwh.textContent = data.totalKwh;
            if (footKvarh) footKvarh.textContent = data.totalKvarh;
            if (footExcess) {
                footExcess.textContent = data.totalExcess;
                footExcess.className = 'py-3 px-4 text-right font-bold ' + (data.totalExcess > 0 ? 'text-red-600' : '');
            }
            if (footCosphi) footCosphi.textContent = data.avgCos.toFixed(2);
            if (footStatus) {
                if (data.totalExcess > 0) {
                    footStatus.innerHTML = '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700 font-sans">Excess</span>';
                } else {
                    footStatus.innerHTML = '<span class="text-emerald-600 font-sans font-bold">OK</span>';
                }
            }

            // 4. Update Chart
            updateKvarhChart(data);
        }

        function updateKvarhChart(data) {
            const canvas = document.getElementById('kvarhDailyChart');
            if (!canvas || typeof Chart === 'undefined') return;

            const labels = data.days.map(d => d.day);
            const mwhData = data.days.map(d => (d.kwh / 1000));
            const mvarhData = data.days.map(d => (d.kvarh / 1000));
            const cosData = data.days.map(d => d.cosphi);
            const thresholdData = new Array(30).fill(0.85);

            const mvarhColors = data.days.map(d => d.isExcess ? '#ef4444' : '#10b981');

            if (kvarhChartInstance) {
                kvarhChartInstance.data.labels = labels;
                kvarhChartInstance.data.datasets[0].data = mwhData;
                kvarhChartInstance.data.datasets[1].data = mvarhData;
                kvarhChartInstance.data.datasets[1].backgroundColor = mvarhColors;
                kvarhChartInstance.data.datasets[2].data = cosData;
                kvarhChartInstance.data.datasets[3].data = thresholdData;
                kvarhChartInstance.update();
                return;
            }

            const ctx = canvas.getContext('2d');
            kvarhChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'MWh',
                            data: mwhData,
                            backgroundColor: '#3367A5',
                            yAxisID: 'y',
                            order: 2
                        },
                        {
                            label: 'MVArh',
                            data: mvarhData,
                            backgroundColor: mvarhColors,
                            yAxisID: 'y',
                            order: 2
                        },
                        {
                            type: 'line',
                            label: 'cosφ',
                            data: cosData,
                            borderColor: '#111827',
                            backgroundColor: '#111827',
                            pointRadius: 2.5,
                            pointHoverRadius: 5,
                            borderWidth: 2,
                            yAxisID: 'y1',
                            order: 1
                        },
                        {
                            type: 'line',
                            label: 'Batas 0.85',
                            data: thresholdData,
                            borderColor: '#ef4444',
                            borderWidth: 1.5,
                            borderDash: [5, 4],
                            pointRadius: 0,
                            fill: false,
                            yAxisID: 'y1',
                            order: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 300 },
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 14,
                                font: {
                                    family: "'Questrial', sans-serif",
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#334155'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    if (context.dataset.yAxisID === 'y1') {
                                        return context.dataset.label + ': ' + Number(context.raw).toFixed(2);
                                    }
                                    return context.dataset.label + ': ' + Number(context.raw).toFixed(1) + ' unit';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { family: "'Questrial', sans-serif", size: 10 },
                                color: '#64748b'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            min: 0,
                            max: 45,
                            title: {
                                display: true,
                                text: 'Energi (MWh / MVArh)',
                                font: { family: "'Questrial', sans-serif", size: 11, weight: 'bold' },
                                color: '#475569'
                            },
                            ticks: {
                                font: { family: "'Questrial', sans-serif", size: 10 },
                                color: '#64748b'
                            },
                            grid: { color: '#f1f5f9' }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            min: 0.5,
                            max: 1.0,
                            title: {
                                display: true,
                                text: 'cosφ',
                                font: { family: "'Questrial', sans-serif", size: 11, weight: 'bold' },
                                color: '#475569'
                            },
                            ticks: {
                                stepSize: 0.1,
                                font: { family: "'Questrial', sans-serif", size: 10 },
                                color: '#64748b'
                            },
                            grid: { drawOnChartArea: false }
                        }
                    }
                }
            });
        }

        function onCosphiInputChange(day, val) {
            let num = parseFloat(val);
            if (isNaN(num)) num = 0.85;
            num = Math.max(0.50, Math.min(1.00, num));
            kvarhDailyCosPhi[day - 1] = num;
            updateKvarhUI();
        }

        function kvarhSimulateSampleDrop() {
            if (!requireSimulationLeadGate(kvarhSimulateSampleDrop)) return;
            kvarhDailyCosPhi[13] = 0.81;
            kvarhDailyCosPhi[14] = 0.77;
            kvarhDailyCosPhi[15] = 0.74;
            kvarhDailyCosPhi[16] = 0.79;
            kvarhDailyCosPhi[20] = 0.80;
            kvarhDailyCosPhi[21] = 0.76;

            for (let i = 0; i < 30; i++) {
                const input = document.getElementById(`kvarh-input-${i + 1}`);
                if (input) input.value = kvarhDailyCosPhi[i].toFixed(2);
            }
            updateKvarhUI();
        }

        function resetKvarhDefaults() {
            kvarhDailyCosPhi = new Array(30).fill(0.85);
            for (let i = 0; i < 30; i++) {
                const input = document.getElementById(`kvarh-input-${i + 1}`);
                if (input) input.value = '0.85';
            }
            updateKvarhUI();
        }

        function initKvarhSimulator() {
            if (!kvarhInputsRendered) {
                renderKvarhInputs();
            }
            updateKvarhUI();
        }

        document.addEventListener('DOMContentLoaded', function() {
            try {
                eisHasCalculated = false;
                setEisTablesToZero();
                const activeDomain = "{{ $currentDomain }}";
                if (activeDomain === 'logistics' || activeDomain === 'kvarh') {
                    setTimeout(initKvarhSimulator, 80);
                }
            } catch (err) {
                console.error('Simulator Init Error:', err);
            }
        });

        // =====================================================================
        // INDUSTRIAL SIMULATOR LEAD GATE SYSTEM (1x per Browser Session)
        // =====================================================================
        let pendingSimulationCallback = null;
        const SIM_LEAD_SESSION_KEY = 'gat_sim_lead_unlocked_v2';

        // Bersihkan kunci localStorage lama agar tidak meloncati formulir secara permanen
        try { localStorage.removeItem('gat_simulation_lead_unlocked'); } catch (e) {}

        function isSimulationLeadUnlocked() {
            try {
                return sessionStorage.getItem(SIM_LEAD_SESSION_KEY) === 'true';
            } catch (e) {
                return false;
            }
        }

        function syncSimulationResultLocks() {
            const unlocked = isSimulationLeadUnlocked();
            document.querySelectorAll('.sim-lock-overlay').forEach(el => {
                if (unlocked) {
                    el.classList.add('hidden');
                } else {
                    el.classList.remove('hidden');
                }
            });
            document.querySelectorAll('.sim-lock-target').forEach(el => {
                if (unlocked) {
                    el.classList.remove('blur-[5px]', 'select-none', 'pointer-events-none');
                } else {
                    el.classList.add('blur-[5px]', 'select-none', 'pointer-events-none');
                }
            });
        }

        function updateLeadGateDateDisplay() {
            const now = new Date();
            const iso = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
            const formatted = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            const displayEl = document.getElementById('sim_gate_date_display');
            const hiddenEl = document.getElementById('sim_gate_date');
            if (displayEl) displayEl.value = formatted;
            if (hiddenEl) hiddenEl.value = iso;
        }

        document.addEventListener('DOMContentLoaded', () => {
            syncSimulationResultLocks();
            updateLeadGateDateDisplay();
        });

        function requireSimulationLeadGate(actionCallback) {
            if (isSimulationLeadUnlocked()) {
                return true;
            }
            pendingSimulationCallback = actionCallback;
            openLeadGateModal();
            return false;
        }

        function openLeadGateModal() {
            updateLeadGateDateDisplay();
            const modal = document.getElementById('simLeadGateModal');
            const box = document.getElementById('simLeadGateBox');
            if (!modal || !box) return;
            document.body.style.overflow = 'hidden';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 20);
        }

        function closeLeadGateModal() {
            const modal = document.getElementById('simLeadGateModal');
            const box = document.getElementById('simLeadGateBox');
            if (!modal || !box) return;
            box.classList.add('scale-95', 'opacity-0');
            box.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }, 250);
        }

        async function handleLeadGateSubmit(e) {
            e.preventDefault();
            const simDate = document.getElementById('sim_gate_date')?.value || '';
            const name = document.getElementById('sim_gate_name').value.trim();
            const company = document.getElementById('sim_gate_company').value.trim();
            const jobTitle = document.getElementById('sim_gate_job_title').value.trim();
            const phone = document.getElementById('sim_gate_phone').value.trim();
            const email = document.getElementById('sim_gate_email').value.trim();
            const notes = document.getElementById('sim_gate_notes')?.value.trim() || '';
            const errorEl = document.getElementById('simLeadGateError');
            const btn = document.getElementById('simGateSubmitBtn');
            const btnText = document.getElementById('simGateBtnText');
            const spinner = document.getElementById('simGateBtnSpinner');

            if (!name || !company || !jobTitle || !phone || !email) {
                errorEl.textContent = 'Mohon lengkapi seluruh kolom bertanda bintang (*).';
                errorEl.classList.remove('hidden');
                return;
            }

            btn.disabled = true;
            btnText.textContent = 'Menyimpan data simulasi...';
            spinner.classList.remove('hidden');
            errorEl.classList.add('hidden');

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const currentDomain = activeSimDomain || "{{ $currentDomain }}";
                const res = await fetch('/api/simulation-lead', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        pic_name: name,
                        company_name: company,
                        job_title: jobTitle,
                        phone: phone,
                        email: email,
                        domain: currentDomain,
                        simulation_date: simDate,
                        notes: notes || ('Simulasi Otomasi ' + (currentDomain ? currentDomain.toUpperCase() : 'INDUSTRI'))
                    })
                });

                const data = await res.json();
                if (res.ok && data.success) {
                    try {
                        sessionStorage.setItem(SIM_LEAD_SESSION_KEY, 'true');
                        sessionStorage.setItem('gat_simulation_lead_user', JSON.stringify({ name, company, jobTitle, phone, email, simDate }));
                    } catch (err) {}
                    syncSimulationResultLocks();
                    closeLeadGateModal();
                    if (typeof pendingSimulationCallback === 'function') {
                        const cb = pendingSimulationCallback;
                        pendingSimulationCallback = null;
                        setTimeout(cb, 180);
                    }
                } else {
                    const firstErr = data.errors ? Object.values(data.errors).flat()[0] : null;
                    errorEl.textContent = firstErr || data.message || 'Gagal menyimpan data. Silakan periksa kembali input Anda.';
                    errorEl.classList.remove('hidden');
                }
            } catch (err) {
                console.error('Lead gate error:', err);
                errorEl.textContent = 'Koneksi ke server terkendala. Silakan coba klik tombol lagi.';
                errorEl.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btnText.textContent = 'Buka Hasil Simulasi & Simpan';
                spinner.classList.add('hidden');
            }
        }
    </script>

    <!-- ===================================================================== -->
    <!-- SIMULATOR LEAD GATE MODAL (Split 2-Column Modern Corporate Card)      -->
    <!-- ===================================================================== -->
    <div id="simLeadGateModal"
         onclick="if (event.target === this) closeLeadGateModal()"
         class="fixed inset-0 z-[9999] hidden items-center justify-center p-3 sm:p-5 bg-slate-950/65 backdrop-blur-sm transition-all duration-300">
        <div id="simLeadGateBox"
             class="relative w-full max-w-[920px] bg-white rounded-[28px] shadow-[0_28px_80px_rgba(15,23,42,0.35)] border border-slate-200/70 p-2.5 sm:p-3 transform transition-all duration-300 scale-95 opacity-0 max-h-[94vh] flex flex-col md:grid md:grid-cols-12 gap-0 overflow-hidden">

            <!-- Close Button (Top Right) -->
            <button type="button" onclick="closeLeadGateModal()" aria-label="Tutup Formulir"
                class="absolute top-4 right-4 sm:top-5 sm:right-5 z-30 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- LEFT PANEL: Luminous Light-Sky Corporate Mesh-Gradient Panel (Desktop & Tablet >= md) -->
            <div class="hidden md:flex md:col-span-5 relative rounded-[22px] overflow-hidden flex-col justify-between p-7 lg:p-8 text-black select-none border border-[#3367A5]/15"
                 style="background:
                    radial-gradient(circle at 18% 12%, #FFFFFF 0%, rgba(255, 255, 255, 0) 45%),
                    radial-gradient(circle at 86% 20%, #C7D2FE 0%, rgba(199, 210, 254, 0) 50%),
                    radial-gradient(circle at 22% 52%, #60A5FA 0%, rgba(96, 165, 250, 0) 55%),
                    radial-gradient(circle at 82% 78%, #E0F2FE 0%, rgba(224, 242, 254, 0) 58%),
                    linear-gradient(150deg, #E0F2FE 0%, #BFDBFE 42%, #C7D2FE 72%, #F0F9FF 100%);">

                <!-- Soft Bottom Veil so Black Bold Text Always Pops Crisp & Clear -->
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-3/5 bg-gradient-to-t from-white/85 via-white/55 to-transparent"></div>

                <!-- Top Brand Mark -->
                <div class="relative z-10 flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-white/85 backdrop-blur-md border border-slate-900/10 flex items-center justify-center shadow-sm">
                        <img src="{{ asset('storage/Logo_Perusahaan(1).png') }}" alt="PT Global Aspect Technology" class="w-6 h-6 object-contain">
                    </div>
                    <span class="text-xs font-extrabold tracking-wider uppercase text-black font-['Agrandir',sans-serif]">
                        GAT Simulator
                    </span>
                </div>

                <!-- Bottom Editorial Headline (Crisp Bold Black Typography) -->
                <div class="relative z-10 space-y-2.5 pt-12">
                    <p class="text-xs sm:text-sm text-black font-['Agrandir',sans-serif] font-bold">
                        PT Global Aspect Technology
                    </p>
                    <h3 class="text-2xl lg:text-[26px] font-extrabold font-['Agrandir',sans-serif] leading-[1.2] tracking-tight text-black">
                        Akses penuh simulasi &amp; analitik otomasi industri Anda
                    </h3>
                    <p class="text-xs text-slate-900 font-['Questrial',sans-serif] font-bold leading-relaxed pt-1">
                        Isi data singkat 1x per sesi untuk langsung menjalankan simulasi, menghitung OEE, energi, dan kualitas daya.
                    </p>
                </div>
            </div>

            <!-- Mobile-only Compact Gradient Header (< md) -->
            <div class="md:hidden rounded-[20px] px-5 py-4 text-white mb-1 shrink-0"
                 style="background: linear-gradient(135deg, #0A1D56 0%, #24539C 55%, #60A5FA 100%);">
                <p class="text-[11px] text-blue-100 font-['Questrial',sans-serif]">PT Global Aspect Technology</p>
                <h3 class="text-base font-bold font-['Agrandir',sans-serif] leading-snug mt-0.5 pr-8">
                    Formulir Akses Simulasi Industri
                </h3>
            </div>

            <!-- RIGHT PANEL: Crisp White Form Surface -->
            <div class="md:col-span-7 flex flex-col justify-center px-4 py-4 sm:px-7 sm:py-6 lg:px-9 lg:py-7 overflow-y-auto font-['Questrial',sans-serif]">
                <!-- Form Heading -->
                <div class="mb-4 sm:mb-5 pr-6">
                    <div class="hidden md:inline-flex w-8 h-8 rounded-xl bg-[#E6F0FA] text-[#3367A5] items-center justify-center mb-2.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl sm:text-2xl font-bold text-slate-900 font-['Agrandir',sans-serif] tracking-tight leading-tight">
                        Formulir Akses Simulasi
                    </h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Lengkapi identitas singkat berikut untuk langsung membuka proses &amp; hasil simulasi.
                    </p>
                </div>

                <!-- Form Inputs -->
                <form id="simLeadGateForm" onsubmit="handleLeadGateSubmit(event)" class="space-y-3">
                    <!-- Tanggal Simulasi (Otomatis Hari Ini) -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Tanggal Simulasi</label>
                        <input type="text" id="sim_gate_date_display" readonly
                            value="{{ now()->translatedFormat('l, d F Y') }}"
                            class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-200 bg-slate-50 text-slate-600 font-semibold cursor-not-allowed select-none">
                        <input type="hidden" id="sim_gate_date" value="{{ now()->toDateString() }}">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Nama Lengkap PIC <span class="text-rose-500">*</span></label>
                            <input type="text" id="sim_gate_name" required placeholder="Budi Santoso"
                                class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Jabatan / Divisi <span class="text-rose-500">*</span></label>
                            <input type="text" id="sim_gate_job_title" required placeholder="Plant Manager / Engineering"
                                class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Nama PT / Perusahaan / Instansi <span class="text-rose-500">*</span></label>
                        <input type="text" id="sim_gate_company" required placeholder="PT Manufaktur Otomotif Maju"
                            class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Kontak / WhatsApp Aktif <span class="text-rose-500">*</span></label>
                            <input type="tel" id="sim_gate_phone" required placeholder="08123456789"
                                class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Email Aktif <span class="text-rose-500">*</span></label>
                            <input type="email" id="sim_gate_email" required placeholder="nama@perusahaan.co.id"
                                class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 font-['Agrandir',sans-serif] mb-1">Catatan / Kebutuhan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <textarea id="sim_gate_notes" rows="2" placeholder="Kebutuhan inspeksi botol, peningkatan OEE, atau monitoring energi..."
                            class="w-full px-3.5 py-2 text-xs sm:text-[13px] rounded-xl border border-slate-300/90 bg-white text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#3367A5]/25 focus:border-[#3367A5] transition-all resize-none font-['Questrial',sans-serif]"></textarea>
                    </div>

                    <div id="simLeadGateError" class="hidden text-xs text-rose-600 bg-rose-50 p-2.5 rounded-xl border border-rose-200"></div>

                    <div class="pt-1.5">
                        <button type="submit" id="simGateSubmitBtn"
                            class="w-full py-2.5 sm:py-3 px-4 rounded-xl text-xs sm:text-sm font-bold font-['Agrandir',sans-serif] text-white bg-[#3367A5] hover:bg-[#244E81] shadow-[0_10px_28px_rgba(51,103,165,0.38)] hover:shadow-[0_12px_32px_rgba(36,78,129,0.45)] transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer active:scale-[0.99]">
                            <span id="simGateBtnText">Buka Hasil Simulasi &amp; Simpan</span>
                            <svg id="simGateBtnSpinner" class="hidden animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
