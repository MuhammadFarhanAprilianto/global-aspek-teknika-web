@props([
    'eyebrowEn' => 'Start Your Automation Project',
    'eyebrowId' => 'Mulai Proyek Otomasi Anda',
    'titleEn' => 'Have a Project Challenge in Your Production Facility?',
    'titleId' => null,
    'descriptionEn' => 'Discuss your throughput requirements, cycle times, and machine integration specs with our engineering team.',
    'descriptionId' => null,
    'primaryLabelEn' => 'Discuss Your Project',
    'primaryLabelId' => null,
    'primaryHref' => null,
    'waMessage' => 'Halo Tim Marketing PT Global Aspect Technology, saya ingin berdiskusi mengenai proyek otomasi industri di fasilitas kami.',
])

@php
    $ctaMarketingWa = \App\Models\SiteSetting::publicWaNumber();
    $ctaPrimaryHref = $primaryHref ?: route('contact');
    $ctaWaHref = 'https://wa.me/' . $ctaMarketingWa . '?text=' . rawurlencode($waMessage);
@endphp

@once
<style id="gat-cta-banner-styles">
    /* Signature Left-to-Right Liquid Wipe Hover (Matches Navbar "Get A Quote" Button — Immune to Bootstrap !important) */
    .gat-cta-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 0 !important;
        outline: none !important;
        border-radius: 9999px;
        text-decoration: none !important;
        isolation: isolate;
        cursor: pointer;
        transition: color 0.45s cubic-bezier(0.25, 1, 0.5, 1),
                    box-shadow 0.55s cubic-bezier(0.25, 1, 0.5, 1),
                    transform 0.2s ease;
    }

    .gat-cta-btn:active {
        transform: scale(0.96);
    }

    .gat-cta-btn .gat-cta-wipe {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        transform: translateX(-105%);
        transition: transform 0.75s cubic-bezier(0.25, 1, 0.5, 1);
        pointer-events: none;
        z-index: 0;
    }

    .gat-cta-btn:hover .gat-cta-wipe,
    .gat-cta-btn:focus-visible .gat-cta-wipe {
        transform: translateX(0);
    }

    .gat-cta-btn .gat-cta-label {
        position: relative;
        z-index: 10;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.4s ease;
    }

    .gat-cta-btn .gat-cta-arrow {
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .gat-cta-btn:hover .gat-cta-arrow,
    .gat-cta-btn:focus-visible .gat-cta-arrow {
        transform: translateX(5px);
    }

    /* Primary Button: Solid White (No Border/Outline) -> Glides Left-to-Right into Obsidian Dark (#121316) */
    .gat-cta-btn--primary {
        background-color: #ffffff;
        color: #3367A5;
        box-shadow: 0 10px 26px rgba(9, 24, 56, 0.28);
    }

    .gat-cta-btn--primary .gat-cta-wipe {
        background-color: #000000;
    }

    .gat-cta-btn--primary:hover,
    .gat-cta-btn--primary:focus-visible {
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    /* Secondary Button: Solid Translucent Fill (No Border/Outline) -> Glides Left-to-Right into Solid White */
    .gat-cta-btn--secondary {
        background-color: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        backdrop-filter: blur(6px);
    }

    .gat-cta-btn--secondary .gat-cta-wipe {
        background-color: #ffffff;
    }

    .gat-cta-btn--secondary:hover,
    .gat-cta-btn--secondary:focus-visible {
        color: #3367A5;
        box-shadow: 0 10px 26px rgba(9, 24, 56, 0.28);
    }
</style>
@endonce

<!-- FLOATING CORPORATE ROYAL BLUE CTA CARD -->
<section class="w-full bg-white py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 reveal-on-scroll">
        <div class="relative rounded-[32px] overflow-hidden px-7 py-12 sm:px-12 sm:py-16 lg:px-16 flex flex-col lg:flex-row lg:items-center justify-between gap-8 text-white shadow-[0_24px_60px_rgba(36,78,129,0.28)]"
             style="background: linear-gradient(135deg, #0D2554 0%, #244E81 52%, #3367A5 100%);">
            <div class="pointer-events-none absolute -top-24 -right-24 w-72 h-72 rounded-full bg-[#7FB0EA]/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 left-1/3 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative z-10 max-w-2xl space-y-3">
                @if (!empty($eyebrowEn))
                    <span class="inline-block text-[11px] font-bold uppercase tracking-widest text-[#7FB0EA] font-['Agrandir',sans-serif]"
                          data-lang-en="{{ $eyebrowEn }}"
                          data-lang-id="{{ $eyebrowId }}">
                        {{ $eyebrowEn }}
                    </span>
                @endif
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-['Agrandir',sans-serif] tracking-tight leading-tight text-white"
                    @if ($titleId)
                        data-lang-en="{{ $titleEn }}"
                        data-lang-id="{{ $titleId }}"
                    @endif>
                    {{ $titleEn }}
                </h2>
                <p class="text-white/90 text-sm sm:text-base font-['Questrial',sans-serif] leading-relaxed"
                   @if ($descriptionId)
                       data-lang-en="{{ $descriptionEn }}"
                       data-lang-id="{{ $descriptionId }}"
                   @endif>
                    {{ $descriptionEn }}
                </p>
            </div>

            <div class="relative z-10 flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ $ctaPrimaryHref }}"
                   class="gat-cta-btn gat-cta-btn--primary px-7 py-3.5 font-bold text-xs sm:text-sm font-['Agrandir',sans-serif] whitespace-nowrap">
                    <span class="gat-cta-wipe" aria-hidden="true"></span>
                    <span class="gat-cta-label">
                        <span @if ($primaryLabelId) data-lang-en="{{ $primaryLabelEn }}" data-lang-id="{{ $primaryLabelId }}" @endif>{{ $primaryLabelEn }}</span>
                        <svg class="gat-cta-arrow w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
                <a href="{{ $ctaWaHref }}"
                   target="_blank" rel="noopener noreferrer"
                   class="gat-cta-btn gat-cta-btn--secondary px-6 py-3.5 font-bold text-xs sm:text-sm font-['Agrandir',sans-serif] whitespace-nowrap">
                    <span class="gat-cta-wipe" aria-hidden="true"></span>
                    <span class="gat-cta-label">
                        <span data-lang-en="WhatsApp Marketing" data-lang-id="WhatsApp Marketing">WhatsApp Marketing</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
