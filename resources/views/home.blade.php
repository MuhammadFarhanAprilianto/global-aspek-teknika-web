<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Aspek Teknologi</title>

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


<!-- Swiper Slider -->
<div class="swiper mySwiper mt-8">
    <div class="swiper-wrapper">
        <!-- Slide 1 with Dark Overlay -->
        <div class="swiper-slide relative mt-20">
            <img src="{{ asset('storage/Swipper 1.png') }}" alt="Pict 1" class="w-full h-auto md:h-screen object-cover">
            <div class="absolute inset-0 bg-black/80"></div>
            <div class="absolute inset-0 flex flex-col md:flex-row items-center px-6 md:px-10 text-white">
                <div class="w-full md:w-1/2 text-center md:text-left mt-4">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-['Libre_Baskerville'] leading-tight">Digital Automation Innovation</h1>
                    <p class="text-base md:text-lg lg:text-xl mt-2 opacity-80 font-['Syne']">Innovation in Automation and Software Development for Your Business</p>
                </div>
                <div class="hidden md:flex w-1/2 justify-center md:justify-end">
                    <img src="{{ asset('storage/PictLaptop.png') }}" class="max-w-xs md:max-w-lg lg:max-w-2xl scale-100 md:scale-110 ml-0 md:ml-10">
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="swiper-slide relative mt-20">
            <img src="{{ asset('storage/Swipper 2.png') }}" alt="Pict 2" class="w-full h-auto md:h-screen object-cover">
            <div class="absolute inset-0 bg-black/80"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white px-6 md:px-10">
                <div class="w-full md:w-3/4 text-center">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-['Libre_Baskerville'] leading-tight">Internet of Things (IoT)</h1>
                    <p class="text-sm md:text-lg lg:text-xl mt-2 opacity-80">The Internet of Things (IoT) is a technological concept in which physical objects are embedded with sensors, software, and other technologies...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 1 -->
<section class="relative flex items-center bg-[#1B1B1B] text-white py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-10">
        <!-- Text Section -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h6 class="text-xl font-['Syne'] mb-4 text-red-600">We Are The Solution Partner In Automation Industry</h6>
            <h2 class="text-5xl font-bold font-['Libre_Baskerville'] mb-8">Welcome to the Industry 4.0 revolution</h2>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                PT. Global Aspect Technology, founded in 2017, specializes in providing integrated systems for both the manufacturing and non-industrial sectors, serving businesses of all sizes. We are committed to delivering optimal solutions tailored to our clients' needs in system automation, software development, monitoring, and control, prioritizing efficiency, reliability, and innovation.
            </p>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                As Industry 4.0 revolutionizes the manufacturing landscape, we empower businesses to harness the potential of cutting-edge technologies such as the Internet of Things (IoT), cloud computing, artificial intelligence (AI), and machine learning. By integrating these technologies into production facilities and business operations, we help companies streamline processes, enhance decision-making, improve productivity, and reduce operating costs. Our solutions drive smart manufacturing, enabling real-time data collection, advanced analytics, and automation, transforming factories into intelligent, self-optimizing systems.
            </p>
            <p class="text-lg leading-relaxed font-['Syne'] opacity-80 text-justify mb-6">
                In a rapidly evolving digital landscape, we understand the pressure businesses face to stay competitive. We work closely with our clients to implement systems that not only increase operational efficiency but also provide the agility to adapt to market changes and future technological advancements. Our expertise in automation and system integration ensures that our clients remain at the forefront of innovation, unlocking new opportunities for growth, sustainability, and long-term success.
            </p>
        </div>
        
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0">
            <img src="{{ asset('storage/Teknisi PLC.jpg') }}" alt="About Us Image" class="w-full h-auto object-cover scale-120 md:scale-75 md:translate-x-10 rounded-lg">
        </div>
    </div>
</section>

<!-- Section 2 -->
<section class="text-center bg-[#FFFAFA] text-[#1B1B1B] py-16">
    <div class="container mx-auto px-8">
        <h2 class="text-3xl md:text-4xl font-bold font-['Poppins'] text-black">Providing Professional And Reliable Solutions For Various Industry</h2>
        <div class="w-16 h-[2px] bg-black mx-auto my-2"></div>
        <p class="text-lg text-black-300 mt-4 font-['Syne']">
            PT. Global Aspect Technology, established in 2017, focuses on providing integrated system solutions for manufacturing and non-industrial industries, both large and small scale. We provide and prioritize the best solutions to meet client needs in system automation, software development, monitoring, and control. With continuous innovation, we are committed to improving productivity and reliability, taking the industry to a higher level through advanced technology solutions.
        </p>
    </div>
</section>

<!-- Section 3 -->
<section class="flex items-center min-h-[80vh] bg-[#1B1B1B] text-white py-10">
    <div class="container mx-auto flex flex-col md:flex-row items-center mt-6">
        <div class="w-full md:w-1/2">
            <img src="{{ asset('storage/modul2.webp') }}" alt="Industrial Product" class="w-full scale-100 max-w-3xl rounded-lg">
        </div>
        <div class="w-full md:w-1/2 px-10 mt-8 mb-4">
            <h1 class="text-5xl md:text-6xl font-bold font-['Libre_Baskerville'] leading-tight">Elevating the <br> Industrial Experience</h1>
            <p class="text-lg text-gray-300 mt-4 font-['Syne']">Empowering Businesses with Innovative Technology and Seamless Integration</p>
            <button class="mt-6 px-6 py-3 bg-white text-black text-lg font-semibold rounded-full shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                <a href="{{ route('about') }}">Explore Our About Us</a>
            </button>
        </div>
    </div>
</section>

<!-- Section 4 -->
<section class="bg-white text-black py-16">
    <div class="container mx-auto px-6 lg:px-12 font-['Libre_Baskerville']">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-black">
            <div>
                <h2 class="text-2xl font-semibold text-black">Advancing the Industrial Frontier</h2>
                <p class="mt-2 opacity-80 font-['Poppins']">Pioneering Integrated Solutions for a Sustainable Industrial Future</p>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-black">Empowering the Industrial Revolution 4</h2>
                <p class="mt-2 opacity-80 font-['Poppins']">Redefining the Boundaries of Industrial Automation: Integrated Systems for a Connected World</p>
            </div>
        </div>

        <div class="mt-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center font-['Libre_Baskerville']">
            <div>
                <img src="{{ asset('storage/Monitoring(3).jpeg') }}" alt="Industrial Robot" class="w-full rounded-lg">
            </div>
            <div>
                <h2 class="text-3xl font-semibold text-black">Amplifying Industrial Potential</h2>
                <div class="mt-6 space-y-6 text-black">
                    <div>
                        <h3 class="text-lg font-semibold text-black">Powering Innovation</h3>
                        <p class="mt-1 opacity-80 font-['Poppins']">Unlocking the Full Potential of Integrated Systems: Streamlining Industrial Processes</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-black">Bridging the Future</h3>
                        <p class="mt-1 opacity-80 font-['Poppins']">Transforming Industrial Landscapes: Integrated Solutions for Unparalleled Efficiency, Productivity, and Sustainability</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-black">Synergy at its Finest</h3>
                        <p class="mt-1 opacity-80 font-['Poppins']">Harnessing the Power of Integration: Automated Solutions for the Industrial Visionaries</p>
                    </div>
                </div>
                <button class="mt-8 px-6 py-3 bg-white text-black text-lg font-semibold rounded-full shadow-lg hover:bg-gray-300 transition font-['Poppins']">
                    <a href="{{ route('solution') }}">Embrace the Future, Today</a>
                </button>
            </div>
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
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
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
