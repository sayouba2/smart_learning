<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Tableau de bord enseignant
    public function show()
    {
        return view('teacher.dashboard');
    }

    // Formulaire de création d'un enseignant
    public function create()
    {
        return view('teacher.create');
    }

    // Enregistrement d’un nouvel enseignant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'teacher';

        User::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Enseignant créé avec succès');
    }

    // Suppression d’un enseignant
    public function destroy($id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Enseignant supprimé avec succès');
    }
}
