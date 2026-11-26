<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Portal - PT Global Aspect Technology</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/Logo_Perusahaan(1).png') }}" type="image/png" sizes="64x64">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/agrandir" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Sembunyikan ikon mata bawaan browser (Edge/Chrome/IE) agar tidak muncul ganda */
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            pointer-events: none !important;
        }
        input::-webkit-contacts-auto-fill-button,
        input::-webkit-credentials-auto-fill-button {
            visibility: hidden !important;
            display: none !important;
            pointer-events: none !important;
            height: 0 !important;
            width: 0 !important;
            margin: 0 !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen w-full antialiased font-['Questrial',sans-serif] text-slate-900 selection:bg-[#3367A5] selection:text-white">
    {{ $slot }}
    @fluxScripts
</body>

</html>
