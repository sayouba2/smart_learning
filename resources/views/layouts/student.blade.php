<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Etudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation principale -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-indigo-600">
                        <i class="fas fa-graduation-cap mr-2"></i>Elearning
                    </a>
                </div>

                <!-- Liens de navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 transition">Accueil</a>
                    <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-indigo-600 transition">Cours</a>
                    <a href="{{route('about')}}" class="text-gray-700 hover:text-indigo-600 transition">A Propos</a>
                    <a href="{{ route('contact.show') }}" class="text-gray-700 hover:text-indigo-600 transition">Contact</a>
                </div>

                <!-- Bouton utilisateur avec dropdown -->
                <div class="flex items-center">
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="hidden md:inline text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform duration-200" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                <i class="fas fa-user-cog mr-2"></i>Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-50 transition">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        <span class="hidden md:inline">Connexion</span>
                    </a>
                    @endauth
                </div>

                <!-- Menu mobile -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile (dépliant) -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Accueil</a>
                <a href="{{ route('courses.index') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Cours</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Fonctionnalités</a>
                <a href="{{ route('contact.show') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
                
                @auth
                <div class="pt-2 border-t">
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-user-cog mr-2"></i>Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
                @else
                <div class="pt-2 border-t">
                    <a href="{{ route('login') }}" class="block py-2 text-indigo-600">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Pied de page -->
<footer class="bg-white text-gray-800 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Elearning</h3>
                <p class="text-gray-600">La plateforme <br> d'apprentissage en <br> ligne pour tous.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600">Accueil</a></li>
                    <li><a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-indigo-600">Cours</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Prix</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Légal</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Mentions légales</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">CGU</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-indigo-600">Confidentialité</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact</h4>
                <ul class="space-y-2">
                    <li class="text-gray-600"><i class="fas fa-envelope mr-2"></i> contact@elearning.com</li>
                    <li class="text-gray-600"><i class="fas fa-phone mr-2"></i> +212 623113083</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-200 mt-8 pt-8 text-center text-gray-600">
            <p>© {{ date('Y') }} Elearning. Tous droits réservés.</p>
        </div>
    </div>
</footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Menu mobile
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>