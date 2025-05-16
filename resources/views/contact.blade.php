@extends('layouts.contact')

@section('content')
<div class="contact-container">
    <div class="contact-wrapper">
        <!-- Section d'information -->
        <div class="contact-info">
            <div class="info-content">
                <h2>Contactez-nous</h2>
                <p class="subtitle">Nous serions ravis d'échanger avec vous</p>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Adresse</h4>
                        <p>14 rue mayssira Issil Marrakech</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <h4>Téléphone</h4>
                        <p>+212 623113083</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>Email</h4>
                        <p>contact@monsite.com</p>
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <!-- Formulaire de contact -->
        <div class="contact-form">
            @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <span class="close-alert">&times;</span>
            </div>
            @endif

            <h2>Envoyez-nous un message</h2>
            <p class="form-subtitle">Remplissez ce formulaire et nous vous répondrons dès que possible</p>

            <form method="POST" action="{{ route('contact.send') }}" id="contactForm">
                @csrf
                <div class="form-group floating">
                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder=" ">
                    <label for="name">Nom complet</label>
                    <i class="fas fa-user input-icon"></i>
                    @error('name') <small class="error-message">{{ $message }}</small> @enderror
                </div>

                <div class="form-group floating">
                    <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" placeholder=" ">
                    <label for="email">Adresse Email</label>
                    <i class="fas fa-envelope input-icon"></i>
                    @error('email') <small class="error-message">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="message" class="textarea-label">Votre Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                    @error('message') <small class="error-message">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="submit-btn">
                    <span class="btn-text">Envoyer le message</span>
                    <i class="fas fa-paper-plane btn-icon"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #e0e7ff;
    --secondary-color: #3f37c9;
    --success-color: #10b981;
    --success-light: #d1fae5;
    --info-color: #3b82f6;
    --info-light: #dbeafe;
    --warning-color: #f59e0b;
    --warning-light: #fef3c7;
    --danger-color: #ef4444;
    --danger-light: #fee2e2;
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
.contact-container {
    padding: 2rem 1rem;
    background-color: var(--light-color);
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-wrapper {
    max-width: 1200px;
    width: 100%;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

/* Section Info */
.contact-info {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 3rem;
    position: relative;
    overflow: hidden;
}

.contact-info::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.contact-info::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -80px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
}

.info-content {
    position: relative;
    z-index: 1;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.contact-info h2 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.contact-info .subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.info-item i {
    font-size: 1.2rem;
    margin-right: 1rem;
    margin-top: 0.2rem;
    color: rgba(255, 255, 255, 0.8);
}

.info-item h4 {
    font-size: 1.1rem;
    margin-bottom: 0.3rem;
}

.info-item p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: auto;
    padding-top: 2rem;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
}

/* Formulaire */
.contact-form {
    padding: 3rem;
}

.contact-form h2 {
    font-size: 1.8rem;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: var(--gray-color);
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-group.floating {
    position: relative;
}

.form-control {
    width: 100%;
    padding: 1rem 1rem 1rem 2.5rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-light);
    outline: none;
}

textarea.form-control {
    min-height: 150px;
    resize: vertical;
    padding: 1rem;
}

/* Floating Labels */
.floating label {
    position: absolute;
    top: 1rem;
    left: 2.5rem;
    color: var(--gray-color);
    transition: all 0.3s ease;
    pointer-events: none;
    background: white;
    padding: 0 0.3rem;
}

.floating .form-control:focus + label,
.floating .form-control:not(:placeholder-shown) + label {
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

.form-control:focus ~ .input-icon {
    color: var(--primary-color);
}

.textarea-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--gray-color);
    font-size: 0.95rem;
}

/* Bouton Submit */
.submit-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
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

/* Alert */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    position: relative;
}

.alert-success {
    background-color: var(--success-light);
    color: var(--dark-color);
    border-left: 4px solid var(--success-color);
}

.alert i {
    margin-right: 0.75rem;
    color: var(--success-color);
}

.close-alert {
    position: absolute;
    right: 1rem;
    top: 1rem;
    cursor: pointer;
    font-size: 1.2rem;
    opacity: 0.7;
    transition: opacity 0.2s;
}

.close-alert:hover {
    opacity: 1;
}

/* Error Messages */
.error-message {
    color: var(--danger-color);
    font-size: 0.8rem;
    margin-top: 0.3rem;
    display: block;
}

/* Responsive */
@media (max-width: 992px) {
    .contact-wrapper {
        grid-template-columns: 1fr;
    }
    
    .contact-info {
        padding: 2rem;
    }
    
    .contact-form {
        padding: 2rem;
    }
    
    .social-links {
        margin-top: 2rem;
    }
}

@media (max-width: 576px) {
    .contact-container {
        padding: 1rem 0.5rem;
    }
    
    .contact-info, .contact-form {
        padding: 1.5rem;
    }
    
    .contact-info h2, .contact-form h2 {
        font-size: 1.5rem;
    }
    
    .submit-btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des éléments au chargement
    const contactItems = document.querySelectorAll('.info-item, .contact-form h2, .contact-form .form-group');
    contactItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
        item.classList.add('animate-fade-in');
    });

    // Fermer l'alerte
    const closeAlert = document.querySelector('.close-alert');
    if (closeAlert) {
        closeAlert.addEventListener('click', function() {
            this.parentElement.style.opacity = '0';
            setTimeout(() => {
                this.parentElement.remove();
            }, 300);
        });
    }

    // Animation du formulaire
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.input-icon').style.animation = 'float 1.5s infinite';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.querySelector('.input-icon').style.animation = '';
        });
    });

    // Validation du formulaire
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = this.querySelectorAll('[required]');
            
            inputs.forEach(input => {
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
    formInputs.forEach(input => {
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