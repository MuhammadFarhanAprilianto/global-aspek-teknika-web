<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLC - Programming</title>

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
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-8">PLC - Programming</h2>
            <h2 class="text-2xl font-bold font-['Libre_Baskerville'] mb-8">What is a PLC (Programmable Logic Controller)?</h2>

            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                PLC is an electronic hardware that can be programmed to automatically regulate and control various processes in the industrial world. Basically, PLC functions as the "brain" of an automatic control system, processing data received through input, and producing output that will control machines or other equipment in the industrial process.
            </p>

            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                In other words, PLC is an industrial computer optimized to control and monitor industrial processes that require real-time control and durability in harsh environments. PLCs are commonly used in factories, industrial machinery, and various other automation applications.
            </p>
        </div>
        
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0">
            <img src="{{ asset('storage/Teknisi PLC.jpg') }}" alt="PLC Image" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Solution Section -->
<section class="text-center bg-white text-[#1B1B1B] py-16">
    <div class="container mx-auto px-8">
        <h2 class="text-3xl md:text-2xl font-['Poppins'] text-black">
            Involves Development, Coding, And Maintenance Of PLC Programs. We Also Partner With Mitsubishi, Keyence, Omron, Siemens, Allan Bradley, And Others.
        </h2>

        <!-- Solution Cards -->
        <div class="flex flex-wrap justify-center items-start gap-8 mt-8">
            <!-- Card 1 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/Develop.jpg') }}" alt="Develop New Program PLC" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Develop New Program PLC</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        We provide automation solutions tailored to your company's specific needs. We bring the latest technological innovations to design and develop efficient, intelligent and safe PLC programs.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/editProgram.png') }}" alt="Edit Existing Program" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Edit Existing Program</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        If you need help editing or enhancing an existing program, our team will provide the right solution for your needs. With our experience and expertise in PLC programming, we are ready to ensure that your program runs optimally and efficiently.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="w-full sm:w-1/3 md:w-1/4 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('storage/troubleshoot.webp') }}" alt="Troubleshoot Program PLC" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold text-black">Troubleshoot Program PLC</h3>
                    <p class="text-gray-700 mt-4 text-justify">
                        We are a reliable PLC troubleshooting service provider to solve problems in industrial automation systems. With a team of experienced experts, we are ready to identify and fix operational disruptions quickly and efficiently. We focus on customer satisfaction with timely solutions, reducing production downtime and increasing productivity.
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
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">MODIFICATION PROGRAM SERVO</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                Project for adding "Moving" servo to the Packaging aging machine, there is a barcode scanner that can move 3-Axis reading, there is a development request for additional movement from the servo so that it can move to the fourth position.
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/plc5.jpg') }}" alt="Servo Modification" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Job 2 -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/plc1.jpg') }}" alt="Built-in PLC Programming" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>

        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-right">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">BUILT-IN PROGRAMMING PLC</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                We have developed a sophisticated digitalization management system to monitor products efficiently. By embedding a unique QR Code on each product. We use scanners to collect important data such as Production date, Production line, Batch number, and others.
            </p>
        </div>
    </div>
</section>

<!-- Job 3 -->
<section class="relative flex items-center bg-white text-[#1b1b1b] py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-4">MODIFICATION PROGRAM MACHINE FILLING</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-4">
                Imagine a situation where product filling using a forward nozzle resulted in an unrecoverable product filling, which caused 36 days of downtime. In just two days, we were able to provide a solution to overcome this challenge. Want to know how our rapid transformation was done?
            </p>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-6 md:mt-0">
            <img src="{{ asset('storage/about3.jpg') }}" alt="Machine Filling Modification" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
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
