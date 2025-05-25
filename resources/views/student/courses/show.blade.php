@extends('layouts.student')

@section('content')
<div class="course-container py-4">
    <!-- Hero Section -->
    <div class="course-hero mb-5">
        <div class="hero-content">
            <div class="badge-container">
                <span class="badge category-badge">{{ $course->category->name }}</span>
                <span class="badge duration-badge">{{ $course->duration }} heures</span>
            </div>
            <h1 class="course-title">{{ $course->title }}</h1>
            <p class="course-description">{{ $course->description }}</p>
            
            <div class="course-meta">
                <div class="meta-item">
                    <i class="fas fa-user-tie"></i>
                    <span>{{ $course->teacher->name }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    <span>{{ $enrollment }} inscrits</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-star"></i>
                    <span>{{ $course->level }}</span>
                </div>
            </div>
            
            @auth
                @if(auth()->user()->isStudent())
                    @php
                        $enrollment = $course->enrollments()->where('user_id', auth()->id())->first();
                        $isEnrolled = !is_null($enrollment);
                        $isCompleted = $isEnrolled && !is_null($enrollment->completed_at);
                    @endphp

                    @if($isEnrolled)
                        <div class="enrollment-status">
                            <div class="status-badge enrolled">
                                <i class="fas fa-check-circle"></i>
                                <span>Inscrit</span>
                            </div>
                            
                            @if(!$isCompleted)
                                <form action="{{ route('courses.complete', $course) }}" method="POST" class="complete-course-form">
                                    @csrf
                                    <button type="submit" class="btn complete-btn">
                                        <i class="fas fa-trophy"></i> Terminer le cours
                                    </button>
                                </form>
                            @else
                                <div class="status-badge completed">
                                    <i class="fas fa-medal"></i>
                                    <span>Terminé le {{ $enrollment->completed_at->format('d/m/Y') }}</span>
                                </div>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('enroll', $course) }}" method="POST" class="enroll-form">
                            @csrf
                            <button type="submit" class="btn enroll-btn">
                                <i class="fas fa-bookmark"></i> S'inscrire ({{ $course->priceText() }})
                            </button>
                        </form>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Connectez-vous pour vous inscrire
                </a>
            @endauth
        </div>
        <div class="hero-progress">
            <div class="progress-card">
                <h3>Votre progression</h3>
                <div class="progress-track">
                    <div class="progress-bar" style="width: {{ $progress ?? 0 }}%"></div>
                </div>
                <span class="progress-value">{{ $progress ?? 0 }}% complété</span>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="course-content-grid">
        <!-- Lessons Section -->
        <div class="lessons-section">
            <div class="section-header">
                <h2><i class="fas fa-list-ol"></i> Programme du cours</h2>
                <p>{{ $course->lessons->count() }} leçons disponibles</p>
            </div>
            
            <div class="lessons-grid">
                @foreach($course->lessons as $lesson)
                <div class="lesson-card" data-lesson-id="{{ $lesson->id }}">
                    <div class="lesson-number">{{ $loop->iteration }}</div>
                    <div class="lesson-content">
                        <h3>{{ $lesson->title }}</h3>
                        <p>{{ $lesson->description }}</p>
                    </div>
                    
                    @if($isEnrolled ?? false)
                        @php
                            $isLessonCompleted = $enrollment->completedLessons->contains($lesson->id);
                        @endphp
                        
                        <form action="{{ route('student.lessons.toggle-completion', [$course, $lesson]) }}" method="POST" class="toggle-lesson-form">
                            @csrf
                            <button type="submit" class="lesson-status {{ $isLessonCompleted ? 'completed' : '' }}">
                                <i class="fas {{ $isLessonCompleted ? 'fa-check-circle' : 'fa-circle' }}"></i>
                            </button>
                        </form>
                    @else
                        <div class="lesson-status locked">
                            <i class="fas fa-lock"></i>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Resources Section -->
        <div class="resources-section">
            <div class="section-header">
                <h2><i class="fas fa-file-alt"></i> Ressources</h2>
                <p>Documents complémentaires</p>
            </div>
            
            <div class="resources-grid">
                <!-- Resources will be loaded via AJAX -->
                <div class="resource-card skeleton">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-text"></div>
                </div>
                <div class="resource-card skeleton">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-text"></div>
                </div>
            </div>
            
            <!-- Course Details Card -->
            <div class="details-card">
                <h3><i class="fas fa-info-circle"></i> Détails du cours</h3>
                <ul class="details-list">
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        <span>Créé le {{ $course->created_at->format('d/m/Y') }}</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Durée: {{ $course->duration }} heures</span>
                    </li>
                    <li>
                        <i class="fas fa-layer-group"></i>
                        <span>Niveau: {{ $course->level }}</span>
                    </li>
                    <li>
                        <i class="fas fa-certificate"></i>
                        <span>Certificat: {{ $course->has_certificate ? 'Inclus' : 'Non inclus' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Base Styles */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --accent-color: #4cc9f0;
        --success-color: #4bb543;
        --warning-color: #ff9500;
        --text-color: #2b2d42;
        --light-text: #8d99ae;
        --bg-color: #f8f9fa;
        --card-bg: #ffffff;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
        background-color: var(--bg-color);
    }
    
    .course-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Hero Section */
    .course-hero {
        display: flex;
        gap: 30px;
        background: var(--card-bg);
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .hero-content {
        flex: 2;
    }
    
    .hero-progress {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge-container {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .category-badge {
        background-color: var(--accent-color);
        color: white;
    }
    
    .duration-badge {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
    }
    
    .course-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--text-color);
    }
    
    .course-description {
        font-size: 1.1rem;
        line-height: 1.6;
        color: var(--light-text);
        margin-bottom: 25px;
    }
    
    .course-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }
    
    .meta-item i {
        color: var(--primary-color);
    }
    
    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }
    
    .enroll-btn {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .enroll-btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
    }
    
    .complete-btn {
        background-color: var(--warning-color);
        color: white;
    }
    
    .complete-btn:hover {
        background-color: #e68a00;
        transform: translateY(-2px);
    }
    
    .login-btn {
        background-color: var(--primary-color);
        color: white;
    }
    
    /* Progress Card */
    .progress-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 25px;
        border-radius: 12px;
        width: 100%;
        max-width: 300px;
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
    }
    
    .progress-card h3 {
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }
    
    .progress-track {
        height: 10px;
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background-color: white;
        border-radius: 5px;
        transition: width 0.6s ease;
    }
    
    .progress-value {
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    /* Enrollment Status */
    .enrollment-status {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .enrolled {
        background-color: rgba(75, 181, 67, 0.1);
        color: var(--success-color);
    }
    
    .completed {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
    }
    
    /* Course Content Grid */
    .course-content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
    
    /* Section Header */
    .section-header {
        margin-bottom: 25px;
    }
    
    .section-header h2 {
        font-size: 1.5rem;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-header p {
        color: var(--light-text);
        font-size: 0.9rem;
    }
    
    .progress-bar.completed {
    background-color: var(--success-color);
    box-shadow: 0 0 10px rgba(75, 181, 67, 0.5);
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(75, 181, 67, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(75, 181, 67, 0); }
    100% { box-shadow: 0 0 0 0 rgba(75, 181, 67, 0); }
}

.progress-card.completed {
    animation: pulse 1.5s infinite;
}
    /* Lessons Grid */
    .lessons-grid {
        display: grid;
        gap: 15px;
    }
    
    .lesson-card {
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: var(--card-bg);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .lesson-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .lesson-number {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border-radius: 50%;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .lesson-content {
        flex: 1;
    }
    
    .lesson-content h3 {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .lesson-content p {
        font-size: 0.9rem;
        color: var(--light-text);
        margin-bottom: 0;
    }
    
    .lesson-status {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: none;
        background: none;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .lesson-status i {
        font-size: 1.2rem;
    }
    
    .lesson-status:not(.locked) {
        background-color: rgba(0, 0, 0, 0.05);
        color: var(--light-text);
    }
    
    .lesson-status.completed {
        background-color: rgba(75, 181, 67, 0.1);
        color: var(--success-color);
    }
    
    .lesson-status.locked {
        color: var(--light-text);
        cursor: not-allowed;
    }
    
    /* Resources Section */
    .resources-grid {
        display: grid;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .resource-card {
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: var(--card-bg);
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--text-color);
    }
    
    .resource-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        background-color: var(--primary-color);
        color: white;
    }
    
    .resource-card i {
        font-size: 1.2rem;
        color: var(--primary-color);
    }
    
    .resource-card:hover i {
        color: white;
    }
    
    /* Details Card */
    .details-card {
        background-color: var(--card-bg);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    .details-card h3 {
        font-size: 1.2rem;
        margin-top: 0;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .details-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .details-list li {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .details-list li:last-child {
        border-bottom: none;
    }
    
    .details-list i {
        width: 20px;
        color: var(--primary-color);
    }
    
    /* Skeleton Loading */
    .skeleton {
        background-color: #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .skeleton::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        animation: shimmer 1.5s infinite;
    }
    
    .skeleton-icon {
        width: 24px;
        height: 24px;
        background-color: #d0d0d0;
        border-radius: 50%;
    }
    
    .skeleton-text {
        height: 14px;
        background-color: #d0d0d0;
        border-radius: 7px;
        flex: 1;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .course-hero {
            flex-direction: column;
        }
        
        .hero-progress {
            justify-content: flex-start;
        }
        
        .progress-card {
            max-width: 100%;
        }
        
        .course-content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .course-hero {
            padding: 30px 20px;
        }
        
        .course-title {
            font-size: 1.8rem;
        }
        
        .course-meta {
            flex-wrap: wrap;
        }
        
        .enrollment-status {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Animation au chargement
        gsap.from('.course-hero', { 
            duration: 0.8, 
            y: 30, 
            opacity: 0, 
            ease: "power2.out" 
        });
        
        gsap.from('.lesson-card', { 
            duration: 0.6, 
            y: 20, 
            opacity: 0, 
            stagger: 0.1,
            delay: 0.3,
            ease: "power2.out" 
        });
        
        // Chargement des ressources
        function loadResources() {
            $.get('{{ route('api.course.resources', $course->id) }}', function(data) {
                const container = $('.resources-grid');
                container.empty();
                
                if (data.length > 0) {
                    data.forEach(function(resource) {
                        const card = $(`
                            <a href="${resource.url}" target="_blank" class="resource-card">
                                <i class="fas ${resource.icon}"></i>
                                <span>${resource.name}</span>
                            </a>
                        `);
                        
                        container.append(card);
                        gsap.from(card, { 
                            duration: 0.5, 
                            x: -20, 
                            opacity: 0, 
                            delay: 0.1 
                        });
                    });
                } else {
                    container.append('<p class="no-resources">Aucune ressource disponible</p>');
                }
            }).fail(function() {
                $('.resources-grid').html('<p class="error">Impossible de charger les ressources</p>');
            });
        }
        
        // Gestion de la complétion du cours
$('#complete-course-form').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    const button = form.find('.complete-btn');
    
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        beforeSend: function() {
            button.html('<i class="fas fa-spinner fa-spin"></i> Traitement...');
            button.prop('disabled', true);
        },
        success: function(response) {
            // Animation de la barre de progression
            gsap.to('.progress-bar', {
                width: '100%',
                duration: 1.5,
                ease: "power4.out",
                onUpdate: function() {
                    const progress = Math.round(this.targets()[0].style.width);
                    $('.progress-value').text(progress + '% complété');
                },
                onComplete: function() {
                    // Remplace le formulaire par le badge "Terminé"
                    form.replaceWith(`
                        <div class="status-badge completed">
                            <i class="fas fa-medal"></i>
                            <span>Terminé le ${new Date().toLocaleDateString('fr-FR')}</span>
                        </div>
                    `);
                    
                    // Animation de confirmation
                    gsap.from('.status-badge.completed', {
                        scale: 0.5,
                        opacity: 0,
                        duration: 0.8,
                        ease: "elastic.out(1, 0.5)"
                    });
                }
            });
        },
        error: function(xhr) {
            button.html('<i class="fas fa-trophy"></i> Terminer le cours');
            button.prop('disabled', false);
            showToast('Erreur: ' + xhr.responseJSON.message, 'error');
        }
    });
});
        // Marquage des leçons
        $('.toggle-lesson-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('.lesson-status');
            const card = form.closest('.lesson-card');
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                beforeSend: function() {
                    button.html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function(response) {
                    if (response.completed) {
                        button.removeClass().addClass('lesson-status completed');
                        button.html('<i class="fas fa-check-circle"></i>');
                        card.addClass('lesson-completed');
                        
                        // Animation de confirmation
                        gsap.to(button, {
                            scale: 1.2,
                            duration: 0.3,
                            yoyo: true,
                            repeat: 1
                        });
                    } else {
                        button.removeClass('completed');
                        button.html('<i class="fas fa-circle"></i>');
                        card.removeClass('lesson-completed');
                    }
                    
                    updateCourseProgress();
                },
                error: function(xhr) {
                    button.html('<i class="fas fa-exclamation-circle"></i>');
                    showToast('Erreur: ' + xhr.responseJSON.message, 'error');
                }
            });
        });
        
        // Mise à jour de la progression
        function updateCourseProgress() {
            $.get('{{ route('api.course.progress', $course->id) }}', function(data) {
                gsap.to('.progress-bar', {
                    width: data.progress + '%',
                    duration: 0.8,
                    ease: "power2.out",
                    onUpdate: function() {
                        const progress = Math.round(this.targets()[0].style.width);
                        $('.progress-value').text(progress + '% complété');
                    }
                });
            });
        }
        
        // Inscription au cours
        $('.enroll-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('.enroll-btn');
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                beforeSend: function() {
                    button.html('<i class="fas fa-spinner fa-spin"></i> Traitement...');
                    button.prop('disabled', true);
                },
                success: function(response) {
                    // Animation de succès
                    button.html('<i class="fas fa-check"></i> Inscrit !');
                    button.removeClass('enroll-btn').addClass('enrolled-btn');
                    
                    // Remplacer le formulaire après délai
                    setTimeout(() => {
                        form.replaceWith(`
                            <div class="enrollment-status">
                                <div class="status-badge enrolled">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Inscrit</span>
                                </div>
                                <form action="${response.complete_url}" method="POST" class="complete-course-form">
                                    @csrf
                                    <button type="submit" class="btn complete-btn">
                                        <i class="fas fa-trophy"></i> Terminer le cours
                                    </button>
                                </form>
                            </div>
                        `);
                        
                        // Mise à jour du compteur
                        const countElement = $('.meta-item:nth-child(2) span');
                        const currentCount = parseInt(countElement.text());
                        countElement.text(currentCount + 1);
                        
                        // Recharger les boutons de leçon
                        $('.lesson-status.locked').each(function() {
                            $(this).replaceWith(`
                                <form action="" method="POST" class="toggle-lesson-form">
                                    @csrf
                                    <button type="submit" class="lesson-status">
                                        <i class="fas fa-circle"></i>
                                    </button>
                                </form>
                            `);
                        });
                    }, 1500);
                },
                error: function(xhr) {
                    button.html('<i class="fas fa-bookmark"></i> S\'inscrire');
                    button.prop('disabled', false);
                    showToast('Erreur: ' + xhr.responseJSON.message, 'error');
                }
            });
        });
        
        // Notification toast
        function showToast(message, type = 'success') {
            const toast = $(`
                <div class="toast-notification toast-${type}">
                    ${message}
                </div>
            `);
            
            $('body').append(toast);
            
            gsap.from(toast, {
                y: 30,
                opacity: 0,
                duration: 0.3
            });
            
            setTimeout(() => {
                gsap.to(toast, {
                    y: -30,
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => toast.remove()
                });
            }, 5000);
        }
        
        // Initialisation
        loadResources();
    });
</script>
@endpush