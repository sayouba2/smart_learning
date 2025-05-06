<?php

namespace App\Http\Controllers\Student;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('student.dashboard', [
            'completedCourses' => $user->completedCourses()->with('teacher')->get(),
            'inProgressCourses' => $user->inProgressCourses()->with('teacher')->get(),
            'certificates' => $this->getMockCertificates($user) // Temporaire
        ]);
    }

    protected function getMockCertificates($user)
    {
        // À remplacer par la vraie logique plus tard
        return $user->completedCourses->map(function ($course) {
            return [
                'course_name' => $course->title,
                'completed_at' => $course->pivot->completed_at->format('Y-m-d'),
                'certificate_id' => 'CERT-' . strtoupper(Str::random(8))
            ];
        });
    } 
}
