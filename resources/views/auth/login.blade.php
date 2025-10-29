<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Centre de Ressources du Préscolaire - Administration">
    <title>Centre de Ressources du Préscolaire - Admin</title>
    
    <!-- FontAwesome CDN (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Local CSS will be loaded via Vite -->
    @if(app()->environment('local') && file_exists(base_path('public/hot')))
        {{-- Development: Use Vite dev server --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Production: Use compiled assets --}}
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
            $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
            $vendorFile = $manifest['resources/js/app.js']['imports'][0] ?? null;
            $swiperFile = $manifest['resources/js/app.js']['imports'][1] ?? null;
        @endphp
        @if($cssFile)
            <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
        @else
            <style>
                /* Fallback styles */
                body { font-family: system-ui, -apple-system, sans-serif; }
            </style>
        @endif
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
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <style>
        :root {
            --primary-color: #10B981;
            --primary-dark: #0DA271;
            --secondary-color: #0DCAF0;
            --dark-color: #1E293B;
            --light-color: #F8F9FA;
            --gray-light: #E2E8F0;
            --gray-medium: #64748B;
            --error-color: #EF4444;
            --error-bg: #FEE2E2;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }
        
        /* Enhanced Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            display: flex;
            overflow: hidden;
            animation: cardEntrance 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        
        /* Sidebar - Optimized for mobile */
        .login-sidebar {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--primary-color) 100%);
            padding: clamp(30px, 5vw, 50px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
            flex: 0 0 40%;
            min-width: 300px;
        }
        
        .login-sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
            animation: backgroundShift 20s ease-in-out infinite;
        }
        
        .logo {
            margin-bottom: clamp(20px, 4vw, 30px);
            position: relative;
            z-index: 2;
        }
        
        .logo img {
            width: clamp(80px, 15vw, 120px);
            height: auto;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }
        
        .login-sidebar h3 {
            font-weight: 600;
            margin-bottom: clamp(12px, 2vw, 15px);
            font-size: clamp(1.25rem, 3vw, 1.5rem);
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .login-sidebar p {
            text-align: center;
            margin-bottom: clamp(20px, 4vw, 30px);
            opacity: 0.9;
            font-size: clamp(0.9rem, 2vw, 1rem);
            line-height: 1.5;
            position: relative;
            z-index: 2;
            max-width: 300px;
        }
        
        /* Form Section */
        .login-form-container {
            flex: 0 0 60%;
            padding: clamp(30px, 5vw, 50px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .login-form-container h2 {
            color: var(--dark-color);
            margin-bottom: 8px;
            font-weight: 700;
            font-size: clamp(1.5rem, 4vw, 2rem);
        }
        
        .login-form-container > p {
            color: var(--gray-medium);
            margin-bottom: clamp(25px, 5vw, 30px);
            font-size: clamp(0.9rem, 2vw, 1rem);
        }
        
        /* Form Elements */
        .form-group {
            position: relative;
            margin-bottom: clamp(20px, 4vw, 25px);
        }
        
        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            background: white;
            padding: 0 8px;
            font-size: 0.875rem;
            color: var(--primary-color);
            font-weight: 500;
            z-index: 2;
            transition: var(--transition);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-medium);
            transition: var(--transition);
            z-index: 2;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-input {
            width: 100%;
            height: 56px;
            border-radius: var(--border-radius);
            border: 2px solid var(--gray-light);
            padding: 0 20px 0 48px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            font-family: inherit;
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            outline: none;
        }
        
        .form-input:focus + .input-icon {
            color: var(--primary-color);
        }
        
        /* Form Utilities */
        .form-utilities {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: clamp(20px, 4vw, 25px);
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--gray-medium);
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid var(--gray-light);
            cursor: pointer;
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .forgot-link:hover {
            color: var(--primary-dark);
        }
        
        /* Buttons */
        .btn-login {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 16px 24px;
            font-weight: 600;
            width: 100%;
            font-size: 1rem;
            transition: var(--transition);
            margin-bottom: 20px;
            cursor: pointer;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-medium);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
            gap: 8px;
        }
        
        .back-link:hover {
            color: var(--dark-color);
        }
        
        /* Error States */
        .form-error {
            background: var(--error-bg);
            color: var(--error-color);
            padding: 16px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease-out;
        }
        
        /* Animations */
        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes backgroundShift {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
                align-items: flex-start;
                min-height: 100vh;
                height: auto;
            }
            
            .login-card {
                flex-direction: column;
                min-height: auto;
                max-width: 500px;
                margin: 20px auto;
            }
            
            .login-sidebar {
                flex: none;
                min-width: auto;
                padding: 40px 30px;
                border-radius: var(--border-radius) var(--border-radius) 0 0;
            }
            
            .login-form-container {
                flex: none;
                padding: 40px 30px;
            }
            
            .form-utilities {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .forgot-link {
                align-self: flex-end;
            }
        }
        
        @media (max-width: 480px) {
            .login-sidebar,
            .login-form-container {
                padding: 30px 20px;
            }
            
            .logo img {
                width: 70px;
            }
            
            .form-input {
                height: 52px;
                font-size: 16px; /* Prevent zoom on iOS */
            }
            
            .btn-login {
                padding: 14px 20px;
            }
        }
        
        @media (max-width: 360px) {
            body {
                padding: 12px;
            }
            
            .login-sidebar,
            .login-form-container {
                padding: 25px 16px;
            }
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .login-card {
                background: white;
                border: 2px solid var(--dark-color);
            }
            
            .form-input {
                border-width: 2px;
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .login-card {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }
        
        /* Loading state */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }
        
        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="logo">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Centre de Ressources du Préscolaire" loading="eager">
            </div>
            <h3>Centre de Ressources du Préscolaire</h3>
            <p>Plateforme d'administration pour la gestion des ressources, formations et contenus pédagogiques.</p>
        </div>
        
        <!-- Login Form -->
        <div class="login-form-container">
            <h2>Connexion Administrateur</h2>
            <p>Entrez vos identifiants pour accéder au panneau d'administration</p>
            
            @if ($errors->any())
            <div class="form-error" role="alert">
                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input" required autocomplete="email" autofocus>
                        <div class="input-icon">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-input" required autocomplete="current-password">
                        <div class="input-icon">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-utilities">
                    <label class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Se souvenir de moi
                    </label>
                    <a href="#" class="forgot-link">Mot de passe oublié?</a>
                </div>
                
                <button type="submit" class="btn-login" id="loginButton">
                    Se connecter <i class="fas fa-arrow-right ms-2" aria-hidden="true"></i>
                </button>
                
                <a href="{{ route('home') }}" class="back-link">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Retour au site
                </a>
            </form>
        </div>
    </div>

    <script>
        // Enhanced form handling with performance optimizations
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            
            if (loginForm) {
                // Form submission handler
                loginForm.addEventListener('submit', function(e) {
                    const email = document.getElementById('email').value.trim();
                    const password = document.getElementById('password').value;
                    
                    // Basic client-side validation
                    if (!email || !password) {
                        e.preventDefault();
                        showError('Veuillez remplir tous les champs obligatoires.');
                        return;
                    }
                    
                    // Show loading state
                    if (loginButton) {
                        loginButton.classList.add('loading');
                        loginButton.disabled = true;
                        loginButton.innerHTML = 'Connexion...';
                    }
                });
                
                // Real-time validation
                const emailInput = document.getElementById('email');
                const passwordInput = document.getElementById('password');
                
                if (emailInput) {
                    emailInput.addEventListener('blur', validateEmail);
                }
                
                if (passwordInput) {
                    passwordInput.addEventListener('blur', validatePassword);
                }
            }
            
            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    showFieldError(emailInput, 'Format d\'email invalide');
                    return false;
                } else {
                    clearFieldError(emailInput);
                    return true;
                }
            }
            
            function validatePassword() {
                const password = passwordInput.value;
                
                if (password && password.length < 6) {
                    showFieldError(passwordInput, 'Le mot de passe doit contenir au moins 6 caractères');
                    return false;
                } else {
                    clearFieldError(passwordInput);
                    return true;
                }
            }
            
            function showFieldError(input, message) {
                clearFieldError(input);
                input.style.borderColor = 'var(--error-color)';
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error';
                errorDiv.style.cssText = `
                    color: var(--error-color);
                    font-size: 0.8rem;
                    margin-top: 5px;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                `;
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                
                input.parentNode.appendChild(errorDiv);
            }
            
            function clearFieldError(input) {
                input.style.borderColor = '';
                const existingError = input.parentNode.querySelector('.field-error');
                if (existingError) {
                    existingError.remove();
                }
            }
            
            function showError(message) {
                // Remove existing errors
                const existingErrors = document.querySelectorAll('.form-error');
                existingErrors.forEach(error => error.remove());
                
                // Create new error
                const errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.setAttribute('role', 'alert');
                errorDiv.innerHTML = `
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                    <span>${message}</span>
                `;
                
                // Insert after the description paragraph
                const description = document.querySelector('.login-form-container > p');
                if (description) {
                    description.parentNode.insertBefore(errorDiv, description.nextSibling);
                }
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.remove();
                    }
                }, 5000);
            }
            
            // Focus management for accessibility
            const firstInput = document.querySelector('.form-input');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>
</body>
</html>