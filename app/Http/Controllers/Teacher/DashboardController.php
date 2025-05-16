<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // app/Http/Controllers/Teacher/DashboardController.php
public function index()
{
    $user = Auth::user();
    
    return view('student.dashboard', [
        'inProgressCourses' => $user->enrolledCourses()
            ->wherePivotNull('completed_at')
            ->with('teacher')
            ->latest('enrollments.created_at')
            ->get(),
            
        'completedCourses' => $user->enrolledCourses()
            ->wherePivotNotNull('completed_at')
            ->with('teacher')
            ->latest('enrollments.completed_at')
            ->get(),
            
        'certificates' => $user->certificates()->with('course.teacher')->get()
            ->map(function ($cert) {
                return [
                    'course_name' => $cert->course->title,
                    'teacher_name' => $cert->course->teacher->name,
                    'completed_at' => $cert->created_at->format('d/m/Y'),
                    'certificate_id' => 'CERT-'.strtoupper(Str::random(8))
                ];
            })
    ]);
}
}
