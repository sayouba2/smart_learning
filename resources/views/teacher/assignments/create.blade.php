@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50">
    <!-- Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
        <div id="progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-300 ease-out" style="width: 0%"></div>
    </div>

    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Créer un nouveau devoir</h1>
                        <p class="text-sm text-gray-600 mt-1">Organisez le travail de vos étudiants</p>
                    </div>
                </div>
                
                <a href="{{ route('teacher.assignments.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('teacher.assignments.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              id="assignment-form"
              x-data="assignmentForm()"
              x-on:submit="onSubmit">
            @csrf

            <!-- Form Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center" x-bind:class="currentStep >= 1 ? 'text-blue-600' : 'text-gray-400'">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-200"
                                 x-bind:class="currentStep >= 1 ? 'border-blue-600 bg-blue-600 text-white' : 'border-gray-300'">
                                <span class="text-sm font-medium">1</span>
                            </div>
                            <span class="ml-2 text-sm font-medium">Informations de base</span>
                        </div>
                        
                        <div class="w-16 h-px bg-gray-300"></div>
                        
                        <div class="flex items-center" x-bind:class="currentStep >= 2 ? 'text-blue-600' : 'text-gray-400'">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-200"
                                 x-bind:class="currentStep >= 2 ? 'border-blue-600 bg-blue-600 text-white' : 'border-gray-300'">
                                <span class="text-sm font-medium">2</span>
                            </div>
                            <span class="ml-2 text-sm font-medium">Configuration</span>
                        </div>
                        
                        <div class="w-16 h-px bg-gray-300"></div>
                        
                        <div class="flex items-center" x-bind:class="currentStep >= 3 ? 'text-blue-600' : 'text-gray-400'">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-200"
                                 x-bind:class="currentStep >= 3 ? 'border-blue-600 bg-blue-600 text-white' : 'border-gray-300'">
                                <span class="text-sm font-medium">3</span>
                            </div>
                            <span class="ml-2 text-sm font-medium">Finalisation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 1: Basic Information -->
            <div x-show="currentStep === 1" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-6"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Informations de base</h2>
                    <p class="text-gray-600">Commencez par définir le titre et la description de votre devoir</p>
                </div>

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Titre du devoir <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}"
                                   x-model="formData.title"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Ex: Analyse de texte - Chapitre 3"
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <div class="relative">
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      x-model="formData.description"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                      placeholder="Décrivez les objectifs et consignes de ce devoir...">{{ old('description') }}</textarea>
                            <div class="absolute bottom-3 right-3">
                                <span class="text-xs text-gray-400" x-text="`${formData.description.length}/500`"></span>
                            </div>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="button" 
                            x-on:click="nextStep()"
                            x-bind:disabled="!formData.title.trim()"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Suivant
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 2: Configuration -->
            <div x-show="currentStep === 2" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-6"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Configuration du devoir</h2>
                    <p class="text-gray-600">Définissez la date limite et associez le devoir à un cours</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Date et heure limite <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="datetime" 
                                   name="due_date" 
                                   id="due_date"
                                   value="{{ old('due_date') }}"
                                   x-model="formData.due_date"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('due_date')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Cours associé <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="course_id" 
                                    id="course_id"
                                    x-model="formData.course_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none bg-white" 
                                    required>
                                <option value="">-- Sélectionner un cours --</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('course_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" 
                            x-on:click="prevStep()"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                        </svg>
                        Précédent
                    </button>
                    
                    <button type="button" 
                            x-on:click="nextStep()"
                            x-bind:disabled="!formData.due_date || !formData.course_id"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Suivant
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Step 3: File Upload & Finalization -->
            <div x-show="currentStep === 3" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-6"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Finalisation</h2>
                    <p class="text-gray-600">Ajoutez un fichier optionnel et finalisez votre devoir</p>
                </div>

                <!-- File Upload -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Fichier joint (optionnel)
                    </label>
                    
                    <div class="relative">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors duration-200"
                             x-data="fileUpload()"
                             x-on:dragover.prevent="dragover = true"
                             x-on:dragleave.prevent="dragover = false"
                             x-on:drop.prevent="handleDrop($event)"
                             x-bind:class="{ 'border-blue-400 bg-blue-50': dragover }">
                            
                            <input type="file" 
                                   name="file" 
                                   id="file"
                                   accept=".pdf,.docx"
                                   x-on:change="handleFileSelect($event)"
                                   class="hidden"
                                   x-ref="fileInput">
                            
                            <div x-show="!selectedFile">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-lg font-medium text-gray-700 mb-2">Glissez votre fichier ici</p>
                                <p class="text-sm text-gray-500 mb-4">ou <button type="button" x-on:click="$refs.fileInput.click()" class="text-blue-600 hover:text-blue-700 font-medium">parcourez vos fichiers</button></p>
                                <p class="text-xs text-gray-400">PDF, DOCX jusqu'à 5MB</p>
                            </div>
                            
                            <div x-show="selectedFile" class="flex items-center justify-center space-x-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900" x-text="selectedFile?.name"></p>
                                        <p class="text-sm text-gray-500" x-text="formatFileSize(selectedFile?.size)"></p>
                                    </div>
                                </div>
                                <button type="button" 
                                        x-on:click="removeFile()"
                                        class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    @error('file')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Summary -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Récapitulatif</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Titre :</span>
                            <span class="font-medium text-gray-900" x-text="formData.title || 'Non défini'"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Cours :</span>
                            <span class="font-medium text-gray-900" x-text="getCourseName() || 'Non sélectionné'"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date limite :</span>
                            <span class="font-medium text-gray-900" x-text="formatDate(formData.due_date) || 'Non définie'"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Description :</span>
                            <span class="font-medium text-gray-900" x-text="formData.description || 'Aucune'"></span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <button type="button" 
                            x-on:click="prevStep()"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                        </svg>
                        Précédent
                    </button>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('teacher.assignments.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all duration-200">
                            Annuler
                        </a>
                        
                        <button type="submit" 
                                x-bind:disabled="submitting"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg x-show="!submitting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <svg x-show="submitting" class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="submitting ? 'Création...' : 'Créer le devoir'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function assignmentForm() {
    return {
        currentStep: 1,
        submitting: false,
        formData: {
            title: '',
            description: '',
            due_date: '',
            course_id: ''
        },
        
        init() {
            this.setCurrentDateTime();
            this.updateProgress();
        },
        
        setCurrentDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            this.formData.due_date = `${year}-${month}-${day}T${hours}:${minutes}`;
        },
        
        nextStep() {
            if (this.currentStep < 3) {
                this.currentStep++;
                this.updateProgress();
                this.scrollToTop();
            }
        },
        
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.updateProgress();
                this.scrollToTop();
            }
        },
        
        updateProgress() {
            const progress = (this.currentStep / 3) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
        },
        
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        
        onSubmit() {
            this.submitting = true;
        },
        
        getCourseName() {
            const select = document.getElementById('course_id');
            const selectedOption = select.options[select.selectedIndex];
            return selectedOption && selectedOption.value ? selectedOption.text : '';
        },
        
        formatDate(dateString) {
            if (!dateString) return '';
            
            const date = new Date(dateString);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };
            
            return date.toLocaleDateString('fr-FR', options);
        }
    }
}

function fileUpload() {
    return {
        dragover: false,
        selectedFile: null,
        
        handleDrop(event) {
            this.dragover = false;
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                this.processFile(files[0]);
            }
        },
        
        handleFileSelect(event) {
            const files = event.target.files;
            if (files.length > 0) {
                this.processFile(files[0]);
            }
        },
        
        processFile(file) {
            // Vérifier la taille du fichier (5MB max)
            const maxSize = 5 * 1024 * 1024; // 5MB en bytes
            if (file.size > maxSize) {
                alert('Le fichier est trop volumineux. Taille maximum : 5MB');
                return;
            }
            
            // Vérifier le type de fichier
            const allowedTypes = [
                'application/pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            
            if (!allowedTypes.includes(file.type)) {
                alert('Type de fichier non autorisé. Seuls les fichiers PDF et DOCX sont acceptés.');
                return;
            }
            
            this.selectedFile = file;
        },
        
        removeFile() {
            this.selectedFile = null;
            const fileInput = document.getElementById('file');
            if (fileInput) {
                fileInput.value = '';
            }
        },
        
        formatFileSize(bytes) {
            if (!bytes) return '';
            
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            
            return Math.round(bytes / Math.pow(1024, i) * 100) / 100 + ' ' + sizes[i];
        }
    }
}

// Fonction utilitaire pour valider le formulaire
function validateForm() {
    const title = document.getElementById('title').value.trim();
    const dueDate = document.getElementById('due_date').value;
    const courseId = document.getElementById('course_id').value;
    
    if (!title) {
        alert('Le titre du devoir est obligatoire');
        return false;
    }
    
    if (!dueDate) {
        alert('La date limite est obligatoire');
        return false;
    }
    
    if (!courseId) {
        alert('Vous devez sélectionner un cours');
        return false;
    }
    
    // Vérifier que la date limite est dans le futur
    const selectedDate = new Date(dueDate);
    const now = new Date();
    
    if (selectedDate <= now) {
        alert('La date limite doit être dans le futur');
        return false;
    }
    
    return true;
}

// Fonction pour afficher les notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
    
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ? 'bg-green-500' : 'bg-blue-500';
    notification.classList.add(bgColor, 'text-white');
    
    const icon = type === 'error' ? '⚠️' : type === 'success' ? '✅' : 'ℹ️';
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <span>${icon}</span>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animation d'entrée
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Suppression automatique après 5 secondes
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}

// Gestion des erreurs de validation côté client
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assignment-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
        });
    }
    
    // Auto-sauvegarde en localStorage (optionnel)
    const inputs = document.querySelectorAll('#assignment-form input, #assignment-form textarea, #assignment-form select');
    inputs.forEach(input => {
        // Charger les données sauvegardées
        const savedValue = localStorage.getItem(`assignment_form_${input.name}`);
        if (savedValue && !input.value) {
            input.value = savedValue;
        }
        
        // Sauvegarder lors des modifications
        input.addEventListener('input', function() {
            localStorage.setItem(`assignment_form_${input.name}`, input.value);
        });
    });
    
    // Nettoyer le localStorage après soumission réussie
    form?.addEventListener('submit', function() {
        setTimeout(() => {
            inputs.forEach(input => {
                localStorage.removeItem(`assignment_form_${input.name}`);
            });
        }, 1000);
    });
});

// Raccourcis clavier
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S pour sauvegarder
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        const form = document.getElementById('assignment-form');
        if (form && validateForm()) {
            form.submit();
        }
    }
    
    // Échap pour annuler/revenir
    if (e.key === 'Escape') {
        const backButton = document.querySelector('a[href*="assignments.index"]');
        if (backButton && confirm('Voulez-vous vraiment quitter sans sauvegarder ?')) {
            window.location.href = backButton.href;
        }
    }
});

// Fonction pour prévisualiser le fichier (optionnel)
function previewFile(file) {
    if (file.type === 'application/pdf') {
        const fileURL = URL.createObjectURL(file);
        window.open(fileURL, '_blank');
    } else {
        showNotification('Aperçu non disponible pour ce type de fichier', 'info');
    }
}

// Gestion de la connexion réseau
window.addEventListener('online', function() {
    showNotification('Connexion rétablie', 'success');
});

window.addEventListener('offline', function() {
    showNotification('Connexion perdue. Vos modifications sont sauvegardées localement.', 'error');
});
</script>
@endsection