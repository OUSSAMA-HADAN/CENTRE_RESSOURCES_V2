@extends('layouts.app')

@section('title', 'Unité de Documentation et Production')
@section('content')
    <!-- Hero Section -->
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
                        <i class="fas fa-book me-2"></i>{{ __('documentation.hero.badge') }}
                    </div>

                    <h1 class="display-3 fw-bold mb-3 text-shadow">{{ __('documentation.hero.title') }}</h1>

                    <div class="d-flex justify-content-center mb-4">
                        <div style="width: 100px; height: 4px; background-color: #ffc107;"></div>
                    </div>

                    <p class="lead mb-5 text-shadow">{{ __('documentation.hero.subtitle') }}</p>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#mission" class="btn btn-light btn-lg px-4 py-3 rounded-pill shadow-sm">
                            <i class="fas fa-folder-open me-2"></i>{{ __('documentation.hero.button_categories') }}
                        </a>
                        <a href="#publications" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="fas fa-newspaper"></i> {{ __('documentation.hero.button_publications') }}
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



    <!-- Main Content Section -->
    <section id="documentation-content" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">{{ __('documentation.resources.title') }}</h2>
                <div class="d-flex justify-content-center my-3">
                    <div style="width: 80px; height: 3px; background-color: #10b981;"></div>
                </div>
            </div>
            

            <!-- Resources Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($resources as $resource)
                        <div class="col-md-4">
                            <x-public.card title="{{ $resource->title }}"
                                description="{{ Str::limit($resource->description, 100) }}"
                                date="{{ $resource->published_at ? $resource->published_at->format('d M Y') : '' }}"
                                category="{{ $resource->category }}" icon="fas fa-file-pdf" :url="route('documentation.resource', $resource->slug)" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Aucune ressource disponible pour le moment.
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
               
            </div>
        </div>
        </div>
    </section>

    <!-- Featured Publications Section -->
    <section id="featured-publications" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">{{ __('documentation.featured_publications.title') }}</h2>
                <div class="d-flex justify-content-center my-3">
                    <div style="width: 80px; height: 3px; background-color: #10b981;"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($featuredPublications as $publication)
                    <div class="col-md-4">
                        <x-public.card title="{{ $publication->title }}"
                            description="{{ Str::limit($publication->summary, 100) }}"
                            date="{{ $publication->published_at ? $publication->published_at->format('d M Y') : '' }}"
                            {{-- category="{{ $publication->category }}" icon="fas fa-newspaper" :url="route('documentation.publication', $publication->slug)" --}} />
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>aucune publication pour le moment</p>
                    </div>
                @endforelse
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
    </style>
@endpush
