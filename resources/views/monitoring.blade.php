<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring System</title>

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
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-8">MONITORING SYSTEM</h2>
            <h2 class="text-2xl font-bold font-['Libre_Baskerville'] mb-8">What is a Monitoring System?</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                Monitoring System is an integrated system that functions to monitor, supervise, and control various processes, devices, or certain conditions in real-time. The main purpose of this system is to ensure that all components and processes being monitored are in optimal condition and in accordance with established standards. This system works by collecting data from various sources, analyzing it using certain algorithms or software, and providing warnings or notifications if anomalies or deviations are detected that could potentially cause problems.
            </p>
        </div>
        
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0">
            <img src="{{ asset('storage/Monitoring.avif') }}" alt="Monitoring Image" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="text-center bg-white text-[#1B1B1B] py-16">
    <div class="container mx-auto px-8">
        <h2 class="text-3xl md:text-2xl font-['Poppins'] text-black">
            Development of the Andon “Monitoring” system integrated with Internet of Things (IoT) technology to monitor, control, and optimize production or operational processes in industrial environments.
        </h2>

        <!-- Feature Cards -->
        <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
            <!-- Card 1 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/moni1.jpg') }}" alt="Manufacturing Factory" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Manufacturing Factory</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Implementing an Andon system connected to sensors in the production line to detect disruptions or problems in production. Information about the problem will be uploaded to the cloud and can be accessed by management and employees on various devices, such as information boards, mobile applications, or computers.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/moni2.jpg') }}" alt="Quality Control" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Quality Control</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Image of Andon system connected to testing devices or sensor quality to detect defective or substandard products. When a defective product is detected, the system will notify the operator or supervisor to take corrective or handling actions.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/moni3.jpg') }}" alt="Energy Efficiency" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Energy Efficiency</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Using Andon system connected with energy sensors to monitor and manage energy consumption in industrial facilities. Information about energy usage will be presented in the form of graphs and reports that help management identify energy-saving opportunities.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job & Description Section -->
<section class="text-center bg-[#1b1b1b] text-white py-16">
    <div class="container mx-auto px-8">
        <h2 class="text-3xl md:text-4xl font-bold font-['Poppins']">JOB & DESC</h2>
        <div class="w-16 h-[2px] bg-white mx-auto my-2"></div>
    </div>
</section>

<!-- Job 1 -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">DOWNTIME MONITORING SYSTEM</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                A system used to monitor and track downtime or lost operational time on machinery, equipment, or production lines in an industrial facility.
            </p>

            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                This system allows operators or managers to understand and analyze how often and how long downtime occurs, as well as the root causes of downtime.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/moni4.webp') }}" alt="Downtime Monitoring" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
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
