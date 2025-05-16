<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer les cours créés par l'enseignant avec le nombre d'étudiants
        $courses = Course::with('category')
            ->withCount('students')
            ->where('teacher_id', $user->id)
            ->get();

        // Statistiques
        $stats = [
            'total_courses' => $courses->count(),
            'total_students' => $courses->sum('students_count'),
            'free_courses' => $courses->where('is_free', true)->count(),
        ];

        return view('teacher.dashboard', compact('courses', 'stats'));
    }
}
