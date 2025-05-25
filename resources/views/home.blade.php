@extends('layouts.home')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #3b82f6;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
        --border-color: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    body {
        line-height: 1.6;
        color: var(--text-primary);
        background-color: var(--bg-white);
    }

    /* Navigation Enhancement */
    .navbar-brand {
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--primary-color) !important;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        color: white;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .btn-hero-primary {
        background: white;
        color: var(--primary-color);
        font-weight: 600;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-lg);
        border: none;
    }

    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: var(--primary-color);
    }

    .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-weight: 600;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        transform: translateY(-2px);
    }

    /* Stats Cards */
    .stats-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        color: white;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stats-label {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* Professional Card Design */
    .professional-card {
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .professional-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-color);
    }

    .professional-card .card-body {
        padding: 2rem;
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: white;
        font-size: 1.5rem;
    }

    .feature-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .feature-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    /* Course Cards */
    .course-card {
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
        height: 100%;
    }

    .course-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-color);
    }

    .course-image {
        height: 200px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .course-image i {
        font-size: 3rem;
        color: white;
        opacity: 0.8;
    }

    .course-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-new {
        background: var(--success-color);
        color: white;
    }

    .badge-popular {
        background: var(--warning-color);
        color: white;
    }

    .badge-premium {
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
        color: white;
    }

    .course-content {
        padding: 1.5rem;
    }

    .course-rating {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stars {
        color: #fbbf24;
        margin-right: 0.5rem;
    }

    .rating-count {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .course-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-primary);
        line-height: 1.3;
    }

    .course-description {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .course-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .instructor {
        display: flex;
        align-items: center;
    }

    .instructor-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
    }

    .instructor-name {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .course-duration {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .course-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .course-price {
        display: flex;
        align-items: center;
    }

    .price-current {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
    }

    .price-original {
        font-size: 0.875rem;
        color: var(--text-secondary);
        text-decoration: line-through;
        margin-left: 0.5rem;
    }

    .btn-course {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-course:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-1px);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--text-primary) 0%, #374151 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }

    .cta-badge {
        background: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .cta-subtitle {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .guarantee-cards {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
    }

    .guarantee-number {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .guarantee-text {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* Testimonials */
    .testimonial-card {
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        height: 100%;
        position: relative;
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .testimonial-quote {
        font-size: 1.125rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
    }

    .testimonial-author {
        display: flex;
        align-items: center;
    }

    .author-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        margin-right: 1rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .author-info h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .author-info small {
        color: var(--text-secondary);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.125rem;
        }
        
        .cta-title {
            font-size: 2rem;
        }
    }

    /* Animation Classes */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Live Indicators */
    .live-indicator {
        background: var(--success-color);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.7;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Progress Bars */
    .progress-modern {
        height: 6px;
        border-radius: 10px;
        background: var(--border-color);
        overflow: hidden;
    }

    .progress-bar-modern {
        height: 100%;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        transition: width 0.6s ease;
    }

    /* Footer */
    .footer {
        background: var(--text-primary);
        color: white;
    }

    .footer-link {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: white;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="live-indicator"></span>
                        <strong>52,431</strong>&nbsp;étudiants connectés maintenant
                    </div>
                    
                    <h1 class="hero-title">
                        Maîtrisez les compétences
                        <span class="d-block text-warning">de demain</span>
                    </h1>
                    
                    <p class="hero-subtitle">
                        Accédez à plus de 1,200 cours certifiés dispensés par des experts de l'industrie. 
                        Développez vos compétences à votre rythme et boostez votre carrière.
                    </p>
                    
                    <div class="d-flex flex-column flex-sm-row gap-3 mb-5">
                        <a href="{{ route('register') }}" class="btn-hero-primary">
                            <i class="fas fa-rocket me-2"></i>
                            Commencer gratuitement
                        </a>
                        <a href="{{ route('courses.index') }}" class="btn-hero-secondary">
                            <i class="fas fa-play me-2"></i>
                            Parcourir les cours
                        </a>
                    </div>
                    
                    <!-- Live Stats -->
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="stats-card">
                                <span class="stats-number" data-count="1200">0</span>
                                <div class="stats-label">Cours disponibles</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-card">
                                <span class="stats-number" data-count="52431">0</span>
                                <div class="stats-label">Étudiants actifs</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-card">
                                <span class="stats-number" data-count="98">0</span>
                                <div class="stats-label">% Satisfaction</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative">
                    <!-- Learning Dashboard Preview -->
                    <div class="stats-card p-4" style="max-width: 400px; margin-left: auto;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-2 me-3">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Tableau de bord étudiant</h6>
                                <small class="opacity-75">Votre progression en temps réel</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small>Cours complétés cette semaine</small>
                                <small><strong>3/5</strong></small>
                            </div>
                            <div class="progress-modern">
                                <div class="progress-bar-modern" style="width: 60%"></div>
                            </div>
                        </div>
                        
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="text-center p-2 bg-white bg-opacity-10 rounded">
                                    <div class="h5 mb-0">24h</div>
                                    <small>Temps d'étude</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-white bg-opacity-10 rounded">
                                    <div class="h5 mb-0">12</div>
                                    <small>Certificats</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" style="padding: 5rem 0; background: var(--bg-light);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <div class="d-inline-flex align-items-center px-3 py-2 bg-primary bg-opacity-10 text-primary rounded-pill mb-3">
                    <i class="fas fa-award me-2"></i>
                    <small class="fw-semibold">Plateforme certifiée ISO 27001</small>
                </div>
                <h2 class="display-5 fw-bold mb-3">
                    Une expérience d'apprentissage 
                    <span class="text-primary">exceptionnelle</span>
                </h2>
                <p class="lead text-muted">
                    Notre plateforme combine technologie de pointe et pédagogie innovante 
                    pour offrir la meilleure expérience d'apprentissage en ligne.
                </p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 fade-in-up">
                <div class="professional-card h-100">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="feature-title">IA Adaptive</h3>
                        <p class="feature-description">
                            Notre intelligence artificielle analyse votre style d'apprentissage et adapte 
                            automatiquement le contenu pour optimiser votre progression.
                        </p>
                        <div class="d-flex align-items-center text-primary">
                            <small class="fw-semibold">Découvrir la technologie</small>
                            <i class="fas fa-arrow-right ms-2 small"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.2s;">
                <div class="professional-card h-100">
                    <div class="card-body">
                        <div class="feature-icon" style="background: linear-gradient(135deg, var(--success-color), #059669);">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="feature-title">Mentoring Expert</h3>
                        <p class="feature-description">
                            Bénéficiez de l'accompagnement personnalisé d'experts reconnus dans leur domaine, 
                            disponibles 24/7 pour répondre à vos questions.
                        </p>
                        <div class="d-flex align-items-center text-primary">
                            <small class="fw-semibold">Rencontrer nos mentors</small>
                            <i class="fas fa-arrow-right ms-2 small"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.4s;">
                <div class="professional-card h-100">
                    <div class="card-body">
                        <div class="feature-icon" style="background: linear-gradient(135deg, var(--warning-color), #d97706);">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="feature-title">Certifications Reconnues</h3>
                        <p class="feature-description">
                            Obtenez des certifications reconnues par les plus grandes entreprises tech 
                            et validées par des organismes internationaux.
                        </p>
                        <div class="d-flex align-items-center text-primary">
                            <small class="fw-semibold">Voir les partenaires</small>
                            <i class="fas fa-arrow-right ms-2 small"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trending Courses Section -->
<section class="py-5" style="padding: 5rem 0;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-6 fw-bold mb-2">
                    Cours <span class="text-primary">tendances</span>
                </h2>
                <p class="lead text-muted mb-0">
                    Les formations les plus demandées par les professionnels cette semaine
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-th-large me-2"></i>
                    Tous les cours
                </a>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Course 1: Laravel Mastery -->
            <div class="col-lg-4 fade-in-up">
                <div class="course-card">
                    <div class="course-image" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                        <div class="course-badge badge-new">Nouveau</div>
                        <i class="fab fa-laravel"></i>
                    </div>
                    <div class="course-content">
                        <div class="course-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="rating-count">(4,821 avis)</span>
                        </div>
                        
                        <h3 class="course-title">Laravel 10 - Développement Web Avancé</h3>
                        <p class="course-description">
                            Maîtrisez Laravel 10 avec les dernières fonctionnalités : Filament, Livewire, 
                            API Platform et architecture hexagonale.
                        </p>
                        
                        <div class="course-meta">
                            <div class="instructor">
                                <div class="instructor-avatar bg-danger">
                                    <span>TL</span>
                                </div>
                                <span class="instructor-name">Taylor Otwell</span>
                            </div>
                            <div class="course-duration">
                                <i class="fas fa-clock me-1"></i>
                                42h 30min
                            </div>
                        </div>
                        
                        <div class="course-footer">
                            <div class="course-price">
                                <span class="price-current">Gratuit</span>
                                <span class="price-original">€299</span>
                            </div>
                            <a href="#" class="btn-course">
                                Commencer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course 2: React & Next.js -->
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.2s;">
                <div class="course-card">
                    <div class="course-image" style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
                        <div class="course-badge badge-popular">Populaire</div>
                        <i class="fab fa-react"></i>
                    </div>
                    <div class="course-content">
                        <div class="course-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="rating-count">(7,293 avis)</span>
                        </div>
                        
                        <h3 class="course-title">React 18 & Next.js 14 - Formation Complète</h3>
                        <p class="course-description">
                            De zéro à expert : React 18, Next.js 14, TypeScript, Server Components, 
                            et déploiement Vercel.
                        </p>
                        
                        <div class="course-meta">
                            <div class="instructor">
                                <div class="instructor-avatar bg-info">
                                    <span>VV</span>
                                </div>
                                <span class="instructor-name">Vercel Team</span>
                            </div>
                            <div class="course-duration">
                                <i class="fas fa-clock me-1"></i>
                                38h 15min
                            </div>
                        </div>
                        
                        <div class="course-footer">
                            <div class="course-price">
                                <span class="price-current">€89</span>
                                <span class="price-original">€349</span>
                            </div>
                            <a href="#" class="btn-course">
                                S'inscrire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Course 3: DevOps & Cloud -->
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.4s;">
                <div class="course-card">
                    <div class="course-image" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                        <div class="course-badge badge-premium">Premium</div>
                        <i class="fas fa-cloud"></i>
                    </div>
                    <div class="course-content">
                        <div class="course-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-count">(3,147 avis)</span>
                        </div>
                        
                        <h3 class="course-title">DevOps & Architecture Cloud Native</h3>
                        <p class="course-description">
                            Docker, Kubernetes, CI/CD, Infrastructure as Code avec Terraform, 
                            monitoring et sécurité cloud.
                        </p>
                        
                        <div class="course-meta">
                            <div class="instructor">
                                <div class="instructor-avatar bg-purple">
                                    <span>KA</span>
                                </div>
                                <span class="instructor-name">Kelsey Hightower</span>
                            </div>
                            <div class="course-duration">
                                <i class="fas fa-clock me-1"></i>
                                55h 45min
                            </div>
                        </div>
                        
                        <div class="course-footer">
                            <div class="course-price">
                                <span class="price-current">€199</span>
                                <span class="price-original">€599</span>
                            </div>
                            <a href="#" class="btn-course">
                                Premium
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="padding: 5rem 0; background: var(--bg-light);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-6 fw-bold mb-3">
                    Ce que disent nos <span class="text-primary">étudiants</span>
                </h2>
                <p class="lead text-muted">
                    Plus de 50,000 professionnels ont transformé leur carrière grâce à nos formations
                </p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 fade-in-up">
                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "Grâce aux cours Laravel, j'ai pu décrocher un poste de Lead Developer dans une startup parisienne. La qualité des contenus et l'accompagnement sont exceptionnels !"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <span>SM</span>
                        </div>
                        <div class="author-info">
                            <h6>Sarah Martin</h6>
                            <small>Lead Developer chez Techflow</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.2s;">
                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "Les formations DevOps m'ont permis de maîtriser Kubernetes et Docker. J'ai augmenté mon salaire de 40% en 6 mois ! Une plateforme incontournable."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <span>JD</span>
                        </div>
                        <div class="author-info">
                            <h6>Julien Dubois</h6>
                            <small>DevOps Engineer chez CloudTech</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 fade-in-up" style="animation-delay: 0.4s;">
                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "L'approche pédagogique avec des projets concrets est fantastique. J'ai pu créer mon portfolio React et décrocher mon premier job en tant que Frontend Developer."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <span>AL</span>
                        </div>
                        <div class="author-info">
                            <h6>Antoine Lefebvre</h6>
                            <small>Frontend Developer chez DigitalCorp</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5" style="padding: 5rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <div class="cta-badge">
                        <i class="fas fa-fire me-2"></i>
                        Offre limitée - 7 jours restants
                    </div>
                    
                    <h2 class="cta-title">
                        Transformez votre carrière
                        <span class="d-block text-info">dès aujourd'hui</span>
                    </h2>
                    
                    <p class="cta-subtitle">
                        Rejoignez plus de 50,000 professionnels qui ont déjà boosté leur carrière 
                        grâce à nos formations certifiantes. Accès illimité à tous les cours pour 
                        seulement 29€/mois.
                    </p>
                    
                    <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-crown me-2"></i>
                            Commencer l'essai gratuit
                        </a>
                        <a href="{{-- route('pricing') --}}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-tag me-2"></i>
                            Voir les tarifs
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="guarantee-cards">
                            <div class="guarantee-number">30j</div>
                            <div class="guarantee-text">Garantie remboursement</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="guarantee-cards">
                            <div class="guarantee-number">24/7</div>
                            <div class="guarantee-text">Support premium</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="guarantee-cards">
                            <div class="guarantee-number">∞</div>
                            <div class="guarantee-text">Accès à vie</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="guarantee-cards">
                            <div class="guarantee-number">SSL</div>
                            <div class="guarantee-text">Paiement sécurisé</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-5" style="padding: 3rem 0; background: var(--bg-white);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-muted mb-4">Nos étudiants travaillent dans les meilleures entreprises</p>
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-google fa-2x text-muted"></i>
                            <div class="small mt-1">Google</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-microsoft fa-2x text-muted"></i>
                            <div class="small mt-1">Microsoft</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-amazon fa-2x text-muted"></i>
                            <div class="small mt-1">Amazon</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-meta fa-2x text-muted"></i>
                            <div class="small mt-1">Meta</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-spotify fa-2x text-muted"></i>
                            <div class="small mt-1">Spotify</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="p-3 text-center opacity-50">
                            <i class="fab fa-airbnb fa-2x text-muted"></i>
                            <div class="small mt-1">Airbnb</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animated counter for stats
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            element.innerHTML = current.toLocaleString();
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Animate stats when they come into view
                if (entry.target.classList.contains('stats-number')) {
                    const target = parseInt(entry.target.getAttribute('data-count'));
                    animateValue(entry.target, 0, target, 2000);
                }
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // Observe stats numbers
    document.querySelectorAll('.stats-number').forEach(el => {
        observer.observe(el);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add hover effects to course cards
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Dynamic progress bar animation
    const progressBars = document.querySelectorAll('.progress-bar-modern');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });

    // Add parallax effect to hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Toast notification for course enrollment
    document.querySelectorAll('.btn-course').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create toast notification
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 p-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="toast show" role="alert">
                    <div class="toast-header">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong class="me-auto">Inscription réussie</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        Vous avez été inscrit au cours avec succès !
                    </div>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    });
});
</script>
@endpush