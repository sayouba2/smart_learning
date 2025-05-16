<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles de base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f8fafc;
        }
        
        /* Navigation principale */
        header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Logo */
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4f46e5;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 0.5rem;
        }
        
        /* Conteneur des liens */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        /* Liens de navigation */
        .nav-link {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }
        
        .nav-link:hover {
            color: #4f46e5;
        }
        
        .nav-link i {
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }
        
        /* Boutons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: #4f46e5;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
        }
        
        .btn-outline {
            border: 1px solid #4f46e5;
            color: #4f46e5;
            background: transparent;
        }
        
        .btn-outline:hover {
            background-color: #eef2ff;
        }
        
        /* Dropdown utilisateur */
        .user-menu {
            position: relative;
        }
        
        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        
        .user-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            width: 200px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            overflow: hidden;
            z-index: 50;
            display: none;
        }
        
        .user-dropdown.show {
            display: block;
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .dropdown-item:hover {
            background-color: #f9fafb;
        }
        
        .dropdown-item i {
            width: 20px;
            margin-right: 0.75rem;
            color: #6b7280;
        }
        
        /* Menu mobile */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #4b5563;
            font-size: 1.25rem;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                gap: 0;
                padding: 1rem 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
                display: none;
            }
            
            .nav-links.show {
                display: flex;
            }
            
            .nav-link {
                padding: 1rem 1.5rem;
                width: 100%;
            }
            
            .user-dropdown {
                position: static;
                width: 100%;
                box-shadow: none;
                margin-top: 0;
            }
        }
    </style>
    @stack('styles')
    <title>Tableau de bord Etudiant</title>
</head>
<body>
    <header>
        <nav>
            <a href="/" class="logo">
                <i class="fas fa-graduation-cap"></i>
                Elearning
            </a>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-links" id="navLinks">
                @auth
                    <a href="{{ route('student.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    
                    <a href="{{ route('student.courses') }}" class="nav-link">
                        <i class="fas fa-book"></i> Mes Cours
                    </a>
                    
                    <div class="user-menu">
                        <div class="user-btn" id="userBtn">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        
                        <div class="user-dropdown" id="userDropdown">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="fas fa-user-cog"></i> Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Inscription
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Pied de page -->
    </footer>

    <script>
        // Gestion du menu mobile
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('show');
        });
        
        // Gestion du dropdown utilisateur
        document.getElementById('userBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('show');
        });
        
        // Fermer les menus quand on clique ailleurs
        window.addEventListener('click', function() {
            document.getElementById('userDropdown').classList.remove('show');
            document.getElementById('navLinks').classList.remove('show');
        });
    </script>
    
    @stack('scripts')
</body>
</html>