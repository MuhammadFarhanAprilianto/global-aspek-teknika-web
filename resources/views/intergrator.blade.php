<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrator System - GAT Industrial Solutions</title>

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

        .cta-quote-btn .cta-text-wrapper {
            color: #ffffff !important;
            transition: color 0.35s ease;
        }

        .cta-quote-btn:hover .cta-text-wrapper {
            color: #000000 !important;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full bg-white text-neutral-900 selection:bg-[#3367A5] selection:text-white">

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
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-agrandir tracking-tight text-black leading-tight"
                        data-lang-en="Integrator System"
                        data-lang-id="Sistem Integrator">
                        Integrator System
                    </h1>
                    <p class="text-xl sm:text-2xl text-[#3367A5] font-bold font-agrandir tracking-tight"
                        data-lang-en="End-to-End Industrial Robotics, Material Flow &amp; Smart Line Integration"
                        data-lang-id="Robotika Industri End-to-End, Aliran Material &amp; Integrasi Lini Cerdas">
                        End-to-End Industrial Robotics, Material Flow &amp; Smart Line Integration
                    </p>
                    <p class="text-base sm:text-lg text-neutral-600 font-questrial leading-relaxed max-w-3xl"
                        data-lang-en="Seamlessly connecting robotic arms, automated conveyors, inspection gates, and shop floor controllers into unified high-efficiency manufacturing cells. Complete turnkey automation from concept simulation to full deployment."
                        data-lang-id="Menghubungkan lengan robotik, konveyor otomatis, gerbang inspeksi, dan pengontrol lantai pabrik secara mulus ke dalam sel manufaktur berefisiensi tinggi yang terpadu. Otomasi siap pakai lengkap mulai simulasi konsep hingga penerapan penuh.">
                        Seamlessly connecting robotic arms, automated conveyors, inspection gates, and shop floor controllers into unified high-efficiency manufacturing cells. Complete turnkey automation from concept simulation to full deployment.
                    </p>
                </div>

                <!-- Stats Quick Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-1">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">200+</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Integrated Workcells"
                            data-lang-id="Sel Kerja Terintegrasi">
                            Integrated Workcells
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-2">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-[#3367A5]">40%</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Throughput Acceleration"
                            data-lang-id="Percepatan Kapasitas">
                            Throughput Acceleration
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-3">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">100%</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Turnkey Engineering"
                            data-lang-id="Rekayasa Siap Pakai">
                            Turnkey Engineering
                        </div>
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-[#3367A5] font-agrandir"
                        data-lang-en="Core Capabilities"
                        data-lang-id="Kemampuan Utama">
                        Core Capabilities
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight"
                        data-lang-en="What We Deliver"
                        data-lang-id="Layanan yang Kami Hadirkan">
                        What We Deliver
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400 font-questrial"
                        data-lang-en="Bespoke industrial integration optimizing material flow, ergonomics, and machine cycle efficiency."
                        data-lang-id="Integrasi industri khusus untuk mengoptimalkan aliran material, ergonomi, dan efisiensi siklus mesin.">
                        Bespoke industrial integration optimizing material flow, ergonomics, and machine cycle efficiency.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    
                    <!-- Deliverable 1 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-[#3367A5] hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-1">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-[#3367A5] transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-[#3367A5] transition-colors"
                                data-lang-en="Robotic Workcells"
                                data-lang-id="Sel Kerja Robotika">
                                Robotic Workcells
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Deploying 6-axis articulated robots, SCARA, Delta, and collaborative cobots for high-speed pick-and-place, assembly, and automated packing."
                                data-lang-id="Menerapkan robot articulated 6-sumbu, SCARA, Delta, dan cobot kolaboratif untuk pick-and-place kecepatan tinggi, perakitan, dan pengemasan otomatis.">
                                Deploying 6-axis articulated robots, SCARA, Delta, and collaborative cobots for high-speed pick-and-place, assembly, and automated packing.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="FANUC, Yaskawa, ABB &amp; Universal Robots" data-lang-id="FANUC, Yaskawa, ABB &amp; Universal Robots">FANUC, Yaskawa, ABB &amp; Universal Robots</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Custom End-of-Arm Tooling (EOAT) Grippers" data-lang-id="Gripper End-of-Arm Tooling (EOAT) Kustom">Custom End-of-Arm Tooling (EOAT) Grippers</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Optical Safety Light Curtains &amp; Interlocks" data-lang-id="Tirai Cahaya Pengaman Optik &amp; Interlock">Optical Safety Light Curtains &amp; Interlocks</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 2 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-[#3367A5] hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-2">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-[#3367A5] transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-[#3367A5] transition-colors"
                                data-lang-en="Material Handling Conveyors"
                                data-lang-id="Konveyor Penanganan Material">
                                Material Handling Conveyors
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Custom modular conveyor systems, sorting tables, spiral elevators, and palletizing transport lines engineered for zero jamming."
                                data-lang-id="Sistem konveyor modular kustom, meja penyortiran, elevator spiral, dan jalur transportasi palletizing yang dirancang bebas macet.">
                                Custom modular conveyor systems, sorting tables, spiral elevators, and palletizing transport lines engineered for zero jamming.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Motorized Roller, Belt &amp; Slat Conveyors" data-lang-id="Konveyor Roller Bermotor, Sabuk &amp; Slat">Motorized Roller, Belt &amp; Slat Conveyors</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Rotary Indexers &amp; 90-Degree Diverters" data-lang-id="Pengindeks Putar &amp; Pengarah 90 Derajat">Rotary Indexers &amp; 90-Degree Diverters</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Automatic Pallet Infeed &amp; Outfeed Lines" data-lang-id="Lini Infeed &amp; Outfeed Palet Otomatis">Automatic Pallet Infeed &amp; Outfeed Lines</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Deliverable 3 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-[#3367A5] hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-3">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-[#3367A5] transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-[#3367A5] transition-colors"
                                data-lang-en="MES &amp; ERP Floor Interfacing"
                                data-lang-id="Antarmuka Lantai Produksi MES &amp; ERP">
                                MES &amp; ERP Floor Interfacing
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Bridging shop floor machines with SAP, Oracle, and custom Manufacturing Execution Systems for automated work-order dispatch and inventory tracking."
                                data-lang-id="Menjembatani mesin lantai pabrik dengan SAP, Oracle, dan Sistem Eksekusi Manufaktur khusus untuk pengiriman surat perintah kerja otomatis dan pelacakan inventaris.">
                                Bridging shop floor machines with SAP, Oracle, and custom Manufacturing Execution Systems for automated work-order dispatch and inventory tracking.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Automated Job Order Synchronization" data-lang-id="Sinkronisasi Perintah Kerja Otomatis">Automated Job Order Synchronization</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Barcode &amp; RFID Material Verification" data-lang-id="Verifikasi Material Barcode &amp; RFID">Barcode &amp; RFID Material Verification</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                        <span data-lang-en="Real-time WIP (Work-in-Progress) Auditing" data-lang-id="Audit WIP (Work-in-Progress) Real-Time">Real-time WIP (Work-in-Progress) Auditing</span>
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-[#3367A5] font-agrandir"
                        data-lang-en="Structured Methodology"
                        data-lang-id="Metodologi Terstruktur">
                        Structured Methodology
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight"
                        data-lang-en="Our 4-Phase Process"
                        data-lang-id="Proses 4 Fase Kami">
                        Our 4-Phase Process
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-600 font-questrial"
                        data-lang-en="Turnkey mechanical, electrical, and software delivery for complex manufacturing systems."
                        data-lang-id="Pengiriman mekanikal, elektrikal, dan perangkat lunak siap pakai untuk sistem manufaktur yang kompleks.">
                        Turnkey mechanical, electrical, and software delivery for complex manufacturing systems.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all reveal-on-scroll reveal-stagger-1">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-[#3367A5]">01</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 1"
                                data-lang-id="Fase 1">Phase 1</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="3D CAD &amp; Cycle Study"
                            data-lang-id="CAD 3D &amp; Studi Siklus">3D CAD &amp; Cycle Study</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="3D digital twin layout modeling, robot reachability studies, and precise throughput cycle time simulations."
                            data-lang-id="Pemodelan tata letak digital twin 3D, studi jangkauan robot, dan simulasi waktu siklus produksi yang akurat.">
                            3D digital twin layout modeling, robot reachability studies, and precise throughput cycle time simulations.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all reveal-on-scroll reveal-stagger-2">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-[#3367A5]">02</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 2"
                                data-lang-id="Fase 2">Phase 2</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Fabrication &amp; Control Panel"
                            data-lang-id="Fabrikasi &amp; Panel Kontrol">Fabrication &amp; Control Panel</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="CNC machining of custom grippers, structural welding, electrical panel wiring, and safety cage assembly."
                            data-lang-id="Permesinan CNC untuk gripper kustom, pengelasan struktural, perkabelan panel listrik, dan perakitan sangkar pengaman.">
                            CNC machining of custom grippers, structural welding, electrical panel wiring, and safety cage assembly.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all reveal-on-scroll reveal-stagger-3">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-[#3367A5]">03</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 3"
                                data-lang-id="Fase 3">Phase 3</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="PLC &amp; Robot Sync"
                            data-lang-id="Sinkronisasi PLC &amp; Robot">PLC &amp; Robot Sync</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Interlocking robot controller kinematics with master PLC signals, sensors, and safety protocols."
                            data-lang-id="Mengunci kinematika pengontrol robot dengan sinyal PLC master, sensor, dan protokol keselamatan.">
                            Interlocking robot controller kinematics with master PLC signals, sensors, and safety protocols.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all reveal-on-scroll reveal-stagger-4">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-[#3367A5]">04</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 4"
                                data-lang-id="Fase 4">Phase 4</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Turnkey Installation"
                            data-lang-id="Pemasangan Siap Pakai">Turnkey Installation</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="On-site plant deployment, continuous endurance trial runs, safety certification, and full operator training."
                            data-lang-id="Penerapan di pabrik, uji coba ketahanan berkelanjutan, sertifikasi keselamatan, dan pelatihan menyeluruh untuk operator.">
                            On-site plant deployment, continuous endurance trial runs, safety certification, and full operator training.
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-[#3367A5] font-agrandir"
                        data-lang-en="FAQS"
                        data-lang-id="TANYA JAWAB">
                        FAQS
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight"
                        data-lang-en="Frequently Asked Questions"
                        data-lang-id="Pertanyaan yang Sering Diajukan">
                        Frequently Asked Questions
                    </h2>
                </div>

                <div class="space-y-4" id="faq-accordion">
                    
                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-1">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Do you handle mechanical fabrication in addition to electrical automation?" data-lang-id="Apakah Anda menangani fabrikasi mekanikal selain otomasi elektrikal?">Do you handle mechanical fabrication in addition to electrical automation?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. We provide complete turnkey systems including mechanical frame design, CNC fabricated grippers, pneumatic routing, electrical control panel building, and software programming under one roof."
                            data-lang-id="Ya. Kami menyediakan sistem siap pakai lengkap yang mencakup perancangan rangka mekanis, gripper fabrikasi CNC, jalur pneumatik, perakitan panel kontrol listrik, dan pemrograman perangkat lunak secara terpadu.">
                            Yes. We provide complete turnkey systems including mechanical frame design, CNC fabricated grippers, pneumatic routing, electrical control panel building, and software programming under one roof.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-2">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Can collaborative robots (Cobots) work safely next to human operators?" data-lang-id="Dapatkah robot kolaboratif (Cobot) bekerja dengan aman di samping operator manusia?">Can collaborative robots (Cobots) work safely next to human operators?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. We engineer ISO-compliant collaborative workstations equipped with integrated force-torque torque limiting sensors, optical area scanners, and automatic speed reduction zones."
                            data-lang-id="Ya. Kami merancang ruang kerja kolaboratif yang sesuai standar ISO dilengkapi sensor pembatas gaya torsi terintegrasi, pemindai area optik, dan zona pengurangan kecepatan otomatis.">
                            Yes. We engineer ISO-compliant collaborative workstations equipped with integrated force-torque torque limiting sensors, optical area scanners, and automatic speed reduction zones.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-3">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="What warranty and after-sales support do you provide?" data-lang-id="Garansi dan dukungan purnajual apa yang Anda berikan?">What warranty and after-sales support do you provide?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Every integrated line comes with a comprehensive 1-year turnkey warranty, spare parts inventory recommendations, and rapid on-site emergency SLA support."
                            data-lang-id="Setiap lini terintegrasi dilengkapi dengan garansi menyeluruh selama 1 tahun, rekomendasi inventaris suku cadang, dan dukungan SLA darurat di lokasi yang cepat.">
                            Every integrated line comes with a comprehensive 1-year turnkey warranty, spare parts inventory recommendations, and rapid on-site emergency SLA support.
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
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#3367A5] font-agrandir"
                    data-lang-en="LET'S COLLABORATE"
                    data-lang-id="MARI BERKOLABORASI">
                    LET'S COLLABORATE
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight leading-tight"
                    data-lang-en="Ready to Automate Your Manufacturing Workcells?"
                    data-lang-id="Siap Mengotomasi Sel Kerja Manufaktur Anda?">
                    Ready to Automate Your Manufacturing Workcells?
                </h2>
                <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-questrial leading-relaxed"
                    data-lang-en="Our robotics and system integration experts are ready to study your line layout and propose an optimal automated solution."
                    data-lang-id="Pakar robotika dan integrasi sistem kami siap meneliti tata letak lini Anda dan mengusulkan solusi otomasi terbaik.">
                    Our robotics and system integration experts are ready to study your line layout and propose an optimal automated solution.
                </p>

                <div class="pt-4 flex items-center justify-center">
                    <a href="{{ route('contact') }}"
                        class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-[#3367A5] font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-agrandir border-0 outline-none isolate">
                        <!-- White Wipe Layer from Left to Right -->
                        <span
                            class="absolute inset-0 bg-white rounded-full -translate-x-[105%] group-hover:translate-x-0 transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)] pointer-events-none"></span>

                        <!-- Text & Arrow Layer (White initially, Black on hover) -->
                        <span class="cta-text-wrapper relative z-10 flex items-center gap-2 font-agrandir text-sm sm:text-base font-bold">
                            <span data-lang-en="Get A Quote / Consultation" data-lang-id="Minta Penawaran / Konsultasi">Get A Quote / Consultation</span>
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
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180', 'bg-[#3367A5]', 'text-white'));

                if (!isOpen) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'bg-[#3367A5]', 'text-white');
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
