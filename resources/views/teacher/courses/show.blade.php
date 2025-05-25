@extends('layouts.teacher')

@push('styles')
<style>
    /* Animation des cartes */
    .card-animate {
        transition: all 0.3s ease;
    }
    .card-animate:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Style des leçons */
    .lesson-item {
        transition: all 0.2s ease;
        border-left: 4px solid #3B82F6;
    }
    .lesson-item:hover {
        background-color: #F8FAFC;
        border-left-width: 6px;
    }

    /* Barre de progression */
    .progress-bar {
        transition: width 1s ease-in-out;
    }

    /* Badges */
    .badge-completed {
        background-color: #ECFDF5;
        color: #059669;
    }
    .badge-in-progress {
        background-color: #FFFBEB;
        color: #B45309;
    }

    /* Boutons */
    .btn-primary {
        background-color: #4F46E5;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #4338CA;
        transform: translateY(-2px);
    }

    /* Animation d'entrée */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- En-tête avec animation -->
    <div class="flex justify-between items-center mb-8 animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
            <p class="text-gray-500">{{ $course->category->name }}</p>
        </div>
        <a href="{{ route('teacher.courses.edit', $course) }}" 
           class="btn-primary text-white px-6 py-3 rounded-lg shadow-md flex items-center">
            <i class="fas fa-edit mr-2"></i>
            Modifier le cours
        </a>
    </div>

    <!-- Grille principale -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Colonne 1 : Détails du cours -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Carte Description -->
            <div class="card-animate bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Description du cours
                    </h2>
                    <p class="text-gray-600 mb-6">{{ $course->description }}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="block text-sm text-gray-500">Niveau</span>
                            <span class="font-medium text-gray-800">{{ ucfirst($course->level) }}</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="block text-sm text-gray-500">Durée</span>
                            <span class="font-medium text-gray-800">{{ $course->duration }} heures</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="block text-sm text-gray-500">Prix</span>
                            <span class="font-medium text-gray-800">
                                {{ $course->is_free ? 'Gratuit' : $course->price.' €' }}
                            </span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="block text-sm text-gray-500">Leçons</span>
                            <span class="font-medium text-gray-800">{{ $course->lessons->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des leçons avec animation -->
            <div class="card-animate bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold flex items-center">
                            <i class="fas fa-list-ol text-blue-500 mr-2"></i>
                            Plan du cours
                        </h2>
                        <a href="{{ route('teacher.lessons.create', ['course' => $course]) }}" 
                           class="text-sm bg-blue-50 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-100">
                            <i class="fas fa-plus mr-1"></i> Ajouter
                        </a>
                    </div>
                    
                    <div class="space-y-3" id="lessons-container">
                        @foreach($course->lessons->sortBy('order') as $lesson)
                        <a href="{{ route('teacher.lessons.edit', ['course' => $course, 'lesson' => $lesson]) }}" 
                           class="lesson-item block pl-4 py-3 pr-2 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $lesson->title }}</h4>
                                    <p class="text-sm text-gray-500 truncate">{{ Str::limit($lesson->content, 60) }}</p>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded mr-2">
                                        {{ $lesson->duration }} min
                                    </span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne 2 : Statistiques et étudiants -->
        <div class="space-y-6">
            <!-- Carte Statistiques -->
            <div class="card-animate bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                        Statistiques
                    </h2>
                    
                    <div class="space-y-5">
                        <!-- Taux de complétion -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-500">Taux de complétion</span>
                                <span class="text-sm font-medium text-blue-600">{{ $stats['completion_rate'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="progress-bar bg-blue-600 h-2.5 rounded-full" 
                                     style="width: {{ $stats['completion_rate'] }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Note moyenne -->
                        <div>
                            <span class="block text-sm text-gray-500 mb-1">Note moyenne</span>
                            <div class="flex items-center">
                                <div class="flex mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($stats['avg_rating']))
                                            <i class="fas fa-star text-yellow-400"></i>
                                        @elseif($i - 0.5 <= $stats['avg_rating'])
                                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="font-medium">{{ number_format($stats['avg_rating'], 1) }}/5</span>
                            </div>
                        </div>
                        
                        <!-- Étudiants inscrits -->
                        <div>
                            <span class="block text-sm text-gray-500">Étudiants inscrits</span>
                            <span class="font-medium text-2xl">{{ $stats['enrollments_count'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des étudiants -->
            <div class="card-animate bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        Étudiants inscrits
                    </h2>
                    
                    <div class="space-y-3" id="students-list">
                        @forelse($course->students as $student)
                        <div class="flex items-center justify-between py-2 px-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                <span>{{ $student->name }}</span>
                            </div>
                            @if($student->pivot->completed_at)
                                <span class="badge-completed text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-check mr-1"></i> Terminé
                                </span>
                            @else
                                <span class="badge-in-progress text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-spinner mr-1"></i> En cours
                                </span>
                            @endif
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-500">
                            <i class="fas fa-user-graduate text-2xl mb-2"></i>
                            <p>Aucun étudiant inscrit</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des éléments au chargement
    const animateElements = document.querySelectorAll('.card-animate, .lesson-item');
    animateElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.5s ease';
        el.style.transitionDelay = `${index * 0.1}s`;
        
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 50);
    });

    // Tooltip pour les étoiles de notation
    const ratingElement = document.querySelector('.flex.mr-2');
    if (ratingElement) {
        ratingElement.addEventListener('mouseover', (e) => {
            if (e.target.classList.contains('fa-star') || 
                e.target.classList.contains('fa-star-half-alt') || 
                e.target.classList.contains('far')) {
                e.target.style.transform = 'scale(1.2)';
            }
        });
        
        ratingElement.addEventListener('mouseout', (e) => {
            if (e.target.classList.contains('fa-star') || 
                e.target.classList.contains('fa-star-half-alt') || 
                e.target.classList.contains('far')) {
                e.target.style.transform = 'scale(1)';
            }
        });
    }

    // Animation de la barre de progression
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        // Réinitialiser la largeur pour l'animation
        progressBar.style.width = '0';
        setTimeout(() => {
            progressBar.style.width = progressBar.getAttribute('style').match(/width: (\d+)%/)[1] + '%';
        }, 300);
    }
});
</script>
@endpush