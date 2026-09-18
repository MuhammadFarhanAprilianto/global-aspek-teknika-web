<footer class="w-full bg-white text-gray-900 border-t border-gray-200/80 font-['Questrial',sans-serif]">
  <div class="container mx-auto px-6 sm:px-10 lg:px-16 py-8 sm:py-10">

    <!-- Mobile Layout (< md): Modern Agency Style -->
    <div class="flex flex-col md:hidden items-center text-center space-y-6">
      <!-- 1. Top: Logo & Brief Subtitle -->
      <div class="flex flex-col items-center gap-2">
        <a href="{{ route('home') }}" class="inline-flex items-center" title="PT. Global Aspect Technology">
          <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT. Global Aspect Technology" class="h-9 w-auto object-contain">
        </a>
        <p class="text-xs text-gray-500 max-w-xs font-['Questrial',sans-serif] leading-relaxed">
          Integrated Automation, Vision Inspection &amp; IoT Systems
        </p>
      </div>

      <!-- 2. Middle: Navigation Links in Clean 2-Column Grid -->
      <div class="w-full max-w-xs px-2 py-3 bg-gray-50/70 border border-gray-100 rounded-2xl">
        <div class="grid grid-cols-2 gap-y-2.5 gap-x-4 text-xs font-medium text-gray-700">
          <div class="flex flex-col items-start pl-4 space-y-2 text-left">
            <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Home</a>
            <a href="{{ route('about') }}" class="hover:text-red-600 transition-colors">About Us</a>
            <a href="{{ route('product') }}" class="hover:text-red-600 transition-colors">Products</a>
          </div>
          <div class="flex flex-col items-start pl-2 space-y-2 text-left">
            <a href="{{ route('solution') }}" class="hover:text-red-600 transition-colors">Solutions</a>
            <a href="{{ route('contact') }}" class="hover:text-red-600 transition-colors">Contact Us</a>
          </div>
        </div>
      </div>

      <!-- 3. Connect: LinkedIn Action Pill -->
      <div class="flex items-center justify-center">
        <a href="https://www.linkedin.com/in/gat-aspect/" target="_blank" rel="noopener noreferrer" 
          class="inline-flex items-center gap-2 px-4 py-2 bg-neutral-900 text-white hover:bg-red-600 rounded-full text-xs font-medium transition-colors shadow-xs">
          <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
          </svg>
          <span>Connect on LinkedIn</span>
        </a>
      </div>

      <!-- 4. Bottom: Copyright -->
      <div class="pt-2 border-t border-gray-100 w-full text-center">
        <p class="text-[11px] text-gray-400">
          &copy; {{ date('Y') }} PT. Global Aspect Technology. All rights reserved.
        </p>
      </div>
    </div>

    <!-- Desktop / Tablet Layout (>= md): Horizontal Bar -->
    <div class="hidden md:flex flex-row justify-between items-center gap-6">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="{{ route('home') }}" class="inline-flex items-center" title="PT. Global Aspect Technology">
          <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT. Global Aspect Technology" class="h-11 lg:h-12 w-auto object-contain">
        </a>
      </div>

      <!-- Links -->
      <div>
        <ul class="flex items-center gap-6 lg:gap-10 text-base lg:text-[18px] font-normal text-gray-700">
          <li><a href="{{ route('home') }}" class="hover:text-red-600 transition-colors duration-200">Home</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-red-600 transition-colors duration-200">About Us</a></li>
          <li><a href="{{ route('product') }}" class="hover:text-red-600 transition-colors duration-200">Products</a></li>
          <li><a href="{{ route('solution') }}" class="hover:text-red-600 transition-colors duration-200">Solution</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-red-600 transition-colors duration-200">Contact Us</a></li>
        </ul>
      </div>

      <!-- Connect -->
      <div class="flex items-center">
        <a href="https://www.linkedin.com/in/gat-aspect/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-base lg:text-[18px] font-normal text-gray-700 hover:text-red-600 transition-colors duration-200">
          <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
          </svg>
          <span>LinkedIn</span>
        </a>
      </div>
    </div>

  </div>
</footer>
