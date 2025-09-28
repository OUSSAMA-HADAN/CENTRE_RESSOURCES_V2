<nav class="navbar navbar-expand-md navbar-dark shadow-lg fixed-top">
    <div class="container-fluid">
        <!-- Logo with hover effect -->
        <a class="navbar-brand d-flex align-items-center " href="{{ route('home') }}">
            <div class="logo-container position-relative overflow-hidden">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" height="60" class="logo-image">
                <div class="logo-overlay"></div>
            </div>
            <span class="ms-2 d-none d-sm-inline text-light site-title">{{ __('header.title') }}</span>
        </a>

        <!-- Language switcher for mobile (visible outside sidebar) -->
        <div class="d-md-none me-2">
            <div class="dropdown">
                <button class="btn btn-sm text-white dropdown-toggle language-btn" type="button" id="mobileLangDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe me-1"></i>
                    <span>{{ app()->getLocale() == 'fr' ? 'FR' : 'AR' }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="mobileLangDropdown">
                    <li><a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}">Français</a></li>
                    <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                </ul>
            </div>
        </div>

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
                    <a class="nav-link text-light px-3 py-2 {{ request()->routeIs('home') && !request()->routeIs('inscription.*') ? 'active' : '' }}" href="{{ route('home') }}#hero" data-section="hero">
                        <i class="fas fa-home me-1"></i>
                        <span>{{ __('header.home') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#surNous" data-section="surNous">
                        <i class="fas fa-info-circle me-1"></i>
                        <span>{{ __('header.about') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown position-relative mx-md-1">
                    <a class="nav-link dropdown-toggle text-light px-3 py-2" href="{{ route('home') }}#units" 
                       id="servicesDropdown"
                       role="button" 
                       data-bs-toggle="dropdown" 
                       aria-expanded="false">
                        <i class="fas fa-cogs me-1"></i>
                        <span>{{ __('header.units') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                    <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="servicesDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}#units">
                                <i class="fas fa-eye me-2"></i>{{ __('header.view_all_units') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('recherche.index') }}">
                                <i class="fas fa-microscope me-2"></i>{{ __('header.research_development') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('documentation.index') }}">
                                <i class="fas fa-book me-2"></i>{{ __('header.documentation_production') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('formation.index') }}">
                                <i class="fas fa-users me-2"></i>{{ __('header.online_training') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#gallery" data-section="gallery">
                        <i class="fas fa-images me-1"></i>
                        <span>{{ __('header.gallery') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-md-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#location" data-section="location">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        <span>{{ __('header.location') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <!-- Language switcher -->
                <li class="nav-item dropdown position-relative mx-md-1">
                    <a class="nav-link dropdown-toggle text-light px-3 py-2" href="#" id="languageDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe me-1"></i>
                        <span>{{ app()->getLocale() == 'fr' ? 'FR' : 'AR' }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                    <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}">Français</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                    </ul>
                </li>
                <!-- Signup button -->
                <li class="nav-item ms-md-3 mt-3 mt-md-0">
                    <a class="btn px-4 py-2 signup-btn" href="#" data-bs-toggle="modal" data-bs-target="#inscriptionModal"
                        style="background-color: #f7a223; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-weight: 500; transition: all 0.3s ease;">
                        <i class="fas fa-user-plus me-2"></i>S'inscrire
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar Menu (hidden by default) -->
<div id="mobile-sidebar" class="mobile-sidebar">
    <div class="mobile-sidebar-header">
        <button id="close-sidebar" class="close-sidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="mobile-sidebar-content">
        <ul class="mobile-nav">
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('home') }}#hero" data-section="hero">
                    <i class="fas fa-home me-2"></i>
                    <span>{{ __('header.home') }}</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('home') }}#surNous" data-section="surNous">
                    <i class="fas fa-info-circle me-2"></i>
                    <span>{{ __('header.about') }}</span>
                </a>
            </li>
            <li class="mobile-nav-item mobile-dropdown">
                <div class="mobile-nav-link mobile-dropdown-toggle">
                    <i class="fas fa-cogs me-2"></i>
                    <span>{{ __('header.units') }}</span>
                    <i class="fas fa-chevron-down ms-auto dropdown-icon"></i>
                </div>
                <ul class="mobile-dropdown-menu">
                    <li><a class="mobile-dropdown-item" href="{{route('recherche.index')}}">
                            <i class="fas fa-microscope me-2"></i> {{ __('header.units_dropdown.research') }}
                        </a></li>
                    <li><a class="mobile-dropdown-item" href="{{route('documentation.index')}}">
                            <i class="fas fa-book me-2"></i>{{ __('header.units_dropdown.documentation') }}
                        </a></li>
                    <li><a class="mobile-dropdown-item"  href="{{route('formation.index')}}">
                            <i class="fas fa-users me-2"></i>Formation Enligne
                        </a></li>
                </ul>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('home') }}#gallery" data-section="gallery">
                    <i class="fas fa-images me-2"></i>
                    <span>{{ __('header.gallery') }}</span>
                </a>
            </li>
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('home') }}#location" data-section="location">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>{{ __('header.location') }}</span>
                </a>
            </li>
            <li class="mobile-nav-item mt-4">
                <a class="btn px-4 py-2 signup-btn w-100" href="#" data-bs-toggle="modal" data-bs-target="#inscriptionModal"
                    style="background-color: #f7a223; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-weight: 500; transition: all 0.3s ease;">
                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Overlay for mobile sidebar -->
<div id="sidebar-overlay" class="sidebar-overlay"></div>












<!-- Registration options modal -->
<div class="modal fade" id="inscriptionModal" tabindex="-1" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold" id="inscriptionModalLabel">Choisissez votre type de formation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <!-- Option 1: Formation normale -->
                    <div class="col-12">
                        <a href="{{ route('inscription.form', ['type' => 'normal']) }}" class="text-decoration-none">
                            <div class="card border-0 inscription-card normal-card" style="transition: all 0.3s ease;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-light-orange rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 60px; height: 60px; background-color: rgba(247, 162, 35, 0.15);">
                                            <i class="fas fa-graduation-cap fa-2x" style="color: #f7a223;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1">Formation Normale</h5>
                                            <p class="text-muted mb-0">Programme standard ouvert à tous</p>
                                        </div>
                                        <i class="fas fa-chevron-right ms-auto" style="color: #f7a223;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Option 2: Formation pour éducatrices -->
                    <div class="col-12">
                        <a href="{{ route('inscription.form', ['type' => 'educatrice']) }}" class="text-decoration-none">
                            <div class="card border-0 inscription-card educatrice-card" style="transition: all 0.3s ease;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-light-orange rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 60px; height: 60px; background-color: rgba(247, 162, 35, 0.15);">
                                            <i class="fas fa-chalkboard-teacher fa-2x" style="color: #f7a223;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1">Formation pour Éducatrices des écoles privées</h5>
                                            <p class="text-muted mb-0">Programme spécialisé pour les écoles privées</p>
                                        </div>
                                        <i class="fas fa-chevron-right ms-auto" style="color: #f7a223;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.signup-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    z-index: 1;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    color: #fff;
    font-weight: 600;
}

.signup-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.6s ease;
    z-index: -1;
}

.signup-btn:hover:before {
    left: 100%;
}

.signup-btn:hover {
    transform: translateY(-2px);
    background-color: #e89417 !important;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    color: #fff;
}

.inscription-card {
    cursor: pointer;
    border-left: 4px solid transparent;
}

.inscription-card:hover {
    background-color: #fff8ee;
    transform: translateX(5px);
    border-left: 4px solid #f7a223;
}

.normal-card {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

@media (max-width: 767.98px) {
    .modal-dialog {
        margin: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add a subtle animation when the modal opens
    const inscriptionModal = document.getElementById('inscriptionModal');
    if (inscriptionModal) {
        inscriptionModal.addEventListener('show.bs.modal', function (event) {
            setTimeout(function() {
                const cards = document.querySelectorAll('.inscription-card');
                cards.forEach((card, index) => {
                    setTimeout(function() {
                        card.classList.add('animate__animated', 'animate__fadeInRight');
                    }, index * 150);
                });
            }, 200);
        });
        
        // Reset animations when modal closes
        inscriptionModal.addEventListener('hidden.bs.modal', function (event) {
            const cards = document.querySelectorAll('.inscription-card');
            cards.forEach(card => {
                card.classList.remove('animate__animated', 'animate__fadeInRight');
            });
        });
    }
});
</script>




























<style>
    /* Navbar styling */
    .navbar {
        background-color: rgba(16, 185, 129, 0.95);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
        padding: 15px 0;
        z-index: 1030;
    }

    /* Mobile language button */
    .language-btn {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
        transition: all 0.2s ease;
    }

    .language-btn:hover, .language-btn:focus {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    /* Logo effects */
    .logo-container {
        position: relative;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .logo-container:hover {
        transform: scale(1.05);
    }

    .logo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .logo-container:hover .logo-overlay {
        opacity: 1;
    }

    /* Site title styling */
    .site-title {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Nav indicator for active state */
    .nav-indicator {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        height: 3px;
        width: 80%;
        background-color: #ffffff;
        border-radius: 2px;
        transition: transform 0.3s ease;
        transform-origin: center;
    }

    .nav-item:hover .nav-indicator {
        transform: translateX(-50%) scaleX(1);
    }

    /* Active link styling */
    .navbar-nav .nav-item.active .nav-link {
        font-weight: 600;
    }

    .navbar-nav .nav-item.active .nav-indicator {
        transform: translateX(-50%) scaleX(1);
    }

    /* Navigation link hover effect */
    .navbar-nav .nav-link {
        position: relative;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Custom hamburger menu */
    .hamburger-icon {
        width: 30px;
        height: 24px;
        position: relative;
        cursor: pointer;
        display: inline-block;
    }

    .hamburger-icon span {
        position: absolute;
        height: 3px;
        width: 100%;
        background: white;
        border-radius: 3px;
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: .25s ease-in-out;
    }

    .hamburger-icon span:nth-child(1) {
        top: 0px;
    }

    .hamburger-icon span:nth-child(2) {
        top: 10px;
    }

    .hamburger-icon span:nth-child(3) {
        top: 20px;
    }

    /* Sign up button animation */
    .signup-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        z-index: 1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: #fff;
        font-weight: 600;
    }

    .signup-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
        z-index: -1;
    }

    .signup-btn:hover:before {
        left: 100%;
    }

    .signup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    /* Dropdown styling */
    .dropdown-menu {
        background-color: #fff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin-top: 10px;
        min-width: 200px;
    }

    .dropdown-item {
        color: #333;
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .dropdown-item i {
        color: #10b981;
    }

    .dropdown-divider {
        border-color: rgba(0, 0, 0, 0.05);
        margin: 5px 0;
    }

    /* Animation for dropdown */
    .animated {
        animation-duration: 0.3s;
        animation-fill-mode: both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fadeIn {
        animation-name: fadeIn;
    }

    /* Scrolled navbar styling */
    .navbar.scrolled {
        padding: 8px 0;
        background-color: rgba(16, 185, 129, 0.98);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Mobile Sidebar Styling */
    .mobile-sidebar {
        position: fixed;
        top: 0;
        right: -280px;
        width: 280px;
        height: 100vh;
        background-color: #10b981;
        z-index: 1040;
        overflow-y: auto;
        transition: right 0.3s ease;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }

    .mobile-sidebar.active {
        right: 0;
    }

    .mobile-sidebar-header {
        display: flex;
        justify-content: flex-end;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1rem;
    }

    .close-sidebar {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.5rem;
    }

    .mobile-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-nav-item {
        margin-bottom: 0.5rem;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .mobile-nav-link:hover, 
    .mobile-nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .mobile-dropdown-toggle {
        justify-content: space-between;
    }

    .mobile-dropdown-menu {
        list-style: none;
        padding: 0.5rem 0 0.5rem 1.5rem;
        margin-top: 0.25rem;
        display: none;
    }

    .mobile-dropdown-menu.show {
        display: block;
    }

    .mobile-dropdown-item {
        display: block;
        padding: 0.6rem 1rem;
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .mobile-dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Overlay when sidebar is open */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        z-index: 1035;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Hide desktop navbar on mobile */
    @media (max-width: 767.98px) {
        .navbar-collapse {
            display: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get DOM elements
        const navbar = document.querySelector('.navbar');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebar = document.getElementById('close-sidebar');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link:not(.mobile-dropdown-toggle)');
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        // Function to handle navbar color change on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Function to open mobile sidebar
        function openSidebar() {
            mobileSidebar.classList.add('active');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when sidebar is open
        }

        // Function to close mobile sidebar
        function closeSidebarMenu() {
            mobileSidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        }

        // Open sidebar when clicking hamburger menu
        mobileMenuToggle.addEventListener('click', openSidebar);

        // Close sidebar when clicking close button
        closeSidebar.addEventListener('click', closeSidebarMenu);

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', closeSidebarMenu);

        // Close sidebar when clicking a nav link
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeSidebarMenu);
        });

        // Toggle dropdown menus in mobile sidebar
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation(); // Empêche la propagation de l'événement
                
                // Trouver le menu déroulant
                const dropdownMenu = this.nextElementSibling;
                const dropdownIcon = this.querySelector('.dropdown-icon');
                
                // Basculer la classe show
                dropdownMenu.classList.toggle('show');
                
                // Changer l'icône en fonction de l'état
                if (dropdownMenu.classList.contains('show')) {
                    if (dropdownIcon) {
                        dropdownIcon.classList.remove('fa-chevron-down');
                        dropdownIcon.classList.add('fa-chevron-up');
                    }
                } else {
                    if (dropdownIcon) {
                        dropdownIcon.classList.remove('fa-chevron-up');
                        dropdownIcon.classList.add('fa-chevron-down');
                    }
                }
            });
        });

        // Empêcher les liens du menu déroulant de fermer le sidebar immédiatement
        const dropdownItems = document.querySelectorAll('.mobile-dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                setTimeout(closeSidebarMenu, 100);
            });
        });

        // Set active link based on current section
        const sections = document.querySelectorAll('section[id]');

        function setActiveLinks() {
            // Si on est sur une autre page que home, ne pas activer les liens basés sur le scroll
            if (!window.location.pathname.endsWith('/') && !window.location.href.includes('#')) {
                return;
            }
            let current = '';
            const scrollPosition = window.scrollY + 200;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            // Default to home if no section is active and we're at the top
            if (!current && window.scrollY < 100) {
                current = 'hero';
            }

            // Desktop menu: Remove all active classes first
            document.querySelectorAll('.navbar-nav .nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Desktop menu: Add active class to current section's nav item
            if (current) {
                const activeDesktopLink = document.querySelector(`.navbar-nav .nav-link[data-section="${current}"]`);
                if (activeDesktopLink) {
                    activeDesktopLink.closest('.nav-item').classList.add('active');
                }
            }

            // Mobile menu: Remove all active classes first
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Mobile menu: Add active class to current section's nav link
            if (current) {
                const activeMobileLink = document.querySelector(`.mobile-nav-link[data-section="${current}"]`);
                if (activeMobileLink) {
                    activeMobileLink.classList.add('active');
                }
            }
        }

        // Call on page load and scroll
        setActiveLinks();
        window.addEventListener('scroll', setActiveLinks);
        window.addEventListener('resize', setActiveLinks);
    });
</script>