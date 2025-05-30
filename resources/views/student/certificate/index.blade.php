@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-white shadow-lg rounded-2xl mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-10"></div>
        <div class="relative px-8 py-12">
            <div class="flex items-center space-x-4 mb-4">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Mes Certificats
                    </h1>
                    <p class="text-gray-600 mt-2">Découvrez et téléchargez vos certificats de réussite</p>
                </div>
            </div>
            
            <!-- Stats Bar -->
            <div class="flex items-center space-x-6 mt-6">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>{{ $courses->count() }} cours complétés</span>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Mis à jour aujourd'hui</span>
                </div>
            </div>
        </div>
    </div>

    @if($courses->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="text-center py-16 px-8">
                <div class="mx-auto w-32 h-32 mb-8 relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full animate-pulse"></div>
                    <div class="absolute inset-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Aucun certificat disponible</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Vous n'avez pas encore complété de cours. Commencez votre parcours d'apprentissage pour obtenir vos premiers certificats !
                </p>
                
                <div class="space-y-4">
                    <button class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Explorer les cours
                    </button>
                    
                    <p class="text-sm text-gray-500">
                        Ou consultez votre <a href="#" class="text-blue-500 hover:text-blue-600 underline">tableau de bord</a>
                    </p>
                </div>
            </div>
        </div>
    @else
        <!-- Certificates Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($courses as $course)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                    <!-- Certificate Header -->
                    <div class="relative h-32 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 overflow-hidden">
                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        <div class="absolute inset-0 bg-white bg-opacity-10 backdrop-blur-sm"></div>
                        
                        <!-- Decorative Elements -->
                        <div class="absolute top-4 right-4 w-8 h-8 border-2 border-white border-opacity-30 rounded-full"></div>
                        <div class="absolute top-6 right-6 w-4 h-4 bg-white bg-opacity-30 rounded-full"></div>
                        <div class="absolute bottom-4 left-4 w-12 h-12 border-2 border-white border-opacity-20 rounded-lg rotate-12"></div>
                        
                        <!-- Certificate Icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="p-4 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Certificate Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $course->title }}
                            </h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Complété avec succès</span>
                            </div>
                        </div>
                        
                        <!-- Achievement Badge -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-2">
                                <div class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                    ✓ Certifié
                                </div>
                                <div class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                    Vérifiable
                                </div>
                            </div>
                        </div>
                        
                        <!-- Download Button -->
                        <a href="{{ route('student.certificate.generate', $course->id) }}" 
                           class="block w-full">
                            <button class="w-full flex items-center justify-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 group-hover:from-blue-600 group-hover:to-purple-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Télécharger</span>
                            </button>
                        </a>
                        
                        <!-- Additional Actions -->
                        <div class="flex items-center justify-center space-x-4 mt-4 pt-4 border-t border-gray-100">
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-blue-500 text-sm transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                <span>Partager</span>
                            </button>
                            
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-green-500 text-sm transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Vérifier</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Bottom Action Section -->
        <div class="mt-12 bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 px-8 py-6">
                <div class="flex items-center justify-between text-white">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Félicitations ! 🎉</h3>
                        <p class="text-blue-100">Vous avez complété {{ $courses->count() }} cours avec succès</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">{{ $courses->count() }}</div>
                        <div class="text-sm text-blue-100">Certificats</div>
                    </div>
                </div>
            </div>
            
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-2">Continuez votre apprentissage</p>
                        <p class="text-sm text-gray-500">Explorez de nouveaux cours pour obtenir plus de certificats</p>
                    </div>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        Voir tous les cours
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection