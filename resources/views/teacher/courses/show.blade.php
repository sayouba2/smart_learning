@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $course->title }}</h1>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">
            Modifier le cours
        </a>
    </div>

    <!-- Grille principale -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Colonne 1 : Détails du cours -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Détails du cours</h2>
            <p class="text-gray-600 mb-4">{{ $course->description }}</p>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <span class="block text-sm text-gray-500">Niveau</span>
                    <span class="font-medium">{{ ucfirst($course->level) }}</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Durée</span>
                    <span class="font-medium">{{ $course->duration }} heures</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Prix</span>
                    <span class="font-medium">
                        {{ $course->is_free ? 'Gratuit' : $course->price.' €' }}
                    </span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Catégorie</span>
                    <span class="font-medium">{{ $course->category->name }}</span>
                </div>
            </div>

            <!-- Liste des leçons -->
            <h3 class="font-semibold mb-3">Leçons ({{ $course->lessons->count() }})</h3>
            <div class="space-y-2">
                @foreach($course->lessons->sortBy('order') as $lesson)
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h4 class="font-medium">{{ $lesson->title }}</h4>
                    <p class="text-sm text-gray-600 truncate">{{ $lesson->content }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Colonne 2 : Statistiques et étudiants -->
        <div class="space-y-6">
            <!-- Carte Statistiques -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Statistiques</h2>
                <div class="space-y-4">
                    <div>
                        <span class="block text-sm text-gray-500">Taux de complétion</span>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                            <div class="bg-blue-600 h-2.5 rounded-full" 
                                 style="width: {{ $stats['completion_rate'] }}%"></div>
                        </div>
                        <span class="text-sm font-medium">{{ $stats['completion_rate'] }}%</span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500">Note moyenne</span>
                        <span class="font-medium">{{ $stats['avg_rating'] }}/5</span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500">Étudiants inscrits</span>
                        <span class="font-medium">{{ $stats['enrollments_count'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Liste des étudiants -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Étudiants inscrits</h2>
                <div class="space-y-3">
                    @forelse($course->students as $student)
                    <div class="flex items-center justify-between">
                        <span>{{ $student->name }}</span>
                        @if($student->pivot->completed_at)
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                                Terminé
                            </span>
                        @else
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                En cours
                            </span>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500">Aucun étudiant inscrit</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection