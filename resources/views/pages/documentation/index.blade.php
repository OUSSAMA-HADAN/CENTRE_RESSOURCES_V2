@extends('layouts.app')

@section('title', 'Unité de Documentation et Production')
@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden mt-5" style="min-height: 80vh; background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
        <div class="hero-background position-absolute w-100 h-100"
            style="background: url('{{ asset('storage/images/research-bg.jpg') }}') center/cover no-repeat; opacity: 0.1; top: 0; left: 0; z-index: 0;">
        </div>

        <!-- Professional overlay pattern -->
        <div class="position-absolute w-100 h-100" style="background: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%); z-index: 1;"></div>

        <div class="container position-relative" style="z-index: 5;">
            <div class="row justify-content-center align-items-center min-vh-75">
                <div class="col-lg-10 text-center text-white py-5">
                    <!-- Logo Section -->
                    <div class="logo-section mb-5">
                        <img src="{{ asset('storage/images/logo.png') }}" alt="Centre de Ressources du Préscolaire" 
                             class="logo-img mb-4" style="max-height: 120px; width: auto; filter: brightness(0) invert(1);">
                    </div>

                    <!-- Badge -->
                    <div class="badge bg-white text-dark px-4 py-2 mb-4 shadow-sm" style="font-size: 1rem; font-weight: 500;">
                        <i class="fas fa-graduation-cap me-2"></i>{{ __('documentation.hero.badge') }}
                    </div>

                    <!-- Main Title -->
                    <h1 class="display-2 fw-bold mb-4 text-shadow" style="font-weight: 700; line-height: 1.2;">
                        {{ __('documentation.hero.title') }}
                    </h1>

                    <!-- Decorative Line -->
                    <div class="d-flex justify-content-center mb-5">
                        <div style="width: 120px; height: 4px; background: linear-gradient(90deg, #ffc107, #f59e0b); border-radius: 2px;"></div>
                    </div>

                    <!-- Subtitle -->
                    <p class="lead mb-0 text-shadow" style="font-size: 1.3rem; font-weight: 300; max-width: 800px; margin: 0 auto;">
                        {{ __('documentation.hero.subtitle') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Professional Wave Bottom -->
        <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="transform: translateY(1px);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100"
                style="height: 100px;">
                <path fill="#f8f9fa" fill-opacity="1"
                    d="M0,192L48,197.3C96,203,192,213,288,197.3C384,181,480,139,576,144C672,149,768,203,864,202.7C960,203,1056,149,1152,133.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>



    <!-- Main Content Section -->
    <section id="documentation-content" class="py-5 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
        <!-- Background Pattern -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: radial-gradient(circle at 25% 25%, rgba(16, 185, 129, 0.03) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(5, 150, 105, 0.03) 0%, transparent 50%); z-index: 1;"></div>
        
        <div class="container position-relative" style="z-index: 2;">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="badge bg-gradient px-5 py-3 mb-4" style="font-size: 1rem; font-weight: 600; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 25px; box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3); color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    <i class="fas fa-book me-2"></i>{{ __('documentation.resources.title') }}
                </div>
                <h2 class="fw-bold mb-4" style="color: #1a202c; font-size: 3rem; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    Ressources Pédagogiques
                </h2>
                <div class="d-flex justify-content-center my-4">
                    <div style="width: 120px; height: 5px; background: linear-gradient(90deg, #10b981, #059669); border-radius: 3px; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);"></div>
                </div>
                <p class="lead mb-0" style="max-width: 700px; margin: 0 auto; font-size: 1.2rem; line-height: 1.6; color: #4a5568;">
                    Découvrez notre collection de ressources pédagogiques soigneusement sélectionnées pour l'éducation préscolaire
                </p>
            </div>

            <!-- Advanced Filter and Search Section -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg filter-card" style="border-radius: 25px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <div class="card-body p-5">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6">
                                    <h4 class="fw-bold mb-0" style="color: #2d3748;">
                                        <i class="fas fa-search me-2 text-primary"></i>Recherche Avancée
                                    </h4>
                                    <p class="mb-0" style="color: #6b7280;">Trouvez exactement ce que vous cherchez</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="badge bg-light text-dark px-3 py-2" style="font-size: 0.9rem;">
                                        <i class="fas fa-filter me-1"></i>{{ $resources->total() }} ressources disponibles
                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{ route('documentation.index') }}" method="GET" class="row g-4">
                                <div class="col-md-6">
                                    <label for="search" class="form-label fw-semibold text-dark mb-3">
                                        <i class="fas fa-search me-2 text-primary"></i>Rechercher une ressource
                                    </label>
                                    <div class="position-relative">
                                        <input type="text" 
                                               class="form-control form-control-lg search-input" 
                                               id="search" 
                                               name="search" 
                                               placeholder="Titre, description, mots-clés..." 
                                               value="{{ $search ?? '' }}"
                                               style="border-radius: 15px; border: 2px solid #e2e8f0; padding-left: 50px; font-size: 1rem; transition: all 0.3s ease;">
                                        <i class="fas fa-search position-absolute" style="left: 18px; top: 50%; transform: translateY(-50%); color: #a0aec0; z-index: 3;"></i>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="category" class="form-label fw-semibold text-dark mb-3">
                                        <i class="fas fa-tags me-2 text-primary"></i>Catégorie
                                    </label>
                                    <select class="form-select form-select-lg category-select" 
                                            id="category" 
                                            name="category"
                                            style="border-radius: 15px; border: 2px solid #e2e8f0; font-size: 1rem; transition: all 0.3s ease;">
                                        <option value="">Toutes les catégories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ ($categoryFilter ?? '') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-2 d-flex align-items-end gap-2">
                                    <button type="submit" 
                                            class="btn btn-primary btn-lg flex-fill search-btn" 
                                            style="border-radius: 15px; font-weight: 600; padding: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                                        <i class="fas fa-search me-2"></i>Filtrer
                                    </button>
                                    @if($search || $categoryFilter)
                                    <a href="{{ route('documentation.index') }}" 
                                       class="btn btn-outline-secondary btn-lg" 
                                       style="border-radius: 15px; font-weight: 600; padding: 12px;"
                                       title="Effacer les filtres">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Results Info -->
            @if($search || $categoryFilter)
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="alert alert-info border-0" style="border-radius: 15px; background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%); border-left: 4px solid #0d6efd;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="color: #2d3748;">
                                <i class="fas fa-info-circle me-2" style="color: #0d6efd;"></i>
                                <strong style="color: #2d3748;">Résultats de recherche:</strong>
                                @if($search)
                                    <span style="color: #0d6efd; font-weight: 600;">"{{ $search }}"</span>
                                @endif
                                @if($search && $categoryFilter)
                                    <span style="color: #6b7280;">dans</span>
                                @endif
                                @if($categoryFilter)
                                    <span class="badge bg-primary ms-1">{{ $categoryFilter }}</span>
                                @endif
                                <span style="color: #6b7280;">({{ $resources->total() }} résultat{{ $resources->total() > 1 ? 's' : '' }})</span>
                            </div>
                            <a href="{{ route('documentation.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-times me-1"></i>Effacer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Resources Grid -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row g-5">
                        @forelse($resources as $index => $resource)
                            <div class="col-lg-4 col-md-6">
                                <div class="resource-card h-100" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="card border-0 shadow-lg h-100 resource-card-inner" style="border-radius: 25px; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                                        <!-- Card Header with Advanced Design -->
                                        <div class="card-header bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 2rem; min-height: 140px;">
                                            <!-- Decorative Elements -->
                                            <div class="position-absolute top-0 end-0" style="width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; transform: translate(30px, -30px);"></div>
                                            <div class="position-absolute bottom-0 start-0" style="width: 60px; height: 60px; background: rgba(255,255,255,0.05); border-radius: 50%; transform: translate(-20px, 20px);"></div>
                                            
                                            <div class="d-flex align-items-start position-relative" style="z-index: 2;">
                                                <div class="icon-wrapper me-4" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3);">
                                                    @php
                                                        $icon = 'fas fa-file-pdf';
                                                        $iconColor = '#ffffff';
                                                        switch($resource->file_type) {
                                                            case 'pdf':
                                                                $icon = 'fas fa-file-pdf';
                                                                $iconColor = '#ffffff';
                                                                break;
                                                            case 'doc':
                                                            case 'docx':
                                                                $icon = 'fas fa-file-word';
                                                                $iconColor = '#ffffff';
                                                                break;
                                                            case 'xls':
                                                            case 'xlsx':
                                                                $icon = 'fas fa-file-excel';
                                                                $iconColor = '#ffffff';
                                                                break;
                                                            case 'ppt':
                                                            case 'pptx':
                                                                $icon = 'fas fa-file-powerpoint';
                                                                $iconColor = '#ffffff';
                                                                break;
                                                            case 'zip':
                                                                $icon = 'fas fa-file-archive';
                                                                $iconColor = '#ffffff';
                                                                break;
                                                            default:
                                                                $icon = 'fas fa-file-alt';
                                                                $iconColor = '#ffffff';
                                                        }
                                                    @endphp
                                                    <i class="{{ $icon }} fa-2x" style="color: {{ $iconColor }}; text-shadow: 0 2px 4px rgba(0,0,0,0.2);"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1.2rem; line-height: 1.3; color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.4);">
                                                        {{ Str::limit($resource->title, 45) }}
                                                    </h5>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-white text-dark px-3 py-2" style="font-size: 0.8rem; font-weight: 600; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                            <i class="fas fa-tag me-1"></i>{{ $resource->category }}
                                                        </span>
                                                        <span class="badge bg-light text-dark px-3 py-2" style="font-size: 0.8rem; font-weight: 600; border-radius: 15px; background: rgba(255,255,255,0.9) !important;">
                                                            <i class="fas fa-file me-1"></i>{{ strtoupper($resource->file_type) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Body with Enhanced Design -->
                                        <div class="card-body p-4" style="position: relative;">
                                            <!-- Description -->
                                            <p class="card-text mb-4" style="font-size: 1rem; line-height: 1.6; color: #2d3748;">
                                                {{ Str::limit($resource->description, 130) }}
                                            </p>

                                            <!-- Metadata -->
                                            <div class="metadata mb-4">
                                                @if($resource->published_at)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-calendar-alt me-2" style="color: #10b981;"></i>
                                                        <span style="font-size: 0.9rem; font-weight: 500; color: #4a5568;">Publié le {{ $resource->published_at->format('d M Y') }}</span>
                                                    </div>
                                                @endif
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-clock me-2" style="color: #10b981;"></i>
                                                    <span style="font-size: 0.9rem; font-weight: 500; color: #4a5568;">Lecture estimée: 5-10 min</span>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-flex gap-3">
                                                <!-- <a href="{{ route('documentation.resource', $resource->slug) }}" 
                                                   class="btn btn-outline-primary btn-lg flex-fill" 
                                                   style="border-radius: 15px; font-weight: 600; padding: 12px; border-width: 2px; transition: all 0.3s ease;">
                                                    <i class="fas fa-info-circle me-2"></i>Détails
                                                </a> -->
                                                <a href="{{ route('documentation.resource.download', $resource->slug) }}" 
                                                   class="btn btn-primary btn-lg flex-fill" 
                                                   style="border-radius: 15px; font-weight: 600; padding: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                                                    <i class="fas fa-download me-2"></i>Télécharger
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Hover Overlay -->
                                        <div class="card-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); opacity: 0; transition: all 0.3s ease; pointer-events: none; border-radius: 25px;"></div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon mb-4">
                                            <i class="fas fa-folder-open fa-5x text-muted" style="opacity: 0.3;"></i>
                                        </div>
                                        <h3 class="mb-3 fw-bold" style="color: #6b7280;">Aucune ressource disponible</h3>
                                        <p class="mb-4 lead" style="color: #9ca3af;">Les ressources pédagogiques seront bientôt disponibles.</p>
                                        <div class="d-flex justify-content-center">
                                            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #10b981, #059669); border-radius: 2px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Enhanced Pagination -->
                    @if($resources->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            <div class="pagination-wrapper">
                                {{ $resources->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

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

        /* Logo Animation */
        .logo-img {
            transition: all 0.3s ease;
            animation: logoFloat 6s ease-in-out infinite;
        }

        .logo-img:hover {
            transform: scale(1.05);
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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

        /* Advanced Filter Section Styling */
        .filter-card {
            animation: fadeInUp 0.8s ease-out 0.8s both;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .search-input:focus,
        .category-select:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25) !important;
            transform: translateY(-2px);
        }

        .search-input,
        .category-select {
            transition: all 0.3s ease;
        }

        .search-input:hover,
        .category-select:hover {
            border-color: #10b981;
            transform: translateY(-1px);
        }

        .search-btn {
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
        }

        /* Professional Resource Cards */
        .resource-card {
            animation: fadeInUp 0.8s ease-out both;
        }

        .resource-card-inner {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .resource-card-inner:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .resource-card-inner:hover .card-overlay {
            opacity: 1;
        }

        .resource-card-inner:hover .icon-wrapper {
            transform: scale(1.15) rotate(5deg);
            background: rgba(255,255,255,0.3) !important;
        }

        .resource-card-inner:hover .card-header::before {
            left: 100%;
        }

        .card-header {
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }

        .icon-wrapper {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Button Styling */
        .btn-outline-primary {
            border-width: 2px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-outline-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(13, 110, 253, 0.3);
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border-color: #007bff;
        }

        .btn-primary {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Empty State */
        .empty-state {
            animation: fadeInUp 0.8s ease-out;
        }

        .empty-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Section Header Animation */
        .badge {
            animation: fadeInUp 0.6s ease-out;
        }

        h2 {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .d-flex div {
            animation: expandLine 1.2s ease-out 0.4s both;
        }

        .lead {
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        /* Card Stagger Animation */
        .resource-card:nth-child(1) { animation: fadeInUp 0.8s ease-out 0.1s both; }
        .resource-card:nth-child(2) { animation: fadeInUp 0.8s ease-out 0.2s both; }
        .resource-card:nth-child(3) { animation: fadeInUp 0.8s ease-out 0.3s both; }
        .resource-card:nth-child(4) { animation: fadeInUp 0.8s ease-out 0.4s both; }
        .resource-card:nth-child(5) { animation: fadeInUp 0.8s ease-out 0.5s both; }
        .resource-card:nth-child(6) { animation: fadeInUp 0.8s ease-out 0.6s both; }

        /* Pagination Styling */
        .pagination-wrapper .pagination {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .pagination-wrapper .page-link {
            border: none;
            padding: 12px 18px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            transform: translateY(-2px);
        }

        .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: white;
        }

        /* Metadata Styling */
        .metadata {
            background: rgba(16, 185, 129, 0.05);
            border-radius: 12px;
            padding: 15px;
            border-left: 4px solid #10b981;
        }

        /* Text Color Fixes */
        .card-text {
            color: #2d3748 !important;
        }

        .text-muted {
            color: #6b7280 !important;
        }

        .lead {
            color: #4a5568 !important;
        }

        /* Ensure proper contrast */
        .resource-card .card-body {
            color: #2d3748;
        }

        .resource-card .card-body p {
            color: #2d3748 !important;
        }

        .resource-card .card-body .text-muted {
            color: #6b7280 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .resource-card .card-header {
                padding: 1.5rem !important;
                min-height: 120px !important;
            }
            
            .icon-wrapper {
                width: 50px !important;
                height: 50px !important;
            }
            
            h2 {
                font-size: 2.5rem !important;
            }
            
            .lead {
                font-size: 1.1rem !important;
            }

            .filter-card .card-body {
                padding: 2rem !important;
            }

            .search-input,
            .category-select {
                font-size: 0.9rem !important;
            }
        }

        @media (max-width: 576px) {
            .resource-card .card-header {
                padding: 1rem !important;
                min-height: 100px !important;
            }
            
            .icon-wrapper {
                width: 45px !important;
                height: 45px !important;
            }
            
            h2 {
                font-size: 2rem !important;
            }

            .btn-lg {
                font-size: 0.9rem !important;
                padding: 10px !important;
            }

            .filter-card .card-body {
                padding: 1.5rem !important;
            }
        }

        /* Advanced Hover Effects */
        .resource-card-inner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 25px;
        }

        .resource-card-inner:hover::before {
            opacity: 1;
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        .resource-card.loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>
@endpush
