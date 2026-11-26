<!-- Google Fonts: Questrial & Agrandir -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

<style>
    html {
        scroll-behavior: smooth;
        overflow-x: clip;
        width: 100%;
        min-height: 100%;
        margin: 0;
        padding: 0;
    }
    @supports not (overflow: clip) {
        html {
            overflow-x: hidden;
        }
    }
    body {
        overflow-x: clip;
        width: 100%;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        position: relative;
    }
    @supports not (overflow: clip) {
        body {
            overflow-x: hidden;
        }
    }
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
    .app-flyout-menu {
        position: absolute;
        left: 100%;
        top: -12px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateX(8px);
        transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1), transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.22s;
        z-index: 1050;
    }
    .group\/app:hover .app-flyout-menu,
    .group\/app:focus-within .app-flyout-menu,
    .app-flyout-menu:hover {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
        transform: translateX(0) !important;
    }
</style>

<!-- Master Dynamic Navbar with LabsStdio Scroll Transition Logic -->
<header id="site-header"
    class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] font-['Questrial',sans-serif]">

    <!-- ========================================================================= -->
    <!-- STATE 1: INITIAL NAVBAR (Nempel Pada Header / At Top, scrollY <= 20)      -->
    <!-- Scaled downwards (112px) & expanded horizontally to prevent line wrapping -->
    <!-- ========================================================================= -->
    <div id="navbar-initial"
        class="w-full bg-white/95 backdrop-blur-md border-b border-gray-200/80 shadow-xs transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] min-h-[68px] h-[68px] sm:min-h-[80px] sm:h-[80px] lg:min-h-[88px] lg:h-[88px] flex items-center">
        <div class="w-full px-4 sm:px-6 lg:px-6 xl:px-14 flex items-center justify-between gap-2 xl:gap-6">

            <!-- Brand Logo (Direct WebP, No Circle Wrapper) -->
            <a href="{{ route('home') }}" class="flex items-center shrink-0" title="PT. Global Aspect Technology">
                <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT. Global Aspect Technology"
                    class="h-9 sm:h-11 xl:h-16 w-auto object-contain">
            </a>

            <!-- Desktop Navigation Links (Questrial Font, Scaled & Gliding 3D Dark Glass Pill) -->
            <nav id="nav-track-initial"
                class="relative hidden lg:flex items-center gap-1.5 xl:gap-6 2xl:gap-9 text-sm xl:text-[17px] 2xl:text-[19px] font-normal tracking-wide text-gray-800 shrink-0">
                <!-- Single Horizontal Gliding Dark Glass Pill Capsule -->
                <div id="nav-pill-initial"
                    class="absolute pointer-events-none rounded-full bg-gradient-to-b from-[#24262c] to-[#121316] border border-neutral-700/60 shadow-[0_4px_14px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.22)] z-0 transition-[left,width,opacity] duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]"
                    style="top: 50%; transform: translateY(-50%); height: 40px; opacity: 0; left: 0; width: 0;"></div>

                <a href="{{ route('home') }}" data-nav-link
                    data-active="{{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'true' : 'false' }}"
                    data-lang-en="Home" data-lang-id="Beranda"
                    class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Home
                </a>

                <!-- About Us Dropdown -->
                <div class="mega-dropdown-wrapper group py-2 shrink-0">
                    <a href="{{ route('about') }}" data-nav-link
                        data-active="{{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'true' : 'false' }}"
                        class="relative z-10 flex items-center gap-1 xl:gap-1.5 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        <span data-lang-en="About Us" data-lang-id="Tentang Kami" class="whitespace-nowrap">About Us</span>
                        <svg class="w-4 h-4 {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>

                    <!-- Dropdown Menu (LabsStdio Style) -->
                    <div class="mega-dropdown-menu pt-3 w-[460px] lg:w-[500px]">
                        <!-- Outer Card with Caret Arrow -->
                        <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-6 sm:p-7 text-left">
                            <!-- Top Caret Notch -->
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                            <!-- List of Sub-Pages -->
                            <div class="space-y-2.5">
                                    <!-- Item 1: Vision, Mission & Goals -->
                                    <a href="{{ route('vision-mission') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                        <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-0.5">
                                            <h4 data-lang-en="Vision, Mission &amp; Goals" data-lang-id="Visi, Misi &amp; Tujuan"
                                                class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                Vision, Mission &amp; Goals
                                            </h4>
                                            <p data-lang-en="Strategic roadmap, corporate values &amp; enduring vision" data-lang-id="Peta jalan strategis, nilai perusahaan &amp; visi berkelanjutan"
                                                class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                Strategic roadmap, corporate values &amp; enduring vision
                                            </p>
                                        </div>
                                    </a>

                                    <!-- Item 2: Application with Side Flyout -->
                                    <div class="relative group/app">
                                        <a href="{{ route('application') }}" class="group/item flex items-center justify-between gap-3 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="flex items-start gap-3.5 min-w-0">
                                                <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Applications" data-lang-id="Aplikasi Industri"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Applications
                                                    </h4>
                                                    <p data-lang-en="Smart automation architectures &amp; cross-sector use cases" data-lang-id="Arsitektur otomasi cerdas &amp; use case lintas sektor"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        Smart automation architectures &amp; cross-sector use cases
                                                    </p>
                                                </div>
                                            </div>
                                            <svg class="w-4 h-4 text-neutral-400 group-hover/item:text-[#3367A5] group-hover/item:translate-x-0.5 transition-all shrink-0 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>

                                        <!-- Side Flyout Submenu (5 Operational Domains - Matching Image 1) -->
                                        <div class="app-flyout-menu pl-3.5 w-[360px] xl:w-[380px]">
                                            <div class="relative bg-white rounded-[26px] shadow-[0_25px_60px_rgba(0,0,0,0.18)] border border-neutral-200/90 p-4 space-y-1.5 text-left">
                                                <!-- Left Caret Notch -->
                                                <div class="absolute -left-1.5 top-7 w-3 h-3 bg-white border-b border-l border-neutral-200/90 rotate-45 z-10 hidden sm:block"></div>

                                                <!-- Domain 1: Manufacturing & FMCG -->
                                                <a href="{{ route('application.manufacturing') }}"
                                                   class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                    <div class="min-w-0">
                                                        <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Manufacturing &amp; FMCG Bottle Inspection" data-lang-id="Inspeksi Botol Manufaktur &amp; FMCG">Manufacturing &amp; FMCG Bottle Inspection</div>
                                                        <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="Bottle inspection &amp; multi-conveyor sync" data-lang-id="Inspeksi botol &amp; sinkronisasi multi-konveyor">Bottle inspection &amp; multi-conveyor sync</div>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Domain 2: Automotive & Heavy Machinery -->
                                                <a href="{{ route('application.automotive') }}"
                                                   class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                    <div class="min-w-0">
                                                        <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Automotive &amp; Machinery OEE" data-lang-id="Otomotif &amp; Mesin OEE">Automotive &amp; Machinery OEE</div>
                                                        <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="OEE line analytics &amp; downtime control" data-lang-id="Analitik OEE lini &amp; kendali downtime">OEE line analytics &amp; downtime control</div>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Domain 3: Pharma & Cleanrooms -->
                                                <a href="{{ route('application.pharma') }}"
                                                   class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                    <div class="min-w-0">
                                                        <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Pharma &amp; Cleanrooms EnPI" data-lang-id="Farmasi &amp; Ruang Bersih EnPI">Pharma &amp; Cleanrooms EnPI</div>
                                                        <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="EnPI energy calculator &amp; carbon credit" data-lang-id="Kalkulator EnPI energi &amp; kredit karbon">EnPI energy calculator &amp; carbon credit</div>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Domain 4: Smart BMS & Energy Information (EIS) -->
                                                <a href="{{ route('application.bms') }}"
                                                   class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                    <div class="min-w-0">
                                                        <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Smart BMS &amp; Energy Information (EIS)" data-lang-id="Smart BMS &amp; Sistem Informasi Energi (EIS)">Smart BMS &amp; Energy Information (EIS)</div>
                                                        <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="EIS sub-metering, storage &amp; cost sizing" data-lang-id="Sub-metering energi &amp; simulasi EIS">EIS sub-metering, storage &amp; cost sizing</div>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                                <!-- Domain 5: Power Quality & Cos φ Telemetry -->
                                                <a href="{{ route('application.packaging') }}"
                                                   class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                    <div class="min-w-0">
                                                        <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Power Quality &amp; Cos φ Telemetry" data-lang-id="Kualitas Daya &amp; Telemetri Cos φ">Power Quality &amp; Cos φ Telemetry</div>
                                                        <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="kVarh monitoring &amp; penalty mitigation" data-lang-id="Monitoring kVarh &amp; mitigasi penalti">kVarh monitoring &amp; penalty mitigation</div>
                                                    </div>
                                                    <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 3: Projects -->
                                    <a href="{{ route('projects') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                        <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-0.5">
                                            <h4 data-lang-en="Projects" data-lang-id="Proyek &amp; Portofolio"
                                                class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                Projects
                                            </h4>
                                            <p data-lang-en="Real-world engineering implementations &amp; client case studies" data-lang-id="Implementasi rekayasa nyata &amp; studi kasus klien"
                                                class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                Real-world engineering implementations &amp; client case studies
                                            </p>
                                        </div>
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- Solutions Dropdown -->
                <div class="mega-dropdown-wrapper group py-2 shrink-0">
                    <a href="{{ route('solution') }}" data-nav-link
                        data-active="{{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'true' : 'false' }}"
                        class="relative z-10 flex items-center gap-1 xl:gap-1.5 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        <span data-lang-en="Solutions" data-lang-id="Solusi" class="whitespace-nowrap">Solutions</span>
                        <svg class="w-4 h-4 {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>

                    <!-- Dropdown Mega Menu (LabsStdio Style) -->
                    <div class="mega-dropdown-menu pt-3 w-[580px] xl:w-[750px]">
                        
                        <!-- Outer Card with Caret Arrow (LabsStudio Rounded 32px & Shadow) -->
                        <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-7 sm:p-8 text-left">
                            <!-- Top Caret Notch -->
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                                                        @php
                                $headerSolutions = \App\Models\Solution::where('show_in_navbar', true)
                                    ->orderBy('sort_order')
                                    ->get();
                                $halfCount = max(1, (int) ceil($headerSolutions->count() / 2));
                                $col1 = $headerSolutions->slice(0, $halfCount);
                                $col2 = $headerSolutions->slice($halfCount);
                            @endphp

                            <div class="grid grid-cols-2 gap-7">
                                <!-- Column 1 -->
                                <div class="space-y-3.5">
                                    @foreach ($col1 as $sol)
                                        @php
                                            $link = $sol->publicUrl();
                                        @endphp
                                        <a href="{{ $link }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                @if (!empty($sol->icon_svg))
                                                    @if (str_contains($sol->icon_svg, '<svg'))
                                                        {!! $sol->icon_svg !!}
                                                    @else
                                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            {!! $sol->icon_svg !!}
                                                        </svg>
                                                    @endif
                                                @else
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                        <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    {{ $sol->name }}
                                                </h4>
                                                <p class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    {{ $sol->short_description ?: Str::limit($sol->description, 35) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Column 2 -->
                                <div class="space-y-3.5">
                                    @foreach ($col2 as $sol)
                                        @php
                                            $link = $sol->publicUrl();
                                        @endphp
                                        <a href="{{ $link }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                @if (!empty($sol->icon_svg))
                                                    @if (str_contains($sol->icon_svg, '<svg'))
                                                        {!! $sol->icon_svg !!}
                                                    @else
                                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            {!! $sol->icon_svg !!}
                                                        </svg>
                                                    @endif
                                                @else
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                        <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    {{ $sol->name }}
                                                </h4>
                                                <p class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    {{ $sol->short_description ?: Str::limit($sol->description, 35) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('product') }}" data-nav-link
                    data-active="{{ request()->routeIs('product*') || request()->is('product*') ? 'true' : 'false' }}"
                    data-lang-en="Products" data-lang-id="Produk"
                    class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('product*') || request()->is('product*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Products
                </a>

                <a href="{{ route('contact') }}" data-nav-link
                    data-active="{{ request()->routeIs('contact*') || request()->is('contact*') ? 'true' : 'false' }}"
                    data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                    class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('contact*') || request()->is('contact*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Contact Us
                </a>
            </nav>

            <!-- Right Action: Quote CTA (LabsStdio Red Gliding Button) -->
            <div class="hidden lg:flex items-center shrink-0">
                <a href="{{ route('contact') }}"
                    class="group relative inline-flex items-center justify-center overflow-hidden px-4 xl:px-6 py-2 xl:py-3 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-xs xl:text-[15px] font-normal tracking-wider rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(51,103,165,0.4)] hover:border-[#3367A5]/60 transition-all duration-1000 active:scale-95 whitespace-nowrap shrink-0">
                    <!-- Red Wipe Layer from Left to Right -->
                    <span
                        class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>

                    <!-- Text Layer -->
                    <span data-lang-en="Get A Quote" data-lang-id="Minta Penawaran" class="relative z-10 flex items-center gap-2">
                        Get A Quote
                    </span>
                </a>
            </div>

            <!-- Mobile / Tablet Hamburger Toggle (< lg) -->
            <button type="button"
                class="btn-menu-open lg:hidden p-2.5 text-gray-700 hover:text-black hover:bg-gray-100 rounded-2xl transition focus:outline-none shrink-0"
                aria-label="Open Navigation">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

        </div>
    </div>


    <!-- ========================================================================= -->
    <!-- STATE 2: SCROLLED FLOATING CAPSULE (Muncul Saat Scroll, scrollY > 20)      -->
    <!-- ========================================================================= -->
    <div id="navbar-scrolled"
        class="w-full pointer-events-none px-4 sm:px-6 transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] opacity-0 -translate-y-6 pointer-events-none hidden font-['Questrial',sans-serif]">
        <div class="max-w-7xl mx-auto flex items-center justify-center pt-3 sm:pt-4">

            <!-- Center Pill: Logo + Nav Links -->
            <div
                class="pointer-events-auto flex items-center justify-between gap-2 sm:gap-3.5 px-4 py-2 sm:px-6 sm:py-3 bg-white/95 backdrop-blur-md rounded-full shadow-[0_10px_32px_rgba(0,0,0,0.1)] border border-gray-100 transition-all duration-300 shrink-0">
                <!-- Logo (Direct WebP) -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 pr-2 shrink-0"
                    title="PT. Global Aspect Technology">
                    <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="GAT Logo"
                        class="h-8 sm:h-10 lg:h-12 w-auto object-contain">
                    <span
                        class="font-normal text-xs sm:text-base text-gray-900 tracking-tight lg:hidden whitespace-nowrap">GAT</span>
                </a>

                <!-- Desktop Links inside Pill with Gliding Dark Glass Indicator -->
                <nav id="nav-track-scrolled"
                    class="relative hidden lg:flex items-center gap-2 xl:gap-8 2xl:gap-10 text-sm xl:text-[19px] 2xl:text-[22px] font-normal tracking-wide text-gray-800 shrink-0">
                    <!-- Single Horizontal Gliding Dark Glass Pill Capsule for Scrolled State -->
                    <div id="nav-pill-scrolled"
                        class="absolute pointer-events-none rounded-full bg-gradient-to-b from-[#24262c] to-[#121316] border border-neutral-700/60 shadow-[0_3px_10px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] z-0 transition-[left,width,opacity] duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]"
                        style="top: 50%; transform: translateY(-50%); height: 44px; opacity: 0; left: 0; width: 0;">
                    </div>

                    <a href="{{ route('home') }}" data-nav-link
                        data-active="{{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'true' : 'false' }}"
                        data-lang-en="Home" data-lang-id="Beranda"
                    class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Home
                </a>

                <!-- About Us Pill Dropdown -->
                <div class="mega-dropdown-wrapper group shrink-0">
                    <a href="{{ route('about') }}" data-nav-link
                        data-active="{{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'true' : 'false' }}"
                        class="relative z-10 flex items-center gap-1.5 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white font-medium' : 'text-gray-700' }}">
                            <span data-lang-en="About Us" data-lang-id="Tentang Kami" class="whitespace-nowrap">About Us</span>
                            <svg class="w-4 h-4 {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>

                        <!-- Dropdown Mega Menu (LabsStdio Style) -->
                        <div class="mega-dropdown-menu pt-3 w-[460px] lg:w-[500px]">
                            <!-- Outer Card with Caret Arrow -->
                            <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-6 sm:p-7 text-left">
                                <!-- Top Caret Notch -->
                                <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                                <!-- List of Sub-Pages -->
                                <div class="space-y-2.5">
                                        <!-- Item 1: Vision, Mission & Goals -->
                                        <a href="{{ route('vision-mission') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Vision, Mission &amp; Goals" data-lang-id="Visi, Misi &amp; Tujuan"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Vision, Mission &amp; Goals
                                                </h4>
                                                <p data-lang-en="Strategic roadmap, corporate values &amp; enduring vision" data-lang-id="Peta jalan strategis, nilai perusahaan &amp; visi berkelanjutan"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Strategic roadmap, corporate values &amp; enduring vision
                                                </p>
                                            </div>
                                        </a>

                                        <!-- Item 2: Application with Side Flyout -->
                                        <div class="relative group/app">
                                            <a href="{{ route('application') }}" class="group/item flex items-center justify-between gap-3 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="flex items-start gap-3.5 min-w-0">
                                                    <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="space-y-0.5">
                                                        <h4 data-lang-en="Applications" data-lang-id="Aplikasi Industri"
                                                            class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                            Applications
                                                        </h4>
                                                        <p data-lang-en="Smart automation architectures &amp; cross-sector use cases" data-lang-id="Arsitektur otomasi cerdas &amp; use case lintas sektor"
                                                            class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                            Smart automation architectures &amp; cross-sector use cases
                                                        </p>
                                                    </div>
                                                </div>
                                                <svg class="w-4 h-4 text-neutral-400 group-hover/item:text-[#3367A5] group-hover/item:translate-x-0.5 transition-all shrink-0 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>

                                            <!-- Side Flyout Submenu (5 Operational Domains - Matching Image 1) -->
                                            <div class="app-flyout-menu pl-3.5 w-[360px] xl:w-[380px]">
                                                <div class="relative bg-white rounded-[26px] shadow-[0_25px_60px_rgba(0,0,0,0.18)] border border-neutral-200/90 p-4 space-y-1.5 text-left">
                                                    <!-- Left Caret Notch -->
                                                    <div class="absolute -left-1.5 top-7 w-3 h-3 bg-white border-b border-l border-neutral-200/90 rotate-45 z-10 hidden sm:block"></div>

                                                    <!-- Domain 1: Manufacturing & FMCG -->
                                                    <a href="{{ route('application.manufacturing') }}"
                                                       class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                        <div class="min-w-0">
                                                            <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Manufacturing &amp; FMCG Bottle Inspection" data-lang-id="Inspeksi Botol Manufaktur &amp; FMCG">Manufacturing &amp; FMCG Bottle Inspection</div>
                                                            <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="Bottle inspection &amp; multi-conveyor sync" data-lang-id="Inspeksi botol &amp; sinkronisasi multi-konveyor">Bottle inspection &amp; multi-conveyor sync</div>
                                                        </div>
                                                        <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </a>

                                                    <!-- Domain 2: Automotive & Heavy Machinery -->
                                                    <a href="{{ route('application.automotive') }}"
                                                       class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                        <div class="min-w-0">
                                                            <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Automotive &amp; Machinery OEE" data-lang-id="Otomotif &amp; Mesin OEE">Automotive &amp; Machinery OEE</div>
                                                            <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="OEE line analytics &amp; downtime control" data-lang-id="Analitik OEE lini &amp; kendali downtime">OEE line analytics &amp; downtime control</div>
                                                        </div>
                                                        <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </a>

                                                    <!-- Domain 3: Pharma & Cleanrooms -->
                                                    <a href="{{ route('application.pharma') }}"
                                                       class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                        <div class="min-w-0">
                                                            <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Pharma &amp; Cleanrooms EnPI" data-lang-id="Farmasi &amp; Ruang Bersih EnPI">Pharma &amp; Cleanrooms EnPI</div>
                                                            <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="EnPI energy calculator &amp; carbon credit" data-lang-id="Kalkulator EnPI energi &amp; kredit karbon">EnPI energy calculator &amp; carbon credit</div>
                                                        </div>
                                                        <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </a>

                                                    <!-- Domain 4: Smart BMS & Energy Information (EIS) -->
                                                    <a href="{{ route('application.bms') }}"
                                                       class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                        <div class="min-w-0">
                                                            <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="Smart BMS &amp; Energy Information (EIS)" data-lang-id="Smart BMS &amp; Sistem Informasi Energi (EIS)">Smart BMS &amp; Energy Information (EIS)</div>
                                                            <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="EIS sub-metering, storage &amp; cost sizing" data-lang-id="Sub-metering energi &amp; simulasi EIS">EIS sub-metering, storage &amp; cost sizing</div>
                                                        </div>
                                                        <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </a>

                                                    <!-- Domain 5: End-of-Line Packaging -->
                                                    <a href="{{ route('application.packaging') }}"
                                                       class="group/sub flex items-center justify-between px-3 py-2 rounded-xl hover:bg-neutral-50 transition-all">
                                                        <div class="min-w-0">
                                                            <div class="text-xs font-bold text-neutral-900 group-hover/sub:text-[#3367A5] font-['Agrandir',sans-serif] transition-colors truncate" data-lang-en="End-of-Line Packaging" data-lang-id="Pengemasan End-of-Line">End-of-Line Packaging</div>
                                                            <div class="text-[11px] text-neutral-400 font-['Questrial',sans-serif] truncate" data-lang-en="3,500N arch strapping &amp; turntables" data-lang-id="Mesin strapping 3.500N &amp; meja putar">3,500N arch strapping &amp; turntables</div>
                                                        </div>
                                                        <svg class="w-3.5 h-3.5 text-neutral-400 group-hover/sub:text-[#3367A5] group-hover/sub:translate-x-0.5 transition-all shrink-0 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Item 3: Projects -->
                                        <a href="{{ route('projects') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-10 h-10 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Projects" data-lang-id="Proyek &amp; Portofolio"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Projects
                                                </h4>
                                                <p data-lang-en="Real-world engineering implementations &amp; client case studies" data-lang-id="Implementasi rekayasa nyata &amp; studi kasus klien"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Real-world engineering implementations &amp; client case studies
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- Solutions Pill Dropdown -->
                    <div class="mega-dropdown-wrapper group shrink-0">
                        <a href="{{ route('solution') }}" data-nav-link
                            data-active="{{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'true' : 'false' }}"
                            class="relative z-10 flex items-center gap-1.5 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white font-medium' : 'text-gray-700' }}">
                            <span data-lang-en="Solutions" data-lang-id="Solusi" class="whitespace-nowrap">Solutions</span>
                            <svg class="w-4 h-4 {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('software*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>

                        <!-- Dropdown Mega Menu (LabsStdio Style) -->
                        <div class="mega-dropdown-menu pt-3 w-[580px] xl:w-[750px]">
                            
                            <!-- Outer Card with Caret Arrow (LabsStudio Rounded 32px & Shadow) -->
                            <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-7 sm:p-8 text-left">
                                <!-- Top Caret Notch -->
                                <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                                                            @php
                                $headerSolutions = \App\Models\Solution::where('show_in_navbar', true)
                                    ->orderBy('sort_order')
                                    ->get();
                                $halfCount = max(1, (int) ceil($headerSolutions->count() / 2));
                                $col1 = $headerSolutions->slice(0, $halfCount);
                                $col2 = $headerSolutions->slice($halfCount);
                            @endphp

                            <div class="grid grid-cols-2 gap-7">
                                <!-- Column 1 -->
                                <div class="space-y-3.5">
                                    @foreach ($col1 as $sol)
                                        @php
                                            $link = $sol->publicUrl();
                                        @endphp
                                        <a href="{{ $link }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                @if (!empty($sol->icon_svg))
                                                    @if (str_contains($sol->icon_svg, '<svg'))
                                                        {!! $sol->icon_svg !!}
                                                    @else
                                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            {!! $sol->icon_svg !!}
                                                        </svg>
                                                    @endif
                                                @else
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                        <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    {{ $sol->name }}
                                                </h4>
                                                <p class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    {{ $sol->short_description ?: Str::limit($sol->description, 35) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Column 2 -->
                                <div class="space-y-3.5">
                                    @foreach ($col2 as $sol)
                                        @php
                                            $link = $sol->publicUrl();
                                        @endphp
                                        <a href="{{ $link }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                @if (!empty($sol->icon_svg))
                                                    @if (str_contains($sol->icon_svg, '<svg'))
                                                        {!! $sol->icon_svg !!}
                                                    @else
                                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            {!! $sol->icon_svg !!}
                                                        </svg>
                                                    @endif
                                                @else
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                        <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    {{ $sol->name }}
                                                </h4>
                                                <p class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    {{ $sol->short_description ?: Str::limit($sol->description, 35) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <a href="{{ route('product') }}" data-nav-link
                        data-active="{{ request()->routeIs('product*') || request()->is('product*') ? 'true' : 'false' }}"
                        data-lang-en="Products" data-lang-id="Produk"
                        class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('product*') || request()->is('product*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        Products
                    </a>

                    <a href="{{ route('contact') }}" data-nav-link
                        data-active="{{ request()->routeIs('contact*') || request()->is('contact*') ? 'true' : 'false' }}"
                        data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                        class="relative z-10 px-3 xl:px-4 2xl:px-5 py-2 xl:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('contact*') || request()->is('contact*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        Contact Us
                    </a>
                </nav>

                <!-- Mobile / Tablet Hamburger inside Pill (< lg) -->
                <button type="button"
                    class="btn-menu-open lg:hidden p-2 text-gray-700 hover:text-black hover:bg-gray-100 rounded-full transition focus:outline-none shrink-0"
                    aria-label="Open Navigation">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

</header>


    <!-- ========================================================================= -->
    <!-- MOBILE NAVIGATION MODAL / DRAWER (Scrollable Compact Accordion)           -->
    <!-- ========================================================================= -->
    <style>
        #mobile-menu-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(51, 103, 165, 0.35) transparent;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-y;
        }
        #mobile-menu-scroll::-webkit-scrollbar {
            width: 5px;
        }
        #mobile-menu-scroll::-webkit-scrollbar-track {
            background: transparent;
            margin: 6px 0;
        }
        #mobile-menu-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(51, 103, 165, 0.35);
            border-radius: 9999px;
        }
        #mobile-menu-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(51, 103, 165, 0.6);
        }
    </style>
    <div id="mobile-menu"
        data-lenis-prevent data-lenis-prevent-wheel data-lenis-prevent-touch
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] hidden p-3 sm:p-6 items-center justify-center font-['Questrial',sans-serif]"
        style="display: none;">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm sm:max-w-md w-full max-h-[85vh] max-h-[85dvh] flex flex-col overflow-hidden relative">
            <!-- Fixed Brand Header -->
            <div class="shrink-0 flex items-center justify-between px-5 pt-5 pb-3.5">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="GAT Logo"
                        class="h-9 w-auto object-contain">
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 font-['Agrandir',sans-serif] leading-tight">PT. Global Aspect</h4>
                        <p class="text-[11px] text-gray-500">Est. 2017 &bull; Integrated Systems</p>
                    </div>
                </div>
                <button id="menu-close" type="button"
                    class="p-2 text-gray-500 hover:text-gray-900 rounded-full hover:bg-gray-100 transition focus:outline-none"
                    aria-label="Close Navigation">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Vertically Scrollable Navigation Links Container (Always scrollable when dropdowns expand) -->
            <div id="mobile-menu-scroll"
                data-lenis-prevent data-lenis-prevent-wheel data-lenis-prevent-touch
                class="flex-1 min-h-0 overflow-y-auto overscroll-y-contain touch-pan-y px-4 py-2.5 space-y-1 text-[15px] font-normal">
                <a href="{{ route('home') }}" data-lang-en="Home" data-lang-id="Beranda"
                    class="block px-3.5 py-2.5 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'bg-gray-100 font-semibold text-gray-950' : '' }}">Home</a>

                <!-- About Us Accordion -->
                <div class="rounded-xl overflow-hidden">
                    <div class="flex items-center justify-between rounded-xl hover:bg-gray-100 transition {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application*') || request()->routeIs('projects') || request()->routeIs('project') ? 'bg-gray-100 font-semibold text-gray-950' : 'text-gray-800' }}">
                        <a href="{{ route('about') }}" data-lang-en="About Us" data-lang-id="Tentang Kami"
                            class="flex-1 px-3.5 py-2.5 text-inherit">About Us</a>
                        <button type="button" onclick="toggleMobileAccordion('mob-sub-about', this)"
                            class="px-3.5 py-2.5 text-gray-500 hover:text-[#3367A5] focus:outline-none"
                            aria-label="Toggle About Submenu">
                            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div id="mob-sub-about" class="hidden pl-3 pr-2 pb-2 pt-1 space-y-1">
                        <a href="{{ route('vision-mission') }}" data-lang-en="Vision, Mission &amp; Goals" data-lang-id="Visi, Misi &amp; Tujuan"
                            class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-black hover:bg-gray-50 transition {{ request()->routeIs('vision-mission') ? 'text-[#3367A5] font-bold bg-[#3367A5]/10' : '' }}">Vision, Mission &amp; Goals</a>

                        <div>
                            <div class="flex items-center justify-between rounded-lg hover:bg-gray-50 transition">
                                <a href="{{ route('application') }}" data-lang-en="Applications" data-lang-id="Aplikasi Industri"
                                    class="flex-1 px-3 py-2 text-sm {{ request()->routeIs('application*') ? 'text-[#3367A5] font-bold' : 'text-gray-600' }}">Applications</a>
                                <button type="button" onclick="toggleMobileAccordion('mob-sub-apps', this)"
                                    class="px-3 py-2 text-gray-400 hover:text-[#3367A5] focus:outline-none"
                                    aria-label="Toggle Applications Submenu">
                                    <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                            </div>
                            <div id="mob-sub-apps" class="hidden pl-3 space-y-0.5 py-1">
                                <a href="{{ route('application.manufacturing') }}" data-lang-en="Manufacturing &amp; FMCG" data-lang-id="Manufaktur &amp; FMCG" class="block px-2.5 py-1.5 rounded-lg text-xs text-gray-500 hover:text-[#3367A5] hover:bg-gray-50">Manufacturing &amp; FMCG</a>
                                <a href="{{ route('application.automotive') }}" data-lang-en="Automotive &amp; OEE" data-lang-id="Otomotif &amp; OEE" class="block px-2.5 py-1.5 rounded-lg text-xs text-gray-500 hover:text-[#3367A5] hover:bg-gray-50">Automotive &amp; OEE</a>
                                <a href="{{ route('application.pharma') }}" data-lang-en="Pharma &amp; Cleanrooms" data-lang-id="Farmasi &amp; Ruang Bersih" class="block px-2.5 py-1.5 rounded-lg text-xs text-gray-500 hover:text-[#3367A5] hover:bg-gray-50">Pharma &amp; Cleanrooms</a>
                                <a href="{{ route('application.bms') }}" data-lang-en="Smart BMS &amp; EIS" data-lang-id="Smart BMS &amp; EIS" class="block px-2.5 py-1.5 rounded-lg text-xs text-gray-500 hover:text-[#3367A5] hover:bg-gray-50">Smart BMS &amp; EIS</a>
                                <a href="{{ route('application.packaging') }}" data-lang-en="End-of-Line Packaging" data-lang-id="Pengemasan End-of-Line" class="block px-2.5 py-1.5 rounded-lg text-xs text-gray-500 hover:text-[#3367A5] hover:bg-gray-50">End-of-Line Packaging</a>
                            </div>
                        </div>

                        <a href="{{ route('projects') }}" data-lang-en="Projects" data-lang-id="Proyek &amp; Portofolio"
                            class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-black hover:bg-gray-50 transition {{ request()->routeIs('projects') || request()->routeIs('project') ? 'text-[#3367A5] font-bold bg-[#3367A5]/10' : '' }}">Projects</a>
                    </div>
                </div>

                <!-- Solutions & Services Accordion -->
                @php
                    $mobileSolutions = \App\Models\Solution::where('show_in_navbar', true)->orderBy('sort_order')->get();
                @endphp
                <div class="rounded-xl overflow-hidden">
                    <div class="flex items-center justify-between rounded-xl hover:bg-gray-100 transition {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('software') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') ? 'bg-gray-100 font-semibold text-gray-950' : 'text-gray-800' }}">
                        <a href="{{ route('solution') }}" data-lang-en="Solutions &amp; Services" data-lang-id="Solusi &amp; Layanan"
                            class="flex-1 px-3.5 py-2.5 text-inherit">Solutions &amp; Services</a>
                        <button type="button" onclick="toggleMobileAccordion('mob-sub-solutions', this)"
                            class="px-3.5 py-2.5 text-gray-500 hover:text-[#3367A5] focus:outline-none"
                            aria-label="Toggle Solutions Submenu">
                            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div id="mob-sub-solutions" class="hidden pl-3 pr-2 pb-2 pt-1 space-y-1">
                        @foreach ($mobileSolutions as $msol)
                            <a href="{{ $msol->publicUrl() }}"
                                class="block px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:text-[#3367A5] hover:bg-gray-50 transition">
                                {{ $msol->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('product') }}" data-lang-en="Products" data-lang-id="Produk"
                    class="block px-3.5 py-2.5 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('product*') || request()->is('product*') ? 'bg-gray-100 font-semibold text-gray-950' : '' }}">Products</a>
                <a href="{{ route('contact') }}" data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                    class="block px-3.5 py-2.5 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('contact*') || request()->is('contact*') ? 'bg-gray-100 font-semibold text-gray-950' : '' }}">Contact Us</a>
            </div>

            <!-- Pinned Compact Bottom Actions (Always Visible Inside Mobile Screen) -->
            <div class="shrink-0 px-5 pt-3 pb-5 bg-gray-50/80 flex flex-col gap-2">
                <button onclick="copyGatEmail('admin@gat-aspect.com', this)"
                    class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-white hover:bg-gray-100 text-gray-800 rounded-full text-xs sm:text-sm font-normal shadow-xs transition">
                    <svg class="copy-svg w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                    <span class="copy-label">admin@gat-aspect.com</span>
                </button>

                <a href="{{ route('contact') }}"
                    class="group relative overflow-hidden w-full text-center py-2.5 px-4 bg-black text-white rounded-full text-xs sm:text-sm font-normal tracking-wider shadow-md transition-all duration-1000 active:scale-95">
                    <span
                        class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>
                    <span data-lang-en="Get A Quote" data-lang-id="Minta Penawaran" class="relative z-10">Get A Quote</span>
                </a>
            </div>
        </div>
    </div>


<!-- ========================================================================= -->
<!-- LABSSTDIO SCROLL & TRANSITION LOGIC                                       -->
<!-- ========================================================================= -->
<script>
    (function () {
        const header = document.getElementById('site-header');
        const navInitial = document.getElementById('navbar-initial');
        const navScrolled = document.getElementById('navbar-scrolled');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClose = document.getElementById('menu-close');
        const menuOpenBtns = document.querySelectorAll('.btn-menu-open, #menu-toggle');

        let isScrolled = false;
        let isVisible = true;
        let lastScrollY = typeof window !== 'undefined' ? window.scrollY : 0;

        function updateNavbarState() {
            const currentScrollY = window.scrollY;

            // 1. Logic Pergantian Bentuk: scrollY > 20
            if (currentScrollY > 20) {
                if (!isScrolled) {
                    isScrolled = true;
                    navInitial.classList.add('opacity-0', '-translate-y-full', 'pointer-events-none');
                    navInitial.classList.remove('opacity-100', 'translate-y-0');
                    setTimeout(() => {
                        if (isScrolled) navInitial.classList.add('hidden');
                    }, 400);

                    navScrolled.classList.remove('hidden');
                    void navScrolled.offsetWidth;
                    navScrolled.classList.remove('opacity-0', '-translate-y-6', 'pointer-events-none');
                    navScrolled.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    if (pillScrolled) pillScrolled.update(true);
                }
            } else {
                if (isScrolled) {
                    isScrolled = false;
                    navScrolled.classList.add('opacity-0', '-translate-y-6', 'pointer-events-none');
                    navScrolled.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    setTimeout(() => {
                        if (!isScrolled) navScrolled.classList.add('hidden');
                    }, 400);

                    navInitial.classList.remove('hidden');
                    void navInitial.offsetWidth;
                    navInitial.classList.remove('opacity-0', '-translate-y-full', 'pointer-events-none');
                    navInitial.classList.add('opacity-100', 'translate-y-0');
                    if (pillInitial) pillInitial.update(true);
                }
            }

            // 2. Logic Auto Hide/Show Berdasarkan Arah Scroll
            const isMenuOpen = mobileMenu && !mobileMenu.classList.contains('hidden');

            if (currentScrollY < 100) {
                isVisible = true;
                header.classList.remove('-translate-y-full', 'opacity-0');
                header.classList.add('translate-y-0', 'opacity-100');
            } else if (currentScrollY > lastScrollY && currentScrollY > 400 && !isMenuOpen) {
                isVisible = false;
                header.classList.remove('translate-y-0', 'opacity-100');
                header.classList.add('-translate-y-full', 'opacity-0');
            } else if (currentScrollY < lastScrollY) {
                isVisible = true;
                header.classList.remove('-translate-y-full', 'opacity-0');
                header.classList.add('translate-y-0', 'opacity-100');
            }

            lastScrollY = currentScrollY;
        }

        // =========================================================================
        // HORIZONTAL GLIDING 3D DARK GLASS PILL TRACKER
        // =========================================================================
        function initHorizontalSlidePill(containerId, pillId) {
            const container = document.getElementById(containerId);
            const pill = document.getElementById(pillId);
            if (!container || !pill) return null;

            const links = container.querySelectorAll('[data-nav-link]');
            let activeLink = container.querySelector('[data-nav-link][data-active="true"]');
            let currentHovered = null;

            function setActiveColors(currentLink) {
                links.forEach(l => {
                    const icon = l.querySelector('svg');
                    if (l === currentLink) {
                        l.classList.add('text-white', 'font-medium');
                        l.classList.remove('text-gray-700');
                        if (icon) {
                            icon.classList.add('text-white');
                            icon.classList.remove('text-gray-400');
                        }
                    } else {
                        l.classList.remove('text-white', 'font-medium');
                        l.classList.add('text-gray-700');
                        if (icon) {
                            icon.classList.remove('text-white');
                            icon.classList.add('text-gray-400');
                        }
                    }
                });
            }

            function slideTo(target, immediate = false) {
                if (!target || !pill) return;
                const cRect = container.getBoundingClientRect();
                const tRect = target.getBoundingClientRect();
                if (cRect.width === 0 || tRect.width === 0) return;

                const left = tRect.left - cRect.left;
                const width = tRect.width;

                if (immediate) {
                    pill.style.transition = 'none';
                } else {
                    pill.style.transition = 'left 300ms cubic-bezier(0.25, 1, 0.5, 1), width 300ms cubic-bezier(0.25, 1, 0.5, 1), opacity 200ms ease';
                }

                pill.style.left = left + 'px';
                pill.style.width = width + 'px';
                pill.style.opacity = '1';

                setActiveColors(target);

                if (immediate) {
                    void pill.offsetWidth;
                    pill.style.transition = 'left 300ms cubic-bezier(0.25, 1, 0.5, 1), width 300ms cubic-bezier(0.25, 1, 0.5, 1), opacity 200ms ease';
                }
            }

            // Mouseover delegation
            container.addEventListener('mouseover', (e) => {
                const link = e.target.closest('[data-nav-link]');
                if (link && container.contains(link)) {
                    currentHovered = link;
                    slideTo(link, false);
                }
            });

            container.addEventListener('mouseleave', () => {
                currentHovered = null;
                activeLink = container.querySelector('[data-nav-link][data-active="true"]');
                if (activeLink) {
                    slideTo(activeLink, false);
                } else {
                    pill.style.opacity = '0';
                    setActiveColors(null);
                }
            });

            function update(immediate = false) {
                activeLink = container.querySelector('[data-nav-link][data-active="true"]');
                const target = (currentHovered && container.contains(currentHovered)) ? currentHovered : activeLink;
                if (target) {
                    slideTo(target, immediate);
                } else {
                    pill.style.opacity = '0';
                    setActiveColors(null);
                }
            }

            // ResizeObserver & MutationObserver to track any dynamic width/text changes (e.g. language translations)
            if (typeof ResizeObserver !== 'undefined') {
                const ro = new ResizeObserver(() => {
                    update(false);
                });
                links.forEach(l => ro.observe(l));
                ro.observe(container);
            }

            if (typeof MutationObserver !== 'undefined') {
                const mo = new MutationObserver(() => {
                    update(false);
                });
                mo.observe(container, { childList: true, characterData: true, subtree: true });
            }

            update(true);

            return { update, slideTo };
        }

        const pillInitial = initHorizontalSlidePill('nav-track-initial', 'nav-pill-initial');
        const pillScrolled = initHorizontalSlidePill('nav-track-scrolled', 'nav-pill-scrolled');

        function updateAllPills(immediate = true) {
            if (pillInitial) pillInitial.update(immediate);
            if (pillScrolled) pillScrolled.update(immediate);
        }

        window.updateGatNavPills = updateAllPills;

        window.addEventListener('gatLanguageChanged', () => {
            updateAllPills(false);
            requestAnimationFrame(() => updateAllPills(false));
            setTimeout(() => updateAllPills(false), 30);
            setTimeout(() => updateAllPills(false), 100);
            setTimeout(() => updateAllPills(false), 250);
        });

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => setTimeout(() => updateAllPills(true), 20));
        } else {
            setTimeout(() => updateAllPills(true), 20);
        }
        window.addEventListener('load', () => updateAllPills(true));
        window.addEventListener('resize', () => updateAllPills(true));
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(() => updateAllPills(true));
        }

        window.addEventListener('scroll', updateNavbarState, { passive: true });
        updateNavbarState();

        // Mobile Menu Event Handlers (Full-Viewport Drawer outside header stacking context)
        const mobileMenuScroll = document.getElementById('mobile-menu-scroll');

        function openMobileMenu() {
            if (!mobileMenu) return;
            mobileMenu.classList.remove('hidden');
            mobileMenu.style.display = 'flex';
            if (mobileMenuScroll) mobileMenuScroll.scrollTop = 0;
            document.documentElement.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            if (!mobileMenu) return;
            mobileMenu.classList.add('hidden');
            mobileMenu.style.display = 'none';
            document.documentElement.style.overflow = '';
        }

        window.toggleMobileAccordion = function (targetId, btnEl) {
            const sub = document.getElementById(targetId);
            if (!sub) return;
            const willOpen = sub.classList.contains('hidden');
            sub.classList.toggle('hidden');
            const svg = btnEl ? btnEl.querySelector('svg') : null;
            if (svg) {
                svg.style.transform = willOpen ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        };

        document.addEventListener('click', function (e) {
            const opener = e.target.closest('.btn-menu-open, #menu-toggle');
            if (opener) {
                e.preventDefault();
                e.stopPropagation();
                openMobileMenu();
            }
        });

        if (menuClose) {
            menuClose.addEventListener('click', function (e) {
                e.stopPropagation();
                closeMobileMenu();
            });
        }

        if (mobileMenu) {
            mobileMenu.addEventListener('click', function (e) {
                if (e.target === mobileMenu) {
                    closeMobileMenu();
                }
            });
            mobileMenu.querySelectorAll('a[href]').forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mobileMenu && mobileMenu.style.display === 'flex') {
                closeMobileMenu();
            }
        });
    })();

    // Helper Copy Email dengan Feedback Visual
    function copyGatEmail(email, buttonEl) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(email).then(() => {
                showButtonCopiedFeedback(buttonEl);
            }).catch(() => {
                execCopy(email, buttonEl);
            });
        } else {
            execCopy(email, buttonEl);
        }
    }

    function execCopy(email, buttonEl) {
        const temp = document.createElement("textarea");
        temp.value = email;
        temp.style.position = "fixed";
        temp.style.left = "-9999px";
        document.body.appendChild(temp);
        temp.focus();
        temp.select();
        try {
            document.execCommand('copy');
            showButtonCopiedFeedback(buttonEl);
        } catch (err) {
            window.location.href = "mailto:" + email;
        }
        document.body.removeChild(temp);
    }

    function showButtonCopiedFeedback(buttonEl) {
        if (!buttonEl) return;
        const label = buttonEl.querySelector('.copy-label');
        const icon = buttonEl.querySelector('.copy-svg');
        if (!label) return;

        const originalText = label.innerText;
        label.innerText = 'Copied!';
        if (icon) {
            icon.innerHTML = '<polyline points="20 6 9 17 4 12"></polyline>';
            icon.classList.add('text-emerald-600');
        }

        setTimeout(() => {
            label.innerText = originalText;
            if (icon) {
                icon.innerHTML = '<rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>';
                icon.classList.remove('text-emerald-600');
            }
        }, 2000);
    }
</script>