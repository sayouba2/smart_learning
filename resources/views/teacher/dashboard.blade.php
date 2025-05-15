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
                                    </a>
                                    <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger action-btn"
                                            onclick="return confirm('Supprimer ce cours ?')">
                                            <i class="fas fa-trash"></i>
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

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --info: #4895ef;
        --warning: #f72585;
        --danger: #e63946;
        --light: #f8f9fa;
        --dark: #212529;
    }
    
    body {
        background-color: #f5f7fa;
    }
    
    .dashboard-container {
        padding: 20px 10px;
    }
    
    /* Stats Cards */
    .stats-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-card .card-body {
        padding: 25px;
    }
    
    .stats-card .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
    }
    
    .stats-card .h2 {
        font-weight: 700;
        margin-bottom: 0;
        font-size: 2.5rem;
    }
    
    .stats-card .icon {
        font-size: 2.5rem;
        opacity: 0.2;
        position: absolute;
        right: 15px;
        bottom: 15px;
    }
    
    /* Table Card */
    .table-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .table-card .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 20px 25px;
    }
    
    .table-card .card-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }
    
    .table-card .btn-primary {
        background-color: var(--primary);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
    }
    
    /* Table Styling */
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        padding: 15px 25px;
    }
    
    .table td {
        padding: 15px 25px;
        vertical-align: middle;
    }
    
    .table a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    
    .table a:hover {
        color: var(--secondary);
    }
    
    /* Badges */
    .badge {
        padding: 8px 12px;
        font-weight: 500;
        border-radius: 6px;
    }
    
    .badge.bg-success {
        background-color: rgba(76, 201, 240, 0.1) !important;
        color: var(--success);
    }
    
    .badge.bg-warning {
        background-color: rgba(247, 37, 133, 0.1) !important;
        color: var(--warning);
    }
    
    /* Action Buttons */
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    
    .btn-outline-danger {
        color: var(--danger);
        border-color: var(--danger);
    }
    
    .btn-outline-danger:hover {
        background-color: var(--danger);
        color: white;
        border-color: var(--danger);
    }
    
    /* Chart Card */
    .chart-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .chart-card .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 20px 25px;
    }
    
    .chart-card .card-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }
    
    .chart-card .card-body {
        padding: 25px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique avec Chart.js
    const ctx = document.getElementById('enrollmentsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($courses->pluck('title')),
            datasets: [{
                label: 'Nombre d\'étudiants',
                data: @json($courses->pluck('students_count')),
                backgroundColor: [
                    'rgba(67, 97, 238, 0.7)',
                    'rgba(76, 201, 240, 0.7)',
                    'rgba(72, 149, 239, 0.7)',
                    'rgba(247, 37, 133, 0.7)'
                ],
                borderColor: [
                    'rgba(67, 97, 238, 1)',
                    'rgba(76, 201, 240, 1)',
                    'rgba(72, 149, 239, 1)',
                    'rgba(247, 37, 133, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection