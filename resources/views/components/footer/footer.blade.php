<footer class="bg-[#1b1b1b] text-white p-6">
  <div class="flex flex-col md:flex-row justify-between items-center">
    <!-- Logo -->
    <div class="mb-4 md:mb-0">
      <img src="{{ asset('storage/Logo_Perusahaan(1).png') }}" alt="Global Aspect" class="h-12">
    </div>

    <!-- Links -->
    <div class="mb-4 md:mb-0">
      <ul class="flex flex-col md:flex-row space-y-2 md:space-x-6 md:space-y-0 text-center md:text-left">
        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
        <li><a href="{{ route('product') }}" class="hover:text-white">Products</a></li>
        <li><a href="{{ route('solution') }}" class="hover:text-white">Solution</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact Us</a></li>
      </ul>
    </div>

    <!-- Connect -->
    <div>
      <a href="https://www.linkedin.com/in/gat-aspect/" class="text-white hover:underline">LinkedIn</a>
    </div>
  </div>
</footer>
