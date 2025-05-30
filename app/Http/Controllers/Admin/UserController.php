<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::all(); // ou paginate() si besoin
        return view('admin.users.index', compact('users'));
    }

    /**
     * Afficher le formulaire de création d’un utilisateur.
     */
    public function create()
    {
        return view('admin.users.create'); // Vue contenant le formulaire (nom, email, mot de passe, rôle)
    }

    /**
     * Mettre à jour le rôle ou les données d’un utilisateur.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'role' => 'required|in:student,teacher,admin', // les rôles autorisés
        ]);

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Stocker un nouvel utilisateur (étudiant ou enseignant).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:student,teacher',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }
}
