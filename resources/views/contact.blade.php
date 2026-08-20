<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GAT</title>

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600&display=swap">
</head>

<body>

    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- Contact Us Section -->
    <section class="bg-[#FFF8F8] text-[#1B1B1B] py-16">
        <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center gap-12">
            <!-- Form -->
            <div class="w-full lg:w-1/2">
                <h2 class="text-4xl font-bold mb-6">Contact Us</h2>
                <form action="{{ route('contact') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Name" class="w-full p-3 border rounded-md focus:border-black" required>
                    <input type="email" name="email" placeholder="Email" class="w-full p-3 border rounded-md focus:border-black" required>
                    <textarea name="message" rows="5" placeholder="Write Your Message" class="w-full p-3 border rounded-md focus:border-black" required></textarea>
                    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition">Send Message</button>
                </form>
            </div>

            <!-- Image -->
            <div class="w-full lg:w-1/2 flex justify-center mt-36">
                <img src="{{ asset('storage/gedung1.jpg') }}" alt="Contact Us" class="w-3/4 md:w-2/3 rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Contact Us Title Section -->
    <section class="text-center bg-[#1b1b1b] text-white py-16">
        <h2 class="text-3xl md:text-4xl font-bold font-['Poppins']">CONTACT US</h2>
        <div class="w-16 h-[2px] bg-white mx-auto my-2"></div>
    </section>

    <!-- Address & Email Section -->
    <section class="text-center bg-[#FFFAFA] text-[#1B1B1B] py-16">
        <div class="container mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-center items-start md:items-center gap-12 mt-8">
                <!-- Address -->
                <div class="w-full md:w-2/4 font-['Poppins']">
                    <h3 class="text-2xl font-bold text-black">ADDRESS</h3>
                    <h4 class="font-semibold">Head Office</h4>
                    <p class="text-lg text-gray-700 mt-4">
                        Cibis Nine Building floor 11 TB Simatupang Street, Pasar Minggu Jakarta South, 12560
                    </p>
                    <h4 class="font-semibold">WorkShop</h4>
                    <p class="text-lg text-gray-700 mt-4">
                        Cibubur Country, komplek RFP I No.6, Cikeas Udik, Kec. Gn. Putri, Kabupaten Bogor, Jawa Barat 16966
                    </p>
                </div>

                <!-- Email -->
                <div class="w-full md:w-2/4 font-['Poppins']">
                    <h3 class="text-2xl font-bold text-black">EMAIL</h3>
                    <a href="mailto:admin@gat-aspect.com" class="hover:text-blue-500 text-lg text-gray-700 mt-4">admin@gat-aspect.com</a>
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
