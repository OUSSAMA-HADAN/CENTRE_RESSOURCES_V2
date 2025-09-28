<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de Ressources du Préscolaire - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #10B981;
            --secondary-color: #0DCAF0;
            --dark-color: #1E293B;
            --light-color: #F8F9FA;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
        
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            z-index: 10;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px var(--shadow-color);
            width: 100%;
            max-width: 900px;
            overflow: hidden;
            display: flex;
            position: relative;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .login-sidebar {
            background: linear-gradient(to bottom, var(--dark-color), var(--primary-color));
            width: 40%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-sidebar::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            top: -50%;
            left: -50%;
            animation: pulse 15s infinite;
        }
        
        .login-sidebar .logo {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        
        .login-sidebar .logo img {
            width: 120px;
            height: auto;
        }
        
        .login-sidebar h3 {
            font-weight: 600;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        .login-sidebar p {
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.6;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .login-sidebar .decorative-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
        }
        
        .decorative-icon {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            animation: float 8s infinite ease-in-out;
        }
        
        .icon-1 {
            top: 10%;
            left: 10%;
            font-size: 30px;
            animation-delay: 0s;
        }
        
        .icon-2 {
            top: 30%;
            right: 15%;
            font-size: 25px;
            animation-delay: 1s;
        }
        
        .icon-3 {
            bottom: 20%;
            left: 20%;
            font-size: 35px;
            animation-delay: 2s;
        }
        
        .icon-4 {
            bottom: 10%;
            right: 10%;
            font-size: 28px;
            animation-delay: 3s;
        }
        
        .login-form-container {
            width: 60%;
            padding: 50px;
            position: relative;
        }
        
        .login-form-container h2 {
            color: var(--dark-color);
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .login-form-container p {
            color: #64748B;
            margin-bottom: 30px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .input-group label {
            position: absolute;
            top: -10px;
            left: 15px;
            background-color: white;
            padding: 0 5px;
            font-size: 14px;
            color: var(--primary-color);
            font-weight: 500;
            transition: all 0.3s ease;
            z-index: 1;
        }
        
        .input-group .icon-wrapper {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
        }
        
        .input-group .icon-wrapper i {
            color: #94A3B8;
        }
        
        .input-group input {
            width: 100%;
            height: 60px;
            border-radius: 10px;
            border: 2px solid #E2E8F0;
            padding: 0 20px 0 45px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
            outline: none;
        }
        
        .input-group input:focus + .icon-wrapper i {
            color: var(--primary-color);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .forgot-password:hover {
            color: var(--dark-color);
        }
        
        .btn-login {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-weight: 600;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background: #0DA271;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .back-to-site {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748B;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .back-to-site:hover {
            color: var(--dark-color);
        }
        
        .form-error {
            background-color: #FEE2E2;
            color: #EF4444;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        
        .form-error i {
            margin-right: 10px;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            0% {
                transform: translateY(40px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.2;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        @keyframes shake {
            10%, 90% {
                transform: translate3d(-1px, 0, 0);
            }
            20%, 80% {
                transform: translate3d(2px, 0, 0);
            }
            30%, 50%, 70% {
                transform: translate3d(-3px, 0, 0);
            }
            40%, 60% {
                transform: translate3d(3px, 0, 0);
            }
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .login-card {
                max-width: 700px;
            }
        }
        
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 500px;
            }
            .login-sidebar, .login-form-container {
                width: 100%;
            }
            .login-sidebar {
                padding: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .login-form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Particles background -->
    <div id="particles-js" class="particles"></div>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Sidebar -->
            <div class="login-sidebar">
                <div class="logo">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Centre de Ressources du Préscolaire">
                </div>
                <h3>Centre de Ressources du Préscolaire</h3>
                <p>Plateforme d'administration pour la gestion des ressources, formations et contenus pédagogiques.</p>
                
                <div class="decorative-icons">
                    <i class="fas fa-graduation-cap decorative-icon icon-1"></i>
                    <i class="fas fa-book decorative-icon icon-2"></i>
                    <i class="fas fa-chalkboard-teacher decorative-icon icon-3"></i>
                    <i class="fas fa-child decorative-icon icon-4"></i>
                </div>
            </div>
            
            <!-- Login Form -->
            <div class="login-form-container">
                <h2>Connexion Administrateur</h2>
                <p>Entrez vos identifiants pour accéder au panneau d'administration</p>
                
                @if ($errors->any())
                <div class="form-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="input-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        <div class="icon-wrapper">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                        <div class="icon-wrapper">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    
                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Se souvenir de moi</label>
                        </div>
                        <a href="
                        {{-- {{ route('admin.password.request') }} --}}
                         " class="forgot-password">Mot de passe oublié?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        Se connecter <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    
                    <a href="{{ route('home') }}" class="back-to-site">
                        <i class="fas fa-arrow-left me-2"></i> Retour au site
                    </a>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        // Initialize particles.js
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        }
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 0.5
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
        });
    </script>
</body>
</html>