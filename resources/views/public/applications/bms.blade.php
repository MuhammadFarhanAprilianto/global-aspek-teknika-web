<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart BMS & EIS Utilities Telemetry - PT. Global Aspect Technology</title>
    @include('components.seo-meta', [
        'seoTitle' => 'Smart BMS & Energy Information Systems — PT Global Aspect Technology',
        'seoDescription' => 'Centralized HVAC, electrical sub-metering, utilities telemetry, and Smart BMS PLC controls engineered for industrial plants and buildings.',
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

        .reveal-stagger-1 {
            transition-delay: 0.08s;
        }

        .reveal-stagger-2 {
            transition-delay: 0.16s;
        }

        .reveal-stagger-3 {
            transition-delay: 0.24s;
        }

        .cta-quote-btn {
            border: none !important;
            outline: none !important;
            text-decoration: none !important;
        }

        .cta-quote-btn .cta-text-wrapper,
        .cta-quote-btn .cta-text-wrapper * {
            color: #ffffff !important;
            stroke: #ffffff !important;
            transition: color 0.35s ease;
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

<body
    class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif] bg-black text-white selection:bg-[#3367A5] selection:text-white">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- ========================================================================= -->
    <!-- 1. HERO SECTION                                                           -->
    <!-- ========================================================================= -->
    <section
        class="relative w-full min-h-[48vh] sm:min-h-[56vh] bg-black text-white pt-44 sm:pt-52 pb-20 sm:pb-24 overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#3367A5]/25 via-black/80 to-black">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#1f293710_1px,transparent_1px),linear-gradient(to_bottom,#1f293710_1px,transparent_1px)] bg-[size:4rem_4rem]">
            </div>
        </div>

        <div
            class="relative z-10 px-6 max-w-5xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll mt-4 sm:mt-8">
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold uppercase font-['Agrandir'] tracking-tight text-white leading-tight drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)]"
                data-lang-en="Smart BMS &amp; Energy Information System (EIS)" data-lang-id="Smart BMS &amp; Sistem Informasi Energi (EIS)">
                Smart BMS &amp; Energy Information System (EIS)
            </h1>

            <div
                class="w-24 sm:w-28 h-1.5 bg-[#3367A5] mx-auto mt-5 rounded-full shadow-[0_0_20px_rgba(51,103,165,0.8)]">
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 2. CORE SYSTEM SHOWCASE & METRICS                                         -->
    <!-- ========================================================================= -->
    <section class="bg-black text-white py-20 sm:py-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-stretch">
                <div class="lg:col-span-6 flex flex-col justify-between h-full reveal-on-scroll space-y-6 lg:space-y-0">
                    <div class="space-y-6 lg:space-y-7">
                        <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-bold font-['Agrandir'] text-white leading-[1.15] tracking-tight"
                            data-lang-en="Energy Information System (EIS) &amp; Facility Utilities"
                            data-lang-id="Sistem Informasi Energi (EIS) &amp; Utilitas Fasilitas">
                            Energy Information System (EIS) &amp; Facility Utilities
                        </h2>

                        <p class="text-sm sm:text-base lg:text-[17px] text-gray-300 font-['Questrial'] leading-relaxed text-justify"
                            data-lang-en="Smart commercial towers and manufacturing plants use our universal web-based EIS architecture to unify multi-node power sub-meters, environmental sensors, and gateway telemetry into one open time-series platform with automated storage retention and cost estimation."
                            data-lang-id="Gedung komersial dan pabrik manufaktur menggunakan arsitektur EIS berbasis web untuk mengintegrasikan sub-meter listrik multi-node, sensor lingkungan, dan telemetri gateway ke dalam satu platform time-series terbuka dengan kalkulasi retensi storage dan estimasi biaya terpadu.">
                            Smart commercial towers and manufacturing plants use our universal web-based EIS
                            architecture to unify multi-node power sub-meters, environmental sensors, and gateway
                            telemetry into one open time-series platform with automated storage retention and cost
                            estimation.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-6">
                        <div
                            class="p-5 sm:p-6 lg:p-7 rounded-2xl bg-white text-neutral-900 border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300 flex flex-col justify-center min-h-[110px] sm:min-h-[120px]">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#3367A5] font-['Agrandir']">
                                -18%</div>
                            <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1"
                                data-lang-en="Energy Waste Reduction" data-lang-id="Reduksi Pemborosan Energi">Energy Waste Reduction</div>
                        </div>
                        <div
                            class="p-5 sm:p-6 lg:p-7 rounded-2xl bg-white text-neutral-900 border border-neutral-100 shadow-[0_4px_20px_rgba(0,0,0,0.25)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.35)] transition-all duration-300 flex flex-col justify-center min-h-[110px] sm:min-h-[120px]">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-neutral-900 font-['Agrandir']">
                                &lt;2s</div>
                            <div class="text-xs sm:text-sm text-neutral-600 font-medium font-['Questrial'] mt-1"
                                data-lang-en="Telemetry &amp; Alarm Dispatch" data-lang-id="Kecepatan Telemetri &amp; Alarm">Telemetry &amp; Alarm Dispatch</div>
                        </div>
                    </div>
                </div>

                <div
                    class="lg:col-span-6 flex flex-col justify-between h-full space-y-4 reveal-on-scroll reveal-stagger-1">
                    <div
                        class="rounded-3xl overflow-hidden bg-neutral-900 shadow-2xl relative flex-1 min-h-[300px] sm:min-h-[360px]">
                        <img src="{{ asset('storage/smartics_building_bms.jpg') }}" alt="Building Management Systems"
                            class="w-full h-full object-cover object-center">
                    </div>

                    <a href="{{ route('simulator.show', 'bms') }}"
                        class="sim-launch-btn w-full flex items-center justify-between px-6 py-4 rounded-2xl font-bold font-['Agrandir'] shadow-lg no-underline group shrink-0">
                        <span class="text-sm sm:text-base font-bold font-['Agrandir']"
                            data-lang-en="Simulation: EIS Form &amp; Energy Sizing Simulator"
                            data-lang-id="Simulasi: Simulator Form EIS &amp; Sizing Energi">Simulation: EIS Form &amp; Energy Sizing Simulator</span>
                        <span
                            class="inline-flex items-center gap-1.5 text-xs sm:text-sm uppercase tracking-wider shrink-0 font-bold font-['Agrandir']">
                            <span data-lang-en="Launch" data-lang-id="Buka">Launch</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
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
    <section class="bg-white text-neutral-900 py-20 sm:py-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-14 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black font-['Agrandir']"
                    data-lang-en="EIS &amp; Smart BMS Engineering Solutions" data-lang-id="Solusi Rekayasa EIS &amp; Smart BMS">
                    EIS &amp; Smart BMS Engineering Solutions
                </h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-4 mb-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto items-stretch">
                <div
                    class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col h-full">
                    <div
                        class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center font-bold text-base font-['Agrandir'] mb-4 shrink-0">
                        01</div>
                    <h3 class="text-lg sm:text-xl font-bold font-['Agrandir'] text-neutral-900 leading-snug min-h-[3.5rem] flex items-start mb-4"
                        data-lang-en="Multi-Node Power Sub-Metering" data-lang-id="Sub-Metering Listrik Multi-Node">Multi-Node Power Sub-Metering</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed flex-grow"
                        data-lang-en="Digital power analyzers capture real-time voltage, current, active/reactive power (kW/kVA/kVAR), power factor (Cos &phi;), frequency, and THD harmonics across all electrical distribution panels."
                        data-lang-id="Power meter digital membaca tegangan, arus, daya aktif/reaktif (kW/kVA/kVAR), faktor daya (Cos &phi;), frekuensi, dan harmonisa THD secara real-time di seluruh panel distribusi.">
                        Digital power analyzers capture real-time voltage, current, active/reactive power (kW/kVA/kVAR),
                        power factor (Cos &phi;), frequency, and THD harmonics across all electrical distribution panels.
                    </p>
                </div>

                <div
                    class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col h-full">
                    <div
                        class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center font-bold text-base font-['Agrandir'] mb-4 shrink-0">
                        02</div>
                    <h3 class="text-lg sm:text-xl font-bold font-['Agrandir'] text-neutral-900 leading-snug min-h-[3.5rem] flex items-start mb-4"
                        data-lang-en="Environmental Sensors &amp; Gateways"
                        data-lang-id="Sensor Lingkungan &amp; Gateway Data">Environmental Sensors &amp; Gateways</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed flex-grow"
                        data-lang-en="Ambient temperature and humidity transmitters combined with multi-channel IoT data loggers forward telemetry via Modbus TCP with discrete event and alarm logging."
                        data-lang-id="Transmitter suhu dan kelembaban ruangan dikombinasikan dengan data logger multi-channel untuk meneruskan telemetri via Modbus TCP dengan pencatatan alarm dan event otomatis.">
                        Ambient temperature and humidity transmitters combined with multi-channel IoT data loggers
                        forward telemetry via Modbus TCP with discrete event and alarm logging.
                    </p>
                </div>

                <div
                    class="p-7 rounded-3xl bg-neutral-50 border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col h-full">
                    <div
                        class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center font-bold text-base font-['Agrandir'] mb-4 shrink-0">
                        03</div>
                    <h3 class="text-lg sm:text-xl font-bold font-['Agrandir'] text-neutral-900 leading-snug min-h-[3.5rem] flex items-start mb-4"
                        data-lang-en="Time-Series Historian &amp; Sizing" data-lang-id="Historian Time-Series &amp; Sizing">
                        Time-Series Historian &amp; Sizing</h3>
                    <p class="text-sm text-neutral-600 font-['Questrial'] leading-relaxed flex-grow"
                        data-lang-en="PostgreSQL + TimescaleDB engine calculates exact daily/yearly retention storage, minimum PC/server specs, and transparent CapEx/OpEx breakdown without client seat licensing fees."
                        data-lang-id="Database PostgreSQL + TimescaleDB menghitung estimasi kapasitas retensi storage (GB/tahun), spesifikasi PC server minimum, dan proyeksi biaya CapEx/OpEx tanpa biaya lisensi per kursi.">
                        PostgreSQL + TimescaleDB engine calculates exact daily/yearly retention storage, minimum PC/server
                        specs, and transparent CapEx/OpEx breakdown without client seat licensing fees.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. EXPLORE OTHER OPERATIONAL DOMAINS                                      -->
    <!-- ========================================================================= -->
    <section class="bg-black text-white py-20 sm:py-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-20">
            <div class="max-w-3xl mx-auto text-center mb-12 reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl font-bold font-['Agrandir'] text-white"
                    data-lang-en="Explore Other Operational Domains"
                    data-lang-id="Jelajahi Domain Operasional Lainnya">Explore Other Operational Domains</h2>
                <div class="w-16 h-1 bg-[#3367A5] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <a href="{{ route('application.manufacturing') }}"
                    class="group p-6 rounded-3xl bg-white border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col justify-center">
                    <h4
                        class="text-lg font-bold text-neutral-950 font-['Agrandir'] group-hover:text-[#3367A5] transition-colors"
                        data-lang-en="Manufacturing &amp; FMCG Bottle Inspection"
                        data-lang-id="Inspeksi Botol Manufaktur &amp; FMCG">
                        Manufacturing &amp; FMCG Bottle Inspection</h4>
                    <p class="text-xs text-neutral-600 font-['Questrial'] mt-2.5 leading-relaxed"
                       data-lang-en="High-speed optical bottle inspection, fill level &amp; cap verification, and multi-conveyor sync."
                       data-lang-id="Inspeksi botol optik kecepatan tinggi, verifikasi level isi &amp; tutup, serta sinkronisasi multi-konveyor.">
                       High-speed optical bottle inspection, fill level &amp; cap verification, and multi-conveyor sync.</p>
                </a>

                <a href="{{ route('application.automotive') }}"
                    class="group p-6 rounded-3xl bg-white border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col justify-center">
                    <h4
                        class="text-lg font-bold text-neutral-950 font-['Agrandir'] group-hover:text-[#3367A5] transition-colors"
                        data-lang-en="Automotive &amp; Machinery OEE"
                        data-lang-id="Otomotif &amp; Mesin OEE">
                        Automotive &amp; Machinery OEE</h4>
                    <p class="text-xs text-neutral-600 font-['Questrial'] mt-2.5 leading-relaxed"
                       data-lang-en="OEE production analytics, shift downtime tracking, and line throughput optimization."
                       data-lang-id="Analitik produksi OEE, pemantauan downtime shift, dan optimalisasi throughput lini.">
                       OEE production analytics, shift downtime tracking, and line throughput optimization.</p>
                </a>

                <a href="{{ route('application.pharma') }}"
                    class="group p-6 rounded-3xl bg-white border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col justify-center">
                    <h4
                        class="text-lg font-bold text-neutral-950 font-['Agrandir'] group-hover:text-[#3367A5] transition-colors"
                        data-lang-en="Pharma &amp; Cleanrooms EnPI"
                        data-lang-id="Farmasi &amp; Ruang Bersih EnPI">
                        Pharma &amp; Cleanrooms EnPI</h4>
                    <p class="text-xs text-neutral-600 font-['Questrial'] mt-2.5 leading-relaxed"
                       data-lang-en="EnPI energy performance (ISO 50001), SEC daily tracking, and carbon credit valuation."
                       data-lang-id="Kinerja energi EnPI (ISO 50001), pelacakan harian SEC, dan valuasi kredit karbon.">
                       EnPI energy performance (ISO 50001), SEC daily tracking, and carbon credit valuation.</p>
                </a>

                <a href="{{ route('application.packaging') }}"
                    class="group p-6 rounded-3xl bg-white border border-neutral-200/80 hover:border-[#3367A5] transition-colors duration-200 flex flex-col justify-center">
                    <h4
                        class="text-lg font-bold text-neutral-950 font-['Agrandir'] group-hover:text-[#3367A5] transition-colors"
                        data-lang-en="Power Quality &amp; Cos φ Telemetry"
                        data-lang-id="Kualitas Daya &amp; Telemetri Cos φ">
                        Power Quality &amp; Cos φ Telemetry</h4>
                    <p class="text-xs text-neutral-600 font-['Questrial'] mt-2.5 leading-relaxed"
                        data-lang-en="kVarh monitoring, automatic capacitor bank control, and PLN penalty mitigation."
                        data-lang-id="Monitoring kVarh, kendali kapasitor bank otomatis, dan mitigasi penalti PLN.">
                        kVarh monitoring, automatic capacitor bank control, and PLN penalty mitigation.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. CONSULTATION CTA (Floating Corporate Royal Blue Card)                  -->
    <!-- ========================================================================= -->
    <x-cta-banner
        eyebrow-en="Smart BMS & Energy SCADA"
        eyebrow-id="Smart BMS & SCADA Energi"
        title-en="Planning a Facility BMS or Energy SCADA Modernization?"
        title-id="Merencanakan Modernisasi BMS atau SCADA Energi Fasilitas?"
        description-en="Contact our smart building engineers for HVAC sequence audits, energy dashboard demos, and fieldbus gateway integration."
        description-id="Hubungi insinyur otomasi gedung kami untuk audit sekuens HVAC, demo dashboard energi, dan integrasi gateway fieldbus."
        primary-label-en="Request Technical Consultation"
        primary-label-id="Minta Konsultasi Teknis"
        wa-message="Halo Tim Marketing PT Global Aspect Technology, saya ingin berdiskusi mengenai sistem Smart BMS & Energy Information System (EIS)."
    />

    <!-- Floating Action Button -->
    @include('components.button.button')

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Script for Smooth Scroll & Observer -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -40px 0px'
                });
                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-revealed'));
            }
        });
    </script>
</body>

</html>
