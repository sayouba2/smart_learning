@extends('layouts.student')

@section('content')
<div class="container student-dashboard py-4">
    <div class="row mb-4">
        <!-- Cours en progression -->
        <div class="col-md-6">
            <div class="card course-card in-progress-card">
                <div class="card-header bg-primary text-white">
                    <h3><i class="fas fa-book-reader me-2"></i>Mes Cours en Progrès</h3>
                </div>
                <div class="card-body">
                    @forelse($inProgressCourses as $course)
                    <div class="course-item mb-3 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5>{{ $course->title }}</h5>
                                <p class="mb-1"><small>Enseignant : {{ $course->teacher->name }}</small></p>
                                <p class="mb-1"><small>Inscrit le : {{ $course->pivot->created_at }}</small></p>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('student.courses.show', $course) }}" 
                                   class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('student.courses.complete', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" 
                                            title="Marquer comme terminé">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ rand(30, 90) }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <p class="empty-state">Aucun cours en cours de suivi</p>
                        <a href="{{ route('student.courses.available') }}" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> Trouver un cours
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Cours terminés -->
        <div class="col-md-6">
            <div class="card course-card completed-card">
                <div class="card-header bg-success text-white">
                    <h3><i class="fas fa-check-circle me-2"></i>Mes Cours Terminés</h3>
                </div>
                <div class="card-body">
                    @forelse($completedCourses as $course)
                    <div class="course-item mb-3 p-3 border rounded">
                        <h5>{{ $course->title }}</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1"><small>Enseignant : {{ $course->teacher->name }}</small></p>
                                @if($course->pivot->completed_at)
                                <p class="mb-1"><small>Terminé le : {{ $course->pivot->completed_at }}</small></p>
                                @else
                                <p class="mb-1"><small class="text-warning">En attente de validation</small></p>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('student.courses.show', $course) }}" 
                                   class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($course->pivot->completed_at)
                                <a href="#" class="btn btn-sm btn-warning" 
                                   title="Télécharger le certificat">
                                    <i class="fas fa-download"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                        <p class="empty-state">Aucun cours terminé</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Certificats -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card certificate-card">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-medal me-2"></i>Mes Certificats</h3>
                        <span class="badge bg-white text-info">{{ count($certificates) }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($certificates) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="40%">Cours</th>
                                    <th width="25%">Enseignant</th>
                                    <th width="20%">Date d'obtention</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificates as $certificate)
                                <tr>
                                    <td>
                                        <strong>{{ $certificate['course_name'] }}</strong>
                                    </td>
                                    <td>{{ $certificate['teacher_name'] }}</td>
                                    <td>{{ $certificate['completed_at'] ?? 'Date non disponible' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-file-pdf me-1"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-file-pdf fa-3x text-muted mb-3"></i>
                        <p class="empty-state">Aucun certificat disponible</p>
                        <p class="text-muted small">Les certificats apparaissent ici après avoir terminé un cours</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .course-card .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    .course-item {
        transition: transform 0.2s;
    }
    .course-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .empty-state {
        color: #6c757d;
        font-style: italic;
    }
    .certificate-btn {
        transition: all 0.2s;
    }
    .certificate-btn:hover {
        background-color: #0dcaf0;
        color: white !important;
    }
</style>
@endpush
@endsection