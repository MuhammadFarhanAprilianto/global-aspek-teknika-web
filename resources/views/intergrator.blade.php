<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrator System</title>

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
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-8">Integrator System</h2>
            <h2 class="text-2xl font-bold font-['Libre_Baskerville'] mb-8">What is an Integrator System?</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                A System Integrator is an individual or company that has expertise in combining various components of an information technology system—such as hardware, software, and networks—into a single system that functions comprehensively and efficiently. The main goal is to ensure that the various subsystems can work together to meet the needs and business objectives of the organization.
            </p>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                In practice, a system integrator will design, implement, and manage effective system integration, including conducting needs analysis, planning, and maintaining the integrated system.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0">
            <img src="{{ asset('storage/inter6.jpg') }}" alt="Integrator System Image" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="text-center bg-white text-[#1B1B1B] py-16">
    <div class="container mx-auto px-8">
        <h2 class="text-3xl md:text-2xl font-['Poppins'] text-black">
            Can work in various industries and engineering fields, such as Information Technology, Manufacturing, Industrial Automation, Transportation, Smart Buildings, IoT, and many more.
        </h2>

        <!-- Feature Cards -->
        <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
            <!-- Card 1 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/inter1.webp') }}" alt="Smart Building System" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Smart Building System</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Designing and integrating smart systems in buildings, such as automatic lighting systems, temperature control, door access security, and energy management connected to the Internet of Things.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/inter2.webp') }}" alt="Industrial Automation" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Industrial Automation</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Integrating automation systems into a factory or industrial facility environment, such as PLC control systems, sensor monitoring, and machine tools to improve efficiency and productivity.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/Teknisi PLC.jpg') }}" alt="Remote Monitoring System" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Remote Monitoring System</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        Building remote monitoring systems for various devices and sensors in the field, such as industrial surveillance equipment, agricultural gardens, or critical infrastructure.
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
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">DIGITALIZATION WAREHOUSE MANAGEMENT</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                Transforming traditional warehouses into technology-based environments using software and digital solutions. The goal is to improve efficiency, accuracy, and visibility in managing inventory and optimizing the overall warehouse operational process.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/inter3.jpg') }}" alt="Warehouse Management" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Job 2 -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/inter4.jpg') }}" alt="Cloud-Based Temperature Monitoring" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>

        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-right">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">CLOUD BASED TEMPERATURE MONITORING</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                Using internet-connected temperature sensors to monitor temperature in real-time and send the data to a cloud platform. This enables remote monitoring, and can be applied in a variety of contexts such as server rooms, and industrial environments.
            </p>
        </div>
    </div>
</section>

<!-- Job 3 -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">SAFETY SENSOR</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                Implementation of sensor technology to detect potential hazards in the work environment. The goal is to improve safety by identifying high-risk situations and taking preventive or warning actions to prevent injury or accidents. Examples of sensor inclusions include motion detection.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/inter5.jpg') }}" alt="Safety Sensor" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
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
