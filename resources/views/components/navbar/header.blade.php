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
        <div class="w-full px-4 sm:px-6 md:px-8 lg:px-10 xl:px-14 flex items-center justify-between gap-3 lg:gap-6">

            <!-- Brand Logo (Direct WebP, No Circle Wrapper) -->
            <a href="{{ route('home') }}" class="flex items-center shrink-0" title="PT. Global Aspect Technology">
                <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT. Global Aspect Technology"
                    class="h-9 sm:h-12 lg:h-16 w-auto object-contain">
            </a>

            <!-- Desktop Navigation Links (Questrial Font, Scaled & Gliding 3D Dark Glass Pill) -->
            <nav id="nav-track-initial"
                class="relative hidden md:flex items-center gap-6 lg:gap-8 xl:gap-9 text-base lg:text-[18px] xl:text-[19px] font-normal tracking-wide text-gray-800 shrink-0">
                <!-- Single Horizontal Gliding Dark Glass Pill Capsule -->
                <div id="nav-pill-initial"
                    class="absolute pointer-events-none rounded-full bg-gradient-to-b from-[#24262c] to-[#121316] border border-neutral-700/60 shadow-[0_4px_14px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.22)] z-0 transition-[left,width,opacity] duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]"
                    style="top: 50%; transform: translateY(-50%); height: 40px; opacity: 0; left: 0; width: 0;"></div>

                <a href="{{ route('home') }}" data-nav-link
                    data-active="{{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'true' : 'false' }}"
                    data-lang-en="Home" data-lang-id="Beranda"
                    class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Home
                </a>

                <!-- About Us Dropdown -->
                <div class="mega-dropdown-wrapper group py-2 shrink-0">
                    <a href="{{ route('about') }}" data-nav-link
                        data-active="{{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'true' : 'false' }}"
                        class="relative z-10 flex items-center gap-1.5 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white font-medium' : 'text-gray-700' }}">
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

                                    <!-- Item 2: Application -->
                                    <a href="{{ route('application') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
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
                                    </a>

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
                        data-active="{{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'true' : 'false' }}"
                        class="relative z-10 flex items-center gap-1.5 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        <span data-lang-en="Solutions" data-lang-id="Solusi" class="whitespace-nowrap">Solutions</span>
                        <svg class="w-4 h-4 {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </a>

                    <!-- Dropdown Mega Menu (LabsStdio Style) -->
                    <div class="mega-dropdown-menu pt-3 w-[680px] lg:w-[750px]">
                        
                        <!-- Outer Card with Caret Arrow (LabsStudio Rounded 32px & Shadow) -->
                        <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-7 sm:p-8 text-left">
                            <!-- Top Caret Notch -->
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                            <div class="grid grid-cols-2 gap-7">
                                <!-- Column 1 -->
                                <div class="space-y-3.5">
                                        <!-- Item 1: PLC Programming -->
                                        <a href="{{ route('plc-progamming') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                    <rect x="9" y="9" width="6" height="6"></rect>
                                                    <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="PLC Programming" data-lang-id="Pemrograman PLC"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    PLC Programming
                                                </h4>
                                                <p data-lang-en="Mitsubishi, Omron, Siemens, etc." data-lang-id="Mitsubishi, Omron, Siemens, dll."
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Mitsubishi, Omron, Siemens, etc.
                                                </p>
                                            </div>
                                        </a>

                                        <!-- Item 2: Inspection & Record Data System -->
                                        <a href="{{ route('inspection') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7V5a2 2 0 012-2h2m12 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 8v8M10 8v8M14 8v8M17 8v8"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Inspection &amp; Record Data System" data-lang-id="Sistem Inspeksi &amp; Rekam Data"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Inspection &amp; Record Data System
                                                </h4>
                                                <p data-lang-en="High-precision quality assurance" data-lang-id="Jaminan kualitas presisi tinggi"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    High-precision quality assurance
                                                </p>
                                            </div>
                                        </a>

                                        <!-- Item 3: Monitoring System -->
                                        <a href="{{ route('monitoring') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Monitoring System" data-lang-id="Sistem Monitoring"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Monitoring System
                                                </h4>
                                                <p data-lang-en="Real-time industrial telemetry" data-lang-id="Telemetri industri waktu-nyata"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Real-time industrial telemetry
                                                </p>
                                            </div>
                                        </a>
                                </div>

                                <!-- Column 2 -->
                                <div class="space-y-3.5">
                                        <!-- Item 4: Integrator System -->
                                        <a href="{{ route('intergrator') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Integrator System" data-lang-id="Sistem Integrator"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Integrator System
                                                </h4>
                                                <p data-lang-en="End-to-end industrial workflows" data-lang-id="Alur kerja industri terintegrasi"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    End-to-end industrial workflows
                                                </p>
                                            </div>
                                        </a>

                                        <!-- Item 5: Laser Marking & Inkjet Printing -->
                                        <a href="{{ route('laser-marking') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Laser Marking &amp; Inkjet Printing" data-lang-id="Penandaan Laser &amp; Cetak Inkjet"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Laser Marking &amp; Inkjet Printing
                                                </h4>
                                                <p data-lang-en="Precision industrial tracing" data-lang-id="Pelacakan industri presisi"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Precision industrial tracing
                                                </p>
                                            </div>
                                        </a>

                                        <!-- Item 6: Strapping -->
                                        <a href="{{ route('strapping') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                            <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div class="space-y-0.5">
                                                <h4 data-lang-en="Strapping" data-lang-id="Strapping"
                                                    class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                    Strapping
                                                </h4>
                                                <p data-lang-en="Automated packaging systems" data-lang-id="Sistem pengemasan otomatis"
                                                    class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                    Automated packaging systems
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('product') }}" data-nav-link
                    data-active="{{ request()->routeIs('product*') || request()->is('product*') ? 'true' : 'false' }}"
                    data-lang-en="Products" data-lang-id="Produk"
                    class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('product*') || request()->is('product*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Products
                </a>

                <a href="{{ route('contact') }}" data-nav-link
                    data-active="{{ request()->routeIs('contact*') || request()->is('contact*') ? 'true' : 'false' }}"
                    data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                    class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('contact*') || request()->is('contact*') ? 'text-white font-medium' : 'text-gray-700' }}">
                    Contact Us
                </a>
            </nav>

            <!-- Right Action: Quote CTA (LabsStdio Red Gliding Button) -->
            <div class="hidden md:flex items-center shrink-0">
                <a href="{{ route('contact') }}"
                    class="group relative inline-flex items-center justify-center overflow-hidden px-5 lg:px-6 py-2.5 lg:py-3 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-xs sm:text-sm lg:text-[15px] font-normal tracking-wider rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(51,103,165,0.4)] hover:border-[#3367A5]/60 transition-all duration-1000 active:scale-95 whitespace-nowrap shrink-0">
                    <!-- Red Wipe Layer from Left to Right -->
                    <span
                        class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>

                    <!-- Text Layer -->
                    <span data-lang-en="Get A Quote" data-lang-id="Minta Penawaran" class="relative z-10 flex items-center gap-2">
                        Get A Quote
                    </span>
                </a>
            </div>

            <!-- Mobile Hamburger Toggle -->
            <button type="button"
                class="btn-menu-open md:hidden p-2.5 text-gray-700 hover:text-black hover:bg-gray-100 rounded-2xl transition focus:outline-none shrink-0"
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
            <nav
                class="pointer-events-auto flex items-center justify-between gap-2 sm:gap-3.5 px-4 py-2 sm:px-6 sm:py-3 bg-white/95 backdrop-blur-md rounded-full shadow-[0_10px_32px_rgba(0,0,0,0.1)] border border-gray-100 transition-all duration-300 shrink-0">
                <!-- Logo (Direct WebP) -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 pr-2 shrink-0"
                    title="PT. Global Aspect Technology">
                    <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="GAT Logo"
                        class="h-8 sm:h-10 lg:h-12 w-auto object-contain">
                    <span
                        class="font-normal text-xs sm:text-base text-gray-900 tracking-tight md:hidden whitespace-nowrap">GAT</span>
                </a>

                <!-- Desktop Links inside Pill with Gliding Dark Glass Indicator -->
                <nav id="nav-track-scrolled"
                    class="relative hidden md:flex items-center gap-7 lg:gap-8 xl:gap-10 text-lg lg:text-[20px] xl:text-[22px] font-normal tracking-wide text-gray-800 shrink-0">
                    <!-- Single Horizontal Gliding Dark Glass Pill Capsule for Scrolled State -->
                    <div id="nav-pill-scrolled"
                        class="absolute pointer-events-none rounded-full bg-gradient-to-b from-[#24262c] to-[#121316] border border-neutral-700/60 shadow-[0_3px_10px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] z-0 transition-[left,width,opacity] duration-300 ease-[cubic-bezier(0.25,1,0.5,1)]"
                        style="top: 50%; transform: translateY(-50%); height: 44px; opacity: 0; left: 0; width: 0;">
                    </div>

                    <a href="{{ route('home') }}" data-nav-link
                        data-active="{{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'true' : 'false' }}"
                        data-lang-en="Home" data-lang-id="Beranda"
                        class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        Home
                    </a>

                    <!-- About Us Pill Dropdown -->
                    <div class="mega-dropdown-wrapper group shrink-0">
                        <a href="{{ route('about') }}" data-nav-link
                            data-active="{{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'true' : 'false' }}"
                            class="relative z-10 flex items-center gap-1.5 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'text-white font-medium' : 'text-gray-700' }}">
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

                                        <!-- Item 2: Application -->
                                        <a href="{{ route('application') }}" class="group/item flex items-start gap-3.5 p-2.5 rounded-2xl hover:bg-neutral-50 transition-colors">
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
                                        </a>

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
                            data-active="{{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'true' : 'false' }}"
                            class="relative z-10 flex items-center gap-1.5 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white font-medium' : 'text-gray-700' }}">
                            <span data-lang-en="Solutions" data-lang-id="Solusi" class="whitespace-nowrap">Solutions</span>
                            <svg class="w-4 h-4 {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'text-white' : 'text-gray-400' }} transition-transform duration-300 group-hover:rotate-180 shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>

                        <!-- Dropdown Mega Menu (LabsStdio Style) -->
                        <div class="mega-dropdown-menu pt-3 w-[680px] lg:w-[750px]">
                            
                            <!-- Outer Card with Caret Arrow (LabsStudio Rounded 32px & Shadow) -->
                            <div class="relative bg-white rounded-[32px] shadow-[0_30px_70px_rgba(0,0,0,0.16)] border border-neutral-200/90 p-7 sm:p-8 text-left">
                                <!-- Top Caret Notch -->
                                <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-neutral-200/90 rotate-45 z-10"></div>

                                <div class="grid grid-cols-2 gap-7">
                                    <!-- Column 1 -->
                                    <div class="space-y-3.5">
                                            <!-- Item 1: PLC Programming -->
                                            <a href="{{ route('plc-progamming') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                        <rect x="9" y="9" width="6" height="6"></rect>
                                                        <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="PLC Programming" data-lang-id="Pemrograman PLC"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        PLC Programming
                                                    </h4>
                                                    <p data-lang-en="Mitsubishi, Omron, Siemens, etc." data-lang-id="Mitsubishi, Omron, Siemens, dll."
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        Mitsubishi, Omron, Siemens, etc.
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Item 2: Inspection & Record Data System -->
                                            <a href="{{ route('inspection') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7V5a2 2 0 012-2h2m12 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 8v8M10 8v8M14 8v8M17 8v8"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Inspection &amp; Record Data System" data-lang-id="Sistem Inspeksi &amp; Rekam Data"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Inspection &amp; Record Data System
                                                    </h4>
                                                    <p data-lang-en="High-precision quality assurance" data-lang-id="Jaminan kualitas presisi tinggi"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        High-precision quality assurance
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Item 3: Monitoring System -->
                                            <a href="{{ route('monitoring') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Monitoring System" data-lang-id="Sistem Monitoring"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Monitoring System
                                                    </h4>
                                                    <p data-lang-en="Real-time industrial telemetry" data-lang-id="Telemetri industri waktu-nyata"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        Real-time industrial telemetry
                                                    </p>
                                                </div>
                                            </a>
                                        </div>

                                    <!-- Column 2 -->
                                    <div class="space-y-3.5">
                                            <!-- Item 4: Integrator System -->
                                            <a href="{{ route('intergrator') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Integrator System" data-lang-id="Sistem Integrator"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Integrator System
                                                    </h4>
                                                    <p data-lang-en="End-to-end industrial workflows" data-lang-id="Alur kerja industri terintegrasi"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        End-to-end industrial workflows
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Item 5: Laser Marking & Inkjet Printing -->
                                            <a href="{{ route('laser-marking') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Laser Marking &amp; Inkjet Printing" data-lang-id="Penandaan Laser &amp; Cetak Inkjet"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Laser Marking &amp; Inkjet Printing
                                                    </h4>
                                                    <p data-lang-en="Precision industrial tracing" data-lang-id="Pelacakan industri presisi"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        Precision industrial tracing
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Item 6: Strapping -->
                                            <a href="{{ route('strapping') }}" class="group/item flex items-start gap-3.5 p-2 rounded-2xl hover:bg-neutral-50 transition-colors">
                                                <div class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center shrink-0 shadow-sm group-hover/item:bg-[#3367A5] transition-colors">
                                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h4 data-lang-en="Strapping" data-lang-id="Strapping"
                                                        class="text-sm font-bold text-neutral-900 font-['Agrandir',sans-serif] group-hover/item:text-[#3367A5] transition-colors">
                                                        Strapping
                                                    </h4>
                                                    <p data-lang-en="Automated packaging systems" data-lang-id="Sistem pengemasan otomatis"
                                                        class="text-xs text-neutral-500 font-['Agrandir',sans-serif]">
                                                        Automated packaging systems
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('product') }}" data-nav-link
                        data-active="{{ request()->routeIs('product*') || request()->is('product*') ? 'true' : 'false' }}"
                        data-lang-en="Products" data-lang-id="Produk"
                        class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('product*') || request()->is('product*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        Products
                    </a>

                    <a href="{{ route('contact') }}" data-nav-link
                        data-active="{{ request()->routeIs('contact*') || request()->is('contact*') ? 'true' : 'false' }}"
                        data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                        class="relative z-10 px-4 lg:px-5 py-2 lg:py-2.5 rounded-full transition-colors duration-200 whitespace-nowrap {{ request()->routeIs('contact*') || request()->is('contact*') ? 'text-white font-medium' : 'text-gray-700' }}">
                        Contact Us
                    </a>
                </nav>

                <!-- Mobile Hamburger inside Pill -->
                <button type="button"
                    class="btn-menu-open md:hidden p-2 text-gray-700 hover:text-black hover:bg-gray-100 rounded-full transition focus:outline-none shrink-0"
                    aria-label="Open Navigation">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </nav>

        </div>
    </div>


    <!-- ========================================================================= -->
    <!-- MOBILE NAVIGATION MODAL / DRAWER                                          -->
    <!-- ========================================================================= -->
    <div id="mobile-menu"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[110] hidden transition-opacity duration-300 font-['Questrial',sans-serif]">
        <div class="min-h-screen px-4 pt-6 pb-8 flex flex-col justify-start">
            <div class="bg-white rounded-3xl shadow-2xl p-6 max-w-sm w-full mx-auto relative border border-gray-100">
                <!-- Close Button & Brand -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="GAT Logo"
                            class="h-10 w-auto object-contain">
                        <div>
                            <h4 class="font-normal text-base text-gray-900 leading-tight">PT. Global Aspect</h4>
                            <p class="text-xs text-gray-500">Est. 2017 &bull; Integrated Systems</p>
                        </div>
                    </div>
                    <button id="menu-close" type="button"
                        class="p-2 text-gray-400 hover:text-gray-800 rounded-full hover:bg-gray-100 transition focus:outline-none"
                        aria-label="Close Navigation">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="mt-4 space-y-1 text-base font-normal">
                    <a href="{{ route('home') }}" data-lang-en="Home" data-lang-id="Beranda"
                        class="block px-3 py-2 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('home') || request()->is('/') || request()->is('home*') ? 'bg-gray-100 font-medium' : '' }}">Home</a>
                    <!-- About Us Section with Sub-Links in Mobile Menu -->
                    <div class="space-y-1">
                        <a href="{{ route('about') }}" data-lang-en="About Us" data-lang-id="Tentang Kami"
                            class="block px-3 py-2 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('about*') || request()->routeIs('vision-mission') || request()->routeIs('application') || request()->routeIs('projects') || request()->routeIs('project') || request()->is('about*') || request()->is('vision-mission*') || request()->is('application*') || request()->is('projects*') || request()->is('project*') ? 'bg-gray-100 font-medium' : '' }}">About Us</a>
                        <div class="pl-4 space-y-1 border-l-2 border-[#3367A5]/30 ml-2">
                            <a href="{{ route('vision-mission') }}" data-lang-en="Vision, Mission &amp; Goals" data-lang-id="Visi, Misi &amp; Tujuan"
                                class="block px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:text-black hover:bg-gray-50 transition {{ request()->routeIs('vision-mission') ? 'text-[#3367A5] font-bold' : '' }}">Vision, Mission &amp; Goals</a>
                            <a href="{{ route('application') }}" data-lang-en="Applications" data-lang-id="Aplikasi Industri"
                                class="block px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:text-black hover:bg-gray-50 transition {{ request()->routeIs('application') ? 'text-[#3367A5] font-bold' : '' }}">Applications</a>
                            <a href="{{ route('projects') }}" data-lang-en="Projects" data-lang-id="Proyek &amp; Portofolio"
                                class="block px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:text-black hover:bg-gray-50 transition {{ request()->routeIs('projects') || request()->routeIs('project') ? 'text-[#3367A5] font-bold' : '' }}">Projects</a>
                        </div>
                    </div>
                    <a href="{{ route('solution') }}" data-lang-en="Solutions &amp; Services" data-lang-id="Solusi &amp; Layanan"
                        class="block px-3 py-2 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('solution*') || request()->routeIs('plc-progamming') || request()->routeIs('inspection') || request()->routeIs('monitoring') || request()->routeIs('intergrator') || request()->routeIs('laser-marking') || request()->routeIs('strapping') || request()->is('solution*') || request()->is('plc-progamming*') || request()->is('inspection*') || request()->is('monitoring*') || request()->is('intergrator*') || request()->is('laser-marking*') || request()->is('strapping*') ? 'bg-gray-100 font-medium' : '' }}">Solutions
                        &amp; Services</a>
                    <a href="{{ route('product') }}" data-lang-en="Products" data-lang-id="Produk"
                        class="block px-3 py-2 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('product*') || request()->is('product*') ? 'bg-gray-100 font-medium' : '' }}">Products</a>
                    <a href="{{ route('contact') }}" data-lang-en="Contact Us" data-lang-id="Kontak Kami"
                        class="block px-3 py-2 rounded-xl text-gray-800 hover:bg-gray-100 transition {{ request()->routeIs('contact*') || request()->is('contact*') ? 'bg-gray-100 font-medium' : '' }}">Contact
                        Us</a>
                </div>

                <!-- Actions -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex flex-col gap-2">
                    <button onclick="copyGatEmail('admin@gat-aspect.com', this)"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-sm font-normal transition">
                        <svg class="copy-svg w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="copy-label">admin@gat-aspect.com</span>
                    </button>

                    <a href="{{ route('contact') }}"
                        class="group relative overflow-hidden w-full text-center py-3 px-4 bg-black text-white rounded-full text-sm font-normal tracking-wider shadow-md transition-all duration-1000 active:scale-95">
                        <span
                            class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>
                        <span data-lang-en="Get A Quote" data-lang-id="Minta Penawaran" class="relative z-10">Get A Quote</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</header>


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

        // Mobile Menu Event Handlers
        menuOpenBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (mobileMenu) mobileMenu.classList.remove('hidden');
            });
        });

        if (menuClose && mobileMenu) {
            menuClose.addEventListener('click', function () {
                mobileMenu.classList.add('hidden');
            });
        }

        if (mobileMenu) {
            mobileMenu.addEventListener('click', function (e) {
                if (e.target === mobileMenu || e.target.classList.contains('min-h-screen')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
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