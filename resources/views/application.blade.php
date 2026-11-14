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
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/gat_scada_interface_dark.jpg') }}" alt="Manufacturing SCADA"
                            class="w-full h-80 sm:h-96 object-cover object-center">
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
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/turnkey_integration.webp') }}" alt="Automotive Integration"
                            class="w-full h-80 sm:h-96 object-cover object-center">
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
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/automated_vision_system.webp') }}" alt="Pharma Optical Inspection"
                            class="w-full h-80 sm:h-96 object-cover object-center">
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
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/smartics_building_bms.jpg') }}" alt="Building Management Systems"
                            class="w-full h-80 sm:h-96 object-cover object-center">
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
                    <div class="lg:col-span-6 rounded-3xl overflow-hidden border border-neutral-800 bg-neutral-900 shadow-2xl relative">
                        <img src="{{ asset('storage/strapping_panel_system.webp') }}" alt="Strapping System Integration"
                            class="w-full h-80 sm:h-96 object-cover object-center">
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

    <!-- Script for Domain Switcher & Smooth Scroll -->
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

        document.addEventListener('DOMContentLoaded', function () {
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

