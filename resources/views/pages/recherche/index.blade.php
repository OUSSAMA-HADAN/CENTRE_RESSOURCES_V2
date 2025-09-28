@extends('layouts.app')

@section('title', 'Unité de recherche et développement')

@section('content')


    <section class="hero-section position-relative overflow-hidden mt-5" style="min-height: 70vh; background: #10B981;">
        <div class="hero-background position-absolute w-100 h-100"
            style="background: url('{{ asset('storage/images/research-bg.jpg') }}') center/cover no-repeat; opacity: 0.15; top: 0; left: 0; z-index: 0;">
        </div>

        <!-- Animated shapes -->
        <div class="hero-shapes">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
            <div class="shape-3"></div>
        </div>

        <div class="container position-relative " style="z-index: 5;">
            <div class="row justify-content-center align-items-center min-vh-50">
                <div class="col-lg-8 text-center text-white py-5">
                    <div class="badge bg-warning text-dark px-3 py-2 mb-4">
                        <i class="fas fa-microscope me-2"></i>Centre de Ressources du Préscolaire
                    </div>

                    <h1 class="display-3 fw-bold mb-3 text-shadow">Unité de Recherche et Développement</h1>

                    <div class="d-flex justify-content-center mb-4">
                        <div style="width: 100px; height: 4px; background-color: #ffc107;"></div>
                    </div>

                    <p class="lead mb-5 text-shadow">Innovation et excellence dans la recherche pour améliorer l'éducation
                        préscolaire au Maroc</p>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#mission" class="btn btn-light btn-lg px-4 py-3 rounded-pill shadow-sm">
                            <i class="fas fa-info-circle me-2"></i>Découvrir notre mission
                        </a>
                        <a href="#publications" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-file-alt me-2"></i>Voir nos publications
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave bottom -->
        <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="transform: translateY(1px);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100"
                style="height: 80px;">
                <path fill="#f8f9fa" fill-opacity="1"
                    d="M0,192L48,197.3C96,203,192,213,288,197.3C384,181,480,139,576,144C672,149,768,203,864,202.7C960,203,1056,149,1152,133.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <img src="{{ asset('storage/images/research-icon.png') }}"
                                        alt="Recherche et développement" class="img-fluid rounded">
                                </div>
                                <div class="col-md-8">
                                    <h2 class="mb-4">Notre mission de recherche</h2>
                                    <p class="text-muted mb-4">L'Unité de Recherche et Développement du Centre de Ressources
                                        du Préscolaire d'Oujda est dédiée à l'avancement des connaissances et des pratiques
                                        dans le domaine de l'éducation préscolaire. À travers nos recherches et nos projets
                                        innovants, nous visons à améliorer la qualité de l'éducation des jeunes enfants et à
                                        soutenir le développement professionnel des éducateurs.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3 p-3 rounded-circle bg-primary text-white">
                                            <i class="fas fa-microscope"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Recherche appliquée</h5>
                                            <p class="mb-0 text-muted">Études et analyses sur les méthodes pédagogiques
                                                adaptées au contexte marocain</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3 p-3 rounded-circle bg-primary text-white">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Innovation pédagogique</h5>
                                            <p class="mb-0 text-muted">Développement d'outils et méthodes innovantes pour
                                                l'éducation préscolaire</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-3 rounded-circle bg-primary text-white">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Partenariats stratégiques</h5>
                                            <p class="mb-0 text-muted">Collaboration avec des institutions nationales et
                                                internationales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Publications Section -->
    <!-- Publications Section -->
    
    <section id="publications" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Nos publications</h2>
                <div class="d-flex justify-content-center mb-3">
                    <div style="width: 80px; height: 4px; background-color: #10b981;"></div>
                </div>
                <p class="text-muted">Découvrez nos recherches et publications dans le domaine de l'éducation préscolaire
                </p>
            </div>

            @if (isset($publications) && count($publications) > 0)
                <div class="row g-4" id="publications-grid">
                    @foreach ($publications as $publication)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm publication-card">
                                <div class="card-body d-flex flex-column">
                                    @if ($publication->cover_image && Storage::exists('public/' . $publication->cover_image))
                                    <div class="publication-cover-container mb-3">
                                        <img src="{{ asset('storage/' . $publication->cover_image) }}"
                                            alt="{{ $publication->title }}" class="publication-cover-image">
                                    </div>
                                @endif                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary-soft rounded-circle p-3 me-3">
                                            <i class="fas fa-file-alt text-primary fs-4"></i>
                                        </div>
                                        <h5 class="card-title mb-0 text-dark fw-bold">{{ $publication->title }}</h5>
                                    </div>

                                    <p class="card-text text-muted flex-grow-1 mb-4">
                                        {{ Str::limit($publication->summary, 150, '...') }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="badge bg-primary-soft text-primary p-2">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ $publication->category }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $publication->published_at->format('d/m/Y') }}
                                        </small>
                                    </div>

                                    <div class="card-footer bg-transparent border-0 px-0 pt-3">
                                        <button class="btn btn-outline-primary w-100 publication-expand-btn"
                                            data-publication-id="{{ $publication->id }}">
                                            <i class="fas fa-eye me-2"></i>
                                            Lire plus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="publication-details-{{ $publication->id }}" class="publication-details-fullscreen">
                                <div class="publication-fullscreen-content">
                                    <button class="btn-close publication-close-btn" aria-label="Fermer"></button>
                                    <div class="publication-header">
                                        <h2>{{ $publication->title }}</h2>
                                        <span class="publication-meta">
                                            <i class="fas fa-tag me-2"></i>{{ $publication->category }}
                                            |
                                            <i
                                                class="far fa-calendar-alt me-2"></i>{{ $publication->published_at->format('d/m/Y') }}
                                        </span>

                                        @if ($publication->cover_image)
                                            <div class="publication-cover-image-full mt-3">
                                                <img src="{{ asset('storage/' . $publication->cover_image) }}"
                                                    alt="{{ $publication->title }}" class="img-fluid rounded">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="publication-body">
                                        {!! $publication->content !!}
                                    </div>
                                    @if ($publication->pdf_file)
                                        <div class="publication-footer">
                                            <a href="{{ asset('storage/' . $publication->pdf_file) }}"
                                                class="btn btn-primary" target="_blank">
                                                <i class="fas fa-download me-2"></i>Télécharger le PDF
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-file-alt fa-4x text-muted opacity-50"></i>
                        </div>
                        <h3 class="mb-3">Aucune publication disponible</h3>
                        <p class="text-muted mb-0">Nos travaux de recherche sont en cours. Les publications seront bientôt
                            disponibles.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>


    @push('styles')
        <style>
            /* Card styles */
            .publication-card {
                transition: transform 0.3s ease;
            }
            
            .publication-card:hover {
                transform: translateY(-5px);
            }
            
            /* Image container styles to maintain uniform size */
            .publication-cover-container {
                height: 200px;
                width: 100%;
                overflow: hidden;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .publication-cover-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            /* Full screen overlay styles */
            .publication-details-fullscreen {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                z-index: 9999;
                overflow-y: auto;
                padding: 50px 20px;
            }

            .publication-fullscreen-content {
                background-color: white;
                max-width: 900px;
                margin: 0 auto;
                border-radius: 10px;
                padding: 40px;
                position: relative;
                max-height: 90vh;
                overflow-y: auto;
            }

            .publication-close-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                font-size: 1.5rem;
            }

            .publication-header {
                margin-bottom: 30px;
                border-bottom: 2px solid #f0f0f0;
                padding-bottom: 15px;
            }

            .publication-header h2 {
                margin-bottom: 10px;
            }

            .publication-meta {
                color: #6c757d;
                font-size: 0.9rem;
            }

            .publication-cover-image-full {
                margin-top: 20px;
                max-height: 400px;
                overflow: hidden;
                border-radius: 10px;
            }

            .publication-cover-image-full img {
                width: 100%;
                object-fit: cover;
                max-height: 400px;
            }

            .publication-body {
                margin-bottom: 30px;
            }

            .publication-footer {
                text-align: center;
                padding-top: 20px;
                border-top: 2px solid #f0f0f0;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const publicationCards = document.querySelectorAll('.publication-expand-btn');
                const publicationOverlays = document.querySelectorAll('.publication-details-fullscreen');

                publicationCards.forEach(card => {
                    card.addEventListener('click', function() {
                        const publicationId = this.dataset.publicationId;
                        const overlay = document.getElementById(`publication-details-${publicationId}`);

                        if (overlay) {
                            overlay.style.display = 'block';
                            document.body.style.overflow = 'hidden';
                        }
                    });
                });

                publicationOverlays.forEach(overlay => {
                    const closeBtn = overlay.querySelector('.publication-close-btn');

                    closeBtn.addEventListener('click', function() {
                        overlay.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });

                    overlay.addEventListener('click', function(event) {
                        if (event.target === overlay) {
                            overlay.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                    });
                });
            });
        </script>
    @endpush












































    
    <!-- Team Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Notre équipe de recherche</h2>
                <div class="d-flex justify-content-center mb-3">
                    <div style="width: 80px; height: 4px; background-color: #10b981;"></div>
                </div>
                <p class="text-muted"> expert passionné par l'avancement de l'éducation préscolaire</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm text-center h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <div class="rounded-circle overflow-hidden mx-auto mb-3"
                                    style="width: 120px; height: 120px;">
                                    <img src="https://via.placeholder.com/300" alt="Chercheur" class="img-fluid">
                                </div>
                                <h5 class="card-title">Mr. FOUAD MASSAOUDI</h5>
                                <p class="text-primary mb-2">Chercheur principal</p>
                            </div>
                            <p class="card-text text-muted small">Spécialiste en développement cognitif et social des
                                enfants avec plus de 15 ans d'expérience dans la recherche éducative.</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-4">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center py-3">
            <h2 class="fw-bold mb-4">Rejoignez nos efforts de recherche</h2>
            <p class="lead mb-4">Vous êtes un chercheur, un éducateur ou un professionnel de l'éducation préscolaire ? Nous
                sommes toujours ouverts aux collaborations et partenariats.</p>
            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                <a href="#" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-handshake me-2"></i>Devenir partenaire
                </a>
                <a href="#" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-envelope me-2"></i>Contactez-nous
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Pour compenser le header fixe en plus de la classe mt-5 */
        /* Hero styling */
        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-section {
            padding-top: calc(3rem + 50px) !important;
            padding-bottom: 5rem !important;
            margin-top: 0 !important;
        }

        /* Animated background shapes */
        .hero-shapes .shape-1 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 15s infinite ease-in-out;
        }

        .hero-shapes .shape-2 {
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            bottom: 50px;
            left: -50px;
            animation: float 18s infinite ease-in-out reverse;
        }

        .hero-shapes .shape-3 {
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            bottom: 150px;
            right: 10%;
            animation: morph 15s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(5deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        @keyframes morph {
            0% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }

            25% {
                border-radius: 50% 50% 30% 70% / 70% 30% 70% 30%;
            }

            50% {
                border-radius: 70% 30% 50% 50% / 30% 30% 70% 70%;
            }

            75% {
                border-radius: 30% 70% 70% 30% / 70% 70% 30% 30%;
            }

            100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }
        }

        .bg-primary {
            background-color: #10B981 !important;
        }

        .text-primary {
            color: #10B981 !important;
        }

        .btn-primary {
            background-color: #10B981;
            border-color: #10B981;
        }

        .btn-primary:hover {
            background-color: #0ea573;
            border-color: #0ea573;
        }

        .btn-outline-primary {
            color: #10B981;
            border-color: #10B981;
        }

        .btn-outline-primary:hover {
            background-color: #10B981;
            border-color: #10B981;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush
