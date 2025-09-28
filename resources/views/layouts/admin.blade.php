<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'Administration')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
            --primary-color: #4361ee;
            --dark-bg: #2b3137;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --transition-speed: 0.3s;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            overflow-x: hidden;
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
            z-index: 100;
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 500;
            margin-left: 15px;
        }

        .header-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
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

        .sidebar-toggle-desktop {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px;
            display: none;
            /* Hidden by default */
        }

        @media (min-width: 992px) {
            .sidebar-toggle-desktop {
                display: block;
                /* Show on desktop */
            }

            .sidebar-toggle-mobile {
                display: none;
                /* Hide on desktop */
            }
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            /* Start offscreen */
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--dark-bg);
            color: white;
            z-index: 200;
            overflow-y: auto;
            transition: left var(--transition-speed) ease, width var(--transition-speed) ease;
        }

        /* Sidebar visible state */
        .admin-sidebar.active {
            left: 0;
        }

        /* Sidebar on desktop */
        @media (min-width: 992px) {
            .admin-sidebar {
                left: 0;
                /* Always show on desktop */
                width: var(--sidebar-width);
            }

            /* Collapsed state on desktop */
            .admin-sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }

            .admin-main {
                margin-left: var(--sidebar-width);
                transition: margin-left var(--transition-speed) ease;
            }

            /* Main content when sidebar is collapsed */
            .admin-sidebar.collapsed~.admin-main {
                margin-left: var(--sidebar-collapsed-width);
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
            z-index: 150;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Main content */
        .admin-main {
            padding-top: var(--header-height);
            min-height: 100vh;
            transition: margin-left var(--transition-speed) ease;
        }

        .admin-content {
            padding: 20px;
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
                /* Hide on desktop */
            }
        }

        /* Section headers */
        .section-title {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            color: var(--dark-bg);
        }

        /* Card styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
        }

        /* Buttons */
        .btn-circle {
            border-radius: 100%;
            height: 2.5rem;
            width: 2.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-circle.btn-sm {
            height: 1.8rem;
            width: 1.8rem;
            font-size: 0.75rem;
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
    </style>

    @yield('styles')
</head>

<body>
    <!-- Header -->
    <header class="admin-header">
        <button class="sidebar-toggle-mobile" id="sidebarToggleMobile">
            <i class="fas fa-bars"></i>
        </button>
        {{-- <h1 class="header-title">@yield('page-title', 'Tableau de Bord')</h1> --}}

        <div class="header-actions">
            {{-- <div class="dropdown me-3">
                <button class="btn" type="button" id="notificationsMenu" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-bell"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsMenu">
                    <li>
                        <h6 class="dropdown-header">Notifications</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Nouveau candidat</a></li>
                    <li><a class="dropdown-item" href="#">Message reçu</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Voir toutes les notifications</a></li>
                </ul>
            </div> --}}

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-user me-1"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profil</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Paramètres</a></li> --}}
                    {{-- <li>
                        <hr class="dropdown-divider">
                    </li> --}}
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
            <li class="{{ request()->routeIs('admin.candidats.*') ? 'active' : '' }}">
                <a href="{{ route('admin.educatrices.index') }}">
                    <i class="fas fa-list me-2"></i> 
                    <span class="sidebar-text">Liste des éducatrices</span>
                </a>
            </li>
























            <li class="{{ request()->routeIs('admin.recherche.*') ? 'active' : '' }}">
                <a href="{{ route('admin.recherche.index') }}">
                    <i class="fas fa-microscope me-2"></i>
                    <span class="sidebar-text">Recherches</span>
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
            <!--<li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">-->
            <!--    <a href="">-->
            <!--        <i class="fas fa-cog nav-icon"></i>-->
            <!--        <span class="sidebar-text">Paramètres</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li>
                <a href="{{ route('home') }}">
                    <i class="fas fa-home nav-icon"></i>
                    <span class="sidebar-text">Retour au site</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="d-flex justify-content-center">
                <small class="text-muted">© {{ date('Y') }} Votre Entreprise</small>
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

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');
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
            sidebarToggleDesktop?.addEventListener('click', function() {
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
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });

            // Close sidebar
            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = ''; // Re-enable scrolling
            }

            sidebarClose?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            // Close sidebar when clicking on a menu item on mobile
            const menuItems = document.querySelectorAll('.sidebar-menu a');

            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 992) { // Only on mobile
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    document.body.style.overflow = ''; // Always enable scrolling on desktop
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
        });
    </script>

    @yield('scripts')
</body>

</html>
