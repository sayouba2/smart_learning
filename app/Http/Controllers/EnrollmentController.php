<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EnrollmentController extends Controller
{
    use AuthorizesRequests;
    public function enroll(Course $course)
    {
        $user = Auth::user();
    
        // Vérifie manuellement si l'utilisateur est un étudiant
        if ($user->role !== 'student') {
            abort(403, 'Seuls les étudiants peuvent s’inscrire à un cours.');
        }
    
        // Vérifie si l'utilisateur est déjà inscrit
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà inscrit à ce cours');
        }
    
        // Inscription
        $user->enrolledCourses()->attach($course->id);
    
        return back()->with('success', 'Inscription réussie !');
    }
    
    public function complete(Course $course)
    {
        // Autorisation
        //Gate::authorize('complete', [$course]);

        Auth::user()->enrolledCourses()
              ->updateExistingPivot($course->id, ['completed_at' => now()]);

        return back()->with('success', 'Cours marqué comme terminé');
    }
}
