@extends('layouts.teacher')

@push('styles')
<style>
    .gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .gradient-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    }
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .floating-label {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        transition: all 0.3s ease;
        pointer-events: none;
        color: #6b7280;
        background: white;
        padding: 0 0.25rem;
        font-weight: 500;
    }
    
    .input-focused .floating-label,
    .input-filled .floating-label {
        top: -0.5rem;
        left: 0.75rem;
        font-size: 0.75rem;
        color: #6366f1;
        font-weight: 600;
    }
    
    .animate-slide-up {
        animation: slideUp 0.8s ease-out;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    .animate-scale-in {
        animation: scaleIn 0.5s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .step-indicator {
        position: relative;
    }
    
    .step-indicator::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 100%;
        width: 100%;
        height: 2px;
        background: #e5e7eb;
        z-index: 1;
    }
    
    .step-indicator.completed::after {
        background: #10b981;
    }
    
    .floating-action {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 50;
    }
    
    .progress-ring {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 py-8">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-12 animate-slide-up">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Créer un <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">nouveau cours</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Partagez vos connaissances avec le monde entier. Créez un cours engageant et inspirant pour vos étudiants.
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="max-w-4xl mx-auto mb-12 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between relative">
                <div class="flex items-center step-indicator completed">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-semibold text-green-600">Informations de base</span>
                </div>
                <div class="flex items-center step-indicator">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">2</div>
                    <span class="ml-3 font-semibold text-gray-700">Configuration</span>
                </div>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">3</div>
                    <span class="ml-3 font-semibold text-gray-400">Publication</span>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="max-w-4xl mx-auto mb-8 animate-scale-in">
            <div class="bg-green-50 border-l-4 border-green-400 p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="text-green-400 hover:text-green-600 ml-4" onclick="this.parentElement.parentElement.parentElement.remove()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Form -->
        <div class="max-w-4xl mx-auto animate-slide-up" style="animation-delay: 0.4s;">
            <div class="glass-effect rounded-3xl shadow-2xl p-8 md:p-12">
                <form action="{{ route('teacher.courses.store') }}" method="POST" id="courseForm" class="space-y-8">
                    @csrf
                    
                    <!-- Form Progress -->
                    <div class="mb-8">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Progression du formulaire</span>
                            <span id="formProgress">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="progressBar" class="h-2 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Course Title -->
                    <div class="space-y-2">
                        <div class="relative input-group">
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                placeholder=" "
                                maxlength="255"
                                class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white"
                                required
                            >
                            <label class="floating-label text-lg">Titre du cours</label>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-red-500 hidden error-message">Ce champ est obligatoire</span>
                            <span id="titleCounter" class="text-gray-500">0/255 caractères</span>
                        </div>
                    </div>

                    <!-- Course Description -->
                    <div class="space-y-2">
                        <div class="relative input-group">
                            <textarea 
                                name="description" 
                                id="description" 
                                placeholder=" "
                                rows="5"
                                class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white resize-none"
                                required
                            ></textarea>
                            <label class="floating-label text-lg">Description du cours</label>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-red-500 hidden error-message">Veuillez saisir une description</span>
                            <span id="descriptionCounter" class="text-gray-500">0 caractères</span>
                        </div>
                    </div>

                    <!-- Price and Duration Row -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Price -->
                        <div class="space-y-2">
                            <div class="relative input-group">
                                <input 
                                    type="number" 
                                    name="price" 
                                    id="price" 
                                    placeholder=" "
                                    min="0" 
                                    step="0.01"
                                    class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white"
                                    required
                                >
                                <label class="floating-label text-lg">Prix (€)</label>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-red-500 hidden error-message">Veuillez saisir un prix valide</span>
                        </div>

                        <!-- Duration -->
                        <div class="space-y-2">
                            <div class="relative input-group">
                                <input 
                                    type="number" 
                                    name="duration" 
                                    id="duration" 
                                    placeholder=" "
                                    min="1"
                                    class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white"
                                    required
                                >
                                <label class="floating-label text-lg">Durée (heures)</label>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-red-500 hidden error-message">Veuillez saisir une durée valide</span>
                        </div>
                    </div>

                    <!-- Level and Category Row -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Level -->
                        <div class="space-y-2">
                            <div class="relative input-group">
                                <select 
                                    name="level" 
                                    id="level" 
                                    class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white appearance-none"
                                    required
                                >
                                    <option value="" disabled selected></option>
                                    <option value="débutant">🌱 Débutant</option>
                                    <option value="intermédiaire">📈 Intermédiaire</option>
                                    <option value="avancé">🚀 Avancé</option>
                                </select>
                                <label class="floating-label text-lg">Niveau du cours</label>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-red-500 hidden error-message">Veuillez sélectionner un niveau</span>
                        </div>

                        <!-- Category -->
                        <div class="space-y-2">
                            <div class="relative input-group">
                                <select 
                                    name="category_id" 
                                    id="category_id" 
                                    class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-300 peer bg-white appearance-none"
                                    required
                                >
                                    <option value="" disabled selected></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label class="floating-label text-lg">Catégorie</label>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-red-500 hidden error-message">Veuillez sélectionner une catégorie</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                        <button 
                            type="button"
                            onclick="window.location.href='{{ route('teacher.courses.index') }}'"
                            class="flex-1 sm:flex-none px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 font-semibold text-lg"
                        >
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Annuler
                        </button>
                        
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                        >
                            <svg id="submitIcon" class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <svg id="loadingIcon" class="hidden w-6 h-6 inline mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="submitText">Créer le cours</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Action Button (Save Draft) -->
    <div class="floating-action">
        <button 
            type="button" 
            id="saveDraftBtn"
            class="bg-white text-gray-700 rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 hover:bg-gray-50"
            title="Sauvegarder en brouillon"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('courseForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitIcon = document.getElementById('submitIcon');
    const loadingIcon = document.getElementById('loadingIcon');
    const submitText = document.getElementById('submitText');
    const progressBar = document.getElementById('progressBar');
    const formProgress = document.getElementById('formProgress');
    const titleCounter = document.getElementById('titleCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');
    
    // Form fields
    const fields = ['title', 'description', 'price', 'duration', 'level', 'category_id'];
    const inputs = fields.map(field => document.getElementById(field));

    // Floating labels logic
    function handleFloatingLabel(input) {
        const group = input.closest('.input-group');
        if (input.value.trim() !== '' || document.activeElement === input) {
            group.classList.add('input-focused', 'input-filled');
        } else {
            group.classList.remove('input-focused', 'input-filled');
        }
    }

    // Initialize floating labels
    inputs.forEach(input => {
        if (input) {
            handleFloatingLabel(input);
            
            input.addEventListener('focus', () => {
                input.closest('.input-group').classList.add('input-focused');
            });
            
            input.addEventListener('blur', () => {
                input.closest('.input-group').classList.remove('input-focused');
                handleFloatingLabel(input);
                validateField(input);
            });
            
            input.addEventListener('input', () => {
                handleFloatingLabel(input);
                updateProgress();
                clearFieldError(input);
            });
        }
    });

    // Character counters
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');

    titleInput.addEventListener('input', function() {
        const count = this.value.length;
        titleCounter.textContent = `${count}/255 caractères`;
        
        if (count > 230) {
            titleCounter.classList.add('text-red-500');
            titleCounter.classList.remove('text-gray-500');
        } else {
            titleCounter.classList.remove('text-red-500');
            titleCounter.classList.add('text-gray-500');
        }
    });

    descriptionInput.addEventListener('input', function() {
        const count = this.value.length;
        descriptionCounter.textContent = `${count} caractères`;
    });

    // Progress calculation
    function updateProgress() {
        let filledFields = 0;
        const totalFields = fields.length;

        inputs.forEach(input => {
            if (input && input.value.trim() !== '') {
                filledFields++;
            }
        });

        const progress = (filledFields / totalFields) * 100;
        progressBar.style.width = progress + '%';
        formProgress.textContent = Math.round(progress) + '%';
    }

    // Field validation
    function validateField(field) {
        const errorMsg = field.parentElement.parentElement.querySelector('.error-message');
        
        if (!field.checkValidity() || field.value.trim() === '') {
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-200', 'border-green-500');
            if (errorMsg) {
                errorMsg.classList.remove('hidden');
            }
            return false;
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-green-500');
            if (errorMsg) {
                errorMsg.classList.add('hidden');
            }
            return true;
        }
    }

    function clearFieldError(field) {
        if (field.value.trim() !== '') {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-200');
            const errorMsg = field.parentElement.parentElement.querySelector('.error-message');
            if (errorMsg) {
                errorMsg.classList.add('hidden');
            }
        }
    }

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Validate all fields
        inputs.forEach(input => {
            if (input && !validateField(input)) {
                isValid = false;
            }
        });

        if (!isValid) {
            // Scroll to first error
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitIcon.classList.add('hidden');
        loadingIcon.classList.remove('hidden');
        submitText.textContent = 'Création en cours...';

        // Submit form after delay (for demo purposes)
        setTimeout(() => {
            form.submit();
        }, 1500);
    });

    // Save draft functionality
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    saveDraftBtn.addEventListener('click', function() {
        // Here you would implement the save draft functionality
        alert('Fonctionnalité de sauvegarde en brouillon à implémenter');
    });

    // Initialize progress
    updateProgress();

    // Animate elements on load
    setTimeout(() => {
        document.querySelectorAll('.animate-slide-up, .animate-fade-in, .animate-scale-in').forEach(el => {
            el.style.opacity = '1';
        });
    }, 100);
});

// CSS animations for blobs
const style = document.createElement('style');
style.textContent = `
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
`;
document.head.appendChild(style);
</script>
@endpush