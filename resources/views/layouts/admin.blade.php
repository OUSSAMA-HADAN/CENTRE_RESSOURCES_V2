<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'Administration')</title>
    
    <!-- FontAwesome CDN (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Local CSS (includes Bootstrap, Animate.css, Summernote, Swiper) -->
    @if(app()->environment('local') && file_exists(base_path('public/hot')))
        {{-- Development: Use Vite dev server --}}
        @vite(['resources/css/app.css'])
    @else
        {{-- Production: Use compiled assets --}}
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
        @endphp
        @if($cssFile)
            <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
        @else
            <style>
                /* Fallback styles */
                body { font-family: system-ui, -apple-system, sans-serif; }
            </style>
        @endif
    @endif
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
            --primary-color: #4361ee;
            --dark-bg: #2b3137;
            --text-color: #333;
            --light-bg: #f5f7fb;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
        }

        /* Main layout container */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Header */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            border-bottom: 1px solid #e3e6f0;
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 500;
            margin-left: 15px;
            color: var(--text-color);
        }

        .header-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Sidebar toggle buttons */
        .sidebar-toggle-mobile {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            display: block;
            padding: 5px;
            color: var(--text-color);
        }

        .sidebar-toggle-desktop-header {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            display: none;
            padding: 8px;
            color: var(--text-color);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle-desktop-header:hover {
            background-color: rgba(0, 0, 0, 0.1);
            transform: scale(1.1);
        }

        .sidebar-toggle-desktop {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            display: none;
            transition: all 0.3s ease;
            border-radius: 4px;
            min-width: 32px;
            min-height: 32px;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-desktop:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .sidebar-toggle-desktop:active {
            transform: scale(0.95);
        }

        @media (min-width: 992px) {
            .sidebar-toggle-desktop {
                display: flex;
            }

            .sidebar-toggle-desktop-header {
                display: block;
            }

            .sidebar-toggle-mobile {
                display: none;
            }
        }

        /* Sidebar */
        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--dark-bg);
            color: white;
            overflow-y: auto;
            transition: width var(--transition-speed) ease;
            flex-shrink: 0;
            position: relative;
        }

        /* Sidebar visible state */
        .admin-sidebar.active {
            left: 0;
        }

        /* Sidebar on desktop */
        @media (min-width: 992px) {
            .admin-sidebar {
                width: var(--sidebar-width);
            }

            /* Collapsed state on desktop */
            .admin-sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }

            .admin-main {
                flex: 1;
                transition: all var(--transition-speed) ease;
            }
        }

        /* Collapsed state styles */
        .admin-sidebar.collapsed .sidebar-text {
            display: none;
        }

        .admin-sidebar .nav-icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            transition: margin var(--transition-speed) ease;
        }

        .admin-sidebar.collapsed .nav-icon {
            margin-right: 0;
        }

        .sidebar-logo-img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            transition: opacity var(--transition-speed) ease;
        }

        @media (min-width: 992px) {
            .admin-sidebar.collapsed .sidebar-title span {
                display: none;
            }

            .admin-sidebar.collapsed .sidebar-logo-img {
                display: none;
            }
        }

        /* Sidebar header */
        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            justify-content: space-between;
            position: relative;
        }

        .sidebar-title {
            color: white;
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        /* Sidebar menu */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: background-color 0.2s;
            border: none;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li.active a {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* Mobile overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Mobile sidebar behavior */
        @media (max-width: 991.98px) {
            .admin-layout {
                position: relative;
            }
            
            .admin-sidebar {
                position: fixed;
                left: -250px;
                width: var(--sidebar-width);
                height: 100vh;
                z-index: 1050;
                transition: left var(--transition-speed) ease;
            }
            
            .admin-sidebar.active {
                left: 0;
            }
            
            .admin-main {
                width: 100%;
                margin-left: 0;
            }
        }

        /* Main content */
        .admin-main {
            flex: 1;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            padding-top: var(--header-height);
        }

        .admin-content {
            padding: 20px;
            max-width: 100%;
            overflow-x: hidden;
            width: 100%;
            box-sizing: border-box;
            margin: 0;
        }

        /* Ensure content doesn't overflow */
        .admin-content .container,
        .admin-content .container-fluid {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Fix for tables and wide content */
        .admin-content table {
            max-width: 100%;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        .admin-content .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Close button for mobile */
        .sidebar-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            display: block;
        }

        @media (min-width: 992px) {
            .sidebar-close {
                display: none;
            }
        }

        /* Sidebar section headers */
        .sidebar-section-header {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            padding: 1.5rem 1.25rem 0.5rem;
        }

        .admin-sidebar.collapsed .sidebar-section-header {
            display: none;
        }

        /* Footer */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .admin-sidebar.collapsed .sidebar-footer {
            display: none;
        }

        /* Fix for Bootstrap compatibility */
        .admin-content .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .admin-content .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }

        .admin-content .table {
            width: 100%;
            margin-bottom: 1rem;
        }

        .admin-content .btn {
            font-weight: 500;
        }

        /* Ensure proper z-index for modals */
        .modal {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
        }

        /* Fix for dropdowns */
        .dropdown-menu {
            z-index: 1080 !important;
        }

        /* Ensure dropdown is visible */
        .header-actions .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.175);
        }

        .header-actions .dropdown.show .dropdown-menu {
            display: block;
        }

        /* Debug: Make dropdown always visible for testing - REMOVE THIS AFTER TESTING */
        /* .header-actions .dropdown-menu {
            display: block !important;
            opacity: 0.8;
        } */

        /* Alert styles */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        /* Additional responsive fixes */
        @media (max-width: 1200px) {
            .admin-content {
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 10px;
            }
        }

        /* Ensure proper scrolling on mobile */
        @media (max-width: 991.98px) {
            .admin-main {
                overflow-x: hidden;
            }
            
            .admin-content {
                overflow-x: hidden;
            }
        }

        /* Fix for very wide content */
        .admin-content * {
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Ensure proper flexbox behavior */
        .admin-layout {
            width: 100%;
            min-height: 100vh;
        }

        /* Desktop specific fixes */
        @media (min-width: 992px) {
            .admin-layout {
                display: flex;
                flex-direction: row;
            }
            
            .admin-sidebar {
                flex-shrink: 0;
            }
            
            .admin-main {
                flex: 1;
                min-width: 0; /* Prevents flex item from overflowing */
            }
        }

        /* Mobile specific fixes */
        @media (max-width: 991.98px) {
            .admin-layout {
                display: block;
            }
            
            .admin-sidebar {
                position: fixed;
                z-index: 1050;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Header -->
    <header class="admin-header">
        <button class="sidebar-toggle-mobile" id="sidebarToggleMobile">
            <i class="fas fa-bars"></i>
        </button>
        
        <button class="sidebar-toggle-desktop-header" id="sidebarToggleDesktopHeader">
            <i class="fas fa-bars"></i>
        </button>

        <div class="header-actions">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user me-1"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </button>
                    </form>
                </ul>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Layout Container -->
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="sidebar">
        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>

        <div class="sidebar-header">
            <h2 class="sidebar-title">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="sidebar-logo-img">
                <span>Administration</span>
            </h2>
            <button class="sidebar-toggle-desktop" id="sidebarToggleDesktop">
                <i class="fas fa-chevron-left" id="toggleIcon"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-section-header">Tableau de bord</li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <span class="sidebar-text">Tableau de Bord</span>
                </a>
            </li>

            <li class="sidebar-section-header">Gestion</li>
            <li class="{{ request()->routeIs('admin.candidats.*') ? 'active' : '' }}">
                <a href="{{ route('admin.candidats.index') }}">
                    <i class="fas fa-users nav-icon"></i>
                    <span class="sidebar-text">Candidats</span>
                </a>
            </li>


            <li class="{{ request()->routeIs('admin.documentation.index') ? 'active' : '' }}">
                <a href="{{ route('admin.documentation.index') }}">
                    <i class="fas fa-book nav-icon"></i>
                    <span class="sidebar-text">Documentation</span>
                </a>
            </li>
            
            <li class="{{ request()->routeIs('admin.formations.*') ? 'active' : '' }}">
                <a href="{{ route('admin.formations.index') }}">
                    <i class="fas fa-graduation-cap nav-icon"></i>
                    <span class="sidebar-text">Formations en ligne</span>
                </a>
            </li>
            
            <li class="sidebar-section-header">Système</li>
            <li>
                <a href="{{ route('home') }}">
                    <i class="fas fa-home nav-icon"></i>
                    <span class="sidebar-text">Retour au site</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="d-flex justify-content-center">
                <small class="text-muted">© {{ date('Y') }} Centre de Ressources</small>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    </div> <!-- End admin-layout -->

    <!-- Local JS (includes Bootstrap, jQuery, Popper.js, Summernote, Swiper) -->
    @if(app()->environment('local') && file_exists(base_path('public/hot')))
        {{-- Development: Use Vite dev server --}}
        @vite(['resources/js/app.js'])
    @else
        {{-- Production: Use compiled assets --}}
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
            $vendorFile = $manifest['resources/js/app.js']['imports'][0] ?? null;
            $swiperFile = $manifest['resources/js/app.js']['imports'][1] ?? null;
        @endphp
        @if($jsFile)
            @if($vendorFile && isset($manifest[$vendorFile]))
                <script src="{{ asset('build/' . $manifest[$vendorFile]['file']) }}"></script>
            @endif
            @if($swiperFile && isset($manifest[$swiperFile]))
                <script src="{{ asset('build/' . $manifest[$swiperFile]['file']) }}"></script>
            @endif
            <script src="{{ asset('build/' . $jsFile) }}"></script>
        @endif
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');
            const sidebarToggleDesktopHeader = document.getElementById('sidebarToggleDesktopHeader');
            const toggleIcon = document.getElementById('toggleIcon');
            const sidebarClose = document.getElementById('sidebarClose');

            // Check if sidebar state exists in localStorage
            const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            // Apply sidebar state on load for desktop
            if (window.innerWidth >= 992) {
                if (isSidebarCollapsed) {
                    sidebar.classList.add('collapsed');
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                }
            }

            // Toggle sidebar on desktop
            sidebarToggleDesktop?.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Desktop toggle clicked');
                sidebar.classList.toggle('collapsed');

                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });

            // Toggle sidebar from header (desktop)
            sidebarToggleDesktopHeader?.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Header toggle clicked');
                sidebar.classList.toggle('collapsed');

                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });

            // Open sidebar on mobile
            sidebarToggleMobile?.addEventListener('click', function() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            // Close sidebar
            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            sidebarClose?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            // Close sidebar when clicking on a menu item on mobile
            const menuItems = document.querySelectorAll('.sidebar-menu a');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    document.body.style.overflow = '';
                    overlay.classList.remove('active');
                    sidebar.classList.remove('active');

                    // Apply saved collapse state
                    const savedState = localStorage.getItem('sidebarCollapsed');
                    if (savedState === 'true') {
                        sidebar.classList.add('collapsed');
                        if (toggleIcon) {
                            toggleIcon.classList.remove('fa-chevron-left');
                            toggleIcon.classList.add('fa-chevron-right');
                        }
                    } else {
                        sidebar.classList.remove('collapsed');
                        if (toggleIcon) {
                            toggleIcon.classList.remove('fa-chevron-right');
                            toggleIcon.classList.add('fa-chevron-left');
                        }
                    }
                } else {
                    // Reset collapse state on mobile
                    sidebar.classList.remove('collapsed');
                    if (toggleIcon) {
                        toggleIcon.classList.remove('fa-chevron-right');
                        toggleIcon.classList.add('fa-chevron-left');
                    }
                }
            });

            // Initialize Bootstrap tooltips if needed
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Initialize Bootstrap dropdowns with more robust method
            setTimeout(function() {
                var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
                var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                    return new bootstrap.Dropdown(dropdownToggleEl)
                });
                
                // Also try manual initialization for the specific dropdown
                var userMenuDropdown = document.getElementById('userMenu');
                if (userMenuDropdown) {
                    new bootstrap.Dropdown(userMenuDropdown);
                }
            }, 100);

            // Manual click handler for dropdown as backup
            var userMenuButton = document.getElementById('userMenu');
            var userMenuDropdown = document.querySelector('#userMenu + .dropdown-menu');
            
            if (userMenuButton && userMenuDropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Toggle dropdown manually
                    var isOpen = userMenuDropdown.style.display === 'block';
                    if (isOpen) {
                        userMenuDropdown.style.display = 'none';
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    } else {
                        userMenuDropdown.style.display = 'block';
                        userMenuButton.setAttribute('aria-expanded', 'true');
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                        userMenuDropdown.style.display = 'none';
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>