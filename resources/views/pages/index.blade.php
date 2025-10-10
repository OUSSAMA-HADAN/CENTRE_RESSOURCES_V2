@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
  








<!-- Enhanced Hero Section with Perfect Responsiveness -->
<section id="hero" class="hero position-relative d-flex align-items-center justify-content-center text-white" style="min-height: 100vh; padding-top: 80px; background: linear-gradient(rgba(16, 185, 129, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('storage/images/hero-img.webp') }}') center/cover no-repeat fixed; overflow: hidden;">
    
    <!-- Animated Particles -->
    <div class="particles-container position-absolute w-100 h-100 top-0 start-0" style="z-index: 1;"></div>
    
    <div class="container position-relative" style="z-index: 10;">

        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <!-- Enhanced Animated Logo Icon -->
                <div class="animate__animated animate__fadeInDown">
                    <div class="hero-logo-container">
                        <i class="fas fa-graduation-cap hero-logo-icon"></i>
                    </div>
                </div>
                
                <!-- Enhanced Main Title - French -->
                <h1 class="hero-title-gradient animate__animated animate__fadeInUp">
                    Centre de Ressources du Préscolaire - OUJDA
                </h1>
                
                <!-- Enhanced Title in Arabic -->
                <h2 class="hero-arabic-title animate__animated animate__fadeInUp animate__delay-1s">
                    مركز موارد التعليم الأولي - وجدة
                </h2>
                
                <!-- Enhanced Glowing Separator -->
                <div class="animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="hero-separator-enhanced"></div>
                </div>
                
                <!-- Enhanced Action buttons with hover effects -->
                <div class="hero-buttons-container animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{route('inscription.form')}}" class="btn hero-btn-primary shadow-sm">
                        <i class="fas fa-user-plus me-2"></i>{{ __('homepage.register_button') }}
                    </a>
                    <a href="#surNous" class="btn hero-btn-secondary">
                        <i class="fas fa-info-circle me-2"></i>{{ __('homepage.more_info_button') }}
                    </a>
                </div>

                <!-- TV News Ticker Bar - Now positioned relative to content -->
                <div class="news-ticker-wrapper animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="news-ticker">
                        <div class="news-ticker-content">
                            <div class="news-ticker-text">{{ __('homepage.disclamer') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced wave effect at bottom with multiple layers -->
    <div class="position-absolute bottom-0 start-0 w-100" style="z-index: 2;">
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255,0.1)"></use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255,0.2)"></use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#f8f9fa"></use>
            </g>
        </svg>
    </div>

    <style>
        /* Development Banner */
        .dev-banner {
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            z-index: 1000;
            text-align: center;
            transform: rotate(-2deg);
        }
        
        .dev-banner-inner {
            display: inline-block;
            background-color: #f7a223;
            color: white;
            font-weight: bold;
            padding: 8px 25px;
            font-size: 18px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            animation: pulse-banner 2s infinite;
            border-radius: 4px;
            transform: rotate(0deg);
        }
        
        @keyframes pulse-banner {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Professional Enhancement Styles */
        .hero-logo-container {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            padding: 2rem;
            display: inline-block;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .hero-logo-container:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.18);
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.2);
        }

        .hero-logo-icon {
            background: linear-gradient(135deg, #ffc107, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 4px 8px rgba(255, 193, 7, 0.3));
            font-size: 4rem;
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
            font-size: 3.5rem;
            font-weight: 700;
        }

        .hero-arabic-title {
            text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            font-family: 'Amiri', serif;
            opacity: 0.95;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 600;
        }

        .hero-separator-enhanced {
            width: 150px;
            height: 4px;
            background: linear-gradient(90deg, transparent, #ffc107, transparent);
            border-radius: 2px;
            box-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
            position: relative;
            margin: 2rem auto;
        }

        .hero-separator-enhanced::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            background: #ffc107;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.8);
        }

        .hero-buttons-container {
            margin-bottom: 2rem;
            gap: 1rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-btn-primary {
            background: linear-gradient(135deg, #ffc107 0%, #f59e0b 100%);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .hero-btn-primary:hover::before {
            left: 100%;
        }

        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
            background: linear-gradient(135deg, #f59e0b 0%, #ffc107 100%);
            color: white;
            text-decoration: none;
        }

        .hero-btn-secondary {
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
        }

        /* Enhanced particles animation */
        .particles-container::before,
        .particles-container::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particles-container::before {
            top: 20%;
            left: 10%;
            animation-delay: -2s;
        }

        .particles-container::after {
            top: 60%;
            right: 15%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
                opacity: 0.4; 
            }
            50% { 
                transform: translateY(-25px) rotate(180deg); 
                opacity: 0.8; 
            }
        }

        /* FIXED TV News Ticker Bar Styles */
        .news-ticker-wrapper {
            position: relative;
            width: 100%;
            margin: 2rem auto 0;
            padding: 0 15px;
            z-index: 50;
        }

        .news-ticker {
            width: 100%;
            height: 50px;
            background: #7edc2671;
            color: white;
            box-shadow: 0 2px 15px rgba(65, 220, 38, 0.4);
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .news-ticker-content {
            display: flex;
            align-items: center;
            height: 100%;
            white-space: nowrap;
            animation: scrollNews 30s linear infinite;
        }

        .news-ticker-label {
            background: #2c991bff;
            padding: 0 20px;
            height: 100%;
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            flex-shrink: 0;
            border-right: 3px solid #26d712ff;
        }

        .news-ticker-text {
            padding: 0 30px;
            font-size: 15px;
            font-weight: 500;
            line-height: 1.2;
            white-space: nowrap;
            overflow: visible;
            min-width: max-content;
            flex-shrink: 0;
        }

        @keyframes scrollNews {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-200%);
            }
        }

        /* RTL animation for Arabic mode */
        html[lang="ar"] .news-ticker-content,
        body[lang="ar"] .news-ticker-content,
        [lang="ar"] .news-ticker-content {
            animation: scrollNewsRTL 40s linear infinite;
        }

        @keyframes scrollNewsRTL {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(300%);
            }
        }

        /* Adjust label position for RTL */
        html[lang="ar"] .news-ticker-label,
        body[lang="ar"] .news-ticker-label,
        [lang="ar"] .news-ticker-label {
            border-right: none;
            border-left: 3px solid #dc2626;
            order: 2;
        }

        html[lang="ar"] .news-ticker-text,
        body[lang="ar"] .news-ticker-text,
        [lang="ar"] .news-ticker-text {
            order: 1;
            direction: rtl;
            text-align: right;
        }

        /* Hero waves animation enhanced */
        .hero .hero-waves {
            display: block;
            width: 100%;
            height: 60px;
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
        }

        .hero .wave1 use {
            animation: move-forever1 10s linear infinite;
            animation-delay: -2s;
        }

        .hero .wave2 use {
            animation: move-forever2 8s linear infinite;
            animation-delay: -2s;
        }

        .hero .wave3 use {
            animation: move-forever3 6s linear infinite;
            animation-delay: -2s;
        }

        @keyframes move-forever1 {
            0% { transform: translate(85px, 0%); }
            100% { transform: translate(-90px, 0%); }
        }

        @keyframes move-forever2 {
            0% { transform: translate(-90px, 0%); }
            100% { transform: translate(85px, 0%); }
        }

        @keyframes move-forever3 {
            0% { transform: translate(-90px, 0%); }
            100% { transform: translate(85px, 0%); }
        }

        /* Tablet Responsive (768px - 991px) */
        @media (max-width: 991.98px) {
            .hero {
                min-height: 95vh;
                padding-top: 70px;
            }
            
            .hero-logo-container {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .hero-logo-icon {
                font-size: 3.5rem;
            }
            
            .hero-title-gradient {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }
            
            .hero-arabic-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .hero-separator-enhanced {
                width: 120px;
                margin: 1.5rem auto;
            }
            
            .hero-buttons-container {
                margin-bottom: 2rem;
            }
            
            .hero-btn-primary,
            .hero-btn-secondary {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
            
            .news-ticker-wrapper {
                margin-top: 1.5rem;
                padding: 0 10px;
            }
            
            .news-ticker {
                height: 45px;
            }
            
            .news-ticker-label {
                padding: 0 15px;
                font-size: 12px;
            }
            
            .news-ticker-text {
                font-size: 13px;
                padding: 0 20px;
            }
        }

        /* Mobile Responsive (max-width: 767px) */
        @media (max-width: 767.98px) {
            .hero {
                min-height: 90vh;
                padding-top: 60px;
            }
            
            .dev-banner {
                top: 15px;
            }
            
            .dev-banner-inner {
                font-size: 16px;
                padding: 6px 20px;
            }
            
            .hero-logo-container {
                padding: 1.25rem;
                margin-bottom: 1.25rem;
                margin-top: 40px;
            }
            
            .hero-logo-icon {
                font-size: 3rem;
            }
            
            .hero-title-gradient {
                font-size: 2rem;
                margin-bottom: 1rem;
                line-height: 1.2;
            }
            
            .hero-arabic-title {
                font-size: 1.25rem;
                margin-bottom: 1.25rem;
            }
            
            .hero-separator-enhanced {
                width: 100px;
                margin: 1.25rem auto;
            }
            
            .hero-buttons-container {
                flex-direction: column;
                margin-bottom: 1.5rem;
                gap: 0.75rem;
            }
            
            .hero-btn-primary,
            .hero-btn-secondary {
                padding: 0.75rem 1.25rem;
                font-size: 0.95rem;
                width: 100%;
                max-width: 280px;
                margin: 0 auto;
            }
            
            .news-ticker-wrapper {
                margin-top: 1.25rem;
                padding: 0 10px;
            }
            
            .news-ticker {
                height: 45px;
                border-radius: 6px;
            }
            
            .news-ticker-content {
                animation: scrollNewsMobile 40s linear infinite;
            }
            
            html[lang="ar"] .news-ticker-content,
            body[lang="ar"] .news-ticker-content,
            [lang="ar"] .news-ticker-content {
                animation: scrollNewsRTLMobile 25s linear infinite;
            }
            
            .news-ticker-label {
                padding: 0 15px;
                font-size: 12px;
            }
            
            .news-ticker-text {
                font-size: 13px;
                padding: 0 20px;
            }
        }

        /* Small Mobile Responsive (max-width: 575px) */
        @media (max-width: 575.98px) {
            .hero {
                min-height: 85vh;
                padding-top: 50px;
            }
            
            .dev-banner {
                top: 10px;
            }
            
            .dev-banner-inner {
                font-size: 14px;
                padding: 5px 15px;
            }
            
            .hero-logo-container {
                padding: 1rem;
                margin-bottom: 1rem;
                margin-top: 30px;
            }
            
            .hero-logo-icon {
                font-size: 2.5rem;
            }
            
            .hero-title-gradient {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
                line-height: 1.1;
            }
            
            .hero-arabic-title {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }
            
            .hero-separator-enhanced {
                width: 80px;
                margin: 1rem auto;
            }
            
            .hero-buttons-container {
                margin-bottom: 1rem;
                gap: 0.5rem;
            }
            
            .hero-btn-primary,
            .hero-btn-secondary {
                padding: 0.625rem 1rem;
                font-size: 0.9rem;
                max-width: 250px;
            }
            
            .news-ticker-wrapper {
                margin-top: 1rem;
                padding: 0 5px;
            }
            
            .news-ticker {
                height: 40px;
                border-radius: 4px;
            }
            
            .news-ticker-content {
                animation: scrollNewsMobile 30s linear infinite;
            }
            
            html[lang="ar"] .news-ticker-content,
            body[lang="ar"] .news-ticker-content,
            [lang="ar"] .news-ticker-content {
                animation: scrollNewsRTLMobile 30s linear infinite;
            }
            
            .news-ticker-label {
                padding: 0 12px;
                font-size: 11px;
            }
            
            .news-ticker-text {
                font-size: 12px;
                padding: 0 15px;
            }
        }

        /* Extra Small Mobile (max-width: 375px) */
        @media (max-width: 375px) {
            .hero-title-gradient {
                font-size: 1.5rem;
            }
            
            .hero-arabic-title {
                font-size: 1rem;
            }
            
            .hero-btn-primary,
            .hero-btn-secondary {
                font-size: 0.85rem;
                max-width: 220px;
            }
            
            .news-ticker-wrapper {
                margin-top: 0.75rem;
            }
            
            .news-ticker {
                height: 35px;
            }
            
            .news-ticker-label {
                padding: 0 10px;
                font-size: 10px;
            }
            
            .news-ticker-text {
                font-size: 11px;
                padding: 0 12px;
            }
        }

        /* Mobile-specific animations with longer distance */
        @keyframes scrollNewsMobile {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-400%);
            }
        }

        @keyframes scrollNewsRTLMobile {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(250%);
            }
        }

        /* Handle fixed background for iOS */
        @supports (-webkit-overflow-scrolling: touch) {
            .hero {
                background-attachment: scroll;
            }
        }
    </style>
</section>

<!-- Responsive JS code for particles -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create and animate floating particles in the hero section
    const particlesContainer = document.querySelector('.particles-container');
    
    if (particlesContainer) {
        // Adjust number of particles based on screen size
        const width = window.innerWidth;
        const particleCount = width < 768 ? 25 : 50;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            
            // Random styling for particles - smaller for mobile
            const size = width < 768 ? (Math.random() * 3 + 1) : (Math.random() * 5 + 2);
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const opacity = Math.random() * 0.5 + 0.1;
            const animDuration = Math.random() * 15 + 10;
            const animDelay = Math.random() * 5;
            
            // Set particle styles
            particle.style.position = 'absolute';
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.borderRadius = '50%';
            particle.style.backgroundColor = 'rgba(255, 255, 255, ' + opacity + ')';
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animation = `floatParticle ${animDuration}s ease-in-out ${animDelay}s infinite`;
            
            particlesContainer.appendChild(particle);
        }
    }
    
    // Smooth scroll for anchor links with offset for fixed header
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Get header height for offset
                const headerHeight = document.querySelector('header') ? 
                    document.querySelector('header').offsetHeight : 0;
                
                window.scrollTo({
                    top: targetElement.offsetTop - headerHeight,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Add keyframe animation for particles
const style = document.createElement('style');
style.innerHTML = `
    @keyframes floatParticle {
        0%, 100% {
            transform: translateY(0) translateX(0);
        }
        25% {
            transform: translateY(-15px) translateX(10px);
        }
        50% {
            transform: translateY(-25px) translateX(-5px);
        }
        75% {
            transform: translateY(-10px) translateX(-10px);
        }
    }
`;
document.head.appendChild(style);
</script>






























<!-- Professional Sur Nous Section -->
<section id="surNous" class="py-5 bg-white">
    <div class="container">
        <!-- Section Header - First -->
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-4">{{ __('homepage.about.title') }}</h2>
                    <p class="lead text-muted mb-5">{{ __('homepage.about.description') }}</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- Image Column - Second -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative">
                    <div class="image-frame rounded-3 overflow-hidden shadow-sm">
                        <img src="{{ asset('storage/images/ecole.webp') }}" class="img-fluid w-100" alt="Centre de Ressources du Préscolaire" style="height: 500px; object-fit: cover;">
                    </div>
                    <!-- Decorative Element -->
                    <div class="position-absolute top-0 end-0 w-25 h-25 bg-primary bg-opacity-05 rounded-3 translate-middle-y"></div>
                </div>
            </div>
            
            <!-- Features Column - Third -->
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <!-- Features List -->
                    <div class="features-list">
                        <!-- Feature 1 -->
                        <div class="feature-item d-flex align-items-start mb-4 p-4 rounded-3 border border-light-subtle bg-light-subtle">
                            <div class="feature-icon bg-primary bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                                <i class="fas fa-graduation-cap fa-lg text-primary"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.about.professional_training.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.professional_training.description') }}</p>
                            </div>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="feature-item d-flex align-items-start mb-4 p-4 rounded-3 border border-light-subtle bg-light-subtle">
                            <div class="feature-icon bg-success bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                                <i class="fas fa-chalkboard-teacher fa-lg text-success"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.about.qualified_experts.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.qualified_experts.description') }}</p>
                            </div>
                        </div>
                        
                        <!-- Feature 3 -->
                        <div class="feature-item d-flex align-items-start mb-4 p-4 rounded-3 border border-light-subtle bg-light-subtle">
                            <div class="feature-icon bg-warning bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                                <i class="fas fa-tools fa-lg text-warning"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.about.pedagogical_resources.title') }}</h5>
                                <p class="text-muted mb-0">{{ __('homepage.about.pedagogical_resources.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-opacity-05 { background-color: rgba(var(--bs-primary-rgb), 0.05) !important; }
        .bg-opacity-10 { background-color: rgba(var(--bs-primary-rgb), 0.1) !important; }
        
        .feature-item {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef !important;
        }
        
        .feature-item:hover {
            border-color: var(--bs-primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .feature-icon {
            transition: transform 0.3s ease;
        }
        
        .feature-item:hover .feature-icon {
            transform: scale(1.05);
        }
        
        .image-frame {
            transition: transform 0.3s ease;
        }
        
        .image-frame:hover {
            transform: scale(1.01);
        }
        
        @media (max-width: 991.98px) {
            .display-6 {
                font-size: 2rem;
            }
            
            .feature-item {
                padding: 1.5rem !important;
            }
            
            .image-frame img {
                height: 400px !important;
            }
        }
        
        @media (max-width: 767.98px) {
            .display-6 {
                font-size: 1.75rem;
            }
            
            .feature-item {
                flex-direction: column;
                text-align: center;
            }
            
            .feature-icon {
                margin-right: 0 !important;
                margin-bottom: 1rem;
            }
            
            .image-frame img {
                height: 350px !important;
            }
        }
        
        @media (max-width: 575.98px) {
            .image-frame img {
                height: 300px !important;
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
            <!-- Research and Development Unit -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-3 shadow-sm h-100 unit-card bg-white">
                    <div class="card-header bg-white border-bottom py-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-microscope fa-lg text-primary"></i>
                            </div>
                            <h5 class="mb-0 fw-semibold text-dark">{{ __('units.research.title') }}</h5>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">{{ __('units.research.description') }}</p>
                        <ul class="list-unstyled mb-0">
                            @foreach(__('units.research.key_areas') as $area)
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 me-2 fs-6"></i>
                                    <span class="text-muted">{{ $area }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-white border-0 py-3">
                        <a href="{{route('recherche.index')}}" class="btn btn-outline-primary w-100 py-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            {{ __('units.research.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Documentation and Production Unit -->
            <div class="col-lg-4 col-md-6">
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
            <div class="col-lg-4 col-md-6">
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
<section id="director" class="py-5 bg-white">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill">
                {{ __('homepage.director.badge') }}
            </span>
            <h2 class="display-6 fw-bold text-dark mb-3">
                {{ __('homepage.director.title_part1') }} 
                <span class="text-primary">{{ __('homepage.director.title_part2') }}</span>
            </h2>
            <div class="d-flex justify-content-center mb-4">
                <div style="width: 80px; height: 3px; background: linear-gradient(90deg, #10b981, #0ea5e9);"></div>
            </div>
            <p class="lead text-muted col-lg-8 mx-auto">
                {{ __('homepage.director.description') }}
            </p>
        </div>
        
        <div class="row align-items-center g-5">
           <!-- Image Column -->
<div class="col-lg-5">
    <div class="director-profile">
        <div class="image-container rounded-3 overflow-hidden shadow-sm">
            <img src="{{ asset('storage/images/prf.webp') }}" class="img-fluid director-image" alt="Responsable du Centre" style="width: 100%; height: 500px; object-fit: cover; object-position: center center;">
        </div>
        
        <!-- Experience Badge -->
        <div class="experience-badge bg-primary text-white rounded-3 p-3 shadow-sm mt-4 text-center">
            <div class="h4 mb-0 fw-bold">20+</div>
            <small class="opacity-90">{{ __('homepage.director.years_experience') }}</small>
        </div>
    </div>
</div>
            
            <!-- Content Column -->
            <div class="col-lg-7">
                <div class="expertise-list">
                    <!-- Expertise Item 1 -->
                    <div class="expertise-item d-flex align-items-start mb-4 p-4 rounded-3 border border-light-subtle bg-light-subtle">
                        <div class="expertise-icon bg-primary bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                            <i class="fas fa-graduation-cap fa-lg text-primary"></i>
                        </div>
                        <div class="expertise-content">
                            <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.director.expertise.formation.title') }}</h5>
                            <p class="text-muted mb-0">{{ __('homepage.director.expertise.formation.description') }}</p>
                        </div>
                    </div>
                    
                    <!-- Expertise Item 2 -->
                    <div class="expertise-item d-flex align-items-start mb-4 p-4 rounded-3 border border-light-subtle bg-light-subtle">
                        <div class="expertise-icon bg-success bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                            <i class="fas fa-chalkboard-teacher fa-lg text-success"></i>
                        </div>
                        <div class="expertise-content">
                            <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.director.expertise.experience.title') }}</h5>
                            <p class="text-muted mb-0">{{ __('homepage.director.expertise.experience.description') }}</p>
                        </div>
                    </div>
                    
                    <!-- Expertise Item 3 -->
                    <div class="expertise-item d-flex align-items-start p-4 rounded-3 border border-light-subtle bg-light-subtle">
                        <div class="expertise-icon bg-warning bg-opacity-10 rounded-3 p-3 me-4 flex-shrink-0">
                            <i class="fas fa-certificate fa-lg text-warning"></i>
                        </div>
                        <div class="expertise-content">
                            <h5 class="fw-semibold text-dark mb-2">{{ __('homepage.director.expertise.pedagogy.title') }}</h5>
                            <p class="text-muted mb-0">{{ __('homepage.director.expertise.pedagogy.description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-opacity-05 { background-color: rgba(var(--bs-primary-rgb), 0.05) !important; }
        .bg-opacity-10 { background-color: rgba(var(--bs-primary-rgb), 0.1) !important; }
        
        .director-profile {
            transition: transform 0.3s ease;
        }
        
        .image-container {
            transition: all 0.3s ease;
        }
        
        .director-image {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            object-position: center top;
        }
        
        .image-container:hover {
            transform: scale(1.01);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }
        
        .experience-badge {
            transition: all 0.3s ease;
            min-width: 100px;
            display: inline-block;
        }
        
        .director-profile:hover .experience-badge {
            transform: scale(1.05);
        }
        
        .expertise-item {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef !important;
        }
        
        .expertise-item:hover {
            border-color: var(--bs-primary) !important;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .expertise-icon {
            transition: transform 0.3s ease;
        }
        
        .expertise-item:hover .expertise-icon {
            transform: scale(1.05);
        }
        
        /* Desktop specific styles */
        @media (min-width: 992px) {
            .director-image {
                height: 500px;
            }
        }
        
        /* Tablet and mobile adjustments */
        @media (max-width: 991.98px) {
            .display-6 {
                font-size: 2rem;
            }
            
            .director-image {
                height: 400px;
                object-position: center center;
            }
            
            .expertise-item {
                padding: 1.5rem !important;
            }
        }
        
        @media (max-width: 767.98px) {
            .display-6 {
                font-size: 1.75rem;
            }
            
            .director-image {
                height: 350px;
                object-position: center center;
            }
            
            .expertise-item {
                flex-direction: column;
                text-align: center;
            }
            
            .expertise-icon {
                margin-right: 0 !important;
                margin-bottom: 1rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .director-image {
                height: 300px;
                object-position: center center;
            }
            
            .experience-badge {
                min-width: 80px;
                padding: 1rem !important;
            }
        }
        
        @media (max-width: 375px) {
            .director-image {
                height: 250px;
                object-position: center center;
            }
        }
        .director-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    object-position: center center;
}

/* Responsive height adjustments */
@media (max-width: 991.98px) {
    .director-image {
        height: 400px;
    }
}

@media (max-width: 767.98px) {
    .director-image {
        height: 350px;
    }
}

@media (max-width: 575.98px) {
    .director-image {
        height: 300px;
    }
}

@media (max-width: 375px) {
    .director-image {
        height: 250px;
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

