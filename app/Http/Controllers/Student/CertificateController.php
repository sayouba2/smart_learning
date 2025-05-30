<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use PDF;

class CertificateController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupère tous les cours complétés par l'étudiant
        $completedCourses = $user->completedCourses()->get();

        return view('student.certificate.index', [
            'courses' => $completedCourses
        ]);
    }

    public function generate(Course $course)
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur est bien un étudiant inscrit au cours ET l'a complété
        $isCompleted = $user->completedCourses()->where('course_id', $course->id)->exists();

        if (!$isCompleted) {
            abort(403, 'Vous devez terminer le cours pour obtenir le certificat.');
        }

        $pdf = PDF::loadView('student.certificate', [
            'user' => $user,
            'course' => $course,
            'date' => now()->format('d/m/Y')
        ]);

        return $pdf->download('certificat-' . $course->title . '.pdf');
    }
}
