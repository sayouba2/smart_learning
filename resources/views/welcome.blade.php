@extends('layouts.app')

@section('title', 'Accueil - Study Course')

@section('content')

<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 animate-on-scroll">
                <h1 class="display-4 fw-bold text-primary mb-3">Apprenez à votre rythme</h1>
                <p class="lead mb-4">Développez vos compétences avec nos cours en ligne de qualité. Des experts reconnus pour vous accompagner dans votre apprentissage.</p>
                <div class="d-flex gap-3 mb-4">
                    <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">Découvrir les cours</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">S'inscrire gratuitement</a>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex">
                        <img src="{{ asset('assets/images/testimonial1.jpg') }}" class="rounded-circle border border-3 border-white" style="width: 45px; height: 45px; object-fit: cover; margin-right: -10px; z-index: 3;">
                        <img src="{{ asset('assets/images/testimonial2.jpg') }}" class="rounded-circle border border-3 border-white" style="width: 45px; height: 45px; object-fit: cover; margin-right: -10px; z-index: 2;">
                        <img src="{{ asset('assets/images/testimonial3.jpg') }}" class="rounded-circle border border-3 border-white" style="width: 45px; height: 45px; object-fit: cover; z-index: 1;">
                    </div>
                    <div class="ms-3">
                        <div class="d-flex align-items-center">
                            <div class="text-warning me-2">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-secondary small">4.8/5</span>
                        </div>
                        <p class="mb-0 small">Plus de 10 000 étudiants satisfaits</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0 animate-on-scroll">
                <div class="position-relative">
                    <img src="{{ asset('assets/images/hero-image.jpg') }}" class="img-fluid rounded-lg shadow-lg" alt="Online learning">
                    <div class="position-absolute top-0 start-0 bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 120px; height: 120px; transform: translate(-30%, -30%);">
                        <div class="text-center">
                            <div class="fw-bold fs-4">200+</div>
                            <div class="small">cours</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <h2 class="fw-bold">Explorez nos catégories</h2>
            <p class="text-secondary">Découvrez des cours dans différents domaines</p>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Répéter les blocs ci-dessous pour chaque catégorie -->
            <!-- Exemple pour Développement -->
            <div class="col-6 col-md-4 col-lg-2 animate-on-scroll">
                <div class="modern-card p-4 text-center h-100">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3">
                        <i class="fas fa-laptop-code text-primary fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Développement</h5>
                    <p class="small text-secondary mb-0">42 cours</p>
                </div>
            </div>
            <!-- Ajouter les autres catégories ici -->
        </div>
    </div>
</section>

<!-- Cours populaires -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="animate-on-scroll">
                <h2 class="fw-bold mb-0">Cours populaires</h2>
                <p class="text-secondary">Les mieux notés par nos étudiants</p>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary animate-on-scroll">Voir tous les cours</a>
        </div>

        <div class="row g-4">
            <!-- Utilisation de composants Blade : x-course-card -->
            <!-- Répéter pour chaque cours -->
            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <x-course-card
                    image="{{ asset('assets/images/course1.jpg') }}"
                    badge="Débutant"
                    badgeColor="bg-success text-white"
                    price="39,99 €"
                    title="Introduction au développement web"
                    description="Apprenez les bases du HTML, CSS et JavaScript."
                    duration="12h"
                    students="845"
                    instructor="Marie Laurent"
                    instructorImage="{{ asset('assets/images/testimonial1.jpg') }}"
                    link="{{ route('courses.show', 1) }}"
                    rating="4.8"
                />
            </div>
            <!-- Ajouter les autres cours ici -->
        </div>
    </div>
</section>

<!-- Pourquoi nous choisir ? -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <h2 class="fw-bold">Pourquoi choisir Study Course ?</h2>
            <p class="text-secondary">Notre plateforme vous offre une expérience d'apprentissage optimale</p>
        </div>

        <div class="row g-4">
            <!-- Exemple de feature -->
            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="modern-card p-4 h-100">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3">
                        <i class="fas fa-chalkboard-teacher text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Experts reconnus</h4>
                    <p class="text-secondary mb-0">Nos formateurs sont des professionnels expérimentés, passionnés par le partage de leurs connaissances.</p>
                </div>
            </div>
            <!-- Ajouter les autres "features" ici -->
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <h2 class="fw-bold">Ce que disent nos étudiants</h2>
            <p class="text-secondary">Des milliers d'apprenants satisfaits partout dans le monde</p>
        </div>

        <div class="row g-4">
            <!-- Exemple de témoignage -->
            <div class="col-md-4 animate-on-scroll">
                <div class="modern-card p-4 h-100">
                    <div class="d-flex mb-3">
                        <div class="text-warning me-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-secondary small">il y a 2 jours</span>
                    </div>
                    <p class="mb-4">"Les cours sont très bien structurés et les enseignants sont extrêmement compétents. J'ai acquis de nouvelles compétences en un temps record !"</p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/testimonial1.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-0">Marie Dubois</h6>
                            <p class="text-secondary small mb-0">Développeuse Web</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajouter les autres témoignages ici -->
        </div>
    </div>
</section>

<!-- Call to Action Final -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container animate-on-scroll">
        <h2 class="fw-bold mb-3">Prêt à commencer votre parcours d’apprentissage ?</h2>
        <p class="mb-4">Inscrivez-vous gratuitement et accédez à des centaines de cours dès aujourd’hui.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Créer un compte</a>
    </div>
</section>

@endsection
