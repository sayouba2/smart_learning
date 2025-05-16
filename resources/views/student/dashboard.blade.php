@extends('layouts.student')

@section('content')
<div class="student-dashboard">
    <!-- Header avec bienvenue -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1>Bonjour, {{ auth()->user()->name }}!</h1>
            <p class="subtitle">Voici votre tableau de bord étudiant</p>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="dashboard-main">
        <!-- Section Certificats -->
        <div class="certificates-section">
            <div class="section-header">
                <h2><i class="fas fa-medal me-2"></i> Mes Certificats</h2>
                <span class="badge">{{ count($certificates) }}</span>
            </div>

            @if(count($certificates) > 0)
            <div class="certificates-grid">
                @foreach($certificates as $certificate)
                <div class="certificate-card">
                    <div class="certificate-ribbon">
                        <i class="fas fa-award"></i> Certificat de Réussite
                    </div>
                    <div class="certificate-body">
                        <div class="certificate-logo">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="course-name">{{ $certificate['course_name'] }}</h3>
                        <p class="student-name">Décerné à <strong>{{ auth()->user()->name }}</strong></p>
                        <div class="certificate-meta">
                            <div class="meta-item">
                                <i class="fas fa-user-tie"></i>
                                <span>Enseignant: {{ $certificate['teacher_name'] }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Date: {{ $certificate['completed_at'] ?? 'Non spécifiée' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="certificate-footer">
                        <a href="#" class="download-btn">
                            <i class="fas fa-file-pdf"></i> Télécharger
                        </a>
                        <a href="#" class="share-btn">
                            <i class="fas fa-share-alt"></i> Partager
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-file-pdf"></i>
                <p>Aucun certificat disponible</p>
                <small>Les certificats apparaissent ici après avoir terminé un cours</small>
            </div>
            @endif
        </div>

        <!-- Section Cours -->
        <div class="courses-section">
            <!-- Cours en progression -->
            <div class="courses-subsection">
                <div class="subsection-header">
                    <h3><i class="fas fa-book-reader me-2"></i> Mes Cours en Progrès</h3>
                </div>

                @if(count($inProgressCourses) > 0)
                <div class="horizontal-scroll">
                    <div class="courses-horizontal">
                        @foreach($inProgressCourses as $course)
                        <div class="course-card progress">
                            <div class="course-image-container">
                                <img src="{{ $course->image_url ?? 'https://source.unsplash.com/random/300x200?education&sig='.$loop->index }}" 
                                     alt="{{ $course->title }}" class="course-image">
                                <div class="progress-overlay">
                                    <div class="progress-circle" data-progress="{{ rand(30, 90) }}">
                                        <span class="progress-value">{{ rand(30, 90) }}%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course-body">
                                <h4 class="course-title">{{ $course->title }}</h4>
                                <p class="course-teacher">
                                    <i class="fas fa-user-tie"></i> {{ $course->teacher->name }}
                                </p>
                                <p class="course-date">
                                    <i class="fas fa-calendar-alt"></i> Inscrit le: {{ $course->pivot->created_at }}
                                </p>
                            </div>
                            <div class="course-actions">
                                <a href="{{ route('student.courses.show', $course) }}" class="action-btn view">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <form action="{{ route('student.courses.complete', $course) }}" method="POST">
                                    @csrf
                                    
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <p>Aucun cours en progression</p>
                    <a href="{{ route('student.courses.available') }}" class="browse-btn">
                        <i class="fas fa-plus"></i> Parcourir les cours
                    </a>
                </div>
                @endif
            </div>

            <!-- Cours terminés -->
            <div class="courses-subsection">
                <div class="subsection-header">
                    <h3><i class="fas fa-check-circle me-2"></i> Mes Cours Terminés</h3>
                </div>

                @if(count($completedCourses) > 0)
                <div class="horizontal-scroll">
                    <div class="courses-horizontal">
                        @foreach($completedCourses as $course)
                        <div class="course-card completed">
                            <div class="course-image-container">
                                <img src="{{ $course->image_url ?? 'https://source.unsplash.com/random/300x200?education&sig='.$loop->index }}" 
                                     alt="{{ $course->title }}" class="course-image">
                                <div class="completed-badge">
                                    <i class="fas fa-check"></i> Terminé
                                </div>
                            </div>
                            <div class="course-body">
                                <h4 class="course-title">{{ $course->title }}</h4>
                                <p class="course-teacher">
                                    <i class="fas fa-user-tie"></i> {{ $course->teacher->name }}
                                </p>
                                <p class="course-date">
                                    <i class="fas fa-calendar-check"></i> 
                                    Terminé le: {{ $course->pivot->completed_at ? $course->pivot->completed_at : 'En validation' }}
                                </p>
                            </div>
                            <div class="course-actions">
                                <a href="{{ route('student.courses.show', $course) }}" class="action-btn view">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                @if($course->pivot->completed_at)
                                <a href="#" class="action-btn download">
                                    <i class="fas fa-download"></i> Certificat
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-graduation-cap"></i>
                    <p>Aucun cours terminé</p>
                </div>
                @endif
            </div>
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
.student-dashboard {
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

/* Layout */
.dashboard-main {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
}

@media (max-width: 1200px) {
    .dashboard-main {
        grid-template-columns: 1fr;
    }
}

/* Sections */
.certificates-section, .courses-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.section-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.section-header h2 i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.section-header .badge {
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    margin-left: 0.75rem;
}

/* Certificats */
.certificates-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.certificate-card {
    border: 1px solid var(--border-color);
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.certificate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.certificate-ribbon {
    background-color: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
}

.certificate-ribbon i {
    margin-right: 0.5rem;
}

.certificate-body {
    padding: 1.5rem;
    text-align: center;
}

.certificate-logo {
    width: 60px;
    height: 60px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.course-name {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.student-name {
    color: var(--gray-color);
    margin-bottom: 1.5rem;
}

.certificate-meta {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--gray-color);
}

.meta-item i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.certificate-footer {
    display: flex;
    border-top: 1px solid var(--border-color);
}

.download-btn, .share-btn {
    flex: 1;
    padding: 0.75rem;
    text-align: center;
    font-weight: 500;
    transition: all 0.2s ease;
}

.download-btn {
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-right: 1px solid var(--border-color);
}

.share-btn {
    background-color: var(--success-light);
    color: var(--success-color);
}

.download-btn:hover {
    background-color: var(--primary-color);
    color: white;
}

.share-btn:hover {
    background-color: var(--success-color);
    color: white;
}

/* Cours */
.courses-subsection {
    margin-bottom: 2rem;
}

.subsection-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.subsection-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.subsection-header h3 i {
    margin-right: 0.5rem;
    color: var(--primary-color);
}

.horizontal-scroll {
    overflow-x: auto;
    padding-bottom: 1rem;
    scrollbar-width: thin;
}

.horizontal-scroll::-webkit-scrollbar {
    height: 6px;
}

.horizontal-scroll::-webkit-scrollbar-thumb {
    background-color: var(--gray-color);
    border-radius: 3px;
}

.courses-horizontal {
    display: inline-flex;
    gap: 1.5rem;
    padding: 0.5rem;
}

.course-card {
    min-width: 280px;
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

.course-image-container {
    position: relative;
    height: 160px;
}

.course-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.progress-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: conic-gradient(var(--primary-color) var(--progress), rgba(255, 255, 255, 0.3) var(--progress));
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress-value {
    background-color: white;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: var(--dark-color);
}

.completed-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background-color: var(--success-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.completed-badge i {
    margin-right: 0.25rem;
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

.course-teacher, .course-date {
    font-size: 0.85rem;
    color: var(--gray-color);
    display: flex;
    align-items: center;
    margin-bottom: 0.25rem;
}

.course-teacher i, .course-date i {
    margin-right: 0.5rem;
}

.course-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem;
}

.action-btn {
    flex: 1;
    padding: 0.5rem;
    font-size: 0.85rem;
    font-weight: 500;
    border-radius: 6px;
    text-align: center;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn i {
    margin-right: 0.25rem;
}

.action-btn.view {
    background-color: var(--primary-light);
    color: var(--primary-color);
    margin-right: 0.5rem;
}

.action-btn.complete {
    background-color: var(--success-light);
    color: var(--success-color);
}

.action-btn.download {
    background-color: var(--info-light);
    color: var(--info-color);
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    color: white;
}

.action-btn.view:hover {
    background-color: var(--primary-color);
}

.action-btn.complete:hover {
    background-color: var(--success-color);
}

.action-btn.download:hover {
    background-color: var(--info-color);
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 2rem;
    border: 1px dashed var(--border-color);
    border-radius: 10px;
    color: var(--gray-color);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--border-color);
}

.empty-state p {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.empty-state small {
    font-size: 0.9rem;
    display: block;
    margin-bottom: 1rem;
}

.browse-btn {
    background-color: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}

.browse-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    color: white;
}

.browse-btn i {
    margin-right: 0.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .student-dashboard {
        padding: 1rem;
    }
    
    .welcome-section h1 {
        font-size: 2rem;
    }
    
    .section-header h2 {
        font-size: 1.25rem;
    }
    
    .subsection-header h3 {
        font-size: 1.1rem;
    }
    
    .course-card {
        min-width: 260px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cercles de progression
    const progressCircles = document.querySelectorAll('.progress-circle');
    progressCircles.forEach(circle => {
        const progress = circle.getAttribute('data-progress');
        circle.style.setProperty('--progress', `${progress}%`);
    });

    // Confirmation avant de marquer un cours comme terminé
    const completeForms = document.querySelectorAll('form[action*="complete"]');
    completeForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr d\'avoir terminé ce cours ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });

    // Animation au survol des cartes
    const cards = document.querySelectorAll('.certificate-card, .course-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 10px 15px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.boxShadow = '';
        });
    });

    // Animation des boutons
    const buttons = document.querySelectorAll('.action-btn, .download-btn, .share-btn, .browse-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.transform = '';
        });
    });

    // Détection du scroll horizontal pour afficher l'ombre
    const horizontalScrolls = document.querySelectorAll('.horizontal-scroll');
    horizontalScrolls.forEach(scroll => {
        scroll.addEventListener('scroll', function() {
            const shadowLeft = this.scrollLeft > 0;
            const shadowRight = this.scrollLeft < (this.scrollWidth - this.clientWidth);
            
            if (shadowLeft && shadowRight) {
                this.style.boxShadow = 'inset 10px 0 10px -10px rgba(0,0,0,0.1), inset -10px 0 10px -10px rgba(0,0,0,0.1)';
            } else if (shadowLeft) {
                this.style.boxShadow = 'inset 10px 0 10px -10px rgba(0,0,0,0.1)';
            } else if (shadowRight) {
                this.style.boxShadow = 'inset -10px 0 10px -10px rgba(0,0,0,0.1)';
            } else {
                this.style.boxShadow = 'none';
            }
        });
    });
});
</script>
@endsection