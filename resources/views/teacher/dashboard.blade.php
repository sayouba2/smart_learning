@extends('layouts.teacher')

@section('content')
<div class="container-fluid dashboard-container py-4">
    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stats-card bg-primary text-white">
                <div class="card-body position-relative">
                    <h5 class="card-title">Cours créés</h5>
                    <p class="h2">{{ $stats['total_courses'] }}</p>
                    <i class="fas fa-book icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card bg-success text-white">
                <div class="card-body position-relative">
                    <h5 class="card-title">Étudiants</h5>
                    <p class="h2">{{ $stats['total_students'] }}</p>
                    <i class="fas fa-users icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card bg-info text-white">
                <div class="card-body position-relative">
                    <h5 class="card-title">Cours gratuits</h5>
                    <p class="h2">{{ $stats['free_courses'] }}</p>
                    <i class="fas fa-gift icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des cours avec actions -->
    <div class="card table-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Mes Cours</h3>
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nouveau cours
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Étudiants</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>
                                <a href="{{ route('teacher.courses.show', $course) }}">
                                    {{ $course->title }}
                                </a>
                            </td>
                            <td>{{ $course->category->name }}</td>
                            <td>{{ $course->students_count }}</td>
                            <td>
                                <span class="badge {{ $course->is_free ? 'bg-success' : 'bg-warning' }}">
                                    {{ $course->is_free ? 'Gratuit' : 'Payant' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('teacher.courses.edit', $course) }}" 
                                       class="btn btn-sm btn-outline-primary action-btn">
                                        <i class="fas fa-edit"></i>
                                        editer
                                    </a>
                                    <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger action-btn"
                                            onclick="return confirm('Supprimer ce cours ?')">
                                            <i class="fas fa-trash"></i>
                                            supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Graphique (optionnel) -->
    <div class="container mx-auto py-6 px-4">
        {{-- ... autres sections ... --}}
        
        @livewire('teacher-course-stats')
        @livewire('student-stats')
    
        {{-- ... autres sections ... --}}
    </div>
    
</div>


@endsection