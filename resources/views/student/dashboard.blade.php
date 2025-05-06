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
                        <h5>{{ $course->title }}</h5>
                        <p>Enseignant : {{ $course->teacher->name }}</p>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                            Continuer
                        </a>
                    </div>
                    @empty
                    <p class="empty-state">Aucun cours en cours de suivi</p>
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
                        <p>Terminé le : {{ $course->pivot->completed_at->format('d/m/Y') }}</p>
                    </div>
                    @empty
                    <p class="empty-state">Aucun cours terminé</p>
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
                    <h3><i class="fas fa-medal me-2"></i>Mes Certificats</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom du Cours</th>
                                    <th>Date d'obtention</th>
                                    <th>Certificat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($certificates as $certificate)
                                <tr>
                                    <td>{{ $certificate['course_name'] }}</td>
                                    <td>{{ $certificate['completed_at'] }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary certificate-btn">
                                            <i class="fas fa-file-pdf me-1"></i>{{ $certificate['certificate_id'] }} (PDF)
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center empty-state">Aucun certificat obtenu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --primary-dark: #3a0ca3;
        --success: #4cc9f0;
        --success-light: #90e0ef;
        --success-dark: #0077b6;
        --info: #4895ef;
        --info-light: #a8dadc;
        --info-dark: #457b9d;
        --warning: #f72585;
        --secondary: #6c757d;
        --light: #f8f9fa;
        --dark: #212529;
    }
    
    body {
        background-color: #f5f7fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .student-dashboard {
        padding-top: 20px;
        padding-bottom: 40px;
    }
    
    /* Card Styling */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-3px);
    }
    
    .card-header {
        padding: 18px 25px;
        border-bottom: none;
    }
    
    .card-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
    }
    
    .card-body {
        padding: 25px;
    }
    
    /* Course Item Styling */
    .course-item {
        background-color: white;
        border-radius: 8px;
        border-color: #eaeaea !important;
        transition: all 0.3s;
        position: relative;
    }
    
    .course-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.05);
        border-color: var(--primary-light) !important;
    }
    
    .course-item h5 {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    
    .course-item p {
        color: var(--secondary);
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
    
    /* Button Styling */
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
        border-radius: 6px;
        font-weight: 500;
        padding: 6px 15px;
        transition: all 0.3s;
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
    }
    
    .btn-outline-secondary {
        color: var(--secondary);
        border-color: #dee2e6;
        border-radius: 6px;
        font-weight: 500;
        padding: 6px 15px;
        transition: all 0.3s;
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--secondary);
        color: white;
        border-color: var(--secondary);
    }
    
    /* Certificate Table Styling */
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        border-top: none;
        border-bottom-width: 1px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: var(--secondary);
        padding: 12px 20px;
    }
    
    .table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        border-color: #eaeaea;
    }
    
    .certificate-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Headers Color Customization */
    .in-progress-card .card-header {
        background: linear-gradient(45deg, var(--primary), var(--primary-light)) !important;
    }
    
    .completed-card .card-header {
        background: linear-gradient(45deg, var(--success-dark), var(--success)) !important;
    }
    
    .certificate-card .card-header {
        background: linear-gradient(45deg, var(--info-dark), var(--info)) !important;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        color: #6c757d;
        padding: 20px;
        font-style: italic;
    }
</style>
@endpush
@endsection