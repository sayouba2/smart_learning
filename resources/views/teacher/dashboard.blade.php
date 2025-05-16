@extends('layouts.teacher')

@section('content')
<div class="teacher-dashboard">
    <!-- Header avec bienvenue et stats -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1>Bonjour, {{ auth()->user()->name }}!</h1>
            <p class="subtitle">Voici votre tableau de bord d'enseignant</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ $stats['total_courses'] }}</span>
                        <span class="stat-label">Cours créés</span>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ ($stats['total_courses']/max($stats['total_courses'], 10))*100 }}%"></div>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ $stats['total_students'] }}</span>
                        <span class="stat-label">Étudiants</span>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ ($stats['total_students']/max($stats['total_students'], 50))*100 }}%"></div>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ $stats['free_courses'] }}</span>
                        <span class="stat-label">Cours gratuits</span>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ ($stats['free_courses']/max($stats['total_courses'], 1))*100 }}%"></div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">{{ $stats['avg_rating'] ?? '4.5' }}</span>
                        <span class="stat-label">Note moyenne</span>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ (($stats['avg_rating'] ?? 4.5)/5)*100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="dashboard-main">
        <!-- Section Cours -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2><i class="fas fa-book me-2"></i> Mes Cours</h2>
                <a href="{{ route('teacher.courses.create') }}" class="btn-create">
                    <i class="fas fa-plus"></i> Nouveau cours
                </a>
            </div>

            <div class="courses-grid">
                @foreach($courses as $course)
                <div class="course-card">
                    <div class="course-header">
                        <span class="course-badge {{ $course->is_free ? 'free' : 'premium' }}">
                            {{ $course->is_free ? 'Gratuit' : 'Payant' }}
                        </span>
                        <img src="{{ $course->image_url ?? 'https://source.unsplash.com/random/300x200?education&sig='.$loop->index }}" alt="{{ $course->title }}" class="course-image">
                    </div>
                    <div class="course-body">
                        <h3 class="course-title">{{ $course->title }}</h3>
                        <p class="course-category">
                            <i class="fas fa-tag"></i> {{ $course->category->name }}
                        </p>
                        <div class="course-meta">
                            <span class="meta-item">
                                <i class="fas fa-users"></i> {{ $course->students_count }} étudiants
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-star"></i> {{ $course->average_rating ?? '4.5' }}/5
                            </span>
                        </div>
                    </div>
                    <div class="course-footer">
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn-action view">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('teacher.courses.edit', $course) }}" class="btn-action edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action delete" onclick="return confirm('Supprimer ce cours?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Section Statistiques -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2><i class="fas fa-chart-line me-2"></i> Statistiques</h2>
            </div>
            <div class="stats-container">
                <div class="chart-container">
                    @livewire('teacher-course-stats')
                </div>
                <div class="chart-container">
                    @livewire('student-stats')
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Modal -->
    <div id="quickActionsModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #e0e7ff;
    --secondary-color: #3f37c9;
    --success-color: #10b981;
    --success-light: #d1fae5;
    --info-color: #3b82f6;
    --info-light: #dbeafe;
    --warning-color: #f59e0b;
    --warning-light: #fef3c7;
    --danger-color: #ef4444;
    --danger-light: #fee2e2;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --border-color: #e2e8f0;
}

/* Base Styles */
.teacher-dashboard {
    padding: 2rem;
    max-width: 1800px;
    margin: 0 auto;
    color: var(--dark-color);
}

.dashboard-header {
    margin-bottom: 3rem;
}

.welcome-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--dark-color);
}

.welcome-section .subtitle {
    font-size: 1.1rem;
    color: var(--gray-color);
    margin-bottom: 2rem;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.stat-card.primary {
    border-left: 4px solid var(--primary-color);
}

.stat-card.success {
    border-left: 4px solid var(--success-color);
}

.stat-card.info {
    border-left: 4px solid var(--info-color);
}

.stat-card.warning {
    border-left: 4px solid var(--warning-color);
}

.stat-content {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.25rem;
}

.stat-card.primary .stat-icon {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.stat-card.success .stat-icon {
    background-color: var(--success-light);
    color: var(--success-color);
}

.stat-card.info .stat-icon {
    background-color: var(--info-light);
    color: var(--info-color);
}

.stat-card.warning .stat-icon {
    background-color: var(--warning-light);
    color: var(--warning-color);
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--gray-color);
}

.stat-progress {
    height: 4px;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background-color: currentColor;
    transition: width 1s ease;
}

.stat-card.primary .progress-bar {
    background-color: var(--primary-color);
}

.stat-card.success .progress-bar {
    background-color: var(--success-color);
}

.stat-card.info .progress-bar {
    background-color: var(--info-color);
}

.stat-card.warning .progress-bar {
    background-color: var(--warning-color);
}

/* Dashboard Sections */
.dashboard-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.section-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.section-header h2 i {
    margin-right: 0.5rem;
}

.btn-create {
    background-color: var(--primary-color);
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-create:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    color: white;
}

.btn-create i {
    margin-right: 0.5rem;
}

/* Courses Grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.course-card {
    border: 1px solid var(--border-color);
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.course-header {
    position: relative;
}

.course-image {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

.course-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 1;
}

.course-badge.free {
    background-color: var(--success-color);
    color: white;
}

.course-badge.premium {
    background-color: var(--warning-color);
    color: white;
}

.course-body {
    padding: 1.25rem;
    flex-grow: 1;
}

.course-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.course-category {
    font-size: 0.85rem;
    color: var(--gray-color);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.course-category i {
    margin-right: 0.5rem;
}

.course-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    margin-top: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    color: var(--gray-color);
}

.meta-item i {
    margin-right: 0.25rem;
    color: var(--primary-color);
}

.course-footer {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    background-color: var(--light-color);
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.5rem;
    transition: all 0.2s ease;
}

.btn-action.view {
    background-color: var(--info-light);
    color: var(--info-color);
}

.btn-action.edit {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.btn-action.delete {
    background-color: var(--danger-light);
    color: var(--danger-color);
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.delete-form {
    margin: 0;
}

/* Charts Container */
.stats-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

.chart-container {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    transition: opacity 0.3s ease;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 2rem;
    border-radius: 12px;
    width: 90%;
    max-width: 800px;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    animation: fadeIn 0.3s ease-out;
}

.close-modal {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    font-size: 1.5rem;
    color: var(--gray-color);
    cursor: pointer;
    transition: color 0.2s ease;
}

.close-modal:hover {
    color: var(--dark-color);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .teacher-dashboard {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-create {
        margin-top: 1rem;
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes stats au chargement
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in');
    });

    // Animation des cartes de cours
    const courseCards = document.querySelectorAll('.course-card');
    courseCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
        card.classList.add('animate-fade-in');
    });

    // Gestion du hover sur les boutons d'action
    const actionButtons = document.querySelectorAll('.btn-action');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'translateY(-2px)';
            button.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
        
        button.addEventListener('mouseleave', () => {
            if (!button.classList.contains('active')) {
                button.style.transform = '';
                button.style.boxShadow = '';
            }
        });
    });

    // Confirmation avant suppression
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce cours ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });

    // Quick Actions Modal (exemple)
    const quickActionsModal = document.getElementById('quickActionsModal');
    const closeModal = document.querySelector('.close-modal');
    
    // Ouvrir le modal (exemple)
    function openQuickActions() {
        quickActionsModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    
    // Fermer le modal
    closeModal.addEventListener('click', () => {
        quickActionsModal.style.display = 'none';
        document.body.style.overflow = '';
    });
    
    window.addEventListener('click', (e) => {
        if (e.target === quickActionsModal) {
            quickActionsModal.style.display = 'none';
            document.body.style.overflow = '';
        }
    });

    // Simuler le chargement des barres de progression
    setTimeout(() => {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            bar.style.width = bar.style.width; // Déclenche la transition
        });
    }, 500);
});
</script>
@endsection