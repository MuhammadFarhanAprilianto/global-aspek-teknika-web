@php
    $metaTitle = $seoTitle ?? 'PT Global Aspect Technology — Industrial Automation, PLC, HMI & Machine Vision';
    $metaDescription = $seoDescription ?? 'PT Global Aspect Technology is a trusted Indonesian industrial automation system integrator specializing in PLC programming, HMI/SCADA panels, machine vision inspection, TIJ/laser coding, and turnkey factory integration since 2017.';
    $metaImage = $seoImage ?? asset('storage/Logo_Perusahaan.webp');
    $metaUrl = url()->current();
@endphp
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $metaUrl }}">

<!-- Open Graph -->
<meta property="og:site_name" content="PT Global Aspect Technology">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $metaUrl }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">
