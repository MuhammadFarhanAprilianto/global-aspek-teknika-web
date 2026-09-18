<!-- Scroll to Top Floating Pill Button (Left Side) -->
<button id="gat-scroll-top" type="button" aria-label="Scroll to top" onclick="gatScrollToTop()"
    class="fixed bottom-6 left-6 sm:bottom-8 sm:left-8 z-50 flex items-center gap-2 px-4 py-3 rounded-full bg-white/95 hover:bg-white text-gray-900 border border-gray-200/90 shadow-[0_8px_25px_rgba(0,0,0,0.12)] backdrop-blur-md transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] opacity-0 translate-y-6 pointer-events-none hover:shadow-[0_12px_30px_rgba(220,38,38,0.25)] hover:border-red-500/50 hover:text-red-600 active:scale-95 group/top font-['Questrial',sans-serif] text-sm font-medium cursor-pointer">
    <svg class="w-4 h-4 transition-transform duration-300 group-hover/top:-translate-y-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
    <span>Top</span>
</button>

<!-- Interactive Hover Expandable Floating Action Button (FAB / Speed Dial - Right Side) -->
<div id="gat-fab-container"
    class="group/fab fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-50 font-['Questrial',sans-serif]">

    <!-- Speed Dial Action Items (Muncul ke atas saat tombol di-hover) -->
    <div id="gat-fab-menu"
        class="absolute bottom-full right-0 pb-3.5 flex flex-col items-end gap-3 transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] opacity-0 translate-y-4 invisible pointer-events-none scale-90 group-hover/fab:opacity-100 group-hover/fab:translate-y-0 group-hover/fab:visible group-hover/fab:pointer-events-auto group-hover/fab:scale-100">

        <!-- 4. Scroll To Top -->
        <button type="button" onclick="gatScrollToTop()"
            class="group/item flex items-center gap-3 transition-transform duration-200 hover:scale-105 focus:outline-none cursor-pointer">
            <span
                class="px-3.5 py-1.5 text-xs sm:text-sm font-normal text-white bg-[#111215] border border-neutral-700/60 rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.35)] opacity-0 group-hover/item:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none">
                Scroll To Top
            </span>
            <div
                class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-gray-900 shadow-[0_8px_20px_rgba(0,0,0,0.12)] border border-gray-100 flex items-center justify-center hover:bg-red-600 hover:text-white hover:border-red-500 transition-all duration-300">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </div>
        </button>

        <!-- 3. Email Us -->
        <a href="mailto:admin@gat-aspect.com"
            class="group/item flex items-center gap-3 transition-transform duration-200 hover:scale-105 focus:outline-none">
            <span
                class="px-3.5 py-1.5 text-xs sm:text-sm font-normal text-white bg-[#111215] border border-neutral-700/60 rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.35)] opacity-0 group-hover/item:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none">
                Email Us
            </span>
            <div
                class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-red-600 shadow-[0_8px_20px_rgba(0,0,0,0.12)] border border-gray-100 flex items-center justify-center hover:bg-black hover:text-white hover:border-neutral-800 transition-all duration-300">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        </a>

        <!-- 2. LinkedIn -->
        <a href="https://www.linkedin.com/in/gat-aspect/" target="_blank" rel="noopener noreferrer"
            class="group/item flex items-center gap-3 transition-transform duration-200 hover:scale-105 focus:outline-none">
            <span
                class="px-3.5 py-1.5 text-xs sm:text-sm font-normal text-white bg-[#111215] border border-neutral-700/60 rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.35)] opacity-0 group-hover/item:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none">
                LinkedIn
            </span>
            <div
                class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-[#0A66C2] shadow-[0_8px_20px_rgba(0,0,0,0.12)] border border-gray-100 flex items-center justify-center hover:bg-black hover:text-white hover:border-neutral-800 transition-all duration-300">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
            </div>
        </a>

        <!-- 1. WhatsApp -->
        <a href="https://wa.me/6285280002573" target="_blank" rel="noopener noreferrer"
            class="group/item flex items-center gap-3 transition-transform duration-200 hover:scale-105 focus:outline-none">
            <span
                class="px-3.5 py-1.5 text-xs sm:text-sm font-normal text-white bg-[#111215] border border-neutral-700/60 rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.35)] opacity-0 group-hover/item:opacity-100 transition-opacity duration-200 whitespace-nowrap pointer-events-none">
                WhatsApp
            </span>
            <div
                class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-[#25D366] shadow-[0_8px_20px_rgba(0,0,0,0.12)] border border-gray-100 flex items-center justify-center hover:bg-black hover:text-white hover:border-neutral-800 transition-all duration-300">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </div>
        </a>

    </div>

    <!-- Main FAB Trigger Button -->
    <div id="gat-fab-toggle" role="button" tabindex="0" aria-label="Quick Contact Menu"
        class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white shadow-[0_8px_25px_rgba(220,38,38,0.45)] flex items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer focus:outline-none">

        <!-- Rotating Plus Icon (+ to x upon hover) -->
        <svg id="gat-fab-icon"
            class="w-7 h-7 sm:w-8 sm:h-8 transition-transform duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform group-hover/fab:rotate-45"
            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
        </svg>
    </div>
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
            menu.classList.remove('opacity-0', 'translate-y-4', 'invisible', 'pointer-events-none', 'scale-90');
            menu.classList.add('opacity-100', 'translate-y-0', 'visible', 'pointer-events-auto', 'scale-100');
            icon.classList.add('rotate-45');
        }

        function closeMenu() {
            if (closeTimeout) clearTimeout(closeTimeout);
            closeTimeout = setTimeout(() => {
                menu.classList.remove('opacity-100', 'translate-y-0', 'visible', 'pointer-events-auto', 'scale-100');
                menu.classList.add('opacity-0', 'translate-y-4', 'invisible', 'pointer-events-none', 'scale-90');
                icon.classList.remove('rotate-45');
            }, 150);
        }

        // Hover handling - strictly when hovering over the container (which only occupies the button when closed)
        container.addEventListener('mouseenter', openMenu);
        container.addEventListener('mouseleave', closeMenu);

        // Mobile / Touch Tap toggle
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (menu.classList.contains('pointer-events-none') || menu.classList.contains('invisible') || menu.classList.contains('opacity-0')) {
                openMenu();
            } else {
                closeMenu();
            }
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                closeMenu();
            }
        });
    })();
</script>
