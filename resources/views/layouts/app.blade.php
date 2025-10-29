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

    <!-- FontAwesome CDN (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Local CSS (includes Bootstrap, Animate.css, Summernote, Swiper) -->
    @if(app()->environment('local') && file_exists(base_path('public/hot')))
        {{-- Development: Use Vite dev server --}}
        @vite(['resources/css/app.css'])
    @else
        {{-- Production: Use compiled assets --}}
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
        @endphp
        @if($cssFile)
            <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
        @else
            <style>
                /* Fallback styles */
                body { font-family: system-ui, -apple-system, sans-serif; }
            </style>
        @endif
    @endif




    

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

        <!-- Local JS (includes Bootstrap, jQuery, Popper.js, Summernote, Swiper) -->
        @if(app()->environment('local') && file_exists(base_path('public/hot')))
            {{-- Development: Use Vite dev server --}}
            @vite(['resources/js/app.js'])
        @else
            {{-- Production: Use compiled assets --}}
            @php
                $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
                $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
                $vendorFile = $manifest['resources/js/app.js']['imports'][0] ?? null;
                $swiperFile = $manifest['resources/js/app.js']['imports'][1] ?? null;
            @endphp
            @if($jsFile)
                @if($vendorFile && isset($manifest[$vendorFile]))
                    <script src="{{ asset('build/' . $manifest[$vendorFile]['file']) }}"></script>
                @endif
                @if($swiperFile && isset($manifest[$swiperFile]))
                    <script src="{{ asset('build/' . $manifest[$swiperFile]['file']) }}"></script>
                @endif
                <script src="{{ asset('build/' . $jsFile) }}"></script>
            @endif
        @endif

        <!-- Debug Script for Development -->
        @if(config('app.debug'))
        <script>
        console.log('🔍 Debug Mode Active');
        console.log('📱 Screen Size:', window.innerWidth + 'x' + window.innerHeight);
        console.log('🌐 User Agent:', navigator.userAgent);
        
        // Check if assets are loading
        window.addEventListener('load', function() {
            console.log('✅ Page fully loaded');
            
            // Check for missing images
            const images = document.querySelectorAll('img');
            images.forEach((img, index) => {
                if (!img.complete || img.naturalHeight === 0) {
                    console.error('❌ Image failed to load:', img.src);
                } else {
                    console.log('✅ Image loaded:', img.src);
                }
            });
            
            // Check for missing CSS
            const stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach((link, index) => {
                console.log('📄 CSS loaded:', link.href);
            });
            
            // Check for missing JS
            const scripts = document.querySelectorAll('script[src]');
            scripts.forEach((script, index) => {
                console.log('📜 JS loaded:', script.src);
            });
        });
        
        // Monitor network errors
        window.addEventListener('error', function(e) {
            if (e.target.tagName === 'IMG') {
                console.error('❌ Image load error:', e.target.src);
            } else if (e.target.tagName === 'LINK') {
                console.error('❌ CSS load error:', e.target.href);
            } else if (e.target.tagName === 'SCRIPT') {
                console.error('❌ JS load error:', e.target.src);
            }
        });
        </script>
        @endif

        <!-- Additional Scripts -->
        @stack('scripts')

    <!-- CDN JS - Now loaded via Vite bundles -->
    {{-- Bootstrap and Swiper are now bundled via Vite in app.js to avoid duplication --}}
</body>

</html>