<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automotive & Heavy Machinery Automation - PT. Global Aspect Technology</title>

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
        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }

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

        .sim-launch-btn {
            background-color: #3367A5 !important;
            color: #ffffff !important;
            border: none !important;
            outline: none !important;
            text-decoration: none !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .sim-launch-btn * {
            color: #ffffff !important;
            transition: color 0.3s ease, stroke 0.3s ease !important;
        }
        .sim-launch-btn svg {
            stroke: #ffffff !important;
        }
        .sim-launch-btn:hover {
            background-color: #ffffff !important;
            color: #000000 !important;
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.18) !important;
        }
        .sim-launch-btn:hover * {
            color: #000000 !important;
        }
        .sim-launch-btn:hover svg {
            stroke: #000000 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-black text-white selection:bg-[#3367A5] selection:text-white">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION                                                           -->
    <!-- ========================================================================= -->
    <section class="relative w-full min-h-[60vh] sm:min-h-[70vh] bg-black text-white pt-36 sm:pt-44 pb-20 overflow-hidden flex items-center justify-center border-b border-neutral-900">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#3367A5]/25 via-black/80 to-black"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f293710_1px,transparent_1px),linear-gradient(to_bottom,#1f293710_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        </div>

        <div class="relative z-10 px-6 max-w-5xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/15 text-xs font-semibold uppercase tracking-widest text-[#3367A5] font-['Agrandir'] mb-6 backdrop-blur-md">
                <a href="{{ route('application') }}" class="text-neutral-400 hover:text-white transition">Applications</a>
                <span class="text-neutral-500">/</span>
                <span class="text-white">Domain 02</span>
            </div>

            <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold uppercase font-['Agrandir'] tracking-tight text-white leading-tight drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)]"
                data-lang-en="Automotive &amp; Heavy Machinery"
                data-lang-id="Otomotif &amp; Alat Berat">
                Automotive &amp; Heavy Machinery
            </h1>

            <div class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-4 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]"></div>

            <p class="text-sm sm:text-base md:text-lg text-gray-300 font-['Questrial'] max-w-2xl mt-5 leading-relaxed"
                data-lang-en="High-precision hydraulic press retrofits, multi-axis robotic loading cells, and telecentric vision verification ensuring 0.001mm tolerance."
                data-lang-id="Modernisasi mesin press hidrolik presisi tinggi, sel pemuatan robot multi-axis, dan verifikasi kamera telesentris berakurasi 0.001mm.">
                High-precision hydraulic press retrofits, multi-axis robotic loading cells, and telecentric vision verification ensuring 0.001mm tolerance.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('simulator.show', 'automotive') }}"
                    class="sim-launch-btn inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full font-bold font-['Agrandir'] text-sm shadow-lg">
                    <span data-lang-en="Launch Sub-Micron QA Simulator" data-lang-id="Buka Simulator QA Sub-Mikron">Launch Sub-Micron QA Simulator</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full font-bold font-['Agrandir'] text-sm bg-neutral-900 text-white hover:bg-neutral-800 border border-neutral-700 transition">
                    <span data-lang-en="Consult Automotive Engineer" data-lang-id="Konsultasi Insinyur Otomotif">Consult Automotive Engineer</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. CORE SYSTEM SHOWCASE & METRICS                                         -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                <!-- Left: Headline & Deep Dive Narrative -->
                <div class="lg:col-span-6 space-y-6 lg:space-y-7 flex flex-col justify-between reveal-on-scroll">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#3367A5]/20 text-[#3367A5] text-xs font-bold font-['Agrandir'] w-max">
                        Sub-Micron Metrology
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-bold font-['Agrandir'] text-white leading-[1.15] tracking-tight"
                        data-lang-en="Robotic Workcells &amp; Sub-Micron Dimensional QA"
                        data-lang-id="Sel Robotik &amp; QA Dimensi Sub-Mikron">
                        Robotic Workcells &amp; Sub-Micron Dimensional QA
                    </h2>

                    <p class="text-sm sm:text-base lg:text-[17px] text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                        data-lang-en="Automotive component plants (such as Komatsu and transmission suppliers) require rigorous dimensional tolerances. GAT retrofits hydraulic presses, implements multi-axis robotic loading cells, and integrates telecentric vision cameras verifying gear teeth and hole pitch to 0.001mm accuracy."
                        data-lang-id="Pabrik komponen otomotif (seperti mitra Komatsu) memerlukan toleransi dimensi yang sangat ketat. GAT memodernisasi mesin press hidrolik, mengintegrasikan robot perakitan multi-axis, dan memasang kamera visi telesentris untuk verifikasi gigi roda dan pitch lubang dengan akurasi 0.001mm.">
                        Automotive component plants (such as Komatsu and transmission suppliers) require rigorous dimensional tolerances. GAT retrofits hydraulic presses, implements multi-axis robotic loading cells, and integrates telecentric vision cameras verifying gear teeth and hole pitch to 0.001mm accuracy.
                    </p>

                    <!-- Key Highlights / Metrics -->
                    <div class="grid grid-cols-2 gap-4 pt-1">
                        <div class="p-4 sm:p-5 lg:p-6 rounded-2xl bg-white text-neutral-900 border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#3367A5] font-['Agrandir']">&plusmn;0.001mm</div>
                            <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Optical Tolerance" data-lang-id="Toleransi Optik">Optical Tolerance</div>
                        </div>
                        <div class="p-4 sm:p-5 lg:p-6 rounded-2xl bg-white text-neutral-900 border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-neutral-900 font-['Agrandir']">SIL-3</div>
                            <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1" data-lang-en="Safety Interlock Level" data-lang-id="Tingkat Keamanan">Safety Interlock Level</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Showcase & Simulator Launcher -->
                <div class="lg:col-span-6 space-y-4 reveal-on-scroll reveal-stagger-1">
                    <div class="rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/turnkey_integration.webp') }}" alt="Automotive Integration"
                            class="w-full h-80 sm:h-96 object-cover object-center">
                    </div>

                    <a href="{{ route('simulator.show', 'automotive') }}"
                        class="sim-launch-btn w-full flex items-center justify-between px-6 py-4 rounded-2xl font-bold font-['Agrandir'] shadow-lg no-underline group">
                        <span class="text-sm sm:text-base font-bold font-['Agrandir']"
                            data-lang-en="Simulation: Sub-Micron Gear QA &amp; OEE Simulator (with Chart)"
                            data-lang-id="Simulation: Simulator QA Roda Gigi &amp; Grafik OEE">Simulation: Sub-Micron Gear QA &amp; OEE Simulator (with Chart)</span>
                        <span class="inline-flex items-center gap-1.5 text-xs sm:text-sm uppercase tracking-wider shrink-0 font-bold font-['Agrandir']">
                            <span data-lang-en="Launch" data-lang-id="Buka">Launch</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 3. DETAILED TECHNICAL ARCHITECTURE                                        -->
    <!-- ========================================================================= -->
    <section class="bg-white text-neutral-900 py-20 sm:py-24 border-b border-gray-100">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 reveal-on-scroll">
                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']">Automotive Quality Engineering</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir'] mt-2"
                    data-lang-en="Key Deliverables for Automotive Plants"
                    data-lang-id="Solusi Utama untuk Industri Otomotif">
                    Key Deliverables for Automotive Plants
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 mb-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                <div class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-1 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center font-bold text-base font-['Agrandir']">01</div>
                    <h3 class="text-xl font-bold font-['Agrandir'] text-neutral-900" data-lang-en="Telecentric Vision Metrology" data-lang-id="Metrologi Visi Telesentris">Telecentric Vision Metrology</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed"
                        data-lang-en="Parallax-free telecentric optical lenses verify gear outer diameter, root pitch, and runout without distortion caused by component distance variances."
                        data-lang-id="Lensa telesentris bebas paralaks memverifikasi diameter luar roda gigi, pitch, dan runout tanpa distorsi jarak komponen.">
                        Parallax-free telecentric optical lenses verify gear outer diameter, root pitch, and runout without distortion caused by component distance variances.
                    </p>
                </div>

                <div class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-2 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#3367A5] text-white flex items-center justify-center font-bold text-base font-['Agrandir']">02</div>
                    <h3 class="text-xl font-bold font-['Agrandir'] text-neutral-900" data-lang-en="Robotic Workcell Integration" data-lang-id="Integrasi Sel Kerja Robotik">Robotic Workcell Integration</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed"
                        data-lang-en="6-axis articulated robots with servo-pneumatic grippers handle rapid blank part loading, stamping ejection, and direct pallet nesting within 1.2-second cycles."
                        data-lang-id="Robot 6-axis dengan gripper servo-pneumatik menangani pemuatan material, pengeluaran cetakan stamping, dan penataan palet dalam siklus 1,2 detik.">
                        6-axis articulated robots with servo-pneumatic grippers handle rapid blank part loading, stamping ejection, and direct pallet nesting within 1.2-second cycles.
                    </p>
                </div>

                <div class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] hover:shadow-lg transition-all duration-300 reveal-on-scroll reveal-stagger-3 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center font-bold text-base font-['Agrandir']">03</div>
                    <h3 class="text-xl font-bold font-['Agrandir'] text-neutral-900" data-lang-en="SIL-3 Press Safety Interlocks" data-lang-id="Interlock Keamanan Press SIL-3">SIL-3 Press Safety Interlocks</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed"
                        data-lang-en="Compliant light curtains, redundant hydraulic safety valves, and monitored dual emergency circuits prevent press descent during operator reach."
                        data-lang-id="Tirai cahaya keselamatan, katup hidrolik redundan, dan sirkuit emergency ganda mencegah penurunan press saat terdeteksi jangkauan operator.">
                        Compliant light curtains, redundant hydraulic safety valves, and monitored dual emergency circuits prevent press descent during operator reach.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. EXPLORE OTHER OPERATIONAL DOMAINS                                      -->
    <!-- ========================================================================= -->
    <section class="bg-neutral-950 text-white py-20 sm:py-24 border-b border-neutral-900">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-12 reveal-on-scroll">
                <span class="text-xs font-bold uppercase tracking-wider text-[#3367A5] font-['Agrandir']">Cross-Sector Solutions</span>
                <h2 class="text-3xl sm:text-4xl font-bold font-['Agrandir'] text-white mt-2" data-lang-en="Explore Other Operational Domains" data-lang-id="Jelajahi Domain Operasional Lainnya">Explore Other Operational Domains</h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <a href="{{ route('application.manufacturing') }}" class="group p-6 rounded-3xl bg-neutral-900 border border-neutral-800 hover:border-[#3367A5] hover:bg-neutral-850 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">DOMAIN 01</span>
                        <h4 class="text-lg font-bold text-white font-['Agrandir'] mt-2 group-hover:text-[#3367A5] transition-colors">Manufacturing &amp; FMCG</h4>
                        <p class="text-xs text-neutral-400 font-['Questrial'] mt-2 line-clamp-3">800+ pcs/m line speeds, bottle vision inspection, and high-speed rejection.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-[#3367A5] font-bold font-['Agrandir'] mt-4"><span>Explore Domain</span><svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>

                <a href="{{ route('application.pharma') }}" class="group p-6 rounded-3xl bg-neutral-900 border border-neutral-800 hover:border-[#3367A5] hover:bg-neutral-850 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">DOMAIN 03</span>
                        <h4 class="text-lg font-bold text-white font-['Agrandir'] mt-2 group-hover:text-[#3367A5] transition-colors">Pharma &amp; Cleanrooms</h4>
                        <p class="text-xs text-neutral-400 font-['Questrial'] mt-2 line-clamp-3">10-cavity blister inspection, 2D batch OCR serialization, and cleanroom SCADA.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-[#3367A5] font-bold font-['Agrandir'] mt-4"><span>Explore Domain</span><svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>

                <a href="{{ route('application.bms') }}" class="group p-6 rounded-3xl bg-neutral-900 border border-neutral-800 hover:border-[#3367A5] hover:bg-neutral-850 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">DOMAIN 04</span>
                        <h4 class="text-lg font-bold text-white font-['Agrandir'] mt-2 group-hover:text-[#3367A5] transition-colors">Smart BMS &amp; Utilities</h4>
                        <p class="text-xs text-neutral-400 font-['Questrial'] mt-2 line-clamp-3">Web SCADA telemetry, multi-chiller sequences, and power factor optimization.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-[#3367A5] font-bold font-['Agrandir'] mt-4"><span>Explore Domain</span><svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>

                <a href="{{ route('application.packaging') }}" class="group p-6 rounded-3xl bg-neutral-900 border border-neutral-800 hover:border-[#3367A5] hover:bg-neutral-850 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#3367A5] font-['Agrandir']">DOMAIN 05</span>
                        <h4 class="text-lg font-bold text-white font-['Agrandir'] mt-2 group-hover:text-[#3367A5] transition-colors">End-of-Line Packaging</h4>
                        <p class="text-xs text-neutral-400 font-['Questrial'] mt-2 line-clamp-3">3,500N automatic arch strappers, 60 straps/min, and motorized turntables.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-[#3367A5] font-bold font-['Agrandir'] mt-4"><span>Explore Domain</span><svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. CONSULTATION CTA                                                       -->
    <!-- ========================================================================= -->
    <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
        <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-['Agrandir'] tracking-tight leading-tight"
                data-lang-en="Planning an Automotive QA or Robotic Cell Upgrade?"
                data-lang-id="Merencanakan Upgrade QA Otomotif atau Sel Robotik?">
                Planning an Automotive QA or Robotic Cell Upgrade?
            </h2>
            <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-['Questrial'] leading-relaxed"
                data-lang-en="Contact our robotics and optical engineers for part-drawing review, cycle time modeling, and proof-of-concept testing."
                data-lang-id="Hubungi insinyur robotik dan optik kami untuk telaah gambar teknik, simulasi waktu siklus, dan uji coba proof-of-concept.">
                Contact our robotics and optical engineers for part-drawing review, cycle time modeling, and proof-of-concept testing.
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

    <!-- Script for Smooth Scroll & Observer -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
