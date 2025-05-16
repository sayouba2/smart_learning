@extends('layouts.course')

@section('content')
<div class="courses-container">
    @if (session('success'))
        <div class="alert alert-success animate-fade-in">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger animate-fade-in">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="courses-header">
        <h1 class="page-title">Explorez nos cours</h1>
        <p class="page-subtitle">Développez vos compétences avec nos formations de qualité</p>
    </div>

    <div class="courses-grid" id="coursesGrid">
        @foreach ($courses as $course)
            <div class="course-card" data-course-id="{{ $course->id }}">
                <div class="card-header">
                    <div class="category-badge">{{ $course->category->name ?? 'Général' }}</div>
                    @if($course->price == 0)
                        <div class="free-badge">GRATUIT</div>
                    @endif
                    <img src="{{ $course->image_url ?? 'https://source.unsplash.com/random/300x200?education,learning&sig=' . $loop->index }}" 
                         alt="{{ $course->title }}" class="course-image">
                </div>
                
                <div class="card-body">
                    <div class="teacher-info">
                        <div class="teacher-avatar">
                            <img src="{{ $course->teacher->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($course->teacher->name ?? 'Inconnu') }}" 
                                 alt="{{ $course->teacher->name ?? 'N/A' }}">
                        </div>
                        <span>Par {{ $course->teacher->name ?? 'N/A' }}</span>
                    </div>
                    
                    <h3 class="course-title">{{ $course->title }}</h3>
                    <p class="course-description">{{ Str::limit($course->description, 100) }}</p>
                    
                    <div class="course-meta">
                        <span class="meta-item">
                            <i class="fas fa-users"></i> {{ $course->enrollments_count ?? 0 }} étudiants
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-star"></i> {{ $course->rating ?? '4.5' }}/5
                        </span>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="price-container">
                        @if($course->price == 0)
                            <span class="price-free">Gratuit</span>
                        @else
                            <span class="price">{{ $course->price }} €</span>
                            @if($course->original_price)
                                <span class="original-price">{{ $course->original_price }} €</span>
                            @endif
                        @endif
                    </div>
                    
                    @auth
                        @if(in_array($course->id, $enrolledCourseIds))
                            <button class="enrolled-btn" disabled>
                                <i class="fas fa-check-circle"></i> Inscrit
                            </button>
                        @else
                            <form action="{{ route('enroll', $course->id) }}" method="POST" class="enroll-form">
                                @csrf
                                <button type="submit" class="enroll-btn">
                                    <i class="fas fa-cart-plus"></i> S'inscrire
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="login-link">
                            <i class="fas fa-lock"></i> Se connecter
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal pour les détails du cours -->
<div id="courseModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --secondary-color: #3f37c9;
    --accent-color: #4cc9f0;
    --success-color: #4ade80;
    --danger-color: #f87171;
    --warning-color: #fbbf24;
    --dark-color: #1e293b;
    --light-color: #f8fafc;
    --gray-color: #94a3b8;
    --free-color: #10b981;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

/* Base Styles */
.courses-container {
    max-width: 1400px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.courses-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
    background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.page-subtitle {
    font-size: 1.1rem;
    color: var(--gray-color);
}

/* Courses Grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.course-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    animation: fadeIn 0.5s ease-out;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Card Header */
.card-header {
    position: relative;
}

.course-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.category-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background-color: var(--primary-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 1;
}

.free-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background-color: var(--free-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 1;
}

/* Card Body */
.card-body {
    padding: 1.5rem;
    flex-grow: 1;
}

.teacher-info {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.teacher-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 0.75rem;
}

.teacher-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.course-description {
    color: var(--gray-color);
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.course-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    color: var(--gray-color);
    margin-top: auto;
}

.meta-item {
    display: flex;
    align-items: center;
}

.meta-item i {
    margin-right: 0.25rem;
    color: var(--primary-color);
}

/* Card Footer */
.card-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price-container {
    display: flex;
    align-items: center;
}

.price {
    font-weight: 700;
    color: var(--dark-color);
    font-size: 1.1rem;
}

.price-free {
    font-weight: 700;
    color: var(--free-color);
    font-size: 1.1rem;
}

.original-price {
    text-decoration: line-through;
    color: var(--gray-color);
    font-size: 0.9rem;
    margin-left: 0.5rem;
}

.enroll-btn, .enrolled-btn, .login-link {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
}

.enroll-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    cursor: pointer;
}

.enroll-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
}

.enroll-btn i {
    margin-right: 0.5rem;
}

.enrolled-btn {
    background-color: var(--success-color);
    color: white;
    border: none;
    cursor: not-allowed;
}

.enrolled-btn i {
    margin-right: 0.5rem;
}

.login-link {
    color: var(--primary-color);
    text-decoration: none;
}

.login-link:hover {
    text-decoration: underline;
}

.login-link i {
    margin-right: 0.5rem;
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
    width: 80%;
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

/* Responsive */
@media (max-width: 768px) {
    .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .courses-container {
        padding: 0 1rem;
    }
    
    .modal-content {
        width: 95%;
        padding: 1.5rem;
    }
}

/* Alert Styles */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background-color: #fee2e2;
    color: #b91c1c;
    border-left: 4px solid #ef4444;
}

.alert i {
    margin-right: 0.75rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation au survol des boutons
    const enrollButtons = document.querySelectorAll('.enroll-btn');
    enrollButtons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'translateY(-2px)';
            button.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.transform = '';
            button.style.boxShadow = '';
        });
    });
    
    // Gestion du modal
    const courseCards = document.querySelectorAll('.course-card');
    const modal = document.getElementById('courseModal');
    const closeModal = document.querySelector('.close-modal');
    const modalContent = document.getElementById('modalContent');
    
    // Fermer le modal en cliquant à l'extérieur
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    
    // Simulation de chargement des détails du cours
    courseCards.forEach(card => {
        card.addEventListener('click', (e) => {
            // Empêcher l'ouverture du modal si on clique sur un bouton
            if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || e.target.closest('button') || e.target.closest('a')) {
                return;
            }
            
            const courseId = card.getAttribute('data-course-id');
            
            // Ici vous feriez normalement une requête AJAX pour récupérer les détails complets
            // Pour l'exemple, nous simulons des données
            const courseTitle = card.querySelector('.course-title').textContent;
            const courseDescription = "Description complète du cours..."; // Remplacer par la vraie description
            const teacherName = card.querySelector('.teacher-info span').textContent.replace('Par ', '');
            
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>${courseTitle}</h2>
                    <p class="modal-teacher">Par ${teacherName}</p>
                </div>
                <div class="modal-body">
                    <img src="${card.querySelector('.course-image').src}" alt="${courseTitle}" class="modal-image">
                    <p>${courseDescription}</p>
                    <div class="modal-meta">
                        <span><i class="fas fa-users"></i> ${card.querySelector('.meta-item:nth-child(1)').textContent}</span>
                        <span><i class="fas fa-star"></i> ${card.querySelector('.meta-item:nth-child(2)').textContent}</span>
                        <span><i class="fas fa-clock"></i> Durée: 10 heures</span>
                    </div>
                    <h3>Programme du cours</h3>
                    <ul class="modal-syllabus">
                        <li>Module 1: Introduction</li>
                        <li>Module 2: Concepts de base</li>
                        <li>Module 3: Approfondissement</li>
                        <li>Module 4: Projet pratique</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    ${card.querySelector('.card-footer').innerHTML}
                </div>
            `;
            
            modal.style.display = 'block';
        });
    });
    
    // Animation des cartes au chargement
    const grid = document.getElementById('coursesGrid');
    const cards = grid.querySelectorAll('.course-card');
    
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Effet de recherche/filtre (simulé)
    const searchInput = document.createElement('input');
    searchInput.setAttribute('type', 'text');
    searchInput.setAttribute('placeholder', 'Rechercher un cours...');
    searchInput.className = 'course-search';
    searchInput.style.marginBottom = '2rem';
    searchInput.style.width = '100%';
    searchInput.style.maxWidth = '500px';
    searchInput.style.padding = '0.75rem 1rem';
    searchInput.style.borderRadius = '8px';
    searchInput.style.border = '1px solid #e2e8f0';
    searchInput.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
    
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        
        cards.forEach(card => {
            const title = card.querySelector('.course-title').textContent.toLowerCase();
            const description = card.querySelector('.course-description').textContent.toLowerCase();
            const teacher = card.querySelector('.teacher-info span').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm) || teacher.includes(searchTerm)) {
                card.style.display = 'block';
                card.classList.add('animate-fade-in');
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    document.querySelector('.courses-header').appendChild(searchInput);
});
</script>
@endsection