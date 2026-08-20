<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - GAT</title>

<!-- Favicon -->
<link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600&family=Syne:wght@400..800&family=Viga&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:wght@100;200;300;600&family=Viga&display=swap" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
@include('components.navbar.header')

<!-- Hero Section (Company Profile) -->
<section class="relative bg-black text-white text-center py-48">
    <div class="absolute inset-0 mt-20">
        <img src="{{ asset('storage/Laptop3.png') }}" alt="Company Background" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div class="relative z-10 text-center px-6 md:px-12">
        <h1 class="text-3xl md:text-[4rem] font-bold uppercase font-['Poppins']">Product</h1>
        <div class="w-20 h-1 bg-red-500 mx-auto mt-4"></div>     
    </div>
</section>

<!-- Product List -->
<section class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Kotak 1 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg text-center">
            <img src="{{ asset('storage/laptop6.jpg') }}" alt="Solution 1" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Nama Product</h2>
            <p class="mt-2 font-semibold">IPC is built-in 6 serial ports and two Ethernet ports...</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                Click Here
            </button>
        </div>
        <!-- Kotak 2 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg text-center">
            <img src="{{ asset('storage/laptop6.jpg') }}" alt="Solution 1" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Nama Product</h2>
            <p class="mt-2 font-semibold">IPC is built-in 6 serial ports and two Ethernet ports...</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                Click Here
            </button>
        </div>
        <!-- Kotak 3 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg text-center">
            <img src="{{ asset('storage/laptop6.jpg') }}" alt="Solution 1" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Nama Product</h2>
            <p class="mt-2 font-semibold">IPC is built-in 6 serial ports and two Ethernet ports...</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                Click Here
            </button>
        </div>
    </div>
</section>

    <!-- Footer --> 
    @include('components.footer.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!-- Floating Button 1 -->
<a href="https://wa.me/6285280002573" target="_blank" class="fixed bottom-24 right-6 z-50">
    <div class="w-16 h-16 bg-[#1BD742] rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition-transform duration-300">
        <img src="{{ asset('storage/WhatsappIcon.jpg') }}" alt="WhatsApp" class="w-10 h-10">
    </div>
</a>

<!-- JavaScript for Menu Toggle -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menuClose = document.getElementById('menu-close');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
    });
    
    menuClose.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });
</script>

</body>
</html>
