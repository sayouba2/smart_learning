@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<section class="bg-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Apprenez sans limites</h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">Découvrez des milliers de cours en ligne dispensés par des experts dans leur domaine.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-gray-100 transition duration-300">Commencer maintenant</a>
            <a href="{{ route('courses.index') }}" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-indigo-600 transition duration-300">Explorer les cours</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir Elearning ?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Apprentissage flexible</h3>
                <p class="text-gray-600">Apprenez à votre rythme, quand et où vous voulez.</p>
            </div>
            <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Experts certifiés</h3>
                <p class="text-gray-600">Des cours dispensés par des professionnels reconnus.</p>
            </div>
            <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                <div class="text-indigo-600 text-4xl mb-4">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Certifications</h3>
                <p class="text-gray-600">Obtenez des certificats valorisants pour votre carrière.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Courses -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Cours populaires</h2>
            <a href="{{ route('courses.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Voir tous les cours →</a>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Exemple de carte de cours -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-book-open text-5xl text-indigo-500"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold">Introduction à Laravel</h3>
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">Nouveau</span>
                    </div>
                    <p class="text-gray-600 mb-4">Maîtrisez les bases du framework PHP Laravel.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-semibold">Gratuit</span>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">En savoir plus →</a>
                    </div>
                </div>
            </div>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-book-open text-5xl text-indigo-500"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold">Introduction à Laravel</h3>
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">Nouveau</span>
                    </div>
                    <p class="text-gray-600 mb-4">Maîtrisez les bases du framework PHP Laravel.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-semibold">Gratuit</span>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">En savoir plus →</a>
                    </div>
                </div>
            </div>

                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-book-open text-5xl text-indigo-500"></i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold">Introduction à Laravel</h3>
                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">Nouveau</span>
                    </div>
                    <p class="text-gray-600 mb-4">Maîtrisez les bases du framework PHP Laravel.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-semibold">Gratuit</span>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">En savoir plus →</a>
                    </div>
                </div>
            </div>
            <!-- Ajoutez d'autres cartes de cours ici -->
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-indigo-600 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-4">Prêt à commencer votre voyage d'apprentissage ?</h2>
        <p class="text-lg mb-6">Rejoignez des milliers d'étudiants qui améliorent déjà leurs compétences avec Elearning.</p>
        <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition duration-300">S'inscrire gratuitement</a>
    </div>
</section>
@endsection