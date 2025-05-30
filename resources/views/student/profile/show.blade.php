@extends('layouts.student')

@section('name')
    <div class="flex items-center justify-between">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent leading-tight">
            {{ __('Mon Profil') }}
        </h2>
        <div class="hidden sm:flex items-center space-x-2">
            <div class="h-2 w-2 bg-green-400 rounded-full animate-pulse"></div>
            <span class="text-sm text-gray-600 dark:text-gray-400">En ligne</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Profile Card -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl shadow-xl mb-8 border border-slate-200 dark:border-slate-700">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 opacity-10"></div>
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(168, 85, 247, 0.1) 0%, transparent 50%);"></div>
                
                <div class="relative p-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                        <!-- Avatar -->
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 p-1 shadow-lg">
                                <div class="w-full h-full rounded-full bg-white dark:bg-slate-800 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            </div>
                            <button class="absolute bottom-2 right-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 shadow-lg transition-all duration-200 transform hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ Auth::user()->name ?? 'Utilisateur' }}
                            </h1>
                            <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">
                                {{ Auth::user()->email ?? 'email@example.com' }}
                            </p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Étudiant
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Vérifié
                                </span>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-white/50 dark:bg-slate-700/50 rounded-lg p-3 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">12</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Cours</div>
                            </div>
                            <div class="bg-white/50 dark:bg-slate-700/50 rounded-lg p-3 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">8</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Terminés</div>
                            </div>
                            <div class="bg-white/50 dark:bg-slate-700/50 rounded-lg p-3 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">4.8</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Moyenne</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Main Forms -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Profile Information -->
                    <div class="group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white/20 rounded-lg p-2">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">{{ __('Informations du Profil') }}</h3>
                                </div>
                                <p class="text-blue-100 mt-2">{{ __('Mettez à jour vos informations personnelles et votre adresse email.') }}</p>
                            </div>
                            <div class="p-8">
                                @include('student.profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <!-- Password Update -->
                    <div class="group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-6">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white/20 rounded-lg p-2">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">{{ __('Sécurité du Compte') }}</h3>
                                </div>
                                <p class="text-amber-100 mt-2">{{ __('Assurez-vous que votre compte utilise un mot de passe sécurisé.') }}</p>
                            </div>
                            <div class="p-8">
                                @include('student.profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            {{ __('Actions Rapides') }}
                        </h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors duration-200 group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Télécharger CV') }}</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            <button class="w-full flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200 group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Partager Profil') }}</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2M7 4h10M7 4v16a1 1 0 001 1h8a1 1 0 001-1V4M7 8h10M7 12h10"></path>
                            </svg>
                            {{ __('Activité Récente') }}
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Profil mis à jour') }}</p>
                                    <p class="text-xs text-gray-400">{{ __('Il y a 2 heures') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Cours terminé') }}</p>
                                    <p class="text-xs text-gray-400">{{ __('Hier') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-600 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Nouveau certificat') }}</p>
                                    <p class="text-xs text-gray-400">{{ __('Il y a 3 jours') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-red-200 dark:border-red-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-pink-600 p-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 rounded-lg p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-white">{{ __('Zone de Danger') }}</h3>
                            </div>
                            <p class="text-red-100 mt-2">{{ __('Actions irréversibles sur votre compte.') }}</p>
                        </div>
                        <div class="p-8">
                            @include('student.profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .group:hover .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Gradient border animation */
        @keyframes gradient-border {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .gradient-border {
            background: linear-gradient(-45deg, #3b82f6, #8b5cf6, #ec4899, #10b981);
            background-size: 400% 400%;
            animation: gradient-border 5s ease infinite;
        }
    </style>
@endsection