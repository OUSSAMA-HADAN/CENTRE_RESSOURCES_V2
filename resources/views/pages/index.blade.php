@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<style>
    /* Professional Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        /* Account for fixed header - use calc to ensure proper spacing */
        padding-top: calc(80px + env(safe-area-inset-top, 0px));
        box-sizing: border-box;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('storage/images/hero-img.webp') }}') center/cover no-repeat;
        opacity: 0.3;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        max-width: 800px;
        padding: 0 20px;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 2rem; /* Ensure space above waves */
    }

    .hero-logo {
        margin-bottom: 2rem;
        animation: fadeInDown 1s ease-out;
    }

    .hero-logo img {
        max-height: 150px;
        width: auto;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .hero-logo img:hover {
        transform: scale(1.05);
    }

    .hero-titles {
        margin-bottom: 2rem;
    }

    .hero-title-fr {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out 0.2s both;
        line-height: 1.1;
        word-wrap: break-word;
        hyphens: auto;
    }

    .hero-title-ar {
        font-size: 1.8rem;
        font-weight: 600;
        font-family: 'Amiri', serif;
        opacity: 0.95;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out 0.4s both;
        line-height: 1.2;
        word-wrap: break-word;
        hyphens: auto;
    }

    .hero-divider {
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, #ffc107, #f59e0b);
        margin: 0 auto 2rem;
        border-radius: 2px;
        animation: fadeInUp 1s ease-out 0.6s both;
    }

    .hero-actions {
        margin-bottom: 2rem;
        animation: fadeInUp 1s ease-out 0.8s both;
    }

    .hero-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 25px;
        color: white;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        min-height: 44px; /* Touch-friendly minimum size */
        min-width: 44px;
        justify-content: center;
        text-align: center;
    }

    .hero-link:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        line-height: 1;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        animation: badge-pulse 2s ease-in-out infinite;
        z-index: 10;
    }

    .notification-badge:empty,
    .notification-badge[data-count="0"] {
        background: #6b7280;
        box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        animation: badge-pulse-subtle 3s ease-in-out infinite;
    }

    @keyframes badge-pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        50% {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.6);
        }
    }

    @keyframes badge-pulse-subtle {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 3px 10px rgba(107, 114, 128, 0.4);
        }
    }

    .hero-announcement {
        animation: fadeInUp 1s ease-out 1s both;
        position: relative;
        z-index: 3; /* Above waves */
        margin-bottom: 2rem; /* Add space before waves */
    }

    .announcement-content {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        padding: 15px 20px;
        font-size: 0.9rem;
        line-height: 1.4;
        backdrop-filter: blur(10px);
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 3; /* Above waves */
    }

    .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 120px;
        z-index: 1; /* Below content */
        line-height: 0;
        pointer-events: none; /* Prevent interference with content */
    }

    .hero-waves svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    .hero-waves path {
        animation: gentleWave 6s ease-in-out infinite;
    }

    .hero-waves path:nth-child(1) {
        animation-delay: 0s;
    }

    .hero-waves path:nth-child(2) {
        animation-delay: -2s;
    }

    @keyframes gentleWave {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(10px);
        }
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Wave Animation Enhancements */
    .hero-waves::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16,185,129,0.1), transparent);
        animation: wave-shimmer 3s ease-in-out infinite;
    }

    @keyframes wave-shimmer {
        0%, 100% {
            transform: translateX(-100%);
        }
        50% {
            transform: translateX(100%);
        }
    }

    /* Enhanced Responsive Design */
    
    /* Large tablets and small desktops */
    @media (max-width: 1200px) {
        .hero-title-fr {
            font-size: 2.5rem;
        }
        
        .hero-title-ar {
            font-size: 1.6rem;
        }
        
        .hero-logo img {
            max-height: 120px;
        }
    }
    
    /* Tablets */
    @media (max-width: 992px) {
        .hero-section {
            height: 100vh;
            min-height: 600px;
            padding-top: 70px; /* Tablets */
        }
        
        .hero-title-fr {
            font-size: 2.2rem;
            line-height: 1.2;
        }
        
        .hero-title-ar {
            font-size: 1.4rem;
            line-height: 1.3;
        }
        
        .hero-logo img {
            max-height: 100px;
        }
        
        .hero-content {
            padding: 0 20px;
            max-width: 700px;
        }
        
        .hero-waves {
            height: 100px;
        }
        
        .announcement-content {
            font-size: 0.9rem;
            padding: 15px 20px;
            margin-bottom: 1rem; /* Extra space on tablets */
        }
    }
    
    /* Mobile landscape and small tablets */
    @media (max-width: 768px) {
        .hero-section {
            height: 100vh;
            min-height: 500px;
            padding-top: 120px !important; /* Force extra padding for mobile - header overlap fix */
        }
        
        .hero-title-fr {
            font-size: 1.9rem;
            line-height: 1.1;
            margin-bottom: 0.8rem;
        }
        
        .hero-title-ar {
            font-size: 1.2rem;
            line-height: 1.2;
        }
        
        .hero-logo {
            margin-bottom: 1.5rem;
        }
        
        .hero-logo img {
            max-height: 85px;
        }
        
        .hero-content {
            padding: 0 15px;
            max-width: 600px;
        }
        
        .hero-divider {
            width: 80px;
            height: 2px;
            margin: 0 auto 1.5rem;
        }
        
        .hero-actions {
            margin-bottom: 1.5rem;
        }
        
        .hero-link {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
        
        .hero-waves {
            height: 80px;
        }
        
        .announcement-content {
            font-size: 0.85rem;
            padding: 12px 15px;
            margin-bottom: 1rem; /* Extra space on mobile */
        }
        
        .notification-badge {
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            top: -6px;
            right: -6px;
        }
    }
    
    /* Mobile portrait */
    @media (max-width: 576px) {
        .hero-section {
            height: 100vh;
            min-height: 450px;
            padding-top: 130px !important; /* Force extra padding for small mobile - header overlap fix */
        }
        
        .hero-title-fr {
            font-size: 1.6rem;
            line-height: 1.1;
            margin-bottom: 0.6rem;
        }
        
        .hero-title-ar {
            font-size: 1.1rem;
            line-height: 1.2;
        }
        
        .hero-logo {
            margin-bottom: 1.2rem;
        }
        
        .hero-logo img {
            max-height: 75px;
        }
        
        .hero-content {
            padding: 0 12px;
            max-width: 100%;
        }
        
        .hero-titles {
            margin-bottom: 1.2rem;
        }
        
        .hero-divider {
            width: 60px;
            height: 2px;
            margin: 0 auto 1.2rem;
        }
        
        .hero-actions {
            margin-bottom: 1.2rem;
        }
        
        .hero-link {
            padding: 8px 16px;
            font-size: 0.85rem;
            gap: 0.4rem;
        }
        
        .hero-waves {
            height: 60px;
        }
        
        .announcement-content {
            font-size: 0.8rem;
            padding: 10px 12px;
            line-height: 1.3;
            margin-bottom: 1rem; /* Extra space on small mobile */
        }
        
        .notification-badge {
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            top: -5px;
            right: -5px;
        }
    }
    
    /* Very small screens */
    @media (max-width: 480px) {
        .hero-section {
            height: 100vh;
            min-height: 400px;
            padding-top: 140px !important; /* Force extra padding for very small screens - header overlap fix */
        }
        
        .hero-title-fr {
            font-size: 1.4rem;
            line-height: 1.1;
        }
        
        .hero-title-ar {
            font-size: 1rem;
            line-height: 1.2;
        }
        
        .hero-logo img {
            max-height: 65px;
        }
        
        .hero-content {
            padding: 0 10px;
        }
        
        .hero-link {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
        
        .hero-waves {
            height: 50px;
        }
        
        .announcement-content {
            font-size: 0.75rem;
            padding: 8px 10px;
            margin-bottom: 1rem; /* Extra space on very small screens */
        }
        
        .notification-badge {
            width: 16px;
            height: 16px;
            font-size: 0.6rem;
            top: -4px;
            right: -4px;
        }
    }
    
    /* Extra small screens */
    @media (max-width: 360px) {
        .hero-section {
            padding-top: 150px !important; /* Force extra padding for extra small screens - header overlap fix */
        }
    }
    
    /* Additional mobile-specific fixes */
    @media (max-width: 768px) {
        .hero-section {
            /* Force the hero content to start below the header */
            margin-top: 0 !important;
            padding-top: 120px !important;
        }
        
        .hero-content {
            /* Ensure content is positioned correctly */
            position: relative;
            z-index: 10;
            margin-top: 0 !important;
        }
    }
    
    /* Universal fix for all screen sizes - deployment safety */
    .hero-section {
        /* Ensure minimum padding to prevent header overlap */
        padding-top: max(80px, env(safe-area-inset-top, 0px) + 80px) !important;
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding-top: max(120px, env(safe-area-inset-top, 0px) + 120px) !important;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section {
            padding-top: max(130px, env(safe-area-inset-top, 0px) + 130px) !important;
        }
    }
    
    @media (max-width: 480px) {
        .hero-section {
            padding-top: max(140px, env(safe-area-inset-top, 0px) + 140px) !important;
        }
    }
    
    @media (max-width: 360px) {
        .hero-section {
            padding-top: max(150px, env(safe-area-inset-top, 0px) + 150px) !important;
        }
    }
    
    @media (max-width: 360px) {
        .hero-logo img {
            max-height: 55px;
        }
        
        .hero-link {
            padding: 5px 10px;
            font-size: 0.75rem;
        }
    }
    
    /* Landscape orientation adjustments */
    @media (max-height: 500px) and (orientation: landscape) {
        .hero-section {
            height: 100vh;
            min-height: 100vh;
            padding-top: 50px; /* Landscape */
        }
        
        .hero-logo {
            margin-bottom: 1rem;
        }
        
        .hero-logo img {
            max-height: 60px;
        }
        
        .hero-title-fr {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .hero-title-ar {
            font-size: 1rem;
        }
        
        .hero-titles {
            margin-bottom: 1rem;
        }
        
        .hero-divider {
            margin: 0 auto 1rem;
        }
        
        .hero-actions {
            margin-bottom: 1rem;
        }
        
        .hero-announcement {
            display: none; /* Hide announcement in landscape to save space */
        }
        
        .hero-waves {
            height: 40px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to adjust hero section padding based on header height
    function adjustHeroPadding() {
        const header = document.querySelector('.navbar');
        const hero = document.querySelector('.hero-section');
        
        if (header && hero) {
            const headerHeight = header.offsetHeight;
            const isSmallScreen = window.innerWidth <= 768;
            
            // Add extra buffer on small screens to prevent overlap
            const paddingValue = isSmallScreen ? headerHeight + 30 : headerHeight + 10;
            hero.style.paddingTop = paddingValue + 'px';
            
            // Force a reflow to ensure the change takes effect
            hero.offsetHeight;
        }
    }
    
    // Adjust immediately
    adjustHeroPadding();
    
    // Adjust on load
    window.addEventListener('load', adjustHeroPadding);
    
    // Adjust on resize
    window.addEventListener('resize', adjustHeroPadding);
    
    // Multiple adjustments for small screens
    if (window.innerWidth <= 768) {
        setTimeout(adjustHeroPadding, 100);
        setTimeout(adjustHeroPadding, 300);
        setTimeout(adjustHeroPadding, 500);
        setTimeout(adjustHeroPadding, 1000);
        setTimeout(adjustHeroPadding, 2000);
    }
    
    // Force adjustment on scroll (in case header changes)
    window.addEventListener('scroll', function() {
        if (window.innerWidth <= 768) {
            adjustHeroPadding();
        }
    });
});
</script>

<!-- Professional Hero Section -->
<section id="hero" class="hero-section" >
    <div class="hero-background"></div>
    
    <div class="hero-content">
        <div class="hero-logo">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Centre de Ressources du Préscolaire" loading="eager" fetchpriority="high">
        </div>
        
        <div class="hero-titles">
            <h1 class="hero-title-fr">Centre de Ressources du Préscolaire - OUJDA</h1>
            <h2 class="hero-title-ar">مركز موارد التعليم الأولي - وجدة</h2>
        </div>
        
        <div class="hero-divider"></div>
        
        <div class="hero-actions">
            <a href="{{ route('documentation.index') }}" class="hero-link">
                <i class="fas fa-book"></i>
                <span>{{ __('homepage.documentation_reminder') }}</span>
                <span class="notification-badge" data-count="{{ $documentationCount }}">{{ $documentationCount }}</span>
            </a>
        </div>
        
        <div class="hero-announcement">
            <div class="announcement-content">
                {{ __('homepage.disclamer') }}
            </div>
        </div>
    </div>
    
    <div class="hero-waves">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,0 L0,40 Q360,20 720,40 T1440,40 L1440,120 L0,120 Z" fill="#ffffff"/>
            <path d="M0,30 L0,60 Q360,40 720,60 T1440,60 L1440,120 L0,120 Z" fill="#f8fafb"/>
            <path d="M0,60 L0,120 L1440,120 L1440,120 Z" fill="#f0f4f8"/>
        </svg>
    </div> 
</section>

<!-- Professional Sur Nous Section -->
<section id="surNous" class="py-5" style="background: linear-gradient(135deg, #ffffff 0%, #f0f4f8 100%);">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="badge bg-primary text-white mb-3 px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-university me-2"></i>{{ __('homepage.about.badge') }}
                </span>
                <h2 class="display-5 fw-bold text-dark mb-3">{{ __('homepage.about.title') }}</h2>
                <div class="d-flex justify-content-center mb-4">
                    <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #10b981, #0ea5e9); border-radius: 2px;"></div>
                </div>
                <p class="lead text-muted col-lg-8 mx-auto">{{ __('homepage.about.description') }}</p>
            </div>
        </div>

        <div class="row align-items-center g-4">
            <!-- Image Column -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative">
                    <div class="about-image-wrapper rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/images/ecole.webp') }}" class="img-fluid w-100 about-image" alt="Centre de Ressources du Préscolaire" style="height: 550px; object-fit: cover;" loading="lazy">
                    </div>
                </div>
            </div>
            
            <!-- Features Column -->
            <div class="col-lg-6">
                <!-- Features List -->
                <div class="features-list">
                    <!-- Feature 1 -->
                    <div class="feature-card mb-4 p-4 rounded-4 border-0 shadow-sm">
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-wrapper me-3 flex-shrink-0">
                                <div class="feature-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                    <i class="fas fa-graduation-cap fa-2x text-white"></i>
                                </div>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold text-dark mb-2">{{ __('homepage.about.professional_training.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.professional_training.description') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="feature-card mb-4 p-4 rounded-4 border-0 shadow-sm">
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-wrapper me-3 flex-shrink-0">
                                <div class="feature-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f7a223 0%, #e89417 100%);">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-white"></i>
                                </div>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold text-dark mb-2">{{ __('homepage.about.qualified_experts.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.qualified_experts.description') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="feature-card p-4 rounded-4 border-0 shadow-sm">
                        <div class="d-flex align-items-start">
                            <div class="feature-icon-wrapper me-3 flex-shrink-0">
                                <div class="feature-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                                    <i class="fas fa-book-open fa-2x text-white"></i>
                                </div>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-bold text-dark mb-2">{{ __('homepage.about.pedagogical_resources.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.pedagogical_resources.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .about-image-wrapper {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .about-image-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }
        
        .feature-card {
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            background: white;
            transform: translateX(5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        }
        
        .feature-icon-circle {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover .feature-icon-circle {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .display-5 {
                font-size: 2rem !important;
            }
            
            .about-image {
                height: 450px !important;
            }
        }
        
        @media (max-width: 767.98px) {
            .display-5 {
                font-size: 1.75rem !important;
            }
            
            .about-image {
                height: 400px !important;
            }
            
            .feature-card {
                padding: 1.5rem !important;
            }
        }
        
        @media (max-width: 575.98px) {
            .about-image {
                height: 350px !important;
            }
            
            .feature-icon-wrapper {
                margin-bottom: 1rem;
            }
        }
    </style>
</section>

<!-- Professional Units Section -->
<section id="units" class="py-5 bg-light-subtle">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-dark mb-4">{{ __('units.title') }}</h2>
            <div class="d-flex justify-content-center mb-4">
                <div style="width: 80px; height: 3px; background: linear-gradient(90deg, #10b981, #0ea5e9);"></div>
            </div>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">{{ __('units.description') }}</p>
        </div>

        <!-- Units Grid -->
        <div class="row g-4">

            <!-- Documentation and Production Unit -->
            <div class="col-lg-6 col-md-6">
                <div class="card border-0 rounded-3 shadow-sm h-100 unit-card bg-white">
                    <div class="card-header bg-white border-bottom py-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-book fa-lg text-success"></i>
                            </div>
                            <h5 class="mb-0 fw-semibold text-dark">{{ __('units.documentation.title') }}</h5>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">{{ __('units.documentation.description') }}</p>
                        <ul class="list-unstyled mb-0">
                            @foreach(__('units.documentation.key_areas') as $area)
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-2 fs-6"></i>
                                    <span class="text-muted">{{ $area }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 py-3">
                        <a href="{{route('documentation.index')}}" class="btn btn-outline-success w-100 py-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            {{ __('units.documentation.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Online Training Unit -->
            <div class="col-lg-6 col-md-6">
                <div class="card border-0 rounded-3 shadow-sm h-100 unit-card bg-white">
                    <div class="card-header bg-white border-bottom py-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-users fa-lg text-info"></i>
                            </div>
                            <h5 class="mb-0 fw-semibold text-dark">{{ __('units.online_training.title') }}</h5>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">{{ __('units.online_training.description') }}</p>
                        <ul class="list-unstyled mb-0">
                            @foreach(__('units.online_training.key_areas') as $area)
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-info mt-1 me-2 fs-6"></i>
                                    <span class="text-muted">{{ $area }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 py-3">
                        <a href="{{route('formation.index')}}" class="btn btn-outline-info w-100 py-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            {{ __('units.online_training.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .unit-card {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .unit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08) !important;
            border-color: var(--bs-primary);
        }

        .icon-wrapper {
            transition: transform 0.3s ease;
        }

        .unit-card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .card-header {
            border-bottom: 1px solid #e9ecef !important;
        }

        .btn-outline-primary,
        .btn-outline-success,
        .btn-outline-info {
            transition: all 0.3s ease;
            border-width: 1px;
        }

        .btn-outline-primary:hover {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-outline-success:hover {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
        }

        .btn-outline-info:hover {
            background-color: var(--bs-info);
            border-color: var(--bs-info);
        }

        @media (max-width: 991.98px) {
            .display-6 {
                font-size: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .display-6 {
                font-size: 1.75rem;
            }
            
            .card-header .d-flex {
                flex-direction: column;
                text-align: center;
            }
            
            .icon-wrapper {
                margin-right: 0 !important;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .display-6 {
                font-size: 1.5rem;
            }
        }
    </style>
</section>

<!-- Professional Director Section -->
<section id="director" class="py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white mb-3 px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-user-tie me-2"></i>{{ __('homepage.director.badge') }}
            </span>
            <h2 class="display-5 fw-bold text-dark mb-3">
                {{ __('homepage.director.title_part1') }} 
                <span class="text-primary">{{ __('homepage.director.title_part2') }}</span>
            </h2>
            <div class="d-flex justify-content-center mb-4">
                <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #10b981, #0ea5e9); border-radius: 2px;"></div>
            </div>
        </div>
        
        <!-- Professional Card Layout -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="director-card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Image Section -->
                        <div class="col-lg-4 bg-white position-relative">
                            <div class="director-image-wrapper position-relative h-100">
                                <img src="{{ asset('storage/images/prf.webp') }}" 
                                     class="director-image w-100 h-100" 
                                     alt="Responsable du Centre"
                                     style="object-fit: cover; object-position: center;"
                                     loading="lazy">
                                
                                <!-- Overlay with name and experience -->
                                <div class="director-overlay position-absolute bottom-0 start-0 end-0 p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="experience-badge bg-white shadow px-3 py-2 rounded-pill">
                                            <div class="h4 mb-0 fw-bold text-primary">20+</div>
                                            <small class="text-muted d-block" style="font-size: 0.7rem;">{{ __('homepage.director.years_experience') }}</small>
                                        </div>
                                    </div>
                                    <h4 class="text-white fw-bold mb-0">{{ __('homepage.director.name') }}</h4>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="col-lg-8 bg-white">
                            <div class="p-5">
                                <p class="lead text-dark mb-4" style="line-height: 1.8;">
                                    {{ __('homepage.director.description') }}
                                </p>
                                
                                <div class="row g-3 mt-4">
                                    <!-- Expertise Item 1 -->
                                    <div class="col-md-6">
                                        <div class="expertise-card h-100 p-4 rounded-3 border-0 shadow-sm">
                                            <div class="expertise-icon-wrapper mb-3">
                                                <div class="expertise-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                                    <i class="fas fa-graduation-cap fa-2x text-white"></i>
                                                </div>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-2">{{ __('homepage.director.expertise.formation.title') }}</h6>
                                            <p class="text-muted small mb-0">{{ __('homepage.director.expertise.formation.description') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Expertise Item 2 -->
                                    <div class="col-md-6">
                                        <div class="expertise-card h-100 p-4 rounded-3 border-0 shadow-sm">
                                            <div class="expertise-icon-wrapper mb-3">
                                                <div class="expertise-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f7a223 0%, #e89417 100%);">
                                                    <i class="fas fa-chalkboard-teacher fa-2x text-white"></i>
                                                </div>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-2">{{ __('homepage.director.expertise.experience.title') }}</h6>
                                            <p class="text-muted small mb-0">{{ __('homepage.director.expertise.experience.description') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Expertise Item 3 -->
                                    <div class="col-12">
                                        <div class="expertise-card p-4 rounded-3 border-0 shadow-sm">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="expertise-icon-circle rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                                                        <i class="fas fa-certificate fa-2x text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h6 class="fw-bold text-dark mb-2">{{ __('homepage.director.expertise.pedagogy.title') }}</h6>
                                                    <p class="text-muted small mb-0">{{ __('homepage.director.expertise.pedagogy.description') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .director-card {
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .director-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }
        
        .director-image-wrapper {
            min-height: 600px;
        }
        
        .director-image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(180deg, rgba(0,0,0,0.5) 0%, transparent 100%);
            z-index: 1;
        }
        
        .director-overlay {
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.9) 100%);
            z-index: 2;
        }
        
        .experience-badge {
            transition: transform 0.3s ease;
        }
        
        .director-card:hover .experience-badge {
            transform: scale(1.05);
        }
        
        .expertise-card {
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .expertise-card:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        }
        
        .expertise-icon-circle {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .expertise-card:hover .expertise-icon-circle {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .director-image-wrapper {
                min-height: 500px;
            }
            
            .director-overlay {
                padding: 2rem !important;
            }
        }
        
        @media (max-width: 767.98px) {
            .director-image-wrapper {
                min-height: 400px;
            }
            
            .director-overlay {
                padding: 1.5rem !important;
            }
            
            .expertise-card {
                margin-bottom: 1rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .display-5 {
                font-size: 1.75rem !important;
            }
            
            .director-image-wrapper {
                min-height: 350px;
            }
        }
    </style>
</section>

<!-- Gallery Section -->
<!-- Immersive 3D Gallery Section -->
<section id="gallery" class="gallery-section">
    <div class="container-fluid p-0">
        <!-- Section Header -->
        <div class="gallery-header text-center">
            <h2 class="gallery-title">{{ __('homepage.galery.title') }}</h2>
            <div class="title-decoration">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <p class="gallery-description">{{ __('homepage.galery.description') }}</p>
        </div>
        
        <!-- Interactive Gallery -->
        <div class="gallery-showcase">
            <div class="gallery-container">
                <!-- Gallery Nav Dots -->
                <div class="gallery-nav">
                    <span class="nav-dot active" data-index="0"></span>
                    <span class="nav-dot" data-index="1"></span>
                    <span class="nav-dot" data-index="2"></span>
                    <!--<span class="nav-dot" data-index="3"></span>-->
                    <span class="nav-dot" data-index="4"></span>
                    <!--<span class="nav-dot" data-index="5"></span>-->
                </div>
                
                <!-- Featured Image Display -->
                <div class="featured-image-container">
                    <div class="featured-wrapper">
                        <div class="featured-image active" style="background-image: url('{{ asset('storage/images/galery1.webp') }}');">
                            <div class="image-info">
                                <div class="info-content">
                                    <h3>{{ __('homepage.galery.items.1') }}</h3>
                                    <div class="info-decoration"></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        <div class="featured-image" style="background-image: url('{{ asset('storage/images/galery6.webp') }}');">
                            <div class="image-info">
                                <div class="info-content">
                                    <h3>{{ __('homepage.galery.items.2') }}</h3>
                                    <div class="info-decoration"></div>
                                </div>
                            </div>
                        </div>
                        <div class="featured-image" style="background-image: url('{{ asset('storage/images/galery9.webp') }}');">
                            <div class="image-info">
                                <div class="info-content">
                                    <h3>{{ __('homepage.galery.items.9') }}</h3>
                                    <div class="info-decoration"></div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="featured-image" style="background-image: url('{{ asset('storage/images/galery2.webp') }}');">
                            <div class="image-info">
                                <div class="info-content">
                                    <h3>{{ __('homepage.galery.items.5') }}</h3>
                                    <div class="info-decoration"></div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                
                <!-- Thumbnail Strip -->
                <div class="thumbnail-strip-container">
                    <div class="thumbnail-controls">
                        <button class="control-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                        <button class="control-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    </div>
                    <div class="thumbnail-strip">
                        <div class="thumbnail active" data-index="0">
                            <img src="{{ asset('storage/images/galery1.webp') }}" alt="Formation">
                        </div>
                        <div class="thumbnail" data-index="1">
                            <img src="{{ asset('storage/images/galery6.webp') }}" alt="Salle de classe">
                        </div>
                        <div class="thumbnail" data-index="2">
                            <img src="{{ asset('storage/images/galery9.webp') }}" alt="fette">
                        </div>
                       
                        <div class="thumbnail" data-index="4">
                            <img src="{{ asset('storage/images/galery2.webp') }}" alt="Événements">
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Gallery Main Styles */
.gallery-section {
    position: relative;
    padding: 0;
    background: #ffffff;
    color: #2d3748;
    overflow: hidden;
}

/* Header Styles */
.gallery-header {
    position: relative;
    padding: 60px 15px;
    z-index: 10;
}

.gallery-title {
    font-size: 3.5rem;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 20px;
    background: linear-gradient(90deg, #10b981, #3b82f6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-transform: uppercase;
    text-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
}

.title-decoration {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 25px;
}

.title-decoration span {
    display: block;
    height: 4px;
    width: 25px;
    background: #10b981;
    border-radius: 4px;
}

.title-decoration span:nth-child(2) {
    width: 45px;
    background: #3b82f6;
}

.gallery-description {
    max-width: 700px;
    margin: 0 auto;
    font-size: 1.2rem;
    color: rgba(45, 55, 72, 0.8);
}

/* Gallery Showcase */
.gallery-showcase {
    position: relative;
    width: 100%;
    height: 85vh; /* Increased height to show full images */
    min-height: 650px; /* Increased minimum height */
}

.gallery-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Nav Dots */
.gallery-nav {
    position: relative;
    display: flex;
    justify-content: center;
    gap: 15px;
    padding: 15px 0;
    background: #ffffff;
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
}

.nav-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.3);
    cursor: pointer;
    transition: all 0.4s ease;
}

.nav-dot.active {
    background: #10b981;
    transform: scale(1.2);
    box-shadow: 0 0 10px #10b981, 0 0 20px rgba(16, 185, 129, 0.4);
}

/* Featured Image */
.featured-image-container {
    position: relative;
    flex: 1;
    width: 100%;
    overflow: hidden;
}

.featured-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.featured-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: contain;
    background-position: center;
    opacity: 0;
    transform: scale(1.05);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    background-repeat: no-repeat;
}

.featured-image.active {
    opacity: 1;
    transform: scale(1);
}

.featured-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(0deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.4) 100%);
}

/* Image Info */
.image-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 30px;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.5s ease 0.3s;
}

.featured-image.active .image-info {
    transform: translateY(0);
    opacity: 1;
}

.info-content {
    max-width: 600px;
}

.info-content h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2d3748;
    text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.5);
}

.info-decoration {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #3b82f6);
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(16, 185, 129, 0.6);
    animation: pulseGlow 2s infinite alternate;
}

@keyframes pulseGlow {
    from {
        box-shadow: 0 0 5px rgba(16, 185, 129, 0.4);
    }
    to {
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.6), 0 0 30px rgba(59, 130, 246, 0.3);
    }
}

/* Thumbnail Strip */
.thumbnail-strip-container {
    position: relative;
    height: 120px;
    background: #f0f7ff;
    overflow: hidden;
    border-top: 1px solid rgba(59, 130, 246, 0.2);
}

.thumbnail-controls {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 10;
}

.control-prev, .control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid #10b981;
    color: #10b981;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    pointer-events: auto;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.control-prev {
    left: 20px;
}

.control-next {
    right: 20px;
}

.control-prev:hover, .control-next:hover {
    background: #10b981;
    color: white;
}

.thumbnail-strip {
    display: flex;
    align-items: center;
    height: 100%;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE/Edge */
    gap: 10px;
    padding: 0 80px;
}

.thumbnail-strip::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

.thumbnail {
    flex: 0 0 auto;
    width: 160px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    transform: scale(0.95);
    opacity: 0.6;
}

.thumbnail.active {
    border-color: #10b981;
    transform: scale(1);
    opacity: 1;
    box-shadow: 0 0 15px rgba(16, 185, 129, 0.6);
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail:hover img {
    transform: scale(1.1);
}

/* Animation Keyframes */
@keyframes fadeScale {
    0% {
        opacity: 0;
        transform: scale(1.1);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Styles */
@media (max-width: 991px) {
    .gallery-title {
        font-size: 2.5rem;
    }
    
    .info-content h3 {
        font-size: 2rem;
    }
    
    .thumbnail {
        width: 140px;
        height: 80px;
    }
    
    .gallery-showcase {
        height: 65vh;
        min-height: 550px;
    }
    
    .featured-image::before {
        background: linear-gradient(0deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 100%);
    }
}

@media (max-width: 767px) {
    .gallery-title {
        font-size: 2rem;
    }
    
    .gallery-header {
        padding: 40px 15px;
    }
    
    .info-content h3 {
        font-size: 1.5rem;
    }
    
    .thumbnail {
        width: 120px;
        height: 70px;
    }
    
    .thumbnail-strip {
        padding: 0 60px;
    }
    
    .gallery-showcase {
        height: 65vh;
        min-height: 500px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const thumbnails = document.querySelectorAll('.thumbnail');
    const navDots = document.querySelectorAll('.nav-dot');
    const featuredImages = document.querySelectorAll('.featured-image');
    const thumbnailStrip = document.querySelector('.thumbnail-strip');
    const prevBtn = document.querySelector('.control-prev');
    const nextBtn = document.querySelector('.control-next');
    const galleryContainer = document.querySelector('.gallery-container');
    
    let currentIndex = 0;
    let autoplayTimeout = null;
    const autoplaySpeed = 3000; // Reduced from 6000ms to 3000ms for faster autoplay
    let isAutoplayEnabled = true;
    let isGalleryInView = false;
    
    // Check if gallery is in viewport
    function checkGalleryInView() {
        const galleryRect = galleryContainer.getBoundingClientRect();
        return (
            galleryRect.top < (window.innerHeight || document.documentElement.clientHeight) &&
            galleryRect.bottom > 0
        );
    }
    
    // Function to change active image
    function changeImage(index) {
        // Update current index
        currentIndex = index;
        
        // Update featured images
        featuredImages.forEach(img => img.classList.remove('active'));
        featuredImages[index].classList.add('active');
        
        // Update thumbnails
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        thumbnails[index].classList.add('active');
        
        // Update navigation dots
        navDots.forEach(dot => dot.classList.remove('active'));
        navDots[index].classList.add('active');
        
        // Only scroll the thumbnail into view if gallery is in viewport
        const galleryRect = galleryContainer.getBoundingClientRect();
        const isInViewport = (
            galleryRect.top >= 0 &&
            galleryRect.left >= 0 &&
            galleryRect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            galleryRect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
        
        if (isInViewport) {
            thumbnails[index].scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });
        }
        
        // Reset autoplay timeout
        if (autoplayTimeout) {
            clearTimeout(autoplayTimeout);
        }
        
        // Set new autoplay timeout
        startAutoplay();
    }
    
    // Function to start autoplay
    function startAutoplay() {
        if (isAutoplayEnabled) {
            autoplayTimeout = setTimeout(() => {
                // Only change image if gallery is in view
                isGalleryInView = checkGalleryInView();
                if (isGalleryInView) {
                    let newIndex = currentIndex + 1;
                    if (newIndex >= featuredImages.length) newIndex = 0;
                    changeImage(newIndex);
                } else {
                    // If not in view, just restart the timer without changing image
                    startAutoplay();
                }
            }, autoplaySpeed);
        }
    }
    
    // Monitor scroll to detect when gallery enters or leaves viewport
    window.addEventListener('scroll', function() {
        isGalleryInView = checkGalleryInView();
    });
    
    // Check if gallery is initially in view
    isGalleryInView = checkGalleryInView();
    
    // Immediately start autoplay
    startAutoplay();
    
    // Set up thumbnail click events
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => changeImage(index));
    });
    
    // Set up navigation dot click events
    navDots.forEach((dot, index) => {
        dot.addEventListener('click', () => changeImage(index));
    });
    
    // Previous button
    prevBtn.addEventListener('click', () => {
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = featuredImages.length - 1;
        changeImage(newIndex);
    });
    
    // Next button
    nextBtn.addEventListener('click', () => {
        let newIndex = currentIndex + 1;
        if (newIndex >= featuredImages.length) newIndex = 0;
        changeImage(newIndex);
    });
    
    // Pause autoplay on hover
    galleryContainer.addEventListener('mouseenter', () => {
        if (autoplayTimeout) {
            clearTimeout(autoplayTimeout);
            autoplayTimeout = null;
        }
        isAutoplayEnabled = false;
    });
    
    galleryContainer.addEventListener('mouseleave', () => {
        isAutoplayEnabled = true;
        startAutoplay();
    });
    
    // Force all images to preload for smoother transitions
    featuredImages.forEach(img => {
        const bgUrl = img.style.backgroundImage.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
        const preloadImg = new Image();
        preloadImg.src = bgUrl;
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = featuredImages.length - 1;
            changeImage(newIndex);
        } else if (e.key === 'ArrowRight') {
            let newIndex = currentIndex + 1;
            if (newIndex >= featuredImages.length) newIndex = 0;
            changeImage(newIndex);
        }
    });
    
    // Swipe detection for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    const galleryShowcase = document.querySelector('.gallery-showcase');
    
    galleryShowcase.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        
        // Pause autoplay on touch
        if (autoplayTimeout) {
            clearTimeout(autoplayTimeout);
            autoplayTimeout = null;
        }
        isAutoplayEnabled = false;
    });
    
    galleryShowcase.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        
        // Resume autoplay after touch
        isAutoplayEnabled = true;
        startAutoplay();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next image
            let newIndex = currentIndex + 1;
            if (newIndex >= featuredImages.length) newIndex = 0;
            changeImage(newIndex);
        }
        
        if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous image
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = featuredImages.length - 1;
            changeImage(newIndex);
        }
    }
});
</script>

    <!-- Location Section -->
    <section id="location" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h2 class="fw-bold mb-4">{{ __('homepage.location.title') }}</h2>
                        <p class="text-secondary mb-4">{{ __('homepage.location.description') }}</p>
                        
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1 me-3" style="font-size: 1.25rem;"></i>
                            <div>
                                <h5 class="mb-1 h6 fw-bold">{{ __('homepage.location.address.title') }}</h5>
                                <p class="mb-0">{{ __('homepage.location.address.content') }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="fas fa-envelope text-primary mt-1 me-3" style="font-size: 1.25rem;"></i>
                            <div>
                                <h5 class="mb-1 h6 fw-bold">{{ __('homepage.location.email.title') }}</h5>
                                <p class="mb-0">crp@markaz-oujda.com</p>
                            </div>
                        </div>
                        
                        <a href="https://maps.app.goo.gl/8zbQf7E21C3FiMx99" target="_blank" class="btn btn-primary">
                            <i class="fas fa-directions me-2"></i>{{ __('homepage.location.get_directions') }}
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.0650964313495!2d-1.915168!3d34.6783065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd78659d1f422f09%3A0xf34ce4c061aff2ff!2z2KfZhNmF2K_Ysdiz2Kkg2KfZhNil2KjYqtiv2KfYptmK2Kkg2LPZitiv2Yog2LLZitin2YYg2KfZhNmF2K7YqtmE2LfYqQ!5e0!3m2!1sen!2sma!4v1735366763972!5m2!1sen!2sma"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection