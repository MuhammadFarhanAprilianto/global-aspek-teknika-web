{{-- ========================================================================= --}}
{{-- GLOBAL STAGGERED SEQUENTIAL SCROLL-REVEAL ENGINE (ALL PUBLIC PAGES)       --}}
{{-- Text, headings, paragraphs & CTAs stay hidden until scrolled into view,   --}}
{{-- then reveal smoothly one-by-one (top-to-bottom staggered cadence).        --}}
{{-- ========================================================================= --}}
<style id="gat-scroll-reveal-styles">
    .gat-sr-item {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity 0.62s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.68s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }

    .gat-sr-item.gat-sr-visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (prefers-reduced-motion: reduce), print {
        .gat-sr-item {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }

    /* Seamless Edge Shadow Fade Attached Flush to Dark <-> Light Section Boundaries */
    .gat-edge-fade {
        position: absolute;
        left: 0;
        right: 0;
        height: 48px;
        z-index: 15;
        pointer-events: none;
        user-select: none;
    }

    .gat-edge-fade-top {
        top: -1px;
    }

    .gat-edge-fade-bottom {
        bottom: -1px;
    }

    @media (min-width: 640px) {
        .gat-edge-fade {
            height: 64px;
        }
    }

    @media (min-width: 1024px) {
        .gat-edge-fade {
            height: 80px;
        }
    }

    @media print {
        .gat-edge-fade {
            display: none !important;
        }
    }
</style>

<script>
(function () {
    if (window.__gatSequentialScrollRevealInit) return;
    window.__gatSequentialScrollRevealInit = true;

    // Jangan sembunyikan teks pada halaman dokumen transaksi / verifikasi invoice atau Admin
    const path = window.location.pathname || '/';
    if (
        path.startsWith('/admin') ||
        path.startsWith('/checkout') ||
        path.startsWith('/verify-invoice')
    ) {
        return;
    }

    // Hormati preferensi aksesibilitas reduced-motion
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const EXCLUDE_SELECTOR = [
        'header',
        'nav',
        'footer',
        '#site-header',
        '#mobile-menu',
        '#gat-fab-container',
        '#gat-lang-toggle',
        '#gat-scroll-top',
        '#case-modal',
        '#simLeadGateModal',
        '#proforma-invoice-sheet',
        '[role="dialog"]',
        '.fixed',
        '.showcase-card',
        '.showcase-step',
        '.showcase-overlay-bg',
        '.marquee-wrapper',
        '.animate-marquee-left',
        '.animate-marquee-right',
        '.sim-lock-overlay',
        '.sim-lock-target',
        '.sim-pane',
        'table',
        'form',
        'canvas',
        'svg',
        '[x-cloak]',
        '[data-no-reveal]'
    ].join(',');

    function isExcluded(el) {
        if (!el || el.nodeType !== 1) return true;
        if (el.closest(EXCLUDE_SELECTOR)) return true;

        // Jangan target elemen yang sedang tersembunyi (mis. tab / modal / dropdown tertutup)
        let cur = el;
        while (cur && cur !== document.body) {
            if (cur.classList && (cur.classList.contains('hidden') || cur.classList.contains('mega-dropdown-menu'))) {
                return true;
            }
            const idStr = (cur.id || '').toLowerCase();
            if (idStr.includes('modal') || idStr.includes('drawer') || idStr.includes('dropdown') || idStr.includes('toast')) {
                return true;
            }
            cur = cur.parentElement;
        }

        const style = window.getComputedStyle(el);
        if (style.display === 'none' || style.visibility === 'hidden') return true;
        if ((el.textContent || '').trim().length === 0) return true;

        return false;
    }

    function initSequentialReveal() {
        const scopes = Array.from(document.querySelectorAll('section, main'));
        if (scopes.length === 0) return;

        // Pilih blok teks editorial, heading, paragraf & tombol CTA agar muncul berurutan satu per satu
        const TARGET_QUERY = 'h1, h2, h3, h4, p, blockquote, ul > li, .cta-quote-btn, a[href][class*="rounded-full"]:not([onclick])';
        const registered = new Set();
        const sectionGroups = [];

        scopes.forEach(scope => {
            if (scope.closest('header, nav, footer, .fixed, #case-modal, #simLeadGateModal')) return;

            const rawNodes = Array.from(scope.querySelectorAll(TARGET_QUERY));
            const items = [];

            rawNodes.forEach(node => {
                if (registered.has(node)) return;
                if (isExcluded(node)) return;

                // Hindari membungkus anak jika induknya sudah ikut dalam daftar animasi
                let ancestorRegistered = false;
                let p = node.parentElement;
                while (p && p !== scope) {
                    if (registered.has(p)) {
                        ancestorRegistered = true;
                        break;
                    }
                    p = p.parentElement;
                }
                if (ancestorRegistered) return;

                registered.add(node);
                items.push(node);
            });

            if (items.length > 0) {
                sectionGroups.push({ scope, items });
            }
        });

        const allItems = [];
        sectionGroups.forEach(group => {
            group.items.forEach(el => {
                el.classList.add('gat-sr-item');
                allItems.push(el);
            });
        });

        if (allItems.length === 0) return;

        // Antrean batch agar elemen yang masuk viewport secara bersamaan muncul BERURUTAN satu per satu
        let pendingQueue = [];
        let flushTimer = null;

        function flushQueue() {
            flushTimer = null;
            if (pendingQueue.length === 0) return;

            // Urutkan persis dari atas ke bawah (dan kiri ke kanan pada baris yang sama)
            const batch = pendingQueue.slice().sort((a, b) => {
                const ra = a.getBoundingClientRect();
                const rb = b.getBoundingClientRect();
                if (Math.abs(ra.top - rb.top) > 16) {
                    return ra.top - rb.top;
                }
                return ra.left - rb.left;
            });
            pendingQueue = [];

            batch.forEach((el, idx) => {
                const delayMs = Math.min(idx * 95, 650);
                el.style.transitionDelay = delayMs + 'ms';
                requestAnimationFrame(() => {
                    el.classList.add('gat-sr-visible');
                });
                // Setelah animasi selesai, kembalikan kontrol CSS penuh ke elemen asli (hover/click tetap normal 100%)
                setTimeout(() => {
                    el.classList.remove('gat-sr-item', 'gat-sr-visible');
                    el.style.transitionDelay = '';
                    el.dataset.gatSrDone = '1';
                }, delayMs + 800);
            });
        }

        function enqueueReveal(el) {
            if (!el || el.dataset.gatSrDone === '1' || el.classList.contains('gat-sr-visible') || el.dataset.gatSrQueued === '1') return;
            el.dataset.gatSrQueued = '1';
            pendingQueue.push(el);
            if (!flushTimer) {
                flushTimer = setTimeout(flushQueue, 35);
            }
        }

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        enqueueReveal(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -55px 0px'
            });

            allItems.forEach(el => observer.observe(el));

            // Jaring pengaman: jika pengunjung menggulir sampai paling bawah, pastikan semua elemen di atas layar sudah muncul
            let scrollCheckTimer = null;
            window.addEventListener('scroll', () => {
                if (scrollCheckTimer) return;
                scrollCheckTimer = setTimeout(() => {
                    scrollCheckTimer = null;
                    const vh = window.innerHeight || document.documentElement.clientHeight;
                    const nearBottom = (window.scrollY + vh) >= (document.documentElement.scrollHeight - 80);
                    allItems.forEach(el => {
                        if (el.dataset.gatSrDone === '1' || el.classList.contains('gat-sr-visible')) return;
                        const rect = el.getBoundingClientRect();
                        if (rect.top < vh - 20 || nearBottom) {
                            enqueueReveal(el);
                            observer.unobserve(el);
                        }
                    });
                }, 120);
            }, { passive: true });
        } else {
            allItems.forEach(el => el.classList.add('gat-sr-visible'));
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSequentialReveal);
    } else {
        initSequentialReveal();
    }
})();

/* ========================================================================= */
/* GLOBAL SEAMLESS DARK <-> LIGHT SECTION FADE TRANSITIONS (ALL PUBLIC PAGES)*/
/* ========================================================================= */
(function () {
    if (window.__gatSectionFadeInit) return;
    window.__gatSectionFadeInit = true;

    const path = window.location.pathname || '/';
    if (
        path.startsWith('/admin') ||
        path.startsWith('/checkout') ||
        path.startsWith('/verify-invoice')
    ) {
        return;
    }

    function parseRgb(colorStr) {
        if (!colorStr || colorStr === 'transparent') return null;
        const m = colorStr.match(/rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)(?:\s*,\s*([\d.]+))?\s*\)/i);
        if (!m) return null;
        const a = m[4] !== undefined ? parseFloat(m[4]) : 1;
        if (a <= 0.05) return null;
        return { r: parseInt(m[1], 10), g: parseInt(m[2], 10), b: parseInt(m[3], 10), a };
    }

    function luminance(rgb) {
        return 0.2126 * rgb.r + 0.7152 * rgb.g + 0.0722 * rgb.b;
    }

    function resolveSectionColor(el) {
        const direct = parseRgb(window.getComputedStyle(el).backgroundColor);
        if (direct) return direct;
        // Fallback ke warna body (umumnya putih #ffffff)
        const bodyBg = parseRgb(window.getComputedStyle(document.body).backgroundColor);
        return bodyBg || { r: 255, g: 255, b: 255, a: 1 };
    }

    function isDarkColor(rgb) {
        return luminance(rgb) < 60;
    }

    function isLightColor(rgb) {
        return luminance(rgb) > 195;
    }

    function buildEdgeGradient(darkRgb, edge) {
        const d = (alpha) => `rgba(${darkRgb.r}, ${darkRgb.g}, ${darkRgb.b}, ${alpha})`;
        const dSolid = `rgb(${darkRgb.r}, ${darkRgb.g}, ${darkRgb.b})`;

        // Persis menempel di batas section hitam -> memudar mulus ke transparan di atas section putih
        if (edge === 'top') {
            return `linear-gradient(to bottom, ${dSolid} 0%, ${d(0.45)} 45%, ${d(0)} 100%)`;
        }
        return `linear-gradient(to top, ${dSolid} 0%, ${d(0.45)} 45%, ${d(0)} 100%)`;
    }

    function hasExistingEdgeFade(sectionEl, edge) {
        // Cek apakah sudah ada fade bawaan (.gat-edge-fade) atau gradient manual (seperti di home & about)
        if (sectionEl.querySelector(`:scope > .gat-edge-fade-${edge}`)) return true;

        const directDivs = Array.from(sectionEl.querySelectorAll(':scope > div'));
        return directDivs.some(div => {
            const cls = (typeof div.className === 'string' ? div.className : '');
            if (!cls.includes('bg-gradient-to-')) return false;
            if (!cls.includes('pointer-events-none')) return false;
            if (edge === 'top' && cls.includes('top-0') && !cls.includes('inset-0') && !cls.includes('bottom-0')) {
                return true;
            }
            if (edge === 'bottom' && cls.includes('bottom-0') && !cls.includes('inset-0') && !cls.includes('top-0')) {
                return true;
            }
            return false;
        });
    }

    function ensureRelativePosition(el) {
        if (window.getComputedStyle(el).position === 'static') {
            el.style.position = 'relative';
        }
    }

    function applyDarkLightSectionFades() {
        // Kumpulkan hanya section konten (kecualikan <footer> agar footer selalu bersih tanpa bayangan)
        const rawBlocks = Array.from(document.querySelectorAll('body > section, body > main, body > main > section'));
        const blocks = rawBlocks.filter(el => {
            if (el.tagName === 'FOOTER' || el.closest('footer')) return false;
            if (el.tagName === 'MAIN' && el.querySelector(':scope > section')) return false;
            const style = window.getComputedStyle(el);
            if (style.display === 'none' || style.position === 'fixed') return false;
            if (el.offsetHeight < 40) return false;
            return true;
        });

        for (let i = 0; i < blocks.length - 1; i++) {
            const curr = blocks[i];
            const next = blocks[i + 1];

            const currRgb = resolveSectionColor(curr);
            const nextRgb = resolveSectionColor(next);

            const currDark = isDarkColor(currRgb);
            const currLight = isLightColor(currRgb);
            const nextDark = isDarkColor(nextRgb);
            const nextLight = isLightColor(nextRgb);

            // Kasus 1: Section Hitam di atas -> Section Putih di bawah
            // Tempelkan bayangan pudar halus di sisi paling atas section putih (menyatu langsung ke hitam)
            if (currDark && nextLight) {
                if (hasExistingEdgeFade(next, 'top')) continue;
                ensureRelativePosition(next);
                curr.style.borderBottomColor = 'transparent';
                next.style.borderTopColor = 'transparent';

                const fade = document.createElement('div');
                fade.className = 'gat-edge-fade gat-edge-fade-top';
                fade.setAttribute('aria-hidden', 'true');
                fade.style.background = buildEdgeGradient(currRgb, 'top');
                next.insertAdjacentElement('afterbegin', fade);
            }
            // Kasus 2: Section Putih di atas -> Section Hitam di bawah
            // Tempelkan bayangan pudar halus di sisi paling bawah section putih (menyatu langsung ke hitam)
            else if (currLight && nextDark) {
                if (hasExistingEdgeFade(curr, 'bottom')) continue;
                ensureRelativePosition(curr);
                curr.style.borderBottomColor = 'transparent';
                next.style.borderTopColor = 'transparent';

                const fade = document.createElement('div');
                fade.className = 'gat-edge-fade gat-edge-fade-bottom';
                fade.setAttribute('aria-hidden', 'true');
                fade.style.background = buildEdgeGradient(nextRgb, 'bottom');
                curr.insertAdjacentElement('beforeend', fade);
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => setTimeout(applyDarkLightSectionFades, 120));
    } else {
        setTimeout(applyDarkLightSectionFades, 120);
    }
    window.addEventListener('load', applyDarkLightSectionFades);
})();
</script>
