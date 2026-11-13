<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Aspek Teknologi</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600;700;800;900&family=Syne:wght@400..800&family=Viga&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
        /* Lenis Smooth Scroll System */
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

        .reveal-stagger-1 {
            transition-delay: 0.08s;
        }

        .reveal-stagger-2 {
            transition-delay: 0.16s;
        }

        .reveal-stagger-3 {
            transition-delay: 0.24s;
        }

        .reveal-stagger-4 {
            transition-delay: 0.32s;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full">

    <!-- Navbar -->
    @include('components.navbar.header')


    <!-- Single Slide Hero Section with Orbital Ecosystem -->
    <!-- Single Slide Hero Section (Inspired by Sevensense Robotics Blueprint Layout) -->
    <section
        class="relative w-full min-h-[calc(100vh-92px)] pt-28 sm:pt-32 lg:pt-36 pb-16 sm:pb-20 lg:pb-24 flex flex-col justify-start bg-white overflow-hidden">

        <div class="w-full px-4 sm:px-6 md:px-8 lg:px-10 xl:px-14 relative z-20">

            <!-- 1. Top-Left Engineering Headline (Tepat di Atas Gambar) -->
            <div class="w-full text-left mb-2 sm:mb-3 pt-3 sm:pt-4 lg:pt-6">
                <!-- Main Bold Engineering Headline -->
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-[50px] xl:text-[56px] font-black text-gray-950 font-['Agrandir',sans-serif] tracking-tight leading-[1.10] text-left">
                    <span class="block text-gray-950" data-lang-en="Machine Vision &amp;" data-lang-id="Machine Vision &amp;">Machine Vision &amp;</span>
                    <span class="block text-[#3367A5]" data-lang-en="Integrated Systems." data-lang-id="Sistem Terintegrasi.">Integrated Systems.</span>
                </h1>
            </div>

            <!-- 2. Centerpiece Stage: Transparent Hardware Sensor Unit (Dinaikkan Agar Tidak Terlalu di Bawah) -->
            <div
                class="relative w-full max-w-6xl mx-auto flex flex-col items-center justify-center select-none py-1 sm:py-2 -mt-3 sm:-mt-6 lg:-mt-10">
                <div class="relative w-full flex items-center justify-center">
                    <picture class="relative z-10">
                        <source srcset="{{ asset('images/HeroSection01_transparent.webp') }}" type="image/webp">
                        <img src="{{ asset('images/HeroSection01_transparent.png') }}"
                            alt="PT Global Aspect Technology - Smart Optical Vision & Inspection System"
                            class="w-full max-h-[460px] sm:max-h-[520px] lg:max-h-[580px] object-contain block pointer-events-none drop-shadow-[0_20px_45px_rgba(0,0,0,0.06)]">
                    </picture>

                    <!-- Technical Sub-Narrative Placed in Lower-Right (Samping Connection Interface, Posisi Semula yang Sudah Benar) -->
                    <div
                        class="hidden md:block absolute bottom-4 lg:bottom-8 right-0 md:translate-x-8 lg:translate-x-12 max-w-[270px] lg:max-w-[310px] text-left pointer-events-auto z-20">
                        <div data-lang-en="High-Speed Vision Inspection" data-lang-id="Inspeksi Visual Kecepatan Tinggi"
                            class="text-[11px] lg:text-xs font-bold text-gray-900 uppercase tracking-wider font-['Poppins']">
                            High-Speed Vision Inspection
                        </div>
                        <p data-lang-en="Sub-micron optical defect detection, high-speed barcode verification, and automated sorting engineered for 24/7 manufacturing reliability." data-lang-id="Deteksi cacat optik sub-mikron, verifikasi barcode berkecepatan tinggi, dan penyortiran otomatis untuk keandalan produksi 24/7."
                            class="text-[11px] lg:text-xs text-gray-600 font-['Poppins'] leading-relaxed mt-1">
                            Sub-micron optical defect detection, high-speed barcode verification, and automated sorting engineered for
                            24/7 manufacturing reliability.
                        </p>
                        <div class="mt-2.5">
                            <a href="{{ route('inspection') }}"
                                class="group inline-flex items-center gap-1.5 text-xs font-semibold text-[#3367A5] hover:text-[#255187] transition font-['Poppins']">
                                <span data-lang-en="Explore Vision Systems" data-lang-id="Jelajahi Sistem Vision">Explore Vision Systems</span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile View for Technical Sub-Narrative (Cleanly positioned below image on small screens) -->
                <div class="md:hidden w-full max-w-sm text-left mt-3 px-2">
                    <div data-lang-en="Machine Vision &amp; AI Integration" data-lang-id="Integrasi Machine Vision &amp; AI"
                        class="text-xs font-bold text-gray-900 uppercase tracking-wider font-['Poppins']">
                        Machine Vision &amp; AI Integration
                    </div>
                    <p data-lang-en="Sub-micron optical inspection, automated packaging, and Tier-1 PLC telemetry engineered for 24/7 reliability." data-lang-id="Inspeksi optik sub-mikron, pengemasan otomatis, dan telemetri PLC Tier-1 yang dirancang untuk keandalan 24/7."
                        class="text-xs text-gray-600 font-['Poppins'] leading-relaxed mt-1">
                        Sub-micron optical inspection, automated packaging, and Tier-1 PLC telemetry engineered for 24/7
                        reliability.
                    </p>
                    <div class="mt-2.5">
                        <a href="{{ route('product') }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-[#3367A5] font-['Poppins']">
                            <span data-lang-en="Explore Solutions &rarr;" data-lang-id="Jelajahi Solusi &rarr;">Explore Solutions &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Seamless Smoky Dark Gradient Transition from Hero (White) into Section 1 (Black) -->
        <div
            class="absolute bottom-0 left-0 right-0 h-12 sm:h-16 lg:h-20 bg-gradient-to-b from-transparent via-black/40 to-black pointer-events-none z-10">
        </div>
    </section>

    <!-- Floating Badge Animations -->
    <style>
        @keyframes floatSlow1 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-8px) scale(1.02);
            }
        }

        @keyframes floatSlow2 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(10px) scale(0.98);
            }
        }

        @keyframes floatSlow3 {

            0%,
            100% {
                transform: translateX(0px) translateY(0px);
            }

            50% {
                transform: translateX(-5px) translateY(-6px);
            }
        }

        .animate-float-1 {
            animation: floatSlow1 5s ease-in-out infinite;
        }

        .animate-float-2 {
            animation: floatSlow2 6s ease-in-out infinite 0.8s;
        }

        .animate-float-3 {
            animation: floatSlow3 5.5s ease-in-out infinite 1.5s;
        }
    </style>



    <!-- Section 1: Welcome & Company Overview -->
    <section class="relative bg-black text-white py-16 sm:py-20 lg:py-24 overflow-hidden">
        <!-- Ambient Radial Glow Accents -->
        <div class="absolute top-1/4 -left-48 w-96 h-96 bg-[#3367A5]/15 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-10 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <!-- Section 1 Tagline Banner -->
            <div class="text-center mb-12 sm:mb-14 lg:mb-16 reveal-on-scroll">
                <h2 data-lang-en="We Are The Solution Partner In Automation Industry" data-lang-id="Mitra Solusi Tepercaya Anda di Industri Otomasi"
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-[42px] font-normal text-white font-['Agrandir',sans-serif] leading-snug tracking-tight">
                    We Are The Solution Partner In Automation Industry
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch gap-10 lg:gap-12 xl:gap-16">

                <!-- Left Column: Content (Headline, Narrative & Elevated Stats - Vertically Centered with Right Card) -->
                <div
                    class="w-full lg:w-1/2 text-left pt-0 flex flex-col justify-center reveal-on-scroll reveal-stagger-1">
                    <div class="flex flex-col justify-start">
                        <!-- Main Headline (2 Baris Rata Kiri dengan Jarak Baris Proporsional) -->
                        <h2
                            class="text-3xl sm:text-4xl lg:text-[44px] xl:text-[48px] font-extrabold text-white font-['Agrandir',sans-serif] leading-[1.22] tracking-tight mb-5 lg:mb-6 text-left">
                            <span class="block sm:whitespace-nowrap" data-lang-en="Welcome to the" data-lang-id="Selamat Datang di">Welcome to the</span>
                            <span class="block sm:whitespace-nowrap mt-1" data-lang-en="Industry 4.0 Revolution" data-lang-id="Revolusi Industri 4.0">Industry 4.0 Revolution</span>
                        </h2>

                        <!-- Narrative Summary Paragraph (Line Spacing Proporsional & Rapi) -->
                        <p data-lang-en="Founded in 2017, &lt;strong class=&quot;text-white font-semibold&quot;&gt;PT. Global Aspect Technology&lt;/strong&gt; specializes in delivering tailored integrated systems in automation, software development, monitoring, and control for manufacturing and non-industrial sectors of all scales. As Industry 4.0 transforms modern production, we empower businesses to harness cutting-edge technologies—such as the Internet of Things (IoT), artificial intelligence (AI), and real-time cloud telemetry—to streamline operations, enhance decision-making, and reduce costs. Our close collaborative approach and end-to-end integration expertise ensure high efficiency, reliability, and long-term agility in an ever-evolving digital landscape."
                           data-lang-id="Didirikan pada tahun 2017, &lt;strong class=&quot;text-white font-semibold&quot;&gt;PT. Global Aspect Technology&lt;/strong&gt; berfokus dalam menghadirkan sistem terintegrasi khusus pada bidang otomasi, pengembangan perangkat lunak, pemantauan, dan pengendalian untuk sektor manufaktur maupun non-industri di berbagai skala. Seiring perkembangan Industri 4.0, kami memberdayakan pelaku industri melalui pemanfaatan teknologi mutakhir—seperti Internet of Things (IoT), kecerdasan buatan (AI), dan telemetri cloud real-time—untuk menyederhanakan alur operasional, mempercepat pengambilan keputusan, dan menghemat biaya. Pendekatan kolaboratif dan keahlian integrasi menyeluruh kami menjamin efisiensi tinggi, keandalan maksimal, dan fleksibilitas jangka panjang di era digital yang dinamis."
                            class="text-sm sm:text-base lg:text-[15px] xl:text-base text-gray-300 font-['Agrandir',sans-serif] leading-[1.65] text-justify mb-0">
                            Founded in 2017, <strong class="text-white font-semibold">PT. Global Aspect
                                Technology</strong> specializes in delivering tailored integrated systems in automation,
                            software development, monitoring, and control for manufacturing and non-industrial sectors
                            of all scales. As Industry 4.0 transforms modern production, we empower businesses to
                            harness cutting-edge technologies—such as the Internet of Things (IoT), artificial
                            intelligence (AI), and real-time cloud telemetry—to streamline operations, enhance
                            decision-making, and reduce costs. Our close collaborative approach and end-to-end
                            integration expertise ensure high efficiency, reliability, and long-term agility in an
                            ever-evolving digital landscape.
                        </p>
                    </div>

                    <!-- Stats & CTA Row (Dinaikkan Tepat di Bawah Paragraf) -->
                    <div
                        class="flex flex-wrap sm:flex-nowrap items-center justify-between gap-4 mt-6 sm:mt-8 pt-6 border-t border-white/10">
                        <!-- Stats Group -->
                        <div class="flex items-center gap-4 sm:gap-6 lg:gap-5 xl:gap-6">
                            <!-- Stat 1: Year -->
                            <div>
                                <div
                                    class="text-2xl sm:text-3xl font-black text-white tracking-tight font-['Agrandir',sans-serif]">
                                    2017</div>
                                <div data-lang-en="Established" data-lang-id="Tahun Berdiri" class="text-xs text-gray-400 font-['Questrial',sans-serif] mt-0.5">
                                    Established</div>
                            </div>

                            <!-- Divider -->
                            <div class="h-7 w-px bg-white/20"></div>

                            <!-- Stat 2: Projects -->
                            <div>
                                <div
                                    class="text-2xl sm:text-3xl font-black text-white tracking-tight font-['Agrandir',sans-serif]">
                                    100+</div>
                                <div data-lang-en="Projects Done" data-lang-id="Proyek Selesai" class="text-xs text-gray-400 font-['Questrial',sans-serif] mt-0.5">
                                    Projects Done</div>
                            </div>

                            <!-- Divider -->
                            <div class="h-7 w-px bg-white/20"></div>

                            <!-- Stat 3: Reliability -->
                            <div>
                                <div
                                    class="text-2xl sm:text-3xl font-black text-[#4D88CF] tracking-tight font-['Agrandir',sans-serif]">
                                    99.9%</div>
                                <div data-lang-en="Reliability" data-lang-id="Keandalan" class="text-xs text-gray-400 font-['Questrial',sans-serif] mt-0.5">
                                    Reliability</div>
                            </div>
                        </div>

                        <!-- CTA Button (Gliding Red Wipe Button like Get A Quote) -->
                        <div class="pt-2 sm:pt-0">
                            <a href="{{ route('about') }}"
                                class="group relative inline-flex items-center justify-center overflow-hidden py-3 px-5 sm:px-6 bg-white text-black hover:text-white text-xs sm:text-sm font-semibold font-['Questrial',sans-serif] tracking-wide rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.2)] hover:shadow-[0_6px_22px_rgba(51,103,165,0.4)] active:scale-95 whitespace-nowrap"
                                style="transition: all 1000ms cubic-bezier(0.25, 1, 0.5, 1);">
                                <!-- Red Wipe Layer from Left to Right -->
                                <span
                                    class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0"
                                    style="transition: transform 1000ms cubic-bezier(0.25, 1, 0.5, 1);"></span>

                                <!-- Text & Arrow Layer -->
                                <span class="relative z-10 flex items-center gap-2">
                                    <span data-lang-en="Explore Our Story" data-lang-id="Pelajari Kisah Kami">Explore Our Story</span>
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Smart Factory & Productivity Bento Grid -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end reveal-on-scroll reveal-stagger-2">
                    <div
                        class="w-full max-w-xl xl:max-w-2xl h-full bg-white rounded-3xl shadow-[0_25px_70px_rgba(0,0,0,0.5)] border border-gray-100 overflow-hidden flex flex-col justify-between p-5 sm:p-6 lg:p-7 gap-5 text-gray-900 select-none">

                        <!-- Top Bento Card: Overview Video Showcase (Autoplay & Loop) -->
                        <div
                            class="w-full bg-[#FAFAFA] rounded-2xl overflow-hidden border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] transition-all duration-300 hover:shadow-md relative flex items-center justify-center">
                            <video autoplay loop muted playsinline preload="auto"
                                class="w-full h-auto object-cover rounded-2xl block">
                                <source src="{{ asset('storage/OverView Card.mp4') }}" type="video/mp4">
                            </video>
                        </div>

                        <!-- Bottom Stack: 2 Cards (Arranged Vertically: Atas-Bawah) -->
                        <div class="flex flex-col gap-3 sm:gap-3.5 mt-auto">

                            <!-- Card 1 (Atas): Hardware Integration -->
                            <div
                                class="bg-[#FAFAFA] rounded-2xl p-4 sm:p-5 border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-center transition-all duration-300 hover:shadow-md">
                                <div>
                                    <h4 data-lang-en="Unified Integration" data-lang-id="Integrasi Terpadu"
                                        class="text-sm sm:text-base font-bold font-['Agrandir',sans-serif] text-gray-950">
                                        Unified Integration
                                    </h4>
                                    <p data-lang-en="Integrate smoothly with Tier-1 automation controllers, PLC, and enterprise SCADA telemetries." data-lang-id="Terintegrasi mulus dengan pengontrol otomasi Tier-1, PLC, dan telemetri SCADA enterprise."
                                        class="text-xs text-gray-500 font-['Questrial',sans-serif] mt-1 sm:mt-1.5 leading-relaxed">
                                        Integrate smoothly with Tier-1 automation controllers, PLC, and enterprise SCADA
                                        telemetries.
                                    </p>
                                </div>
                            </div>

                            <!-- Card 2 (Bawah): 3X Efficiency (Matching 3X >>>> in reference) -->
                            <div
                                class="bg-[#FAFAFA] rounded-2xl p-4 sm:p-5 border border-gray-100/90 shadow-[0_2px_12px_rgba(0,0,0,0.03)] flex flex-col justify-center transition-all duration-300 hover:shadow-md">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-2xl sm:text-3xl font-black font-['Agrandir',sans-serif] text-gray-950 tracking-tight leading-none">
                                            3X
                                        </span>
                                        <span
                                            class="text-base sm:text-lg font-bold text-gray-300 tracking-wider select-none">
                                            &rsaquo;&rsaquo;&rsaquo;&rsaquo;
                                        </span>
                                    </div>
                                    <p data-lang-en="Boost team &amp; plant efficiency by 3X with automated workflows and streamlined communication." data-lang-id="Tingkatkan efisiensi tim &amp; pabrik hingga 3X lipat dengan alur kerja otomatis dan komunikasi terpadu."
                                        class="text-xs text-gray-500 font-['Questrial',sans-serif] leading-relaxed mt-1 sm:mt-1.5">
                                        Boost team &amp; plant efficiency by 3X with automated workflows and streamlined
                                        communication.
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section 2: Providing Professional Solutions & Elevating Industrial Experience (Unified Section) -->
    <section class="relative w-full bg-white text-black pt-24 sm:pt-28 lg:pt-36 pb-14 sm:pb-18 lg:pb-24 overflow-hidden">
        <!-- Seamless Smoky Dark Gradient / Shadow Transition from Section 1 (Black) into Section 2 (White) -->
        <div
            class="absolute top-0 left-0 right-0 h-12 sm:h-16 lg:h-20 bg-gradient-to-b from-black via-black/40 to-transparent pointer-events-none z-10">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <!-- Top Tagline Banner Header (Diberi Jarak Lega dari Bayangan Hitam) -->
            <div class="text-center pt-2 sm:pt-4 mb-10 sm:mb-12 lg:mb-14 reveal-on-scroll">
                <h2 data-lang-en="Providing Professional And Reliable Solutions For Various Industry" data-lang-id="Menyediakan Solusi Profesional dan Tepercaya untuk Berbagai Industri"
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-normal font-['Questrial',sans-serif] text-black leading-snug tracking-tight">
                    Providing Professional And Reliable Solutions For Various Industry
                </h2>
            </div>

            <!-- Video Simulation Showcase (Autoplay, Loop, Muted) -->
            <div
                class="w-full max-w-5xl mx-auto mb-10 sm:mb-12 lg:mb-16 rounded-2xl sm:rounded-3xl overflow-hidden border border-gray-100 shadow-[0_12px_45px_rgba(0,0,0,0.08)] bg-neutral-100 reveal-on-scroll">
                <video autoplay loop muted playsinline preload="auto"
                    class="w-full h-auto object-cover rounded-2xl sm:rounded-3xl block">
                    <source src="{{ asset('storage/VideoSection02.mp4') }}" type="video/mp4">
                </video>
            </div>

            <!-- Content Row: Kiri (Headline Diperbesar) & Kanan (Narasi & Tombol) -->
            <div
                class="w-full max-w-5xl mx-auto flex flex-col md:flex-row items-start justify-between gap-8 sm:gap-10 lg:gap-14 reveal-on-scroll">
                <!-- Sisi Kiri (Gambar 1): Main Headline Diperbesar (3 Baris Rata Kiri) -->
                <div class="w-full md:w-1/2 text-left">
                    <h2
                        class="text-4xl sm:text-5xl md:text-5xl lg:text-[64px] xl:text-[74px] font-extrabold font-['Agrandir',sans-serif] text-black leading-[1.05] tracking-tight">
                        <span class="block" data-lang-en="Elevating the" data-lang-id="Meningkatkan">Elevating the</span>
                        <span class="block mt-1 sm:mt-1.5" data-lang-en="Industrial" data-lang-id="Pengalaman">Industrial</span>
                        <span class="block mt-1 sm:mt-1.5" data-lang-en="Experience" data-lang-id="Industri">Experience</span>
                    </h2>
                </div>

                <!-- Sisi Kanan (Gambar 2): Narrative Paragraph & CTA Button -->
                <div class="w-full md:w-1/2 text-left flex flex-col items-start justify-start">
                    <p data-lang-en="Transforming traditional manufacturing into intelligent, high-efficiency ecosystems, we engineer bespoke automation systems, advanced PLC programming, and precision robotics tailored to meet the complex demands of modern high-speed industrial environments. By embedding smart IoT telemetry, machine vision inspection, and real-time cloud data, we empower enterprises to eliminate operational bottlenecks, optimize productivity, and significantly reduce operating costs while establishing a resilient foundation for continuous industrial innovation."
                       data-lang-id="Mentransformasi manufaktur konvensional menjadi ekosistem cerdas berkecepatan tinggi, kami merekayasa sistem otomasi khusus, pemrograman PLC tingkat lanjut, dan robotika presisi yang disesuaikan untuk menjawab tantangan industri modern. Dengan mengintegrasikan telemetri cerdas IoT, inspeksi machine vision, dan data cloud real-time, kami membantu perusahaan mengatasi kendala operasional, memaksimalkan produktivitas, serta menekan biaya produksi secara signifikan sekaligus membangun fondasi yang tangguh bagi inovasi industri berkelanjutan."
                        class="text-sm sm:text-base lg:text-base xl:text-lg text-gray-600 font-['Questrial',sans-serif] leading-[1.65] text-justify">
                        Transforming traditional manufacturing into intelligent, high-efficiency ecosystems, we
                        engineer bespoke automation systems, advanced PLC programming, and precision robotics tailored
                        to meet the complex demands of modern high-speed industrial environments. By embedding smart IoT
                        telemetry, machine vision inspection, and real-time cloud data, we empower enterprises to
                        eliminate operational bottlenecks, optimize productivity, and significantly reduce operating
                        costs while establishing a resilient foundation for continuous industrial innovation.
                    </p>
                    <div class="mt-6 sm:mt-8">
                        <a href="{{ route('about') }}"
                            class="group relative inline-flex items-center justify-center overflow-hidden px-8 py-3.5 sm:py-4 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-base sm:text-lg font-normal tracking-wide rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(51,103,165,0.4)] hover:border-[#3367A5]/60 active:scale-95 whitespace-nowrap font-['Questrial',sans-serif]"
                            style="transition: all 1000ms cubic-bezier(0.25, 1, 0.5, 1);">
                            <!-- Red Wipe Layer from Left to Right -->
                            <span
                                class="absolute inset-0 bg-[#3367A5] rounded-full -translate-x-full group-hover:translate-x-0"
                                style="transition: transform 1000ms cubic-bezier(0.25, 1, 0.5, 1);"></span>

                            <!-- Text Layer -->
                            <span data-lang-en="Explore Our About Us" data-lang-id="Tentang Kami Selengkapnya" class="relative z-10 font-['Questrial',sans-serif]">
                                Explore Our About Us
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seamless Smoky Dark Gradient Transition from Section 2 (White) into Section 3 (Dark) -->
        <div
            class="absolute bottom-0 left-0 right-0 h-12 sm:h-16 lg:h-20 bg-gradient-to-b from-transparent via-black/40 to-[#0B0C10] pointer-events-none z-10">
        </div>
    </section>

    <!-- Section 3: Core Industrial Automation & Machinery Solutions (Catalog Portfolio) -->
    <section class="relative w-full bg-[#0B0C10] text-white py-16 sm:py-20 lg:py-28 overflow-hidden">
        <!-- Ambient Radial Glow Accents -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#3367A5]/15 rounded-full blur-[130px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-10 w-[450px] h-[450px] bg-blue-600/5 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-12 sm:mb-16 lg:mb-20 reveal-on-scroll">
                <h2 data-lang-en="Engineered Automation Systems &amp; Industrial Machinery" data-lang-id="Sistem Otomasi Rekayasa &amp; Mesin Industri"
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-[46px] font-extrabold text-white font-['Agrandir',sans-serif] tracking-tight leading-tight">
                    Engineered Automation Systems &amp; Industrial Machinery
                </h2>
            </div>

            <!-- 6-Card Grid: The 6 Core Product Categories of PT Global Aspek Teknologi -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 lg:gap-8">

                <!-- Category 1: Industrial Strapping & Packaging -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-1">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: delivery-box-01 -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M2.5 7.5v6c0 3.771 0 5.657 1.172 6.828S6.729 21.5 10.5 21.5h3c3.771 0 5.657 0 6.828-1.172S21.5 17.271 21.5 13.5v-6M3.87 5.315L2.5 7.5h19l-1.252-2.087c-.854-1.423-1.28-2.134-1.969-2.524c-.687-.389-1.517-.389-3.176-.389h-6.15c-1.623 0-2.435 0-3.113.375c-.678.376-1.109 1.064-1.97 2.44M12 7.5v-5M6 18h5m-5-3h3" />
                                </svg>
                            </div>
                            <span data-lang-en="Packaging Machinery" data-lang-id="Mesin Pengemasan"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Packaging Machinery
                            </span>
                        </div>
                        <h3 data-lang-en="Industrial Strapping &amp; Packaging" data-lang-id="Strapping &amp; Pengemasan Industri"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            Industrial Strapping &amp; Packaging
                        </h3>
                        <p data-lang-en="Heavy-duty battery-powered friction welders (V2 3200N), pneumatic strapping sealers (A25), and high-tension pneumatic steel strap tools (KZ-19 8,500N)."
                           data-lang-id="Alat las gesek bertenaga baterai tugas berat (V2 3200N), sealer strapping pneumatik (A25), dan alat strapping baja pneumatik tegangan tinggi (KZ-19 8.500N)."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            Heavy-duty battery-powered friction welders (V2 3200N), pneumatic strapping sealers (A25), and high-tension pneumatic steel strap tools (KZ-19 8,500N).
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="Battery V2 3200N" data-lang-id="Baterai V2 3200N"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Battery
                                V2 3200N</span>
                            <span data-lang-en="Pneumatic A25" data-lang-id="Pneumatik A25"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Pneumatic
                                A25</span>
                            <span data-lang-en="Steel Band KZ-19" data-lang-id="Tali Baja KZ-19"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Steel
                                Band KZ-19</span>
                        </div>
                        <a href="{{ route('strapping') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Strapping Solutions" data-lang-id="Lihat Solusi Strapping">Explore Strapping Solutions</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Category 2: Vision & Auto-Inspection -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-2">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: scan-eye -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17c4.227 0 6.334-3.491 6.913-4.64a.8.8 0 0 0 0-.722C18.334 10.49 16.227 7 12 7s-6.334 3.49-6.913 4.638a.8.8 0 0 0 0 .723C5.666 13.509 7.773 17 12 17" />
                                    <circle cx="12" cy="11.999" r="2" />
                                    <path
                                        d="M21.5 7.5c-.091-1.846-.365-2.997-1.184-3.816c-.819-.818-1.97-1.092-3.816-1.184m-14 5c.092-1.847.365-2.998 1.184-3.816c.819-.82 1.97-1.093 3.816-1.184m14 14c-.091 1.846-.365 2.997-1.184 3.816s-1.97 1.092-3.816 1.184m-14-5c.092 1.847.365 2.998 1.184 3.817c.819.818 1.97 1.092 3.816 1.184" />
                                </svg>
                            </div>
                            <span data-lang-en="Machine Vision" data-lang-id="Machine Vision"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Machine Vision
                            </span>
                        </div>
                        <h3 data-lang-en="Vision &amp; Auto-Inspection" data-lang-id="Sistem Visi &amp; Auto-Inspeksi"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            Vision &amp; Auto-Inspection
                        </h3>
                        <p data-lang-en="Sub-micron multi-angle dimensional measurement systems (±0.001 mm accuracy) and high-speed 1D/2D optical barcode readers for automated inline QC."
                           data-lang-id="Sistem pengukuran dimensi multi-sudut sub-mikron (akurasi ±0,001 mm) dan pembaca barcode optik 1D/2D berkecepatan tinggi untuk QC otomatis inline."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            Sub-micron multi-angle dimensional measurement systems (±0.001 mm accuracy) and high-speed 1D/2D optical barcode readers for automated inline QC.
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="±0.001mm Accuracy" data-lang-id="Akurasi ±0.001mm"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">±0.001mm
                                Accuracy</span>
                            <span data-lang-en="1D/2D Barcode" data-lang-id="Barcode 1D/2D"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">1D/2D
                                Barcode</span>
                            <span data-lang-en="Optical QC" data-lang-id="QC Optik"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Optical
                                QC</span>
                        </div>
                        <a href="{{ route('inspection') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Vision Inspection" data-lang-id="Lihat Inspeksi Vision">Explore Vision Inspection</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Category 3: Industrial Coding & Marking -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-3">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: printer -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M17 17h1.667c1.246 0 1.869 0 2.333-.268a2 2 0 0 0 .732-.732c.268-.464.268-1.087.268-2.333c0-2.493 0-3.739-.536-4.667A4 4 0 0 0 20 7.536C19.072 7 17.826 7 15.333 7H8.667C6.174 7 4.928 7 4 7.536A4 4 0 0 0 2.536 9C2 9.928 2 11.174 2 13.667c0 1.246 0 1.869.268 2.333a2 2 0 0 0 .732.732C3.464 17 4.087 17 5.333 17H7M17 7V5c0-1.414 0-2.121-.44-2.56C16.122 2 15.415 2 14 2h-4c-1.414 0-2.121 0-2.56.44C7 2.878 7 3.585 7 5v2" />
                                    <path
                                        d="M17 14v5c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44h-4c-1.414 0-2.121 0-2.56-.44C7 21.122 7 20.415 7 19v-5zm1.875-3.75h-.125m.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0" />
                                </svg>
                            </div>
                            <span data-lang-en="Coding &amp; Marking" data-lang-id="Pencetakan Kode &amp; Penandaan"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Coding &amp; Marking
                            </span>
                        </div>
                        <h3 data-lang-en="Industrial Coding &amp; Marking" data-lang-id="Pencetakan Kode &amp; Penandaan Industri"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            Industrial Coding &amp; Marking
                        </h3>
                        <p data-lang-en="High-speed Thermal Inkjet (TIJ G0510) printers and industrial laser marking for non-contact lot batch codes, expiry dates, and 2D serialization."
                           data-lang-id="Printer Thermal Inkjet kecepatan tinggi (TIJ G0510) dan laser marking industri untuk kode lot batch non-kontak, tanggal kedaluwarsa, dan serialisasi 2D."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            High-speed Thermal Inkjet (TIJ G0510) printers and industrial laser marking for non-contact lot batch codes, expiry dates, and 2D serialization.
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="TIJ G0510 Inkjet" data-lang-id="Inkjet TIJ G0510"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">TIJ
                                G0510 Inkjet</span>
                            <span data-lang-en="Laser Marking" data-lang-id="Laser Marking"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Laser
                                Marking</span>
                            <span data-lang-en="Batch Serialization" data-lang-id="Serialisasi Batch"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Batch
                                Serialization</span>
                        </div>
                        <a href="{{ route('laser-marking') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Coding Solutions" data-lang-id="Lihat Solusi Koding">Explore Coding Solutions</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Category 4: PLC & Control Automation -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-1">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: cpu -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M4 12c0-3.771 0-5.657 1.172-6.828S8.229 4 12 4s5.657 0 6.828 1.172S20 8.229 20 12s0 5.657-1.172 6.828S15.771 20 12 20s-5.657 0-6.828-1.172S4 15.771 4 12Z" />
                                    <path stroke-linecap="round"
                                        d="M9.5 2v2m5-2v2m-5 16v2m5-2v2M13 9l-4 4m6 0l-2 2m9-.5h-2m-16-5H2m2 5H2m20-5h-2" />
                                </svg>
                            </div>
                            <span data-lang-en="Control &amp; Panel" data-lang-id="Panel &amp; Kontrol"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Control &amp; Panel
                            </span>
                        </div>
                        <h3 data-lang-en="PLC &amp; Control Automation" data-lang-id="Otomasi Kontrol &amp; PLC"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            PLC &amp; Control Automation
                        </h3>
                        <p data-lang-en="Custom industrial electrical control panels, multi-brand PLC programming (Siemens, Mitsubishi, Omron), synchronized motion control, and HMI/SCADA interfaces."
                           data-lang-id="Panel kontrol listrik industri kustom, pemrograman PLC multi-merek (Siemens, Mitsubishi, Omron), kontrol gerak tersinkronisasi, dan antarmuka HMI/SCADA."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            Custom industrial electrical control panels, multi-brand PLC programming (Siemens, Mitsubishi, Omron), synchronized motion control, and HMI/SCADA interfaces.
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="Integrated Panels" data-lang-id="Panel Terintegrasi"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Integrated
                                Panels</span>
                            <span data-lang-en="Multi-Brand PLC" data-lang-id="PLC Multi-Merek"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Multi-Brand
                                PLC</span>
                            <span data-lang-en="HMI &amp; SCADA" data-lang-id="HMI &amp; SCADA"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">HMI
                                &amp; SCADA</span>
                        </div>
                        <a href="{{ route('plc-progamming') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Automation Panels" data-lang-id="Lihat Panel Otomasi">Explore Automation Panels</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Category 5: Sensors & Industrial Telemetry -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-2">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: activity-01 -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M4.318 19.682C3 18.364 3 16.242 3 12s0-6.364 1.318-7.682S7.758 3 12 3s6.364 0 7.682 1.318S21 7.758 21 12s0 6.364-1.318 7.682S16.242 21 12 21s-6.364 0-7.682-1.318" />
                                    <path d="m7 14l2.793-2.793a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10" />
                                </svg>
                            </div>
                            <span data-lang-en="Sensors &amp; Telemetry" data-lang-id="Sensor &amp; Telemetri"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Sensors &amp; Telemetry
                            </span>
                        </div>
                        <h3 data-lang-en="Sensors &amp; Industrial Telemetry" data-lang-id="Sensor &amp; Telemetri Industri"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            Sensors &amp; Industrial Telemetry
                        </h3>
                        <p data-lang-en="Long-range optical thrubeam sensors, high-precision liquid &amp; gas flowmeters, and real-time telemetry modules for continuous factory process monitoring."
                           data-lang-id="Sensor optik tembus jarak jauh, flowmeter cairan &amp; gas presisi tinggi, dan modul telemetri real-time untuk pemantauan proses pabrik terus-menerus."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            Long-range optical thrubeam sensors, high-precision liquid &amp; gas flowmeters, and real-time telemetry modules for continuous factory process monitoring.
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="Thrubeam Optical" data-lang-id="Optik Thrubeam"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Thrubeam
                                Optical</span>
                            <span data-lang-en="Fluid Flowmeter" data-lang-id="Flowmeter Cairan"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Fluid
                                Flowmeter</span>
                            <span data-lang-en="Edge Telemetry" data-lang-id="Telemetri Edge"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Edge
                                Telemetry</span>
                        </div>
                        <a href="{{ route('monitoring') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Sensor Telemetry" data-lang-id="Lihat Telemetri Sensor">Explore Sensor Telemetry</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Category 6: Mechanical & Conveyor Integration -->
                <div
                    class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 lg:p-8 flex flex-col justify-between transition-all duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:shadow-[0_20px_45px_rgba(0,0,0,0.45)] hover:-translate-y-1.5 reveal-on-scroll reveal-stagger-3">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div
                                class="w-12 h-12 rounded-xl sm:rounded-2xl bg-[#3367A5]/10 text-[#3367A5] flex items-center justify-center group-hover:bg-[#3367A5] group-hover:text-white transition-all duration-300 shadow-sm">
                                <!-- Hugeicons: workflow-square-01 -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path
                                        d="M6 5.5c0-.935 0-1.402.201-1.75a1.5 1.5 0 0 1 .549-.549C7.098 3 7.565 3 8.5 3h3c.935 0 1.402 0 1.75.201a1.5 1.5 0 0 1 .549.549C14 4.098 14 4.565 14 5.5s0 1.402-.201 1.75a1.5 1.5 0 0 1-.549.549C12.902 8 12.435 8 11.5 8h-3c-.935 0-1.402 0-1.75-.201a1.5 1.5 0 0 1-.549-.549C6 6.902 6 6.435 6 5.5Zm0 10c0-.935 0-1.402.201-1.75a1.5 1.5 0 0 1 .549-.549C7.098 13 7.565 13 8.5 13h3c.935 0 1.402 0 1.75.201a1.5 1.5 0 0 1 .549.549c.201.348.201.815.201 1.75s0 1.402-.201 1.75a1.5 1.5 0 0 1-.549.549c-.348.201-.815.201-1.75.201h-3c-.935 0-1.402 0-1.75-.201a1.5 1.5 0 0 1-.549-.549C6 16.902 6 16.435 6 15.5Zm14.84 1.64c.773-.773 1.16-1.16 1.16-1.64s-.387-.867-1.16-1.64l-.2-.2c-.773-.773-1.16-1.16-1.64-1.16s-.867.387-1.64 1.16l-.2.2c-.773.773-1.16 1.16-1.16 1.64s.387.867 1.16 1.64l.2.2c.773.773 1.16 1.16 1.64 1.16s.867-.387 1.64-1.16z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.006 5.5H2.008m0 0V2m0 3.5V12c0 1.104-.151 2.468.888 3.163c.504.337 1.206.337 2.61.337m8.496 0h2m2.998-3v-3c0-1.886 0-2.828-.585-3.414c-.586-.586-1.528-.586-3.413-.586h-1M22 22c-.932 0-1.398 0-1.765-.13c-.49-.175-.88-.508-1.083-.928C19 20.627 19 20.227 19 19.429V19" />
                                </svg>
                            </div>
                            <span data-lang-en="Material Handling" data-lang-id="Penanganan Material"
                                class="text-[11px] font-semibold text-neutral-600 bg-neutral-100 px-3 py-1 rounded-full font-['Questrial',sans-serif]">
                                Material Handling
                            </span>
                        </div>
                        <h3 data-lang-en="Mechanical &amp; Conveyor Integration" data-lang-id="Integrasi Mekanikal &amp; Konveyor"
                            class="text-xl sm:text-2xl font-bold font-['Agrandir',sans-serif] text-neutral-900 group-hover:text-[#3367A5] transition-colors duration-200">
                            Mechanical &amp; Conveyor Integration
                        </h3>
                        <p data-lang-en="Precision anti-slip textured conveyor rollers, wear-resistant mechanical components, and turnkey automated modular conveyor line engineering."
                           data-lang-id="Roller konveyor bertekstur anti-selip presisi, komponen mekanik tahan aus, dan rekayasa jalur konveyor modular otomatis siap pakai."
                            class="text-xs sm:text-sm text-neutral-600 font-['Questrial',sans-serif] leading-relaxed mt-3">
                            Precision anti-slip textured conveyor rollers, wear-resistant mechanical components, and turnkey automated modular conveyor line engineering.
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-neutral-100">
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                            <span data-lang-en="Anti-Slip Rollers" data-lang-id="Roller Anti-Selip"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Anti-Slip
                                Rollers</span>
                            <span data-lang-en="Modular Conveyor" data-lang-id="Konveyor Modular"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Modular
                                Conveyor</span>
                            <span data-lang-en="Turnkey Integrator" data-lang-id="Integrator Siap Pakai"
                                class="text-[11px] font-medium text-neutral-700 bg-neutral-100 px-2.5 py-1 rounded font-['Questrial',sans-serif]">Turnkey
                                Integrator</span>
                        </div>
                        <a href="{{ route('intergrator') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-neutral-900 group-hover:text-[#3367A5] transition-colors font-['Questrial',sans-serif]">
                            <span data-lang-en="Explore Conveyor Integration" data-lang-id="Lihat Integrasi Konveyor">Explore Conveyor Integration</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section: Amplifying Industrial Potential Banner -->
    <section
        class="relative w-full bg-white pt-16 sm:pt-20 lg:pt-24 pb-8 sm:pb-10 border-b border-gray-100 text-center reveal-on-scroll overflow-hidden">
        <!-- Seamless Smoky Dark Gradient / Shadow Transition from Section 3 (Dark) into Section 4 (White) -->
        <div
            class="absolute top-0 left-0 right-0 h-12 sm:h-16 lg:h-20 bg-gradient-to-b from-black via-black/40 to-transparent pointer-events-none z-10">
        </div>

        <div class="container mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
            <h2 data-lang-en="Amplifying Industrial Potential" data-lang-id="Mengoptimalkan Potensi Industri"
                class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-normal font-['Questrial',sans-serif] text-black leading-snug tracking-tight">
                Amplifying Industrial Potential
            </h2>
        </div>
    </section>

    <!-- Section 4: Feature Showcase (White Theme) -->
    <section class="w-full bg-white text-black pt-4 sm:pt-6 pb-16 lg:pb-24">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Video Column: 3D Animated Automation Simulation (VideoSection03.mp4) -->
                <div class="w-full flex justify-center lg:justify-start reveal-on-scroll reveal-stagger-1">
                    <div
                        class="w-full max-w-xl xl:max-w-2xl bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
                        <video autoplay loop muted playsinline preload="auto"
                            class="w-full h-auto aspect-video object-cover rounded-3xl block">
                            <source src="{{ asset('storage/VideoSection03.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>

                <!-- Content Column: SmartICS-Style Characteristics & Architecture Specifications -->
                <div class="w-full max-w-xl xl:max-w-2xl reveal-on-scroll reveal-stagger-2 flex flex-col justify-center">
                    <!-- Segmented Tab Switcher (SmartICS Inspired) -->
                    <div class="w-full mb-3 sm:mb-4">
                        <div class="grid grid-cols-2 p-1 bg-neutral-100 rounded-xl border border-neutral-200/80 font-['Agrandir',sans-serif]">
                            <button type="button" id="tab-btn-characteristics" onclick="switchSpecTab('characteristics')"
                                data-lang-en="Characteristics" data-lang-id="Karakteristik"
                                class="py-2 sm:py-2.5 px-4 text-xs sm:text-sm font-semibold rounded-lg transition-all duration-300 text-center bg-neutral-900 text-white shadow-sm">
                                Characteristics
                            </button>
                            <button type="button" id="tab-btn-architecture" onclick="switchSpecTab('architecture')"
                                data-lang-en="Architecture" data-lang-id="Arsitektur"
                                class="py-2 sm:py-2.5 px-4 text-xs sm:text-sm font-semibold rounded-lg transition-all duration-300 text-center text-neutral-600 hover:text-black">
                                Architecture
                            </button>
                        </div>
                    </div>

                    <!-- Tab 1: Characteristics (Product Performance & Specifications) -->
                    <div id="tab-content-characteristics" class="w-full divide-y divide-gray-100 transition-opacity duration-300">
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Throughput &amp; Speed" data-lang-id="Kecepatan &amp; Kapasitas Siklus"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Throughput &amp; Speed
                            </span>
                            <span data-lang-en="High-speed cycle up to 800–1,200 pcs/min on machine vision inspection &amp; 60+ straps/min on packaging lines" data-lang-id="Siklus berkecepatan tinggi hingga 800–1.200 pcs/menit pada inspeksi vision &amp; 60+ tali/menit pada lini kemasan"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                High-speed cycle up to 800–1,200 pcs/min on machine vision inspection &amp; 60+ straps/min on packaging lines
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Optical Precision" data-lang-id="Presisi Optik"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Optical Precision
                            </span>
                            <span data-lang-en="Sub-micron dimensional tolerance up to &plusmn;0.001 mm with high-resolution matrix CMOS sensors and telecentric optics" data-lang-id="Toleransi dimensi sub-mikron hingga &plusmn;0,001 mm dengan sensor matrix CMOS resolusi tinggi dan optik telesentris"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Sub-micron dimensional tolerance up to &plusmn;0.001 mm with high-resolution matrix CMOS sensors and telecentric optics
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Strapping Force" data-lang-id="Gaya Tarik Strapping"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Strapping Force
                            </span>
                            <span data-lang-en="Heavy-duty tension up to 3,500N–8,500N with rapid friction welding (0.2–3.5s) for PET, PP, and steel strap packaging" data-lang-id="Gaya tarik beban berat hingga 3.500N–8.500N dengan pengelasan gesek cepat (0,2–3,5 detik) untuk kemasan tali PET, PP, dan baja"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Heavy-duty tension up to 3,500N–8,500N with rapid friction welding (0.2–3.5s) for PET, PP, and steel strap packaging
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Coding &amp; Marking" data-lang-id="Pencetakan Kode &amp; Penandaan"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Coding &amp; Marking
                            </span>
                            <span data-lang-en="600 DPI industrial TIJ inkjet &amp; fiber laser marking up to 100 m/min with dynamic QR, DataMatrix, and barcode printing" data-lang-id="TIJ inkjet industri 600 DPI &amp; penandaan laser serat hingga 100 m/menit dengan kode QR dinamis, DataMatrix, dan barcode"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                600 DPI industrial TIJ inkjet &amp; fiber laser marking up to 100 m/min with dynamic QR, DataMatrix, and barcode printing
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Operational Uptime" data-lang-id="Keandalan Waktu Operasi"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Operational Uptime
                            </span>
                            <span data-lang-en="Engineered for 24/7 continuous industrial production with 99.9% logic reliability and instant fail-safe recovery" data-lang-id="Dirancang untuk produksi industri kontinu 24/7 dengan keandalan logika 99,9% dan pemulihan pengaman otomatis"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Engineered for 24/7 continuous industrial production with 99.9% logic reliability and instant fail-safe recovery
                            </span>
                        </div>
                    </div>

                    <!-- Tab 2: Architecture (Control Systems & Engineering Standards) -->
                    <div id="tab-content-architecture" class="w-full divide-y divide-gray-100 hidden transition-opacity duration-300">
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="PLC Platforms" data-lang-id="Platform PLC"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                PLC Platforms
                            </span>
                            <span data-lang-en="Mitsubishi (iQ-R/FX), Omron (NJ/NX/CP), Siemens (S7-1200/1500), and Keyence multi-brand controllers" data-lang-id="Pengendali multi-merek Mitsubishi (iQ-R/FX), Omron (NJ/NX/CP), Siemens (S7-1200/1500), dan Keyence"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Mitsubishi (iQ-R/FX), Omron (NJ/NX/CP), Siemens (S7-1200/1500), and Keyence multi-brand controllers
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Fieldbus &amp; Protocols" data-lang-id="Protokol &amp; Fieldbus"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Fieldbus &amp; Protocols
                            </span>
                            <span data-lang-en="Profinet, EtherNet/IP, Modbus TCP/RTU, OPC UA Server, and discrete 24V PNP/NPN high-speed I/O" data-lang-id="Profinet, EtherNet/IP, Modbus TCP/RTU, Server OPC UA, dan I/O diskrit kecepatan tinggi 24V PNP/NPN"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Profinet, EtherNet/IP, Modbus TCP/RTU, OPC UA Server, and discrete 24V PNP/NPN high-speed I/O
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Automated Rejection" data-lang-id="Pemisahan Reject Otomatis"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Automated Rejection
                            </span>
                            <span data-lang-en="Pneumatic high-speed air-jet ejectors, pusher cylinders, and servo motorized sorting flapper gates" data-lang-id="Ejektor semburan angin pneumatik kecepatan tinggi, silinder pendorong, dan gerbang pemilah servo bermotor"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Pneumatic high-speed air-jet ejectors, pusher cylinders, and servo motorized sorting flapper gates
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Telemetry &amp; SCADA" data-lang-id="Telemetri &amp; SCADA"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Telemetry &amp; SCADA
                            </span>
                            <span data-lang-en="Sub-second telemetry (&lt;100ms refresh latency) with real-time OEE tracking and central industrial touch HMI" data-lang-id="Telemetri sub-detik (latensi &lt;100ms) dengan pelacakan OEE real-time dan panel sentuh HMI industri terpusat"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Sub-second telemetry (&lt;100ms refresh latency) with real-time OEE tracking and central industrial touch HMI
                            </span>
                        </div>
                        <div class="py-2.5 sm:py-3 flex items-start gap-4">
                            <span data-lang-en="Safety Architecture" data-lang-id="Arsitektur Keselamatan"
                                class="w-[36%] text-xs sm:text-[13px] font-bold text-neutral-900 font-['Agrandir',sans-serif] tracking-tight shrink-0">
                                Safety Architecture
                            </span>
                            <span data-lang-en="Category 4 / PLe fail-safe interlocks, optoelectronic safety light curtains, and emergency halt circuits" data-lang-id="Interlock pengaman Category 4 / PLe, tirai cahaya keselamatan optoelektronik, dan sirkuit penghenti darurat"
                                class="w-[64%] text-xs sm:text-[13px] text-neutral-600 font-['Questrial',sans-serif] leading-relaxed">
                                Category 4 / PLe fail-safe interlocks, optoelectronic safety light curtains, and emergency halt circuits
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Floating Button 1 -->
    @include('components.button.button')

    <!-- JavaScript for Menu Toggle (Safe Guard) -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });
        }
        if (menuClose && mobileMenu) {
            menuClose.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }
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
                        observer.unobserve(entry.target);
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

        // SmartICS Specifications Tab Switcher
        function switchSpecTab(tab) {
            const btnChar = document.getElementById('tab-btn-characteristics');
            const btnArch = document.getElementById('tab-btn-architecture');
            const contentChar = document.getElementById('tab-content-characteristics');
            const contentArch = document.getElementById('tab-content-architecture');

            if (!btnChar || !btnArch || !contentChar || !contentArch) return;

            const activeBtnClasses = 'py-2 sm:py-2.5 px-4 text-xs sm:text-sm font-semibold rounded-lg transition-all duration-300 text-center bg-neutral-900 text-white shadow-sm';
            const inactiveBtnClasses = 'py-2 sm:py-2.5 px-4 text-xs sm:text-sm font-semibold rounded-lg transition-all duration-300 text-center text-neutral-600 hover:text-black';

            if (tab === 'characteristics') {
                btnChar.className = activeBtnClasses;
                btnArch.className = inactiveBtnClasses;
                contentChar.classList.remove('hidden');
                contentArch.classList.add('hidden');
            } else {
                btnArch.className = activeBtnClasses;
                btnChar.className = inactiveBtnClasses;
                contentArch.classList.remove('hidden');
                contentChar.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
