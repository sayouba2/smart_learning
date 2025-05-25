<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elearning - Plateforme d'apprentissage en ligne</title>
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
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-indigo-600 transition">A propos</a>
                    <a href="{{ route('contact.show') }}" class="text-gray-700 hover:text-indigo-600 transition">Contact</a>
                </div>

                <!-- Boutons d'authentification -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-50 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Inscription</a>
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
                <a href="{{route('about')}}" class="block py-2 text-gray-700 hover:text-indigo-600">A Propos</a>
                <a href="{{ route('contact.show') }}" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
                <div class="pt-2 border-t">
                    <a href="{{ route('login') }}" class="block py-2 text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}" class="block py-2 text-white bg-indigo-600 rounded-md text-center">Inscription</a>
                </div>
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
                <p class="text-gray-600">La plateforme d'apprentissage en ligne pour tous.</p>
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
    <script>
        // Menu mobile
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>