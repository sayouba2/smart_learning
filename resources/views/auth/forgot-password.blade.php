@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(255, 255, 255, 0.18);
        --shadow-primary: 0 32px 64px rgba(102, 126, 234, 0.15);
        --shadow-secondary: 0 16px 32px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--primary-gradient);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated background elements */
    .bg-decoration {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .floating-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        animation: float 8s ease-in-out infinite;
    }

    .shape-1 {
        width: 100px;
        height: 100px;
        top: 15%;
        left: 8%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 150px;
        height: 150px;
        top: 50%;
        right: 10%;
        animation-delay: 3s;
    }

    .shape-3 {
        width: 80px;
        height: 80px;
        bottom: 25%;
        left: 15%;
        animation-delay: 6s;
    }

    .shape-4 {
        width: 60px;
        height: 60px;
        top: 70%;
        right: 25%;
        animation-delay: 1.5s;
    }

    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg) scale(1); 
            opacity: 0.7;
        }
        50% { 
            transform: translateY(-30px) rotate(180deg) scale(1.1); 
            opacity: 1;
        }
    }

    /* Glassmorphism card */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: var(--shadow-primary), var(--shadow-secondary);
        padding: 3rem 2.5rem;
        margin: 2rem auto;
        max-width: 480px;
        position: relative;
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header styling */
    .reset-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .reset-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--secondary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(240, 147, 251, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .reset-icon i {
        font-size: 2rem;
        color: white;
    }

    .reset-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .reset-subtitle {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Form styling */
    .form-floating {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-floating .form-control {
        height: 60px;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 1rem;
        font-weight: 500;
        padding: 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-2px);
    }

    .form-floating label {
        color: #718096;
        font-weight: 500;
        padding: 1rem 1.25rem;
    }

    /* Button styling */
    .btn-primary-custom {
        background: var(--primary-gradient);
        border: none;
        border-radius: 16px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 48px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-custom:active {
        transform: translateY(-1px);
    }

    /* Status message */
    .alert-success-custom {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
        border: none;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        font-weight: 500;
        box-shadow: 0 8px 32px rgba(72, 187, 120, 0.3);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Error styling */
    .invalid-feedback {
        color: #e53e3e;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
        display: block;
    }

    .form-control.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1);
    }

    .form-control.is-invalid:focus {
        border-color: #e53e3e;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.15);
    }

    /* Back link */
    .back-link {
        text-align: center;
        margin-top: 2rem;
    }

    .back-link a {
        color: #718096;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-link a:hover {
        color: #667eea;
        transform: translateX(-3px);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .glass-card {
            margin: 1rem;
            padding: 2rem 1.5rem;
        }
        
        .reset-title {
            font-size: 1.5rem;
        }
        
        .floating-shape {
            opacity: 0.3;
        }
    }

    /* Loading animation */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')
<div class="bg-decoration">
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>
</div>

<div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
    <div class="glass-card w-100">
        <div class="reset-header">
            <div class="reset-icon">
                <i class="fas fa-key"></i>
            </div>
            <h1 class="reset-title">{{ __('Mot de passe oublié?') }}</h1>
            <p class="reset-subtitle">
                {{ __('Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success-custom mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="resetForm">
            @csrf

            <!-- Email Address -->
            <div class="form-floating">
                <input 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    placeholder="{{ __('Adresse e-mail') }}"
                >
                <label for="email">
                    <i class="fas fa-envelope me-2"></i>{{ __('Adresse e-mail') }}
                </label>
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                    <i class="fas fa-paper-plane me-2"></i>
                    {{ __('Envoyer le lien de réinitialisation') }}
                </button>
            </div>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i>
                {{ __('Retour à la connexion') }}
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('email');

    // Form submission with loading state
    form.addEventListener('submit', function() {
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;
    });

    // Email validation with visual feedback
    emailInput.addEventListener('input', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && emailRegex.test(email)) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else if (email) {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-valid', 'is-invalid');
        }
    });

    // Floating shapes interaction
    const shapes = document.querySelectorAll('.floating-shape');
    
    document.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.5;
            const x = (mouseX - 0.5) * speed;
            const y = (mouseY - 0.5) * speed;
            
            shape.style.transform += ` translate(${x}px, ${y}px)`;
        });
    });

    // Card entrance animation
    const card = document.querySelector('.glass-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    observer.observe(card);

    // Enhanced form validation feedback
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Auto-hide success message
    const successAlert = document.querySelector('.alert-success-custom');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            successAlert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                successAlert.remove();
            }, 300);
        }, 5000);
    }

    // Parallax effect for background shapes
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.5;
        
        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.3;
            shape.style.transform = `translateY(${parallax * speed}px)`;
        });
    });
});
</script>
@endpush