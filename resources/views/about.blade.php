@extends('layouts.home')

@section('title', 'À propos de notre plateforme')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
        <div class="p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Notre Mission</h1>
            <p class="text-lg text-gray-600 mb-6">
                Nous nous engageons à fournir une éducation de qualité accessible à tous, 
                partout dans le monde, grâce à notre plateforme d'apprentissage en ligne innovante.
            </p>
            <div class="bg-blue-50 p-6 rounded-lg">
                <p class="text-blue-800 font-medium">
                    "Transformer l'éducation grâce à la technologie et rendre l'apprentissage 
                    accessible à tous."
                </p>
            </div>
        </div>
    </div>

    <!-- Notre Histoire -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Notre Histoire</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="text-gray-600 mb-4">
                    Fondée en 2020, notre plateforme est née de la passion pour l'éducation 
                    et la conviction que la technologie peut briser les barrières géographiques 
                    et économiques dans l'accès au savoir.
                </p>
                <p class="text-gray-600">
                    Depuis nos débuts modestes, nous avons grandi pour servir des milliers 
                    d'étudiants à travers le monde, avec une équipe dévouée d'experts en 
                    éducation et en technologie.
                </p>
            </div>
            <div class="bg-gray-100 rounded-lg flex items-center justify-center p-6">
                <img src="{{ asset('images/about-history.jpg') }}" alt="Notre histoire" class="rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <!-- Notre Équipe -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Rencontrez notre équipe</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Membre 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/team1.jpg') }}" alt="Directeur" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">Jean Dupont</h3>
                    <p class="text-blue-600">Directeur Général</p>
                    <p class="text-gray-600 text-sm mt-2">
                        Expert en éducation avec 15 ans d'expérience dans l'apprentissage en ligne.
                    </p>
                </div>
            </div>
            
            <!-- Membre 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/team2.jpg') }}" alt="CTO" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">Marie Lambert</h3>
                    <p class="text-blue-600">Directrice Technique</p>
                    <p class="text-gray-600 text-sm mt-2">
                        Passionnée par les technologies éducatives et l'innovation pédagogique.
                    </p>
                </div>
            </div>
            
            <!-- Membre 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/team3.jpg') }}" alt="Designer" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">Sophie Martin</h3>
                    <p class="text-blue-600">Designer UX/UI</p>
                    <p class="text-gray-600 text-sm mt-2">
                        Crée des expériences d'apprentissage intuitives et engageantes.
                    </p>
                </div>
            </div>
            
            <!-- Membre 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/team4.jpg') }}" alt="Pédagogue" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">Pierre Leroy</h3>
                    <p class="text-blue-600">Responsable Pédagogique</p>
                    <p class="text-gray-600 text-sm mt-2">
                        S'assure que nos cours répondent aux plus hauts standards de qualité.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Nos Valeurs -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Nos Valeurs</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Valeur 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                <div class="text-blue-500 text-2xl mb-4">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Excellence Académique</h3>
                <p class="text-gray-600">
                    Nous nous engageons à fournir un contenu éducatif de la plus haute qualité.
                </p>
            </div>
            
            <!-- Valeur 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500">
                <div class="text-green-500 text-2xl mb-4">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Accessibilité</h3>
                <p class="text-gray-600">
                    L'éducation devrait être accessible à tous, indépendamment de la situation géographique ou financière.
                </p>
            </div>
            
            <!-- Valeur 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-purple-500">
                <div class="text-purple-500 text-2xl mb-4">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Innovation</h3>
                <p class="text-gray-600">
                    Nous adoptons les dernières technologies pour améliorer l'expérience d'apprentissage.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-blue-600 rounded-lg shadow-lg p-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Prêt à commencer votre voyage d'apprentissage ?</h2>
        <p class="text-blue-100 mb-6">
            Rejoignez notre communauté de milliers d'apprenants satisfaits.
        </p>
        <a href="{{ route('register') }}" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-lg inline-block hover:bg-blue-50 transition">
            S'inscrire maintenant
        </a>
    </div>
</div>
@endsection