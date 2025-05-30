@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Ajouter un nouvel utilisateur</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium">Nom complet</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium">Mot de passe</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium">Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block font-medium">Rôle</label>
            <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Choisir un rôle --</option>
                <option value="student">Étudiant</option>
                <option value="teacher">Enseignant</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            Ajouter l’utilisateur
        </button>
    </form>
</div>
@endsection
