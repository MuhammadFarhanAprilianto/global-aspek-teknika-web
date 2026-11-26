<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Access Restricted — PT Global Aspect Technology</title>
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">
</head>

<body class="bg-[#0B0C10] text-white min-h-screen flex flex-col justify-between font-['Questrial',sans-serif] overflow-x-hidden">
    <main class="flex-1 flex items-center justify-center px-6 py-20">
        <div class="max-w-xl w-full text-center space-y-6">
            <img src="{{ asset('storage/Logo_Perusahaan.webp') }}" alt="PT Global Aspect Technology" class="h-12 w-auto mx-auto brightness-0 invert opacity-90">
            <div class="text-7xl sm:text-8xl font-extrabold font-['Agrandir',sans-serif] text-[#3367A5] tracking-tight leading-none">
                403
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold font-['Agrandir',sans-serif] text-white tracking-tight">
                Access Restricted
            </h1>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-md mx-auto">
                This document link or portal requires a valid authorization signature. Please request a fresh link from our team.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ url('/') }}"
                    class="px-6 py-3 rounded-full bg-[#3367A5] hover:bg-[#244E81] text-white text-sm font-semibold transition">
                    Back to Home
                </a>
                <a href="{{ url('/contact') }}"
                    class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white text-sm font-semibold transition">
                    Contact Support
                </a>
            </div>
        </div>
    </main>
    <footer class="py-6 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} PT Global Aspect Technology. All rights reserved.
    </footer>
</body>

</html>
