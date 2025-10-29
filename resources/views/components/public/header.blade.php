<nav class="navbar navbar-expand-lg navbar-dark shadow-lg fixed-top">
    <div class="container-fluid">
        <!-- Logo with hover effect -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div class="logo-container position-relative overflow-hidden">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" height="60" class="logo-image">
                <div class="logo-overlay"></div>
            </div>
            <span class="ms-2 d-none d-sm-inline text-light site-title">{{ __('header.title') }}</span>
        </a>

        <!-- Modern Language Toggle for Mobile -->
        <div class="d-lg-none me-3">
            <div class="language-switcher-mobile">
                <a href="{{ route('language.switch', app()->getLocale() == 'fr' ? 'ar' : 'fr') }}" 
                   class="language-btn-mobile-icon-only">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="language-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"></path>
                    </svg>
                </a>
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
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item position-relative mx-lg-1">
                    <a class="nav-link text-light px-3 py-2 {{ request()->routeIs('home') && !request()->routeIs('inscription.*') ? 'active' : '' }}" href="{{ route('home') }}#hero" data-section="hero">
                        <i class="fas fa-home me-1"></i>
                        <span>{{ __('header.home') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-lg-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#surNous" data-section="surNous">
                        <i class="fas fa-info-circle me-1"></i>
                        <span>{{ __('header.about') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown position-relative mx-lg-1">
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
                <li class="nav-item position-relative mx-lg-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#gallery" data-section="gallery">
                        <i class="fas fa-images me-1"></i>
                        <span>{{ __('header.gallery') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <li class="nav-item position-relative mx-lg-1">
                    <a class="nav-link text-light px-3 py-2" href="{{ route('home') }}#location" data-section="location">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        <span>{{ __('header.location') }}</span>
                    </a>
                    <span class="nav-indicator"></span>
                </li>
                <!-- Modern Language Switcher for Desktop - Icon Only -->
                <li class="nav-item position-relative mx-lg-1 d-none d-lg-block">
                    <div class="language-switcher-desktop">
                        <a href="{{ route('language.switch', app()->getLocale() == 'fr' ? 'ar' : 'fr') }}" 
                           class="language-btn-desktop-icon-only">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="language-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"></path>
                            </svg>
                        </a>
                    </div>
                    <span class="nav-indicator"></span>
                </li>
                <!-- S'inscrire Button for Desktop -->
                <li class="nav-item position-relative mx-lg-1 d-none d-lg-block">
                    <a class="btn signup-btn px-4 py-2" href="{{ route('inscription.form') }}" 
                       style="background-color: #f7a223; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-weight: 500; transition: all 0.3s ease; color: #fff; border: none;">
                        <i class="fas fa-user-plus me-2"></i>{{ __('header.register') }}
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
                    <li><a class="mobile-dropdown-item" href="{{route('documentation.index')}}">
                            <i class="fas fa-book me-2"></i>{{ __('header.units_dropdown.documentation') }}
                        </a></li>
                    <li><a class="mobile-dropdown-item"  href="{{route('formation.index')}}">
                            <i class="fas fa-users me-2"></i>{{ __('header.online_training') }}
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
            <!-- Mobile Language Switcher -->
            <li class="mobile-nav-item">
                <a class="mobile-nav-link" href="{{ route('language.switch', app()->getLocale() == 'fr' ? 'ar' : 'fr') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="me-2" style="width: 18px; height: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"></path>
                    </svg>
                    <span>{{ __('header.change_language') }}</span>
                </a>
            </li>
            <li class="mobile-nav-item mt-4">
                <a class="btn px-4 py-2 signup-btn w-100" href="{{route('inscription.form')}}" 
                    style="background-color: #f7a223; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-weight: 500; transition: all 0.3s ease;">
                    <i class="fas fa-user-plus me-2"></i>{{ __('header.register') }}
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Overlay for mobile sidebar -->
<div id="sidebar-overlay" class="sidebar-overlay"></div>

<style>
    /* Navbar styling */
    .navbar {
        background-color: rgba(16, 185, 129, 0.95);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
        padding: 12px 0;
        z-index: 1030;
    }

    /* Modern Language Switcher Styles */
    .language-switcher-desktop,
    .language-switcher-mobile {
        position: relative;
        display: inline-block;
    }

    .language-btn-desktop,
    .language-btn-mobile {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Icon-only language button */
    .language-btn-desktop-icon-only {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 0.5rem;
        text-decoration: none;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        width: 40px;
        height: 40px;
    }

    /* Icon-only language button for mobile */
    .language-btn-mobile-icon-only {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 0.4rem;
        text-decoration: none;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        width: 36px;
        height: 36px;
    }

    .language-btn-mobile {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 10px;
    }

    .language-btn-desktop:hover,
    .language-btn-mobile:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .language-btn-desktop-icon-only:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .language-btn-mobile-icon-only:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .language-icon {
        width: 20px;
        height: 20px;
        transition: all 0.3s ease;
    }

    .language-btn-mobile .language-icon {
        width: 16px;
        height: 16px;
    }

    .language-btn-mobile-icon-only .language-icon {
        width: 18px;
        height: 18px;
    }

    .language-btn-desktop:hover .language-icon,
    .language-btn-mobile:hover .language-icon {
        transform: rotate(15deg) scale(1.1);
    }

    .language-text {
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .language-indicator {
        position: absolute;
        top: 50%;
        right: 8px;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        animation: pulse 2s ease-in-out infinite;
    }

    .language-badge {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .mobile-nav-link:hover .language-badge {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    @keyframes pulse {
        0%, 100% { 
            opacity: 0.8; 
            transform: translateY(-50%) scale(1); 
        }
        50% { 
            opacity: 1; 
            transform: translateY(-50%) scale(1.2); 
        }
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
        font-size: 1.1rem;
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
        font-size: 0.95rem;
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
        font-size: 0.9rem;
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
        background-color: #e89417 !important;
    }

    /* Dropdown styling - FIXED FOR DESKTOP LANGUAGE SWITCHER */
    .dropdown-menu {
        background-color: #fff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin-top: 10px;
        min-width: 200px;
        z-index: 1031; /* Ensure dropdown appears above navbar */
    }

    .dropdown-item {
        color: #333;
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.2s ease;
        font-size: 0.9rem;
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
        right: -320px;
        width: 320px;
        max-width: 85vw;
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
        transition: transform 0.2s ease;
    }

    .close-sidebar:hover {
        transform: scale(1.1);
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
        font-size: 1rem;
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
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 0.5rem;
    }

    .mobile-dropdown-menu.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .mobile-dropdown-item {
        display: block;
        padding: 0.6rem 1rem;
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }

    .mobile-dropdown-item:hover,
    .mobile-dropdown-item.active {
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

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .navbar {
            padding: 10px 0;
        }
        
        .site-title {
            font-size: 1rem;
        }
        
        .navbar-nav .nav-link {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        
        .signup-btn {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
        }

        .language-btn-mobile {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }

        .language-btn-mobile .language-icon {
            width: 14px;
            height: 14px;
        }
    }

    @media (max-width: 767.98px) {
        .navbar {
            padding: 8px 0;
        }
        
        .logo-image {
            height: 50px !important;
        }
        
        .site-title {
            font-size: 0.9rem;
        }
        
        .mobile-sidebar {
            width: 280px;
        }
        
        .mobile-nav-link {
            font-size: 0.95rem;
            padding: 0.7rem 1rem;
        }
        
        .mobile-dropdown-item {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .language-btn-mobile {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .language-btn-mobile .language-icon {
            width: 12px;
            height: 12px;
        }
    }

    @media (max-width: 575.98px) {
        .mobile-sidebar {
            width: 260px;
        }
        
        .mobile-nav-link {
            font-size: 0.9rem;
            padding: 0.6rem 0.9rem;
        }
        
        .signup-btn {
            font-size: 0.8rem;
            padding: 0.6rem 1rem;
        }

        .language-btn-mobile {
            padding: 0.2rem 0.4rem;
            font-size: 0.7rem;
        }

        .language-btn-mobile .language-icon {
            width: 10px;
            height: 10px;
        }
    }

    @media (max-width: 375px) {
        .mobile-sidebar {
            width: 240px;
            padding: 0.75rem;
        }
        
        .mobile-nav-link {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }
        
        .mobile-dropdown-item {
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }

        .language-btn-mobile {
            padding: 0.15rem 0.3rem;
            font-size: 0.65rem;
        }

        .language-btn-mobile .language-icon {
            width: 8px;
            height: 8px;
        }
    }

    /* Hide desktop navbar on mobile */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            display: none !important;
        }
    }

    /* Show desktop navbar on larger screens */
    @media (min-width: 992px) {
        .mobile-sidebar,
        .sidebar-overlay {
            display: none !important;
        }
        
        #mobile-menu-toggle {
            display: none !important;
        }
        
        .d-lg-none {
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
        function handleNavbarScroll() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', handleNavbarScroll);

        // Function to open mobile sidebar
        function openSidebar() {
            mobileSidebar.classList.add('active');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Function to close mobile sidebar
        function closeSidebarMenu() {
            mobileSidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
            // Close all dropdowns when closing sidebar
            document.querySelectorAll('.mobile-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
            // Reset dropdown icons
            document.querySelectorAll('.dropdown-icon').forEach(icon => {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            });
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
                e.preventDefault();
                e.stopPropagation();
                
                const dropdownMenu = this.nextElementSibling;
                const dropdownIcon = this.querySelector('.dropdown-icon');
                
                // Close all other dropdowns
                document.querySelectorAll('.mobile-dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });
                
                // Reset all other dropdown icons
                document.querySelectorAll('.dropdown-icon').forEach(icon => {
                    if (icon !== dropdownIcon) {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                });
                
                // Toggle current dropdown
                dropdownMenu.classList.toggle('show');
                
                // Toggle icon
                if (dropdownMenu.classList.contains('show')) {
                    dropdownIcon.classList.remove('fa-chevron-down');
                    dropdownIcon.classList.add('fa-chevron-up');
                } else {
                    dropdownIcon.classList.remove('fa-chevron-up');
                    dropdownIcon.classList.add('fa-chevron-down');
                }
            });
        });

        // Handle dropdown item clicks
        const dropdownItems = document.querySelectorAll('.mobile-dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                closeSidebarMenu();
            });
        });

        // Set active link based on current section
        const sections = document.querySelectorAll('section[id]');

        function setActiveLinks() {
            // If we're not on home page, don't activate scroll-based links
            if (!window.location.pathname.endsWith('/') && !window.location.href.includes('#')) {
                return;
            }
            
            let current = '';
            const scrollPosition = window.scrollY + 100;

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

        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileSidebar.classList.contains('active')) {
                closeSidebarMenu();
            }
        });

        // Initialize navbar state
        handleNavbarScroll();

        // FIX: Ensure Bootstrap dropdowns work properly
        // Initialize all Bootstrap dropdowns
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });

        // Prevent dropdown from closing when clicking inside
        document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
            dropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    });
</script>
