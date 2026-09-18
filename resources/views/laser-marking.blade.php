<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laser Marking & Inkjet Printing - GAT Industrial Solutions</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
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

        .cta-quote-btn {
            border: none !important;
            outline: none !important;
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.4);
            text-decoration: none !important;
        }

        .cta-text-wrapper {
            color: #ffffff !important;
            transition: color 0.35s ease;
        }

        .cta-quote-btn:hover .cta-text-wrapper {
            color: #000000 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full bg-white text-neutral-900 selection:bg-red-600 selection:text-white">

    <!-- Navbar -->
    @include('components.navbar.header')

    <main class="w-full">

        <!-- ========================================================================= -->
        <!-- 1. HERO SECTION (LabsStudio Style Service Detail)                         -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white pt-32 sm:pt-40 pb-16 sm:pb-20 border-b border-neutral-200">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <!-- Hero Headline & Subtitle -->
                <div class="space-y-6 max-w-4xl reveal-on-scroll">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-agrandir tracking-tight text-black leading-tight">
                        Laser Marking &amp; Inkjet Printing
                    </h1>
                    <p class="text-xl sm:text-2xl text-red-600 font-bold font-agrandir tracking-tight">
                        Precision Industrial Tracing, Fiber Laser Marking &amp; High-Speed CIJ Printing
                    </p>
                    <p class="text-base sm:text-lg text-neutral-600 font-questrial leading-relaxed max-w-3xl">
                        High-speed industrial fiber laser marking and continuous inkjet (CIJ) printing systems for permanent product coding, dynamic lot timestamps, and 2D DataMatrix serialization across metals, plastics, glass, and flexible packaging.
                    </p>
                </div>

                <!-- Stats Quick Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-1">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">1200+</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial">Characters / Second Speed</div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-2">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-red-600">50+</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial">Material Substrates Tested</div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-3">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">100%</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial">Zero-Smudge Traceability</div>
                    </div>
                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 2. CORE DELIVERABLES / CAPABILITIES CARDS                                 -->
        <!-- ========================================================================= -->
        <section class="w-full bg-[#07080b] py-16 sm:py-24 border-b border-neutral-900 text-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <div class="text-center space-y-3 max-w-2xl mx-auto reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-500 font-agrandir">
                        Core Capabilities
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight">
                        What We Deliver
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400 font-questrial">
                        Turnkey laser and inkjet coding systems designed for continuous 24/7 industrial production.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    
                    <!-- Deliverable 1 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-1">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors">
                                Fiber, CO2 &amp; UV Laser
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed">
                                Permanent, sharp contrast laser engraving on automotive parts, electronic PCBs, plastics, ceramics, and pharmaceutical vials.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir">Key Highlights</div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Fiber Laser (20W-100W) for Metals &amp; Alloys</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Cold UV Laser for Heat-Sensitive Plastics</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>High-Density 2D DataMatrix &amp; Vector Logos</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 2 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-2">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors">
                                Continuous Inkjet (CIJ)
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed">
                                Fast-drying non-contact coding printing expiration dates, lot numbers, and barcodes on curved bottles, cans, pouches, and cables.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir">Key Highlights</div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Multi-line High-Speed Alphanumeric Coding</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Fast-Drying Food Grade &amp; UV Inks</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Automatic Printhead Flushing &amp; Nozzle Seal</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 3 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-3">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors">
                                Automated Traverse &amp; Vision
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed">
                                Motorized multi-axis traversing slides for wide web packaging and inline OCR verification cameras ensuring 100% legibility.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir">Key Highlights</div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Motorized Multi-Lane Traversing Heads</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Instant Post-Print OCR Legibility Audit</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span>Interlocked Class 1 Laser Safety Enclosures</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 3. STEP-BY-STEP PROCESS TIMELINE                                          -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white py-16 sm:py-24 border-b border-neutral-200">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">
                
                <div class="text-center space-y-3 max-w-2xl mx-auto reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir">
                        Structured Methodology
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight">
                        Our 4-Phase Process
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600 font-questrial">
                        Material testing, encoder synchronization, and line-speed validation for sharp contrast marks.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-1">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">01</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700">Phase 1</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black">Substrate Sample Testing</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed">
                            Laboratory testing on your actual materials to determine the exact laser wavelength, lens focus, or ink adhesion.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-2">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">02</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700">Phase 2</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black">Mounting &amp; Encoder Sync</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed">
                            Fabricating rigid adjustable brackets and wiring high-resolution rotary encoders for dynamic conveyor synchronization.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-3">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">03</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700">Phase 3</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black">PLC &amp; Serialization Link</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed">
                            Connecting printer controllers with master PLC triggers and dynamic database serialization feeds.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-4">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">04</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700">Phase 4</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black">Commissioning &amp; Training</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed">
                            Full-speed production run validation, optical legibility sign-off, and operator maintenance training.
                        </p>
                    </div>
                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 4. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)                             -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white py-16 sm:py-24 border-b border-neutral-200">
            <div class="max-w-4xl mx-auto px-6 sm:px-12 space-y-8">
                
                <div class="text-center space-y-3 reveal-on-scroll">
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir">
                        FAQS
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight">
                        Frequently Asked Questions
                    </h2>
                </div>

                <div class="space-y-4" id="faq-accordion">
                    
                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-1">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span>How do I know whether Fiber Laser or UV Laser is right for my product?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4">
                            Fiber lasers are the industry standard for metals and robust opaque plastics. UV 'cold lasers' operate at a 355nm wavelength that produces photochemical marks on delicate plastics, glass, and medical tubing without creating heat-affected zones or micro-fractures.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-2">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span>Can the system print dynamic date codes and serial numbers without stopping?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4">
                            Yes. The marking software automatically increments unit serial numbers, batch lot IDs, real-time timestamps, and dynamic 2D DataMatrix codes on-the-fly at line speeds up to 1200 chars/sec.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-3">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span>How do you protect line operators from laser radiation?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4">
                            All laser marking installations include certified Class 1 safety enclosures with certified optical shielding windows and dual-channel safety interlocks that immediately shut down the beam if a guard door is opened.
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- ========================================================================= -->
        <!-- 5. CONSULTATION / COLLABORATE CTA BANNER                                  -->
        <!-- ========================================================================= -->
        <section class="w-full bg-[#07080b] text-white py-20 sm:py-28 relative overflow-hidden border-t border-neutral-900">
            <div class="max-w-4xl mx-auto px-6 sm:px-12 text-center space-y-8 relative z-10 reveal-on-scroll">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-red-500 font-agrandir">
                    LET'S COLLABORATE
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight leading-tight">
                    Ready to Upgrade Your Industrial Coding &amp; Marking?
                </h2>
                <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-questrial leading-relaxed">
                    Send us your packaging samples for sample marking evaluations. We'll verify print contrast, adhesion, and speed performance.
                </p>

                <div class="pt-4 flex items-center justify-center">
                    <a href="{{ route('contact') }}"
                        class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-red-600 font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-agrandir border-0 outline-none isolate">
                        <!-- White Wipe Layer from Left to Right -->
                        <span
                            class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                        <!-- Text & Arrow Layer (White initially, Black on hover) -->
                        <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-agrandir text-sm sm:text-base font-bold">
                            <span>Get A Quote / Consultation</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Floating Contact Button -->
    @include('components.button.button')

    <!-- Simple Accordion Script -->
    <script>
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('.faq-icon');
                const isOpen = !content.classList.contains('hidden');

                document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180', 'bg-red-600', 'text-white'));

                if (!isOpen) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'bg-red-600', 'text-white');
                }
            });
        });
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
                        revealObserver.unobserve(entry.target);
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
