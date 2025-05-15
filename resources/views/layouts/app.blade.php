<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title', 'Study Course - Education Platform')</title>

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style-starter.css') }}">

        <!-- Additional custom CSS -->
        <style>
            :root {
                --primary-color:rgb(154, 58, 245);
                --primary-hover:rgb(147, 58, 250);
                --secondary-color: #f97316;
                --text-color:rgb(8, 8, 8);
                --light-bg: #f8fafc;
                --card-bg: #ffffff;
                --border-radius: 12px;
                --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                color: var(--text-color);
                background-color: var(--light-bg);
            }
            
            /* Modern buttons */
            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                border-radius: var(--border-radius);
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background-color: var(--primary-hover);
                transform: translateY(-2px);
                box-shadow: var(--box-shadow);
            }
            
            /* Cards */
            .modern-card {
                background: var(--card-bg);
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                transition: all 0.3s ease;
                overflow: hidden;
            }
            
            .modern-card:hover {
                transform: translateY(-5px);
            }
            
            /* Header animation */
            .navbar-brand {
                position: relative;
            }
            
            .navbar-brand:after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -5px;
                left: 0;
                background-color: var(--primary-color);
                transition: width 0.3s ease;
            }
            
            .navbar-brand:hover:after {
                width: 100%;
            }
            
            /* Improved navbar */
            #site-header {
                padding: 15px 0;
                transition: all 0.4s ease;
            }
            
            #site-header.scrolled {
                padding: 8px 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            }
            
            .nav-link {
                font-weight: 500;
                padding: 0.5rem 1rem;
                position: relative;
            }
            
            .nav-link:after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: 0;
                left: 50%;
                background-color: var(--primary-color);
                transition: all 0.3s ease;
            }
            
            .nav-link:hover:after,
            .nav-item.active .nav-link:after {
                width: 80%;
                left: 10%;
            }
            
            /* Course cards */
            .course-card {
                overflow: hidden;
                height: 100%;
            }
            
            .course-card img {
                transition: all 0.5s ease;
            }
            
            .course-card:hover img {
                transform: scale(1.05);
            }
            
            .course-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                padding: 5px 15px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                z-index: 1;
            }
            
            /* Custom Forms */
            .custom-input {
                border-radius: 8px;
                padding: 12px;
                border: 1px solid #e2e8f0;
                transition: all 0.3s ease;
            }
            
            .custom-input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(49, 58, 177, 0.92);
            }
            
            /* Footer improvements */
            .footer-link {
                color:rgb(3, 3, 3);
                transition: all 0.3s ease;
            }
            
            .footer-link:hover {
                color: var(--primary-color);
                padding-left: 5px;
            }
            
            /* Animation */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fadeInUp {
                animation: fadeInUp 0.5s ease forwards;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header id="site-header" class="fixed-top">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                        <i class="fas fa-graduation-cap text-primary me-2" style="font-size: 24px;"></i>
                        <span>Study Course <span class="d-none d-md-inline text-secondary">| Le chemin vers le succès</span></span>
                    </a>

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mx-lg-auto">
                            <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Accueil</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('courses.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('courses.index') }}"><i class="fas fa-book me-1"></i> Cours</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about') }}"><i class="fas fa-info-circle me-1"></i> À propos</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact') }}"><i class="fas fa-envelope me-1"></i> Contact</a>
                            </li>
                        </ul>

                        <!-- Search -->
                        <div class="search-right me-3">
                            <a href="#search" class="text-dark" title="search"><i class="fas fa-search"></i></a>
                            <div id="search" class="pop-overlay">
                                <div class="popup">
                                    <form action="{{ route('search') }}" method="GET" class="search-box d-sm-flex position-relative">
                                        <input type="search" placeholder="Rechercher des cours..." name="search" required="required" autofocus="" class="form-control custom-input">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                                <a class="close" href="#close"><i class="fas fa-times"></i></a>
                            </div>
                        </div>

                        <!-- Authentication -->
                        <div class="top-quote text-center">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary me-2"><i class="fas fa-sign-in-alt me-1"></i> Connexion</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary"><i class="fas fa-user-plus me-1"></i> Inscription</a>
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end modern-card border-0 py-0 mt-2" aria-labelledby="dropdownMenuButton">
                                        @if(Auth::user()->role === 'admin')
                                            <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard</a></li>
                                        @elseif(Auth::user()->role === 'teacher')
                                            <li><a class="dropdown-item py-2" href="{{ route('teacher.dashboard') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Teacher Dashboard</a></li>
                                        @else
                                            <li><a class="dropdown-item py-2" href="{{ route('student.dashboard') }}"><i class="fas fa-user-graduate me-2"></i> My Dashboard</a></li>
                                        @endif
                                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> Profile</a></li>
                                        <li><hr class="dropdown-divider my-0"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Content -->
        <div class="content-wrapper pt-5 mt-5">
            @yield('content')
        </div>

        <!-- Footer -->
        <section class="footer-section pt-5 pb-3 bg-white mt-5">
            <div class="container py-md-4">
                <div class="row footer-top-29">
                    <div class="col-lg-4 col-md-6 col-sm-7 footer-list-29 footer-1 pe-lg-5 mb-4">
                        <h5 class="mb-3 fw-bold">Contactez-nous</h5>
                        <p><i class="fas fa-map-marker-alt me-2 text-primary"></i> Study course, 343 marketing, #2214 cravel street, NY - 62617.</p>
                        <p class="my-2"><i class="fas fa-phone me-2 text-primary"></i> <a href="tel:+1(21) 234 4567" class="text-reset">+1(21) 234 4567</a></p>
                        <p><i class="fas fa-envelope me-2 text-primary"></i> <a href="mailto:info@example.com" class="text-reset">info@example.com</a></p>
                        <div class="main-social-footer-29 mt-4">
                            <a href="#facebook" class="facebook me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#twitter" class="twitter me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#instagram" class="instagram me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#linkedin" class="linkedin me-2"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-5 col-6 footer-list-29 footer-2 mt-sm-0 mt-4 mb-4">
                        <h5 class="mb-3 fw-bold">La plateforme</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>À propos</a></li>
                            <li><a href="{{ route('courses.index') }}" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Cours</a></li>
                            <li><a href="{{ route('register') }}" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Devenir formateur</a></li>
                            <li><a href="{{ route('courses.index') }}" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Tous les cours</a></li>
                            <li><a href="{{ route('contact') }}" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Nous contacter</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-5 col-6 footer-list-29 footer-3 mt-lg-0 mt-4 mb-4">
                        <h5 class="mb-3 fw-bold">Catégories</h5>
                        <ul class="list-unstyled">
                            <li><a href="#development" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Développement</a></li>
                            <li><a href="#business" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Business</a></li>
                            <li><a href="#design" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Design</a></li>
                            <li><a href="#marketing" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Marketing</a></li>
                            <li><a href="#photography" class="footer-link"><i class="fas fa-angle-right me-2 small"></i>Photographie</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-7 footer-list-29 footer-4 mt-lg-0 mt-4 mb-4">
                        <h5 class="mb-3 fw-bold">Téléchargez notre application</h5>
                        <p class="mb-3">Accédez à vos cours même hors connexion</p>
                        <a href="#playstore" class="d-block mb-2"><img src="{{ asset('assets/images/googleplay.png') }}" class="img-fluid rounded" alt="GooglePlay"></a>
                        <a href="#appstore"><img src="{{ asset('assets/images/appstore.png') }}" class="img-fluid rounded" alt="AppStore"></a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copy-footer-29">© {{ date('Y') }} Study Course. Tous droits réservés.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3 text-reset small">Politique de confidentialité</a>
                        <a href="#" class="text-reset small">Conditions d'utilisation</a>
                    </div>
                </div>
            </div>

            <!-- Move top -->
            <button onclick="topFunction()" id="movetop" class="btn btn-primary btn-sm rounded-circle" title="Go to top">
                <i class="fas fa-chevron-up"></i>
            </button>
        </section>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/js/theme-change.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.countup.js') }}"></script>

        <!-- Custom Scripts -->
        <script>
            // Initialize Bootstrap dropdowns
            document.addEventListener('DOMContentLoaded', function() {
                var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
                var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                    return new bootstrap.Dropdown(dropdownToggleEl)
                });
            });
            
            // Counter
            $('.counter').countUp();

            // Header scroll effect
            window.onscroll = function() {
                scrollFunction();
                
                if(document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                    document.getElementById("site-header").classList.add("scrolled");
                } else {
                    document.getElementById("site-header").classList.remove("scrolled");
                }
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
            
            // Animation for elements when they come into view
            function animateOnScroll() {
                const elements = document.querySelectorAll('.animate-on-scroll');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight - 50) {
                        element.classList.add('animate-fadeInUp');
                    }
                });
            }
            
            // Add animation class to elements
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.section-title, .course-card, .feature-box').forEach(el => {
                    el.classList.add('animate-on-scroll');
                });
                
                window.addEventListener('scroll', animateOnScroll);
                animateOnScroll(); // Initial check
            });
        </script>
    </body>
</html>
