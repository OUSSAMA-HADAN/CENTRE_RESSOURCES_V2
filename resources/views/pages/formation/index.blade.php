@extends('layouts.app')

@section('title', 'Formations en ligne')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden mt-5" style="min-height: 80vh; background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
    <div class="hero-background position-absolute w-100 h-100" style="background: url('{{ asset('storage/images/formation-bg.jpg') }}') center/cover no-repeat; opacity: 0.1; top: 0; left: 0; z-index: 0;"></div>

    <!-- Professional overlay pattern -->
    <div class="position-absolute w-100 h-100" style="background: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%); z-index: 1;"></div>
    
    <div class="container position-relative" style="z-index: 5;">
        <div class="row justify-content-center align-items-center min-vh-75">
            <div class="col-lg-10 text-center text-white py-5">
                <!-- Badge -->
                <div class="badge bg-white text-dark px-4 py-2 mb-4 shadow-sm" style="font-size: 1rem; font-weight: 500;">
                    <i class="fas fa-graduation-cap me-2"></i>{{ __('formation.badge') }}
                </div>
                
                <!-- Main Title -->
                <h1 class="display-2 fw-bold mb-4 text-shadow" style="font-weight: 700; line-height: 1.2;">
                    {{ __('formation.title') }}
                </h1>
                
                <!-- Decorative Line -->
                <div class="d-flex justify-content-center mb-5">
                    <div style="width: 120px; height: 4px; background: linear-gradient(90deg, #ffc107, #f59e0b); border-radius: 2px;"></div>
                </div>
                
                <!-- Subtitle -->
                <p class="lead mb-0 text-shadow" style="font-size: 1.3rem; font-weight: 300; max-width: 800px; margin: 0 auto;">
                    {{ __('formation.description') }}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Professional Wave Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="transform: translateY(1px);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100" style="height: 100px;">
            <path fill="#f8f9fa" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,197.3C384,181,480,139,576,144C672,149,768,203,864,202.7C960,203,1056,149,1152,133.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Notre approche -->
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="approach-card border-0 rounded-4 shadow-lg bg-white overflow-hidden">
                    <div class="p-5">
                        <div class="text-center mb-5">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-4 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-lightbulb me-2"></i>{{ __('formation.approach.badge') }}
                            </span>
                            <h2 class="display-5 fw-bold text-dark mb-3">{{ __('formation.approach.title') }}</h2>
                            <div class="d-flex justify-content-center mb-4">
                                <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #10b981, #0ea5e9); border-radius: 2px;"></div>
                            </div>
                            <p class="text-muted lead col-lg-8 mx-auto">{{ __('formation.approach.description') }}</p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="approach-feature-card h-100 p-4 rounded-4 border-0 shadow-sm text-center">
                                    <div class="approach-icon-wrapper mb-3">
                                        <div class="approach-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                            <i class="fas fa-laptop fa-2x text-white"></i>
                                    </div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-3">{{ __('formation.approach.flexibility.title') }}</h5>
                                    <p class="text-muted mb-0">{{ __('formation.approach.flexibility.description') }}</p>
                                    </div>
                                </div>
                                
                            <div class="col-md-4">
                                <div class="approach-feature-card h-100 p-4 rounded-4 border-0 shadow-sm text-center">
                                    <div class="approach-icon-wrapper mb-3">
                                        <div class="approach-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #f7a223 0%, #e89417 100%);">
                                            <i class="fas fa-certificate fa-2x text-white"></i>
                                    </div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-3">{{ __('formation.approach.certification.title') }}</h5>
                                    <p class="text-muted mb-0">{{ __('formation.approach.certification.description') }}</p>
                                    </div>
                                </div>
                                
                            <div class="col-md-4">
                                <div class="approach-feature-card h-100 p-4 rounded-4 border-0 shadow-sm text-center">
                                    <div class="approach-icon-wrapper mb-3">
                                        <div class="approach-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                                            <i class="fas fa-users fa-2x text-white"></i>
                                    </div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-3">{{ __('formation.approach.community.title') }}</h5>
                                    <p class="text-muted mb-0">{{ __('formation.approach.community.description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>













<!-- Formations programmées -->
<section id="formations" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-calendar-check me-2"></i>{{ __('formation.programmed.badge') }}
            </span>
            <h2 class="display-5 fw-bold mb-3 text-dark">{{ __('formation.programmed.title') }}</h2>
            <div class="d-flex justify-content-center mb-4">
                <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #10b981, #0ea5e9); border-radius: 2px;"></div>
            </div>
            <p class="text-muted lead col-lg-8 mx-auto">{{ __('formation.programmed.description') }}</p>
        </div>
        @if(isset($formations) && count($formations) > 0)
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach($formations as $formation)
                <div class="col">
                    <div class="formation-modern-card h-100 border-0 rounded-4 shadow-sm overflow-hidden position-relative">
                        @if($formation->thumbnail)
                        <div class="formation-card-image-wrapper">
                            <img 
                                src="{{ $formation->thumbnail_url }}" 
                                alt="{{ $formation->title }}" 
                                class="formation-card-image w-100"
                            >
                            <div class="formation-card-overlay"></div>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2">{{ __('formation.card.online') }}</span>
                                    <h5 class="fw-bold text-dark mb-0">{{ $formation->title }}</h5>
                                </div>
                                <div class="formation-icon-badge">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                                </div>
                            </div>
                            
                            <p class="text-muted mb-4 small">{{ Str::limit($formation->description, 100) }}</p>
                            
                            <div class="formation-details-modern">
                                <div class="detail-item d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <small class="text-muted">
                                        {{ $formation->start_date ? $formation->start_date->format('d/m/Y') : __('formation.card.no_date') }}
                                    </small>
                                </div>
                                
                                <div class="detail-item d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <small class="text-muted">
                                        {{ $formation->duration ?? __('formation.card.no_duration') }}
                                    </small>
                                </div>
                                
                                <div class="detail-item d-flex align-items-center mb-2">
                                    <i class="fas fa-user-tie text-primary me-2"></i>
                                    <small class="text-muted">
                                        {{ $formation->formateur_name ?? __('formation.card.no_trainer') }}
                                    </small>
                                </div>
                                
                                <div class="detail-item d-flex align-items-center">
                                    <i class="fas fa-desktop text-primary me-2"></i>
                                    <small class="text-muted">
                                        {{ $formation->platform_name ?? __('formation.card.no_platform') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 pt-0">
                            <a 
                                href="{{ route('formation.show', $formation->slug) }}" 
                                class="btn btn-outline-primary w-100 rounded-pill"
                            >
                                <i class="fas fa-info-circle me-2"></i>{{ __('formation.card.details_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5 text-center">
                <div class="mb-4">
                    <i class="fas fa-graduation-cap fa-5x text-muted opacity-50"></i>
                </div>
                <h3 class="mb-3 text-muted">Aucune formation disponible</h3>
                <p class="text-muted mb-4">
                    Nos équipes travaillent actuellement sur de nouveaux ateliers. 
                    Restez à l'écoute pour des opportunités de formation à venir !
                </p>
                <!--<a href="#" class="btn btn-primary">-->
                <!--    <i class="fas fa-bell me-2"></i>Restez informé-->
                <!--</a>-->
            </div>
        </div>
    @endif
</div>
</section>
@push('styles')
<style>
    /* Professional Hero Styling */
    .text-shadow {
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.4);
    }

    .hero-section {
        padding-top: calc(3rem + 50px) !important;
        padding-bottom: 5rem !important;
        margin-top: 0 !important;
        position: relative;
    }

    /* Professional Badge */
    .badge {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Title Animation */
    h1 {
        animation: fadeInUp 1s ease-out;
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

    /* Subtitle Animation */
    .lead {
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    /* Decorative Line Animation */
    .d-flex div {
        animation: expandLine 1.5s ease-out 0.6s both;
    }

    @keyframes expandLine {
        from {
            width: 0;
        }
        to {
            width: 120px;
        }
    }

    /* Professional Gradient Overlay */
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.95) 100%);
        z-index: 2;
    }

    /* Ensure content is above overlay */
    .container {
        position: relative;
        z-index: 10;
    }

    /* Approach Section */
    .approach-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .approach-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .approach-feature-card {
        transition: all 0.3s ease;
        background: white;
    }

    .approach-feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .approach-icon-circle {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .approach-feature-card:hover .approach-icon-circle {
        transform: scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Formation Cards */
    .formation-modern-card {
        background: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .formation-modern-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .formation-card-image-wrapper {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .formation-card-image {
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .formation-modern-card:hover .formation-card-image {
        transform: scale(1.1);
    }

    .formation-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.5) 100%);
    }

    .formation-icon-badge {
        width: 50px;
        height: 50px;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .formation-modern-card:hover .formation-icon-badge {
        transform: scale(1.1) rotate(5deg);
    }

    /* Why Choose Cards */
    .why-card {
        background: white;
        transition: all 0.3s ease;
    }
    
    .why-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .why-icon-circle {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .why-card:hover .why-icon-circle {
        transform: scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .display-2, .display-5 {
            font-size: 2.5rem !important;
        }
        
        .hero-section {
            min-height: 70vh !important;
        }
    }

    @media (max-width: 767.98px) {
        .display-2, .display-5 {
            font-size: 2rem !important;
        }
        
        .hero-section {
            min-height: 60vh !important;
        }

        .lead {
            font-size: 1.1rem !important;
        }
    }

    @media (max-width: 575.98px) {
        .hero-section {
            min-height: 50vh !important;
        }

        .display-2 {
            font-size: 1.75rem !important;
        }
    }
</style>
@endpush














<!-- Pourquoi nos formations -->
<section class="py-5 bg-light-subtle">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-star me-2"></i>{{ __('formation.why_choose.badge') }}
            </span>
            <h2 class="display-5 fw-bold mb-3 text-dark">{{ __('formation.why_choose.title') }}</h2>
            <div class="d-flex justify-content-center mb-4">
                <div style="width: 100px; height: 4px; background: linear-gradient(90deg, #10b981, #0ea5e9); border-radius: 2px;"></div>
            </div>
            <p class="text-muted lead col-lg-8 mx-auto">{{ __('formation.why_choose.description') }}</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="why-card h-100 p-5 rounded-4 border-0 shadow-sm text-center">
                    <div class="why-icon-wrapper mb-4">
                        <div class="why-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-graduation-cap fa-3x text-white"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">{{ __('formation.why_choose.expertise.title') }}</h4>
                    <p class="text-muted mb-0">{{ __('formation.why_choose.expertise.description') }}</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="why-card h-100 p-5 rounded-4 border-0 shadow-sm text-center">
                    <div class="why-icon-wrapper mb-4">
                        <div class="why-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f7a223 0%, #e89417 100%);">
                            <i class="fas fa-cogs fa-3x text-white"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">{{ __('formation.why_choose.practical.title') }}</h4>
                    <p class="text-muted mb-0">{{ __('formation.why_choose.practical.description') }}</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="why-card h-100 p-5 rounded-4 border-0 shadow-sm text-center">
                    <div class="why-icon-wrapper mb-4">
                        <div class="why-icon-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                            <i class="fas fa-comments fa-3x text-white"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">{{ __('formation.why_choose.support.title') }}</h4>
                    <p class="text-muted mb-0">{{ __('formation.why_choose.support.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<!--<section class="py-5 bg-info text-white">-->
<!--    <div class="container text-center py-3">-->
<!--        <h2 class="fw-bold mb-4">{{ __('formation.cta.title') }}</h2>-->
<!--        <p class="lead mb-4">{{ __('formation.cta.description') }}</p>-->
<!--        <div class="d-flex flex-column flex-md-row justify-content-center gap-3">-->
<!--            <a href="{{ route('inscription.form') }}" class="btn btn-light btn-lg px-4">-->
<!--                <i class="fas fa-user-plus me-2"></i>{{ __('formation.cta.register_button') }}-->
<!--            </a>-->
<!--            <a href="mailto:crp@markaz-oujda.com" class="btn btn-outline-light btn-lg px-4">-->
<!--                <i class="fas fa-envelope me-2"></i>{{ __('formation.cta.contact_button') }}-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
@endsection
