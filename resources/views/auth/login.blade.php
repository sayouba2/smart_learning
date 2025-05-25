@extends('layouts.home')

@section('content')
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Illustration côté gauche -->
            <div class="login-illustration">
                <div class="illustration-content">
                    <h2>Bienvenue à nouveau !</h2>
                    <p>Connectez-vous pour accéder à votre espace personnel et continuer votre apprentissage.</p>
                    <div class="illustration-image">
                        <img src="{{asset('images/img.png')}}" alt="Apprentissage en ligne">
                    </div>
                    <div class="auth-links">
                        <p>Pas encore de compte ?</p>
                        <a href="{{ route('register') }}" class="register-link">S'inscrire maintenant</a>
                    </div>
                </div>
            </div>

            <!-- Formulaire côté droit -->
            <div class="login-form">
                <div class="form-header">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Elearning</span>
                    </div>
                    <h1>Connexion</h1>
                    <p>Entrez vos identifiants pour accéder à votre compte</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="auth-status" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder=" " />
                            <x-input-label for="email" :value="__('Email')" />
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder=" " />
                            <x-input-label for="password" :value="__('Mot de passe')" />
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password" aria-label="Afficher le mot de passe">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Se connecter</span>
                        <i class="fas fa-arrow-right btn-icon"></i>
                    </button>
                </form>

                <div class="social-login">
                    <p class="divider">Ou connectez-vous avec</p>
                    <div class="social-buttons">
                        <a href="#" class="social-btn google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
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
        --danger-color: #ef4444;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
        --gray-color: #94a3b8;
        --border-color: #e2e8f0;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    /* Base Styles */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--light-color);
        padding: 1rem;
    }

    .login-wrapper {
        max-width: 1200px;
        width: 100%;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    /* Illustration Section */
    .login-illustration {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .login-illustration::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .login-illustration::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }

    .illustration-content {
        position: relative;
        z-index: 1;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .login-illustration h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .login-illustration p {
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .illustration-image {
        margin: 2rem 0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .illustration-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .auth-links {
        margin-top: auto;
        text-align: center;
    }

    .auth-links p {
        margin-bottom: 0.5rem;
        opacity: 0.8;
    }

    .register-link {
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        padding: 0.5rem 1rem;
        border: 1px solid white;
        border-radius: 50px;
    }

    .register-link:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Formulaire */
    .login-form {
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: var(--primary-color);
        font-size: 1.5rem;
        font-weight: 700;
    }

    .logo i {
        margin-right: 0.5rem;
        font-size: 1.8rem;
    }

    .login-form h1 {
        font-size: 1.8rem;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .login-form p {
        color: var(--gray-color);
        font-size: 0.95rem;
    }

    /* Alert */
    .auth-status {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        position: relative;
        background-color: var(--success-color);
        color: white;
    }

    .auth-status i {
        margin-right: 0.75rem;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .input-container {
        position: relative;
    }

    /* Input Styles */
    [type='text'], [type='email'], [type='password'] {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    [type='text']:focus, [type='email']:focus, [type='password']:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-light);
        outline: none;
    }

    /* Floating Labels */
    label {
        position: absolute;
        top: 1rem;
        left: 3rem;
        color: var(--gray-color);
        transition: all 0.3s ease;
        pointer-events: none;
        background: white;
        padding: 0 0.3rem;
    }

    [type='text']:focus + label,
    [type='email']:focus + label,
    [type='password']:focus + label,
    [type='text']:not(:placeholder-shown) + label,
    [type='email']:not(:placeholder-shown) + label,
    [type='password']:not(:placeholder-shown) + label {
        top: -0.5rem;
        left: 1.5rem;
        font-size: 0.8rem;
        color: var(--primary-color);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: var(--gray-color);
        transition: all 0.3s ease;
    }

    [type='text']:focus ~ .input-icon,
    [type='email']:focus ~ .input-icon,
    [type='password']:focus ~ .input-icon {
        color: var(--primary-color);
    }

    /* Toggle Password */
    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 1rem;
        background: none;
        border: none;
        color: var(--gray-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        color: var(--primary-color);
    }

    /* Error Messages */
    .error-message {
        color: var(--danger-color);
        font-size: 0.8rem;
        margin-top: 0.3rem;
        display: block;
    }

    /* Form Options */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 0.9rem;
        color: var(--gray-color);
    }

    .remember-me input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        height: 18px;
        width: 18px;
        background-color: white;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        margin-right: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remember-me:hover input ~ .checkmark {
        border-color: var(--primary-color);
    }

    .remember-me input:checked ~ .checkmark {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .checkmark:after {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: white;
        display: none;
        font-size: 0.7rem;
    }

    .remember-me input:checked ~ .checkmark:after {
        display: block;
    }

    .forgot-password {
        color: var(--primary-color);
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .submit-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        width: 100%;
        margin-bottom: 2rem;
    }

    .submit-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .submit-btn .btn-icon {
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }

    .submit-btn:hover .btn-icon {
        transform: translateX(5px);
    }

    /* Social Login */
    .social-login {
        text-align: center;
    }

    .divider {
        display: flex;
        align-items: center;
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .divider::before, .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid var(--border-color);
        margin: 0 1rem;
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.3s ease;
    }

    .social-btn.google {
        background-color: #DB4437;
    }

    .social-btn.facebook {
        background-color: #4267B2;
    }

    .social-btn.twitter {
        background-color: #1DA1F2;
    }

    .social-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .login-wrapper {
            grid-template-columns: 1fr;
        }
        
        .login-illustration {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .login-form {
            padding: 2rem 1.5rem;
        }
        
        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .forgot-password {
            align-self: flex-end;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
        }

        // Animation des éléments au chargement
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
            group.classList.add('animate-fade-in');
        });

        // Animation des icônes au focus
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.animation = 'float 1.5s infinite';
                }
            });
            
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.animation = '';
                }
            });
        });

        // Validation du formulaire
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredInputs = this.querySelectorAll('[required]');
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.style.borderColor = 'var(--danger-color)';
                        input.nextElementSibling.style.color = 'var(--danger-color)';
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    this.querySelector('.error-message')?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        }

        // Réinitialiser les styles de validation
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.style.borderColor = 'var(--border-color)';
                    if (this.nextElementSibling) {
                        this.nextElementSibling.style.color = 'var(--gray-color)';
                    }
                }
            });
        });
    });
    </script>
@endsection