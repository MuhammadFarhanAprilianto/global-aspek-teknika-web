<style id="gat-fab-styles">
    /* Immune to Bootstrap 5 !important utility overrides (.opacity-0, .bg-white, .invisible) */
    #gat-fab-menu {
        position: absolute;
        right: 100%;
        top: 50%;
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        align-items: center !important;
        justify-content: flex-end !important;
        gap: 10px;
        width: max-content;
        padding-right: 12px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: translateY(-50%) translateX(14px) scale(0.94);
        transition: opacity 0.28s cubic-bezier(0.34, 1.56, 0.64, 1),
                    transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1),
                    visibility 0.28s ease;
    }

    @media (min-width: 640px) {
        #gat-fab-menu {
            gap: 12px;
        }
    }

    #gat-fab-container:hover #gat-fab-menu,
    #gat-fab-menu.is-open {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
        transform: translateY(-50%) translateX(0) scale(1) !important;
    }

    #gat-fab-container:hover #gat-fab-icon,
    #gat-fab-icon.is-open {
        transform: rotate(45deg);
    }

    .gat-fab-item {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-decoration: none;
        background: transparent;
        border: 0;
        padding: 0;
        cursor: pointer;
    }

    .gat-fab-circle {
        width: 44px;
        height: 44px;
        border-radius: 9999px;
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.22s ease,
                    color 0.22s ease,
                    border-color 0.22s ease,
                    box-shadow 0.22s ease,
                    transform 0.22s ease;
    }

    @media (min-width: 640px) {
        .gat-fab-circle {
            width: 48px;
            height: 48px;
        }
    }

    .gat-fab-item:hover .gat-fab-circle,
    .gat-fab-item:focus-visible .gat-fab-circle {
        transform: translateY(-2px);
    }

    /* Brand-accurate hover states for each icon */
    .gat-fab-circle--gmail {
        background-color: #ffffff;
    }
    .gat-fab-item:hover .gat-fab-circle--gmail,
    .gat-fab-item:focus-visible .gat-fab-circle--gmail {
        background-color: #FEF2F2;
        border-color: #EA4335;
        box-shadow: 0 10px 24px rgba(234, 67, 53, 0.28);
    }

    .gat-fab-circle--instagram {
        color: #E1306C;
    }
    .gat-fab-item:hover .gat-fab-circle--instagram,
    .gat-fab-item:focus-visible .gat-fab-circle--instagram {
        background-color: #E1306C;
        border-color: #E1306C;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(225, 48, 108, 0.35);
    }

    .gat-fab-circle--youtube {
        color: #FF0000;
    }
    .gat-fab-item:hover .gat-fab-circle--youtube,
    .gat-fab-item:focus-visible .gat-fab-circle--youtube {
        background-color: #FF0000;
        border-color: #FF0000;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(255, 0, 0, 0.32);
    }

    .gat-fab-circle--facebook {
        color: #1877F2;
    }
    .gat-fab-item:hover .gat-fab-circle--facebook,
    .gat-fab-item:focus-visible .gat-fab-circle--facebook {
        background-color: #1877F2;
        border-color: #1877F2;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(24, 119, 242, 0.35);
    }

    .gat-fab-circle--tiktok {
        color: #111827;
    }
    .gat-fab-item:hover .gat-fab-circle--tiktok,
    .gat-fab-item:focus-visible .gat-fab-circle--tiktok {
        background-color: #111827;
        border-color: #111827;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(17, 24, 39, 0.35);
    }

    .gat-fab-circle--linkedin {
        color: #0A66C2;
    }
    .gat-fab-item:hover .gat-fab-circle--linkedin,
    .gat-fab-item:focus-visible .gat-fab-circle--linkedin {
        background-color: #0A66C2;
        border-color: #0A66C2;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(10, 102, 194, 0.35);
    }

    .gat-fab-circle--whatsapp {
        color: #25D366;
    }
    .gat-fab-item:hover .gat-fab-circle--whatsapp,
    .gat-fab-item:focus-visible .gat-fab-circle--whatsapp {
        background-color: #25D366;
        border-color: #25D366;
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(37, 211, 102, 0.35);
    }

    /* Hover tooltip above each icon (immune to Bootstrap .opacity-0 !important) */
    .gat-fab-tooltip {
        position: absolute;
        bottom: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(6px);
        padding: 5px 12px;
        font-size: 12px;
        line-height: 1.2;
        font-weight: 500;
        color: #ffffff;
        background-color: #111215;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 9999px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.32);
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        z-index: 60;
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    .gat-fab-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px 5px 0 5px;
        border-style: solid;
        border-color: #111215 transparent transparent transparent;
    }

    .gat-fab-item:hover .gat-fab-tooltip,
    .gat-fab-item:focus-visible .gat-fab-tooltip {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateX(-50%) translateY(0) !important;
    }

    /* Language toggle tooltip (left side, also immune to Bootstrap .opacity-0 !important) */
    .gat-lang-tooltip {
        position: absolute;
        right: calc(100% + 14px);
        top: 50%;
        transform: translateY(-50%) translateX(6px);
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        color: #ffffff;
        background-color: #111215;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 9999px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        z-index: 60;
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    #gat-lang-toggle:hover .gat-lang-tooltip,
    #gat-lang-toggle:focus-visible .gat-lang-tooltip {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(-50%) translateX(0) !important;
    }
</style>

<!-- Scroll to Top Floating Pill Button (Left Side) -->
<button id="gat-scroll-top" type="button" aria-label="Scroll to top" onclick="gatScrollToTop()"
    class="fixed bottom-6 left-6 sm:bottom-8 sm:left-8 z-50 flex items-center gap-2 px-4 py-3 rounded-full bg-white/95 hover:bg-white text-gray-900 border border-gray-200/90 shadow-[0_8px_25px_rgba(0,0,0,0.12)] backdrop-blur-md transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] opacity-0 translate-y-6 pointer-events-none hover:shadow-[0_12px_30px_rgba(51,103,165,0.25)] hover:border-[#3367A5]/50 hover:text-[#3367A5] active:scale-95 group/top font-['Questrial',sans-serif] text-sm font-medium cursor-pointer">
    <svg class="w-4 h-4 transition-transform duration-300 group-hover/top:-translate-y-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
    <span data-lang-en="Top" data-lang-id="Atas">Top</span>
</button>

<!-- LANGUAGE TOGGLE FLOATING BUTTON (Independent floating button, positioned directly above FAB button) -->
<button id="gat-lang-toggle" type="button" aria-label="Change Language Mode" onclick="gatToggleLanguage()"
    class="fixed bottom-[88px] right-6 sm:bottom-[104px] sm:right-8 z-50 w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white hover:bg-neutral-50 text-neutral-900 shadow-[0_8px_25px_rgba(0,0,0,0.15)] border-2 border-neutral-200/90 hover:border-[#3367A5] hover:text-[#3367A5] flex flex-col items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer group/lang focus:outline-none">

    <!-- Tooltip on Left -->
    <span id="gat-lang-tooltip" class="gat-lang-tooltip">
        Ubah ke Bahasa Indonesia
    </span>

    <!-- Globe SVG Icon with Smooth 360 Rotation on click -->
    <svg id="gat-lang-icon"
        class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] group-hover/lang:scale-110"
        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"></circle>
        <path stroke-linecap="round" stroke-linejoin="round" d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"></path>
    </svg>

    <!-- Current Language Badge: EN / ID -->
    <span id="gat-lang-badge"
        class="text-[10px] sm:text-[11px] font-bold font-['Agrandir',sans-serif] tracking-wider uppercase mt-0.5 text-neutral-800 group-hover/lang:text-[#3367A5]">
        EN
    </span>
</button>

<!-- Interactive Hover Expandable Floating Action Button (FAB / Speed Dial - Right Side) -->
<div id="gat-fab-container"
    class="group/fab fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-50 font-['Questrial',sans-serif]">

    <!-- Speed Dial Action Items (Muncul 1 baris horizontal ke KIRI khusus Social Media & Kontak, ikut Hide/Unhide di Admin) -->
    <div id="gat-fab-menu">

        @php
            $fabEmail = trim((string) \App\Models\SiteSetting::getValue('social_email', 'admin@gat-aspect.com'));
            $fabEmailVisible = \App\Models\SiteSetting::isSocialVisible('email');
            $fabWaNumber = \App\Models\SiteSetting::publicWaNumber();
            $fabActiveSocials = \App\Models\SiteSetting::activeSocialLinks();
            $fabSocialOrder = ['tiktok', 'facebook', 'youtube', 'instagram', 'linkedin'];
            $fabSocialSvgs = [
                'tiktok' => '<path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>',
                'facebook' => '<path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>',
                'youtube' => '<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>',
                'instagram' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>',
                'linkedin' => '<path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>',
            ];
        @endphp

        @if ($fabEmailVisible && $fabEmail !== '')
        <!-- Gmail (Hide/Unhide controllable from Admin -> WA & Social) -->
        <a href="mailto:{{ $fabEmail }}" aria-label="Gmail"
            class="gat-fab-item focus:outline-none">
            <span data-lang-en="Gmail" data-lang-id="Gmail" class="gat-fab-tooltip">
                Gmail
            </span>
            <div class="gat-fab-circle gat-fab-circle--gmail">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6 17V37.5C6 39.1569 7.34315 40.5 9 40.5H14V23L6 17Z" fill="#4285F4"/>
                    <path d="M42 17V37.5C42 39.1569 40.6569 40.5 39 40.5H34V23L42 17Z" fill="#34A853"/>
                    <path d="M14 11L24 18.5L34 11V23L24 30.5L14 23V11Z" fill="#EA4335"/>
                    <path d="M6 12.5C6 9.3 9.6 7.5 12.2 9.65L14 11V23L6 17V12.5Z" fill="#C5221F"/>
                    <path d="M42 12.5C42 9.3 38.4 7.5 35.8 9.65L34 11V23L42 17V12.5Z" fill="#FBBC04"/>
                </svg>
            </div>
        </a>
        @endif

        <!-- Dynamic Active & Visible Social Media Channels (TikTok, Facebook, YouTube, Instagram, LinkedIn) -->
        @foreach ($fabSocialOrder as $platform)
            @if (isset($fabActiveSocials[$platform]))
                <a href="{{ $fabActiveSocials[$platform]['url'] }}" target="_blank" rel="noopener noreferrer"
                    aria-label="{{ $fabActiveSocials[$platform]['label'] }}"
                    class="gat-fab-item focus:outline-none">
                    <span class="gat-fab-tooltip">
                        {{ $fabActiveSocials[$platform]['label'] }}
                    </span>
                    <div class="gat-fab-circle gat-fab-circle--{{ $platform }}">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current" viewBox="0 0 24 24">
                            {!! $fabSocialSvgs[$platform] !!}
                        </svg>
                    </div>
                </a>
            @endif
        @endforeach

        <!-- WhatsApp -->
        <a href="https://wa.me/{{ $fabWaNumber }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"
            class="gat-fab-item focus:outline-none">
            <span class="gat-fab-tooltip">
                WhatsApp
            </span>
            <div class="gat-fab-circle gat-fab-circle--whatsapp">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </div>
        </a>

    </div>

    <!-- Main FAB Trigger Button (+) -->
    <div id="gat-fab-toggle" role="button" tabindex="0" aria-label="Quick Contact Menu"
        class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-[#1E4E8A] to-[#3367A5] hover:from-[#173F70] hover:to-[#2B5A93] text-white shadow-[0_8px_25px_rgba(51,103,165,0.45)] flex items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer focus:outline-none">

        <!-- Rotating Plus Icon (+ to x upon hover) -->
        <svg id="gat-fab-icon"
            class="w-7 h-7 sm:w-8 sm:h-8 transition-transform duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
        </svg>
    </div>
</div>

<!-- Floating Language Toast Notification -->
<div id="gat-lang-toast"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[999] px-5 py-2.5 rounded-full bg-neutral-900/95 text-white text-xs sm:text-sm font-medium border border-neutral-700/80 shadow-[0_10px_30px_rgba(0,0,0,0.35)] backdrop-blur-md transition-all duration-300 opacity-0 translate-y-4 pointer-events-none flex items-center gap-2.5 font-['Questrial',sans-serif]">
    <span id="gat-toast-flag">🇮🇩</span>
    <span id="gat-toast-msg">Mode Bahasa Indonesia diaktifkan</span>
</div>

<!-- Floating Action Button & Scroll to Top Script -->
<script>
    function gatScrollToTop() {
        if (window.lenis) {
            window.lenis.scrollTo(0, { duration: 1.2 });
            return;
        }
        try {
            window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
        } catch (e) {
            window.scrollTo(0, 0);
        }
        if (document.documentElement) {
            try {
                document.documentElement.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
            } catch (e) {
                document.documentElement.scrollTop = 0;
            }
        }
        if (document.body) {
            try {
                document.body.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
            } catch (e) {
                document.body.scrollTop = 0;
            }
        }
    }

    (function () {
        const container = document.getElementById('gat-fab-container');
        const menu = document.getElementById('gat-fab-menu');
        const icon = document.getElementById('gat-fab-icon');
        const toggleBtn = document.getElementById('gat-fab-toggle');
        const scrollTopBtn = document.getElementById('gat-scroll-top');

        if (scrollTopBtn) {
            function updateScrollTopVisibility() {
                const scrollY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
                if (scrollY > 200) {
                    scrollTopBtn.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                    scrollTopBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                } else {
                    scrollTopBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    scrollTopBtn.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
                }
            }

            window.addEventListener('scroll', updateScrollTopVisibility, { passive: true });
            window.addEventListener('resize', updateScrollTopVisibility, { passive: true });
            updateScrollTopVisibility();
        }

        if (!container || !menu || !icon || !toggleBtn) return;

        let closeTimeout = null;

        function openMenu() {
            if (closeTimeout) clearTimeout(closeTimeout);
            menu.classList.add('is-open');
            icon.classList.add('is-open');
        }

        function closeMenu(delay = 150) {
            if (closeTimeout) clearTimeout(closeTimeout);
            closeTimeout = setTimeout(() => {
                menu.classList.remove('is-open');
                icon.classList.remove('is-open');
            }, delay);
        }

        // Hover handling for FAB container
        container.addEventListener('mouseenter', openMenu);
        container.addEventListener('mouseleave', () => closeMenu(250));

        // When mouse enters language button, immediately ensure FAB menu is closed
        const langToggleBtn = document.getElementById('gat-lang-toggle');
        if (langToggleBtn) {
            langToggleBtn.addEventListener('mouseenter', () => closeMenu(0));
        }

        // Mobile / Touch Tap toggle
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (!menu.classList.contains('is-open')) {
                openMenu();
            } else {
                closeMenu(0);
            }
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                closeMenu(0);
            }
        });
    })();

    // =========================================================================
    // GLOBAL GAT BILINGUAL TRANSLATION ENGINE (EN <-> ID)
    // =========================================================================
    (function () {
        const dictionary = {
            // --- Navigation & Navbar ---
            "Home": "Beranda",
            "About Us": "Tentang Kami",
            "Solutions": "Solusi",
            "Products": "Produk",
            "Contact Us": "Kontak Kami",
            "Get A Quote": "Minta Penawaran",
            "Request Quote": "Minta Penawaran",
            "Get Quote": "Minta Penawaran",
            "Top": "Atas",
            "Scroll To Top": "Kembali ke Atas",
            "Email Us": "Kirim Email",
            "Quick Contact Menu": "Menu Kontak Cepat",

            // --- Mega Menu Dropdown Items ---
            "PLC Programming": "Pemrograman PLC",
            "Inspection & Record Data": "Inspeksi & Perekaman Data",
            "Software & IoT": "Software & IoT",
            "Software": "Software",
            "Monitoring System": "Sistem Monitoring",
            "Integrator System": "Integrator Sistem",
            "Laser Marking & Inkjet": "Laser Marking & Inkjet",
            "Strapping & Packaging": "Strapping & Pengemasan",
            "Telemetry & software analytics": "Telemetri & analitik software",
            "Enterprise IoT Telemetry, SCADA & OEE Software Analytics": "Telemetri IoT Enterprise, SCADA & Analitik Software OEE",
            "Ready to Connect Your Factory Floor with Smart Software?": "Siap Menghubungkan Lantai Pabrik Anda dengan Software Pintar?",
            "Mission-Critical Logic Architecture, Motion Control & System Retrofitting": "Arsitektur Logika Kritis, Kontrol Gerak & Retrofit Sistem",
            "Ultra High-Speed Machine Vision & Real-Time Serialization Auditing": "Machine Vision Kecepatan Tinggi & Audit Serialisasi Real-Time",
            "Real-Time Industrial Telemetry, SCADA & OEE Analytics": "Telemetri Industri Real-Time, SCADA & Analisis OEE",
            "End-to-End Industrial Robotics, Material Flow & Smart Line Integration": "Robotika Industri Terpadu, Aliran Material & Integrasi Lini Cerdas",
            "Precision Industrial Tracing, Fiber Laser Marking & High-Speed CIJ Printing": "Pelacakan Industri Presisi, Laser Marking Serat & Cetak CIJ Cepat",
            "High-Speed End-of-Line Packaging, Arch Strappers & Heavy Pallet Bundling": "Pengemasan Lini Akhir Cepat, Arch Strappers & Pengikatan Palet Berat",

            // --- Homepage Hero & Badges ---
            "Tailored Automation & Smart Integrated Systems.": "Otomasi Khusus & Sistem Terintegrasi Cerdas.",
            "Providing Professional And Reliable Solutions For Various Industry": "Menyediakan Solusi Profesional dan Tepercaya untuk Berbagai Industri",
            "Targeted Engineering Solutions": "Solusi Rekayasa Khusus",
            "Machine Vision & AI Integration": "Integrasi Machine Vision & AI",
            "Sub-micron optical inspection, automated packaging, and Tier-1 PLC telemetry engineered for 24/7 reliability.": "Inspeksi optik sub-mikron, pengemasan otomatis, dan telemetri PLC Tier-1 yang dirancang untuk keandalan 24/7.",
            "Explore Solutions": "Jelajahi Solusi",
            "Explore Our About Us": "Tentang Kami Selengkapnya",
            "Amplifying Industrial Potential": "Mengoptimalkan Potensi Industri",
            "Industrial Achievements": "Pencapaian Industri",
            "Core Pillars of Engineering Excellence": "Pilar Utama Keunggulan Rekayasa",
            "Transforming Manufacturing Lines Across Indonesia": "Mentransformasi Lini Manufaktur di Seluruh Indonesia",

            // --- Section 3: Industrial Solutions Grid ---
            "Turnkey Packaging Automation": "Otomasi Pengemasan Terpadu",
            "Heavy-duty automatic and semi-automatic strapping systems with friction welding for high-speed end-of-line packaging.": "Sistem strapping otomatis dan semi-otomatis beban berat dengan pengelasan gesek untuk pengemasan lini akhir berkecepatan tinggi.",
            "Explore Strapping Solutions": "Lihat Solusi Strapping",
            "Vision Quality & Inspection": "Inspeksi Kualitas & Vision",
            "High-speed optical inspection, OCR batch reading, and micron-level tolerance verification with automated defect rejection.": "Inspeksi optik berkecepatan tinggi, pembacaan batch OCR, dan verifikasi toleransi tingkat mikron dengan pemisahan reject otomatis.",
            "Explore Vision Systems": "Lihat Sistem Vision",
            "High-Speed Coding & Marking": "Pencetakan Kode & Penandaan Cepat",
            "Industrial TIJ thermal inkjet and fiber laser marking for indelible serialization, QR codes, and lot trace identification.": "TIJ thermal inkjet industri dan penandaan laser serat untuk serialisasi permanen, kode QR, dan identifikasi pelacakan lot.",
            "Explore Laser & Inkjet": "Lihat Laser & Inkjet",
            "Control Systems & PLC Integration": "Sistem Kontrol & Integrasi PLC",
            "Multi-brand PLC programming (Siemens, Omron, Mitsubishi, Keyence), motion control, and customized HMI/SCADA panels.": "Pemrograman PLC multi-merek (Siemens, Omron, Mitsubishi, Keyence), kontrol gerak, dan panel HMI/SCADA kustom.",
            "Explore Automation Panels": "Lihat Panel Otomasi",
            "Real-Time Industrial Telemetry": "Telemetri Industri Real-Time",
            "Shop-floor IoT telemetry, predictive health monitoring, and OEE performance tracking with low latency.": "Telemetri IoT lantai pabrik, pemantauan kesehatan prediktif, dan pelacakan kinerja OEE dengan latensi rendah.",
            "Explore Sensor Telemetry": "Lihat Telemetri Sensor",
            "Turnkey System Integration": "Integrasi Sistem Siap Pakai",
            "Custom automated conveyor routing, multi-axis robotics, and mechanical handling cells engineered for factory floors.": "Perutean konveyor otomatis khusus, robotika multi-sumbu, dan sel penanganan mekanis untuk lantai pabrik.",
            "Explore Conveyor Integration": "Lihat Integrasi Konveyor",

            // --- Section 4: Specifications Panel (Characteristics & Architecture) ---
            "Characteristics": "Karakteristik",
            "Architecture": "Arsitektur",
            "Throughput & Speed": "Kecepatan & Kapasitas Siklus",
            "High-speed cycle up to 800–1,200 pcs/min on machine vision inspection & 60+ straps/min on packaging lines": "Siklus berkecepatan tinggi hingga 800–1.200 pcs/menit pada inspeksi vision & 60+ tali/menit pada lini kemasan",
            "Optical Precision": "Presisi Optik",
            "Sub-micron dimensional tolerance up to ±0.001 mm with high-resolution matrix CMOS sensors and telecentric optics": "Toleransi dimensi sub-mikron hingga ±0,001 mm dengan sensor matrix CMOS resolusi tinggi dan optik telesentris",
            "Strapping Force": "Gaya Tarik Strapping",
            "Heavy-duty tension up to 3,500N–8,500N with rapid friction welding (0.2–3.5s) for PET, PP, and steel strap packaging": "Gaya tarik beban berat hingga 3.500N–8.500N dengan pengelasan gesek cepat (0,2–3,5 detik) untuk kemasan tali PET, PP, dan baja",
            "Coding & Marking": "Pencetakan Kode & Penandaan",
            "600 DPI industrial TIJ inkjet & fiber laser marking up to 100 m/min with dynamic QR, DataMatrix, and barcode printing": "TIJ inkjet industri 600 DPI & penandaan laser serat hingga 100 m/menit dengan kode QR dinamis, DataMatrix, dan barcode",
            "Operational Uptime": "Keandalan Waktu Operasi",
            "Engineered for 24/7 continuous industrial production with 99.9% logic reliability and instant fail-safe recovery": "Dirancang untuk produksi industri kontinu 24/7 dengan keandalan logika 99,9% dan pemulihan pengaman otomatis",
            "PLC Platforms": "Platform PLC",
            "Mitsubishi (iQ-R/FX), Omron (NJ/NX/CP), Siemens (S7-1200/1500), and Keyence multi-brand controllers": "Pengendali multi-merek Mitsubishi (iQ-R/FX), Omron (NJ/NX/CP), Siemens (S7-1200/1500), dan Keyence",
            "Fieldbus & Protocols": "Protokol & Fieldbus",
            "Profinet, EtherNet/IP, Modbus TCP/RTU, OPC UA Server, and discrete 24V PNP/NPN high-speed I/O": "Profinet, EtherNet/IP, Modbus TCP/RTU, Server OPC UA, dan I/O diskrit kecepatan tinggi 24V PNP/NPN",
            "Automated Rejection": "Pemisahan Reject Otomatis",
            "Pneumatic high-speed air-jet ejectors, pusher cylinders, and servo motorized sorting flapper gates": "Ejektor semburan angin pneumatik kecepatan tinggi, silinder pendorong, dan gerbang pemilah servo bermotor",
            "Telemetry & SCADA": "Telemetri & SCADA",
            "Sub-second telemetry (<100ms refresh latency) with real-time OEE tracking and central industrial touch HMI": "Telemetri sub-detik (latensi <100ms) dengan pelacakan OEE real-time dan panel sentuh HMI industri terpusat",
            "Safety Architecture": "Arsitektur Keselamatan",
            "Category 4 / PLe fail-safe interlocks, optoelectronic safety light curtains, and emergency halt circuits": "Interlock pengaman Category 4 / PLe, tirai cahaya keselamatan optoelektronik, dan sirkuit penghenti darurat",

            // --- Common Headings & Actions Across Pages ---
            "What We Deliver": "Layanan Kami",
            "Core Capabilities": "Kapabilitas Utama",
            "Key Highlights": "Keunggulan Utama",
            "Our Clients": "Klien Kami",
            "View Details": "Lihat Detail",
            "Search Products...": "Cari Produk...",
            "All Categories": "Semua Kategori",
            "Send Message": "Kirim Pesan",
            "Navigation": "Navigasi",
            "Contact Info": "Informasi Kontak",
            "Quick Links": "Tautan Cepat",
            "All Rights Reserved.": "Semua Hak Dilindungi.",
            "Privacy Policy": "Kebijakan Privasi",
            "Terms of Service": "Syarat & Ketentuan"
        };

        // Create reverse lookup for ID -> EN
        const reverseDictionary = {};
        for (const [en, id] of Object.entries(dictionary)) {
            reverseDictionary[id] = en;
        }

        let currentLang = localStorage.getItem('gat_language') || 'en';
        let toastTimeout = null;

        function showLanguageToast(lang) {
            const toast = document.getElementById('gat-lang-toast');
            const flag = document.getElementById('gat-toast-flag');
            const msg = document.getElementById('gat-toast-msg');
            if (!toast || !flag || !msg) return;

            if (lang === 'id') {
                flag.textContent = '🇮🇩';
                msg.textContent = 'Mode Bahasa Indonesia Diaktifkan';
            } else {
                flag.textContent = '🇬🇧';
                msg.textContent = 'English Mode Activated';
            }

            if (toastTimeout) clearTimeout(toastTimeout);
            toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');

            toastTimeout = setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
            }, 2400);
        }

        function updateButtonUI(lang) {
            const badge = document.getElementById('gat-lang-badge');
            const tooltip = document.getElementById('gat-lang-tooltip');
            const btn = document.getElementById('gat-lang-toggle');
            const icon = document.getElementById('gat-lang-icon');

            if (badge) {
                badge.textContent = lang.toUpperCase();
                badge.className = lang === 'id' 
                    ? 'text-[10px] sm:text-[11px] font-bold font-[\'Agrandir\',sans-serif] tracking-wider uppercase mt-0.5 text-[#3367A5]'
                    : 'text-[10px] sm:text-[11px] font-bold font-[\'Agrandir\',sans-serif] tracking-wider uppercase mt-0.5 text-neutral-800 group-hover/lang:text-[#3367A5]';
            }

            if (tooltip) {
                tooltip.textContent = lang === 'id' ? 'Ubah ke English' : 'Ubah ke Bahasa Indonesia';
            }

            if (btn) {
                if (lang === 'id') {
                    btn.classList.add('border-[#3367A5]', 'shadow-[0_8px_25px_rgba(51,103,165,0.25)]');
                    btn.classList.remove('border-neutral-200/90');
                } else {
                    btn.classList.remove('border-[#3367A5]', 'shadow-[0_8px_25px_rgba(51,103,165,0.25)]');
                    btn.classList.add('border-neutral-200/90');
                }
            }

            if (icon) {
                icon.style.transform = lang === 'id' ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        }

        function translateDOM(targetLang) {
            // 1. Direct attribute replacement for 100% deterministic, instant translation
            document.querySelectorAll('[data-lang-en]').forEach(el => {
                const val = targetLang === 'id' ? el.getAttribute('data-lang-id') : el.getAttribute('data-lang-en');
                if (val !== null && val !== undefined) {
                    el.innerHTML = val;
                }
            });

            // 2. Fallback TreeWalker for any untagged text nodes
            const walker = document.createTreeWalker(
                document.body,
                NodeFilter.SHOW_TEXT,
                {
                    acceptNode: function (node) {
                        const parent = node.parentElement;
                        if (!parent) return NodeFilter.FILTER_REJECT;
                        const tag = parent.tagName.toUpperCase();
                        if (['SCRIPT', 'STYLE', 'NOSCRIPT', 'SVG', 'CODE', 'PRE'].includes(tag)) {
                            return NodeFilter.FILTER_REJECT;
                        }
                        // Skip if parent or ancestor already has data-lang-en
                        if (parent.closest('[data-lang-en]')) {
                            return NodeFilter.FILTER_REJECT;
                        }
                        // Skip language button itself
                        if (parent.closest('#gat-lang-toggle') || parent.closest('#gat-lang-toast')) {
                            return NodeFilter.FILTER_REJECT;
                        }
                        const text = node.nodeValue.trim();
                        if (text.length === 0) return NodeFilter.FILTER_SKIP;
                        return NodeFilter.FILTER_ACCEPT;
                    }
                }
            );

            const nodesToUpdate = [];
            while (walker.nextNode()) {
                nodesToUpdate.push(walker.currentNode);
            }

            nodesToUpdate.forEach(node => {
                const text = node.nodeValue.trim();
                if (targetLang === 'id') {
                    if (dictionary[text]) {
                        if (!node._gatOriginalEn) {
                            node._gatOriginalEn = text;
                        }
                        node.nodeValue = node.nodeValue.replace(text, dictionary[text]);
                    }
                } else {
                    // Restore to English
                    if (node._gatOriginalEn) {
                        node.nodeValue = node.nodeValue.replace(text, node._gatOriginalEn);
                    } else if (reverseDictionary[text]) {
                        node.nodeValue = node.nodeValue.replace(text, reverseDictionary[text]);
                    }
                }
            });

            // Also translate placeholders
            document.querySelectorAll('input[placeholder], textarea[placeholder]').forEach(el => {
                const ph = el.getAttribute('placeholder').trim();
                if (targetLang === 'id') {
                    if (dictionary[ph]) {
                        if (!el._gatOriginalPh) el._gatOriginalPh = ph;
                        el.setAttribute('placeholder', dictionary[ph]);
                    }
                } else {
                    if (el._gatOriginalPh) {
                        el.setAttribute('placeholder', el._gatOriginalPh);
                    } else if (reverseDictionary[ph]) {
                        el.setAttribute('placeholder', reverseDictionary[ph]);
                    }
                }
            });
        }

        window.gatSetLanguage = function (lang, showToast = true) {
            currentLang = lang;
            localStorage.setItem('gat_language', lang);
            updateButtonUI(lang);
            translateDOM(lang);
            if (typeof window.updateGatNavPills === 'function') {
                window.updateGatNavPills(false);
            }
            if (showToast) showLanguageToast(lang);

            // Dispatch global event for any page-specific listeners
            window.dispatchEvent(new CustomEvent('gatLanguageChanged', { detail: { language: lang } }));

            requestAnimationFrame(() => {
                if (typeof window.updateGatNavPills === 'function') {
                    window.updateGatNavPills(false);
                }
            });
            setTimeout(() => {
                if (typeof window.updateGatNavPills === 'function') {
                    window.updateGatNavPills(false);
                }
            }, 50);
            setTimeout(() => {
                if (typeof window.updateGatNavPills === 'function') {
                    window.updateGatNavPills(false);
                }
            }, 150);
        };

        window.gatToggleLanguage = function () {
            const nextLang = currentLang === 'en' ? 'id' : 'en';
            window.gatSetLanguage(nextLang, true);
        };

        // Initialize on load
        function initLanguage() {
            const savedLang = localStorage.getItem('gat_language') || 'en';
            updateButtonUI(savedLang);
            if (savedLang === 'id') {
                translateDOM('id');
            }
            if (typeof window.updateGatNavPills === 'function') {
                window.updateGatNavPills(true);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initLanguage);
        } else {
            initLanguage();
        }

        // Re-translate when tab changes in Section 4 or dynamic content appears
        document.addEventListener('click', function(e) {
            if (currentLang === 'id' && (e.target.closest('#tab-btn-characteristics') || e.target.closest('#tab-btn-architecture'))) {
                setTimeout(() => translateDOM('id'), 50);
            }
        });
    })();

</script>
