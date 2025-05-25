@extends('layouts.teacher')

@push('styles')
<style>
    .lessons-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2d3748;
        position: relative;
    }
    .page-title:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 4px;
        background: #4f46e5;
        border-radius: 2px;
    }
    .new-lesson-btn {
        background: #4f46e5;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .new-lesson-btn:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .lesson-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .lesson-table thead th {
        background: #f8fafc;
        color: #4a5568;
        font-weight: 600;
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }
    .lesson-table tbody tr {
        transition: all 0.2s ease;
    }
    .lesson-table tbody tr:hover {
        background: #f8fafc;
    }
    .lesson-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }
    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }
    .edit-btn {
        background: #ebf8ff;
        color: #3182ce;
    }
    .edit-btn:hover {
        background: #bee3f8;
    }
    .delete-btn {
        background: #fff5f5;
        color: #e53e3e;
    }
    .delete-btn:hover {
        background: #fed7d7;
    }
    .duration-badge {
        background: #f0fff4;
        color: #38a169;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    .order-badge {
        background: #ebf8ff;
        color: #3182ce;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    .empty-state {
        padding: 3rem;
        text-align: center;
    }
    .empty-icon {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="page-header">
        <h1 class="page-title">Leçons pour {{ $course->title }}</h1>
        <a href="{{ route('teacher.lessons.create', $course) }}" class="new-lesson-btn">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouvelle leçon
        </a>
    </div>

    <div class="lessons-container">
        @if($lessons->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 mb-2">Aucune leçon trouvée</h3>
            <p class="text-gray-500 mb-4">Commencez par créer votre première leçon</p>
            <a href="{{ route('teacher.lessons.create', $course) }}" class="new-lesson-btn inline-flex">
                <i class="fas fa-plus mr-2"></i>
                Créer une leçon
            </a>
        </div>
        @else
        <table class="lesson-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Durée</th>
                    <th>Ordre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                <tr class="lesson-row" data-lesson-id="{{ $lesson->id }}">
                    <td class="font-medium text-gray-800">{{ $lesson->title }}</td>
                    <td>
                        <span class="duration-badge">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $lesson->duration }} min
                        </span>
                    </td>
                    <td>
                        <span class="order-badge">{{ $lesson->order }}</span>
                    </td>
                    <td class="flex space-x-2">
                        <a href="{{ route('teacher.lessons.edit', [$course, $lesson]) }}" 
                           class="action-btn edit-btn">
                            <i class="fas fa-edit mr-1"></i>
                            Éditer
                        </a>
                        <form action="{{ route('teacher.lessons.destroy', [$course, $lesson]) }}" 
                              method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <i class="fas fa-trash mr-1"></i>
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression avec SweetAlert
    const deleteForms = document.querySelectorAll('.delete-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const lessonTitle = this.closest('.lesson-row').querySelector('td').textContent;
            
            Swal.fire({
                title: 'Confirmer la suppression',
                html: `Êtes-vous sûr de vouloir supprimer la leçon <strong>"${lessonTitle}"</strong> ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    // Animation des lignes du tableau
    const lessonRows = document.querySelectorAll('.lesson-row');
    lessonRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        row.style.transition = 'all 0.4s ease';
        row.style.transitionDelay = `${index * 0.05}s`;
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 50);
    });

    // Drag and drop pour réorganiser (optionnel)
    // Vous pouvez implémenter cette fonctionnalité avec une librairie comme SortableJS
});
</script>
@endpush