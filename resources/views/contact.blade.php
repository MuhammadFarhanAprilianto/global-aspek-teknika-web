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

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>

    <style>
        .font-agrandir {
            font-family: 'Agrandir', sans-serif !important;
        }

        .font-questrial {
            font-family: 'Questrial', sans-serif !important;
        }

        body {
            font-family: 'Questrial', sans-serif;
            color: #1a1a1a;
            background-color: #ffffff;
        }

        /* Lenis Smooth Scroll System */
        html.lenis, html.lenis body {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }

        /* LabsStdio Agency Scroll Reveal Animation with Motion Blur */
        .reveal-on-scroll {
            opacity: 0;
            filter: blur(10px);
            transform: translateY(28px);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                        filter 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform, filter;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1 !important;
            filter: blur(0px) !important;
            transform: translateY(0) !important;
        }
        .reveal-stagger-1 { transition-delay: 0.08s; }
        .reveal-stagger-2 { transition-delay: 0.16s; }
        .reveal-stagger-3 { transition-delay: 0.24s; }
        .reveal-stagger-4 { transition-delay: 0.32s; }
        .reveal-stagger-5 { transition-delay: 0.40s; }
        .reveal-stagger-6 { transition-delay: 0.48s; }

        /* Custom styling for inputs */
        .contact-input {
            background-color: #f4f4f5;
            border: 1px solid transparent;
            border-radius: 1rem;
            padding: 0.95rem 1.25rem;
            font-size: 0.925rem;
            font-family: 'Questrial', sans-serif;
            color: #18181b;
            transition: all 0.2s ease-in-out;
            width: 100%;
        }

        .contact-input:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #18181b;
            box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.08);
        }

        .contact-input::placeholder {
            color: #a1a1aa;
        }

        .contact-label {
            font-family: 'Agrandir', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: #27272a;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full max-w-full font-questrial">

    <!-- Navbar -->
    @include('components.navbar.header')

    <!-- Main Contact Section -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <!-- Success Alert -->
            @if (session('success'))
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm animate-fade-in">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="font-questrial text-sm md:text-base">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm font-semibold">✕</button>
                </div>
            @endif

            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 md:mb-16 reveal-on-scroll">
                <div>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold font-agrandir tracking-tight text-[#111111] leading-none">
                        Contact Us
                    </h1>
                </div>
                <div class="lg:max-w-md">
                    <p class="text-gray-500 font-questrial text-sm md:text-base leading-relaxed">
                        Sampaikan kebutuhan sistem otomasi, vision inspection, atau integrasi industri Anda. Tim ahli kami siap memberikan solusi terbaik dalam 24 jam.
                    </p>
                </div>
            </div>

            <!-- Two-Column Layout (Form & Image Card) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">
                
                <!-- Left Column: Form -->
                <div class="lg:col-span-7 flex flex-col justify-between reveal-on-scroll reveal-stagger-1">
                    <form action="{{ route('contact') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Row 1: Name & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="contact-label">Name <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" placeholder="Your full name" class="contact-input" required value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-xs text-red-500 mt-1 block font-questrial">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="contact-label">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" placeholder="you@example.com" class="contact-input" required value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-xs text-red-500 mt-1 block font-questrial">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Row 2: Phone & Service Selection -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="contact-label">Phone Number</label>
                                <input type="tel" id="phone" name="phone" placeholder="+62 812 3456 7890" class="contact-input" value="{{ old('phone') }}">
                            </div>
                            <div>
                                <label class="contact-label">Select Inquiry / Service</label>
                                
                                <!-- Custom LabsStudio Style Dropdown -->
                                <div class="relative" id="custom-service-dropdown">
                                    <!-- Hidden Input for Form Submission -->
                                    <input type="hidden" name="service" id="service_input" value="{{ old('service', '') }}">

                                    <!-- Dropdown Trigger -->
                                    <button 
                                        type="button" 
                                        id="dropdown-trigger-btn"
                                        onclick="toggleCustomDropdown()" 
                                        class="contact-input flex items-center justify-between text-left cursor-pointer select-none group focus:ring-2 focus:ring-black">
                                        <span id="selected-service-text" class="{{ old('service') ? 'text-gray-900 font-medium' : 'text-gray-400' }}">
                                            {{ old('service', 'Choose inquiry type...') }}
                                        </span>
                                        <div class="w-6 h-6 rounded-full bg-gray-200/60 group-hover:bg-gray-200 flex items-center justify-center transition-colors">
                                            <svg id="dropdown-chevron" class="w-3.5 h-3.5 text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </button>

                                    <!-- Dropdown Menu List -->
                                    <div 
                                        id="dropdown-menu-list" 
                                        class="absolute left-0 right-0 top-full mt-2 z-50 bg-white/95 backdrop-blur-xl border border-gray-100 rounded-2xl p-2 shadow-2xl space-y-1 transition-all duration-200 transform scale-95 opacity-0 pointer-events-none origin-top">
                                        
                                        @php
                                            $services = [
                                                'Machine Vision & Sensor',
                                                'PLC & Industrial Automation',
                                                'Laser Marking & Inkjet Printing',
                                                'Strapping & Packaging System',
                                                'System Integrator & Custom Machine',
                                                'Maintenance & Support',
                                                'Other Consultation'
                                            ];
                                        @endphp

                                        @foreach ($services as $srv)
                                            <div 
                                                onclick="selectServiceOption('{{ $srv }}')" 
                                                class="dropdown-item px-3.5 py-2.5 rounded-xl hover:bg-gray-100/90 cursor-pointer transition-all duration-150 flex items-center justify-between text-sm text-gray-700 hover:text-black font-questrial group {{ old('service') === $srv ? 'bg-gray-100 font-semibold text-black' : '' }}"
                                                data-value="{{ $srv }}">
                                                <div class="flex items-center gap-2.5">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 group-hover:bg-red-500 transition-colors"></span>
                                                    <span>{{ $srv }}</span>
                                                </div>
                                                <span class="check-icon opacity-0 group-hover:opacity-40 transition-opacity {{ old('service') === $srv ? '!opacity-100 text-black' : '' }}">
                                                    <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Preferred Date/Timeline & Company -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="preferred_date" class="contact-label">Preferred Date / Timeline</label>
                                <input type="text" id="preferred_date" name="preferred_date" placeholder="dd/mm/yyyy atau Segera" class="contact-input" value="{{ old('preferred_date') }}">
                            </div>
                            <div>
                                <label for="company" class="contact-label">Company / Organization</label>
                                <input type="text" id="company" name="company" placeholder="PT / CV / Institusi" class="contact-input" value="{{ old('company') }}">
                            </div>
                        </div>

                        <!-- Row 4: Message -->
                        <div>
                            <label for="message" class="contact-label">Message / Special Requests <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" placeholder="Anything else we should know about your inquiry or project?" class="contact-input resize-none" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-red-500 mt-1 block font-questrial">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Row 5: Submit Button (LabsStdio Gliding Red Wipe Button) -->
                        <div class="pt-2">
                            <button type="submit" 
                                class="group relative inline-flex items-center justify-center overflow-hidden px-8 py-4 bg-gradient-to-b from-[#24262c] to-[#121316] text-white text-sm sm:text-base font-medium rounded-full border border-neutral-700/60 shadow-[0_4px_16px_rgba(0,0,0,0.25),inset_0_1px_1px_rgba(255,255,255,0.2)] hover:shadow-[0_6px_22px_rgba(220,38,38,0.4)] hover:border-red-500/60 transition-all duration-1000 active:scale-95 font-questrial cursor-pointer">
                                
                                <!-- Red Wipe Layer from Left to Right -->
                                <span class="absolute inset-0 bg-red-600 rounded-full -translate-x-full group-hover:translate-x-0 transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]"></span>

                                <!-- Content Layer -->
                                <span class="relative z-10 flex items-center gap-3">
                                    <span>Send Message</span>
                                    <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center group-hover:rotate-45 transition-transform duration-500 ease-[cubic-bezier(0.25,1,0.5,1)]">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7V17"></path>
                                        </svg>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Interactive Google Maps Card -->
                <div class="lg:col-span-5 flex flex-col justify-between h-full reveal-on-scroll reveal-stagger-2">
                    
                    <!-- Location Selector Bar (Above the Map Card) -->
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <div class="inline-flex bg-gray-100 p-1 rounded-full border border-gray-200 shadow-sm">
                            <button type="button" id="btn-map-office" onclick="switchMapLocation('office')" class="px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 bg-black text-white shadow-sm">
                                Head Office
                            </button>
                            <button type="button" id="btn-map-workshop" onclick="switchMapLocation('workshop')" class="px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 text-gray-600 hover:text-black">
                                Workshop
                            </button>
                        </div>

                        <a id="btn-open-maps" href="https://maps.google.com/?q=Cibis+Nine+Building+TB+Simatupang+Jakarta+Selatan" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-black hover:text-white text-gray-800 px-4 py-1.5 rounded-full text-xs font-semibold font-questrial border border-gray-200 shadow-sm transition-all duration-300 group" title="Buka di Google Maps">
                            <span>Open in Maps</span>
                            <svg class="w-3.5 h-3.5 text-current group-hover:rotate-45 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Map Card Container -->
                    <div class="relative w-full flex-1 h-[420px] sm:h-[480px] lg:h-full min-h-[440px] rounded-[32px] md:rounded-[40px] overflow-hidden shadow-xl border border-gray-100 flex flex-col justify-between bg-gray-50">
                        
                        <!-- Embedded Google Maps Iframe -->
                        <div class="relative w-full h-full min-h-[420px] sm:min-h-[480px] z-10">
                            <iframe 
                                id="google-maps-frame"
                                src="https://maps.google.com/maps?q=Cibis+Nine+Building+TB+Simatupang+Jakarta+Selatan&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                class="w-full h-full min-h-[440px] border-0 rounded-[32px] md:rounded-[40px]" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <!-- Bottom Information Floating Card -->
                        <div class="absolute bottom-5 left-5 right-5 z-20 bg-white/95 backdrop-blur-md p-5 rounded-2xl md:rounded-3xl border border-gray-200/80 shadow-lg transition-all duration-300">
                            <div class="flex items-start gap-3.5">
                                <div class="w-9 h-9 rounded-xl bg-[#c92a2a] text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 id="map-loc-title" class="font-bold font-agrandir text-sm md:text-base text-gray-900 leading-tight">Head Office (Jakarta Selatan)</h4>
                                    <p id="map-loc-desc" class="text-xs md:text-sm text-gray-600 font-questrial mt-1 leading-relaxed line-clamp-2">
                                        Cibis Nine Building floor 11, TB Simatupang Street, Pasar Minggu, Jakarta Selatan, 12560
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Bottom 3-Column Info Cards (Exact match to reference style) -->
            <div class="mt-20 md:mt-28 pt-12 border-t border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8 text-center">
                    
                    <!-- Item 1: Call & WhatsApp -->
                    <div class="flex flex-col items-center group reveal-on-scroll reveal-stagger-1">
                        <div class="w-14 h-14 rounded-full border border-gray-300 flex items-center justify-center mb-5 group-hover:border-black group-hover:bg-gray-50 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold font-agrandir text-[#111111] mb-2">Call & WhatsApp</h3>
                        <p class="text-gray-600 font-questrial text-sm md:text-base leading-relaxed">
                            <a href="tel:+622182497788" class="hover:text-black transition block">+62 21 8249 7788</a>
                            <a href="https://wa.me/6281288997766" target="_blank" class="hover:text-black transition block">+62 812 8899 7766</a>
                        </p>
                    </div>

                    <!-- Item 2: Working Hours -->
                    <div class="flex flex-col items-center group reveal-on-scroll reveal-stagger-2">
                        <div class="w-14 h-14 rounded-full border border-gray-300 flex items-center justify-center mb-5 group-hover:border-black group-hover:bg-gray-50 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold font-agrandir text-[#111111] mb-2">Working Hours</h3>
                        <p class="text-gray-600 font-questrial text-sm md:text-base leading-relaxed">
                            <span class="block">Senin - Jumat: 08:00 - 17:00</span>
                            <span class="block text-gray-400">Sabtu - Minggu: Tutup</span>
                        </p>
                    </div>

                    <!-- Item 3: Write to Us -->
                    <div class="flex flex-col items-center group reveal-on-scroll reveal-stagger-3">
                        <div class="w-14 h-14 rounded-full border border-gray-300 flex items-center justify-center mb-5 group-hover:border-black group-hover:bg-gray-50 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold font-agrandir text-[#111111] mb-2">Write to Us</h3>
                        <p class="text-gray-600 font-questrial text-sm md:text-base leading-relaxed">
                            <a href="mailto:admin@gat-aspect.com" class="hover:text-black transition block">admin@gat-aspect.com</a>
                            <a href="mailto:marketing@gat-aspect.com" class="hover:text-black transition block">marketing@gat-aspect.com</a>
                        </p>
                    </div>

                </div>
            </div>

            <!-- Address Locations Section -->
            <div class="mt-20 pt-16 border-t border-gray-100">
                <div class="text-center mb-12 reveal-on-scroll">
                    <span class="inline-block text-xs font-semibold uppercase tracking-widest text-gray-400 font-agrandir mb-2">Our Locations</span>
                    <h2 class="text-2xl md:text-3xl font-bold font-agrandir text-[#111111]">Kantor & Fasilitas Workshop</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Head Office Card -->
                    <div class="bg-[#fcfcfd] border border-gray-200/80 rounded-3xl p-8 hover:shadow-md transition-shadow reveal-on-scroll reveal-stagger-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-2xl bg-black text-white flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold font-agrandir text-lg text-gray-900">Head Office (Jakarta)</h4>
                                <span class="text-xs text-gray-500 font-questrial">Cibis Nine Building Floor 11</span>
                            </div>
                        </div>
                        <p class="text-gray-600 font-questrial text-sm md:text-base leading-relaxed">
                            Cibis Nine Building floor 11, TB Simatupang Street, Pasar Minggu, Jakarta Selatan, 12560
                        </p>
                    </div>

                    <!-- Workshop Card -->
                    <div class="bg-[#fcfcfd] border border-gray-200/80 rounded-3xl p-8 hover:shadow-md transition-shadow reveal-on-scroll reveal-stagger-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#c92a2a] text-white flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold font-agrandir text-lg text-gray-900">Workshop & Assembly (Bogor)</h4>
                                <span class="text-xs text-gray-500 font-questrial">Komplek RFP I Cikeas Udik</span>
                            </div>
                        </div>
                        <p class="text-gray-600 font-questrial text-sm md:text-base leading-relaxed">
                            Cibubur Country, komplek RFP I No.6, Cikeas Udik, Kec. Gunung Putri, Kabupaten Bogor, Jawa Barat 16966
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

    <!-- JavaScript for Menu Toggle & Maps Switcher -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });
        }
        if (menuClose && mobileMenu) {
            menuClose.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }

        // Switch Google Maps Location
        function switchMapLocation(type) {
            const frame = document.getElementById('google-maps-frame');
            const title = document.getElementById('map-loc-title');
            const desc = document.getElementById('map-loc-desc');
            const openBtn = document.getElementById('btn-open-maps');
            const btnOffice = document.getElementById('btn-map-office');
            const btnWorkshop = document.getElementById('btn-map-workshop');

            if (type === 'office') {
                frame.src = "https://maps.google.com/maps?q=Cibis+Nine+Building+TB+Simatupang+Jakarta+Selatan&t=&z=15&ie=UTF8&iwloc=&output=embed";
                title.textContent = "Head Office (Jakarta Selatan)";
                desc.textContent = "Cibis Nine Building floor 11, TB Simatupang Street, Pasar Minggu, Jakarta Selatan, 12560";
                openBtn.href = "https://maps.google.com/?q=Cibis+Nine+Building+TB+Simatupang+Jakarta+Selatan";
                
                btnOffice.className = "px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 bg-black text-white shadow-sm";
                btnWorkshop.className = "px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 text-gray-600 hover:text-black";
            } else {
                frame.src = "https://maps.google.com/maps?q=Komplek+RFP+I+Cikeas+Udik+Gunung+Putri+Bogor&t=&z=15&ie=UTF8&iwloc=&output=embed";
                title.textContent = "Workshop & Assembly (Bogor)";
                desc.textContent = "Cibubur Country, komplek RFP I No.6, Cikeas Udik, Kec. Gunung Putri, Kabupaten Bogor, Jawa Barat 16966";
                openBtn.href = "https://maps.google.com/?q=Komplek+RFP+I+Cikeas+Udik+Gunung+Putri+Bogor";

                btnWorkshop.className = "px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 bg-black text-white shadow-sm";
                btnOffice.className = "px-4 py-1.5 rounded-full text-xs font-semibold font-agrandir transition-all duration-300 text-gray-600 hover:text-black";
            }
        }

        // Custom LabsStudio Dropdown Logic
        const dropdownMenu = document.getElementById('dropdown-menu-list');
        const dropdownChevron = document.getElementById('dropdown-chevron');
        const serviceInput = document.getElementById('service_input');
        const selectedText = document.getElementById('selected-service-text');
        const dropdownContainer = document.getElementById('custom-service-dropdown');

        function toggleCustomDropdown() {
            const isOpen = dropdownMenu.classList.contains('opacity-100');
            if (isOpen) {
                closeCustomDropdown();
            } else {
                openCustomDropdown();
            }
        }

        function openCustomDropdown() {
            dropdownMenu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            dropdownMenu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
            dropdownChevron.classList.add('rotate-180');
        }

        function closeCustomDropdown() {
            dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            dropdownChevron.classList.remove('rotate-180');
        }

        function selectServiceOption(value) {
            serviceInput.value = value;
            selectedText.textContent = value;
            selectedText.className = 'text-gray-900 font-medium';

            // Highlight selected item
            const items = dropdownMenu.querySelectorAll('.dropdown-item');
            items.forEach(item => {
                const check = item.querySelector('.check-icon');
                if (item.getAttribute('data-value') === value) {
                    item.classList.add('bg-gray-100', 'font-semibold', 'text-black');
                    if (check) check.classList.add('!opacity-100', 'text-black');
                } else {
                    item.classList.remove('bg-gray-100', 'font-semibold', 'text-black');
                    if (check) check.classList.remove('!opacity-100', 'text-black');
                }
            });

            closeCustomDropdown();
        }

        // Close on Click Outside or Escape key
        document.addEventListener('click', (e) => {
            if (dropdownContainer && !dropdownContainer.contains(e.target)) {
                closeCustomDropdown();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeCustomDropdown();
            }
        });
    </script>

    <!-- Lenis Smooth Scroll & Scroll Reveal Animation -->
    <script>
        // 1. Initialize Lenis Smooth Scroll
        if (typeof Lenis !== 'undefined') {
            window.lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                orientation: 'vertical',
                gestureOrientation: 'vertical',
                smoothWheel: true,
                wheelMultiplier: 1.0,
                touchMultiplier: 1.8,
                infinite: false,
            });

            function raf(time) {
                window.lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);
        }

        // 2. Scroll Reveal Intersection Observer with Fail-safe
        function initScrollReveal() {
            const elements = document.querySelectorAll('.reveal-on-scroll');
            if (!elements.length) return;

            const observerOptions = {
                threshold: 0.01,
                rootMargin: '100px 0px 50px 0px'
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting || entry.intersectionRatio > 0) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight + 100 && rect.bottom > -100) {
                    el.classList.add('is-revealed');
                } else {
                    revealObserver.observe(el);
                }
            });

            // Fail-safe: ensure all elements become visible even if observer fails or on quick scroll
            setTimeout(() => {
                elements.forEach(el => el.classList.add('is-revealed'));
            }, 2000);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initScrollReveal);
        } else {
            initScrollReveal();
        }
        window.addEventListener('load', initScrollReveal);
    </script>

</body>

</html>
