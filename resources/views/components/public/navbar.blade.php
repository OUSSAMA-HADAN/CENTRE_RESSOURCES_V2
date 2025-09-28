<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">
        <!-- Logo with hover effect -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div class="logo-container position-relative overflow-hidden">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" height="60" class="logo-image">
                <div class="logo-overlay"></div>
            </div>
            <span class="ms-2 d-none d-sm-inline text-light site-title">préscolaire Oujda</span>
        </a>

        <!-- Custom hamburger button -->
        <button class="navbar-toggler border-0 p-0" type="button" id="mobile-menu-toggle"
            aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <!-- Navigation items with indicator for desktop -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-md-center">
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#hero" data-section="hero">
                        <i class="fas fa-home me-1"></i>
                        <span>Accueil</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#surNous" data-section="surNous">
                        <i class="fas fa-info-circle me-1"></i>
                        <span>Sur Nous</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown position-relative mx-md-1">
                    <a class="nav-link dropdown-toggle text-light px-3 py-2" href="#" id="servicesDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cogs me-1"></i>
                        <span>Unités</span>
                    </a>
                    <span class="nav-indicator"></span>
                    <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="#formations"><i class="fas fa-microscope me-2"></i> Unité
                                de recherche et de développement</a></li>
                        <li><a class="dropdown-item" href="#consultations"><i class="fas fa-book me-2"></i>Unité de
                                documentation et de production</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#ateliers"><i class="fas fa-users me-2"></i>Formation
                                Enligne</a></li>
                    </ul>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#gallery" data-section="gallery">
                        <i class="fas fa-images me-1"></i>
                        <span>Galerie</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#location" data-section="location">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        <span>Localisation</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                
<div class="nav-item ms-md-3 mt-3 mt-md-0 d-flex flex-column flex-md-row gap-2">
    <a class="btn px-4 py-2 signup-btn" href="{{ route('inscription.form', ['type' => 'normal']) }}"
        style="background-color: #f7a223;">
        <i class="fas fa-user-plus me-2"></i>S'inscrire à la formation normale
    </a>
    <a class="btn px-4 py-2 signup-btn" href="{{ route('inscription.form', ['type' => 'educatrice']) }}"
        style="background-color: #f7a223;">
        <i class="fas fa-user-plus me-2"></i>S'inscrire à la formation dédiée aux éducatrices des écoles privées
    </a>
</div>
            </ul>
        </div>
    </div>
</nav>