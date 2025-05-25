<?php

namespace App\Http\Controllers\Student;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $user = Auth::user();

    $completedCourses = $user->completedCourses()
                             ->with(['teacher', 'category'])
                             ->get();

    $inProgressCourses = $user->inProgressCourses()
                              ->with('teacher')
                              ->get();

    return view('student.dashboard', [
        'completedCourses' => $completedCourses,
        'inProgressCourses' => $inProgressCourses,
        'certificates' => $completedCourses // ✅ plus besoin de getMockCertificates
    ]);
}


    protected function getMockCertificates($user)
    {
        // À remplacer par la vraie logique plus tard
        return $user->completedCourses->map(function ($course) {
            return [
                'course_name' => $course->title,
                'teacher_name' => $course->teacher->name ?? 'N/A',
                'completed_at' => $course->pivot->completed_at,
                'certificate_id' => 'CERT-' . strtoupper(Str::random(8))
            ];
        });
    }
}
