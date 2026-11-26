<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $solution->name }} - GAT Industrial Solutions</title>
    @include('components.seo-meta', [
        'seoTitle' => $solution->name . ' — PT Global Aspect Technology',
        'seoDescription' => $solution->short_description ?: \Illuminate\Support\Str::limit(strip_tags($solution->description), 155),
    ])

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

@php
    $content = $solution->resolvedPageContent();
    $stats = $content['stats'] ?? [];
    $deliverables = $content['deliverables'] ?? [];
    $processSteps = $content['process_steps'] ?? [];
    $faqs = $content['faqs'] ?? [];
@endphp

<body class="overflow-x-hidden w-full max-w-full bg-white text-neutral-900 selection:bg-[#3367A5] selection:text-white">

    <!-- Navbar -->
    @include('components.navbar.header')

    <main class="w-full">

        <!-- ========================================================================= -->
        <!-- 1. HERO SECTION                                                           -->
        <!-- ========================================================================= -->
        <section class="w-full bg-white pt-32 sm:pt-40 pb-16 sm:pb-20">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">

                <!-- Hero Headline & Subtitle -->
                <div class="space-y-6 max-w-4xl reveal-on-scroll">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-agrandir tracking-tight text-black leading-tight">
                        {{ $solution->name }}
                    </h1>
                    <p class="text-xl sm:text-2xl text-[#3367A5] font-bold font-agrandir tracking-tight">
                        {{ $content['hero_subtitle'] }}
                    </p>
                    <p class="text-base sm:text-lg text-neutral-600 font-questrial leading-relaxed max-w-3xl">
                        {{ $solution->description }}
                    </p>
                </div>

                @if (!empty($stats))
                    <!-- Stats Quick Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-{{ min(3, max(1, count($stats))) }} gap-6 pt-4">
                        @foreach ($stats as $sIdx => $stat)
                            <div class="rounded-2xl border border-neutral-200/80 bg-neutral-50/70 p-6 space-y-1 reveal-on-scroll reveal-stagger-{{ ($sIdx % 4) + 1 }}">
                                <div class="text-3xl sm:text-4xl font-bold font-agrandir {{ $sIdx % 2 === 1 ? 'text-[#3367A5]' : 'text-black' }}">
                                    {{ $stat['value'] }}
                                </div>
                                <div class="text-xs sm:text-sm text-neutral-500 font-questrial">
                                    {{ $stat['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>

        @if (!empty($deliverables))
            <!-- ========================================================================= -->
            <!-- 2. CORE DELIVERABLES / CAPABILITIES CARDS                                 -->
            <!-- ========================================================================= -->
            <section class="w-full bg-black py-16 sm:py-24 text-white">
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
                        <p class="text-sm sm:text-base text-neutral-400 font-questrial">
                            {{ $content['deliverables_subtitle'] }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-{{ min(3, max(1, count($deliverables))) }} gap-6 sm:gap-8">
                        @foreach ($deliverables as $dIdx => $del)
                            <div class="bg-white rounded-3xl p-7 sm:p-8 border border-neutral-200/80 shadow-lg space-y-6 flex flex-col justify-between hover:border-[#3367A5] hover:shadow-2xl transition-all duration-300 group reveal-on-scroll reveal-stagger-{{ ($dIdx % 4) + 1 }}">
                                <div class="space-y-4">
                                    <div class="w-12 h-12 rounded-2xl bg-neutral-900 border border-neutral-800 flex items-center justify-center text-white shadow-md group-hover:bg-[#3367A5] transition-colors">
                                        @if ($dIdx % 3 === 0)
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                                <rect x="9" y="9" width="6" height="6"></rect>
                                                <path stroke-linecap="round" d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>
                                            </svg>
                                        @elseif ($dIdx % 3 === 1)
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-neutral-900 font-agrandir group-hover:text-[#3367A5] transition-colors">
                                        {{ $del['title'] }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed">
                                        {{ $del['description'] }}
                                    </p>

                                    @if (!empty($del['highlights']))
                                        <div class="pt-3 space-y-2">
                                            <div class="text-xs font-bold text-neutral-900 uppercase font-agrandir"
                                                data-lang-en="Key Highlights"
                                                data-lang-id="Sorotan Utama">
                                                Key Highlights
                                            </div>
                                            <ul class="space-y-1.5 text-xs text-neutral-600 font-questrial">
                                                @foreach ($del['highlights'] as $hl)
                                                    <li class="flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3367A5] shrink-0"></span>
                                                        <span>{{ $hl }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        @if (!empty($processSteps))
            <!-- ========================================================================= -->
            <!-- 3. STEP-BY-STEP PROCESS TIMELINE                                          -->
            <!-- ========================================================================= -->
            <section class="w-full bg-white py-16 sm:py-24">
                <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 space-y-12">

                    <div class="text-center space-y-3 max-w-2xl mx-auto reveal-on-scroll">
                        <span class="inline-block text-xs sm:text-sm font-bold uppercase tracking-widest text-[#3367A5] font-agrandir"
                            data-lang-en="Structured Methodology"
                            data-lang-id="Metodologi Terstruktur">
                            Structured Methodology
                        </span>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black font-agrandir tracking-tight"
                            data-lang-en="Our Process"
                            data-lang-id="Tahapan Proses Kami">
                            Our {{ count($processSteps) }}-Phase Process
                        </h2>
                        <p class="text-sm sm:text-base text-neutral-600 font-questrial">
                            {{ $content['process_subtitle'] }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ min(4, max(1, count($processSteps))) }} gap-6">
                        @foreach ($processSteps as $pIdx => $step)
                            <div class="rounded-3xl p-6 sm:p-7 border border-neutral-200 bg-neutral-50/50 space-y-4 hover:bg-white hover:border-[#3367A5] hover:shadow-md transition-all reveal-on-scroll reveal-stagger-{{ ($pIdx % 4) + 1 }}">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold font-agrandir text-[#3367A5]">{{ str_pad((string) ($pIdx + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-neutral-200/80 text-neutral-700">
                                        Phase {{ $pIdx + 1 }}
                                    </span>
                                </div>
                                <h4 class="text-lg font-bold font-agrandir text-black">
                                    {{ $step['title'] }}
                                </h4>
                                <p class="text-xs text-neutral-600 font-questrial leading-relaxed">
                                    {{ $step['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        @if (!empty($faqs))
            <!-- ========================================================================= -->
            <!-- 4. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)                             -->
            <!-- ========================================================================= -->
            <section class="w-full bg-white py-16 sm:py-24">
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
                        @foreach ($faqs as $fIdx => $faq)
                            <div class="rounded-2xl border border-neutral-200 bg-white overflow-hidden transition-all shadow-sm reveal-on-scroll reveal-stagger-{{ ($fIdx % 4) + 1 }}">
                                <button type="button" class="faq-toggle w-full flex items-center justify-between p-5 sm:p-6 text-left font-agrandir font-bold text-base sm:text-lg text-black hover:bg-neutral-50/60 transition-colors">
                                    <span>{{ $faq['question'] }}</span>
                                    <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-neutral-100 text-xs font-bold transition-transform duration-300 shrink-0 ml-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </span>
                                </button>
                                <div class="faq-content hidden px-5 sm:px-6 pb-6 text-xs sm:text-sm text-neutral-600 font-questrial leading-relaxed border-t border-neutral-100 pt-4">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        <!-- ========================================================================= -->
        <!-- 5. CONSULTATION / COLLABORATE CTA BANNER (Floating Royal Blue Card)       -->
        <!-- ========================================================================= -->
        <x-cta-banner
            eyebrow-en="Let's Collaborate"
            eyebrow-id="Mari Berkolaborasi"
            :title-en="$content['cta_title']"
            :description-en="$content['cta_description']"
            :primary-label-en="$content['cta_button_text']"
            :wa-message="'Halo Tim Marketing PT Global Aspect Technology, saya tertarik dengan solusi ' . $solution->name . ' dan ingin berkonsultasi lebih lanjut.'"
        />

    </main>

    <!-- Footer -->
    @include('components.footer.footer')

    <!-- Floating Contact Button -->
    @include('components.button.button')

    <!-- FAQ Accordion Script -->
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

        function initScrollReveal() {
            const elements = document.querySelectorAll('.reveal-on-scroll');
            if (!elements.length) return;

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting || entry.intersectionRatio > 0) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.01, rootMargin: '100px 0px 50px 0px' });

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
    </script>
</body>

</html>
