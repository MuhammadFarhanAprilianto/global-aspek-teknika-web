<nav class="bg-white py-3 shadow-md fixed top-0 w-full z-50">
    <div class="container mx-auto flex flex-wrap items-center justify-between px-4 md:px-6">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <img src="{{ asset('storage/Logo-Perusahaan.jpg') }}" alt="Global Aspect" class="h-16 w-auto md:h-20">
        </div>

        <!-- Hamburger Menu Button -->
        <button id="menu-toggle" class="md:hidden text-black focus:outline-none">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Navigation Menu -->
        <div class="hidden md:flex flex-wrap items-center justify-center space-x-6 lg:space-x-16 flex-1 text-base lg:text-xl font-syne">
            <a href="{{ route('home') }}" class="text-black hover:text-blue-500">Home</a>
            <a href="{{ route('about') }}" class="text-black hover:text-blue-500">About Us</a>
            <a href="{{ route('solution') }}" class="text-black hover:text-blue-500">Solution</a>
            <a href="{{ route('contact') }}" class="text-black hover:text-blue-500">Contact Us</a>
        </div>

        <!-- Button -->
        <div class="hidden md:block">
            <a href="{{ route('contact') }}">
                <button class="px-4 py-2 lg:px-6 lg:py-3 bg-black text-white text-sm lg:text-base font-semibold rounded-full shadow-lg hover:bg-gray-300 hover:text-black transition">
                    Get A Quote
                </button>
            </a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-black text-white flex flex-col items-start p-6 hidden z-40">
        <button id="menu-close" class="absolute top-4 right-4 text-white">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <a href="{{ route('home') }}" class="block py-3 text-lg">Home</a>
        <a href="{{ route('about') }}" class="block py-3 text-lg">About Us</a>
        <a href="{{ route('solution') }}" class="block py-3 text-lg">Solution</a>
        <a href="{{ route('contact') }}" class="block py-3 text-lg">Contact Us</a>

        <!-- Get A Quote Button in Mobile Menu -->
        <div class="mt-4">
            <a href="{{ route('contact') }}">
                <button class="px-6 py-3 bg-white text-black text-lg font-semibold rounded-full shadow-lg hover:bg-gray-300 transition">
                    Get A Quote
                </button>
            </a>
        </div>
    </div>
</nav>


<script>
    // JavaScript to toggle dropdown visibility
    document.getElementById('language-dropdown').addEventListener('click', function() {
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });
</script>
