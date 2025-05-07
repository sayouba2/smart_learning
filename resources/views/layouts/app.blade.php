<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title', 'Study Course - Education Platform')</title>

        <!-- Google fonts -->
        <link href="//fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
        <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style-starter.css') }}">
    </head>
    <body>
        <!-- Header -->
        <header id="site-header" class="fixed-top">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark stroke">
                    <h1>
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <span class="fa fa-diamond"></span>Study Course <span class="logo">Journey to success</span>
                        </a>
                    </h1>

                    <button class="navbar-toggler collapsed bg-gradient" type="button" data-toggle="collapse"
                        data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                        <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mx-lg-auto">
                            <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('courses.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>

                        <!-- Search -->
                        <div class="search-right">
                            <a href="#search" title="search"><span class="fa fa-search" aria-hidden="true"></span></a>
                            <div id="search" class="pop-overlay">
                                <div class="popup">
                                    <form action="{{ route('search') }}" method="GET" class="search-box">
                                        <input type="search" placeholder="Search" name="search" required="required" autofocus="">
                                        <button type="submit" class="btn"><span class="fa fa-search" aria-hidden="true"></span></button>
                                    </form>
                                </div>
                                <a class="close" href="#close">×</a>
                            </div>
                        </div>

                        <!-- Authentication -->
                        <div class="top-quote mr-lg-2 text-center">
                            @guest
                                <a href="{{ route('login') }}" class="btn login mr-2"><span class="fa fa-user"></span> Login</a>
                            @else
                                <div class="dropdown">
                                    <button class="btn login dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(Auth::user()->role === 'admin')
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                        @elseif(Auth::user()->role === 'teacher')
                                            <a class="dropdown-item" href="{{ route('teacher.dashboard') }}">Teacher Dashboard</a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('student.dashboard') }}">My Dashboard</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>

                    <!-- Theme Switch -->
                    <div class="mobile-position">
                        <nav class="navigation">
                            <div class="theme-switch-wrapper">
                                <label class="theme-switch" for="checkbox">
                                    <input type="checkbox" id="checkbox">
                                    <div class="mode-container py-1">
                                        <i class="gg-sun"></i>
                                        <i class="gg-moon"></i>
                                    </div>
                                </label>
                            </div>
                        </nav>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        <section class="w3l-footer-29-main">
            <div class="footer-29 py-5">
                <div class="container py-md-4">
                    <div class="row footer-top-29">
                        <div class="col-lg-4 col-md-6 col-sm-7 footer-list-29 footer-1 pr-lg-5">
                            <h6 class="footer-title-29">Contact Info </h6>
                            <p>Address : Study course, 343 marketing, #2214 cravel street, NY - 62617.</p>
                            <p class="my-2">Phone : <a href="tel:+1(21) 234 4567">+1(21) 234 4567</a></p>
                            <p>Email : <a href="mailto:info@example.com">info@example.com</a></p>
                            <div class="main-social-footer-29 mt-4">
                                <a href="#facebook" class="facebook"><span class="fa fa-facebook"></span></a>
                                <a href="#twitter" class="twitter"><span class="fa fa-twitter"></span></a>
                                <a href="#instagram" class="instagram"><span class="fa fa-instagram"></span></a>
                                <a href="#linkedin" class="linkedin"><span class="fa fa-linkedin"></span></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-5 col-6 footer-list-29 footer-2 mt-sm-0 mt-5">
                            <h6 class="footer-title-29">Company</h6>
                            <ul>
                                <li><a href="{{ route('about') }}">About company</a></li>
                                <li><a href="{{ route('blog.index') }}">Latest Blog posts</a></li>
                                <li><a href="{{ route('teacher.register') }}">Became a teacher</a></li>
                                <li><a href="{{ route('courses.index') }}">Online Courses</a></li>
                                <li><a href="{{ route('contact') }}">Get in touch</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-5 col-6 footer-list-29 footer-3 mt-lg-0 mt-5">
                            <h6 class="footer-title-29">Programs</h6>
                            <ul>
                                <li><a href="#traning">Training Center</a></li>
                                <li><a href="#documentation">Documentation</a></li>
                                <li><a href="#release">Release Status</a></li>
                                <li><a href="#customers">Customers</a></li>
                                <li><a href="#helpcenter">Help Center</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-7 footer-list-29 footer-4 mt-lg-0 mt-5">
                            <h6 class="footer-title-29">Support</h6>
                            <a href="#playstore"><img src="{{ asset('assets/images/googleplay.png') }}" class="img-responsive" alt=""></a>
                            <a href="#appstore"><img src="{{ asset('assets/images/appstore.png') }}" class="img-responsive mt-3" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <section class="w3l-copyright text-center">
                <div class="container">
                    <p class="copy-footer-29">© {{ date('Y') }} Study Course. All rights reserved.</p>
                </div>

                <!-- Move top -->
                <button onclick="topFunction()" id="movetop" title="Go to top">&#10548;</button>
            </section>
        </section>

        <!-- Scripts -->
        <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme-change.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.countup.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <!-- Custom Scripts -->
        <script>
            // Counter
            $('.counter').countUp();

            // Scroll to top
            window.onscroll = function() {
                scrollFunction()
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

            // Navbar
            $(window).on("scroll", function () {
                var scroll = $(window).scrollTop();
                if (scroll >= 80) {
                    $("#site-header").addClass("nav-fixed");
                } else {
                    $("#site-header").removeClass("nav-fixed");
                }
            });

            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            });

            $(document).ready(function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
                $(window).on("resize", function () {
                    if ($(window).width() > 991) {
                        $("header").removeClass("active");
                    }
                });
            });
        </script>

        <!-- Page Specific Scripts -->
        @stack('scripts')
    </body>
</html>
