@extends('layouts.teacher')

@push('styles')
<style>
    .lesson-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }
    .form-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    .form-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: #4f46e5;
        border-radius: 2px;
    }
    .form-label {
        display: block;
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    .form-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        outline: none;
    }
    .form-textarea {
        min-height: 200px;
        resize: vertical;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .submit-btn {
        background: #4f46e5;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .submit-btn:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .submit-btn:active {
        transform: translateY(0);
    }
    .character-count {
        font-size: 0.875rem;
        color: #718096;
        text-align: right;
        margin-top: 0.25rem;
    }
    .word-count {
        font-size: 0.875rem;
        color: #718096;
        text-align: right;
        margin-top: 0.25rem;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="lesson-form-container">
        <h1 class="form-title">Créer une nouvelle leçon</h1>

        <form action="{{ route('teacher.lessons.store', $course) }}" method="POST" id="lessonForm">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="form-label">Titre de la leçon</label>
                <input type="text" name="title" id="title" class="form-input" required
                       placeholder="Donnez un titre clair à votre leçon">
                <div id="title-count" class="character-count">0/100 caractères</div>
            </div>

            <div class="mb-6">
                <label for="content" class="form-label">Contenu détaillé</label>
                <textarea name="content" id="content" class="form-input form-textarea" required
                          placeholder="Décrivez en détail le contenu de cette leçon..."></textarea>
                <div class="flex justify-between">
                    <div id="word-count" class="word-count">0 mots</div>
                    <div id="content-count" class="character-count">0/5000 caractères</div>
                </div>
            </div>

            <div class="form-grid mb-8">
                <div>
                    <label for="duration" class="form-label">Durée (minutes)</label>
                    <input type="number" name="duration" id="duration" min="1" max="300" 
                           class="form-input" required value="30">
                    <div class="text-sm text-gray-500 mt-1">Entre 1 et 300 minutes</div>
                </div>
                <div>
                    <label for="order" class="form-label">Ordre d'affichage</label>
                    <input type="number" name="order" id="order" min="0" 
                           class="form-input" value="{{ $course->lessons->count() + 1 }}">
                    <div class="text-sm text-gray-500 mt-1">Détermine la séquence dans le cours</div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('teacher.courses.show', $course) }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" class="submit-btn">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Créer la leçon
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Compteur de caractères pour le titre
    const titleInput = document.getElementById('title');
    const titleCount = document.getElementById('title-count');
    
    titleInput.addEventListener('input', function() {
        const count = this.value.length;
        titleCount.textContent = `${count}/100 caractères`;
        
        if (count > 100) {
            titleCount.classList.add('text-red-500');
        } else {
            titleCount.classList.remove('text-red-500');
        }
    });

    // Compteur de mots et caractères pour le contenu
    const contentInput = document.getElementById('content');
    const wordCount = document.getElementById('word-count');
    const contentCount = document.getElementById('content-count');
    
    contentInput.addEventListener('input', function() {
        const text = this.value;
        const charCount = text.length;
        const wordCountValue = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
        
        wordCount.textContent = `${wordCountValue} mots`;
        contentCount.textContent = `${charCount}/5000 caractères`;
        
        if (charCount > 5000) {
            contentCount.classList.add('text-red-500');
        } else {
            contentCount.classList.remove('text-red-500');
        }
    });

    // Validation du formulaire
    const lessonForm = document.getElementById('lessonForm');
    
    lessonForm.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validation du titre
        if (titleInput.value.length > 100) {
            alert('Le titre ne doit pas dépasser 100 caractères');
            isValid = false;
        }
        
        // Validation du contenu
        if (contentInput.value.length > 5000) {
            alert('Le contenu ne doit pas dépasser 5000 caractères');
            isValid = false;
        }
        
        // Validation de la durée
        const duration = parseInt(document.getElementById('duration').value);
        if (duration < 1 || duration > 300) {
            alert('La durée doit être entre 1 et 300 minutes');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Animation d'entrée
    const formElements = document.querySelectorAll('.lesson-form-container > *');
    formElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = `all 0.3s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 50);
    });
});
</script>
@endpush