<style>
    /* ---- SIDEBAR STYLES ---- */
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: var(--sidebar-width);
        height: 100vh;
        background-color: var(--dark-bg);
        color: white;
        overflow-y: auto;
        transition: transform var(--transition-speed) ease, width var(--transition-speed) ease;
        z-index: 1001;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Default state is hidden */
        transform: translateX(-100%);
    }
    
    /* Collapsed sidebar pushed left to show only the icons */
    .admin-sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
        transform: translateX(calc(-100% + var(--sidebar-collapsed-width)));
    }
    
    @media (min-width: 768px) {
        .admin-sidebar.show.expanded {
            transform: translateX(0);
        }
        
        .admin-sidebar.show.collapsed {
            transform: translateX(0);
        }
    }
    
    /* Top space for header on mobile */
    @media (max-width: 767px) {
        .admin-sidebar {
            top: var(--header-height);
            height: calc(100vh - var(--header-height));
            width: var(--sidebar-width) !important; /* Force full width on mobile */
        }
    }
    
    .sidebar-header {
        height: var(--header-height);
        display: flex;
        align-items: center;
        padding: 0 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .sidebar-logo {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.2rem;
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
    }
    
    .sidebar-logo img {
        width: 32px;
        height: 32px;
        margin-right: 10px;
        transition: margin var(--transition-speed);
    }
    
    .sidebar-logo span {
        transition: opacity var(--transition-speed);
    }
    
    .admin-sidebar.collapsed .sidebar-logo span {
        opacity: 0;
        width: 0;
        display: none;
    }
    
    .admin-sidebar.collapsed .sidebar-logo img {
        margin-right: 0;
    }
    
    .sidebar-toggle {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    
    .sidebar-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 15px 0;
        margin: 0;
    }
    
    .sidebar-menu-header {
        color: rgba(255, 255, 255, 0.6);
        padding: 15px 20px 5px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        overflow: hidden;
        transition: opacity var(--transition-speed);
    }
    
    .admin-sidebar.collapsed .sidebar-menu-header {
        opacity: 0;
        height: 0;
        padding: 0;
        margin: 0;
        display: none;
    }
    
    .sidebar-menu li a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        white-space: nowrap;
    }
    
    .sidebar-menu li a:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: white;
    }
    
    .sidebar-menu li.active a {
        background-color: rgba(255, 255, 255, 0.05);
        border-left-color: var(--primary-color);
        color: white;
    }
    
    .nav-icon {
        width: 20px;
        text-align: center;
        margin-right: 15px;
        font-size: 1rem;
        transition: margin var(--transition-speed);
    }
    
    .admin-sidebar.collapsed .nav-icon {
        margin-right: 0;
    }
    
    .sidebar-menu .nav-text,
    .sidebar-menu .badge {
        transition: opacity var(--transition-speed);
    }
    
    .admin-sidebar.collapsed .nav-text,
    .admin-sidebar.collapsed .badge {
        opacity: 0;
        display: none;
    }
    
    .sidebar-footer {
        padding: 15px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        transition: opacity var(--transition-speed);
    }
    
    .admin-sidebar.collapsed .sidebar-footer {
        opacity: 0;
        height: 0;
        padding: 0;
        overflow: hidden;
        display: none;
    }
    
    .sidebar-footer .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 8px 12px;
        background-color: transparent;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    
    .sidebar-footer .btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .sidebar-footer .btn i {
        margin-right: 8px;
    }
    
    .mobile-close {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }
    
    @media (max-width: 767px) {
        .mobile-close {
            display: block;
        }
        
        .sidebar-toggle {
            display: none;
        }
        
        .admin-sidebar.collapsed .sidebar-logo span,
        .admin-sidebar.collapsed .nav-text,
        .admin-sidebar.collapsed .badge,
        .admin-sidebar.collapsed .sidebar-menu-header,
        .admin-sidebar.collapsed .sidebar-footer {
            opacity: 1;
            display: block;
            height: auto;
            width: auto;
        }
        
        .admin-sidebar.collapsed .nav-icon {
            margin-right: 15px;
        }
        
        .admin-sidebar.collapsed .sidebar-logo img {
            margin-right: 10px;
        }
    }
</style>

<aside class="admin-sidebar" id="admin-sidebar">
    <!-- Mobile close button -->
    <button class="mobile-close" id="mobile-close">
        <i class="fas fa-times"></i>
    </button>
    
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo">
            <span class="text-center">ADMIN<br>tableau de bord</span>
        </a>
        <button class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left" id="sidebar-toggle-icon"></i>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-header">Navigation</li>
            
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <span class="nav-text">Tableau de Bord</span>
                </a>
            </li>
            
            <li class="sidebar-menu-header">Gestion</li>
            
            <li class="{{ Route::is('admin.candidats.*') ? 'active' : '' }}">
                <a href="{{ route('admin.candidats.index') }}">
                    <i class="fas fa-users nav-icon"></i>
                    <span class="nav-text">Candidats</span>
                    @if(isset($candidateCount) && $candidateCount > 0)
                        <span class="badge bg-primary">{{ $candidateCount }}</span>
                    @endif
                </a>
            </li>
            







            
            














            
            <li class="{{ Route::is('admin.recherche.*') ? 'active' : '' }}">
                <a href="{{ route('admin.recherche.index') }}">
                    <i class="fas fa-microscope nav-icon"></i>
                    <span class="nav-text">Recherches</span>
                    @if(isset($researchCount) && $researchCount > 0)
                        <span class="badge bg-success">{{ $researchCount }}</span>
                    @endif
                </a>
            </li>
            
            <li class="{{ Route::is('admin.documentation.*') ? 'active' : '' }}">
                <a href="{{ route('admin.documentation.index') }}">
                    <i class="fas fa-book nav-icon"></i>
                    <span class="nav-text">Documentation</span>
                    @if(isset($documentCount) && $documentCount > 0)
                        <span class="badge bg-warning">{{ $documentCount }}</span>
                    @endif
                </a>
            </li>
            
            <li class="{{ Route::is('admin.formations.*') ? 'active' : '' }}">
                <a href="{{ route('admin.formations.index') }}">
                    <i class="fas fa-graduation-cap nav-icon"></i>
                    <span class="nav-text">Formations</span>
                    @if(isset($formationCount) && $formationCount > 0)
                        <span class="badge bg-info">{{ $formationCount }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="btn">
            <i class="fas fa-home"></i>
            <span>Retour au Site</span>
        </a>
    </div>
</aside>