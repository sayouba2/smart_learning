@extends('layouts.home')

@section('content')
    <div class="register-container">
        <div class="register-wrapper">
            <!-- Illustration côté gauche -->
            <div class="register-illustration">
                <div class="illustration-content">
                    <h2>Rejoignez notre communauté !</h2>
                    <p>Créez votre compte pour accéder à tous nos cours et ressources pédagogiques.</p>
                    <div class="illustration-image">
                        <img src="{{asset('images/img.png')}}" alt="Étudiants en apprentissage">
                    </div>
                    <div class="auth-links">
                        <p>Déjà membre ?</p>
                        <a href="{{ route('login') }}" class="login-link">Se connecter</a>
                    </div>
                </div>
            </div>

            <!-- Formulaire côté droit -->
            <div class="register-form">
                <div class="form-header">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Elearning</span>
                    </div>
                    <h1>Créer un compte</h1>
                    <p>Remplissez le formulaire pour commencer votre parcours</p>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder=" " />
                            <x-input-label for="name" :value="__('Nom complet')" />
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="error-message" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder=" " />
                            <x-input-label for="email" :value="__('Adresse Email')" />
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <div class="select-container">
                            <i class="fas fa-user-tag select-icon"></i>
                            <select id="role" name="role" required>
                                <option value="" disabled selected>Choisissez votre rôle</option>
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Étudiant</option>
                                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Enseignant</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="error-message" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder=" " />
                            <x-input-label for="password" :value="__('Mot de passe')" />
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password" aria-label="Afficher le mot de passe">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                        <div class="password-strength mt-2">
                            <div class="strength-meter">
                                <div class="strength-bar" id="strengthBar"></div>
                            </div>
                            <small id="strengthText" class="strength-text">Faible</small>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <div class="input-container">
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder=" " />
                            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="toggle-password" aria-label="Afficher le mot de passe">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="btn-text">S'inscrire</span>
                        <i class="fas fa-user-plus btn-icon"></i>
                    </button>
                </form>

                <div class="terms-agreement">
                    <p>En vous inscrivant, vous acceptez nos <a href="#" class="terms-link">Conditions d'utilisation</a> et notre <a href="#" class="terms-link">Politique de confidentialité</a>.</p>
                </div>

                <div class="social-login">
                    <p class="divider">Ou inscrivez-vous avec</p>
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
        --warning-color: #f59e0b;
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
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--light-color);
        padding: 1rem;
    }

    .register-wrapper {
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
    .register-illustration {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .register-illustration::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .register-illustration::after {
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

    .register-illustration h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .register-illustration p {
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

    .login-link {
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        padding: 0.5rem 1rem;
        border: 1px solid white;
        border-radius: 50px;
    }

    .login-link:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Formulaire */
    .register-form {
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

    .register-form h1 {
        font-size: 1.8rem;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .register-form p {
        color: var(--gray-color);
        font-size: 0.95rem;
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

    /* Select Styles */
    .select-container {
        position: relative;
    }

    select {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-light);
        outline: none;
    }

    .select-icon {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: var(--gray-color);
    }

    .select-arrow {
        position: absolute;
        right: 1rem;
        top: 1rem;
        color: var(--gray-color);
        pointer-events: none;
    }

    select:focus ~ .select-icon {
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

    /* Password Strength Meter */
    .password-strength {
        display: none;
    }

    .strength-meter {
        height: 5px;
        background-color: #e0e0e0;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 0.3rem;
    }

    .strength-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .strength-text {
        font-size: 0.75rem;
        text-align: right;
    }

    /* Error Messages */
    .error-message {
        color: var(--danger-color);
        font-size: 0.8rem;
        margin-top: 0.3rem;
        display: block;
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
        margin: 1.5rem 0;
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

    /* Terms Agreement */
    .terms-agreement {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 0.8rem;
        color: var(--gray-color);
    }

    .terms-link {
        color: var(--primary-color);
        text-decoration: none;
    }

    .terms-link:hover {
        text-decoration: underline;
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
        .register-wrapper {
            grid-template-columns: 1fr;
        }
        
        .register-illustration {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .register-form {
            padding: 2rem 1.5rem;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
        });

        // Password strength meter
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const strengthMeter = this.parentElement.parentElement.querySelector('.password-strength');
                const strengthBar = document.getElementById('strengthBar');
                const strengthText = document.getElementById('strengthText');
                
                if (this.value.length > 0) {
                    strengthMeter.style.display = 'block';
                    
                    // Calculate strength
                    let strength = 0;
                    if (this.value.length >= 8) strength += 1;
                    if (this.value.match(/[a-z]/)) strength += 1;
                    if (this.value.match(/[A-Z]/)) strength += 1;
                    if (this.value.match(/[0-9]/)) strength += 1;
                    if (this.value.match(/[^a-zA-Z0-9]/)) strength += 1;
                    
                    // Update UI
                    const width = strength * 20;
                    strengthBar.style.width = width + '%';
                    
                    if (strength <= 2) {
                        strengthBar.style.backgroundColor = 'var(--danger-color)';
                        strengthText.textContent = 'Faible';
                        strengthText.style.color = 'var(--danger-color)';
                    } else if (strength === 3) {
                        strengthBar.style.backgroundColor = 'var(--warning-color)';
                        strengthText.textContent = 'Moyen';
                        strengthText.style.color = 'var(--warning-color)';
                    } else {
                        strengthBar.style.backgroundColor = 'var(--success-color)';
                        strengthText.textContent = 'Fort';
                        strengthText.style.color = 'var(--success-color)';
                    }
                } else {
                    strengthMeter.style.display = 'none';
                }
            });
        }

        // Animation des éléments au chargement
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
            group.classList.add('animate-fade-in');
        });

        // Animation des icônes au focus
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('.input-icon, .select-icon');
                if (icon) {
                    icon.style.animation = 'float 1.5s infinite';
                }
            });
            
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('.input-icon, .select-icon');
                if (icon) {
                    icon.style.animation = '';
                }
            });
        });

        // Validation du formulaire
        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredInputs = this.querySelectorAll('[required]');
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.style.borderColor = 'var(--danger-color)';
                        const label = input.nextElementSibling;
                        if (label && label.tagName === 'LABEL') {
                            label.style.color = 'var(--danger-color)';
                        }
                        isValid = false;
                    }
                });
                
                // Check password match
                const password = document.getElementById('password');
                const confirmPassword = document.getElementById('password_confirmation');
                
                if (password && confirmPassword && password.value !== confirmPassword.value) {
                    confirmPassword.style.borderColor = 'var(--danger-color)';
                    const label = confirmPassword.nextElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        label.style.color = 'var(--danger-color)';
                    }
                    const errorMessage = confirmPassword.parentElement.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.textContent = 'Les mots de passe ne correspondent pas';
                    }
                    isValid = false;
                }
                
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
                    const label = this.nextElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        label.style.color = 'var(--gray-color)';
                    }
                }
            });
        });
    });
    </script>
@endsection