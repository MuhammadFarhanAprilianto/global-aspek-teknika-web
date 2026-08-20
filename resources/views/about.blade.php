<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - GAT</title>

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
</head>
<body>
    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- Hero Section (Company Profile) -->
    <section class="relative bg-black text-white text-center py-48">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/Laptop2.png') }}" alt="Company Background" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
        <div class="relative z-10">
            <h1 class="text-5xl font-bold uppercase font-['Poppins']">Company Profile</h1>
            <div class="w-20 h-1 bg-red-500 mx-auto mt-2"></div>
        </div>
    </section>

    <!-- About Company Section -->
    <section class="bg-[#1b1b1b] text-gray-300 py-32">
        <div class="container mx-auto text-center px-6 lg:px-24">
            <h2 class="text-4xl font-bold text-white mb-8 font-['Libre_Baskerville']">About Company</h2>
            <p class="text-lg leading-relaxed font-['Poppins'] text-justify mb-6">
                PT Global Aspect Technology, established in 2017, is a company that focuses on providing integrated systems for various industries, both manufacturing and non-industrial, from small to large scale. Since our inception, we have been committed to providing the best and most innovative solutions to meet the needs of system automation, software development, monitoring, and control of production processes.
            </p>
            <p class="text-lg leading-relaxed font-['Poppins'] text-justify mb-6">
                We understand the importance of efficiency, productivity, and quality in every business process. Therefore, we put forward technology that is not only advanced, but also customizable to each client's specific needs. With extensive experience in various industrial sectors, we continue to innovate to provide timely, reliable, and cost-effective solutions.
            </p>
            <p class="text-lg leading-relaxed font-['Poppins'] text-justify mb-6">
                With a team of experienced professionals, PT Global Aspect Technology is ready to be your reliable partner in facing the challenges of an ever-evolving industry. We are committed to continuously innovate and adapt to market needs, ensuring every solution we offer has added value to your business.
            </p>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="text-center bg-[#FFFAFA] text-[#1B1B1B] py-16">
        <div class="container mx-auto px-8">
            <h2 class="text-3xl md:text-4xl font-bold font-['Poppins'] text-black">VISION & MISSION</h2>
            <div class="w-16 h-[2px] bg-black mx-auto my-2"></div>

            <div class="flex flex-col md:flex-row justify-center items-start md:items-center gap-12 mt-8">
                <!-- Vision -->
                <div class="w-full md:w-2/4 font-['Poppins']">
                    <h3 class="text-2xl font-bold text-black">VISION</h3>
                    <p class="text-lg text-gray-700 mt-4">
                        To become a trusted industrial system integration company in Indonesia and provide the best guarantee 
                        of every solution provided for consumer needs.
                    </p>
                </div>

                <!-- Mission -->
                <div class="w-full md:w-2/4 font-['Poppins']">
                    <h3 class="text-2xl font-bold text-black">MISSION</h3>
                    <p class="text-lg text-gray-700 mt-4">
                        Competence development of each of our employees, to always be able to provide services to consumer 
                        needs and provide the best after-sales support services to consumers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="text-center bg-[#FFFAFA] text-[#1B1B1B] py-16">
        <div class="container mx-auto px-8">
            <h2 class="text-3xl md:text-4xl font-bold font-['Poppins'] text-black">WHY CHOOSE US</h2>

            <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
                <!-- Card 1 -->
                <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                    <div class="w-full h-64 overflow-hidden">
                        <img src="{{ asset('storage/about7.jpg') }}" alt="Develop New Program PLC" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                    <div class="w-full h-64 overflow-hidden">
                        <img src="{{ asset('storage/about4.jpg') }}" alt="Edit Existing Program" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                    <div class="w-full h-64 overflow-hidden">
                        <img src="{{ asset('storage/about5.jpeg') }}" alt="Troubleshoot Program PLC" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- List Content Below the Images -->
            <div class="mt-8 text-center">
                <ul class="list-disc pl-8 space-y-4 inline-block text-left font-['Syne'] text-2xl">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
