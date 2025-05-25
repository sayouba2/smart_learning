@extends('layouts.teacher')

@section('content')
<div class="course-creation-container">
    <div class="creation-header">
        <h2 class="creation-title">Créer un nouveau cours</h2>
        <p class="creation-subtitle">Remplissez les détails de votre nouveau cours</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('teacher.courses.store') }}" method="POST" class="creation-form" id="courseForm">
        @csrf
        
        <div class="form-floating mb-4">
            <input type="text" class="form-control" name="title" id="title" placeholder=" " required maxlength="255">
            <label for="title">Titre du cours</label>
            <div class="invalid-feedback">Veuillez saisir un titre pour le cours</div>
            <div class="form-text">Maximum 255 caractères</div>
        </div>

        <div class="form-floating mb-4">
            <textarea class="form-control" name="description" id="description" placeholder=" " style="height: 150px" required></textarea>
            <label for="description">Description du cours</label>
            <div class="invalid-feedback">Veuillez saisir une description</div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" name="price" id="price" placeholder=" " required min="0" step="0.01">
                    <label for="price">Prix (€)</label>
                    <div class="invalid-feedback">Veuillez saisir un prix valide</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" name="duration" id="duration" placeholder=" " required min="1">
                    <label for="duration">Durée (heures)</label>
                    <div class="invalid-feedback">Veuillez saisir une durée valide</div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" name="level" id="level" required>
                        <option value="" selected disabled>Sélectionnez...</option>
                        <option value="débutant">Débutant</option>
                        <option value="intermédiaire">Intermédiaire</option>
                        <option value="avancé">Avancé</option>
                    </select>
                    <label for="level">Niveau</label>
                    <div class="invalid-feedback">Veuillez sélectionner un niveau</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" name="category_id" id="category_id" required>
                        <option value="" selected disabled>Sélectionnez...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="category_id">Catégorie</label>
                    <div class="invalid-feedback">Veuillez sélectionner une catégorie</div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-submit">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Créer le cours
            </button>
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>

@push('styles')
<style>
    :root {
        --primary-blue: #1a73e8;
        --primary-blue-hover: #1765cc;
        --light-blue: #e8f0fe;
        --blue-accent: #4285f4;
        --blue-shadow: rgba(26, 115, 232, 0.2);
        --dark-blue: #0d47a1;
        --text-primary: #202124;
        --text-secondary: #5f6368;
        --border-color: #dadce0;
        --error-color: #d93025;
        --success-color: #0f9d58;
    }
    
    .course-creation-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 35px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(210, 227, 252, 0.5);
    }
    
    .creation-header {
        margin-bottom: 35px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--light-blue);
        position: relative;
    }
    
    .creation-header::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 80px;
        height: 2px;
        background-color: var(--primary-blue);
    }
    
    .creation-title {
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .creation-subtitle {
        color: var(--text-secondary);
        margin-bottom: 0;
        font-size: 1.05rem;
    }
    
    .creation-form {
        padding: 15px 0;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating label {
        color: var(--text-secondary);
        transition: all 0.25s ease;
        font-weight: 500;
    }
    
    .form-floating .form-control:focus ~ label,
    .form-floating .form-control:not(:placeholder-shown) ~ label,
    .form-floating .form-select:focus ~ label,
    .form-floating .form-select:not(:placeholder-shown) ~ label {
        color: var(--primary-blue);
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 16px;
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
        font-size: 1rem;
        color: var(--text-primary);
        height: calc(3.5rem + 2px);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px var(--blue-shadow);
        outline: none;
    }
    
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%235f6368' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
    }
    
    .form-text {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-top: 6px;
        transition: color 0.2s;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 25px;
        border-top: 2px solid var(--light-blue);
    }
    
    .btn-submit {
        padding: 12px 30px;
        font-weight: 600;
        background-color: var(--primary-blue);
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 6px var(--blue-shadow);
    }
    
    .btn-submit:hover {
        background-color: var(--primary-blue-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px var(--blue-shadow);
    }
    
    .btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 2px 3px var(--blue-shadow);
    }
    
    .btn-outline-secondary {
        padding: 12px 25px;
        font-weight: 500;
        border: 2px solid var(--border-color);
        background: transparent;
        color: var(--text-secondary);
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        background-color: #f5f5f5;
        color: var(--text-primary);
        border-color: #c0c0c0;
    }

    .was-validated .form-control:invalid,
    .was-validated .form-select:invalid {
        border-color: var(--error-color);
        box-shadow: 0 0 0 3px rgba(217, 48, 37, 0.15);
    }
    
    .was-validated .form-control:valid,
    .was-validated .form-select:valid {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(15, 157, 88, 0.15);
    }
    
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .was-validated .form-select:invalid ~ .invalid-feedback {
        display: block;
    }
    
    .invalid-feedback {
        display: none;
        color: var(--error-color);
        font-size: 0.85rem;
        margin-top: 6px;
        font-weight: 500;
    }
    
    .alert-success {
        background-color: rgba(15, 157, 88, 0.1);
        border-left: 4px solid var(--success-color);
        color: #0a693a;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 25px;
        position: relative;
    }
    
    .alert-success .btn-close {
        position: absolute;
        top: 12px;
        right: 12px;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    
    .alert-success .btn-close:hover {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validation en temps réel
        const form = document.getElementById('courseForm');
        const submitBtn = form.querySelector('.btn-submit');
        const spinner = submitBtn.querySelector('.spinner-border');
        
        // Validation des champs
        const validateField = (field) => {
            if (field.checkValidity()) {
                field.classList.remove('is-invalid');
                if (field.value) {
                    field.classList.add('is-valid');
                } else {
                    field.classList.remove('is-valid');
                }
            } else {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
            }
        };
        
        // Écouteurs d'événements pour tous les champs
        document.querySelectorAll('.form-control, .form-select').forEach(field => {
            field.addEventListener('input', () => validateField(field));
            field.addEventListener('change', () => validateField(field));
            field.addEventListener('blur', () => validateField(field));
        });
        
        // Soumission du formulaire
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                
                // Focus sur le premier champ invalide
                const invalidField = form.querySelector('.is-invalid');
                if (invalidField) {
                    invalidField.focus();
                }
            } else {
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
            }
        });
        
        // Compteur de caractères pour le titre
        const titleInput = document.getElementById('title');
        const titleCounter = document.createElement('div');
        titleCounter.className = 'text-end form-text';
        titleInput.parentNode.appendChild(titleCounter);
        
        titleInput.addEventListener('input', function() {
            const remaining = 255 - this.value.length;
            titleCounter.textContent = `${this.value.length}/255 caractères`;
            
            if (remaining < 20) {
                titleCounter.style.color = '#d93025';
            } else {
                titleCounter.style.color = '#5f6368';
            }
        });
        
        // Déclencher l'événement initial
        titleInput.dispatchEvent(new Event('input'));
    });
</script>
@endpush
@endsection