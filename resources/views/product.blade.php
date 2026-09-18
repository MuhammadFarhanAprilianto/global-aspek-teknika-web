<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - GAT</title>

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
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600&family=Questrial&family=Syne:wght@400..800&family=Viga&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
        .font-agrandir {
            font-family: 'Agrandir', sans-serif !important;
        }
        .font-questrial {
            font-family: 'Questrial', sans-serif !important;
        }

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
        .reveal-stagger-5 { transition-delay: 0.40s; }
        .reveal-stagger-6 { transition-delay: 0.48s; }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-questrial font-['Questrial',sans-serif]">
    <!-- Navbar -->

    @include('components.navbar.header')

    <!-- Hero Section (Product Video Background - Expanded Full-Height like About Us, Title Bottom-Aligned) -->
    <section
        class="relative w-full min-h-[75vh] sm:min-h-[85vh] lg:min-h-[92vh] xl:min-h-[96vh] bg-black text-white text-center pt-44 sm:pt-56 pb-12 sm:pb-16 lg:pb-20 overflow-hidden flex flex-col justify-end items-center">
        <!-- Background Video Centered Top-Bottom-Left-Right with WebM Primary and MP4 Fallback -->
        <div
            class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none flex items-center justify-center">
            <video autoplay loop muted playsinline preload="auto" class="w-full h-full object-cover object-center opacity-70"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/ProductCompany.mp4') }}" type="video/mp4">
                <source src="{{ asset('storage/ProductCompany.webm') }}" type="video/webm">
            </video>
            <!-- Overlay to guarantee text contrast & cinematic depth -->
            <div class="absolute inset-0 bg-black/35 backdrop-blur-[0.5px]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-[66px] xl:text-[72px] font-extrabold uppercase font-agrandir font-['Agrandir',sans-serif] tracking-wider text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                Product
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-red-600 mx-auto mt-2 rounded-full shadow-[0_0_20px_rgba(220,38,38,1)]">
            </div>
        </div>
    </section>

    <!-- Featured Case Studies / Product List Section (LabsStdio Style) -->
    <section class="w-full bg-[#000000] py-16 sm:py-20 lg:py-24 font-['Questrial',sans-serif]">
        <div class="container mx-auto px-6 sm:px-10 lg:px-16">

            <!-- 3x3 Responsive LabsStdio Grid (3 Columns Per Row) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7 xl:gap-8">

                <!-- Card 1: Sistem Pengukuran Dimensi -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-1">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/sistem_pengukuran_dimensi.webp') }}" alt="Sistem Pengukuran Dimensi"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <!-- Badges Row -->
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                ±0.001 mm Akurasi
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Sistem Pengukuran Dimensi
                            </span>
                        </div>

                        <!-- Title -->
                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Sistem Pengukuran Dimensi Presisi Tinggi &amp; Auto-Inspection
                        </h3>

                        <!-- Description -->
                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Solusi inspeksi dan pengukuran dimensi optik multi-sudut berkecepatan tinggi dengan toleransi mikron untuk kendali mutu otomatis pada lini manufaktur.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Kontrol & Otomasi PLC -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-2">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/kontrol.webp') }}" alt="Sistem Kontrol dan Panel Otomasi"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-agrandir font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                100% Real-Time
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-questrial font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Sistem Kontrol &amp; Otomasi
                            </span>
                        </div>

                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Integrasi Kontrol Industri &amp; Panel Otomasi Terpadu
                        </h3>

                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Arsitektur kontrol berbasis PLC, SCADA, dan antarmuka HMI pintar untuk memonitor, mengendalikan, dan mengoptimalkan siklus kerja mesin secara terpusat.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Kamera Barcode & Machine Vision -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-3">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/kamera_barcode.webp') }}" alt="Kamera Barcode Machine Vision"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-agrandir font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                1200 PPM Scan
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-questrial font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Kamera Barcode &amp; Vision
                            </span>
                        </div>

                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Kamera Pembaca Barcode 1D/2D Berkecepatan Tinggi
                        </h3>

                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Sistem machine vision pembaca kode QR, DataMatrix, dan barcode pada konveyor bergerak cepat dengan verifikasi data instan dan integrasi database.
                        </p>
                    </div>
                </div>

                <!-- Card 4: Roller Permukaan Kasar -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-4">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/roller_permukaan_kasar.webp') }}" alt="Roller Konveyor Permukaan Kasar"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-agrandir font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                High Durability
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-questrial font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Roller Permukaan Kasar
                            </span>
                        </div>

                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Roller Konveyor Permukaan Kasar Anti-Selip
                        </h3>

                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Komponen roller konveyor bertekstur kasar dengan daya cengkeram optimal untuk mencegah selip material pada jalur produksi berkecepatan tinggi.
                        </p>
                    </div>
                </div>

                <!-- Card 5: Sensor Aliran -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-5">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/sensor_aliran.webp') }}" alt="Sensor Aliran Industri"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-agrandir font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                ±0.5% Akurasi
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-questrial font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Sensor Aliran Fluida
                            </span>
                        </div>

                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Sensor Aliran Cairan &amp; Gas Presisi Tinggi
                        </h3>

                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Solusi pemantauan laju dan volume aliran fluida secara akurat dengan respons real-time untuk efisiensi sistem pemrosesan industri.
                        </p>
                    </div>
                </div>

                <!-- Card 6: Thrubeam -->
                <div
                    class="group relative rounded-[28px] sm:rounded-[32px] overflow-hidden bg-transparent transition-all duration-300 min-h-[440px] sm:min-h-[480px] flex flex-col justify-end p-6 sm:p-7 lg:p-8 text-left reveal-on-scroll reveal-stagger-6">
                    <!-- Product Image (No Zoom) -->
                    <div class="absolute inset-0 z-0 overflow-hidden flex items-center justify-center p-6 sm:p-8 pb-32 sm:pb-36">
                        <img src="{{ asset('storage/thrubeam.webp') }}" alt="Sensor Optik Thrubeam"
                            class="w-full h-full object-contain object-center opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Card Content -->
                    <div class="relative z-20">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-2.5 mb-3 sm:mb-3.5">
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-bold font-agrandir font-['Agrandir',sans-serif] bg-red-600 text-white tracking-wide shadow-sm">
                                0.1 ms Respons
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-[11px] sm:text-xs font-medium font-questrial font-['Questrial',sans-serif] bg-white/20 hover:bg-white/30 backdrop-blur-md text-white tracking-wide transition-colors">
                                Sensor Fotoelektrik Thrubeam
                            </span>
                        </div>

                        <h3
                            class="text-lg sm:text-xl lg:text-[22px] font-bold font-agrandir font-['Agrandir',sans-serif] text-white leading-tight mb-2 sm:mb-2.5 group-hover:text-red-400 transition-colors">
                            Sensor Optik Thrubeam Jarak Jauh Berkecepatan Tinggi
                        </h3>

                        <p
                            class="text-xs sm:text-sm font-normal font-questrial font-['Questrial',sans-serif] text-gray-300 leading-relaxed text-justify line-clamp-2 sm:line-clamp-3">
                            Sensor pendeteksi objek berbasis transmisi sinar optik terpisah dengan jangkauan luas dan sensitivitas tinggi untuk otomasi konveyor presisi.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Floating Action Button -->
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const v = document.querySelector('video');
            if (v) {
                v.muted = true;
                v.playsInline = true;
                const playPromise = v.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log('Autoplay:', error);
                    });
                }
            }
        });
    </script>
</body>

</html>