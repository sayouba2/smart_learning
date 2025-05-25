@extends('layouts.student')

@section('content')
<div class="course-container">
    <!-- Hero Section with Gradient Background -->
    <div class="course-hero">
        <div class="hero-content">
            <div class="course-badges">
                <span class="badge category-badge pulse">{{ $course->category->name }}</span>
                <span class="badge duration-badge">{{ $course->duration }} heures</span>
            </div>
            
            <h1 class="course-title">{{ $course->title }}</h1>
            <p class="course-description">{{ $course->description }}</p>
            
            <div class="course-meta">
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <span>Formateur: {{ $course->teacher->name }}</span>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span>{{ $enrollmentCount }} inscrits</span>
                </div>
                <div class="meta-item">
                    <div class="meta-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <span>Niveau: {{ $course->level }}</span>
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
                            
                            
                                
                            
                        </div>
                    @else
                        <form action="{{ route('enroll', $course) }}" method="POST" class="enroll-form">
                            @csrf
                            <button type="submit" class="btn enroll-btn pulse-hover">
                                <i class="fas fa-bookmark"></i> S'inscrire ({{ $course->priceText() }})
                            </button>
                        </form>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="btn login-btn pulse-hover">
                    <i class="fas fa-sign-in-alt"></i> Connectez-vous pour vous inscrire
                </a>
            @endauth
        </div>
        
        
    </div>

    <!-- Course Content Grid -->
    <div class="course-content-grid">
        <!-- Lessons Section -->
        <div class="lessons-section">
            <div class="section-header">
                <h2><i class="fas fa-list-ol"></i> Programme du cours</h2>
                <p>{{ $course->lessons->count() }} leçons disponibles</p>
            </div>
            
            <div class="lessons-list">
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
                                <span>{{ $isLessonCompleted ? 'Terminé' : 'Marquer' }}</span>
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
        
        <!-- Sidebar Section -->
        <div class="sidebar-section">
            <!-- Resources Card -->
            <div class="sidebar-card">
                <div class="card-header">
                    <h3><i class="fas fa-file-alt"></i> Ressources</h3>
                </div>
                <div class="card-content">
                    @foreach($course->resources as $resource)
                    <a href="{{ $resource->url }}" target="_blank" class="resource-item">
                        <div class="resource-icon">
                            <i class="fas {{ $resource->icon }}"></i>
                        </div>
                        <span>{{ $resource->name }}</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Course Details Card -->
            <div class="sidebar-card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle"></i> Détails du cours</h3>
                </div>
                <div class="card-content">
                    <div class="detail-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Créé le {{ $course->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Durée: {{ $course->duration }} heures</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-layer-group"></i>
                        <span>Niveau: {{ $course->level }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-certificate"></i>
                        <span>Certificat: {{ $course->has_certificate ? 'Inclus' : 'Non inclus' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Completion Modal -->
<div class="modal-overlay" id="completion-modal">
    <div class="modal-content">
        <div class="confetti-container">
            @for($i = 0; $i < 50; $i++)
            <div class="confetti"></div>
            @endfor
        </div>
        <div class="modal-body">
            <i class="fas fa-trophy"></i>
            <h2>Félicitations !</h2>
            <p>Vous avez terminé le cours <strong>{{ $course->title }}</strong></p>
     @if($course->has_certificate)
<form action="{{ route('student.certificate.generate', $course->id) }}" method="GET"  class="certificate-form">
    @csrf
    <button type="submit" class="btn download-certificate">
        <i class="fas fa-download"></i> Télécharger le certificat
    </button>
</form>
@endif
           
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Base Variables */
    :root {
        --primary: #4361ee;
        --primary-dark: #3a0ca3;
        --secondary: #4cc9f0;
        --success: #4bb543;
        --warning: #ff9500;
        --danger: #f72585;
        --dark: #2b2d42;
        --light: #f8f9fa;
        --gray: #8d99ae;
    }
    
    /* Base Styles */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
        background-color: #f5f7fa;
        line-height: 1.6;
    }
    
    .course-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Hero Section */
    .course-hero {
        display: flex;
        gap: 40px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        border-radius: 16px;
        padding: 50px;
        margin: 30px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    .course-hero::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, rgba(67, 97, 238, 0) 70%);
        border-radius: 50%;
    }
    
    .hero-content {
        flex: 2;
        position: relative;
        z-index: 2;
    }
    
    .hero-progress {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .course-badges {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .category-badge {
        background-color: var(--primary);
        color: white;
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(67, 97, 238, 0); }
        100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
    }
    
    .duration-badge {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary);
        border: 1px solid rgba(67, 97, 238, 0.2);
    }
    
    .course-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--dark);
        line-height: 1.2;
    }
    
    .course-description {
        font-size: 1.1rem;
        color: var(--gray);
        margin-bottom: 25px;
    }
    
    .course-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
    }
    
    .meta-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }
    
    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }
    
    .enroll-btn {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .enroll-btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
    }
    
    .pulse-hover:hover {
        animation: pulse 1s infinite;
    }
    
    .complete-btn {
        background-color: var(--warning);
        color: white;
    }
    
    .complete-btn:hover {
        background-color: #e68a00;
        transform: translateY(-2px);
    }
    
    .login-btn {
        background-color: var(--primary);
        color: white;
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
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .enrolled {
        background-color: rgba(75, 181, 67, 0.1);
        color: var(--success);
    }
    
    .completed {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary);
    }
    
    /* Progress Card */
    .progress-card {
        background: white;
        padding: 25px;
        border-radius: 16px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .progress-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }
    
    .progress-card h3 {
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.2rem;
        color: var(--dark);
    }
    
    .progress-track {
        height: 10px;
        background-color: rgba(67, 97, 238, 0.1);
        border-radius: 5px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 5px;
        transition: width 0.6s ease;
        position: relative;
    }
    
    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, 
                    rgba(255,255,255,0.3) 0%, 
                    rgba(255,255,255,0) 50%, 
                    rgba(255,255,255,0.3) 100%);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .progress-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
    }
    
    .progress-stats {
        margin-top: 15px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: var(--gray);
    }
    
    /* Course Content Grid */
    .course-content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 50px;
    }
    
    /* Lessons Section */
    .lessons-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    
    .section-header {
        margin-bottom: 25px;
    }
    
    .section-header h2 {
        font-size: 1.5rem;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--dark);
    }
    
    .section-header p {
        color: var(--gray);
        font-size: 0.9rem;
    }
    
    .lessons-list {
        display: grid;
        gap: 15px;
    }
    
    .lesson-card {
        display: flex;
        align-items: center;
        gap: 20px;
        background-color: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .lesson-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border-color: rgba(67, 97, 238, 0.2);
    }
    
    .lesson-number {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary);
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
        color: var(--dark);
    }
    
    .lesson-content p {
        font-size: 0.9rem;
        color: var(--gray);
        margin-bottom: 0;
    }
    
    .lesson-status {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        background-color: rgba(0, 0, 0, 0.03);
        color: var(--gray);
    }
    
    .lesson-status.completed {
        background-color: rgba(75, 181, 67, 0.1);
        color: var(--success);
    }
    
    .lesson-status.locked {
        background-color: transparent;
        color: var(--gray);
        cursor: not-allowed;
    }
    
    /* Sidebar */
    .sidebar-section {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    .sidebar-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .card-header {
        padding: 20px;
        background-color: var(--light);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .card-header h3 {
        font-size: 1.2rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--dark);
    }
    
    .card-content {
        padding: 20px;
    }
    
    .resource-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
        text-decoration: none;
        color: var(--dark);
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .resource-item:last-child {
        border-bottom: none;
    }
    
    .resource-item:hover {
        color: var(--primary);
        transform: translateX(5px);
    }
    
    .resource-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-item i {
        width: 20px;
        color: var(--primary);
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        position: relative;
        background: white;
        border-radius: 16px;
        padding: 40px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }
    
    .confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 16px;
    }
    
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: var(--primary);
        opacity: 0;
    }
    
    .modal-body i {
        font-size: 4rem;
        color: var(--warning);
        margin-bottom: 20px;
    }
    
    .modal-body h2 {
        font-size: 2rem;
        margin-bottom: 15px;
        color: var(--dark);
    }
    
    .modal-body p {
        margin-bottom: 25px;
        color: var(--gray);
    }
    
    .download-certificate {
        background-color: var(--success);
        color: white;
        margin-bottom: 15px;
    }
    
    .close-modal {
        background-color: var(--primary);
        color: white;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .course-hero {
            flex-direction: column;
        }
        
        .hero-progress {
            justify-content: flex-start;
        }
    }
    
    @media (max-width: 992px) {
        .course-content-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .course-hero {
            padding: 30px;
        }
        
        .course-title {
            font-size: 2rem;
        }
        
        .enrollment-status {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation on load
    gsap.from('.course-hero', {
        duration: 0.8,
        y: 50,
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
    
    function downloadCertificate(url) {
    const statusEl = document.getElementById('download-status');
    statusEl.style.display = 'block';
    statusEl.innerHTML = 'Préparation du téléchargement...';
    
    // Solution 1: Ouverture dans un nouvel onglet
    window.open(url, '_blank');
    
    // Solution 2: Téléchargement via fetch (pour les PDF)
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.blob();
        })
        .then(blob => {
            const blobUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = blobUrl;
            a.download = 'certificat-{{ $course->slug }}.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(blobUrl);
            statusEl.innerHTML = 'Téléchargement réussi!';
        })
        .catch(error => {
            console.error('Erreur:', error);
            statusEl.innerHTML = 'Erreur: ' + error.message;
        })
        .finally(() => {
            setTimeout(() => statusEl.style.display = 'none', 3000);
        });
}

    document.querySelectorAll('.download-certificate').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('href');
        
        // Crée un iframe invisible pour forcer le téléchargement
        const iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        iframe.src = url;
        document.body.appendChild(iframe);
        
        // Optionnel: Retire l'iframe après 5 secondes
        setTimeout(() => {
            iframe.remove();
        }, 5000);
    });
});


    // Lesson completion toggle
    document.querySelectorAll('.toggle-lesson-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('.lesson-status');
            const isCompleted = button.classList.contains('completed');
            
            // Simulate API call
            setTimeout(() => {
                if (isCompleted) {
                    button.classList.remove('completed');
                    button.innerHTML = '<i class="fas fa-circle"></i> <span>Marquer</span>';
                } else {
                    button.classList.add('completed');
                    button.innerHTML = '<i class="fas fa-check-circle"></i> <span>Terminé</span>';
                    
                    // Animation
                    gsap.to(button, {
                        scale: 1.2,
                        duration: 0.3,
                        yoyo: true,
                        repeat: 1
                    });
                }
                
                // Update progress
                updateProgress();
            }, 300);
        });
    });
    
    // Course completion
    const completeForm = document.querySelector('.complete-course-form');
    if (completeForm) {
        completeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading
            const button = this.querySelector('button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
            button.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Update progress to 100%
                document.querySelector('.progress-bar').style.width = '100%';
                document.querySelector('.progress-value').textContent = '100% complété';
                
                // Show completion modal
                showCompletionModal();
                
                // Replace form with completed badge
                const badge = `
                    <div class="status-badge completed">
                        <i class="fas fa-medal"></i>
                        <span>Terminé le ${new Date().toLocaleDateString('fr-FR')}</span>
                    </div>
                `;
                completeForm.parentNode.innerHTML = badge;
            }, 1000);
        });
    }
    
    // Update progress function
    function updateProgress() {
        const totalLessons = document.querySelectorAll('.lesson-card').length;
        const completedLessons = document.querySelectorAll('.lesson-status.completed').length;
        const progress = Math.round((completedLessons / totalLessons) * 100);
        
        gsap.to('.progress-bar', {
            width: `${progress}%`,
            duration: 0.8,
            ease: "power2.out",
            onUpdate: function() {
                document.querySelector('.progress-value').textContent = 
                    `${Math.round(this.targets()[0].style.width)}% complété`;
            }
        });
    }
    
    // Show completion modal
    function showCompletionModal() {
        const modal = document.getElementById('completion-modal');
        modal.classList.add('active');
        
        // Animate confetti
        const confetti = document.querySelectorAll('.confetti');
        confetti.forEach((piece, i) => {
            gsap.set(piece, {
                x: Math.random() * window.innerWidth,
                y: -50,
                backgroundColor: getRandomColor(),
                rotation: Math.random() * 360
            });
            
            gsap.to(piece, {
                y: window.innerHeight + 50,
                opacity: 1,
                duration: 2 + Math.random() * 3,
                delay: i * 0.02,
                ease: "power1.out"
            });
        });
        
        // Close modal
        document.querySelector('.close-modal').addEventListener('click', function() {
            modal.classList.remove('active');
        });
    }
    
    // Helper function for random colors
    function getRandomColor() {
        const colors = ['#4361ee', '#3a0ca3', '#4cc9f0', '#4895ef', '#f72585', '#4bb543'];
        return colors[Math.floor(Math.random() * colors.length)];
    }
});
</script>
@endpush