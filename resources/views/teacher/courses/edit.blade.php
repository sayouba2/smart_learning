@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Modifier le cours</h1>
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('teacher.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Champ Titre -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Titre du cours</label>
                    <input type="text" name="title" id="title" 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('title', $course->title) }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champs groupés -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Prix -->
                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Prix (€)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                               class="w-full px-4 py-2 border rounded-lg"
                               value="{{ old('price', $course->price) }}">
                    </div>

                    <!-- Niveau -->
                    <div>
                        <label for="level" class="block text-gray-700 font-medium mb-2">Niveau</label>
                        <select name="level" id="level" class="w-full px-4 py-2 border rounded-lg">
                            <option value="débutant" {{ $course->level == 'débutant' ? 'selected' : '' }}>Débutant</option>
                            <option value="intermédiaire" {{ $course->level == 'intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                            <option value="avancé" {{ $course->level == 'avancé' ? 'selected' : '' }}>Avancé</option>
                        </select>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full md:w-auto">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-primary {
        background-color: #3b82f6;
        color: white;
    }
    .btn-primary:hover {
        background-color: #2563eb;
    }
    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
    }
</style>
@endpush