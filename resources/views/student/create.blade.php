@extends('layouts.admin')

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .form-floating {
        position: relative;
    }
    
    .form-floating input:focus + label,
    .form-floating input:not(:placeholder-shown) + label {
        transform: translateY(-1.5rem) scale(0.85);
        color: #6366f1;
    }
    
    .form-floating label {
        position: absolute;
        top: 0.75rem;
        left: 1rem;
        transition: all 0.3s ease;
        pointer-events: none;
        color: #6b7280;
        background: white;
        padding: 0 0.25rem;
    }
    
    .animate-slide-up {
        animation: slideUp 0.6s ease-out;
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
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8 animate-slide-up">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Nouvel Étudiant</h1>
            <p class="text-gray-600">Ajoutez un nouvel étudiant au système</p>
        </div>

        <!-- Form Card -->
        <div class="max-w-2xl mx-auto">
            <div class="glass-effect rounded-2xl shadow-xl p-8 animate-slide-up" style="animation-delay: 0.2s;">
                <!-- Progress Indicator -->
                <div class="flex items-center mb-8">
                    <div class="flex items-center text-indigo-600">
                        <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">1</div>
                        <span class="ml-3 font-medium">Informations personnelles</span>
                    </div>
                    <div class="flex-1 h-px bg-gray-200 mx-4"></div>
                    <div class="flex items-center text-gray-400">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-semibold text-sm">2</div>
                        <span class="ml-3 font-medium">Confirmation</span>
                    </div>
                </div>

                <form id="studentForm" action="{{ route('admin.students.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Alert pour les erreurs -->
                    <div id="errorAlert" class="hidden bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-red-700" id="errorMessage"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Nom complet -->
                    <div class="form-floating">
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            placeholder=" "
                            class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-300 peer"
                            required
                        >
                        <label for="name" class="text-gray-500">Nom complet</label>
                        <div class="invalid-feedback hidden text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Email -->
                    <div class="form-floating">
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            placeholder=" "
                            class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-300 peer"
                            required
                        >
                        <label for="email" class="text-gray-500">Adresse email</label>
                        <div class="invalid-feedback hidden text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-floating relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder=" "
                            class="w-full px-4 py-3 pr-12 text-gray-900 bg-white border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-300 peer"
                            required
                        >
                        <label for="password" class="text-gray-500">Mot de passe</label>
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <div class="invalid-feedback hidden text-red-500 text-sm mt-1"></div>
                        
                        <!-- Indicateur de force du mot de passe -->
                        <div class="mt-2">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Force du mot de passe</span>
                                <span id="passwordStrengthText">Faible</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="passwordStrengthBar" class="h-2 rounded-full transition-all duration-300 bg-red-500" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="form-floating">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            placeholder=" "
                            class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-300 peer"
                            required
                        >
                        <label for="password_confirmation" class="text-gray-500">Confirmer le mot de passe</label>
                        <div class="invalid-feedback hidden text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button 
                            type="button"
                            onclick="window.history.back()"
                            class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors duration-300 font-medium"
                        >
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Annuler
                        </button>
                        
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                        >
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span id="submitText">Créer l'étudiant</span>
                            <svg id="loadingSpinner" class="hidden w-5 h-5 inline ml-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('studentForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');
    const passwordStrengthBar = document.getElementById('passwordStrengthBar');
    const passwordStrengthText = document.getElementById('passwordStrengthText');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');

    // Toggle password visibility
    togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        
        if (type === 'text') {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
            `;
        } else {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        }
    });

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updatePasswordStrengthUI(strength);
    });

    function calculatePasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score += 25;
        if (password.match(/[a-z]/)) score += 25;
        if (password.match(/[A-Z]/)) score += 25;
        if (password.match(/[0-9]/)) score += 25;
        if (password.match(/[^a-zA-Z0-9]/)) score += 25;
        return Math.min(score, 100);
    }

    function updatePasswordStrengthUI(strength) {
        passwordStrengthBar.style.width = strength + '%';
        
        if (strength < 25) {
            passwordStrengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
            passwordStrengthText.textContent = 'Très faible';
        } else if (strength < 50) {
            passwordStrengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-orange-500';
            passwordStrengthText.textContent = 'Faible';
        } else if (strength < 75) {
            passwordStrengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
            passwordStrengthText.textContent = 'Moyen';
        } else {
            passwordStrengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
            passwordStrengthText.textContent = 'Fort';
        }
    }

    // Password confirmation validation
    passwordConfirmInput.addEventListener('input', function() {
        const feedback = this.parentElement.querySelector('.invalid-feedback');
        if (this.value !== passwordInput.value && this.value !== '') {
            this.classList.add('border-red-500');
            feedback.textContent = 'Les mots de passe ne correspondent pas';
            feedback.classList.remove('hidden');
        } else {
            this.classList.remove('border-red-500');
            feedback.classList.add('hidden');
        }
    });

    // Form validation and submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset previous errors
        clearErrors();
        
        // Validate form
        if (!validateForm()) {
            return;
        }
        
        // Show loading state
        showLoadingState();
        
        // Simulate form submission delay (remove in production)
        setTimeout(() => {
            form.submit();
        }, 1000);
    });

    function validateForm() {
        let isValid = true;
        const fields = ['name', 'email', 'password', 'password_confirmation'];
        
        fields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            const feedback = field.parentElement.querySelector('.invalid-feedback');
            
            if (!field.value.trim()) {
                showFieldError(field, 'Ce champ est obligatoire');
                isValid = false;
            } else if (fieldName === 'email' && !isValidEmail(field.value)) {
                showFieldError(field, 'Adresse email invalide');
                isValid = false;
            } else if (fieldName === 'password' && field.value.length < 8) {
                showFieldError(field, 'Le mot de passe doit contenir au moins 8 caractères');
                isValid = false;
            } else if (fieldName === 'password_confirmation' && field.value !== passwordInput.value) {
                showFieldError(field, 'Les mots de passe ne correspondent pas');
                isValid = false;
            }
        });
        
        return isValid;
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showFieldError(field, message) {
        field.classList.add('border-red-500');
        const feedback = field.parentElement.querySelector('.invalid-feedback');
        feedback.textContent = message;
        feedback.classList.remove('hidden');
    }

    function clearErrors() {
        document.querySelectorAll('input').forEach(input => {
            input.classList.remove('border-red-500');
        });
        document.querySelectorAll('.invalid-feedback').forEach(feedback => {
            feedback.classList.add('hidden');
        });
        errorAlert.classList.add('hidden');
    }

    function showLoadingState() {
        submitBtn.disabled = true;
        submitText.textContent = 'Création en cours...';
        loadingSpinner.classList.remove('hidden');
        submitBtn.classList.add('opacity-75');
    }

    // Floating label animation
    document.querySelectorAll('.form-floating input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('label').classList.add('text-indigo-600');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('label').classList.remove('text-indigo-600');
            }
        });
    });

    // Add smooth scroll to error
    function scrollToError() {
        const firstError = document.querySelector('.border-red-500');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    }

    // Real-time validation
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-500');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback) feedback.classList.add('hidden');
            }
        });
    });
});
</script>
@endpush