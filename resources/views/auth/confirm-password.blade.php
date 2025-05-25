@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --security-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        --success-gradient: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        --warning-gradient: linear-gradient(135deg, #ffd43b 0%, #fab005 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(255, 255, 255, 0.18);
        --shadow-primary: 0 32px 64px rgba(102, 126, 234, 0.15);
        --shadow-danger: 0 16px 32px rgba(255, 107, 107, 0.2);
        --dark-bg: rgba(30, 41, 59, 0.95);
        --dark-text: #e2e8f0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--security-gradient);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated security grid background */
    .security-grid {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 0.1;
        background-image: 
            linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: gridMove 20s linear infinite;
    }

    @keyframes gridMove {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* Floating security elements */
    .security-decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .security-element {
        position: absolute;
        color: rgba(255, 255, 255, 0.1);
        font-size: 2rem;
        animation: securityFloat 12s ease-in-out infinite;
    }

    .element-1 { top: 10%; left: 15%; animation-delay: 0s; }
    .element-2 { top: 20%; right: 20%; animation-delay: 3s; }
    .element-3 { bottom: 30%; left: 10%; animation-delay: 6s; }
    .element-4 { bottom: 20%; right: 15%; animation-delay: 9s; }
    .element-5 { top: 60%; left: 70%; animation-delay: 1.5s; }
    .element-6 { top: 40%; right: 60%; animation-delay: 4.5s; }

    @keyframes securityFloat {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg);
            opacity: 0.1;
        }
        50% { 
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.2;
        }
    }

    /* Main container */
    .security-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    /* Glassmorphism card with security theme */
    .security-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: var(--shadow-primary), var(--shadow-danger);
        padding: 3rem 2.5rem;
        width: 100%;
        max-width: 480px;
        position: relative;
        overflow: hidden;
        animation: secureEntrance 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .security-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--danger-gradient);
        animation: securityPulse 2s ease-in-out infinite;
    }

    @keyframes secureEntrance {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes securityPulse {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    /* Header styling */
    .security-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .security-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        background: var(--danger-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(255, 107, 107, 0.3);
        animation: shieldPulse 3s ease-in-out infinite;
        position: relative;
    }

    .security-icon::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border: 2px solid rgba(255, 107, 107, 0.3);
        border-radius: 50%;
        animation: ripple 2s linear infinite;
    }

    @keyframes shieldPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes ripple {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    .security-icon i {
        font-size: 2.2rem;
        color: white;
    }

    .security-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .security-subtitle {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
        padding: 1rem;
        background: rgba(255, 107, 107, 0.05);
        border-radius: 12px;
        border-left: 4px solid #ff6b6b;
    }

    /* Form styling */
    .password-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-floating {
        position: relative;
    }

    .form-floating .form-control {
        height: 65px;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 1rem;
        font-weight: 500;
        padding: 1rem 3.5rem 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.1em;
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Password toggle button */
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #718096;
        font-size: 1.1rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 8px;
    }

    .password-toggle:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }

    /* Security strength indicator */
    .security-indicator {
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .security-indicator.visible {
        opacity: 1;
    }

    .security-dots {
        display: flex;
        gap: 0.25rem;
    }

    .security-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #e2e8f0;
        transition: all 0.3s ease;
    }

    .security-dot.active {
        background: #51cf66;
        transform: scale(1.2);
    }

    /* Button styling */
    .btn-confirm {
        background: var(--security-gradient);
        border: none;
        border-radius: 16px;
        padding: 1rem 2.5rem;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .btn-confirm::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-confirm:hover::before {
        left: 100%;
    }

    .btn-confirm:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 48px rgba(102, 126, 234, 0.4);
    }

    .btn-confirm:active {
        transform: translateY(-1px);
    }

    /* Error styling */
    .invalid-feedback {
        color: #e53e3e;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(229, 62, 62, 0.05);
        padding: 0.75rem;
        border-radius: 12px;
        border-left: 4px solid #e53e3e;
    }

    .form-control.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1);
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Loading state */
    .btn-loading {
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

    /* Back link */
    .back-section {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(113, 128, 150, 0.2);
    }

    .back-link {
        color: #718096;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
    }

    .back-link:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        transform: translateX(-3px);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .security-card {
            margin: 1rem;
            padding: 2rem 1.5rem;
        }
        
        .security-title {
            font-size: 1.5rem;
        }
        
        .security-element {
            font-size: 1.5rem;
            opacity: 0.05;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .security-card {
            background: var(--dark-bg);
            color: var(--dark-text);
        }
        
        .security-title {
            color: var(--dark-text);
        }
        
        .form-floating .form-control {
            background: rgba(30, 41, 59, 0.8);
            border-color: #4a5568;
            color: var(--dark-text);
        }
        
        .form-floating label {
            color: #a0aec0;
        }
    }
</style>
@endpush

@section('content')
<div class="security-grid"></div>

<div class="security-decoration">
    <div class="security-element element-1"><i class="fas fa-shield-alt"></i></div>
    <div class="security-element element-2"><i class="fas fa-lock"></i></div>
    <div class="security-element element-3"><i class="fas fa-key"></i></div>
    <div class="security-element element-4"><i class="fas fa-user-shield"></i></div>
    <div class="security-element element-5"><i class="fas fa-fingerprint"></i></div>
    <div class="security-element element-6"><i class="fas fa-eye-slash"></i></div>
</div>

<div class="security-container">
    <div class="security-card">
        <div class="security-header">
            <div class="security-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1 class="security-title">{{ __('Zone Sécurisée') }}</h1>
            <div class="security-subtitle">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ __('Il s\'agit d\'une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
            </div>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" id="confirmForm">
            @csrf

            <!-- Password -->
            <div class="password-group">
                <div class="form-floating">
                    <input 
                        id="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="{{ __('Mot de passe') }}"
                    >
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>{{ __('Mot de passe') }}
                    </label>
                    <button type="button" class="password-toggle" id="passwordToggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <div class="security-indicator" id="securityIndicator">
                    <div class="security-dots">
                        <div class="security-dot"></div>
                        <div class="security-dot"></div>
                        <div class="security-dot"></div>
                        <div class="security-dot"></div>
                        <div class="security-dot"></div>
                    </div>
                    <span class="security-text">Vérification en cours...</span>
                </div>

                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-confirm" id="confirmBtn">
                    <i class="fas fa-check-circle"></i>
                    {{ __('Confirmer') }}
                </button>
            </div>
        </form>

        <div class="back-section">
            <a href="{{ url()->previous() }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                {{ __('Retour') }}
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('confirmForm');
    const confirmBtn = document.getElementById('confirmBtn');
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const securityIndicator = document.getElementById('securityIndicator');

    // Password visibility toggle
    passwordToggle.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type');
        const icon = this.querySelector('i');
        
        if (type === 'password') {
            passwordInput.setAttribute('type', 'text');
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.setAttribute('type', 'password');
            icon.className = 'fas fa-eye';
        }
    });

    // Form submission with loading state
    form.addEventListener('submit', function() {
        confirmBtn.classList.add('btn-loading');
        confirmBtn.disabled = true;
        
        // Security animation during submission
        const dots = securityIndicator.querySelectorAll('.security-dot');
        let dotIndex = 0;
        const loadingInterval = setInterval(() => {
            dots.forEach(dot => dot.classList.remove('active'));
            dots[dotIndex].classList.add('active');
            dotIndex = (dotIndex + 1) % dots.length;
        }, 200);
        
        // Clear interval after form submission (if needed)
        setTimeout(() => clearInterval(loadingInterval), 5000);
    });

    // Password input security feedback
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const dots = securityIndicator.querySelectorAll('.security-dot');
        const securityText = securityIndicator.querySelector('.security-text');
        
        if (password.length > 0) {
            securityIndicator.classList.add('visible');
            
            // Simple security strength visualization
            let strength = 0;
            if (password.length >= 3) strength++;
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            
            dots.forEach((dot, index) => {
                if (index < strength) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
            
            const strengthTexts = [
                'Très faible',
                'Faible', 
                'Moyen',
                'Fort',
                'Très fort'
            ];
            
            securityText.textContent = strengthTexts[strength - 1] || 'Très faible';
        } else {
            securityIndicator.classList.remove('visible');
        }
    });

    // Enhanced security animations
    const securityElements = document.querySelectorAll('.security-element');
    
    // Mouse interaction with security elements
    document.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        securityElements.forEach((element, index) => {
            const speed = (index + 1) * 0.3;
            const x = (mouseX - 0.5) * speed * 10;
            const y = (mouseY - 0.5) * speed * 10;
            
            element.style.transform = `translate(${x}px, ${y}px) rotate(${x * 0.5}deg)`;
        });
    });

    // Security card entrance animation
    const securityCard = document.querySelector('.security-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0) scale(1)';
            }
        });
    });

    observer.observe(securityCard);

    // Enhanced input focus effects
    passwordInput.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.02)';
        this.parentElement.style.zIndex = '10';
    });

    passwordInput.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
        this.parentElement.style.zIndex = '1';
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            form.submit();
        }
        
        // Escape to go back
        if (e.key === 'Escape') {
            window.history.back();
        }
    });

    // Security pulse effect on error
    if (document.querySelector('.is-invalid')) {
        const securityIcon = document.querySelector('.security-icon');
        securityIcon.style.animation = 'shieldPulse 0.5s ease-in-out 3';
        securityIcon.style.background = 'var(--danger-gradient)';
    }

    // Auto-focus password input
    setTimeout(() => {
        passwordInput.focus();
    }, 500);

    // Parallax effect for grid
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const grid = document.querySelector('.security-grid');
        if (grid) {
            grid.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });
});
</script>
@endpush