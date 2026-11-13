<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspection & Record Data System - GAT Industrial Solutions</title>

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
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-agrandir tracking-tight text-black leading-tight"
                        data-lang-en="Inspection &amp; Record Data System"
                        data-lang-id="Sistem Inspeksi &amp; Pencatatan Data">
                        Inspection &amp; Record Data System
                    </h1>
                    <p class="text-xl sm:text-2xl text-red-600 font-bold font-agrandir tracking-tight"
                        data-lang-en="Ultra High-Speed Machine Vision &amp; Real-Time Serialization Auditing"
                        data-lang-id="Machine Vision Kecepatan Ultra Tinggi &amp; Audit Serialisasi Real-Time">
                        Ultra High-Speed Machine Vision &amp; Real-Time Serialization Auditing
                    </p>
                    <p class="text-base sm:text-lg text-neutral-600 font-questrial leading-relaxed max-w-3xl"
                        data-lang-en="AI-powered vision camera systems capable of inspecting at speeds up to 800 pcs/minute. Automated defect rejection, dimensional tolerance verification, and unit-level serialization records for uncompromising Quality Assurance."
                        data-lang-id="Sistem kamera vision bertenaga AI dengan kecepatan inspeksi hingga 800 pcs/menit. Penolakan cacat otomatis, verifikasi toleransi dimensi, serta pencatatan serialisasi tingkat unit demi Jaminan Kualitas tanpa kompromi.">
                        AI-powered vision camera systems capable of inspecting at speeds up to 800 pcs/minute. Automated defect rejection, dimensional tolerance verification, and unit-level serialization records for uncompromising Quality Assurance.
                    </p>
                </div>

                <!-- Stats Quick Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-1">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">800 pcs/min</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Ultra High-Speed Sorting"
                            data-lang-id="Penyortiran Kecepatan Ultra Tinggi">
                            Ultra High-Speed Sorting
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-2">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-red-600">0.01 mm</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Optical Defect Accuracy"
                            data-lang-id="Akurasi Cacat Optik">
                            Optical Defect Accuracy
                        </div>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-3">
                        <div class="text-3xl sm:text-4xl font-bold font-agrandir text-black">100%</div>
                        <div class="text-xs sm:text-sm text-neutral-500 font-questrial"
                            data-lang-en="Full Traceability Compliance"
                            data-lang-id="Kepatuhan Ketertelusuran Penuh">
                            Full Traceability Compliance
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-500 font-agrandir"
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
                        data-lang-en="Advanced optical inspection and database serialization tailored for pharmaceutical, FMCG, and automotive lines."
                        data-lang-id="Inspeksi optik canggih dan serialisasi basis data untuk lini farmasi, FMCG, dan otomotif.">
                        Advanced optical inspection and database serialization tailored for pharmaceutical, FMCG, and automotive lines.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                    
                    <!-- Deliverable 1 -->
                    <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-red-500 hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-1">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-red-600 transition-colors">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7V5a2 2 0 012-2h2m12 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 8v8M10 8v8M14 8v8M17 8v8"></path>
                                
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="High-Speed Vision Camera"
                                data-lang-id="Kamera Vision Kecepatan Tinggi">
                                High-Speed Vision Camera
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Industrial camera systems checking surface flaws, label alignment, OCR character legibility, and packaging integrity at speeds up to 800 pcs/minute."
                                data-lang-id="Sistem kamera industri untuk memeriksa cacat permukaan, kelurusan label, keterbacaan karakter OCR, dan integritas kemasan hingga 800 pcs/menit.">
                                Industrial camera systems checking surface flaws, label alignment, OCR character legibility, and packaging integrity at speeds up to 800 pcs/minute.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="800+ pcs/min Real-Time Processing" data-lang-id="Pemrosesan Real-Time 800+ pcs/menit">800+ pcs/min Real-Time Processing</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Sub-millimeter Dimensional Measurements" data-lang-id="Pengukuran Dimensi Sub-milimeter">Sub-millimeter Dimensional Measurements</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="1D/2D Barcode &amp; DataMatrix Grading" data-lang-id="Penilaian Mutu Barcode 1D/2D &amp; DataMatrix">1D/2D Barcode &amp; DataMatrix Grading</span>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="Serialization Management"
                                data-lang-id="Manajemen Serialisasi">
                                Serialization Management
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="Complete product code generation and tracking software ensuring regulatory compliance, anti-counterfeiting security, and parent-child packaging aggregation."
                                data-lang-id="Perangkat lunak pembuatan kode dan pelacakan produk lengkap untuk memastikan kepatuhan regulasi, keamanan anti-pemalsuan, dan agregasi kemasan induk-anak.">
                                Complete product code generation and tracking software ensuring regulatory compliance, anti-counterfeiting security, and parent-child packaging aggregation.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Unique Item &amp; Bundle Code Hierarchy" data-lang-id="Hierarki Kode Unik Item &amp; Bundel">Unique Item &amp; Bundle Code Hierarchy</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Anti-Counterfeiting Verification Database" data-lang-id="Basis Data Verifikasi Anti-Pemalsuan">Anti-Counterfeiting Verification Database</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Automated BPOM &amp; GS1 Standard Export" data-lang-id="Ekspor Standar BPOM &amp; GS1 Otomatis">Automated BPOM &amp; GS1 Standard Export</span>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-red-600 transition-colors"
                                data-lang-en="Automated Rejector Gateway"
                                data-lang-id="Gerbang Penolakan Otomatis">
                                Automated Rejector Gateway
                            </h3>
                            <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed"
                                data-lang-en="High-speed pneumatic air blowers, flipper arms, and servo pushers that divert non-conforming items instantly into secure reject bins without slowing line speed."
                                data-lang-id="Blower udara pneumatik, lengan flipper, dan pendorong servo berkecepatan tinggi yang membelokkan produk cacat seketika ke kotak penolakan tanpa memperlambat lini.">
                                High-speed pneumatic air blowers, flipper arms, and servo pushers that divert non-conforming items instantly into secure reject bins without slowing line speed.
                            </p>
                            <div class="pt-3 border-t border-neutral-200/80 space-y-2">
                                <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                    data-lang-en="Key Highlights"
                                    data-lang-id="Sorotan Utama">
                                    Key Highlights
                                </div>
                                <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Zero Line Stoppage Rejection" data-lang-id="Penolakan Tanpa Henti Lini Produksi">Zero Line Stoppage Rejection</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Reject Verification Sensor Feedback" data-lang-id="Umpan Balik Sensor Verifikasi Tolakan">Reject Verification Sensor Feedback</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                        <span data-lang-en="Audit-Ready Defect Image Archival" data-lang-id="Pengarsipan Gambar Cacat Siap Audit">Audit-Ready Defect Image Archival</span>
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir"
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
                        data-lang-en="Ensuring zero false-positive rejections and seamless integration with existing conveyors."
                        data-lang-id="Memastikan nihil penolakan salah (false-positive) dan integrasi mulus dengan konveyor yang ada.">
                        Ensuring zero false-positive rejections and seamless integration with existing conveyors.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-1">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">01</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 1"
                                data-lang-id="Fase 1">Phase 1</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Optical Feasibility"
                            data-lang-id="Kelayakan Optik">Optical Feasibility</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Laboratory testing of product samples under multiple lighting angles and high-frequency strobes to guarantee defect visibility."
                            data-lang-id="Pengujian laboratorium pada sampel produk di bawah beragam sudut pencahayaan dan strobo frekuensi tinggi demi visibilitas cacat yang sempurna.">
                            Laboratory testing of product samples under multiple lighting angles and high-frequency strobes to guarantee defect visibility.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-2">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">02</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 2"
                                data-lang-id="Fase 2">Phase 2</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Vision Algorithm"
                            data-lang-id="Algoritma Vision">Vision Algorithm</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Configuring AI defect classification models, OCR text templates, and barcode grading thresholds."
                            data-lang-id="Mengonfigurasi model klasifikasi cacat AI, template teks OCR, dan ambang batas penilaian mutu barcode.">
                            Configuring AI defect classification models, OCR text templates, and barcode grading thresholds.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-3">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">03</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 3"
                                data-lang-id="Fase 3">Phase 3</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Line FAT &amp; Ejector Sync"
                            data-lang-id="FAT Lini &amp; Sinkronisasi Ejektor">Line FAT &amp; Ejector Sync</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Synchronizing camera triggers with conveyor encoders and testing high-speed pneumatic reject mechanisms."
                            data-lang-id="Menyinkronkan pemicu kamera dengan encoder konveyor serta menguji mekanisme penolakan pneumatik kecepatan tinggi.">
                            Synchronizing camera triggers with conveyor encoders and testing high-speed pneumatic reject mechanisms.
                        </p>
                    </div>

                    <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-red-500 hover:shadow-md transition-all reveal-on-scroll reveal-stagger-4">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold font-agrandir text-red-600">04</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700"
                                data-lang-en="Phase 4"
                                data-lang-id="Fase 4">Phase 4</span>
                        </div>
                        <h4 class="text-lg font-bold font-agrandir text-black"
                            data-lang-en="Validation &amp; Handover"
                            data-lang-id="Validasi &amp; Serah Terima">Validation &amp; Handover</h4>
                        <p class="text-xs text-neutral-600 font-questrial leading-relaxed"
                            data-lang-en="Live production trial validation, statistical defect reporting setup, and operator training certification."
                            data-lang-id="Validasi uji produksi langsung, penyiapan laporan statistik cacat, dan sertifikasi pelatihan operator.">
                            Live production trial validation, statistical defect reporting setup, and operator training certification.
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
                    <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-red-600 font-agrandir"
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
                            <span data-lang-en="Can the inspection system handle multiple product SKUs without re-tuning?" data-lang-id="Dapatkah sistem inspeksi menangani banyak SKU produk tanpa pengaturan ulang?">Can the inspection system handle multiple product SKUs without re-tuning?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. The system includes recipe management where operators simply select the product SKU from the touchscreen to automatically switch inspection parameters, lighting presets, and tolerance rules in seconds."
                            data-lang-id="Ya. Sistem dilengkapi manajemen resep di mana operator cukup memilih SKU produk di layar sentuh untuk mengganti parameter inspeksi, preset pencahayaan, dan aturan toleransi dalam hitungan detik.">
                            Yes. The system includes recipe management where operators simply select the product SKU from the touchscreen to automatically switch inspection parameters, lighting presets, and tolerance rules in seconds.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-2">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="How does the system ensure non-compliant products are rejected reliably?" data-lang-id="Bagaimana sistem memastikan produk tidak sesuai ditolak secara andal?">How does the system ensure non-compliant products are rejected reliably?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="High-speed pneumatic air nozzles or mechanical diverters fire within milliseconds of defect detection. Downstream optical sensors confirm that the defective unit has successfully dropped into the locked reject bin."
                            data-lang-id="Nozel udara pneumatik atau pengarah mekanis berkecepatan tinggi bereaksi dalam hitungan milidetik setelah cacat terdeteksi. Sensor optik di hilir memastikan unit cacat telah jatuh ke dalam kotak penolakan yang terkunci.">
                            High-speed pneumatic air nozzles or mechanical diverters fire within milliseconds of defect detection. Downstream optical sensors confirm that the defective unit has successfully dropped into the locked reject bin.
                        </div>
                    </div>

                    <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-3">
                        <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                            <span data-lang-en="Can inspection data and images be exported to ERP/MES systems?" data-lang-id="Dapatkah data inspeksi dan gambar diekspor ke sistem ERP/MES?">Can inspection data and images be exported to ERP/MES systems?</span>
                            <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </button>
                        <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4"
                            data-lang-en="Yes. All inspection timestamps, serial codes, defect categories, and high-resolution flaw images are stored in a local SQL database and can be synced via REST API, MQTT, or OPC-UA to your enterprise ERP."
                            data-lang-id="Ya. Semua stempel waktu inspeksi, kode seri, kategori cacat, dan gambar cacat beresolusi tinggi disimpan dalam basis data SQL lokal dan dapat disinkronkan melalui REST API, MQTT, atau OPC-UA ke ERP perusahaan Anda.">
                            Yes. All inspection timestamps, serial codes, defect categories, and high-resolution flaw images are stored in a local SQL database and can be synced via REST API, MQTT, or OPC-UA to your enterprise ERP.
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
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-red-500 font-agrandir"
                    data-lang-en="LET'S COLLABORATE"
                    data-lang-id="MARI BERKOLABORASI">
                    LET'S COLLABORATE
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white font-agrandir tracking-tight leading-tight"
                    data-lang-en="Ready to Implement Zero-Defect Optical Inspection?"
                    data-lang-id="Siap Menerapkan Inspeksi Optik Nol-Cacat?">
                    Ready to Implement Zero-Defect Optical Inspection?
                </h2>
                <p class="text-neutral-400 text-sm sm:text-base max-w-2xl mx-auto font-questrial leading-relaxed"
                    data-lang-en="Send us your product samples for a free optical feasibility test. We'll verify detection accuracy and provide a custom system design."
                    data-lang-id="Kirimkan sampel produk Anda untuk uji kelayakan optik gratis. Kami akan memverifikasi akurasi deteksi dan merancang sistem yang sesuai.">
                    Send us your product samples for a free optical feasibility test. We'll verify detection accuracy and provide a custom system design.
                </p>

                <div class="pt-4 flex items-center justify-center">
                    <a href="{{ route('contact') }}"
                        class="cta-quote-btn group relative inline-flex items-center justify-center overflow-hidden px-8 sm:px-10 py-4 bg-red-600 font-bold tracking-wider rounded-full hover:shadow-[0_0_35px_rgba(255,255,255,0.25)] transition-all duration-700 active:scale-95 whitespace-nowrap font-agrandir border-0 outline-none isolate">
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
