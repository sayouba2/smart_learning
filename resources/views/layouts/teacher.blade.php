<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Navigation principale */
        .main-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 50;
        }

        /* Conteneur des liens */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Style des liens */
        .nav-link {
            display: flex;
            align-items: center;
            color: #4b5563;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: #6366f1;
        }
        .nav-link i {
            margin-right: 0.5rem;
        }

        /* Boutons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-primary {
            background-color: #6366f1;
            color: white;
        }
        .btn-primary:hover {
            background-color: #4f46e5;
        }
        .btn-outline {
            border: 1px solid #6366f1;
            color: #6366f1;
            background: transparent;
        }
        .btn-outline:hover {
            background-color: #eef2ff;
        }

        /* Dropdown utilisateur */
        .user-dropdown {
            position: relative;
        }
        .user-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%; /* Positionné juste en dessous */
            margin-top: 0.5rem;
            width: 12rem;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            z-index: 50;
        }
        .user-dropdown-item {
            padding: 0.75rem 1rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            width: 100%;
            text-align: left;
        }
        .user-dropdown-item:hover {
            background-color: #f9fafb;
        }
        .user-dropdown-item i {
            width: 1.25rem;
            margin-right: 0.75rem;
        }

        /* Menu mobile */
        @media (max-width: 767px) {
            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                gap: 0;
                padding: 1rem 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            }
            .nav-link {
                padding: 0.75rem 1.5rem;
                width: 100%;
            }
        }
    </style>
    @stack('styles')
    @livewireStyles
    <title>Tableau de bord enseignant</title>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header>
        <nav class="main-nav">
            <!-- Logo -->
            <a href="/" class="text-xl font-bold text-indigo-600">
                <i class="fas fa-graduation-cap mr-2"></i>Elearning
            </a>

            <!-- Menu Desktop -->
            <div class="nav-links">
                @auth
                    <!-- Liens enseignant -->
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('teacher.courses.index') }}" class="nav-link">
                        <i class="fas fa-book"></i> Mes Cours
                    </a>
                    
                    <!-- Dropdown utilisateur -->
                    <div class="user-dropdown" x-data="{ open: false }">
                        <button @click="open = !open" class="nav-link focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="user-dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="user-dropdown-item">
                                <i class="fas fa-user-cog"></i> Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="user-dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Liens visiteur -->
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt mr-2"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus mr-2"></i> Inscription
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Le reste de votre template reste inchangé -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>