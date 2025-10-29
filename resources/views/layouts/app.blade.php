<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    @class([
        'rtl' => app()->getLocale() == 'ar',
        'ltr' => app()->getLocale() == 'fr',
    ])>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $metaData = \App\Helpers\SEOHelper::generateMetaTags([
            'title' => trim(app('view')->yieldContent('title') ?: 'Accueil') . ' - ' . config('app.name'),
            'description' => trim(app('view')->yieldContent('description') ?: 'Centre de Ressources du Préscolaire offrant des ressources pédagogiques et formations spécialisées.'),
            'image' => trim(app('view')->yieldContent('image') ?: asset('storage/images/logo.png')),
            'type' => trim(app('view')->yieldContent('type') ?: 'website'),
            'url' => url()->current(),
        ]);
    @endphp

    <!-- Primary Meta Tags -->
    <title>{{ $metaData['title'] }}</title>
    <meta name="title" content="{{ $metaData['title'] }}">
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="keywords" content="éducation préscolaire, Maroc, formation, ressources pédagogiques, éducation, préscolaire">
    <meta name="author" content="Centre de Ressources du Préscolaire">
    <meta name="robots" content="index, follow">
    <meta name="language" content="{{ $metaData['locale'] }}">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ $metaData['url'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $metaData['type'] }}">
    <meta property="og:url" content="{{ $metaData['url'] }}">
    <meta property="og:title" content="{{ $metaData['title'] }}">
    <meta property="og:description" content="{{ $metaData['description'] }}">
    <meta property="og:image" content="{{ $metaData['image'] }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $metaData['site_name'] }}">
    <meta property="og:locale" content="{{ $metaData['locale'] }}">
    <meta property="og:locale:alternate" content="{{ $metaData['locale_alternate'] }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $metaData['url'] }}">
    <meta name="twitter:title" content="{{ $metaData['title'] }}">
    <meta name="twitter:description" content="{{ $metaData['description'] }}">
    <meta name="twitter:image" content="{{ $metaData['image'] }}">

    <!-- Language Alternates -->
    <link rel="alternate" hreflang="fr" href="{{ route('language.switch', 'fr') }}" />
    <link rel="alternate" hreflang="ar" href="{{ route('language.switch', 'ar') }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $metaData['url'] }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo.png') }}">

    <!-- Font Awesome CDN (for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css">

    <!-- DNS Prefetch and Preconnect for external resources -->
    {{-- <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    
    Preload critical resources
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css" as="style"> --}}

    <!-- Local CSS will be loaded via Vite -->

    <!-- CDN CSS (only for external libraries) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Local CSS (includes Bootstrap) -->
    @vite(['resources/css/app.css'])




    

    <!-- Additional Styles -->
    @stack('styles')

    <!-- Structured Data -->
    <script type="application/ld+json">
        {!! \App\Helpers\SEOHelper::generateOrganizationSchema() !!}
    </script>
    <script type="application/ld+json">
        {!! \App\Helpers\SEOHelper::generateWebSiteSchema() !!}
    </script>
    @stack('structured-data')

    <style>
        html, body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <!-- Header/Navbar -->
    <header>
        @include('components.public.header')
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.public.footer')

    <!-- Local JS will be loaded via Vite -->

    <!-- CDN JS (only for external libraries) -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Local JS (includes Bootstrap, jQuery, Popper.js) -->
    @vite(['resources/js/app.js'])

    <!-- Additional Scripts -->
    @stack('scripts')

    <!-- CDN JS - Now loaded via Vite bundles -->
    {{-- Bootstrap and Swiper are now bundled via Vite in app.js to avoid duplication --}}
</body>

</html>