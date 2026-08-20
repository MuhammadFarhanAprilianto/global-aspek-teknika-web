<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution - GAT</title>

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

<!-- Hero Section (Service Overview) -->
<section class="relative bg-black text-white text-center py-48">
    <div class="absolute inset-0">
        <img src="{{ asset('storage/Laptop7.jpg') }}" alt="Company Background" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div class="relative z-10 text-center px-6 md:px-12">
        <h1 class="text-3xl md:text-[4rem] font-bold uppercase font-['Poppins']">Service</h1>
        <div class="w-20 h-1 bg-red-500 mx-auto mt-4"></div>
        <p class="text-sm md:text-base leading-relaxed font-['Poppins'] max-w-3xl mx-auto text-center md:text-justify mt-6 md:mt-8">
            PT. Global Aspect Technology is a company founded in 2017 that focuses on providing integrated 
            systems for both manufacturing and non-industrial industries, catering to businesses of all sizes. 
            We deliver and prioritize the best solutions for clients' needs in system automation, software 
            development, monitoring, and control.
        </p>        
    </div>
</section>

<!-- Portfolio Section -->
<section class="container mx-auto px-6 py-12">
    <h2 class="text-[2rem] font-bold uppercase font-['Poppins'] text-center mb-6">Solution</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Solution 1 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/plc.jpg') }}" alt="PLC Programming" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">PLC Programming</h2>
            <p class="mt-2 text-justify">Involves developing, coding and maintaining PLC programs. We also partner with Mitsubishi, Keyence, Omron, Siemens, Allan Bradley and others.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('plc-progamming') }}">Click Here</a>
            </button>
        </div>

        <!-- Solution 2 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/Inspect.jpeg') }}" alt="Inspection & Record Data System" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Inspection & Record Data System</h2>
            <p class="mt-2 text-justify">Using a visual camera to sort products that do not match the batch, with a very high machine speed (800pcs/minute) this system can help in the Quality Control (QC) process so that it is more effective.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('inspection') }}">Click Here</a>
            </button>
        </div>

        <!-- Solution 3 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/Monitoring.avif') }}" alt="Monitoring System" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Monitoring System</h2>
            <p class="mt-2 text-justify">Development of an Andon “Monitoring” system integrated with Internet of Things (IoT) technology to monitor, control, and optimize production or operational processes in industrial environments.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('monitoring') }}">Click Here</a>
            </button>
        </div>

        <!-- Solution 4 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/inter6.jpg') }}" alt="Integrator System" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Integrator System</h2>
            <p class="mt-2 text-justify">Can work in various industries and engineering fields, such as Information Technology, Manufacturing, Industrial Automation, Transportation, Smart Buildings, IoT, and many more.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('intergrator') }}">Click Here</a>
            </button>
        </div>

        <!-- Solution 5 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/laser4.webp') }}" alt="Laser Marking & Inkjet Printing" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Laser Marking & Inkjet Printing</h2>
            <p class="mt-2 text-justify">Laser Marking, is a device that uses a laser beam to create permanent marks or markings on the surface of various materials. Inkjet Printing, is a device that uses ink spray technology to print text, images, or codes on the surface of various materials.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('laser-marking') }}">Click Here</a>
            </button>
        </div>

        <!-- Solution 6 -->
        <div class="p-6 border border-gray-300 shadow-md rounded-lg">
            <img src="{{ asset('storage/strapping.webp') }}" alt="Laser Marking & Inkjet Printing" class="w-full h-48 object-cover rounded-md mb-4">
            <h2 class="text-[2rem] text-black-600 font-['Poppins'] font-extrabold">Strapping</h2>
            <p class="mt-2 text-justify">Strapping in automation machinery refers to the process of binding or sealing products using a binding material (usually plastic tape or metal tape) to ensure the product remains securely bound during transportation or storage.</p>
            <button class="mt-6 px-6 py-3 bg-[#21C45C] text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('strapping') }}">Click Here</a>
            </button>
        </div>

    </div>
</section>

<!-- Our Client Section -->
<!-- Our Client Section -->
<section class="bg-[#1b1b1b] text-white py-24">
    <div class="container mx-auto px-6">
        <!-- Our Client -->
        <div class="text-center">
            <h2 class="text-3xl font-bold uppercase font-['Poppins']">Our Client</h2>
            <div class="w-16 h-[2px] bg-white mx-auto my-2"></div>

            <!-- Swiper for Grid 4 Logos -->
            <div class="swiper mySwiper mt-6">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/akasha.png') }}" alt="Client 1" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/cni.jpeg') }}" alt="Client 2" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/dankos.png') }}" alt="Client 3" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/dic.jpg') }}" alt="Client 4" class="h-20 object-contain">
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Hitachi.png') }}" alt="Client 5" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/HM sampoerna.png') }}" alt="Client 6" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/hokkan.png') }}" alt="Client 7" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/knauf.png') }}" alt="Client 8" class="h-20 object-contain">
                    </div>

                    <!-- Slide 3 (Add remaining logos) -->
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/komatsu.png') }}" alt="Client 9" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Logo Federal Oil.png') }}" alt="Client 10" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Logo-ACTAVIS.webp') }}" alt="Client 11" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/monier.jpeg') }}" alt="Client 12" class="h-20 object-contain">
                    </div>

                    <!-- Continue adding the remaining logos -->
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/OT_Logo.png') }}" alt="Client 13" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/pmi.png') }}" alt="Client 14" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Rayovac.png') }}" alt="Client 15" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/rejuve.png') }}" alt="Client 16" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/SGI.png') }}" alt="Client 17" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/SKL.jpg') }}" alt="Client 18" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Sumiden.png') }}" alt="Client 19" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/Syngenta.png') }}" alt="Client 20" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/TMS.png') }}" alt="Client 21" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/MC.jpg') }}" alt="Client 22" class="h-20 object-contain">
                    </div>
                    <div class="swiper-slide flex items-center justify-center bg-white p-6 border-4 border-gray-300 shadow-lg rounded-lg">
                        <img src="{{ asset('storage/logocus/MAM.jpg') }}" alt="Client 23" class="h-20 object-contain">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
@include('components.footer.footer')

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4, 
        spaceBetween: 20, 
        loop: true, 
        autoplay: {
            delay: 2000, 
            disableOnInteraction: false, 
        },
        navigation: {
            nextEl: ".swiper-button-next", 
            prevEl: ".swiper-button-prev", 
        },
        pagination: {
            el: ".swiper-pagination", 
            clickable: true, 
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
            }
        }
    });
</script>

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
