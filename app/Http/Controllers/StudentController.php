<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'student';

        User::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Étudiant créé avec succès');
    }
    public function show()
    {
        return view('student.dashboard');
    }

    public function destroy($id)
{
    $student = User::where('role', 'student')->findOrFail($id);
    $student->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Étudiant supprimé avec succès');
}

}
