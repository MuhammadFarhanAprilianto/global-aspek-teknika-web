<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laser Marking & Inkjet Printing</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Poppins:wght@100;300;600&family=Viga&display=swap" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
@include('components.navbar.header')

<!-- Hero Section -->
<section class="relative bg-black text-white text-center py-48">
    <div class="absolute inset-0">
        <img src="{{ asset('storage/Laptop7.jpg') }}" alt="Company Background" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div class="relative z-10 text-center px-6 md:px-12">
        <h1 class="text-3xl md:text-[4rem] font-bold uppercase font-['Poppins'] mt-8">Service</h1>
        <div class="w-20 h-1 bg-red-500 mx-auto mt-4"></div>    
    </div>
</section>

<!-- Article Section -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-8">LASER MARKING & INKJET PRINTING</h2>
            <h2 class="text-2xl font-bold font-['Libre_Baskerville'] mb-8">What is Laser Marking & Inkjet Printing?</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                Laser marking is a device that uses a high-energy laser beam to create permanent marks or markings on the surface of various materials, such as metal, plastic, glass, and others, with a very high degree of accuracy, so it is often used in industry to mark serial numbers, barcodes, or product logos, which cannot fade or disappear over time.
            </p>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                Meanwhile, inkjet printing is a device that utilizes ink spray technology to print text, images, or codes on the surface of various materials, such as paper, cardboard, plastic, or metal, by spraying liquid or pigment-based ink through a small nozzle, which enables fast and flexible printing in various industrial applications such as packaging, printing, and marketing, and is suitable for short-term use or frequently updated information.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0">
            <img src="{{ asset('storage/laser1.webp') }}" alt="Laser Marking Image" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="text-center bg-[#FFFAFA] text-[#1B1B1B] py-16">
    <div class="container mx-auto px-8">
        <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
            <!-- Card 1 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/laser2.jpg') }}" alt="Laser Marking" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Laser Marking</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        It is a device that uses a laser beam to create permanent marks or markings on the surface of various materials. With high precision and efficient speed, this tool can be used in various industries to mark products, barcodes, logos, and other important information.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/laser3.jpg') }}" alt="Inkjet Printing" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Inkjet Printing</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        It is a device that uses ink spray technology to print text, images, or codes on the surface of various materials. In the process, ink is sprayed through a small nozzle at high speed, forming the desired character or image.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('components.footer.footer')

<!-- Floating Button -->
@include('components.button.button')

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
