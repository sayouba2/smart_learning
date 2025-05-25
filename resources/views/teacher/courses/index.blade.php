@extends('layouts.teacher')

@push('styles')
<style>
    .course-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .course-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.08);
    }
    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .course-header {
        padding: 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .course-body {
        padding: 1.25rem;
    }
    .course-footer {
        padding: 1rem 1.25rem;
        background: rgba(0, 0, 0, 0.02);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    .price-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-action i {
        margin-right: 0.5rem;
    }
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(0, 0, 0, 0.02);
        border-radius: 12px;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Mes Cours</h1>
        <a href="{{ route('teacher.courses.create') }}" 
           class="btn-action bg-indigo-600 text-white hover:bg-indigo-700">
            <i class="fas fa-plus"></i>
            Nouveau cours
        </a>
    </div>

    <div class="course-grid">
        @forelse($courses as $course)
        <div class="course-card">
            <div class="course-header">
                <div class="flex justify-between items-start gap-2">
                    <h3 class="font-bold text-lg text-gray-900">{{ $course->title }}</h3>
                    <span class="price-badge {{ $course->is_free ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $course->is_free ? 'Gratuit' : $course->price.'€' }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-chart-line mr-1"></i>
                    Niveau: {{ ucfirst($course->level) }}
                </p>
            </div>
            
            <div class="course-body">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('teacher.courses.edit', $course) }}" 
                       class="btn-action bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </a>
                    
                    <a href="{{ route('teacher.courses.show', $course) }}" 
                       class="btn-action bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-eye"></i>
                        Voir
                    </a>
                </div>
            </div>
            
            <div class="course-footer">
                <div class="flex justify-between items-center">
                    <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="btn-action bg-red-50 text-red-600 hover:bg-red-100"
                                data-course-title="{{ $course->title }}">
                            <i class="fas fa-trash"></i>
                            Supprimer
                        </button>
                    </form>
                    <span class="text-xs text-gray-400">
                        <i class="far fa-calendar mr-1"></i>
                        {{ $course->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-book-open text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Aucun cours trouvé</h3>
            <p class="text-gray-500 mb-4">Commencez par créer votre premier cours</p>
            <a href="{{ route('teacher.courses.create') }}" 
               class="btn-action bg-indigo-600 text-white hover:bg-indigo-700 inline-flex">
                <i class="fas fa-plus"></i>
                Créer un cours
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteForms = document.querySelectorAll('.delete-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            const courseTitle = button.getAttribute('data-course-title');
            
            Swal.fire({
                title: 'Confirmer la suppression',
                html: `Êtes-vous sûr de vouloir supprimer le cours <b>"${courseTitle}"</b> ?`,
                icon: 'question',
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

    // Animation des cartes
    const cards = document.querySelectorAll('.course-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        card.style.transitionDelay = `${index * 0.05}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 10);
    });
});
</script>
@endpush