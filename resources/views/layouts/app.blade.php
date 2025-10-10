<!DOCTYPE html>
<html lang="fr" dir="ltr"
    @class([
        'rtl' => app()->getLocale() == 'ar',
        'ltr' => app()->getLocale() == 'fr',
    ])>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ config('app.name', 'Centre de Ressources du Préscolaire') }} - @yield('title', 'Accueil')</title>
    <meta name="description" content="@yield('description', 'Centre de Ressources du Préscolaire - Plateforme dédiée à la formation et aux ressources pédagogiques pour l\'éducation préscolaire.')">
    <meta name="keywords" content="@yield('keywords', 'éducation préscolaire, formation enseignants, ressources pédagogiques, maternelle, éducation enfantine')">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ config('app.name', 'Centre de Ressources du Préscolaire') }} - @yield('title', 'Accueil')">
    <meta property="og:description" content="@yield('description', 'Centre de Ressources du Préscolaire - Plateforme dédiée à la formation et aux ressources pédagogiques pour l\'éducation préscolaire.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('storage/images/logo.png') }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Centre de Ressources du Préscolaire') }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'Centre de Ressources du Préscolaire') }} - @yield('title', 'Accueil')">
    <meta name="twitter:description" content="@yield('description', 'Centre de Ressources du Préscolaire - Plateforme dédiée à la formation et aux ressources pédagogiques pour l\'éducation préscolaire.')">
    <meta name="twitter:image" content="{{ asset('storage/images/logo.png') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Alternate Languages -->
    <link rel="alternate" hreflang="fr" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="ar" href="{{ route('language.switch', 'ar') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo.png') }}">

    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://unpkg.com">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "{{ config('app.name', 'Centre de Ressources du Préscolaire') }}",
        "description": "Centre de Ressources du Préscolaire - Plateforme dédiée à la formation et aux ressources pédagogiques pour l'éducation préscolaire.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/images/logo.png') }}",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Oujda",
            "addressCountry": "MA"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service"
        },
        "sameAs": []
    }
    </script>

    <!-- Additional Styles -->
    @stack('styles')
    
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>
</head>

<body itemscope itemtype="https://schema.org/WebPage">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>
    
    <!-- Header/Navbar -->
    <header role="banner">
        @include('components.public.header')
    </header>

    <!-- Main Content -->
    <main id="main-content" role="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer role="contentinfo">
        @include('components.public.footer')
    </footer>

    <!-- External Scripts -->
    <!-- <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Additional Scripts -->
    @stack('scripts')
    
    <!-- Performance Optimization Script -->
    <script>
        // Performance optimizations
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy load non-critical resources
            const lazyLoad = () => {
                const lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));
                const lazyBackgrounds = [].slice.call(document.querySelectorAll('.lazy-bg'));
                
                if ('IntersectionObserver' in window) {
                    const lazyImageObserver = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                const lazyImage = entry.target;
                                lazyImage.src = lazyImage.dataset.src;
                                if (lazyImage.dataset.srcset) {
                                    lazyImage.srcset = lazyImage.dataset.srcset;
                                }
                                lazyImage.classList.remove('lazy');
                                lazyImageObserver.unobserve(lazyImage);
                            }
                        });
                    });

                    lazyImages.forEach((lazyImage) => {
                        lazyImageObserver.observe(lazyImage);
                    });

                    const lazyBackgroundObserver = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.remove('lazy-bg');
                                lazyBackgroundObserver.unobserve(entry.target);
                            }
                        });
                    });

                    lazyBackgrounds.forEach((lazyBackground) => {
                        lazyBackgroundObserver.observe(lazyBackground);
                    });
                }
            };

            // Initialize lazy loading
            lazyLoad();

            // Service Worker Registration (if available)
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered'))
                    .catch(error => console.log('SW registration failed'));
            }

            // Language preference detection and persistence
            const savedLanguage = localStorage.getItem('preferred-language');
            if (savedLanguage && savedLanguage !== 'fr') {
                // User has previously chosen a non-French language
                // You can optionally redirect or show a language switch prompt
                console.log('User prefers:', savedLanguage);
            }

            // Track language switches for analytics
            document.addEventListener('click', function(e) {
                if (e.target.closest('[data-language-switch]')) {
                    const language = e.target.closest('[data-language-switch]').dataset.language;
                    localStorage.setItem('preferred-language', language);
                    
                    // Send to analytics (if implemented)
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'language_switch', {
                            'event_category': 'engagement',
                            'event_label': language
                        });
                    }
                }
            });
        });

        // Error handling for failed resources
        window.addEventListener('error', function(e) {
            console.warn('Resource loading error:', e);
        }, true);
    </script>

    <style>
        /* Accessibility improvements */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #000;
            color: white;
            padding: 8px;
            text-decoration: none;
            z-index: 10000;
            transition: top 0.3s;
        }

        .skip-link:focus {
            top: 6px;
        }

        /* Focus styles for better accessibility */
        *:focus {
            outline: 2px solid #10B981;
            outline-offset: 2px;
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* High contrast support */
        @media (prefers-contrast: high) {
            :root {
                --primary-color: #000000;
                --secondary-color: #000000;
            }
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                font-size: 12pt;
                line-height: 1.4;
            }
            
            a[href]:after {
                content: " (" attr(href) ")";
            }
        }
    </style>
</body>

</html>