<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - GAT</title>

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

<body class="overflow-x-hidden w-full max-w-full font-['Questrial',sans-serif]">
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- Hero Section (Company Profile Video Background - Expanded Full-Height) -->
    <section
        class="relative w-full min-h-[75vh] sm:min-h-[85vh] lg:min-h-[92vh] xl:min-h-[96vh] bg-black text-white text-center py-44 sm:py-56 lg:py-64 xl:py-72 overflow-hidden flex items-center justify-center">
        <!-- Background Video Centered Top-Bottom-Left-Right with WebM Primary and MP4 Fallback -->
        <div class="absolute inset-0 z-0 overflow-hidden w-full h-full pointer-events-none flex items-center justify-center">
            <video autoplay loop muted playsinline
                class="w-full h-full object-cover object-center opacity-70"
                style="object-position: 50% 50%; object-fit: cover;">
                <source src="{{ asset('storage/Company Profile.webm') }}?v={{ time() }}" type="video/webm">
                <source src="{{ asset('storage/Company Profile.mp4') }}?v={{ time() }}" type="video/mp4">
            </video>
            <!-- Overlay to guarantee text contrast & cinematic depth -->
            <div class="absolute inset-0 bg-black/35 backdrop-blur-[0.5px]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50"></div>
        </div>

        <div class="relative z-10 px-6 max-w-4xl mx-auto flex flex-col items-center justify-center text-center reveal-on-scroll">
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-[66px] xl:text-[72px] font-bold uppercase font-['Questrial',sans-serif] tracking-wider text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)] leading-tight">
                Company Profile
            </h1>
            <div class="w-24 sm:w-28 h-1.5 bg-red-600 mx-auto mt-2 rounded-full shadow-[0_0_20px_rgba(220,38,38,1)]">
            </div>
        </div>
    </section>

    <!-- About Company Section -->
    <section class="bg-[#000000] text-gray-300 py-16 sm:py-20 lg:py-28">
        <div class="container mx-auto text-center px-6 sm:px-10 lg:px-24 reveal-on-scroll">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-10 sm:mb-14 lg:mb-20 font-['Agrandir']">ABOUT COMPANY</h2>
            <p class="text-base sm:text-lg lg:text-xl leading-relaxed font-['Questrial'] text-justify mb-5">
                PT Global Aspect Technology, established in 2017, is a company that focuses on providing integrated
                systems for various industries, both manufacturing and non-industrial, from small to large scale. Since
                our inception, we have been committed to providing the best and most innovative solutions to meet the
                needs of system automation, software development, monitoring, and control of production processes.
            </p>
            <p class="text-base sm:text-lg lg:text-xl leading-relaxed font-['Questrial'] text-justify mb-5">
                We understand the importance of efficiency, productivity, and quality in every business process.
                Therefore, we put forward technology that is not only advanced, but also customizable to each client's
                specific needs. With extensive experience in various industrial sectors, we continue to innovate to
                provide timely, reliable, and cost-effective solutions.
            </p>
            <p class="text-base sm:text-lg lg:text-xl leading-relaxed font-['Questrial'] text-justify mb-5">
                With a team of experienced professionals, PT Global Aspect Technology is ready to be your reliable
                partner in facing the challenges of an ever-evolving industry. We are committed to continuously innovate
                and adapt to market needs, ensuring every solution we offer has added value to your business.
            </p>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="text-center bg-[#FFFFFF] text-[#000000] py-16">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold font-['Agrandir'] text-black">VISION &amp; MISSION</h2>
                <div class="w-16 sm:w-20 h-[2.5px] bg-black mx-auto mt-3 mb-6 rounded-full"></div>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-start gap-8 lg:gap-16 mt-10">
                <!-- Vision -->
                <div class="w-full md:w-1/2 text-center reveal-on-scroll reveal-stagger-1">
                    <h3
                        class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-black tracking-wide uppercase">
                        VISION</h3>
                    <p class="text-base sm:text-lg leading-relaxed font-['Questrial'] text-gray-700 mt-4">
                        To become a trusted industrial system integration company in Indonesia and provide the best
                        guarantee of every solution provided for consumer needs.
                    </p>
                </div>

                <!-- Mission -->
                <div class="w-full md:w-1/2 text-center reveal-on-scroll reveal-stagger-2">
                    <h3
                        class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir'] text-black tracking-wide uppercase">
                        MISSION</h3>
                    <p class="text-base sm:text-lg leading-relaxed font-['Questrial'] text-gray-700 mt-4">
                        Competence development of each of our employees, to always be able to provide services to
                        consumer needs and provide the best after-sales support services to consumers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="text-center bg-[#FFFFFF] text-[#000000] py-16">
        <div class="container mx-auto px-6 sm:px-8 lg:px-16">
            <div class="reveal-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold font-['Agrandir'] text-black">WHY CHOOSE US</h2>
            </div>

            <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
                <!-- Card 1 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-1">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/Scada Diagram.webp') }}" alt="SCADA Diagram System"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-2">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/about4.jpg') }}" alt="Edit Existing Program"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-3">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/OilGenerated.webp') }}" alt="Oil Generated System"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-4">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/Paperless.webp') }}" alt="Paperless System"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>

                <!-- Card 5 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-5">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/Spectrum.webp') }}" alt="Spectrum System"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>

                <!-- Card 6 -->
                <div
                    class="group w-full sm:w-1/3 md:w-1/4 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col items-center cursor-pointer reveal-on-scroll reveal-stagger-6">
                    <div class="w-full h-64 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/Fiberoptic.webp') }}" alt="Fiber Optic System"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 ease-out">
                    </div>
                </div>
            </div>

            <!-- List Content Below the Images -->
            <div class="mt-8 text-center reveal-on-scroll">
                <ul class="list-disc pl-6 sm:pl-8 space-y-3 sm:space-y-4 inline-block text-left font-['Questrial'] text-base sm:text-lg lg:text-xl">
                    <li>Maintain excellent service to foster lasting partnerships with our customers and clients.</li>
                    <li>Believe in treating our customers with kindness and trust.</li>
                    <li>Continue to grow by embracing creativity and innovation.</li>
                    <li>Constantly enhance the skills of our dedicated team to drive service development.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
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